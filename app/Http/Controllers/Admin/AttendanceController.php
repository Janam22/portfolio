<?php

namespace App\Http\Controllers\Admin;

use App\Models\AttendanceLog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AttendanceLogListExport;

class AttendanceController extends Controller
{
    public function list(Request $request)
    {
        $show_limit =  $request->show_limit ?? null;
        $attendance_logs = $this->getAttendanceListData($request);
        if (isset($show_limit) && $show_limit > 0) {
            $attendance_logs = $attendance_logs->take($show_limit)->get();
            $perPage = config('default_pagination');
            $page =  $request?->page ?? 1;
            $offset = ($page - 1) * $perPage;
            $itemsForCurrentPage = $attendance_logs->slice($offset, $perPage);
            $attendance_logs = new \Illuminate\Pagination\LengthAwarePaginator(
                $itemsForCurrentPage,
                $attendance_logs->count(),
                $perPage,
                $page,
                options: ['path' => Paginator::resolveCurrentPath(), 'query' => request()->query()]
            );
        } else {
            $attendance_logs = $attendance_logs->paginate(config('default_pagination'));
        }
        return view('admin-views.attendance-log.list', compact('attendance_logs'));
    }
    
    private function getAttendanceListData($request)
    {
        $key = [];
        if ($request->search) {
            $key = explode(' ', $request['search']);
        }

        $from_date = null;
        $to_date = null;

        if ($request?->attendance_date) {
            list($from_date, $to_date) = explode(' - ', $request?->attendance_date);
            $from_date = Carbon::createFromFormat('m/d/Y', $from_date)->startOfDay();
            $to_date = Carbon::createFromFormat('m/d/Y', $to_date)->endOfDay();
        }

        $attendance_logs = AttendanceLog::with('employee')
            ->leftJoin('admins', 'admins.id', '=', 'attendance_logs.emp_id')
            ->select('attendance_logs.*', 'admins.f_name', 'admins.l_name') 
            ->when(count($key) > 0, function ($query) use ($key) {
                foreach ($key as $value) {
                    $query->orWhere('admins.f_name', 'like', "%{$value}%")
                        ->orWhere('admins.l_name', 'like', "%{$value}%");
                }
            })
            ->when(isset($request->attendance_date), function ($query) use ($from_date, $to_date) {
                $query->WhereBetween('attendance_logs.created_at', [$from_date, $to_date]);
            });

        return $attendance_logs;
    }

    public function check_in(Request $request)
    {        
        $request->validate([
            'ci_lat' => 'required',
            'ci_lon' => 'required',
        ]);
        $user_id = auth('admin')->user()->id;
        $attendance_log = [
            'emp_id' => $user_id,
            'checkin_time' => now(),
            'ci_lat' => $request->ci_lat,
            'ci_lon' => $request->ci_lon,
            'created_at' => now(),
            'updated_at' => now()
        ];
        DB::table('attendance_logs')->insert($attendance_log);
        return response()->json([
            'status' => 'success',
            'message' => translate('messages.checked_in_successful')
        ]);
    }

    public function check_out(Request $request)
    {
        $request->validate([
            'co_lat' => 'required',
            'co_lon' => 'required',
        ]);

        $user_id = auth('admin')->user()->id;    
        $today = Carbon::today(); // Get today's date

        // Find today's check-in record for the user
        $att = AttendanceLog::where('emp_id', $user_id)
            ->whereDate('checkin_time', $today) // Ensure check-in was today
            ->first();

        if (!$att) {
            return response()->json([
                'status' => 'error',
                'message' => translate('messages.no_checkin_found_for_today')
            ], 400);
        }

        $att->checkout_time = now();
        $att->co_lat = $request->co_lat;
        $att->co_lon = $request->co_lon;
        $att->save();
        return response()->json([
            'status' => 'success',
            'message' => translate('messages.checked_out_successful')
        ]);
    }

    public function export(Request $request)
    {
        $show_limit =  $request->show_limit ?? null;
        $attendance_logs = $this->getStaffAttendanceListData($request);
        if (isset($show_limit) && $show_limit > 0) {
            $attendance_logs = $attendance_logs->take($show_limit)->get();
        } else {
            $attendance_logs = $attendance_logs->get();
        }

        $data = [
            'attendance_logs' => $attendance_logs,
            'filter' => $request->filter ?? null,
            'show_limit' => $request->show_limit ?? null,
            'attendance_date' => $request?->attendance_date,
            'search' => $request->search ?? null,
        ];

        if ($request->type == 'excel') {
            return Excel::download(new AttendanceLogListExport($data), 'attendance_logs.xlsx');
        } else if ($request->type == 'csv') {
            return Excel::download(new AttendanceLogListExport($data), 'attendance_logs.csv');
        }
    }
    private function getStaffAttendanceListData($request)
    {
        $key = [];
        if ($request->search) {
            $key = explode(' ', $request['search']);
        }

        $from_date = null;
        $to_date = null;

        if ($request?->attendance_date) {
            list($from_date, $to_date) = explode(' - ', $request?->attendance_date);
            $from_date = Carbon::createFromFormat('m/d/Y', $from_date)->startOfDay();
            $to_date = Carbon::createFromFormat('m/d/Y', $to_date)->endOfDay();
        }

        $attendance_logs = AttendanceLog::with('employee')
            ->leftJoin('admins', 'admins.id', '=', 'attendance_logs.emp_id')
            ->select('attendance_logs.*', 'admins.f_name', 'admins.l_name') 
            ->when(count($key) > 0, function ($query) use ($key) {
                foreach ($key as $value) {
                    $query->orWhere('admins.f_name', 'like', "%{$value}%")
                        ->orWhere('admins.l_name', 'like', "%{$value}%");
                }
            })
            ->when(isset($request->attendance_date), function ($query) use ($from_date, $to_date) {
                $query->WhereBetween('attendance_logs.created_at', [$from_date, $to_date]);
            });

        return  $attendance_logs;
    }

}
