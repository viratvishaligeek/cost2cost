<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\OptionValue;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class OptionController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:options-browse')->only('index');
        $this->middleware('can:options-read')->only('show');
        $this->middleware('can:options-edit')->only('edit', 'update');
        $this->middleware('can:options-add')->only('store', 'create');
        $this->middleware('can:options-delete')->only('destroy');
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
        $pageName = 'Product Option List';
        if ($request->ajax()) {
            $query = Option::query();
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
                    $btn = '<div class="d-flex">';
                    if (Auth::user()->can('options-read') || Auth::user()->can('options-edit')) {
                        $btn .= '<a href="' . route('admin.options.show', $id) . '" class="btn btn-subtle-warning m-1 btn-sm"><span class="fas fa-eye"></span></a>';
                    }
                    if (Auth::user()->can('options-edit')) {
                        $btn .= '<a href="' . route('admin.options.edit', $id) . '" class="btn btn-subtle-primary m-1 btn-sm"><span class="fas fa-edit"></span></a>';
                    }
                    if (Auth::user()->can('options-delete')) {
                        $btn .= '<form method="POST" action="' . route('admin.options.destroy', $id) . '" class="m-0 p-0 delete-form">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-subtle-danger m-1 btn-sm confirm-button">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                        </form>';
                    }
                    $btn .= '</div>';

                    return $btn;
                })->rawColumns(['name', 'values', 'tenant', 'status', 'action'])->make(true);
        }

        return view('backend.options.index', compact('pageName'));
    }

    public function create()
    {
        $pageName = 'Create Product Option';

        return view('backend.options.create', compact('pageName'));
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

            return redirect()->route('admin.options.index')->with('success', 'Product Option created successfully');
        } catch (\Exception $th) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
        }
    }

    public function show($id)
    {
        $pageName = 'Product Option Detail';
        $data = Option::findOrFail($this->decryptId($id));

        return view('backend.options.show', [
            'pageName' => $pageName,
            'data' => $data,
        ]);
    }

    public function edit($id)
    {
        $pageName = 'Edit Product Option';
        $data = Option::findOrFail($this->decryptId($id));

        return view('backend.options.edit', compact('pageName', 'data'));
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

            return redirect()->route('admin.options.index')->with('success', 'Option updated successfully');
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
            ->route('admin.options.index')
            ->with('success', 'Option deleted successfully');
    }

    public function getOptionValues(Request $request)
    {
        $option = Option::find($request->id);
        $values = OptionValue::where('option_id', $request->id)->get();
        return response()->json(['status' => 1, 'option' => $option, 'values' => $values]);
    }
}
