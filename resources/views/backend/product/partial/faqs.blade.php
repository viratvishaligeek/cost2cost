<form action="{{ route('admin.product.update-faqs', encrypt($data->id)) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="row">
        <div class="card-body" id="faq-wrapper">
            {{-- EXISTING FAQS (EDIT MODE) --}}
            @if (!empty($faqs) && count($faqs))
                @foreach ($faqs as $i => $faq)
                    <div class="faq-item mb-3 border-top pt-3">

                        <input type="hidden" name="faqs[{{ $i }}][id]" value="{{ $faq->id }}">

                        <input type="text" name="faqs[{{ $i }}][question]" value="{{ $faq->question }}"
                            class="form-control mb-2">

                        <textarea name="faqs[{{ $i }}][answer]" class="form-control">{{ $faq->answer }}</textarea>

                        <button type="button" class="btn btn-sm btn-danger mt-2 remove-faq">
                            Remove
                        </button>
                    </div>
                @endforeach
            @endif
            {{-- NEW FAQ --}}
            <div class="faq-item mb-3">
                <input type="text" name="faqs[new_0][question]" class="form-control mb-2"
                    placeholder="Enter Question">

                <textarea name="faqs[new_0][answer]" class="form-control" placeholder="Enter Answer"></textarea>

                <button type="button" class="btn btn-sm btn-danger mt-2 remove-faq d-none">
                    Remove
                </button>
            </div>
        </div>
    </div>
    {{-- SUBMIT --}}
    <div class="text-end mt-4">
        <button class="btn btn-success px-4">
            💾 Save FAQs
        </button>
    </div>
</form>
