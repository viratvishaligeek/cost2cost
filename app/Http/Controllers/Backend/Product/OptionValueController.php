<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\OptionValue;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class OptionValueController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:option_value-browse')->only('index');
        $this->middleware('can:option_value-read')->only('show');
        $this->middleware('can:option_value-edit')->only('edit', 'update');
        $this->middleware('can:option_value-add')->only('store', 'create');
        $this->middleware('can:option_value-delete')->only('destroy');
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
        $pageName = 'Options Value List';
        if ($request->ajax()) {
            $query = OptionValue::query();
            if (! $request->has('order')) {
                $query->latest();
            }
            return DataTables::eloquent($query)
                ->addIndexColumn()->editColumn('name', function ($row) {
                    return '<p class="text-sm font-weight-bold mb-0 text-capitalize">' . $row->name . '</p>';
                })->editColumn('option', function ($row) {
                    return '<p class="text-sm mb-0 text-capitalize">' . $row->option->name . '</p>';
                })->editColumn('status', function ($row) {
                    return GetStatusBadge($row->status);
                })->editColumn('created_at', function ($row) {
                    return $row->created_at->format('d, M Y, H:i A');
                })->addColumn('action', function ($row) {
                    $id = encrypt($row->id);
                    $btn = '<div class="d-flex">';
                    if (Auth::user()->can('option_value-edit')) {
                        $btn .= '<a href="' . route('admin.option-value.edit', $id) . '" class="btn btn-subtle-primary m-1 btn-sm"><span class="fas fa-edit"></span></a>';
                    }
                    if (Auth::user()->can('option_value-delete')) {
                        $btn .= '<form method="POST" action="' . route('admin.option-value.destroy', $id) . '" class="m-0 p-0 delete-form">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-subtle-danger m-1 btn-sm confirm-button">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                        </form>';
                    }
                    $btn .= '</div>';

                    return $btn;
                })->rawColumns(['name', 'option', 'status', 'action'])->make(true);
        }

        return view('backend.option-value.index', compact('pageName'));
    }

    public function create()
    {
        $pageName = 'Create Option Value';
        $options = Option::get();

        return view('backend.option-value.create', compact('pageName', 'options'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'option_id' => ['required', 'integer', 'exists:options,id'],
        ]);
        try {
            DB::beginTransaction();
            OptionValue::create($validated);
            DB::commit();

            return redirect()->route('admin.option-value.index')->with('success', 'Option Value created successfully');
        } catch (\Exception $th) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
        }
    }

    public function show($id)
    {
        return back()->with('error', 'Not Allowes');
    }

    public function edit($id)
    {
        $pageName = 'Edit Option Value';
        $data = OptionValue::findOrFail($this->decryptId($id));
        $options = Option::get();

        return view('backend.option-value.edit', compact('pageName', 'data', 'options'));
    }

    public function update(Request $request, $id)
    {
        $data = OptionValue::findOrFail($this->decryptId($id));
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'option_id' => ['required', 'integer', 'exists:options,id'],
        ]);
        try {
            DB::beginTransaction();
            $data->update($validated);
            DB::commit();

            return redirect()->route('admin.option-value.index')->with('success', 'Option Value updated successfully');
        } catch (\Exception $th) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = OptionValue::findOrFail($this->decryptId($id));
        $data->delete();

        return redirect()
            ->route('admin.option-value.index')
            ->with('success', 'Option Value deleted successfully');
    }
}
