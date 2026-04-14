<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        $tenantId = $request->tenant_id;
        if (!$tenantId) {
            return response()->json(['status' => 400, 'message' => 'Tenant Details is required'], 400);
        }
        $perPage = (int) $request->per_page ?? 20;
        $page = (int) $request->page ?? 1;

        $cacheKey = "products_t{$tenantId}_p{$page}_pp{$perPage}";
        $data = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($tenantId, $perPage) {
            return Product::withoutGlobalScope('tenant_filter')
                ->where('tenant_id', $tenantId)
                ->where('status', 'active')
                ->orderBy('updated_at', 'desc')
                ->paginate($perPage);
        });
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $data->items(),
            'pagination' => [
                'total'        => $data->total(),
                'per_page'     => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page'    => $data->lastPage(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
            ],
        ], 200);
    }
}
