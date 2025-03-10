<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\LeaveRequest;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LeaveRequestListExport;
use Illuminate\Pagination\LengthAwarePaginator;

class LeaveController extends Controller
{
    public function request()
    {
        return view('admin-views.leave.request');
    }

    public function store(Request $request)
    {
        $request->validate([
            'leave_type' => 'required',
            'from_date' => 'required',
            'to_date' => 'required',
            'subject' => 'required',
            'reason' => 'required',
        ]);
        $user_id = auth('admin')->user()->id;

        $leave_request = new LeaveRequest();
        $leave_request->emp_id = $user_id;
        $leave_request->leave_type = $request->leave_type;
        $leave_request->from_date = $request->from_date;
        $leave_request->to_date = $request->to_date;
        $leave_request->subject = $request->subject;
        $leave_request->reason_description = $request->reason;
        $leave_request->save();

        Toastr::success(translate('messages.leave_requested_successfully'));
        return redirect()->route('admin.leave-request.my-requests');
    }

    public function list(Request $request)
    {        
        $show_limit = $request->show_limit ?? null;
        $leave_request_logs = $this->getLeaveListData($request);
    
        $perPage = $show_limit && $show_limit > 0 ? $show_limit : config('default_pagination');
    
        // Use Laravel's built-in pagination
        $leave_request_logs = $leave_request_logs->paginate($perPage);
    
        return view('admin-views.leave.list', compact('leave_request_logs'));
    }
    
    private function getLeaveListData($request)
    {
        $key = [];
        if ($request->search) {
            $key = explode(' ', $request['search']);
        }

        $from_date = null;
        $to_date = null;

        if ($request?->leave_request_date) {
            list($from_date, $to_date) = explode(' - ', $request?->leave_request_date);
            $from_date = Carbon::createFromFormat('m/d/Y', $from_date)->startOfDay();
            $to_date = Carbon::createFromFormat('m/d/Y', $to_date)->endOfDay();
        }

        $leave_request_logs = LeaveRequest::with('employee')
            ->leftJoin('admins', 'admins.id', '=', 'leave_requests.emp_id')
            ->select('leave_requests.*', 'admins.f_name', 'admins.l_name') 
            ->orderby('created_at', 'desc')
            ->when(count($key) > 0, function ($query) use ($key) {
                foreach ($key as $value) {
                    $query->orWhere('admins.f_name', 'like', "%{$value}%")
                        ->orWhere('admins.l_name', 'like', "%{$value}%");
                }
            })
            ->when(isset($request->leave_request_date), function ($query) use ($from_date, $to_date) {
                $query->WhereBetween('leave_requests.created_at', [$from_date, $to_date]);
            });

        return $leave_request_logs;
    }

    public function my_request(Request $request)
    {        
        $show_limit =  $request->show_limit ?? null;
        $my_leave_request_logs = $this->getMyLeaveListData($request);
        if (isset($show_limit) && $show_limit > 0) {
            $my_leave_request_logs = $my_leave_request_logs->take($show_limit)->get();
            $perPage = config('default_pagination');
            $page =  $request?->page ?? 1;
            $offset = ($page - 1) * $perPage;
            $itemsForCurrentPage = $my_leave_request_logs->slice($offset, $perPage);
            $attendance_logs = new LengthAwarePaginator(
                $itemsForCurrentPage,
                $my_leave_request_logs->count(),
                $perPage,
                $page,
                options: ['path' => Paginator::resolveCurrentPath(), 'query' => request()->query()]
            );
        } else {
            $my_leave_request_logs = $my_leave_request_logs->paginate(config('default_pagination'));
        }
        return view('admin-views.leave.my_request_list', compact('my_leave_request_logs'));
    }
    
    private function getMyLeaveListData($request)
    {
        $from_date = null;
        $to_date = null;

        if ($request?->leave_request_date) {
            list($from_date, $to_date) = explode(' - ', $request?->leave_request_date);
            $from_date = Carbon::createFromFormat('m/d/Y', $from_date)->startOfDay();
            $to_date = Carbon::createFromFormat('m/d/Y', $to_date)->endOfDay();
        }

        $user_id = auth('admin')->user()->id;
        $leave_request_logs = LeaveRequest::with('employee')
            ->where('emp_id', $user_id)
            ->orderby('created_at', 'desc')
            ->when(isset($request->leave_request_date), function ($query) use ($from_date, $to_date) {
                $query->WhereBetween('leave_requests.created_at', [$from_date, $to_date]);
            });

        return $leave_request_logs;
    }

    public function status(Request $request)
    {
        $leave_request = LeaveRequest::find($request->id);
        $leave_request->leave_status = $request->leave_status;
        $leave_request->save();

        Toastr::success(translate('messages.Leave_request_updated_successfully'));
        return back();
    }

    public function export(Request $request)
    {
        $show_limit =  $request->show_limit ?? null;
        $leave_requests = $this->getLeaveRequestListData($request);
        if (isset($show_limit) && $show_limit > 0) {
            $leave_requests = $leave_requests->take($show_limit)->get();
        } else {
            $leave_requests = $leave_requests->get();
        }

        $data = [
            'leave_requests' => $leave_requests,
            'filter' => $request->filter ?? null,
            'show_limit' => $request->show_limit ?? null,
            'leave_request_date' => $request?->leave_request_date,
            'search' => $request->search ?? null,
        ];

        if ($request->type == 'excel') {
            return Excel::download(new LeaveRequestListExport($data), 'leave_requests.xlsx');
        } else if ($request->type == 'csv') {
            return Excel::download(new LeaveRequestListExport($data), 'leave_requests.csv');
        }
    }
    private function getLeaveRequestListData($request)
    {
        $key = [];
        if ($request->search) {
            $key = explode(' ', $request['search']);
        }

        $from_date = null;
        $to_date = null;

        if ($request?->leave_request_date) {
            list($from_date, $to_date) = explode(' - ', $request?->leave_request_date);
            $from_date = Carbon::createFromFormat('m/d/Y', $from_date)->startOfDay();
            $to_date = Carbon::createFromFormat('m/d/Y', $to_date)->endOfDay();
        }

        $leave_requests = LeaveRequest::with('employee')
            ->leftJoin('admins', 'admins.id', '=', 'leave_requests.emp_id')
            ->select('leave_requests.*', 'admins.f_name', 'admins.l_name') 
            ->orderby('created_at', 'desc')
            ->when(count($key) > 0, function ($query) use ($key) {
                foreach ($key as $value) {
                    $query->orWhere('admins.f_name', 'like', "%{$value}%")
                        ->orWhere('admins.l_name', 'like', "%{$value}%");
                }
            })
            ->when(isset($request->leave_request_date), function ($query) use ($from_date, $to_date) {
                $query->WhereBetween('leave_requests.created_at', [$from_date, $to_date]);
            });

        return  $leave_requests;
    }

}
