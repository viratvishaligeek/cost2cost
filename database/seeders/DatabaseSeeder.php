<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Tenant;
use App\Models\Variant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // admin data seeder
        Admin::create([
            'name' => 'Super Admin',
            'email' => 'admin@gmail.com',
            'phone' => '8888888888',
            'password' => 'qwerty',
            'tenant_id' => 1,
        ]);

        // tenant data seeder
        $tenants = [
            [
                'id'     => 1,
                'name'   => 'Cost2Cost Supplement',
                'domain' => 'https://cost2costsupplement.com',
                'notes'  => 'Main Default Tenant',
                'status' => 'active'
            ],
            [
                'id'     => 2,
                'name'   => 'Earthmaa Foods',
                'domain' => 'https://earthmaafoods.com',
                'notes'  => 'Earthmaa foods Tenant',
                'status' => 'active'
            ],
        ];

        foreach ($tenants as $tenant) {
            Tenant::updateOrInsert(['id' => $tenant['id']], array_merge($tenant, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // setting data seeder
        Setting::create([
            'option' => 'project_name',
            'value' => 'Magnus',
            'tenant_id' => 0,
        ]);

        // -----------------------
        $brands = [
            ['id' => 1, 'name' => 'Nike', 'slug' => 'nike', 'status' => 'active', 'tenant_id' => 2],
            ['id' => 2, 'name' => 'Duke', 'slug' => 'duke', 'status' => 'active', 'tenant_id' => 2],
        ];

        foreach ($brands as $brand) {
            Brand::updateOrInsert(['id' => $brand['id']], array_merge($brand, [
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // 2. SEED CATEGORIES (Parent & Sub)
        $categories = [
            ['id' => 1, 'name' => "Men's Shoes", 'slug' => 'mens-shoes', 'is_parent' => 'yes', 'parent_id' => null, 'tenant_id' => 2],
            ['id' => 2, 'name' => 'Sport Shoes', 'slug' => 'sport-shoes-men', 'is_parent' => 'no', 'parent_id' => 1, 'tenant_id' => 2],
            ['id' => 3, 'name' => 'Casual Shoes', 'slug' => 'casual-shoes', 'is_parent' => 'no', 'parent_id' => 1, 'tenant_id' => 2],
            ['id' => 4, 'name' => "Women's Shoes", 'slug' => 'womens-shoes', 'is_parent' => 'yes', 'parent_id' => null, 'tenant_id' => 2],
            ['id' => 5, 'name' => 'Heel Shoes', 'slug' => 'heel-shoes', 'is_parent' => 'no', 'parent_id' => 4, 'tenant_id' => 2],
            ['id' => 6, 'name' => 'Sport Shoes', 'slug' => 'sport-shoes-women', 'is_parent' => 'no', 'parent_id' => 4, 'tenant_id' => 2],
        ];

        foreach ($categories as $cat) {
            Category::updateOrInsert(['id' => $cat['id']], array_merge($cat, [
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ]));
        }

        // 3. SEED OPTIONS
        // $options = [
        //     ['id' => 1, 'name' => 'Size', 'slug' => 'size', 'tenant_id' => 2],
        //     ['id' => 2, 'name' => 'Color', 'slug' => 'color', 'tenant_id' => 2],
        // ];

        // foreach ($options as $opt) {
        //     Option::updateOrInsert(['id' => $opt['id']], array_merge($opt, [
        //         'status' => 'active',
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]));
        // }

        // // 4. SEED OPTION VALUES
        // $optionValues = [
        //     // Size Values (Option ID: 1)
        //     ['id' => 1, 'name' => 'S', 'option_id' => 1],
        //     ['id' => 2, 'name' => 'M', 'option_id' => 1],
        //     ['id' => 3, 'name' => 'L', 'option_id' => 1],
        //     // Color Values (Option ID: 2)
        //     ['id' => 4, 'name' => 'White', 'option_id' => 2],
        //     ['id' => 5, 'name' => 'Black', 'option_id' => 2],
        //     ['id' => 6, 'name' => 'Black White Mix', 'option_id' => 2],
        // ];

        // foreach ($optionValues as $val) {
        //     OptionValue::updateOrInsert(['id' => $val['id']], array_merge($val, [
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ]));
        // }


        // $singleProduct = Product::create([
        //     'name'              => 'Premium Whey Protein',
        //     'slug'              => Str::slug('Premium Whey Protein'),
        //     'brand_id'          => 1,
        //     'category_id'       => 1,
        //     'sub_category_id'   => 2,
        //     'origin'            => 'India',
        //     'refundable'        => 'yes',
        //     'refund_limit'      => '7 Days',
        //     'sku'               => 'WHEY-PN-001',
        //     'bar_code'          => '890123456789',
        //     'hsn_code'          => '2106',
        //     'base_price'        => 2000.00,
        //     'gst'               => 18,
        //     'mrp'               => 3500.00,
        //     'sell_price'        => 2800.00,
        //     'discount_type'     => 'fixed',
        //     'discount'          => 700,
        //     'weight'            => 1000,
        //     'dimension'         => '10x10x20',
        //     'stock'             => 50,
        //     'stock_status'      => 'in_stock',
        //     'low_stock'         => 10,
        //     'min_order'         => 1,
        //     'max_order'         => 5,
        //     'short_description' => '<p>High quality protein for muscle recovery.</p>',
        //     'description'       => '<p>Full detailed description about whey protein benefits and usage.</p>',
        //     'top_product'       => 1,
        //     'featured_product'  => 1,
        //     'tags'              => 'protein, fitness, supplements',
        //     'has_variation'     => 'no',
        //     'status'            => 'active',
        //     'tenant_id'         => 1, // Cost2Cost
        // ]);

        // // 2. DUMMY VARIABLE PRODUCT (With Variations)
        // $variableProduct = Product::create([
        //     'name'              => 'Oversized Cotton Tshirt',
        //     'slug'              => Str::slug('Oversized Cotton Tshirt'),
        //     'brand_id'          => 2,
        //     'category_id'       => 2,
        //     'sub_category_id'   => 5,
        //     'origin'            => 'India',
        //     'refundable'        => 'no',
        //     'has_variation'     => 'yes',
        //     'status'            => 'active',
        //     'tenant_id'         => 2, // Earthmaa Foods
        //     // Pricing/Stock NULL for main product when variations exist
        //     'base_price'        => null,
        //     'stock'             => null,
        // ]);

        // // 3. DUMMY VARIANTS for Product 2
        // $variants = [
        //     [
        //         'name'  => 'Oversized Cotton Tshirt - L - Black',
        //         'combo' => 'L-Black',
        //         'sku'   => 'TSHIRT-L-BLK',
        //         'price' => 999.00,
        //         'stock' => 20
        //     ],
        //     [
        //         'name'  => 'Oversized Cotton Tshirt - M - White',
        //         'combo' => 'M-White',
        //         'sku'   => 'TSHIRT-M-WHT',
        //         'price' => 899.00,
        //         'stock' => 15
        //     ]
        // ];

        // foreach ($variants as $v) {
        //     $newVariant = Variant::create([
        //         'product_id'        => $variableProduct->id,
        //         'name'              => $v['name'],
        //         'combo'             => $v['combo'],
        //         'refundable'        => 'no',
        //         'sku'               => $v['sku'],
        //         'base_price'        => $v['price'] - 100,
        //         'gst'               => 5,
        //         'mrp'               => $v['price'] + 500,
        //         'sell_price'        => $v['price'],
        //         'discount_type'     => 'percentage',
        //         'discount'          => 10,
        //         'weight'            => 250,
        //         'stock'             => $v['stock'],
        //         'stock_status'      => 'in_stock',
        //         'additional_details' => 'Pure Organic Cotton',
        //         'status'            => 'active',
        //         'tenant_id'         => 2,
        //     ]);

        //     // 4. MAPPING OPTIONS (variant_options table)
        //     // Assuming Option 1 is Size and Option 2 is Color
        //     DB::table('variant_options')->insert([
        //         [
        //             'product_id' => $variableProduct->id,
        //             'variant_id' => $newVariant->id,
        //             'option_id'  => 1, // Size
        //             'value_id'   => ($v['combo'] == 'L-Black') ? 1 : 2, // L or M
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ],
        //         [
        //             'product_id' => $variableProduct->id,
        //             'variant_id' => $newVariant->id,
        //             'option_id'  => 2, // Color
        //             'value_id'   => ($v['combo'] == 'L-Black') ? 3 : 4, // Black or White
        //             'created_at' => now(),
        //             'updated_at' => now(),
        //         ]
        //     ]);
        // }
    }
}
