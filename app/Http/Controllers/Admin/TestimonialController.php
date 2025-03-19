<?php

namespace App\Http\Controllers\Admin;

use App\Models\Testimonial;
use App\Models\Translation;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Exports\TestimonialExport;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;

class TestimonialController extends Controller
{
    function index(Request $request)
    {
        $key = explode(' ', $request['search']);
        $testimonials = Testimonial::latest()
        ->when(isset($key) , function ($q) use($key){
            $q->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
        })
        ->paginate(config('default_pagination'));
        return view('admin-views.testimonial.index',compact('testimonials'));
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:100',
            'designation' => 'required|max:200',
            'image' => 'nullable|max:60000',
            'message' => 'required|max:500',
            'name.0' => 'required',

        ], [
            'name.required' => translate('messages.Name is required!'),
            'name.0.required'=>translate('default_name_is_required'),
        ]);

        $testimonial = new Testimonial();
        $testimonial->name = $request->name[array_search('default', $request->lang)];
        $testimonial->designation = $request->designation[array_search('default', $request->lang)];
        $testimonial->message = $request->message[array_search('default', $request->lang)];
        $testimonial->image = $request->has('image') ? Helpers::upload(dir:'testimonial/',format: 'png',image: $request->file('image')) : 'def.png';
        $testimonial->save();
        $data = [];
        $default_lang = str_replace('_', '-', app()->getLocale());

        foreach($request->lang as $index=>$key)
        {
                if($default_lang == $key && !($request->name[$index])){
                    if ($key != 'default') {
                        array_push($data, array(
                            'translationable_type' => 'App\Models\Testimonial',
                            'translationable_id' => $testimonial->id,
                            'locale' => $key,
                            'key' => 'name',
                            'value' => $testimonial->name,
                        ));
                    }
                }else{
                    if ($request->name[$index] && $key != 'default') {
                        array_push($data, array(
                            'translationable_type' => 'App\Models\Testimonial',
                            'translationable_id' => $testimonial->id,
                            'locale' => $key,
                            'key' => 'name',
                            'value' => $request->name[$index],
                        ));
                    }
                }

        }
        if(count($data))
        {
            Translation::insert($data);
        }

        Toastr::success(translate('messages.testimonial_added_successfully'));

        return back();
    }

    public function edit($id)
    {
        $testimonial = Testimonial::withoutGlobalScope('translate')->findOrFail($id);
        return view('admin-views.testimonial.edit', compact('testimonial'));
    }

    public function status(Request $request)
    {
        $testimonial = Testimonial::find($request->id);
        $testimonial->status = $request->status;
        $testimonial->save();
        Toastr::success(translate('messages.testimonial_status_updated'));
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100',
            'designation' => 'required|max:200',
            'image' => 'nullable|max:60000',
            'message' => 'required|max:500',
            'name.0' => 'required',

        ], [
            'name.required' => translate('messages.Name is required!'),
            'name.0.required'=>translate('default_name_is_required'),
        ]);

        $testimonial = Testimonial::find($id);
        $testimonial->name = $request->name[array_search('default', $request->lang)];
        $testimonial->designation = $request->designation[array_search('default', $request->lang)];
        $testimonial->message = $request->message[array_search('default', $request->lang)];
        $testimonial->image = $request->has('image') ? Helpers::update(dir:'testimonial/', old_image:$testimonial->image,format: 'png', image:$request->file('image')) : $testimonial->image;
        $testimonial->save();
        $default_lang = str_replace('_', '-', app()->getLocale());

        foreach($request->lang as $index=>$key)
        {

            if($default_lang == $key && !($request->name[$index])){
                if (isset($testimonial->name) && $key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Models\Testimonial',
                            'translationable_id' => $testimonial->id,
                            'locale' => $key,
                            'key' => 'name'
                        ],
                        ['value' => $testimonial->name]
                    );
                }

            }else{

                if ($request->name[$index] && $key != 'default') {
                    Translation::updateOrInsert(
                        [
                            'translationable_type' => 'App\Models\Testimonial',
                            'translationable_id' => $testimonial->id,
                            'locale' => $key,
                            'key' => 'name'
                        ],
                        ['value' => $request->name[$index]]
                    );
                }
            }
        }
        Toastr::success(translate('messages.testimonial_updated_successfully'));

        return back();
    }

    public function delete(Request $request)
    {
        $testimonial = Testimonial::findOrFail($request->id);
        $testimonial?->translations()?->delete();
        $testimonial->delete();
        Toastr::success(translate('messages.testimonial removed!'));
        return back();
    }

    public function export_testimonials(Request $request){
        try{
                $key = explode(' ', $request['search']);
                $testimonials = Testimonial::when(isset($key) , function ($q) use($key){
                    $q->where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('name', 'like', "%{$value}%");
                        }
                    });
                })
                ->orderBy('id','desc')->get();
                $data=[
                    'testimonials' =>$testimonials,
                    'search' =>$request['search'] ?? null,
                ];
                if($request->type == 'csv'){
                    return Excel::download(new TestimonialExport($data), 'Testimonials.csv');
                }
                return Excel::download(new TestimonialExport($data), 'Testimonials.xlsx');
            } catch(\Exception $e) {
                Toastr::error("line___{$e->getLine()}",$e->getMessage());
                info(["line___{$e->getLine()}",$e->getMessage()]);
                return back();
            }
    }
}
