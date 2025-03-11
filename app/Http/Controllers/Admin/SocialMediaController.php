<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;

class SocialMediaController extends Controller
{
    public function index()
    {
        return view('admin-views.system-settings.social-media');
    }

    public function store(Request $request)
    {
        try {
            SocialMedia::updateOrInsert([
                'name' => $request->get('name'),
            ], [
                'name' => $request->get('name'),
                'link' => $request->get('link'),
            ]);

            return response()->json([
                'success' => 1,
            ]);

        } catch (\Exception $exception) {
            return response()->json([
                'error' => 1,
            ]);
        }
    }

    public function show($socialMedia)
    {
        $data = SocialMedia::where('id', $socialMedia)->first();
        return response()->json($data);
    }

    public function edit(SocialMedia $socialMedia)
    {
        return response()->json($socialMedia);
    }

    public function update(Request $request, $socialMedia)
    {
        $social_media = SocialMedia::find($socialMedia);
        $social_media->name = $request->name;
        $social_media->link = $request->link;
        $social_media->save();
        return response()->json();
    }

    public function fetch(Request $request)
    {
        if ($request->ajax()) {
            $data = SocialMedia::orderBy('id', 'desc')->get()
            ->map(function ($data) {
                return [
                    'id' => $data->id,
                    'name' => translate($data->name),
                    'link' => $data->link,
                    'status' => $data->status,
                ];
            });

            return response()->json($data);
        }
    }

    public function social_media_status_update(Request $request)
    {
        $data=SocialMedia::find($request?->id);
        $data->status =  $data->status ? 0 :1;
        $data?->save();
        if($data->status == 1){
            Toastr::success(Str::title($data->name).' '.translate('messages.is_Enabled!'));
        } else{
            Toastr::warning(Str::title($data->name).' '.translate('messages.is_Disabled!'));
        }
        return back();
    }

}
