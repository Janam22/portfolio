<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use App\Models\Service;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Exports\ProjectExport;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;

class ProjectController extends Controller
{
    function index(Request $request)
    {
        $services = Service::Active()->get();
        $key = explode(' ', $request['search']);
        $projects = Project::latest()
        ->when(isset($key) , function ($q) use($key){
            $q->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
        })
        ->paginate(config('default_pagination'));
        return view('admin-views.project.index',compact('projects', 'services'));
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:projects|max:100',
            'service_id' => 'required',
            'description' => 'required|max:200',
            'image' => 'nullable|max:60000',
            'name.0' => 'required',
        ], [
            'name.required' => translate('messages.Name is required!'),
            'name.0.required'=>translate('default_name_is_required'),
        ]);

        $project = new Project();
        $project->service_id = $request->service_id;
        $project->name = $request->name[array_search('default', $request->lang)];
        $project->description = $request->description[array_search('default', $request->lang)];
        $project->image = $request->has('image') ? Helpers::upload(dir:'project/',format: 'png',image: $request->file('image')) : 'def.png';
        $project->link = $request->link;
        $project->save();

        Helpers::add_or_update_translations(request: $request, key_data:'name' , name_field:'name' , model_name: 'Project' ,data_id: $project->id,data_value: $project->name);
        Helpers::add_or_update_translations(request: $request, key_data:'description' , name_field:'description' , model_name: 'Project' ,data_id: $project->id,data_value: $project->description);

        Toastr::success(translate('messages.project_added_successfully'));

        return back();
    }

    public function edit($id)
    {
        $services = Service::Active()->get();
        $project = Project::withoutGlobalScope('translate')->findOrFail($id);
        return view('admin-views.project.edit', compact('project', 'services'));
    }

    public function status(Request $request)
    {
        $project = Project::find($request->id);
        $project->status = $request->status;
        $project->save();
        Toastr::success(translate('messages.project_status_updated'));
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100|unique:projects,name,'.$id,
            'service_id' => 'required',
            'description' => 'required|max:200',
            'image' => 'nullable|max:60000',
            'name.0' => 'required',
        ],[
            'name.0.required'=>translate('default_name_is_required'),
        ]);

        $project = Project::find($id);
        $project->service_id = $request->service_id;
        $slug = Str::slug($request->name[array_search('default', $request->lang)]);
        $project->slug = $project->slug? $project->slug :"{$slug}{$project->id}";
        $project->name = $request->name[array_search('default', $request->lang)];
        $project->description = $request->description[array_search('default', $request->lang)];
        $project->image = $request->has('image') ? Helpers::update(dir:'project/', old_image:$project->image,format: 'png', image:$request->file('image')) : $project->image;
        $project->link = $request->link;
        $project->save();

        Helpers::add_or_update_translations(request: $request, key_data:'name' , name_field:'name' , model_name: 'Project' ,data_id: $project->id,data_value: $project->name);
        Helpers::add_or_update_translations(request: $request, key_data:'description' , name_field:'description' , model_name: 'Project' ,data_id: $project->id,data_value: $project->description);

        Toastr::success(translate('messages.project_updated_successfully'));

        return back();
    }

    public function delete(Request $request)
    {
        $project = Project::findOrFail($request->id);
        $project?->translations()?->delete();
        $project->delete();
        Toastr::success(translate('messages.Project removed!'));
        return back();
    }

    public function update_priority(Project $project, Request $request)
    {
        $priority = $request->priority??0;
        $project->priority = $priority;
        $project->save();
        Toastr::success(translate('messages.project_priority_updated successfully'));
        return back();
    }

    public function export_projects(Request $request){
        try{
                $key = explode(' ', $request['search']);
                $projects = Project::when(isset($key) , function ($q) use($key){
                    $q->where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('name', 'like', "%{$value}%");
                        }
                    });
                })
                ->orderBy('id','desc')->get();
                $data=[
                    'projects' =>$projects,
                    'search' =>$request['search'] ?? null,
                ];
                if($request->type == 'csv'){
                    return Excel::download(new ProjectExport($data), 'Projects.csv');
                }
                return Excel::download(new ProjectExport($data), 'Projects.xlsx');
            } catch(\Exception $e) {
                Toastr::error("line___{$e->getLine()}",$e->getMessage());
                info(["line___{$e->getLine()}",$e->getMessage()]);
                return back();
            }
    }
}
