<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:category-browse')->only('index');
        $this->middleware('can:category-read')->only('show');
        $this->middleware('can:category-edit')->only('edit', 'update');
        $this->middleware('can:category-add')->only('store', 'create');
        $this->middleware('can:category-delete')->only('destroy');
    }

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
        $pageName = 'Category List';
        if ($request->ajax()) {
            $query = Category::query();
            if (! $request->has('order')) {
                $query->latest();
            }

            return DataTables::eloquent($query)->addIndexColumn()->editColumn('name', function ($row) {
                return '<p class="text-sm font-weight-bold mb-0 text-capitalize">' . $row->name . '</p>';
            })->editColumn('parent', function ($row) {
                return '<p class="text-sm mb-0 text-capitalize">' . ($row->parent?->name ?? 'N/A') . '</p>';
            })->editColumn('tenant', function ($row) {
                return '<p class="text-sm mb-0 text-capitalize">' . $row->tenant->name . '</p>';
            })->editColumn('status', function ($row) {
                return GetStatusBadge($row->status);
            })->addColumn('action', function ($row) {
                $id = encrypt($row->id);
                $btn = '<div class="d-flex">';
                if (Auth::user()->can('category-read') || Auth::user()->can('category-edit')) {
                    $btn .= '<a href="' . route('admin.category.show', $id) . '" class="btn btn-subtle-warning m-1 btn-sm"><span class="fas fa-eye"></span></a>';
                }
                if (Auth::user()->can('category-edit')) {
                    $btn .= '<a href="' . route('admin.category.edit', $id) . '" class="btn btn-subtle-primary m-1 btn-sm"><span class="fas fa-edit"></span></a>';
                }
                if (Auth::user()->can('category-delete')) {
                    $btn .= '<form method="POST" action="' . route('admin.category.destroy', $id) . '" class="m-0 p-0 delete-form">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="submit" class="btn btn-subtle-danger m-1 btn-sm confirm-button">
                    <i class="fa fa-trash text-danger"></i>
                </button>
            </form>';
                }
                $btn .= '</div>';

                return $btn;
            })->rawColumns(['name', 'parent', 'tenant', 'status', 'action'])->make(true);
        }

        return view('backend.category.index', compact('pageName'));
    }

    public function create()
    {
        $pageName = 'Create Product Category';
        $parent = Category::where('is_parent', 'yes')->get();

        return view('backend.category.create', compact('pageName', 'parent'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'featured_image' => ['nullable'],
            'status' => ['required'],
            'description' => ['nullable'],
            'is_parent' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $validated['slug'] = Str::slug($validated['name']);
            Category::create($validated);
            DB::commit();

            return redirect()->route('admin.category.index')->with('success', 'Category created successfully');
        } catch (\Exception $th) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
        }
    }

    public function show($id)
    {
        $pageName = 'Category Details';
        $data = Category::findOrFail($this->decryptId($id));

        return view('backend.category.show', [
            'pageName' => $pageName,
            'data' => $data,
        ]);
    }

    public function edit($id)
    {
        $pageName = 'Edit Category Post';
        $data = Category::findOrFail($this->decryptId($id));
        $parent = Category::where('is_parent', 'yes')->get();

        return view('backend.category.edit', compact('pageName', 'data', 'parent'));
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($this->decryptId($id));
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'parent_id' => ['nullable', 'integer', 'exists:categories,id'],
            'featured_image' => ['nullable'],
            'status' => ['required'],
            'description' => ['nullable'],
            'is_parent' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $validated['slug'] = Str::slug($validated['name']);
            $category->update($validated);
            DB::commit();

            return redirect()->route('admin.category.index')->with('success', 'Category updated successfully');
        } catch (\Exception $th) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = Category::findOrFail($this->decryptId($id));
        $data->delete();

        return redirect()
            ->route('admin.category.index')
            ->with('success', 'Category deleted successfully');
    }

    // ----------- ajax return sub category list json

    public function getSubCategories($id)
    {
        $subCategories = Category::where('parent_id', $id)->get();
        return response()->json([
            'data' => $subCategories,
            'success' => true,
        ]);
    }
}
