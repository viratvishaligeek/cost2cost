<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class HomeController extends Controller
{
    public function home()
    {
        $product = Product::withoutGlobalScope('tenant_filter')
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
        return view('frontend.home', compact('product'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
