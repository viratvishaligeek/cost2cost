<div style="text-align: right">
    <form method="POST" action="{{ route('admin.variant.destroy', encrypt($variant->id)) }}"
        class="m-0 p-0 delete-form d-inline">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-subtle-danger m-1 btn-sm confirm-button">
            <i class="fa fa-trash text-danger"></i> Delete this Variant
        </button>
    </form>
</div>
<form action="{{ route('admin.variant.update', encrypt($variant->id)) }}" method="POST">
    @csrf @method('PATCH')
    <div class="card shadow-none border border-warning-300">
        <div class="card-header bg-warning-soft d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Variant Details: <span class="text-danger">{{ $variant->combo }}</span></h4>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Variant Name (Unique)</label>
                    <input type="text" class="form-control" name="name" value="{{ $variant->name }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">SKU</label>
                    <input type="text" class="form-control" name="sku" value="{{ $variant->sku }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="active" {{ $variant->status == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $variant->status == 'inactive' ? 'selected' : '' }}>Inactive
                        </option>
                        <option value="draft" {{ $variant->status == 'draft' ? 'selected' : '' }}>Draft</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <label class="form-label">Base Price</label>
                    <input type="number" step="0.01" class="form-control" name="base_price"
                        value="{{ $variant->base_price }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">GST</label>
                    <input type="number" class="form-control" name="gst" value="{{ $variant->gst }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">MRP</label>
                    <input type="number" step="0.01" class="form-control" name="mrp"
                        value="{{ $variant->mrp }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Sell Price</label>
                    <input type="number" step="0.01" class="form-control" name="sell_price"
                        value="{{ $variant->sell_price }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Discount Value</label>
                    <input type="number" class="form-control" name="discount" value="{{ $variant->discount }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Stock Qty</label>
                    <input type="number" class="form-control" name="stock" value="{{ $variant->stock }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Low Stock Alert</label>
                    <input type="number" class="form-control" name="low_stock" value="{{ $variant->low_stock }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Min Order</label>
                    <input type="number" class="form-control" name="min_order" value="{{ $variant->min_order }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Max Order</label>
                    <input type="number" class="form-control" name="max_order" value="{{ $variant->max_order }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Weight (gms)</label>
                    <input type="number" class="form-control" name="weight" value="{{ $variant->weight }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Dimension</label>
                    <input type="text" class="form-control" name="dimension" value="{{ $variant->dimension }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">HSN Code</label>
                    <input type="text" class="form-control" name="hsn_code" value="{{ $variant->hsn_code }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Additional Details</label>
                    <textarea class="form-control tinymce-editor" name="additional_details">{{ $variant->additional_details }}</textarea>
                </div>
                <div class="col-12">
                    <label>Gallery Images</label>
                    <div class="input-group">
                        <button id="gallery" data-input="gallery_thumbnail" data-preview="gallery_holder"
                            class="btn btn-warning text-white" type="button">
                            <i class="fa fa-image"></i> Choose
                        </button>
                        <input id="gallery_thumbnail" class="form-control" type="text" name="gallery_image"
                            value="{{ old('gallery_image') }}">
                    </div>
                </div>
                <div id="gallery_holder" class="row mt-3 g-2"></div>
                <div class="col-12 mt-4 text-end">
                    <button type="submit" class="btn btn-warning btn-lg px-10">Update Variant:
                        {{ $variant->combo }}</button>
                </div>
            </div>
        </div>
    </div>
</form>
