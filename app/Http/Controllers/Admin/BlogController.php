<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Str;
use App\CentralLogics\Helpers;
use App\Models\Translation;

class BlogController extends Controller
{
    public function new()
    {
        return view('admin-views.blog.new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'author_name' => 'required',
            'blog_image' => 'nullable|max:60000',
            'blog_title' => 'required',
            'blog_details' => 'required',
        ]);

        $blog = new Blog();
        $slug = Str::slug($request->blog_title[array_search('default', $request->lang)]);
        $blog->author_name = $request->author_name[array_search('default', $request->lang)];
        $blog->blog_image = $request->has('blog_image') ? Helpers::upload(dir:'blog/',format: 'png',image: $request->file('blog_image')) : 'def.png';
        $blog->blog_title = $request->blog_title;
        $blog->blog_details = $request->blog_details;
        $blog->slug = $slug;
        $blog->save();
        $data = [];
        $default_lang = str_replace('_', '-', app()->getLocale());

        foreach($request->lang as $index=>$key)
        {
                if($default_lang == $key && !($request->blog_title[$index])){
                    if ($key != 'default') {
                        array_push($data, array(
                            'translationable_type' => 'App\Models\Blog',
                            'translationable_id' => $blog->id,
                            'locale' => $key,
                            'key' => 'blog_title',
                            'value' => $blog->blog_title,
                        ));
                    }
                }else{
                    if ($request->blog_title[$index] && $key != 'default') {
                        array_push($data, array(
                            'translationable_type' => 'App\Models\Blog',
                            'translationable_id' => $blog->id,
                            'locale' => $key,
                            'key' => 'blog_title',
                            'value' => $request->blog_title[$index],
                        ));
                    }
                }

        }
        if(count($data))
        {
            Translation::insert($data);
        }

        Toastr::success(translate('messages.blog_added_successfully'));
        return redirect()->route('admin.blog.blogs');
    }

    public function edit($id)
    {
        $blog = Blog::withoutGlobalScope('translate')->findOrFail($id);
        return view('admin-views.blog.edit', compact('blog'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'author_name' => 'required',
            'blog_image' => 'nullable|max:60000',
            'blog_title' => 'required',
            'blog_details' => 'required',
        ]);

        $blog = new Blog();
        $slug = Str::slug($request->blog_title[array_search('default', $request->lang)]);
        $blog->author_name = $request->author_name[array_search('default', $request->lang)];
        $blog->blog_image = $request->has('blog_image') ? Helpers::update(dir:'blog/', old_image:$blog->blog_image,format: 'png', image:$request->file('blog_image')) : $blog->blog_image;
        $blog->blog_title = $request->blog_title;
        $blog->blog_details = $request->blog_details;
        $blog->slug = $slug;
        $blog->save();
        $data = [];
        $default_lang = str_replace('_', '-', app()->getLocale());

        foreach($request->lang as $index=>$key)
        {
                if($default_lang == $key && !($request->blog_title[$index])){
                    if ($key != 'default') {
                        array_push($data, array(
                            'translationable_type' => 'App\Models\Blog',
                            'translationable_id' => $blog->id,
                            'locale' => $key,
                            'key' => 'blog_title',
                            'value' => $blog->blog_title,
                        ));
                    }
                }else{
                    if ($request->blog_title[$index] && $key != 'default') {
                        array_push($data, array(
                            'translationable_type' => 'App\Models\Blog',
                            'translationable_id' => $blog->id,
                            'locale' => $key,
                            'key' => 'blog_title',
                            'value' => $request->blog_title[$index],
                        ));
                    }
                }

        }
        if(count($data))
        {
            Translation::insert($data);
        }

        Toastr::success(translate('messages.blog_added_successfully'));
        return redirect()->route('admin.blog.blogs');
    }

    public function list(Request $request)
    {        
        $show_limit = $request->show_limit ?? null;
        $blog_lists = $this->getBlogListData($request);
    
        $perPage = $show_limit && $show_limit > 0 ? $show_limit : config('default_pagination');
    
        // Use Laravel's built-in pagination
        $blog_lists = $blog_lists->paginate($perPage);
    
        return view('admin-views.blog.list', compact('blog_lists'));
    }
    
    private function getBlogListData($request)
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

    public function status(Request $request)
    {
        $blog = Blog::find($request->id);
        $blog->status = $request->status;
        $blog->save();

        Toastr::success(translate('messages.blog_status_updated_successfully'));
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

    public function export(Request $request)
    {
        $show_limit =  $request->show_limit ?? null;
        $blogs = $this->getBlogListData($request);
        if (isset($show_limit) && $show_limit > 0) {
            $blogs = $blogs->take($show_limit)->get();
        } else {
            $blogs = $blogs->get();
        }

        $data = [
            'blogs' => $blogs,
            'filter' => $request->filter ?? null,
            'show_limit' => $request->show_limit ?? null,
            'blog_date' => $request?->blog_date,
            'search' => $request->search ?? null,
        ];

        if ($request->type == 'excel') {
            return Excel::download(new BlogListExport($data), 'Blogs.xlsx');
        } else if ($request->type == 'csv') {
            return Excel::download(new BlogListExport($data), 'Blogs.csv');
        }
    }

}
