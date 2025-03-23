<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Exports\BlogExport;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class BlogController extends Controller
{
    public function list(Request $request)
    {        
        $show_limit = $request->show_limit ?? null;
        $blog_lists = $this->getBlogData($request);
    
        $perPage = $show_limit && $show_limit > 0 ? $show_limit : config('default_pagination');
    
        // Use Laravel's built-in pagination
        $blog_lists = $blog_lists->paginate($perPage);
    
        return view('admin-views.blog.list', compact('blog_lists'));
    }
    
    private function getBlogData($request)
    {
        $key = [];
        if ($request->search) {
            $key = explode(' ', $request['search']);
        }

        $from_date = null;
        $to_date = null;

        if ($request?->blog_date) {
            list($from_date, $to_date) = explode(' - ', $request?->blog_date);
            $from_date = Carbon::createFromFormat('m/d/Y', $from_date)->startOfDay();
            $to_date = Carbon::createFromFormat('m/d/Y', $to_date)->endOfDay();
        }

        $blog_lists = Blog::orderby('created_at', 'desc')
            ->when(count($key) > 0, function ($query) use ($key) {
                foreach ($key as $value) {
                    $query->orWhere('blog_title', 'like', "%{$value}%");
                }
            })
            ->when(isset($request->blog_date), function ($query) use ($from_date, $to_date) {
                $query->WhereBetween('created_at', [$from_date, $to_date]);
            });

        return $blog_lists;
    }

    public function new()
    {
        return view('admin-views.blog.new');
    }

    function store(Request $request)
    {
        $request->validate([
            'author_name' => 'required|max:100',
            'blog_title' => 'required|max:200',
            'blog_image' => 'nullable|max:60000',
            'blog_details' => 'required',
            'tags' => 'nullable'
        ]);

        $blog = new Blog();
        $slug = Str::slug($request->blog_title[array_search('default', $request->lang)]);
        $blog->category = $request->blog_category;
        $blog->author_name = $request->author_name[array_search('default', $request->lang)];
        $blog->blog_title = $request->blog_title[array_search('default', $request->lang)];
        $blog->blog_image = $request->has('blog_image') ? Helpers::upload(dir:'blog/',format: 'png',image: $request->file('blog_image')) : 'def.png';
        $blog->blog_details = $request->blog_details[array_search('default', $request->lang)];
        $blog->tags = $request->tags[array_search('default', $request->lang)];
        $blog->slug = $slug;
        $blog->save();

        Helpers::add_or_update_translations(request: $request, key_data:'author_name' , name_field:'author_name' , model_name: 'Blog' ,data_id: $blog->id,data_value: $blog->author_name);
        Helpers::add_or_update_translations(request: $request, key_data:'blog_title' , name_field:'blog_title' , model_name: 'Blog' ,data_id: $blog->id,data_value: $blog->blog_title);
        Helpers::add_or_update_translations(request: $request, key_data:'blog_details' , name_field:'blog_details' , model_name: 'Blog' ,data_id: $blog->id,data_value: $blog->blog_details);
        Helpers::add_or_update_translations(request: $request, key_data:'tags' , name_field:'tags' , model_name: 'Blog' ,data_id: $blog->id,data_value: $blog->tags);

        Toastr::success(translate('messages.blog_added_successfully'));

        return back();
    }

    public function edit($id)
    {
        $blog = Blog::withoutGlobalScope('translate')->findOrFail($id);
        return view('admin-views.blog.edit', compact('blog'));
    }

    public function status(Request $request)
    {
        $blog = Blog::find($request->id);
        $blog->status = $request->status;
        $blog->save();
        Toastr::success(translate('messages.blog_status_updated'));
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'author_name' => 'required|max:100',
            'blog_title' => 'required|max:200',
            'blog_image' => 'nullable|max:60000',
            'blog_details' => 'required',
            'tags' => 'nullable'
        ]);

        $blog = Blog::find($id);
        $slug = Str::slug($request->blog_title[array_search('default', $request->lang)]);
        $blog->slug = $blog->slug? $blog->slug :"{$slug}{$blog->id}";
        $blog->category = $request->blog_category;
        $blog->author_name = $request->author_name[array_search('default', $request->lang)];
        $blog->blog_title = $request->blog_title[array_search('default', $request->lang)];
        $blog->blog_image = $request->has('blog_image') ? Helpers::update(dir:'blog/', old_image:$blog->blog_image,format: 'png', image:$request->file('blog_image')) : $blog->blog_image;
        $blog->blog_details = $request->blog_details[array_search('default', $request->lang)];
        $blog->tags = $request->tags[array_search('default', $request->lang)];
        $blog->save();

        Helpers::add_or_update_translations(request: $request, key_data:'author_name' , name_field:'author_name' , model_name: 'Blog' ,data_id: $blog->id,data_value: $blog->author_name);
        Helpers::add_or_update_translations(request: $request, key_data:'blog_title' , name_field:'blog_title' , model_name: 'Blog' ,data_id: $blog->id,data_value: $blog->blog_title);
        Helpers::add_or_update_translations(request: $request, key_data:'blog_details' , name_field:'blog_details' , model_name: 'Blog' ,data_id: $blog->id,data_value: $blog->blog_details);
        Helpers::add_or_update_translations(request: $request, key_data:'tags' , name_field:'tags' , model_name: 'Blog' ,data_id: $blog->id,data_value: $blog->tags);

        Toastr::success(translate('messages.blog_updated_successfully'));

        return back();
    }

    public function delete(Request $request)
    {
        $blog = Blog::findOrFail($request->id);
        $blog?->translations()?->delete();
        $blog->delete();
        Toastr::success(translate('messages.blog removed!'));
        return back();
    }

    public function export(Request $request){
        try{
                $key = explode(' ', $request['search']);
                $blogs = Blog::when(isset($key) , function ($q) use($key){
                    $q->where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('blog_title', 'like', "%{$value}%");
                        }
                    });
                })
                ->orderBy('id','desc')->get();
                $data=[
                    'blogs' =>$blogs,
                    'search' =>$request['search'] ?? null,
                ];
                if($request->type == 'csv'){
                    return Excel::download(new BlogExport($data), 'Blogs.csv');
                }
                return Excel::download(new BlogExport($data), 'Blogs.xlsx');
            } catch(\Exception $e) {
                Toastr::error("line___{$e->getLine()}",$e->getMessage());
                info(["line___{$e->getLine()}",$e->getMessage()]);
                return back();
            }
    }
}
