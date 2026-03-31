<?php

namespace App\Http\Controllers\Backend\Blogger;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BlogCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:blog_category-browse')->only('index');
        $this->middleware('can:blog_category-read')->only('show');
        $this->middleware('can:blog_category-edit')->only('edit', 'update');
        $this->middleware('can:blog_category-add')->only('store', 'create');
        $this->middleware('can:blog_category-delete')->only('destroy');
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
        $pageName = 'Blog Category List';
        if ($request->ajax()) {
            $query = BlogCategory::query();
            if (! $request->has('order')) {
                $query->latest();
            }

            return DataTables::eloquent($query)->addIndexColumn()->editColumn('name', function ($row) {
                return '<p class="text-sm font-weight-bold mb-0 text-capitalize">' . $row->name . '</p>';
            })->editColumn('tenant', function ($row) {
                return '<p class="text-sm mb-0 text-capitalize">' . $row->tenant->name ?? '' . '</p>';
            })->editColumn('post_count', function ($row) {
                return '<p class="text-sm mb-0 text-capitalize">' . $row->postsCount() . '</p>';
            })->editColumn('status', function ($row) {
                return GetStatusBadge($row->status);
            })->editColumn('created_at', function ($row) {
                return $row->created_at->format('d, M Y, H:i A');
            })->editColumn('action', function ($row) {
                $id = encrypt($row->id);
                $btn = '<div class="d-flex">';
                if (Auth::user()->can('blog_category-read') || Auth::user()->can('blog_category-edit')) {
                    $btn .= '<a href="' . route('admin.blog-category.show', $id) . '" class="btn btn-subtle-warning m-1 btn-sm"><span class="fas fa-eye"></span></a>';
                }
                if (Auth::user()->can('blog_category-edit')) {
                    $btn .= '<a href="' . route('admin.blog-category.edit', $id) . '" class="btn btn-subtle-primary m-1 btn-sm"><span class="fas fa-edit"></span></a>';
                }
                if (Auth::user()->can('blog_category-delete')) {
                    $btn .= '<form method="POST" action="' . route('admin.blog-category.destroy', $id) . '" class="m-0 p-0 delete-form">
                            ' . csrf_field() . '
                            ' . method_field('DELETE') . '
                            <button type="submit" class="btn btn-subtle-danger m-1 btn-sm confirm-button">
                                <i class="fa fa-trash text-danger"></i>
                            </button>
                        </form>';
                }
                $btn .= '</div>';

                return $btn;
            })->rawColumns(['name', 'tenant', 'post_count', 'status', 'action'])
                ->make(true);
        }

        return view('backend.blog-category.index', compact('pageName'));
    }

    public function create()
    {
        $pageName = 'Create Blog Category';

        return view('backend.blog-category.create', compact('pageName'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'featured_image' => ['nullable'],
            'status' => ['required'],
            'description' => ['nullable'],
        ]);
        try {
            DB::beginTransaction();
            $validated['slug'] = Str::slug($validated['name']);
            BlogCategory::create($validated);
            DB::commit();

            return redirect()->route('admin.blog-category.index')->with('success', 'Blog Category created successfully');
        } catch (\Exception $th) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
        }
    }

    public function show($id)
    {
        $pageName = 'Blog Category Details';
        $data = BlogCategory::findOrFail($this->decryptId($id));

        return view('backend.blog-category.show', [
            'pageName' => $pageName,
            'data' => $data,
        ]);
    }

    public function edit($id)
    {
        $pageName = 'Edit Blog Category';
        $data = BlogCategory::findOrFail($this->decryptId($id));

        return view('backend.blog-category.edit', [
            'pageName' => $pageName,
            'data' => $data,
        ]);
    }

    public function update(Request $request, $id)
    {
        $blogCat = BlogCategory::findOrFail($this->decryptId($id));
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'featured_image' => ['nullable'],
            'status' => ['required'],
            'description' => ['nullable'],
        ]);
        try {
            DB::beginTransaction();
            $validated['slug'] = Str::slug($validated['name']);
            $blogCat->update($validated);
            DB::commit();

            return redirect()->route('admin.blog-category.index')->with('success', 'Blog Category updated successfully');
        } catch (\Exception $th) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = BlogCategory::findOrFail($this->decryptId($id));
        $data->delete();

        return redirect()
            ->route('admin.blog-category.index')
            ->with('success', 'Blog Category deleted successfully');
    }
}
