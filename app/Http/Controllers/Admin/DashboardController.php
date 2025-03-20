<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Inquiry;
use App\Models\Service;
use App\Models\Project;
use App\Models\Blog;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {            
        $total_inquiries = Inquiry::count();
        $total_services = Service::count();
        $total_projects = Project::count();
        $total_blogs = Blog::count();

        return view('admin-views.dashboard', compact('total_inquiries', 'total_services', 'total_projects', 'total_blogs'));
    }

}
