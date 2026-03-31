<?php

namespace App\Http\Controllers\Backend\AdvanceModule;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\DataTables;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:team-browse')->only('index');
        $this->middleware('can:team-read')->only('show');
        $this->middleware('can:team-edit')->only('edit', 'update');
        $this->middleware('can:team-add')->only('store', 'create');
        $this->middleware('can:team-delete')->only('destroy');
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
        $pageName = 'Team List';
        if ($request->ajax()) {
            $query = Admin::where('id', '!=', 1);
            if (!$request->has('order')) {
                $query->latest();
            }
            return DataTables::of($query)
                ->addIndexColumn()
                ->editColumn('name', function ($row) {
                    return '<p class="text-sm font-weight-bold mb-0 text-capitalize">' . $row->name . '</p>';
                })
                ->editColumn('phone', function ($row) {
                    if (!$row->phone) return '***';
                    $lastFive = substr($row->phone, -5);
                    return '<p class="text-primary fw-bold">
                            <span class="fas fa-phone-alt me-1 fs-10"></span>***' . $lastFive . '
                        </p>';
                })
                ->editColumn('role', function ($row) {
                    return '<span class="badge badge-phoenix badge-phoenix-info">' . ($row->getRoleNames()->first() ?? 'N/A') . '</span>';
                })
                ->editColumn('status', function ($row) {
                    return GetStatusBadge($row->status);
                })
                ->editColumn('created_at', function ($row) {
                    return $row->created_at ? $row->created_at->format('d, M Y, H:i A') : 'N/A';
                })

                ->addColumn('action', function ($row) {
                    $id = encrypt($row->id);
                    $btn = '<div class="d-flex">';
                    if (Auth::user()->can('team-read') || Auth::user()->can('team-edit')) {
                        $btn .= '<a href="' . route('admin.team.show', $id) . '" class="btn btn-subtle-warning m-1 btn-sm"><span class="fas fa-eye"></span></a>';
                    }
                    if (Auth::user()->can('team-edit')) {
                        $btn .= '<a href="' . route('admin.team.edit', $id) . '" class="btn btn-subtle-primary m-1 btn-sm"><span class="fas fa-edit"></span></a>';
                    }
                    if (Auth::user()->can('team-delete')) {
                        $btn .= '<form method="POST" action="' . route('admin.team.destroy', $id) . '" class="m-0 p-0 delete-form">
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
                ->rawColumns(['name', 'phone', 'role', 'status', 'action'])
                ->make(true);
        }
        return view('backend.team.index', compact('pageName'));
    }

    public function create()
    {
        $pageName = 'Create Team';
        $tenants = TenantList();
        return view('backend.team.create', compact('pageName', 'tenants'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'string', 'max:50', 'email', 'unique:admins,email'],
            'phone'    => ['required', 'numeric', 'digits:10', 'unique:admins,phone'],
            'tenant_id'  => ['required', 'exists:tenants,id'],
            'status'   => ['required', 'in:active,inactive'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
        try {
            DB::beginTransaction();
            Admin::create($validated);
            DB::commit();
            return redirect()->route('admin.team.index')->with('success', 'Team member added successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(Auth::user()->id . " /// Trying to Team Create Error: " . $e->getMessage());
            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $pageName = 'Team Member Details';
        $team = Admin::findOrFail($this->decryptId($id));
        return view('backend.team.show', [
            'pageName' => $pageName,
            'data' => $team
        ]);
    }

    public function edit($id)
    {
        $pageName = 'Edit Team';
        $team = Admin::findOrFail($this->decryptId($id));
        $tenants = TenantList();

        return view('backend.team.edit', [
            'pageName' => $pageName,
            'data' => $team,
            'tenants' => $tenants
        ]);
    }

    public function update(Request $request, $id)
    {
        $team = Admin::findOrFail($this->decryptId($id));
        $validated = $request->validate([
            'name'     => ['required', 'string', 'max:100'],
            'email'    => ['required', 'string', 'max:50', 'email', 'unique:admins,email,' . $team->id],
            'phone'    => ['required', 'numeric', 'digits:10', 'unique:admins,phone,' . $team->id],
            'tenant_id'  => ['nullable'],
            'status'   => ['required', 'in:active,inactive'],
            'password' => ['nullable', 'string', 'min:6', 'confirmed'],
        ]);
        try {
            DB::beginTransaction();
            $data = $request->except('password');
            if ($request->filled('password')) {
                $data['password'] = Hash::make($request->password);
            }
            if (!$request->filled('tenant_id')) {
                $data['tenant_id'] = 0;
            }
            $team->update($data);
            DB::commit();
            return redirect()->route('admin.team.index')->with('success', 'Team updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(Auth::user()->id . " /// Trying to Team Update Error: " . $e->getMessage());
            return back()->with('error', 'Failed to update team member.');
        }
    }

    public function destroy($id)
    {
        try {
            $team = Admin::findOrFail($this->decryptId($id));
            if ($team->id == Auth::guard('admin')->user()->id || $team->id == 1) {
                return back()->with('error', 'Action not allowed.');
            }
            $team->delete();
            return redirect()->route('admin.team.index')->with('success', 'Member deleted successfully');
        } catch (\Exception $e) {
            Log::error(Auth::user()->id . " /// Trying to Team Delete Error: " . $e->getMessage());
            return back()->with('error', 'Deletion failed.');
        }
    }
}
