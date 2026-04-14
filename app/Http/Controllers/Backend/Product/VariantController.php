<?php

namespace App\Http\Controllers\Backend\Product;

use App\Http\Controllers\Controller;
use App\Models\Variant;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class VariantController extends Controller
{
    private function decryptId($id)
    {
        try {
            return decrypt($id);
        } catch (DecryptException $e) {
            abort(404);
        }
    }

    public function update(Request $request, $id)
    {
        $option = Variant::findOrFail($this->decryptId($id));
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'status' => ['required'],
        ]);
        try {
            DB::beginTransaction();
            $validated['slug'] = Str::slug($validated['name']);
            $option->update($validated);
            DB::commit();

            return redirect()->route('admin.product.index')->with('success', 'Product Variant updated successfully');
        } catch (\Exception $th) {
            DB::rollBack();
            return back()->withInput()->with('error', 'Something went wrong while saving data. ' . $th->getMessage());
        }
    }

    public function destroy($id)
    {
        $data = Variant::findOrFail($this->decryptId($id));
        $data->delete();
        return redirect()
            ->route('admin.product.index')
            ->with('success', 'Product Variant deleted successfully');
    }
}
