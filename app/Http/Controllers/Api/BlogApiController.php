<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class BlogApiController extends Controller
{
    public function index(Request $request)
    {
        $tenantId = $request->tenant_id;
        if (!$tenantId) {
            return response()->json(['status' => 400, 'message' => 'Tenant Details is required'], 400);
        }
        $perPage = (int) ($request->per_page ?? 20);
        $page = (int) ($request->page ?? 1);

        $cacheKey = "blogs_tenant_{$tenantId}_page_{$page}_per_{$perPage}";

        $blogs = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($tenantId, $perPage) {
            return Blog::withoutGlobalScope('tenant_filter')
                ->where('tenant_id', $tenantId)
                ->where('status', 'published')
                ->with([
                    'category:id,name',
                    'author:id,name',
                    'publisher:id,name',
                ])
                ->orderBy('updated_at', 'desc')
                ->paginate($perPage);
        });

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $blogs->items(),
            'pagination' => [
                'total'        => $blogs->total(),
                'per_page'     => $blogs->perPage(),
                'current_page' => $blogs->currentPage(),
                'last_page'    => $blogs->lastPage(),
                'next_page_url' => $blogs->nextPageUrl(),
                'prev_page_url' => $blogs->previousPageUrl(),
            ],
        ], 200);
    }

    public function categoryBlog(Request $request, $categoryId)
    {
        $tenantId = $request->tenant_id;
        if (!$tenantId) {
            return response()->json(['status' => 400, 'message' => 'Tenant Details is required'], 400);
        }
        if (!$categoryId) {
            return response()->json(['status' => 400, 'message' => 'Category Details is required'], 400);
        }
        $perPage = (int) ($request->per_page ?? 20);
        $page = (int) ($request->page ?? 1);

        $cacheKey = "blogs_tenant_{$tenantId}_cat_{$categoryId}_page_{$page}_per_{$perPage}";

        $blogs = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($tenantId, $categoryId, $perPage) {
            return Blog::withoutGlobalScope('tenant_filter')
                ->where('tenant_id', $tenantId)
                ->where('category_id', $categoryId)
                ->where('status', 'published')
                ->with([
                    'category:id,name',
                    'author:id,name',
                    'publisher:id,name',
                ])
                ->orderBy('updated_at', 'desc')
                ->paginate($perPage);
        });

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $blogs->items(),
            'pagination' => [
                'total'        => $blogs->total(),
                'per_page'     => $blogs->perPage(),
                'current_page' => $blogs->currentPage(),
                'last_page'    => $blogs->lastPage(),
                'next_page_url' => $blogs->nextPageUrl(),
                'prev_page_url' => $blogs->previousPageUrl(),
            ],
        ], 200);
    }
}
