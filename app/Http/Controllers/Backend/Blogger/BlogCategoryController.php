<?php

namespace App\Http\Controllers\Backend\Blogger;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BlogCategoryController extends Controller
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
        $pageName = 'Blog Category List';
        if ($request->ajax()) {
            $query = BlogCategory::query();
            if (!$request->has('order')) {
                $query->latest();
            }
            return DataTables::eloquent($query)
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    return '<p class="text-sm font-weight-bold mb-0 text-capitalize">' . $row->name . '</p>';
                })
                ->editColumn('domain', function ($row) {
                    return '<a href="' . $row->domain . '" target="_blank">
                                <span class="fas fa-external-link-alt"></span>
                            </a>';
                })
                ->editColumn('status', function ($row) {
                    return GetStatusBadge($row->status);
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d, M Y, H:i A');
                })
                ->addColumn('action', function ($row) {
                    $id = encrypt($row->id);
                    return '
                    <div class="d-flex">
                        <a href="' . route('admin.tenant.show', $id) . '" class="btn btn-subtle-warning m-1 btn-sm">
                            <span class="fas fa-eye"></span>
                        </a>
                        <a href="' . route('admin.tenant.edit', $id) . '" class="btn btn-subtle-primary m-1 btn-sm">
                            <span class="fas fa-edit"></span>
                        </a>
                        <form method="POST" action="' . route('admin.tenant.destroy', $id) . '" class="m-0 p-0 delete-form">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-subtle-danger m-1 btn-sm confirm-button">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                        </form>
                    </div>';
                })
                ->rawColumns(['name', 'domain', 'status', 'action'])
                ->make(true);
        }
        return view('backend.tenant.index', compact('pageName'));
    }

    public function create()
    {
        $pageName = 'Create Tenant';
        return view('backend.tenant.create', compact('pageName'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:100'],
            'domain' => ['required', 'url', 'max:50', 'unique:tenants,domain'],
            'status' => ['required'],
            'notes'  => ['nullable', 'string', 'max:255']
        ]);
        BlogCategory::create($validated);
        return redirect()
            ->route('admin.tenant.index')
            ->with('success', 'Blog Category created successfully');
    }

    public function show($id)
    {
        $pageName = 'Blog Category Details';
        $tenant = BlogCategory::findOrFail($this->decryptId($id));
        return view('backend.tenant.show', [
            'pageName' => $pageName,
            'data' => $tenant
        ]);
    }

    public function edit($id)
    {
        $pageName = 'Edit Tenant';
        $tenant = BlogCategory::findOrFail($this->decryptId($id));
        return view('backend.tenant.edit', [
            'pageName' => $pageName,
            'data' => $tenant
        ]);
    }

    public function update(Request $request, $id)
    {
        $tenant = BlogCategory::findOrFail($this->decryptId($id));
        $validated = $request->validate([
            'name'   => ['required', 'string', 'max:100'],
            'domain' => ['required', 'url', 'max:50', 'unique:tenants,domain,' . $tenant->id],
            'status' => ['required'],
            'notes'  => ['nullable', 'string', 'max:255']
        ]);
        $tenant->update($validated);
        return redirect()
            ->route('admin.tenant.index')
            ->with('success', 'Blog Category updated successfully');
    }

    public function destroy($id)
    {
        $tenant = BlogCategory::findOrFail($this->decryptId($id));
        $tenant->delete();
        return redirect()
            ->route('admin.tenant.index')
            ->with('success', 'Blog Category deleted successfully');
    }
}
