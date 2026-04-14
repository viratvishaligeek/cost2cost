<style>
    .option-card {
        border: 2px solid #e3e6ed;
        border-radius: 10px;
        padding: 15px;
        transition: all 0.3s ease;
        background: #f9fbfd;
    }

    .variant-badge {
        background: #eef2f6;
        padding: 8px 15px;
        border-radius: 30px;
        display: inline-block;
        margin: 5px;
        border: 1px solid #d1d9e6;
        font-weight: 600;
        color: #344050;
    }

    .remove-variant {
        cursor: pointer;
        color: #ff5050;
        margin-left: 10px;
    }

    .section-title {
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        color: #8a94ad;
        font-weight: 700;
        margin-bottom: 15px;
        display: block;
        border-bottom: 1px solid #eee;
        padding-bottom: 5px;
    }

    .select2-container--bootstrap4 .select2-selection--multiple {
        border-radius: 8px !important;
        border: 1px solid #d1d9e6 !important;
    }

    /* ------------ */
    .custom-option-check:hover {
        background: #f0f4f8;
    }

    .value-card {
        border: 1px solid #e3e6ed;
        border-radius: 8px;
        padding: 10px;
        background: #fff;
    }

    .variant-badge {
        background: #3874ff;
        color: #fff;
        padding: 6px 14px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        font-size: 13px;
    }

    .remove-variant {
        cursor: pointer;
        margin-left: 8px;
        opacity: 0.8;
    }

    .remove-variant:hover {
        opacity: 1;
    }

    .cursor-pointer {
        cursor: pointer;
    }
</style>

<div class="modal modal-xl fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-light">
                <h5 class="modal-title text-primary" id="addProductModalLabel">
                    <i class="fas fa-shopping-bag me-2"></i>Initialize New Product
                </h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-5">
                <form action="{{ route('admin.product.store') }}" method="post" id="productForm">
                    @csrf

                    <span class="section-title">Step 1: Core Identification</span>
                    <div class="row g-3 mb-5">
                        <div class="col-md-6">
                            <div class="form-floating">
                                <input class="form-control" name="name" type="text" placeholder="name" required />
                                <label>Product Master Name</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-select" name="category_id" id="floatingSelectCategory" required>
                                    <option selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                <label>Primary Category</label>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-floating">
                                <select class="form-select" name="sub_category_id" id="floatingSelectSubCategory">
                                    <option selected disabled>Choose Sub Category</option>
                                </select>
                                <label>Sub Category</label>
                            </div>
                        </div>
                    </div>

                    <span class="section-title">Step 2: Brand & Logic</span>
                    <div class="row g-3 mb-5">
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" name="brand_id" id="floatingSelectBrand" required>
                                    <option selected disabled>Select Brand</option>
                                    @foreach ($brands as $brand)
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                    @endforeach
                                </select>
                                <label>Brand</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" name="status" required>
                                    <option value="active">Active (Visible)</option>
                                    <option value="inactive">Inactive (Hidden)</option>
                                    <option value="draft" selected>Draft (Internal)</option>
                                </select>
                                <label>Initial Status</label>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-floating">
                                <select class="form-select" name="has_variation" id="floatingHasVariation" required>
                                    <option value="no">Single Product (No Variants)</option>
                                    <option value="yes">Variable Product (Multiple Variants)</option>
                                </select>
                                <label>Product Type</label>
                            </div>
                        </div>
                    </div>
                    <div id="variationEngine" style="display: none;">
                        <span class="section-title text-info">Step 3: Variation Configuration</span>

                        <div class="row g-3">
                            <div class="col-md-4">
                                <div class="card shadow-none border">
                                    <div class="card-header bg-light py-2">
                                        <h6 class="mb-0">Select Attributes</h6>
                                    </div>
                                    <div class="card-body p-2">
                                        @foreach ($options as $opty)
                                            <div class="form-check custom-option-check p-2 mb-1 rounded">
                                                <input class="form-check-input attr-checkbox" type="checkbox"
                                                    id="attr_{{ $opty->id }}" value="{{ $opty->id }}"
                                                    data-name="{{ $opty->name }}">
                                                <label class="form-check-label fw-bold cursor-pointer"
                                                    for="attr_{{ $opty->id }}">
                                                    {{ $opty->name }}
                                                </label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div id="values-wrapper" class="row g-2">
                                    <div class="col-12 text-center py-5 text-muted" id="placeholder-text">
                                        <i class="fas fa-arrow-left me-2"></i> Select an attribute to see values
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-center mt-4 border-top pt-3">
                            <button class="btn btn-phoenix-primary rounded-pill px-5" id="generate-variants"
                                type="button">
                                <i class="fas fa-layer-group me-2"></i>Generate Combinations
                            </button>
                        </div>

                        <div id="variants-container" class="mt-4 d-flex flex-wrap gap-2">
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer bg-light">
                <button class="btn btn-link text-danger" type="button" data-bs-dismiss="modal">Discard</button>
                <button class="btn btn-primary px-6" form="productForm" type="submit">
                    Create Product <i class="fas fa-arrow-right ms-2"></i>
                </button>
            </div>
        </div>
    </div>
</div>
