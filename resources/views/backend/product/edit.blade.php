@extends('backend.include.layout')
@section('content')
    <div class="mb-4">
        <h2 class="mb-2">{{ $pageName }}</h2>
        <h5 class="text-muted">Product: <span class="text-primary">{{ $data->name }}</span></h5>
    </div>

    <div class="row">
        <div class="col-12">
            <ul class="nav nav-underline optionChainTableHeader gap-0 flex-nowrap scrollbar mb-4" id="productTab"
                role="tablist">
                <li class="nav-item">
                    <a class="nav-link pt-0 text-nowrap active ps-0 pe-3 " id="tab-chart" href="#tab-general"
                        data-bs-toggle="tab" role="tab" aria-controls="tab-general" aria-selected="true">General
                        Information</a>
                </li>
                @if ($data->has_variation == 'yes')
                    @foreach ($data->variants as $variant)
                        <li class="nav-item">
                            <a class="nav-link pt-0 text-nowrap px-3 " id="variant-tab-{{ $variant->id }}"
                                href="#tab-variant-{{ $variant->id }}" data-bs-toggle="tab" role="tab"
                                aria-controls="tab-general" aria-selected="true">
                                {{ $variant->combo }}
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
            <div class="tab-content mt-4" id="productTabContent">
                <div class="tab-pane fade show active" id="tab-general" role="tabpanel">
                    @include('backend.product.partial.edit_general')
                </div>
                @if ($data->has_variation == 'yes')
                    @foreach ($data->variants as $variant)
                        <div class="tab-pane fade" id="tab-variant-{{ $variant->id }}" role="tabpanel">
                            @include('backend.product.partial.edit_variant', ['variant' => $variant])
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('backend') }}/tinymce/tinymce.min.js"></script>
    <script src="{{ URL::asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>

    <style>
        /* Image Preview styling for better UI */
        .preview-container {
            position: relative;
            margin-bottom: 15px;
        }

        .preview-container img {
            width: 100%;
            height: 120px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #ddd;
        }

        .remove-img-btn {
            position: absolute;
            top: -5px;
            right: 5px;
            background: #ff3547;
            color: white;
            border: none;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 12px;
            line-height: 20px;
            cursor: pointer;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>

    <script>
        $(document).ready(function() {
            // --- 1. File Manager Setup ---
            $('#featured').filemanager('image');
            $('#gallery').filemanager('image', {
                multiple: true
            });

            // Handle Variant Buttons (Delegated)
            $(document).on('click', '.variant_gallery_btn', function() {
                $(this).filemanager('image', {
                    multiple: true
                });
            });

            // --- 2. TinyMCE Init ---
            tinymce.init({
                selector: '.tinymce-editor',
                license_key: 'gpl',
                plugins: 'preview autolink autosave save code fullscreen wordcount help charmap advlist lists table media',
                toolbar: "undo redo | blocks | bold italic underline | align numlist bullist | link image | table | removeformat | code fullscreen",
                height: 400,
                branding: false,
                setup: function(editor) {
                    editor.on('change', function() {
                        editor.save();
                    });
                }
            });

            // --- 3. Robust Gallery Preview Function ---
            function renderGalleryPreview(inputId, holderId) {
                let input = $('#' + inputId);
                let holder = $('#' + holderId);

                if (holder.length === 0) return; // Guard clause if holder doesn't exist

                holder.empty();
                if (!input.val()) return;

                let images = input.val().split(',');
                images.forEach((img, index) => {
                    if (img.trim() !== "") {
                        holder.append(`
                            <div class="col-md-3 col-sm-4 preview-container" id="img-wrapper-${inputId}-${index}">
                                <img src="${img}" class="img-fluid">
                                <button type="button" class="remove-img-btn btn btn-danger"
                                    onclick="removeGalleryImage('${inputId}', '${holderId}', ${index})">✕</button>
                            </div>
                        `);
                    }
                });
            }

            // Global function to remove image
            window.removeGalleryImage = function(inputId, holderId, index) {
                let input = $('#' + inputId);
                let images = input.val().split(',');
                images.splice(index, 1);
                input.val(images.join(','));
                renderGalleryPreview(inputId, holderId);
            };

            // --- 4. Event Listeners for Input Changes ---
            // General Gallery & Variant Gallery listener
            $(document).on('change', 'input[name="gallery_image"], input[name="variant_gallery_image"]',
                function() {
                    let inputId = $(this).attr('id');
                    // Pattern match: variant_gallery_thumbnail_123 -> variant_gallery_holder_123
                    let holderId = inputId.replace('thumbnail', 'holder');
                    renderGalleryPreview(inputId, holderId);
                });

            // Featured image single preview
            $('#featured_thumbnail').on('change', function() {
                let val = $(this).val();
                $('#featured_holder').html(val ?
                    `<img src="${val}" style="width:150px; border-radius:8px;" class="mb-3 border">` :
                    '');
            });

            // --- 5. Initial Previews on Page Load ---
            // Run for General Gallery
            renderGalleryPreview('gallery_thumbnail', 'gallery_holder');

            // Run for all Variant Galleries
            $('input[name="variant_gallery_image"]').each(function() {
                let id = $(this).attr('id');
                let holderId = id.replace('thumbnail', 'holder');
                renderGalleryPreview(id, holderId);
            });

            // --- 6. Other Logic (Categories & SweeAlert) ---
            $('#floatingSelectCategory').change(function() {
                const catId = $(this).val();
                $.get("{{ route('admin.product.get-subcategories', ':id') }}".replace(':id', catId),
                    function(response) {
                        let subCat = $('#floatingSelectSubCategory').empty().append(
                            '<option selected disabled>Select Sub Category</option>');
                        if (response.success) {
                            $.each(response.data, function(i, item) {
                                subCat.append(
                                    `<option value="${item.id}">${item.name}</option>`);
                            });
                        }
                    });
            });

            $(document).on('click', '.confirm-button', function(e) {
                e.preventDefault();
                let form = $(this).closest("form");
                swal({
                        title: "Delete Variant?",
                        text: "Wapas nahi aayega data!",
                        icon: "warning",
                        buttons: true,
                        dangerMode: true
                    })
                    .then((willDelete) => {
                        if (willDelete) form.submit();
                    });
            });
        });
    </script>
@endsection
