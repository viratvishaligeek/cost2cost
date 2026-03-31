<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogApiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = ($request->per_page ?? 20);
        $blogs = Blog::where('status', 'publish')
            ->where('tenant_id', $request->tenant_id)
            ->with([
                'category:id,name',
                'author:id,name',
                'publisher:id,name',
            ])
            ->orderBy('updated_at', 'desc')
            ->paginate($perPage);

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $blogs->items(),
            'pagination' => [
                'total' => $blogs->total(),
                'per_page' => $blogs->perPage(),
                'current_page' => $blogs->currentPage(),
                'last_page' => $blogs->lastPage(),
                'next_page_url' => $blogs->nextPageUrl(),
                'prev_page_url' => $blogs->previousPageUrl(),
            ],
        ], 200);
    }
}
