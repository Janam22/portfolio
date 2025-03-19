<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\ResumeDetail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ResumeDetailController extends Controller
{
    public function get_resumedetails(Request $request)
    {        
        $resumedetails = ResumeDetail::Active()->get();
        try {
            return response()->json(['resumedetails'=>$resumedetails], 200);
        } catch (\Exception $e) {
            info($e->getMessage());
            return response()->json([], 200);
        }
    }

}
