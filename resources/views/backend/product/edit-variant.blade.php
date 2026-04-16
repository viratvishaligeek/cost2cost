@extends('backend.include.layout')
@section('content')
    <div class="mb-4">
        <h2 class="mb-2">{{ $pageName }}</h2>
        <h5 class="text-muted">Product: <span class="text-primary">{{ $data->name }}</span></h5>
    </div>

    <div class="row">
        <div class="col-12">
            {{-- tabs menu start here --}}
            @include('backend.product.partial.tabs')
            {{-- tabs menu end here --}}

            <div class="tab-content mt-4" id="productTabContent">
                <div class="tab-pane fade show active" id="tab-general" role="tabpanel">
                    @include('backend.product.partial.variant')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('backend') }}/tinymce/tinymce.min.js"></script>
    <script src="{{ URL::asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#featured').filemanager('image');
            $('#lifestyle').filemanager('image');
            $('#infographics').filemanager('image');
            $('#gallery').filemanager('image', {
                multiple: true
            });

            tinymce.init({
                selector: '.tinymce-editor',
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

            // delete variation asking popup
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
        // -------------------------------
        $(document).ready(function() {
            $('#addRow').click(function() {
                let row = `
                <tr>
                    <td><input type="text" class="form-control spec-key"></td>
                    <td><input type="text" class="form-control spec-value"></td>
                    <td><button type="button" class="btn btn-danger btn-sm removeRow">X</button></td>
                </tr>`;
                $('#specTable tbody').append(row);
            });
            $(document).on('click', '.removeRow', function() {
                $(this).closest('tr').remove();
            });
            let existing = $('#custom_table').val();

            if (existing) {
                try {
                    let specs = JSON.parse(existing);

                    if (specs.length > 0) {
                        $('#specTable tbody').html('');

                        specs.forEach(spec => {
                            let row = `
                            <tr>
                                <td><input type="text" class="form-control spec-key" value="${spec.key}"></td>
                                <td><input type="text" class="form-control spec-value" value="${spec.value}"></td>
                                <td><button type="button" class="btn btn-danger btn-sm removeRow">X</button></td>
                            </tr>`;
                            $('#specTable tbody').append(row);
                        });
                    }
                } catch (e) {
                    console.error('Invalid JSON in custom_table');
                }
            }
            $('form').on('submit', function() {
                let specs = [];
                $('#specTable tbody tr').each(function() {
                    let key = $(this).find('.spec-key').val();
                    let value = $(this).find('.spec-value').val();
                    if (key && value) {
                        specs.push({
                            key,
                            value
                        });
                    }
                });
                $('#custom_table').val(JSON.stringify(specs));
            });

        });
    </script>
@endsection
