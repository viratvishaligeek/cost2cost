@extends('backend.include.layout')
@section('content')
    <h2 class="mb-4">{{ $pageName }}</h2>
    <div class="row">
        <div class="col-xl-9">
            <form class="row g-3 mb-6" action="{{ route('admin.options.update', encrypt($data->id)) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="col-sm-6 col-md-6">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" name="name"
                            value="{{ old('name') ?? $data->name }}" type="text" placeholder="name" required />
                        <label for="floatingInputGrid">Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-floating">
                        <select class="form-select" name="status" id="floatingSelectPrivacy">
                            <option selected="selected" disabled>Select status</option>
                            <option value="active" {{ old('status') ?? $data->status == 'active' ? 'selected' : '' }}>Active
                            </option>
                            <option value="inactive" {{ old('status') ?? $data->status == 'inactive' ? 'selected' : '' }}>In
                                Active</option>
                        </select>
                        <label for="floatingSelectPrivacy">Status</label>
                    </div>
                </div>
                <div class="col-12 gy-6">
                    <div class="row g-3 justify-content-end">
                        <div class="col-auto">
                            <a href="{{ route('admin.options.index') }}" class="btn btn-phoenix-primary px-5">Cancel</a>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary px-5 px-sm-15">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
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
@endsection
