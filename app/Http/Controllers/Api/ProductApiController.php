<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductApiController extends Controller
{
    // featured product
    public function featuredProducts(Request $request)
    {
        $tenantId = $request->tenant_id;
        if (!$tenantId) {
            return response()->json([
                'status' => 400,
                'message' => 'Tenant Details is required'
            ], 400);
        }
        $cacheKey = "featured_products_t{$tenantId}";
        $data = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($tenantId) {
            return Product::withoutGlobalScope('tenant_filter')
                ->select([
                    'id',
                    'name',
                    'slug',
                    'category_id',
                    'sub_category_id',
                    'gst',
                    'mrp',
                    'sell_price',
                    'discount_type',
                    'discount',
                    'stock',
                    'stock_status',
                    'short_description',
                    'top_product',
                    'featured_product',
                    'brand_id',
                    'has_variation',
                    'status',
                    'tenant_id',
                ])
                ->where('tenant_id', $tenantId)
                ->where('status', 'active')
                ->where('featured_product', 1)
                ->with([
                    'category:id,name',
                    'subcategory:id,name',
                    'brand:id,name',
                    'images',
                    'variants.images'
                ])
                ->orderBy('updated_at', 'desc')
                ->limit(15)
                ->get();
        });

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'count' => $data->count(),
            'data' => $data,
        ], 200);
    }

    // top product
    public function topProducts(Request $request)
    {
        $tenantId = $request->tenant_id;
        if (!$tenantId) {
            return response()->json([
                'status' => 400,
                'message' => 'Tenant Details is required'
            ], 400);
        }
        $cacheKey = "top_products_t{$tenantId}";
        $data = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($tenantId) {
            return Product::withoutGlobalScope('tenant_filter')
                ->select([
                    'id',
                    'name',
                    'slug',
                    'category_id',
                    'sub_category_id',
                    'gst',
                    'mrp',
                    'sell_price',
                    'discount_type',
                    'discount',
                    'stock',
                    'stock_status',
                    'short_description',
                    'top_product',
                    'featured_product',
                    'brand_id',
                    'has_variation',
                    'status',
                    'tenant_id',
                ])
                ->where('tenant_id', $tenantId)
                ->where('status', 'active')
                ->where('top_product', 1)
                ->with([
                    'category:id,name',
                    'subcategory:id,name',
                    'brand:id,name',
                    'images',
                    'variants.images'
                ])
                ->orderBy('updated_at', 'desc')
                ->limit(15)
                ->get();
        });

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'count' => $data->count(),
            'data' => $data,
        ], 200);
    }

    // recent product
    public function recentProducts(Request $request)
    {
        $tenantId = $request->tenant_id;
        if (!$tenantId) {
            return response()->json([
                'status' => 400,
                'message' => 'Tenant Details is required'
            ], 400);
        }
        $cacheKey = "recent_products_t{$tenantId}";
        $data = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($tenantId) {
            return Product::withoutGlobalScope('tenant_filter')
                ->select([
                    'id',
                    'name',
                    'slug',
                    'category_id',
                    'sub_category_id',
                    'gst',
                    'mrp',
                    'sell_price',
                    'discount_type',
                    'discount',
                    'stock',
                    'stock_status',
                    'short_description',
                    'top_product',
                    'featured_product',
                    'brand_id',
                    'has_variation',
                    'status',
                    'tenant_id',
                ])
                ->where('tenant_id', $tenantId)
                ->where('status', 'active')
                ->with([
                    'category:id,name',
                    'subcategory:id,name',
                    'brand:id,name',
                    'images',
                    'variants.images'
                ])
                ->latest('updated_at')
                ->limit(15)
                ->get();
        });

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'count' => $data->count(),
            'data' => $data,
        ], 200);
    }

    // all product categories
    public function category(Request $request)
    {
        $tenantId = $request->tenant_id;
        if (!$tenantId) {
            return response()->json([
                'status' => 400,
                'message' => 'Tenant Details is required'
            ], 400);
        }
        $cacheKey = "product_categories_t{$tenantId}";
        $data = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($tenantId) {
            return Category::withoutGlobalScope('tenant_filter')
                ->select([
                    'id',
                    'name',
                    'slug',
                    'parent_id',
                    'tenant_id',
                    'is_parent',
                    'featured_image',
                    'description',
                    'status',
                ])
                ->where('tenant_id', $tenantId)
                ->withCount('products')
                ->where('status', 'active')
                ->orderBy('updated_at', 'desc')
                ->get();
        });

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'count' => $data->count(),
            'data' => $data,
        ], 200);
    }

    // category products
    public function categoryProducts(Request $request, string $slug)
    {
        $validated = $request->validate([
            'tenant_id' => 'required|integer|exists:tenants,id',
            'per_page' => 'nullable|integer|min:1|max:50',
            'page' => 'nullable|integer|min:1',
        ]);

        $tenantId = $validated['tenant_id'];
        $perPage = $validated['per_page'] ?? 15;
        $page = $validated['page'] ?? 1;

        $category = Category::select('id')
            ->where('slug', $slug)
            ->first();

        if (!$category) {
            return response()->json([
                'status' => 404,
                'message' => 'Category not found'
            ], 404);
        }

        $categoryId = $category->id;

        $cacheKey = "category_products_{$tenantId}_{$categoryId}_{$page}_{$perPage}";
        $products = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($tenantId, $categoryId, $perPage, $page) {
            return Product::withoutGlobalScope('tenant_filter')
                ->where('tenant_id', $tenantId)
                ->where('status', 'active')
                ->where(function ($q) use ($categoryId) {
                    $q->where('category_id', $categoryId)
                        ->orWhere('sub_category_id', $categoryId);
                })
                ->select([
                    'id',
                    'name',
                    'slug',
                    'category_id',
                    'sub_category_id',
                    'gst',
                    'mrp',
                    'sell_price',
                    'discount_type',
                    'discount',
                    'stock',
                    'stock_status',
                    'short_description',
                    'top_product',
                    'featured_product',
                    'brand_id',
                    'has_variation',
                    'status',
                    'tenant_id'
                ])
                ->with([
                    'category:id,name',
                    'subcategory:id,name',
                    'brand:id,name',
                    'images',
                    'variants.images'
                ])
                ->latest('updated_at')
                ->paginate($perPage, ['*'], 'page', $page);
        });

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $products->items(),
            'pagination' => [
                'total' => $products->total(),
                'per_page' => $products->perPage(),
                'current_page' => $products->currentPage(),
                'last_page' => $products->lastPage(),
                'next_page_url' => $products->nextPageUrl(),
                'prev_page_url' => $products->previousPageUrl(),
            ],
        ]);
    }
    // public function categoryProducts(Request $request, $slug)
    // {
    //     $tenantId = $request->tenant_id;
    //     if (!$tenantId) {
    //         return response()->json([
    //             'status' => 400,
    //             'message' => 'Tenant Details is required'
    //         ], 400);
    //     }

    //     $categoryData = Category::where('slug', $slug)->first();
    //     if (!$categoryData) {
    //         return response()->json([
    //             'status' => 400,
    //             'message' => 'Category Not Found'
    //         ], 400);
    //     }
    //     $categoryId = $categoryData->id;
    //     $perPage = (int) ($request->per_page ?? 15);
    //     $page = (int) ($request->page ?? 1);
    //     // safety cap
    //     $perPage = min($perPage, 50);
    //     $cacheKey = "category_products_t{$tenantId}_cat{$categoryId}_p{$page}_pp{$perPage}";
    //     $data = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($tenantId, $categoryId, $perPage, $page) {
    //         return Product::withoutGlobalScope('tenant_filter')
    //             ->select([
    //                 'id',
    //                 'name',
    //                 'slug',
    //                 'category_id',
    //                 'sub_category_id',
    //                 'gst',
    //                 'mrp',
    //                 'sell_price',
    //                 'discount_type',
    //                 'discount',
    //                 'stock',
    //                 'stock_status',
    //                 'short_description',
    //                 'top_product',
    //                 'featured_product',
    //                 'brand_id',
    //                 'has_variation',
    //                 'status',
    //                 'tenant_id',
    //             ])
    //             ->where('tenant_id', $tenantId)
    //             ->where(function ($q) use ($categoryId) {
    //                 $q->where('category_id', $categoryId)
    //                     ->orWhere('sub_category_id', $categoryId);
    //             })
    //             ->where('status', 'active')
    //             ->with([
    //                 'category:id,name',
    //                 'subcategory:id,name',
    //                 'brand:id,name',
    //                 'images',
    //                 'variants.images'
    //             ])
    //             ->orderBy('updated_at', 'desc')
    //             ->paginate($perPage, ['*'], 'page', $page);
    //     });
    //     return response()->json([
    //         'status' => 200,
    //         'message' => 'success',
    //         'data' => $data->items(),
    //         'pagination' => [
    //             'total' => $data->total(),
    //             'per_page' => $data->perPage(),
    //             'current_page' => $data->currentPage(),
    //             'last_page' => $data->lastPage(),
    //             'next_page_url' => $data->nextPageUrl(),
    //             'prev_page_url' => $data->previousPageUrl(),
    //         ],
    //     ], 200);
    // }

    // search function
    public function search(Request $request, $query)
    {
        $tenantId = $request->tenant_id;
        if (!$tenantId) {
            return response()->json([
                'status' => 400,
                'message' => 'Tenant Details is required'
            ], 400);
        }
        $query = trim($query);
        if (strlen($query) < 3) {
            return response()->json([
                'status' => 422,
                'message' => 'Search query must be at least 3 characters'
            ], 422);
        }
        if (preg_match('/\s/', $query)) {
            return response()->json([
                'status' => 422,
                'message' => 'Spaces are not allowed in search query'
            ], 422);
        }
        $limit = (int) ($request->limit ?? 5);
        $limit = min($limit, 50);
        $cacheKey = "search_t{$tenantId}_q" . md5($query) . "_limit{$limit}";
        $data = Cache::remember($cacheKey, now()->addMinutes(30), function () use ($tenantId, $query, $limit) {
            return Product::withoutGlobalScope('tenant_filter')
                ->select([
                    'id',
                    'name',
                    'slug',
                    'category_id',
                    'sub_category_id',
                    'gst',
                    'mrp',
                    'sell_price',
                    'discount_type',
                    'discount',
                    'stock',
                    'stock_status',
                    'short_description',
                    'top_product',
                    'featured_product',
                    'brand_id',
                    'has_variation',
                    'status',
                    'tenant_id',
                ])
                ->where('tenant_id', $tenantId)
                ->where('status', 'active')
                ->where(function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%")
                        ->orWhere('slug', 'LIKE', "%{$query}%")
                        ->orWhere('tags', 'LIKE', "%{$query}%");
                })
                ->with([
                    'category:id,name',
                    'subcategory:id,name',
                    'brand:id,name',
                    'images',
                    'variants.images'
                ])
                ->orderBy('updated_at', 'desc')
                ->limit($limit)
                ->get();
        });
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'count' => $data->count(),
            'data' => $data,
        ], 200);
    }

    // all product list
    public function productList(Request $request)
    {
        $tenantId = $request->tenant_id;
        if (!$tenantId) {
            return response()->json([
                'status' => 400,
                'message' => 'Tenant Details is required'
            ], 400);
        }
        $perPage = (int) $request->per_page ?: 20;
        $page = (int) $request->page ?: 1;
        $cacheKey = "products_t{$tenantId}_p{$page}_pp{$perPage}_sort{$request->sort_by}";
        $data = Cache::remember($cacheKey, now()->addMinutes(60), function () use ($tenantId, $perPage, $request) {
            $query = Product::withoutGlobalScope('tenant_filter')
                ->select(
                    'id',
                    'name',
                    'slug',
                    'brand_id',
                    'category_id',
                    'sub_category_id',
                    'origin',
                    'gst',
                    'mrp',
                    'sell_price',
                    'discount_type',
                    'discount',
                    'stock',
                    'stock_status',
                    'short_description',
                    'top_product',
                    'featured_product',
                    'status',
                )
                ->where('tenant_id', $tenantId)
                ->where('status', 'active')
                ->with([
                    'category:id,name',
                    'subcategory:id,name',
                    'brand:id,name',
                    'images',
                    'variants.images'
                ]);
            switch ($request->sort_by) {
                case 'lowtohigh':
                    $query->orderByRaw('CAST(sell_price AS DECIMAL(10,2)) ASC');
                    break;
                case 'hightolow':
                    $query->orderByRaw('CAST(sell_price AS DECIMAL(10,2)) DESC');
                    break;
                case 'pop':
                    $query->where('featured_product', 'yes');
                    break;
                case 'aToz':
                    $query->orderBy('name', 'asc');
                    break;
                case 'zToa':
                    $query->orderBy('name', 'desc');
                    break;
                default:
                    $query->orderBy('updated_at', 'desc');
            }
            return $query->paginate($perPage, ['*'], 'page', $request->page ?? 1);
        });
        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $data->items(),
            'pagination' => [
                'total' => $data->total(),
                'per_page' => $data->perPage(),
                'current_page' => $data->currentPage(),
                'last_page' => $data->lastPage(),
                'next_page_url' => $data->nextPageUrl(),
                'prev_page_url' => $data->previousPageUrl(),
            ],
        ], 200);
    }

    // product detail response function
    public function productDetail(Request $request, $slug)
    {
        try {
            $product = Product::withoutGlobalScope('tenant_filter')
                ->where('slug', $slug)
                ->with(['variants.options.values', 'images', 'category'])
                ->where('status', 'active')
                ->firstOrFail();
            $reviewEligible = false;
            $filteredOptions = $this->getFilteredOptions($product);
            $faq = ProductFaq::where('product_id', $product->id)
                ->select('id', 'question', 'answer', 'created_at')->get();
            $review = [];
            $minPrice = null;
            $maxPrice = null;
            $variantImages = [];
            if ($product->variants && $product->variants->isNotEmpty()) {
                $prices = [];
                foreach ($product->variants as $variant) {
                    $prices[] = $variant->sell_price;
                    $variantImages[] = $variant->images;
                }
                if (!empty($prices)) {
                    $minPrice = min($prices);
                    $maxPrice = max($prices);
                }
            }
            $productPrice = $minPrice && $maxPrice ? "₹$minPrice - ₹$maxPrice" : $product->sell_price;
            $productKey = [
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'has_variation' => $product->has_variation,
                'category_id' => $product->category_id,
                'category' => $product->category->name,
                'category_slug' => $product->category->slug,
                'short_description' => $product->short_description,
                'description' => $product->description,
                'tags' => $product->tags,
                'origin' => $product->origin,
                'dimension' => $product->dimension,
                'weight' => $product->weight,
                'mrp' => $product->mrp,
                'discount_type' => $product->discount_type,
                'min_order' => $product->min_order,
                'max_order' => $product->max_order,
                'discount' => $product->discount,
                'sell_price' => $product->sell_price ?: ($product->sell_price ?: $productPrice),
                'stock' => $product->stock,
                'stock_status' => $product->stock_status,
                'top_product' => $product->top_product,
                'featured_product' => $product->featured_product,
            ];
            $related = Product::withoutGlobalScope('tenant_filter')
                ->select([
                    'id',
                    'name',
                    'slug',
                    'brand_id',
                    'category_id',
                    'sub_category_id',
                    'origin',
                    'gst',
                    'mrp',
                    'sell_price',
                    'discount_type',
                    'discount',
                    'stock',
                    'stock_status',
                    'short_description',
                    'top_product',
                    'featured_product',
                    'status',
                ])
                ->where('status', 'active')
                ->where('id', '!=', $product->id)
                ->where(function ($q) use ($product) {
                    $q->where('category_id', $product->category_id)
                        ->orWhere('sub_category_id', $product->sub_category_id);
                })
                ->with([
                    'category:id,name',
                    'subcategory:id,name',
                    'brand:id,name',
                    'images',
                    'variants.images'
                ])
                ->inRandomOrder()
                ->limit(10)
                ->get();
            // Return the response
            return response()->json(
                [
                    'product' => $productKey,
                    'variants' => $product->variants,
                    'images' => $product->images,
                    'variantImages' => $variantImages,
                    'filtered_options' => $filteredOptions,
                    'faq' => $faq,
                    'review_count' => count($review),
                    'review_eligible' => $reviewEligible,
                    'review' => $review,
                    'related_products' => $related,
                    'status' => 200,
                    'message' => 'success',
                ],
                200
            );
        } catch (\Exception $e) {
            return response()->json([
                'error' => 'Unable to fetch product details',
                'message' => $e->getMessage()
            ], 500);
        }
    }

    // get filtered options
    private function getFilteredOptions($product)
    {
        $options = [];
        $valueIds = [];
        foreach ($product->variants as $variant) {
            foreach ($variant->options as $option) {
                $valueIds[] = $option->pivot->value_id;
            }
        }
        $valueIds = array_unique($valueIds);
        $values = \App\Models\OptionValue::whereIn('id', $valueIds)
            ->get()
            ->keyBy('id');
        foreach ($product->variants as $variant) {
            foreach ($variant->options as $option) {
                $valueId = $option->pivot->value_id;
                if (!isset($values[$valueId])) continue;
                $value = $values[$valueId];
                if (!isset($options[$option->id])) {
                    $options[$option->id] = [
                        'id' => $option->id,
                        'name' => $option->name,
                        'values' => []
                    ];
                }
                $options[$option->id]['values'][$value->id] = [
                    'id' => $value->id,
                    'value' => $value->name
                ];
            }
        }
        foreach ($options as &$opt) {
            $opt['values'] = array_values($opt['values']);
        }
        return array_values($options);
    }
}
