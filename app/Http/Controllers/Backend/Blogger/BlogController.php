<?php

namespace App\Http\Controllers\Backend\Blogger;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:blog-browse')->only('index');
        $this->middleware('can:blog-read')->only('show');
        $this->middleware('can:blog-edit')->only('edit', 'update');
        $this->middleware('can:blog-add')->only('store', 'create');
        $this->middleware('can:blog-delete')->only('destroy');
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
        $pageName = 'Blog List';
        if ($request->ajax()) {
            $query = Blog::query();
            if (! $request->has('order')) {
                $query->latest();
            }

            return DataTables::eloquent($query)->addIndexColumn()->editColumn('name', function ($row) {
                return '<p class="text-sm font-weight-bold mb-0 text-capitalize">' . $row->name . '</p>';
            })->editColumn('category', function ($row) {
                return '<p class="text-sm mb-0 text-capitalize">' . $row->category->name . '</p>';
            })->editColumn('tenant', function ($row) {
                return '<p class="text-sm mb-0 text-capitalize">' . $row->tenant->name . '</p>';
            })->editColumn('author', function ($row) {
                return '<p class="text-sm mb-0 text-capitalize">' . $row->author->name . '</p>';
            })->editColumn('publisher', function ($row) {
                return '<p class="text-sm mb-0 text-capitalize">' . $row->publisher->name . '</p>';
            })->editColumn('status', function ($row) {
                return GetStatusBadge($row->status);
            })->editColumn('created_at', function ($row) {
                return $row->created_at->format('d, M Y, H:i A');
            })->addColumn('action', function ($row) {
                $id = encrypt($row->id);
                $btn = '<div class="d-flex">';
                if (Auth::user()->can('blog-read') || Auth::user()->can('blog-edit')) {
                    $btn .= '<a href="' . route('admin.blog.show', $id) . '" class="btn btn-subtle-warning m-1 btn-sm"><span class="fas fa-eye"></span></a>';
                }
                if (Auth::user()->can('blog-edit')) {
                    $btn .= '<a href="' . route('admin.blog.edit', $id) . '" class="btn btn-subtle-primary m-1 btn-sm"><span class="fas fa-edit"></span></a>';
                }
                if (Auth::user()->can('blog-delete')) {
                    $btn .= '<form method="POST" action="' . route('admin.blog.destroy', $id) . '" class="m-0 p-0 delete-form">
                ' . csrf_field() . '
                ' . method_field('DELETE') . '
                <button type="submit" class="btn btn-subtle-danger m-1 btn-sm confirm-button">
                    <i class="fa fa-trash text-danger"></i>
                </button>
            </form>';
                }
                $btn .= '</div>';

                return $btn;
            })->rawColumns(['name', 'author', 'publisher', 'category', 'tenant', 'status', 'action'])->make(true);
        }

        return view('backend.blog.index', compact('pageName'));
    }

    public function create()
    {
        $pageName = 'Create Blog Post';
        $categories = BlogCategory::get();
        $authors = Admin::where('id', '!=', 1)->get();
        $publishers = Admin::where('id', '!=', 1)->get();

        return view('backend.blog.create', compact('pageName', 'categories', 'authors', 'publishers'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:blog_categories,id'],
            'author_id' => ['required', 'integer', 'exists:admins,id'],
            'publisher_id' => ['required', 'integer', 'exists:admins,id'],
            'featured_image' => ['nullable'],
            'status' => ['required'],
            'description' => ['nullable'],
            'tags' => ['nullable'],
            'publish_date' => ['required', 'date'],
        ]);
        try {
            DB::beginTransaction();
            $validated['slug'] = Str::slug($validated['name']);
            Blog::create($validated);
            DB::commit();

            return redirect()->route('admin.blog.index')->with('success', 'Blog created successfully');
        } catch (\Exception $th) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
        }
    }

    public function show($id)
    {
        $pageName = 'Blog Details';
        $data = Blog::findOrFail($this->decryptId($id));

        return view('backend.blog.show', [
            'pageName' => $pageName,
            'data' => $data,
        ]);
    }

    public function edit($id)
    {
        $pageName = 'Edit Blog Post';
        $data = Blog::findOrFail($this->decryptId($id));
        $categories = BlogCategory::get();
        $authors = Admin::where('id', '!=', 1)->get();
        $publishers = Admin::where('id', '!=', 1)->get();

        return view('backend.blog.edit', compact('pageName', 'data', 'categories', 'authors', 'publishers'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($this->decryptId($id));
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required', 'integer', 'exists:blog_categories,id'],
            'author_id' => ['required', 'integer', 'exists:admins,id'],
            'publisher_id' => ['required', 'integer', 'exists:admins,id'],
            'featured_image' => ['nullable'],
            'status' => ['required'],
            'description' => ['nullable'],
            'tags' => ['nullable'],
            'publish_date' => ['required', 'date'],
        ]);
        try {
            DB::beginTransaction();
            $validated['slug'] = Str::slug($validated['name']);
            $blog->update($validated);
            DB::commit();

            return redirect()->route('admin.blog.index')->with('success', 'Blog updated successfully');
        } catch (\Exception $th) {
            DB::rollBack();

            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = Blog::findOrFail($this->decryptId($id));
        $data->delete();

        return redirect()
            ->route('admin.blog.index')
            ->with('success', 'Blog deleted successfully');
    }
}
