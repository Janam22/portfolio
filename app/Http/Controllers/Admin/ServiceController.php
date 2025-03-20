<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Exports\ServiceExport;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;

class ServiceController extends Controller
{
    function index(Request $request)
    {
        $key = explode(' ', $request['search']);
        $services = Service::latest()
        ->when(isset($key) , function ($q) use($key){
            $q->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
        })
        ->paginate(config('default_pagination'));
        return view('admin-views.service.index',compact('services'));
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:services|max:100',
            'description' => 'required|max:200',
            'image' => 'nullable|max:60000',
            'name.0' => 'required',

        ], [
            'name.required' => translate('messages.Name is required!'),
            'name.0.required'=>translate('default_name_is_required'),
        ]);

        $service = new Service();
        $service->name = $request->name[array_search('default', $request->lang)];
        $service->description = $request->description[array_search('default', $request->lang)];
        $service->image = $request->has('image') ? Helpers::upload(dir:'service/',format: 'png',image: $request->file('image')) : 'def.png';
        $service->save();

        Helpers::add_or_update_translations(request: $request, key_data:'name' , name_field:'name' , model_name: 'Service' ,data_id: $service->id,data_value: $service->name);
        Helpers::add_or_update_translations(request: $request, key_data:'description' , name_field:'description' , model_name: 'Service' ,data_id: $service->id,data_value: $service->description);

        Toastr::success(translate('messages.service_added_successfully'));

        return back();
    }

    public function edit($id)
    {
        $service = Service::withoutGlobalScope('translate')->findOrFail($id);
        return view('admin-views.service.edit', compact('service'));
    }

    public function status(Request $request)
    {
        $service = Service::find($request->id);
        $service->status = $request->status;
        $service->save();
        Toastr::success(translate('messages.service_status_updated'));
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100|unique:services,name,'.$id,
            'description' => 'required|max:200',
            'image' => 'nullable|max:60000',
            'name.0' => 'required',
        ],[
            'name.0.required'=>translate('default_name_is_required'),
        ]);

        $service = Service::find($id);
        $slug = Str::slug($request->name[array_search('default', $request->lang)]);
        $service->slug = $service->slug? $service->slug :"{$slug}{$service->id}";
        $service->name = $request->name[array_search('default', $request->lang)];
        $service->description = $request->description[array_search('default', $request->lang)];
        $service->image = $request->has('image') ? Helpers::update(dir:'service/', old_image:$service->image,format: 'png', image:$request->file('image')) : $service->image;
        $service->save();
        
        Helpers::add_or_update_translations(request: $request, key_data:'name' , name_field:'name' , model_name: 'Service' ,data_id: $service->id,data_value: $service->name);
        Helpers::add_or_update_translations(request: $request, key_data:'description' , name_field:'description' , model_name: 'Service' ,data_id: $service->id,data_value: $service->description);

        Toastr::success(translate('messages.service_updated_successfully'));

        return back();
    }

    public function delete(Request $request)
    {
        $service = Service::findOrFail($request->id);
        $service?->translations()?->delete();
        $service->delete();
        Toastr::success(translate('messages.service removed!'));
        return back();
    }

    public function update_priority(Service $service, Request $request)
    {
        $priority = $request->priority??0;
        $service->priority = $priority;
        $service->save();
        Toastr::success(translate('messages.service_priority_updated successfully'));
        return back();
    }

    public function export_services(Request $request){
        try{
                $key = explode(' ', $request['search']);
                $services = Service::when(isset($key) , function ($q) use($key){
                    $q->where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('name', 'like', "%{$value}%");
                        }
                    });
                })
                ->orderBy('id','desc')->get();
                $data=[
                    'services' =>$services,
                    'search' =>$request['search'] ?? null,
                ];
                if($request->type == 'csv'){
                    return Excel::download(new ServiceExport($data), 'Services.csv');
                }
                return Excel::download(new ServiceExport($data), 'Services.xlsx');
            } catch(\Exception $e) {
                Toastr::error("line___{$e->getLine()}",$e->getMessage());
                info(["line___{$e->getLine()}",$e->getMessage()]);
                return back();
            }
    }
}
