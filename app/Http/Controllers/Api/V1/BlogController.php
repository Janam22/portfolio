<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BlogController extends Controller
{
    public function get_blogs(Request $request)
    {        
        $blogs = Blog::Active()->get();
        try {
            return response()->json(['blogs'=>$blogs], 200);
        } catch (\Exception $e) {
            info($e->getMessage());
            return response()->json([], 200);
        }
    }

    public function get_blog_details($id)
    {
        try {
            $blog = Blog::Active()->findOrFail($id);
            return response()->json($blog, 200);
        } catch (\Exception $e) {
            info($e->getMessage());
            return response()->json([
                'errors' => ['code' => 'blog-001', 'message' => translate('messages.not_found')]
            ], 404);
        }
    }

}
