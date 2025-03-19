<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\SocialMedia;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SocialMediaController extends Controller
{
    public function get_socialmedias(Request $request)
    {        
        $socialmedias = SocialMedia::Active()->get();
        try {
            return response()->json(['socialmedias'=>$socialmedias], 200);
        } catch (\Exception $e) {
            info($e->getMessage());
            return response()->json([], 200);
        }
    }

}
