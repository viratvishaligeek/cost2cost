<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Option;
use App\Models\OptionValue;
use App\Models\Product;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
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
                        <a href="' . route('admin.product.show', $id) . '" class="btn btn-subtle-warning m-1 btn-sm">
                            <span class="fas fa-eye"></span>
                        </a>
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
        $data = Product::findOrFail($this->decryptId($id));
        $brands = Brand::get();
        $categories = Category::where('is_parent', 'yes')->get();
        $subCategories = Category::get();

        return view('backend.product.edit', compact('pageName', 'data', 'brands', 'categories', 'subCategories'));
    }

    public function update(Request $request, $id)
    {
        $data = Product::findOrFail($this->decryptId($id));
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required'],
            'category_id' => ['required'],
            'brand_id' => ['required'],
            'sub_category_id' => ['required'],
            'short_description' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
        ]);
        try {
            DB::beginTransaction();
            $validated['slug'] = Str::slug($validated['name']);
            $data->update($validated);
            DB::commit();
            return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
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
}
