<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {    
        $user_id = auth('admin')->user()->id;
        $today = Carbon::today(); // Get today's date

        return view('admin-views.dashboard');
    }

}
