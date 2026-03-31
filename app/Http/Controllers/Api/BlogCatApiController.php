<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogCatApiController extends Controller
{
    public function index(Request $request)
    {
        $perPage = ($request->per_page ?? 20);
        $tenantId = $request->tenant_id;
        $page = ($request->page ?? 1);
        $cacheKey = "blog_categories_{$tenantId}_page_{$page}_perpage_{$perPage}";

        $blogs = Cache::remember($cacheKey, 60, function () use ($tenantId, $perPage) {
            return BlogCategory::where('tenant_id', $tenantId)
                ->where('status', 'publish')
                ->orderBy('updated_at', 'desc')
                ->paginate($perPage);
        });
        $blogs = BlogCategory::where('tenant_id', $request->tenant_id)
            ->where('status', 'publish')
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
