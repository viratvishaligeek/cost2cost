<div class="modal modal-xl fade" id="addProductModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addProductModalLabel">Add Product</h5>
                <button class="btn btn-close p-1" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="row g-3 mb-6" action="{{ route('admin.product.store') }}" method="post">
                    @csrf
                    <div class="col-sm-4 col-md-4">
                        <div class="form-floating">
                            <input class="form-control" id="floatingInputGrid" name="name"
                                value="{{ old('name') }}" type="text" placeholder="name" required />
                            <label for="floatingInputGrid">Name</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="status" id="floatingSelectCategory">
                                <option selected="selected" disabled>Select Category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelectCategory">Category</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="status" id="floatingSelectSubCategory">
                                <option selected="selected" disabled>Select Category</option>
                                @foreach ($subCategories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelectSubCategory">Sub Category</label>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-floating">
                            <select class="form-select" name="brand_id" id="floatingSelectBrand">
                                <option selected="selected" disabled>Select Brand</option>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            <label for="floatingSelectBrand">Brands</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="form-floating">
                            <select class="form-select" name="status" id="floatingSelectPrivacy">
                                <option selected="selected" disabled>Select status</option>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>In
                                    Active
                                </option>
                            </select>
                            <label for="floatingSelectPrivacy">Status</label>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer"><button class="btn btn-primary" type="button">Okay</button>
                <button class="btn btn-outline-primary" type="button" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
