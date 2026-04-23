<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductController extends Controller
{
    public function showDetail($slug)
    {
        $product = Product::where('slug', $slug)
            ->where('status', 'active')
            ->with([
                'category:id,name',
                'subcategory:id,name',
                'brand:id,name',
                'images',
                'variants.images'
            ])
            ->first();
        return view('frontend.product.show', compact('product'));
    }

    public function contact()
    {
        return view('frontend.contact');
    }
}
