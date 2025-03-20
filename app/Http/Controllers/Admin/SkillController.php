<?php

namespace App\Http\Controllers\Admin;

use App\Models\Skill;
use Illuminate\Http\Request;
use App\CentralLogics\Helpers;
use App\Exports\SkillExport;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;

class SkillController extends Controller
{
    function index(Request $request)
    {
        $key = explode(' ', $request['search']);
        $skills = Skill::latest()
        ->when(isset($key) , function ($q) use($key){
            $q->where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%");
                }
            });
        })
        ->paginate(config('default_pagination'));
        return view('admin-views.skill.index',compact('skills'));
    }

    function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:skills|max:100',
            'rate' => 'required|max:200',
            'image' => 'nullable|max:60000',
            'name.0' => 'required',
        ], [
            'name.required' => translate('messages.Name is required!'),
            'name.0.required'=>translate('default_name_is_required'),
        ]);

        $skill = new Skill();
        $skill->name = $request->name[array_search('default', $request->lang)];
        $skill->rate = $request->rate[array_search('default', $request->lang)];
        $skill->image = $request->has('image') ? Helpers::upload(dir:'skill/',format: 'png',image: $request->file('image')) : 'def.png';
        $skill->save();

        Helpers::add_or_update_translations(request: $request, key_data:'name' , name_field:'name' , model_name: 'Skill' ,data_id: $skill->id,data_value: $skill->name);
        Helpers::add_or_update_translations(request: $request, key_data:'rate' , name_field:'rate' , model_name: 'Skill' ,data_id: $skill->id,data_value: $skill->rate);

        Toastr::success(translate('messages.skill_added_successfully'));

        return back();
    }

    public function edit($id)
    {
        $skill = Skill ::withoutGlobalScope('translate')->findOrFail($id);
        return view('admin-views.skill.edit', compact('skill'));
    }

    public function status(Request $request)
    {
        $skill = Skill::find($request->id);
        $skill->status = $request->status;
        $skill->save();
        Toastr::success(translate('messages.skill_status_updated'));
        return back();
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:100|unique:skills,name,'.$id,
            'rate' => 'required|max:200',
            'image' => 'nullable|max:60000',
            'name.0' => 'required',
        ],[
            'name.0.required'=>translate('default_name_is_required'),
        ]);

        $skill = Skill::find($id);
        $skill->name = $request->name[array_search('default', $request->lang)];
        $skill->rate = $request->rate[array_search('default', $request->lang)];
        $skill->image = $request->has('image') ? Helpers::update(dir:'skill/', old_image:$skill->image,format: 'png', image:$request->file('image')) : $skill->image;
        $skill->save();

        Helpers::add_or_update_translations(request: $request, key_data:'name' , name_field:'name' , model_name: 'Skill' ,data_id: $skill->id,data_value: $skill->name);
        Helpers::add_or_update_translations(request: $request, key_data:'rate' , name_field:'rate' , model_name: 'Skill' ,data_id: $skill->id,data_value: $skill->rate);
        
        Toastr::success(translate('messages.skill_updated_successfully'));

        return back();
    }

    public function delete(Request $request)
    {
        $skill = Skill::findOrFail($request->id);
        $skill?->translations()?->delete();
        $skill->delete();
        Toastr::success(translate('messages.skill removed!'));
        return back();
    }

    public function export_skills(Request $request){
        try{
                $key = explode(' ', $request['search']);
                $skills = Skill::when(isset($key) , function ($q) use($key){
                    $q->where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('name', 'like', "%{$value}%");
                        }
                    });
                })
                ->orderBy('id','desc')->get();
                $data=[
                    'skills' =>$skills,
                    'search' =>$request['search'] ?? null,
                ];
                if($request->type == 'csv'){
                    return Excel::download(new SkillExport($data), 'Skills.csv');
                }
                return Excel::download(new SkillExport($data), 'Skills.xlsx');
            } catch(\Exception $e) {
                Toastr::error("line___{$e->getLine()}",$e->getMessage());
                info(["line___{$e->getLine()}",$e->getMessage()]);
                return back();
            }
    }
}
