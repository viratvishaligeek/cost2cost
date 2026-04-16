<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Product;
use App\Models\ProductFaq;
use App\Models\ProductImage;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    private function decryptId($id)
    {
        try {
            return decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function index(Request $request)
    {
        $pageName = 'Product List';
        if ($request->ajax()) {
            $query = Product::query();
            if (! $request->has('order')) {
                $query->latest();
            }

            return DataTables::eloquent($query)
                ->addIndexColumn()->editColumn('name', function ($row) {
                    return '<p class="text-sm font-weight-bold mb-0 text-capitalize">' . $row->name . '</p>';
                })->editColumn('tenant', function ($row) {
                    return '<p class="text-sm mb-0 text-capitalize">' . $row->tenant->name . '</p>';
                })->editColumn('status', function ($row) {
                    return GetStatusBadge($row->status);
                })->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d, M Y, H:i A');
                })->addColumn('action', function ($row) {
                    $id = encrypt($row->id);

                    return '
                    <div class="d-flex">
                        <a href="' . route('admin.product.edit', $id) . '" class="btn btn-subtle-primary m-1 btn-sm">
                            <span class="fas fa-edit"></span>
                        </a>
                        <form method="POST" action="' . route('admin.product.destroy', $id) . '" class="m-0 p-0 delete-form">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-subtle-danger m-1 btn-sm confirm-button">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                        </form>
                    </div>';
                })->rawColumns(['name', 'tenant', 'status', 'action'])->make(true);
        }

        $categories = Category::where('is_parent', 'yes')->get();
        $brands = Brand::get();
        $options = Option::with('values')->get();

        return view('backend.product.index', compact('pageName', 'categories', 'brands', 'options'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'            => ['required', 'string', 'max:255', 'unique:products,name'],
            'category_id'     => ['required', 'integer'],
            'brand_id'        => ['required', 'integer'],
            'status'          => ['required', 'in:active,inactive,draft'],
            'has_variation'   => ['required', 'in:yes,no'],
        ]);
        try {
            DB::beginTransaction();
            $product = new Product();
            $product->name            = $request->name;
            $product->slug            = Str::slug($request->name);
            $product->brand_id        = $request->brand_id;
            $product->category_id     = $request->category_id;
            $product->sub_category_id = $request->sub_category_id;
            $product->has_variation   = $request->has_variation;
            $product->status          = $request->status;
            $product->save();

            if ($request->has_variation == 'yes' && $request->has('variants')) {
                foreach ($request->variants as $variantData) {
                    $optionNames = [];
                    if (!isset($variantData['options'])) continue;
                    foreach ($variantData['options'] as $optionId => $valueId) {
                        $val = OptionValue::find($valueId);
                        if ($val) {
                            $optionNames[] = $val->name;
                        }
                    }
                    $variantCombo = implode('-', $optionNames);
                    $uniqueName = $product->name . '-' . $variantCombo;
                    $variant = $product->variants()->create([
                        'name' => $uniqueName,
                        'combo' => $variantCombo,
                        'status' => 'active',
                        'tenant_id' => $product->tenant_id,
                        'stock_status' => 'in_stock',
                        'sku' => strtoupper(Str::random(10)),
                    ]);

                    foreach ($variantData['options'] as $optionId => $valueId) {
                        $variant->options()->attach($optionId, [
                            'product_id' => $product->id,
                            'value_id'   => $valueId
                        ]);
                    }
                }
            }
            DB::commit();
            $redirectRoute = ($request->has_variation == 'yes') ? 'admin.product.edit' : 'admin.product.index';
            return redirect()->route($redirectRoute, encrypt($product->id))
                ->with('success', 'Product and variants initialized successfully.');
        } catch (\Exception $th) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Database Error: ' . $th->getMessage());
        }
    }


    public function edit($id)
    {
        $pageName = 'Edit Product';
        $productId = $this->decryptId($id);
        $data = Product::with('variants')->findOrFail($productId);
        $images = ProductImage::where('product_id', $data->id)->first();
        $brands = Brand::get();
        $categories = Category::where('is_parent', 'yes')->get();
        $subCategories = Category::get();

        return view('backend.product.edit', compact(
            'pageName',
            'data',
            'brands',
            'categories',
            'subCategories',
            'images',
        ));
    }

    public function update(Request $request, $id)
    {
        $data = Product::findOrFail($this->decryptId($id));
        $validated = $request->validate([
            'name' => ['nullable', 'string', 'max:255', Rule::unique('products')->ignore($data->id)],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'sub_category_id' => ['nullable', 'exists:categories,id'],
            'origin' => ['nullable', 'string', 'max:100'],
            'status' => ['nullable', 'in:active,inactive,draft'],
            'tags' => ['nullable', 'string'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'string'],
            'gallery_image' => ['nullable', 'string'],
            'base_price' => ['nullable', 'numeric', 'min:0'],
            'mrp' => ['nullable', 'numeric', 'min:0', 'gte:base_price'],
            'sell_price' => ['nullable', 'numeric', 'min:0', 'lte:mrp'],
            'gst' => ['nullable', 'integer', 'min:0', 'max:100'],
            'discount_type' => ['nullable', 'in:fixed,percentage'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'sku' => ['nullable', 'string', 'max:50', Rule::unique('products')->ignore($data->id)],
            'hsn_code' => ['nullable', 'string', 'max:50'],
            'bar_code' => ['nullable', 'string', 'max:50'],
            'weight' => ['nullable', 'numeric', 'min:0'],
            'dimension' => ['nullable', 'string', 'max:50'],
            'refundable' => ['nullable', 'in:yes,no'],
            'refund_limit' => ['nullable', 'string', 'max:50'],
            'stock' => ['nullable', 'integer', 'min:0'],
            'stock_status' => ['nullable', 'in:in_stock,out_of_stock,low_stock'],
            'low_stock' => ['nullable', 'integer', 'min:0'],
            'min_order' => ['nullable', 'integer', 'min:1'],
            'max_order' => ['nullable', 'integer', 'gte:min_order'],
            'top_product' => ['nullable'],
            'featured_product' => ['nullable'],
            'custom_table' => ['nullable'],
        ]);
        try {
            DB::beginTransaction();
            if (($validated['stock'] ?? 0) == 0) {
                $validated['stock_status'] = 'out_of_stock';
            }
            if ($request->discount_type === 'percentage' && $request->discount > 100) {
                return back()->with('error', 'Percentage cannot be more than 100')->withInput();
            }
            if ($request->discount_type === 'fixed' && $request->discount > ($request->mrp ?? 0)) {
                return back()->with('error', 'Discount cannot be more than MRP')->withInput();
            }
            $slug = Str::slug($validated['name']);
            $count = Product::where('slug', 'LIKE', "{$slug}%")
                ->where('id', '!=', $data->id)->count();
            $validated['slug'] = $count ? "{$slug}-{$count}" : $slug;
            $validated['top_product'] = $request->has('top_product');
            $validated['featured_product'] = $request->has('featured_product');
            $data->update($validated);
            $existingImage = ProductImage::where('product_id', $data->id)->first();
            $imageData = [
                'product_id' => $data->id,
                'featured_image' => $validated['featured_image'] ?? $existingImage?->featured_image,
                'gallery' => $validated['gallery_image'] ?? $existingImage?->gallery,
                'lifestyle' => $request->lifestyle ?? $existingImage?->lifestyle,
                'infographics' => $request->infographics ?? $existingImage?->infographics,
                'video' => $request->video ?? $existingImage?->video,
            ];

            ProductImage::updateOrCreate(
                ['product_id' => $data->id],
                $imageData
            );
            DB::commit();
            return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong: ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = Product::findOrFail($this->decryptId($id));
        $data->delete();
        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Product deleted successfully');
    }

    public function getFaqs($id)
    {
        $pageName = 'Product FAQs';
        $data = Product::findOrFail($this->decryptId($id));
        $faqs = ProductFaq::where('product_id', $data->id)->get();
        return view('backend.product.edit-faq', compact('data', 'faqs', 'pageName'));
    }

    public function updateFaqs(Request $request, $id)
    {
        $productId = $this->decryptId($id);
        $submittedFaqs = $request->faqs ?? [];
        $existingIds = ProductFaq::where('product_id', $productId)
            ->pluck('id')
            ->toArray();
        $keepIds = [];
        foreach ($submittedFaqs as $faq) {
            if (empty($faq['question']) && empty($faq['answer'])) {
                continue;
            }
            if (!empty($faq['id'])) {
                ProductFaq::where('id', $faq['id'])->update([
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                ]);
                $keepIds[] = $faq['id'];
            } else {
                $new = ProductFaq::create([
                    'product_id' => $productId,
                    'question' => $faq['question'],
                    'answer' => $faq['answer'],
                ]);

                $keepIds[] = $new->id;
            }
        }
        $deleteIds = array_diff($existingIds, $keepIds);
        if (!empty($deleteIds)) {
            ProductFaq::whereIn('id', $deleteIds)->delete();
        }
        return back()->with('success', 'FAQs updated successfully');
    }
}
