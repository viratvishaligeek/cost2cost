@extends('backend.include.layout')
@section('content')
    <h2 class="mb-4">{{ $pageName }}</h2>
    <form class="row mb-3" action="{{ route('admin.blog.store') }}" method="post">
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
                <style>
                    .tag-container {
                        display: flex;
                        flex-wrap: wrap;
                        border: 1px solid #ccc;
                        padding: 5px;
                        width: 300px;
                    }

                    .tag {
                        background: #007bff;
                        color: white;
                        padding: 5px 10px;
                        margin: 3px;
                        border-radius: 15px;
                        display: flex;
                        align-items: center;
                    }

                    .tag span {
                        margin-left: 8px;
                        cursor: pointer;
                    }

                    input {
                        border: none;
                        outline: none;
                        flex: 1;
                        padding: 5px;
                    }
                </style>
                <div class="col-12">
                    <div class="form-floating">
                        <label class="form-label">Tags</label>
                        <div class="form-control d-flex flex-wrap gap-2" id="tagBox">
                            <input type="text" id="tagInput" class="border-0 flex-grow-1" style="min"
                                placeholder="Type tag and press comma" style="outline:none;" value="" />
                        </div>
                    </div>
                    <input type="hidden" name="tags" id="hiddenTags" />
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-floating">
                        <input type="date" class="form-control" name="publish_date" required
                            value="{{ old('publish_date') ?? date('Y-m-d') }}" />
                        <label>Publish Date</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <select class="form-select" name="category_id" required>
                            <option disabled selected>Select Category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        <label>Category</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <select class="form-select" name="author_id" required>
                            <option disabled selected>Select Author</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>
                                    {{ $author->name }}
                                </option>
                            @endforeach
                        </select>
                        <label>Author</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <select class="form-select" name="publisher_id" required>
                            <option disabled selected>Select Publisher</option>
                            @foreach ($publishers as $publisher)
                                <option value="{{ $publisher->id }}"
                                    {{ old('publisher_id') == $publisher->id ? 'selected' : '' }}>
                                    {{ $publisher->name }}
                                </option>
                            @endforeach
                        </select>
                        <label>Publisher</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <select class="form-select" name="status" required>
                            <option disabled selected>Select Status</option>
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published
                            </option>
                            <option value="archived" {{ old('status') == 'archived' ? 'selected' : '' }}>Archived</option>
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
                    <a href="{{ route('admin.blog.index') }}" class="btn btn-secondary">Cancel</a>
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
                toolbar: "undo redo | accordion accordionremove | blocks fontfamily fontsize | bold italic underline strikethrough | align numlist bullist | link image |  table media | lineheight outdent indent| forecolor backcolor removeformat | charmap emoticons | code fullscreen preview | save print | pagebreak anchor codesample | ltr rtl",
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
            let oldTags = "{{ old('tags') }}";
            let tags = oldTags ? oldTags.split(',') : [];

            function renderTags() {
                $("#tagBox .badge").remove();
                tags.forEach(function(value) {
                    let tag = $(`
                <span class="badge bg-primary d-flex align-items-center" style="padding:6px 10px;">
                ${value}
                <span class="remove-tag" style="margin-left:8px;cursor:pointer;">&times;</span>
                </span>
            `);
                    tag.find(".remove-tag").on("click", function() {
                        tags = tags.filter(t => t !== value.toLowerCase());
                        tag.remove();
                        updateHidden();
                    });
                    $("#tagInput").before(tag);
                });
                updateHidden();
            }
            renderTags();
            $("#tagInput").on("keydown", function(e) {
                if (e.key === ",") {
                    e.preventDefault();
                    let value = $(this).val().trim();
                    value = value.replace(/\s+/g, "");
                    if (value === "") return;
                    if (tags.includes(value.toLowerCase())) {
                        $(this).val("");
                        return;
                    }
                    tags.push(value.toLowerCase());
                    let tag = $(`
                        <span class="badge bg-primary d-flex align-items-center" style="padding:6px 10px;">
                        ${value}
                        <span class="remove-tag" style="margin-left:8px;cursor:pointer;">&times;</span>
                        </span>
                    `);
                    tag.find(".remove-tag").on("click", function() {
                        tags = tags.filter(t => t !== value.toLowerCase());
                        tag.remove();
                        updateHidden();
                    });
                    $("#tagInput").before(tag);
                    $(this).val("");
                    updateHidden();
                }
            });

            function updateHidden() {
                $("#hiddenTags").val(tags.join(","));
            }
        });
    </script>
@endsection
