<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TravelOrder;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TravelOrderRequestListExport;
use Illuminate\Pagination\LengthAwarePaginator;

class TravelOrderController extends Controller
{
    public function request()
    {
        return view('admin-views.travel-order.request');
    }

    public function store(Request $request)
    {
        $request->validate([
            'from_date' => 'required',
            'to_date' => 'required',
            'travel_place' => 'required',
            'travel_mode' => 'required',
        ]);
        $user_id = auth('admin')->user()->id;

        $travel_order = new TravelOrder();
        $travel_order->emp_id = $user_id;
        $travel_order->from_date = $request->from_date;
        $travel_order->to_date = $request->to_date;
        $travel_order->travel_place = $request->travel_place;
        $travel_order->travel_mode = $request->travel_mode;
        $travel_order->save();

        Toastr::success(translate('messages.travel_order_requested_successfully'));
        return redirect()->route('admin.travel-order-request.my-requests');
    }

    public function list(Request $request)
    {        
        $show_limit = $request->show_limit ?? null;
        $travel_order_request_logs = $this->getTravelOrderListData($request);
        $perPage = $show_limit && $show_limit > 0 ? $show_limit : config('default_pagination');
    
        // Using Laravel's built-in pagination
        $travel_order_request_logs = $travel_order_request_logs->paginate($perPage);
    
        return view('admin-views.travel-order.list', compact('travel_order_request_logs'));
    }
    
    private function getTravelOrderListData($request)
    {
        $key = [];
        if ($request->search) {
            $key = explode(' ', $request['search']);
        }

        $from_date = null;
        $to_date = null;

        if ($request?->travel_order_request_date) {
            list($from_date, $to_date) = explode(' - ', $request?->travel_order_request_date);
            $from_date = Carbon::createFromFormat('m/d/Y', $from_date)->startOfDay();
            $to_date = Carbon::createFromFormat('m/d/Y', $to_date)->endOfDay();
        }

        $travel_order_request_logs = TravelOrder::with('employee')
            ->leftJoin('admins', 'admins.id', '=', 'travel_orders.emp_id')
            ->select('travel_orders.*', 'admins.f_name', 'admins.l_name') 
            ->orderby('created_at', 'desc')
            ->when(count($key) > 0, function ($query) use ($key) {
                foreach ($key as $value) {
                    $query->orWhere('admins.f_name', 'like', "%{$value}%")
                        ->orWhere('admins.l_name', 'like', "%{$value}%");
                }
            })
            ->when(isset($request->travel_order_request_date), function ($query) use ($from_date, $to_date) {
                $query->WhereBetween('travel_orders.created_at', [$from_date, $to_date]);
            });

        return $travel_order_request_logs;
    }

    public function my_request(Request $request)
    {        
        $show_limit =  $request->show_limit ?? null;
        $my_travel_order_request_logs = $this->getMyTravelOrderListData($request);
        if (isset($show_limit) && $show_limit > 0) {
            $my_travel_order_request_logs = $my_travel_order_request_logs->take($show_limit)->get();
            $perPage = config('default_pagination');
            $page =  $request?->page ?? 1;
            $offset = ($page - 1) * $perPage;
            $itemsForCurrentPage = $my_travel_order_request_logs->slice($offset, $perPage);
            $attendance_logs = new LengthAwarePaginator(
                $itemsForCurrentPage,
                $my_travel_order_request_logs->count(),
                $perPage,
                $page,
                options: ['path' => Paginator::resolveCurrentPath(), 'query' => request()->query()]
            );
        } else {
            $my_travel_order_request_logs = $my_travel_order_request_logs->paginate(config('default_pagination'));
        }
        return view('admin-views.travel-order.my_request_list', compact('my_travel_order_request_logs'));
    }
    
    private function getMyTravelOrderListData($request)
    {
        $from_date = null;
        $to_date = null;

        if ($request?->travel_order_request_date) {
            list($from_date, $to_date) = explode(' - ', $request?->travel_order_request_date);
            $from_date = Carbon::createFromFormat('m/d/Y', $from_date)->startOfDay();
            $to_date = Carbon::createFromFormat('m/d/Y', $to_date)->endOfDay();
        }

        $user_id = auth('admin')->user()->id;
        $travel_order_request_logs = TravelOrder::with('employee')
            ->where('emp_id', $user_id)
            ->orderby('created_at', 'desc')
            ->when(isset($request->travel_order_request_date), function ($query) use ($from_date, $to_date) {
                $query->WhereBetween('travel_orders.created_at', [$from_date, $to_date]);
            });

        return $travel_order_request_logs;
    }

    public function status(Request $request)
    {
        $travel_order_request = TravelOrder::find($request->id);
        $travel_order_request->travel_order_status = $request->travel_order_status;
        $travel_order_request->save();

        Toastr::success(translate('messages.Travel_order_request_updated_successfully'));
        return back();
    }

    public function export(Request $request)
    {
        $show_limit =  $request->show_limit ?? null;
        $travel_order_requests = $this->getTravelOrderRequestListData($request);
        if (isset($show_limit) && $show_limit > 0) {
            $travel_order_requests = $travel_order_requests->take($show_limit)->get();
        } else {
            $travel_order_requests = $travel_order_requests->get();
        }

        $data = [
            'travel_order_requests' => $travel_order_requests,
            'filter' => $request->filter ?? null,
            'show_limit' => $request->show_limit ?? null,
            'travel_order_request_date' => $request?->travel_order_request_date,
            'search' => $request->search ?? null,
        ];

        if ($request->type == 'excel') {
            return Excel::download(new TravelOrderRequestListExport($data), 'travel_order_requests.xlsx');
        } else if ($request->type == 'csv') {
            return Excel::download(new TravelOrderRequestListExport($data), 'travel_order_requests.csv');
        }
    }
    private function getTravelOrderRequestListData($request)
    {
        $key = [];
        if ($request->search) {
            $key = explode(' ', $request['search']);
        }

        $from_date = null;
        $to_date = null;

        if ($request?->travel_order_request_date) {
            list($from_date, $to_date) = explode(' - ', $request?->travel_order_request_date);
            $from_date = Carbon::createFromFormat('m/d/Y', $from_date)->startOfDay();
            $to_date = Carbon::createFromFormat('m/d/Y', $to_date)->endOfDay();
        }

        $travel_order_requests = TravelOrder::with('employee')
            ->leftJoin('admins', 'admins.id', '=', 'travel_orders.emp_id')
            ->select('travel_orders.*', 'admins.f_name', 'admins.l_name') 
            ->orderby('created_at', 'desc')
            ->when(count($key) > 0, function ($query) use ($key) {
                foreach ($key as $value) {
                    $query->orWhere('admins.f_name', 'like', "%{$value}%")
                        ->orWhere('admins.l_name', 'like', "%{$value}%");
                }
            })
            ->when(isset($request->travel_order_request_date), function ($query) use ($from_date, $to_date) {
                $query->WhereBetween('travel_orders.created_at', [$from_date, $to_date]);
            });

        return  $travel_order_requests;
    }

}
