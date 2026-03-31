<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:brand-browse')->only('index');
        $this->middleware('can:brand-read')->only('show');
        $this->middleware('can:brand-edit')->only('edit', 'update');
        $this->middleware('can:brand-add')->only('store', 'create');
        $this->middleware('can:brand-delete')->only('destroy');
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
        $pageName = 'Brand List';
        if ($request->ajax()) {
            $query = Brand::query();
            if (! $request->has('order')) {
                $query->latest();
            }
            return DataTables::eloquent($query)->addIndexColumn()->editColumn('name', function ($row) {
                return '<p class="text-sm font-weight-bold mb-0 text-capitalize">' . $row->name . '</p>';
            })->editColumn('product_count', function ($row) {
                return '<p class="text-sm mb-0 text-capitalize">00</p>';
            })->editColumn('tenant', function ($row) {
                return '<p class="text-sm mb-0 text-capitalize">' . $row->tenant->name . '</p>';
            })->editColumn('status', function ($row) {
                return GetStatusBadge($row->status);
            })->editColumn('created_at', function ($row) {
                return $row->created_at->format('d, M Y, H:i A');
            })->addColumn('action', function ($row) {
                $id = encrypt($row->id);
                $btn = '<div class="d-flex">';
                if (Auth::user()->can('brand-read') || Auth::user()->can('brand-edit')) {
                    $btn .= '<a href="' . route('admin.brand.show', $id) . '" class="btn btn-subtle-warning m-1 btn-sm"><span class="fas fa-eye"></span></a>';
                }
                if (Auth::user()->can('brand-edit')) {
                    $btn .= '<a href="' . route('admin.brand.edit', $id) . '" class="btn btn-subtle-primary m-1 btn-sm"><span class="fas fa-edit"></span></a>';
                }
                if (Auth::user()->can('brand-delete')) {
                    $btn .= '<form method="POST" action="' . route('admin.brand.destroy', $id) . '" class="m-0 p-0 delete-form">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="submit" class="btn btn-subtle-danger m-1 btn-sm confirm-button">
                    <i class="fa fa-trash text-danger"></i>
                </button>
            </form>';
                }
                $btn .= '</div>';

                return $btn;
            })->rawColumns(['name', 'product_count', 'tenant', 'status', 'action'])->make(true);
        }

        return view('backend.brand.index', compact('pageName'));
    }

    public function create()
    {
        $pageName = 'Create Brand';

        return view('backend.brand.create', compact('pageName'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'featured_image' => ['nullable'],
            'status' => ['required'],
            'description' => ['nullable'],
        ]);
        try {
            DB::beginTransaction();
            $validated['slug'] = Str::slug($validated['name']);
            Brand::create($validated);
            DB::commit();

            return redirect()->route('admin.brand.index')->with('success', 'Brand created successfully');
        } catch (\Exception $th) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
        }
    }

    public function show($id)
    {
        $pageName = 'Brand Details';
        $data = Brand::findOrFail($this->decryptId($id));

        return view('backend.brand.show', [
            'pageName' => $pageName,
            'data' => $data,
        ]);
    }

    public function edit($id)
    {
        $pageName = 'Edit Brand';
        $data = Brand::findOrFail($this->decryptId($id));

        return view('backend.brand.edit', compact('pageName', 'data'));
    }

    public function update(Request $request, $id)
    {
        $data = Brand::findOrFail($this->decryptId($id));
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'featured_image' => ['nullable'],
            'status' => ['required'],
            'description' => ['nullable'],
        ]);
        try {
            DB::beginTransaction();
            $validated['slug'] = Str::slug($validated['name']);
            $data->update($validated);
            DB::commit();

            return redirect()->route('admin.brand.index')->with('success', 'Brand updated successfully');
        } catch (\Exception $th) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = Brand::findOrFail($this->decryptId($id));
        $data->delete();

        return redirect()
            ->route('admin.brand.index')
            ->with('success', 'Brand deleted successfully');
    }
}
