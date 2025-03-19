<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestimonialController extends Controller
{
    public function get_testimonials(Request $request)
    {        
        $testimonials = Testimonial::Active()->get();
        try {
            return response()->json(['testimonials'=>$testimonials], 200);
        } catch (\Exception $e) {
            info($e->getMessage());
            return response()->json([], 200);
        }
    }

}
