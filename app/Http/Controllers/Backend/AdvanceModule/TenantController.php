<?php

namespace App\Http\Controllers\Backend\AdvanceModule;

use App\Http\Controllers\Controller;
use App\Models\Tenant;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class TenantController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:tenant-browse')->only('index');
        $this->middleware('can:tenant-read')->only('show');
        $this->middleware('can:tenant-edit')->only('edit', 'update');
        $this->middleware('can:tenant-add')->only('store', 'create');
        $this->middleware('can:tenant-delete')->only('destroy');
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
        $pageName = 'Tenant List';
        if ($request->ajax()) {
            $query = Tenant::query();
            if (! $request->has('order')) {
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
                    $btn = '<div class="d-flex">';
                    if (Auth::user()->can('tenant-read') || Auth::user()->can('tenant-edit')) {
                        $btn .= '<a href="' . route('admin.tenant.show', $id) . '" class="btn btn-subtle-warning m-1 btn-sm"><span class="fas fa-eye"></span></a>';
                    }
                    if (Auth::user()->can('tenant-edit')) {
                        $btn .= '<a href="' . route('admin.tenant.edit', $id) . '" class="btn btn-subtle-primary m-1 btn-sm"><span class="fas fa-edit"></span></a>';
                    }
                    if (Auth::user()->can('tenant-delete')) {
                        $btn .= '<form method="POST" action="' . route('admin.tenant.destroy', $id) . '" class="m-0 p-0 delete-form">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-subtle-danger m-1 btn-sm confirm-button">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                        </form>';
                    }
                    $btn .= '</div>';

                    return $btn;
                })
                ->rawColumns(['name', 'domain', 'status', 'action'])
                ->make(true);
        }

        return view('backend.tenant.index', compact('pageName'));
    }

    public function create()
    {
        $pageName = 'Create Tenant';
        if (! Auth::user()->can('tenant-add')) {
            return redirect()
                ->route('admin.tenant.index')
                ->with('error', 'Action not allowed.');
        }

        return view('backend.tenant.create', compact('pageName'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'domain' => ['required', 'url', 'max:50', 'unique:tenants,domain'],
            'status' => ['required'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);
        Tenant::create($validated);

        return redirect()
            ->route('admin.tenant.index')
            ->with('success', 'Tenant created successfully');
    }

    public function show($id)
    {
        $pageName = 'Tenant Details';
        $tenant = Tenant::findOrFail($this->decryptId($id));

        return view('backend.tenant.show', [
            'pageName' => $pageName,
            'data' => $tenant,
        ]);
    }

    public function edit($id)
    {
        $pageName = 'Edit Tenant';
        $tenant = Tenant::findOrFail($this->decryptId($id));

        return view('backend.tenant.edit', [
            'pageName' => $pageName,
            'data' => $tenant,
        ]);
    }

    public function update(Request $request, $id)
    {
        $tenant = Tenant::findOrFail($this->decryptId($id));
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'domain' => ['required', 'url', 'max:50', 'unique:tenants,domain,' . $tenant->id],
            'status' => ['required'],
            'notes' => ['nullable', 'string', 'max:255'],
        ]);
        $tenant->update($validated);

        return redirect()
            ->route('admin.tenant.index')
            ->with('success', 'Tenant updated successfully');
    }

    public function destroy($id)
    {
        $tenant = Tenant::findOrFail($this->decryptId($id));
        $tenant->delete();

        return redirect()
            ->route('admin.tenant.index')
            ->with('success', 'Tenant deleted successfully');
    }
}
