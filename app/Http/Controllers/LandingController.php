<?php

namespace App\Http\Controllers;

use App\CentralLogics\Helpers;
use App\Models\Inquiry;
use App\Models\Service;
use Illuminate\Http\Request;
use Brian2694\Toastr\Facades\Toastr;

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {   
        $services = Service::Active()->get();
        $landing_data = Helpers::get_landing_data();
        return view('home', compact('landing_data', 'services'));
    }
    
    public function about()
    {
        $services = Service::Active()->get();
        $landing_data = Helpers::get_landing_data();
        return view('about', compact('landing_data', 'services'));
    }

    public function blog()
    {
        $services = Service::Active()->get();
        $landing_data = Helpers::get_landing_data();
        return view('blog', compact('landing_data', 'services'));
    }
    
    public function blog_detail()
    {
        $services = Service::Active()->get();
        $landing_data = Helpers::get_landing_data();
        return view('blog-detail', compact('landing_data', 'services'));
    }

    public function contact()
    {
        $services = Service::Active()->get();
        $landing_data = Helpers::get_landing_data();
        return view('contact', compact('landing_data', 'services'));
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

}
