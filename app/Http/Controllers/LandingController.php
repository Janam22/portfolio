<?php

namespace App\Http\Controllers;

use App\CentralLogics\Helpers;
use App\Models\Inquiry;
use App\Models\Service;
use App\Models\SocialMedia;
use App\Models\Blog;
use App\Models\Testimonial;
use App\Models\Project;
use App\Models\SystemSetting;
use App\Models\DataSetting;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\App;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {   
        $services = Service::Active()->get();
        $social_media = SocialMedia::Active()->get();
        $blogs = Blog::Active()->latest()->take(3)->get();
        $testimonials = Testimonial::Active()->latest()->get();
        $projects = Project::with('services')->Active()->latest()->get();
        $landing_data = Helpers::get_landing_data();
        return view('home', compact('landing_data', 'services', 'social_media', 'blogs', 'testimonials', 'projects'));
    }
    
    public function about(Request $request)
    {
        $services = Service::Active()->get();
        $social_media = SocialMedia::Active()->get();
        $testimonials = Testimonial::Active()->latest()->get();
        $landing_data = Helpers::get_landing_data();
        return view('about', compact('landing_data', 'services', 'social_media', 'testimonials'));
    }

    public function blog(Request $request)
    {
        $search = $request->search;
        $category = $request->query('category');
        $tag = $request->query('tag');
        $services = Service::Active()->get();
        $social_media = SocialMedia::Active()->get();
        $blogs = Blog::Active()
                ->when($search, function ($query, $search) {
                    $keywords = explode(' ', $search);
                    foreach ($keywords as $key) {
                        $query->where('blog_title', 'like', "%{$key}%");
                    }
                })
                ->when($category, function ($query, $category){
                    $query->where('category', $category);
                })
                ->when($tag, function ($query) use ($tag) {
                    $query->where('tags', 'like', "%{$tag}%");
                })
                ->paginate(5);
        $excluded_ids = $blogs->pluck('id');
        $recent_blogs = Blog::Active()
                    ->whereNotIn('id', $excluded_ids)
                    ->latest()
                    ->take(5)
                    ->get();
        $uniqueTags = $this->get_tags();
        $uniqueCategories = Blog::Active()
                    ->selectRaw('category, COUNT(*) as count')
                    ->groupBy('category')
                    ->get();
        $landing_data = Helpers::get_landing_data();
        return view('blog', compact('landing_data', 'services', 'social_media', 'blogs', 'recent_blogs', 'uniqueTags', 'uniqueCategories'));
    }
    
    public function blog_detail($slug)
    {
        $services = Service::Active()->get();
        $social_media = SocialMedia::Active()->get();
        $blog_detail = Blog::Active()->where('slug', $slug)->firstOrFail();
        $recent_blogs = Blog::Active()
                    ->latest()
                    ->take(5)
                    ->get();
        $uniqueTags = $this->get_tags();
        $uniqueCategories = Blog::Active()
                    ->selectRaw('category, COUNT(*) as count')
                    ->groupBy('category')
                    ->get();
        $landing_data = Helpers::get_landing_data();
        return view('blog-detail', compact('landing_data', 'services', 'social_media', 'blog_detail', 'recent_blogs', 'uniqueTags', 'uniqueCategories'));
    }

    private function get_tags()
    {
        $tags = Blog::Active()->pluck('tags')->toArray();
        $allTags = [];
        foreach ($tags as $tagString){
            $allTags = array_merge($allTags, explode(',', $tagString));
        }
        $uniqueTags = array_unique(array_map('trim', $allTags));
        $uniqueTags = array_slice($uniqueTags, 0, 15); 
        return $uniqueTags;
    }

    public function contact()
    {
        $services = Service::Active()->get();
        $social_media = SocialMedia::Active()->get();
        $landing_data = Helpers::get_landing_data();
        return view('contact', compact('landing_data', 'services', 'social_media'));
    }
    
    function inquiry_store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'subject' => 'required|max:200',
            'email' => 'required',
            'contact' => 'required',
            'message' => 'required',
        ]);

        $inquiry = new Inquiry();
        $inquiry->name = $request->name;
        $inquiry->subject = $request->subject;
        $inquiry->email = $request->email;
        $inquiry->contact = $request->contact;
        $inquiry->message = $request->message;
        if ($inquiry->save()) {
            Toastr::success(translate('messages.Thank_you_for_contacting_me._I_will_reach_you_shortly.'));
            return back();
        } else {
            Toastr::error(translate('messages.Something_went_wrong._Please_try_again_later.'));
            return back();
        }
    }

    public static function get_settings($name)
    {
        $data = DataSetting::where(['key' => $name])->first()?->value;
        return $data;
    }

    public function lang($local)
    {
        $direction = SystemSetting::where('key', 'site_direction')->first();
        $direction = $direction->value ?? 'ltr';
        $language = SystemSetting::where('key', 'system_language')->first();
        foreach (json_decode($language['value'], true) as $key => $data) {
            if ($data['code'] == $local) {
                $direction = isset($data['direction']) ? $data['direction'] : 'ltr';
            }
        }
        session()->forget('landing_language_settings');
        Helpers::landing_language_load();
        session()->put('landing_site_direction', $direction);
        session()->put('landing_local', $local);
        return redirect()->back();
    }

    public static function get_settings_localization($name,$lang)
    {
        $config = null;
        $data = DataSetting::withoutGlobalScope('translate')->with(['translations' => function ($query) use ($lang) {
            return $query->where('locale', $lang);
        }])->where(['key' => $name])->first();
        if($data && count($data->translations)>0){
            $data = $data->translations[0]['value'];
        }else{
            $data = $data ? $data->value: '';
        }
        return $data;
    }

}
