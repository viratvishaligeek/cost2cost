<?php

namespace App\Http\Controllers\Backend\AdvanceModule;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Yajra\DataTables\DataTables;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:role-browse')->only('index');
        $this->middleware('can:role-read')->only('show');
        $this->middleware('can:role-edit')->only('edit', 'update');
        $this->middleware('can:role-add')->only('store', 'create');
        $this->middleware('can:role-delete')->only('destroy');
    }

    private function decryptId($id)
    {
        try {
            return decrypt($id);
        } catch (DecryptException $e) {
            abort(404, 'Invalid Security Token');
        }
    }

    public function index(Request $request)
    {
        $pageName = 'Roles List';
        if ($request->ajax()) {
            $data = Role::orderBy('id', 'desc')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('name', function ($row) {
                    $name = '<p class="text-sm font-weight-bold mb-0 text-capitalize">' . $row->name . '</p>';
                    return $name;
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('d, M Y, H:i A') : 'N/A';
                })
                ->addColumn('action', function ($row) {
                    $id = encrypt($row->id);
                    $btn = '<div class="d-flex">';
                    if (Auth::user()->can('role-read') || Auth::user()->can('role-edit')) {
                        $btn .= '<a href="' . route('admin.role.show', $id) . '" class="btn btn-subtle-warning m-1 btn-sm"><span class="fas fa-eye"></span></a>';
                    }
                    if (Auth::user()->can('role-edit')) {
                        $btn .= '<a href="' . route('admin.role.edit', $id) . '" class="btn btn-subtle-primary m-1 btn-sm"><span class="fas fa-edit"></span></a>';
                    }
                    if (Auth::user()->can('role-delete')) {
                        $btn .= '<form method="POST" action="' . route('admin.role.destroy', $id) . '" class="m-0 p-0 delete-form">
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
                ->rawColumns(['name', 'role_for', 'created_at', 'action'])
                ->make(true);
        }

        return view('backend.role.index', compact('pageName'));
    }

    public function create()
    {
        $pageName = 'Create Role';
        $permission = Permission::where('guard_name', 'admin')->get();
        return view('backend.role.create', compact('pageName', 'permission'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:roles,name'],
        ]);
        try {
            DB::beginTransaction();
            Role::create([
                'name' => $validated['name'],
                'guard_name' => 'admin'
            ]);
            DB::commit();
            return redirect()->route('admin.role.index')->with('success', 'Role added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(Auth::user()->id . " /// Trying to Role Create Error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $e->getMessage());
        }
    }
    public function show($id)
    {
        $pageName = 'Role Details';
        $data = Role::findOrFail($this->decryptId($id));
        $permission = Permission::where('guard_name', $data->guard_name)->get();
        $rolePermissions = $data->permissions->pluck('id')->toArray();
        return view('backend.role.show', compact('pageName', 'data', 'rolePermissions', 'permission'));
    }

    public function edit($id)
    {
        $pageName = 'Role Details';
        $data = Role::findOrFail($this->decryptId($id));
        $permission = Permission::where('guard_name', $data->guard_name)->get();
        $rolePermissions = $data->permissions->pluck('id')->toArray();
        return view('backend.role.edit', compact('pageName', 'data', 'permission', 'rolePermissions'));
    }

    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($this->decryptId($id));
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100', 'unique:roles,name,' . $role->id],
        ]);
        try {
            DB::beginTransaction();
            $role->name = $validated['name'];
            $role->save();
            $permissionUpdate = $request->has('permission')
                ? array_map('intval', $request->permission)
                : [];
            $role->syncPermissions($permissionUpdate);
            DB::commit();
            return redirect(route('admin.role.index'))->with('success', 'Role updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(Auth::user()->id . " /// Trying to Role Update Error: " . $e->getMessage());
            return back()->with('error', 'Failed to update Role.');
        }
    }

    public function destroy($id)
    {
        try {
            $role = Role::findOrFail($this->decryptId($id));
            if ($role->name === 'superadmin') {
                return back()->with('error', 'Cannot delete superadmin role');
            }
            $role->delete();
            return redirect()->route('admin.role.index')->with('success', 'Role deleted successfully');
        } catch (\Exception $e) {
            Log::error(Auth::user()->id . " /// Trying to Role Delete Error: " . $e->getMessage());
            return back()->with('error', 'Deletion failed.');
        }
    }
}
