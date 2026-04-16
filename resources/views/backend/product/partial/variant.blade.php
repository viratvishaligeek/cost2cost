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
            <h4 class="mb-0">Variant Details: <span class="text-danger">{{ $variant->combo }}</span>
            </h4>
        </div>
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <label class="form-label">Variant Name (Unique)</label>
                    <input type="text" class="form-control" name="name"
                        value="{{ old('name') ?? $variant->name }}" required>
                </div>
                <div class="col-md-3">
                    <label class="form-label">SKU</label>
                    <input type="text" class="form-control" name="sku" value="{{ old('sku') ?? $variant->sku }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Status</label>
                    <select class="form-select" name="status">
                        <option value="active" {{ (old('status') ?? $variant->status) == 'active' ? 'selected' : '' }}>
                            Active</option>
                        <option value="inactive"
                            {{ (old('status') ?? $variant->status) == 'inactive' ? 'selected' : '' }}>Inactive
                        </option>
                        <option value="draft" {{ (old('status') ?? $variant->status) == 'draft' ? 'selected' : '' }}>
                            Draft</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="form-label">Base Price</label>
                    <input type="number" step="0.01" class="form-control" name="base_price"
                        value="{{ old('base_price') ?? $variant->base_price }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">GST</label>
                    <input type="number" class="form-control" name="gst" value="{{ old('gst') ?? $variant->gst }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">MRP</label>
                    <input type="number" step="0.01" class="form-control" name="mrp"
                        value="{{ old('mrp') ?? $variant->mrp }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Sell Price</label>
                    <input type="number" step="0.01" class="form-control" name="sell_price"
                        value="{{ old('sell_price') ?? $variant->sell_price }}">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Discount Type</label>
                    <select class="form-select" name="discount_type">
                        <option value="fixed"
                            {{ (old('discount_type') ?? $variant->discount_type) == 'fixed' ? 'selected' : '' }}>
                            Fixed
                        </option>
                        <option value="percentage"
                            {{ (old('discount_type') ?? $variant->discount_type) == 'percentage' ? 'selected' : '' }}>
                            Percentage</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="form-label">Discount Value</label>
                    <input type="number" class="form-control" name="discount"
                        value="{{ old('discount') ?? $variant->discount }}">
                </div>

                <div class="col-md-3">
                    <label class="form-label">Stock Qty</label>
                    <input type="number" class="form-control" name="stock"
                        value="{{ old('stock') ?? $variant->stock }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Low Stock Alert</label>
                    <input type="number" class="form-control" name="low_stock"
                        value="{{ old('low_stock') ?? $variant->low_stock }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Min Order</label>
                    <input type="number" class="form-control" name="min_order"
                        value="{{ old('min_order') ?? $variant->min_order }}">
                </div>
                <div class="col-md-3">
                    <label class="form-label">Max Order</label>
                    <input type="number" class="form-control" name="max_order"
                        value="{{ old('max_order') ?? $variant->max_order }}">
                </div>

                <div class="col-md-4">
                    <label class="form-label">Weight (gms)</label>
                    <input type="number" class="form-control" name="weight"
                        value="{{ old('weight') ?? $variant->weight }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Dimension</label>
                    <input type="text" class="form-control" name="dimension"
                        value="{{ old('dimension') ?? $variant->dimension }}">
                </div>
                <div class="col-md-4">
                    <label class="form-label">HSN Code</label>
                    <input type="text" class="form-control" name="hsn_code"
                        value="{{ old('hsn_code') ?? $variant->hsn_code }}">
                </div>
                <div class="col-12">
                    <label class="form-label">Additional Details</label>
                    <textarea class="form-control tinymce-editor" name="additional_details">{{ old('additional_details') ?? $variant->additional_details }}</textarea>
                </div>
                <div class="card shadow-lg mb-4 border-0 rounded-3">
                    <div class="card-header bg-warning">
                        <h5 class="text-white"><i class="fa fa-image me-2"></i>Images & Gallery</h5>
                    </div>
                    <div class="card-body row g-3">
                        <div class="col-8">
                            <label>Featured Image</label>
                            <div class="input-group">
                                <button id="featured" data-input="featured_thumbnail" data-preview="featured_holder"
                                    class="btn btn-warning text-white" type="button">
                                    <i class="fa fa-image"></i> Choose
                                </button>
                                <input id="featured_thumbnail" class="form-control" type="text"
                                    name="featured_image"
                                    value="{{ old('featured_image', $images?->featured_image) }}">
                            </div>
                        </div>
                        <div class="col-4">
                            <style>
                                #featured_holder img {
                                    height: 100% !important;
                                    width: 40% !important;
                                    border: 1px black solid;
                                    border-radius: 12px;
                                }
                            </style>
                            <div id="featured_holder" class="mt-2"></div>
                        </div>
                        {{-- ---------------------------------------------------- --}}
                        <div class="col-12">
                            <label>Gallery Images</label>
                            <div class="input-group">
                                <button id="gallery" data-input="gallery_thumbnail" data-preview="gallery_holder"
                                    class="btn btn-warning text-white" type="button">
                                    <i class="fa fa-image"></i> Choose
                                </button>
                                <input id="gallery_thumbnail" class="form-control" type="text"
                                    name="gallery_image" value="{{ old('gallery_image', $images?->gallery) }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <style>
                                #gallery_holder img {
                                    height: 100% !important;
                                    width: 100px !important;
                                    border: 1px black solid;
                                    margin: 10px;
                                    padding: 10px;
                                    border-radius: 12px;
                                }
                            </style>
                            <div id="gallery_holder" class="row mt-3 g-2"></div>
                        </div>
                        {{-- ---------------------------------------------- --}}
                        <div class="col-12">
                            <label>LifeStyles Images</label>
                            <div class="input-group">
                                <button id="lifestyle" data-input="lifestyle_thumbnail"
                                    data-preview="lifestyle_holder" class="btn btn-warning text-white"
                                    type="button">
                                    <i class="fa fa-image"></i> Choose
                                </button>
                                <input id="lifestyle_thumbnail" class="form-control" type="text" name="lifestyle"
                                    value="{{ old('lifestyle', $images?->lifestyle) }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <style>
                                #lifestyle_holder img {
                                    height: 100% !important;
                                    width: 100px !important;
                                    border: 1px black solid;
                                    margin: 10px;
                                    padding: 10px;
                                    border-radius: 12px;
                                }
                            </style>
                            <div id="lifestyle_holder" class="row mt-3 g-2"></div>
                        </div>
                        {{-- ---------------------------------------------------------- --}}
                        <div class="col-12">
                            <label>Infographics Images</label>
                            <div class="input-group">
                                <button id="infographics" data-input="infographics_thumbnail"
                                    data-preview="infographics_holder" class="btn btn-warning text-white"
                                    type="button">
                                    <i class="fa fa-image"></i> Choose
                                </button>
                                <input id="infographics_thumbnail" class="form-control" type="text"
                                    name="infographics" value="{{ old('infographics', $images?->infographics) }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <style>
                                #infographics_holder img {
                                    height: 100% !important;
                                    width: 100px !important;
                                    border: 1px black solid;
                                    margin: 10px;
                                    padding: 10px;
                                    border-radius: 12px;
                                }
                            </style>
                            <div id="infographics_holder" class="row mt-3 g-2"></div>
                        </div>
                        <div class="col-12">
                            <label>Video URL only ( Coma Saperated )</label>
                            <div class="input-group">
                                <input class="form-control" type="text" name="video"
                                    value="{{ old('video', $images?->video) }}"
                                    placeholder="https://video.com,https://anothervideo.com">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-lg mb-4 border-0 rounded-3">
                    <div class="card-header bg-info">
                        <h5 class="text-white">
                            <i class="fa fa-table me-2"></i>Specification Table
                        </h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered" id="specTable">
                            <thead>
                                <tr>
                                    <th style="width: 45%">Title</th>
                                    <th style="width: 45%">Value</th>
                                    <th style="width: 10%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="default-row">
                                    <td><input type="text" class="form-control spec-key"
                                            placeholder="e.g. Weight"></td>
                                    <td><input type="text" class="form-control spec-value"
                                            placeholder="e.g. 500g"></td>
                                    <td>
                                        <button type="button" class="btn btn-danger btn-sm removeRow">X</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <button type="button" class="btn btn-primary btn-sm" id="addRow">+ Add Row</button>
                        <input type="hidden" name="custom_table" id="custom_table"
                            value="{{ old('custom_table', $variant->custom_table ?? '') }}">
                    </div>
                </div>
                <div class="col-12 mt-4 text-end">
                    <button type="submit" class="btn btn-warning btn-lg px-10">Update Variant:
                        {{ $variant->combo }}</button>
                </div>
            </div>
        </div>
    </div>
</form>
