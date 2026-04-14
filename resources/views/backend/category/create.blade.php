@extends('backend.include.layout')
@section('content')
    <h2 class="mb-4">{{ $pageName }}</h2>
    <form class="row mb-3" action="{{ route('admin.category.store') }}" method="post">
        @csrf
        <div class="col-xl-9">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-floating">
                        <input class="form-control" name="name" required value="{{ old('name') }}" type="text"
                            placeholder="Name" />
                        <label>Name</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <textarea name="description" class="form-control" id="description">{{ old('description') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-floating">
                        <select name="is_parent" class="form-control" id="isParentCat">
                            <option selected disabled> Select an Option</option>
                            <option value="no" {{ old('is_parent') == 'no' ? 'selected' : '' }}>No</option>
                            <option value="yes" {{ old('is_parent') == 'yes' ? 'selected' : '' }}>Yes</option>
                        </select>
                        <label>Is Parent Category ?</label>
                    </div>
                </div>
                <div class="col-12 d-none" id="catOption">
                    <div class="form-floating">
                        <select class="form-select" name="parent_id" required>
                            <option disabled selected>Select Category</option>
                            @foreach ($parent as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <label>Category</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <select class="form-select" name="status" required>
                            <option disabled selected>Select Status</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>In Active</option>
                        </select>
                        <label>Status</label>
                    </div>
                </div>
                <div class="col-12">
                    <label>Featured Image</label>
                    <div class="input-group">
                        <button id="featured" data-input="featured_thumbnail" data-preview="featured_holder"
                            class="btn btn-warning text-white" type="button">
                            <i class="fa fa-image"></i> Choose
                        </button>
                        <input id="featured_thumbnail" class="form-control" type="text" name="featured_image"
                            value="{{ old('featured_image') }}">
                    </div>
                </div>
                <div class="col-12" id="featured_holder"></div>
                <div class="col-12 text-end">
                    <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>
        </div>
    </form>
@endsection
@section('script')
    <script src="{{ URL::asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script src="{{ URL::asset('backend') }}/tinymce/tinymce.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#featured').filemanager('image');
            tinymce.init({
                selector: '#description',
                license_key: 'gpl',
                plugins: 'preview searchreplace autolink autosave save code fullscreen wordcount help charmap emoticons advlist directionality emoticons image importcss insertdatetime link lists media nonbreaking pagebreak preview save searchreplace table wordcount',
                menubar: true,
                toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image | table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
                autosave_ask_before_unload: true,
                autosave_interval: '30s',
                autosave_retention: '2m',
                height: 600,
                quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote',
                noneditable_class: 'mceNonEditable',
                toolbar_mode: 'sliding',
                contextmenu: 'link',
                branding: false,
                promotion: false,
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('#isParentCat').change(function() {
                if ($(this).val() === 'no') {
                    $('#catOption').removeClass('d-none');
                } else {
                    $('#catOption').addClass('d-none');
                }
            });
        });
    </script>
@endsection
