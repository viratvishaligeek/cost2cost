<form action="{{ route('admin.product.update', encrypt($data->id)) }}" method="POST">
    @csrf @method('PATCH')
    <div class="container-fluid">
        <div class="row">
            <div class="col-9">
                <div class="card shadow-lg mb-4 border-0 rounded-3">
                    <div class="card-header bg-primary ">
                        <h5 class="mb-0 text-white"><i class="fa fa-info-circle me-2"></i>Master Information</h5>
                    </div>
                    <div class="card-body row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Product Name</label>
                            <input class="form-control" name="name" value="{{ old('name') ?? $data->name }}"
                                type="text" required />
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Brand</label>
                            <select class="form-select" name="brand_id">
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}"
                                        {{ (old('brand_id') ?? $data->brand_id) == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Origin</label>
                            <input class="form-control" name="origin" value="{{ old('origin') ?? $data->origin }}"
                                type="text" />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="category_id" id="floatingSelectCategory">
                                @foreach ($categories as $cat)
                                    <option value="{{ $cat->id }}"
                                        {{ (old('category_id') ?? $data->category_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Sub Category</label>
                            <select class="form-select" name="sub_category_id" id="floatingSelectSubCategory">
                                <option selected disabled>Select Sub Category</option>
                                @foreach ($subCategories as $sub_cat)
                                    <option value="{{ $sub_cat->id }}"
                                        {{ (old('sub_category_id') ?? $data->sub_category_id) == $sub_cat->id ? 'selected' : '' }}>
                                        {{ $sub_cat->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status">
                                <option value="active"
                                    {{ (old('status') ?? $data->status) == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive"
                                    {{ (old('status') ?? $data->status) == 'inactive' ? 'selected' : '' }}>Inactive
                                </option>
                                <option value="draft"
                                    {{ (old('status') ?? $data->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="card shadow-lg mb-4 border-0 rounded-3">
                    <div class="card-header bg-dark ">
                        <h5 class="text-white"><i class="fa fa-align-left me-2"></i>Description & Tags</h5>
                    </div>
                    <div class="card-body row g-3">
                        <div class="col-12">
                            <label class="form-label">Tags</label>
                            <textarea class="form-control" name="tags" rows="2">{{ old('tags') ?? $data->tags }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Short Description</label>
                            <textarea class="form-control tinymce-editor" name="short_description">{{ old('short_description') ?? $data->short_description }}</textarea>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Full Description</label>
                            <textarea class="form-control tinymce-editor" name="description">{{ old('description') ?? $data->description }}</textarea>
                        </div>
                    </div>
                </div>
                @if ($data->has_variation == 'no')
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
                                value="{{ old('custom_table', $data->custom_table ?? '') }}">
                        </div>
                    </div>
                @endif
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
            </div>
            <div class="col-3">
                <div class="card shadow-lg mb-4 border-0 rounded-3">
                    @if ($data->has_variation == 'no')
                        <div class="card-header bg-success">
                            <h5 class="text-white"><i class="fa fa-rupee-sign me-2"></i>Pricing & Inventory</h5>
                        </div>
                        <div class="card-body row g-3">
                            <div class="col-md-12">
                                <label class="form-label">Base Price</label>
                                <input type="number" step="0.01" class="form-control" name="base_price"
                                    value="{{ old('base_price') ?? $data->base_price }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">MRP</label>
                                <input type="number" step="0.01" class="form-control" name="mrp"
                                    value="{{ old('mrp') ?? $data->mrp }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">GST</label>
                                <input type="number" class="form-control" name="gst"
                                    value="{{ old('gst') ?? $data->gst }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Discount Type</label>
                                <select class="form-select" name="discount_type">
                                    <option value="fixed"
                                        {{ (old('discount_type') ?? $data->discount_type) == 'fixed' ? 'selected' : '' }}>
                                        Fixed
                                    </option>
                                    <option value="percentage"
                                        {{ (old('discount_type') ?? $data->discount_type) == 'percentage' ? 'selected' : '' }}>
                                        Percentage</option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Discount Value</label>
                                <input type="number" class="form-control" name="discount"
                                    value="{{ old('discount') ?? $data->discount }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Sell Price</label>
                                <input type="number" step="0.01" class="form-control" name="sell_price"
                                    value="{{ old('sell_price') ?? $data->sell_price }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">SKU</label>
                                <input type="text" class="form-control" name="sku"
                                    value="{{ old('sku') ?? $data->sku }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">HSN Code</label>
                                <input type="text" class="form-control" name="hsn_code"
                                    value="{{ old('hsn_code') ?? $data->hsn_code }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Bar Code</label>
                                <input type="text" class="form-control" name="bar_code"
                                    value="{{ old('bar_code') ?? $data->bar_code }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Weight</label>
                                <input type="text" class="form-control" name="weight"
                                    value="{{ old('weight') ?? $data->weight }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Dimension</label>
                                <input type="text" class="form-control" name="dimension"
                                    value="{{ old('dimension') ?? $data->dimension }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Refundable</label>
                                <select class="form-select" name="refundable">
                                    <option value="no"
                                        {{ (old('refundable') ?? $data->refundable) == 'no' ? 'selected' : '' }}>No
                                    </option>
                                    <option value="yes"
                                        {{ (old('refundable') ?? $data->refundable) == 'yes' ? 'selected' : '' }}>Yes
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Refund Limit ( In Days)</label>
                                <input type="text" class="form-control" name="refund_limit"
                                    value="{{ old('refund_limit') ?? $data->refund_limit }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Current Stock</label>
                                <input type="number" class="form-control" name="stock"
                                    value="{{ old('stock') ?? $data->stock }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Stock Status</label>
                                <select class="form-select" name="stock_status">
                                    <option value="in_stock"
                                        {{ (old('stock_status') ?? $data->stock_status) == 'in_stock' ? 'selected' : '' }}>
                                        In Stock
                                    </option>
                                    <option value="out_of_stock"
                                        {{ (old('stock_status') ?? $data->stock_status) == 'out_of_stock' ? 'selected' : '' }}>
                                        Out of Stock</option>
                                    <option value="low_stock"
                                        {{ (old('stock_status') ?? $data->stock_status) == 'low_stock' ? 'selected' : '' }}>
                                        Low Stock
                                    </option>
                                </select>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Low Stock</label>
                                <input type="number" class="form-control" name="low_stock"
                                    value="{{ old('low_stock') ?? $data->low_stock }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Min Order</label>
                                <input type="number" class="form-control" name="min_order"
                                    value="{{ old('min_order') ?? $data->min_order }}">
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Max Order</label>
                                <input type="number" class="form-control" name="max_order"
                                    value="{{ old('max_order') ?? $data->max_order }}">
                            </div>
                            <div class="col-md-12 form-check">
                                <input class="form-check-input" name="top_product" id="flexChecktopProduct"
                                    type="checkbox" value="1"
                                    {{ old('top_product', $data->top_product) ? 'checked' : '' }} />
                                <label class="form-check-label" for="flexChecktopProduct">Top Product</label>
                            </div>
                            <div class="col-md-12 form-check">
                                <input class="form-check-input" name="featured_product" id="flexCheckfeaturedProduct"
                                    type="checkbox" value="1"
                                    {{ old('top_product', $data->featured_product) ? 'checked' : '' }} />
                                <label class="form-check-label" for="flexCheckfeaturedProduct">Featured
                                    Product</label>
                            </div>
                        </div>
                    @endif
                    <div class="card-footer">
                        <div class="col-12 mt-4 text-center">
                            <a href="{{ route('admin.product.index') }}"
                                class="btn btn-phoenix-primary px-5 btn-sm">Cancel</a>
                            <button type="submit" class="btn btn-success btn-sm">Update Master Data</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
