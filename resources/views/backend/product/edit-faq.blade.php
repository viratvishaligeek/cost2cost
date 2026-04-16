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
                    @include('backend.product.partial.faqs')
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
    <script>
        $(document).ready(function() {
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
    </script>
    <script>
        let index = 1;
        $('#add-faq').click(function() {
            let html = `
        <div class="faq-item mb-3 border-top pt-3">
            <input type="text" name="faqs[new_${index}][question]"
                class="form-control mb-2" placeholder="Enter Question">
            <textarea name="faqs[new_${index}][answer]"
                class="form-control" placeholder="Enter Answer"></textarea>
            <button type="button" class="btn btn-sm btn-danger mt-2 remove-faq">
                Remove
            </button>
        </div>
            `;
            $('#faq-wrapper').append(html);
            index++;
        });

        $(document).on('click', '.remove-faq', function() {
            $(this).closest('.faq-item').remove();
        });
    </script>
@endsection
