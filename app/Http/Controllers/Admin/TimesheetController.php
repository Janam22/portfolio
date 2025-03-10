<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TimesheetListExport;
use App\Models\Timesheet;
use Illuminate\Pagination\LengthAwarePaginator;
use App\CentralLogics\Helpers;
use Illuminate\Support\Facades\Storage;

class TimesheetController extends Controller
{
    public function new()
    {
        return view('admin-views.timesheet.new');
    }

    public function store(Request $request)
    {
        $request->validate([
            'details' => 'required',
            'supporting_image' => 'required|array|max:3',
        ]);

        $user_id = auth('admin')->user()->id;
        
        $images = [];
        $total_file =  (is_array($request->supporting_image) ? count($request->supporting_image)  : 0);

        if ($total_file>3) {
            Toastr::error(translate('messages.supporting_images_must_not_have_more_than_3_item'));
            return back();
        }

        if (!empty($request->file('supporting_image'))) {
            $img_names = [];
            foreach ($request->supporting_image as $img) {
                $image_name = Helpers::upload('timesheet/', 'png', $img);
                $img_names[] = ['img' => $image_name, 'storage' => Helpers::getDisk()];
            }
            $images = $img_names;
        }

        $timesheet = new Timesheet();
        $timesheet->emp_id = $user_id;
        $timesheet->details = $request->details;
        $timesheet->supporting_images = json_encode($images);
        $timesheet->save();

        Toastr::success(translate('messages.timesheet_added_successfully'));
        return redirect()->route('admin.timesheet.my-timesheets');
    }

    public function list(Request $request)
    {        
        $show_limit = $request->show_limit ?? null;
        $timesheet_logs = $this->getTimesheetListData($request);
    
        $perPage = $show_limit && $show_limit > 0 ? $show_limit : config('default_pagination');
    
        // Use Laravel's built-in pagination
        $timesheet_logs = $timesheet_logs->paginate($perPage);
    
        return view('admin-views.timesheet.list', compact('timesheet_logs'));
    }
    
    private function getTimesheetListData($request)
    {
        $key = [];
        if ($request->search) {
            $key = explode(' ', $request['search']);
        }

        $from_date = null;
        $to_date = null;

        if ($request?->timesheet_date) {
            list($from_date, $to_date) = explode(' - ', $request?->timesheet_date);
            $from_date = Carbon::createFromFormat('m/d/Y', $from_date)->startOfDay();
            $to_date = Carbon::createFromFormat('m/d/Y', $to_date)->endOfDay();
        }

        $timesheet_logs = Timesheet::with('employee')
            ->leftJoin('admins', 'admins.id', '=', 'timesheets.emp_id')
            ->select('timesheets.*', 'admins.f_name', 'admins.l_name') 
            ->orderby('created_at', 'desc')
            ->when(count($key) > 0, function ($query) use ($key) {
                foreach ($key as $value) {
                    $query->orWhere('admins.f_name', 'like', "%{$value}%")
                        ->orWhere('admins.l_name', 'like', "%{$value}%");
                }
            })
            ->when(isset($request->timesheet_date), function ($query) use ($from_date, $to_date) {
                $query->WhereBetween('timesheets.created_at', [$from_date, $to_date]);
            });

        return $timesheet_logs;
    }

    public function my_timesheet(Request $request)
    {        
        $show_limit =  $request->show_limit ?? null;
        $my_timesheet_logs = $this->getMyTimesheetListData($request);
        if (isset($show_limit) && $show_limit > 0) {
            $my_timesheet_logs = $my_timesheet_logs->take($show_limit)->get();
            $perPage = config('default_pagination');
            $page =  $request?->page ?? 1;
            $offset = ($page - 1) * $perPage;
            $itemsForCurrentPage = $my_timesheet_logs->slice($offset, $perPage);
            $attendance_logs = new LengthAwarePaginator(
                $itemsForCurrentPage,
                $my_timesheet_logs->count(),
                $perPage,
                $page,
                options: ['path' => Paginator::resolveCurrentPath(), 'query' => request()->query()]
            );
        } else {
            $my_timesheet_logs = $my_timesheet_logs->paginate(config('default_pagination'));
        }
        return view('admin-views.timesheet.my_timesheet_list', compact('my_timesheet_logs'));
    }
    
    private function getMyTimesheetListData($request)
    {
        $from_date = null;
        $to_date = null;

        if ($request?->timesheet_date) {
            list($from_date, $to_date) = explode(' - ', $request?->timesheet_date);
            $from_date = Carbon::createFromFormat('m/d/Y', $from_date)->startOfDay();
            $to_date = Carbon::createFromFormat('m/d/Y', $to_date)->endOfDay();
        }

        $user_id = auth('admin')->user()->id;
        $timesheet_logs = Timesheet::with('employee')
            ->where('emp_id', $user_id)
            ->orderby('created_at', 'desc')
            ->when(isset($request->timesheet_date), function ($query) use ($from_date, $to_date) {
                $query->WhereBetween('timesheets.created_at', [$from_date, $to_date]);
            });

        return $timesheet_logs;
    }
    
    public function details(Request $request, $id)
    {
        $timesheet_details = Timesheet::with('employee')
            ->leftJoin('admins', 'admins.id', '=', 'timesheets.emp_id')
            ->select('timesheets.*', 'admins.f_name', 'admins.l_name') 
            ->where('timesheets.id', $id)
            ->first();

        return view('admin-views.timesheet.details', compact('timesheet_details'));
    }

    public function export(Request $request)
    {
        $show_limit =  $request->show_limit ?? null;
        $timesheets = $this->getTimesheetListData($request);
        if (isset($show_limit) && $show_limit > 0) {
            $timesheets = $timesheets->take($show_limit)->get();
        } else {
            $timesheets = $timesheets->get();
        }

        $data = [
            'timesheets' => $timesheets,
            'filter' => $request->filter ?? null,
            'show_limit' => $request->show_limit ?? null,
            'timesheet_date' => $request?->timesheet_date,
            'search' => $request->search ?? null,
        ];

        if ($request->type == 'excel') {
            return Excel::download(new TimesheetListExport($data), 'timesheets.xlsx');
        } else if ($request->type == 'csv') {
            return Excel::download(new TimesheetListExport($data), 'timesheets.csv');
        }
    }
    
    public function download($file_name,$storage='public')
    {    
        return Storage::disk($storage)->download(base64_decode($file_name));
    }

}
