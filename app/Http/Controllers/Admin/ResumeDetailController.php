<?php

namespace App\Http\Controllers\Admin;

use App\Models\ResumeDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\CentralLogics\Helpers;

class ResumeDetailController extends Controller
{
    function index(Request $request)
    {
        $key = explode(' ', $request['search']);
        $resumedetails = ResumeDetail::latest()
        ->when(isset($key) , function ($q) use($key){
            $q->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('title', 'like', "%{$value}%");
                }
            });
        })
        ->paginate(config('default_pagination'));
        return view('admin-views.resumedetail.index',compact('resumedetails'));
    }

    function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:100',
            'resume_type' => 'required',
            'date_range' => 'required',
            'name_address' => 'required',
            'details' => 'required|max:1000',
        ]);

        $resumedetail = new ResumeDetail();
        $resumedetail->resume_type = $request->resume_type;
        $resumedetail->title = $request->title[array_search('default', $request->lang)];
        $resumedetail->date_range = $request->date_range[array_search('default', $request->lang)];
        $resumedetail->name_address = $request->name_address[array_search('default', $request->lang)];
        $resumedetail->details = $request->details[array_search('default', $request->lang)];
        $resumedetail->save();

        Helpers::add_or_update_translations(request: $request, key_data:'title' , name_field:'title' , model_name: 'ResumeDetail' ,data_id: $resumedetail->id,data_value: $resumedetail->title);
        Helpers::add_or_update_translations(request: $request, key_data:'date_range' , name_field:'date_range' , model_name: 'ResumeDetail' ,data_id: $resumedetail->id,data_value: $resumedetail->date_range);
        Helpers::add_or_update_translations(request: $request, key_data:'name_address' , name_field:'name_address' , model_name: 'ResumeDetail' ,data_id: $resumedetail->id,data_value: $resumedetail->name_address);
        Helpers::add_or_update_translations(request: $request, key_data:'details' , name_field:'details' , model_name: 'ResumeDetail' ,data_id: $resumedetail->id,data_value: $resumedetail->details);

        Toastr::success(translate('messages.resumedetail_added_successfully'));

        return back();
    }

    public function edit($id)
    {
        $resumedetail = ResumeDetail::withoutGlobalScope('translate')->findOrFail($id);
        return view('admin-views.resumedetail.edit', compact('resumedetail'));
    }

    public function status(Request $request)
    {
        $resumedetail = ResumeDetail::find($request->id);
        $resumedetail->status = $request->status;
        $resumedetail->save();
        Toastr::success(translate('messages.resumedetail_status_updated'));
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|max:100',
            'resume_type' => 'required',
            'date_range' => 'required',
            'name_address' => 'required',
            'details' => 'required|max:1000',
        ]);

        $resumedetail = ResumeDetail::find($id);
        $resumedetail->resume_type = $request->resume_type;
        $resumedetail->title = $request->title[array_search('default', $request->lang)];
        $resumedetail->date_range = $request->date_range[array_search('default', $request->lang)];
        $resumedetail->name_address = $request->name_address[array_search('default', $request->lang)];
        $resumedetail->details = $request->details[array_search('default', $request->lang)];
        $resumedetail->save();

        Helpers::add_or_update_translations(request: $request, key_data:'title' , name_field:'title' , model_name: 'ResumeDetail' ,data_id: $resumedetail->id,data_value: $resumedetail->title);
        Helpers::add_or_update_translations(request: $request, key_data:'date_range' , name_field:'date_range' , model_name: 'ResumeDetail' ,data_id: $resumedetail->id,data_value: $resumedetail->date_range);
        Helpers::add_or_update_translations(request: $request, key_data:'name_address' , name_field:'name_address' , model_name: 'ResumeDetail' ,data_id: $resumedetail->id,data_value: $resumedetail->name_address);
        Helpers::add_or_update_translations(request: $request, key_data:'details' , name_field:'details' , model_name: 'ResumeDetail' ,data_id: $resumedetail->id,data_value: $resumedetail->details);

        Toastr::success(translate('messages.resumedetail_updated_successfully'));

        return back();
    }

    public function delete(Request $request)
    {
        $resumedetail = ResumeDetail::findOrFail($request->id);
        $resumedetail?->translations()?->delete();
        $resumedetail->delete();
        Toastr::success(translate('messages.resumedetail removed!'));
        return back();
    }

}
