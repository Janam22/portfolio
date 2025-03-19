<?php

namespace App\Http\Controllers\Admin;

use App\Models\Inquiry;
use Illuminate\Http\Request;
use App\Exports\InquiryExport;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;

class InquiryController extends Controller
{
    public function list(Request $request)
    {        
        $show_limit = $request->show_limit ?? null;
        $inquiry_lists = $this->getInquiryData($request);
    
        $perPage = $show_limit && $show_limit > 0 ? $show_limit : config('default_pagination');
    
        // Use Laravel's built-in pagination
        $inquiry_lists = $inquiry_lists->paginate($perPage);
    
        return view('admin-views.inquiry.list', compact('inquiry_lists'));
    }
    
    private function getInquiryData($request)
    {
        $key = [];
        if ($request->search) {
            $key = explode(' ', $request['search']);
        }

        $from_date = null;
        $to_date = null;

        if ($request?->inquiry_date) {
            list($from_date, $to_date) = explode(' - ', $request?->inquiry_date);
            $from_date = Carbon::createFromFormat('m/d/Y', $from_date)->startOfDay();
            $to_date = Carbon::createFromFormat('m/d/Y', $to_date)->endOfDay();
        }

        $inquiry_lists = Inquiry::orderby('created_at', 'desc')
            ->when(count($key) > 0, function ($query) use ($key) {
                foreach ($key as $value) {
                    $query->orWhere('subject', 'like', "%{$value}%");
                }
            })
            ->when(isset($request->inquiry_date), function ($query) use ($from_date, $to_date) {
                $query->WhereBetween('created_at', [$from_date, $to_date]);
            });

        return $inquiry_lists;
    }

    public function delete(Request $request)
    {
        $inquiry = Inquiry::findOrFail($request->id);
        $inquiry?->translations()?->delete();
        $inquiry->delete();
        Toastr::success(translate('messages.inquiry removed!'));
        return back();
    }

    public function export_inquiries(Request $request){
        try{
                $key = explode(' ', $request['search']);
                $inquiries = Inquiry::when(isset($key) , function ($q) use($key){
                    $q->where(function ($q) use ($key) {
                        foreach ($key as $value) {
                            $q->orWhere('subject', 'like', "%{$value}%");
                        }
                    });
                })
                ->orderBy('id','desc')->get();
                $data=[
                    'inquiries' =>$inquiries,
                    'search' =>$request['search'] ?? null,
                ];
                if($request->type == 'csv'){
                    return Excel::download(new InquiryExport($data), 'Inquiries.csv');
                }
                return Excel::download(new InquiryExport($data), 'Inquiries.xlsx');
            } catch(\Exception $e) {
                Toastr::error("line___{$e->getLine()}",$e->getMessage());
                info(["line___{$e->getLine()}",$e->getMessage()]);
                return back();
            }
    }
}
