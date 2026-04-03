<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Option;
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
                })->editColumn('values', function ($row) {
                    return '<p class="text-sm mb-0 text-capitalize">' . $row->values->count() . '</p>';
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
                })->rawColumns(['name', 'values', 'tenant', 'status', 'action'])->make(true);
        }

        $categories = Category::get();
        $subCategories = Category::get();
        $brands = Brand::get();
        $options = Option::with('values')->get();

        return view('backend.product.index', compact('pageName', 'categories', 'brands', 'options', 'subCategories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $validated['slug'] = Str::slug($validated['name']);
            Option::create($validated);
            DB::commit();

            return redirect()->route('admin.product.index')->with('success', 'Product created successfully');
        } catch (\Exception $th) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
        }
    }

    public function show($id)
    {
        $pageName = 'Product Detail';
        $data = Option::findOrFail($this->decryptId($id));

        return view('backend.product.show', [
            'pageName' => $pageName,
            'data' => $data,
        ]);
    }

    public function edit($id)
    {
        $pageName = 'Edit Product';
        $data = Option::findOrFail($this->decryptId($id));

        return view('backend.product.edit', compact('pageName', 'data'));
    }

    public function update(Request $request, $id)
    {
        $option = Option::findOrFail($this->decryptId($id));
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $validated['slug'] = Str::slug($validated['name']);
            $option->update($validated);
            DB::commit();

            return redirect()->route('admin.product.index')->with('success', 'Option updated successfully');
        } catch (\Exception $th) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = Option::findOrFail($this->decryptId($id));
        $data->delete();

        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Option deleted successfully');
    }
}
