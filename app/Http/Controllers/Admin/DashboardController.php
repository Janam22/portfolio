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
    
        // Check if user has checked in today
        $hasCheckedIn = DB::table('attendance_logs')
            ->where('emp_id', $user_id)
            ->whereDate('checkin_time', $today)
            ->exists();
    
        // Check if user has checked in today
        $hasCheckedOut = DB::table('attendance_logs')
            ->where('emp_id', $user_id)
            ->whereDate('checkout_time', $today)
            ->exists();

        return view('admin-views.dashboard', compact('hasCheckedIn', 'hasCheckedOut'));
    }

}
