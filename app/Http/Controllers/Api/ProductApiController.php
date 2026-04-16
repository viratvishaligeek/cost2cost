<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductFaq;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ProductApiController extends Controller
{
    public function index(Request $request)
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


    public function productDetail(Request $request, $slug)
    {
        try {
            $product = Product::where('slug', $slug)
                ->with(['variants.options.values', 'images', 'category'])
                ->where('status', 'active')
                ->firstOrFail();
            //review eligibility
            $reviewEligible = false;
            // Get filtered variant options
            $filteredOptions = $this->getFilteredOptions($product);
            // Get FAQs for the product
            $faq = ProductFaq::where('product_id', $product->id)
                ->select('id', 'question', 'answer', 'created_at')->get();
            // Get product reviews
            $review = [];
            // ----------------------------------------------------
            $minPrice = null;
            $maxPrice = null;
            // Check if product has variations
            if ($product->variants && $product->variants->isNotEmpty()) {
                $prices = [];
                $variantImages = [];
                foreach ($product->variants as $variant) {
                    $prices[] = $variant->sell_price;
                    $variantImages[] = $variant->images;
                }
                if (!empty($prices)) {
                    $minPrice = min($prices);
                    $maxPrice = max($prices);
                }
            }
            // If there are no variations, fallback to the product's base price
            $productPrice = $minPrice && $maxPrice ? "₹$minPrice - ₹$maxPrice" : $product->sell_price;
            // ----------------------------------------------------
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
            $related = Product::where('tenant_id', $request->tenant_id)
                ->where('category_id', $product->category_id)
                ->where('id', '!=', $product->id)
                ->where('status', 'active')
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

    private function getFilteredOptions($product)
    {
        $options = [];

        // 🔥 collect all value_ids first
        $valueIds = [];

        foreach ($product->variants as $variant) {
            foreach ($variant->options as $option) {
                $valueIds[] = $option->pivot->value_id;
            }
        }

        $valueIds = array_unique($valueIds);

        // 🔥 fetch all values in one query
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
