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
        $tenantId = $request->tenant_id;
        if (!$tenantId) {
            return response()->json(['status' => 400, 'message' => 'Tenant Details is required'], 400);
        }
        $perPage = (int) $request->per_page ?? 20;
        $page = (int) $request->page ?? 1;

        $cacheKey = "blog_categories_t{$tenantId}_p{$page}_pp{$perPage}";
        $blogsCat = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($tenantId, $perPage) {
            return BlogCategory::withoutGlobalScope('tenant_filter')
                ->where('tenant_id', $tenantId)
                ->where('status', 'active')
                ->orderBy('updated_at', 'desc')
                ->paginate($perPage);
        });
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $blogsCat->items(),
            'pagination' => [
                'total'        => $blogsCat->total(),
                'per_page'     => $blogsCat->perPage(),
                'current_page' => $blogsCat->currentPage(),
                'last_page'    => $blogsCat->lastPage(),
                'next_page_url' => $blogsCat->nextPageUrl(),
                'prev_page_url' => $blogsCat->previousPageUrl(),
            ],
        ], 200);
    }
}
