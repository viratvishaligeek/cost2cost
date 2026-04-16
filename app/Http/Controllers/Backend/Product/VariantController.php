<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\ProductImage;
use App\Models\Variant;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class VariantController extends Controller
{
    private function decryptId($id)
    {
        try {
            return decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }
    }
    public function edit($id)
    {
        $pageName = 'Edit Product Variant';
        $variantId = $this->decryptId($id);
        $variant = Variant::with('product.variants')->findOrFail($variantId);
        $data = $variant->product;
        $images = ProductImage::where('product_id', $data->id)->where('variant_id', $variantId)->first();
        return view('backend.product.edit-variant', compact('pageName', 'variant', 'images', 'data'));
    }


    public function update(Request $request, $id)
    {
        $variantId = $this->decryptId($id);
        $variant = Variant::findOrFail($variantId);
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'sku' => ['nullable', 'string', 'max:50', Rule::unique('variants')->ignore($variant->id)],
            'status' => ['required', 'in:active,inactive,draft'],
            'base_price' => ['nullable', 'numeric', 'min:0'],
            'gst' => ['nullable', 'integer', 'min:0', 'max:100'],
            'mrp' => ['nullable', 'numeric', 'gte:base_price'],
            'sell_price' => ['nullable', 'numeric', 'lte:mrp'],
            'discount_type' => ['required', 'in:fixed,percentage'],
            'discount' => ['nullable', 'numeric'],
            'stock' => ['nullable', 'integer'],
            'low_stock' => ['nullable', 'integer'],
            'min_order' => ['nullable', 'integer'],
            'max_order' => ['nullable', 'integer', 'gte:min_order'],
            'weight' => ['nullable', 'numeric'],
            'dimension' => ['nullable', 'string'],
            'hsn_code' => ['nullable', 'string'],
            'bar_code' => ['nullable', 'string'],
            'additional_details' => ['nullable', 'string'],
            'featured_image' => ['nullable', 'string'],
            'gallery_image' => ['nullable', 'string'],
            'lifestyle' => ['nullable', 'string'],
            'infographics' => ['nullable', 'string'],
            'video' => ['nullable', 'string'],
            'custom_table' => ['nullable']
        ]);

        try {
            DB::beginTransaction();
            if (($validated['stock'] ?? 0) == 0) {
                $validated['stock_status'] = 'out_of_stock';
            }
            if ($request->discount_type === 'percentage' && $request->discount > 100) {
                return back()->with('error', 'Percentage cannot be more than 100')->withInput();
            }
            if ($request->discount_type === 'fixed' && $request->discount > $request->mrp) {
                return back()->with('error', 'Fixed discount cannot be more than MRP')->withInput();
            }
            $variant->update($validated);
            $existingImage = ProductImage::where('variant_id', $variant->id)->first();
            $imageData = [
                'product_id' => $variant->product_id,
                'variant_id' => $variant->id,
                'featured_image' => $validated['featured_image'] ?? $existingImage?->featured_image,
                'gallery' => $validated['gallery_image'] ?? $existingImage?->gallery,
                'lifestyle' => $request->lifestyle ?? $existingImage?->lifestyle,
                'infographics' => $request->infographics ?? $existingImage?->infographics,
                'video' => $request->video ?? $existingImage?->video,
            ];
            ProductImage::updateOrCreate(
                ['variant_id' => $variant->id],
                $imageData
            );
            DB::commit();
            return redirect()->route('admin.product.index')->with('success', 'Variant updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = Variant::findOrFail($this->decryptId($id));
        $data->delete();
        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Product Variant deleted successfully');
    }
}
