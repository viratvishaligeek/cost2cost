<form action="{{ route('admin.product.update-faqs', encrypt($data->id)) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="row">
        {{-- LEFT: ADD FAQ --}}
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-warning text-dark fw-bold">
                    ➕ Add FAQ
                </div>
                <div class="card-body" id="faq-wrapper">
                    {{-- DEFAULT FIELD --}}
                    <div class="faq-item mb-3">
                        <input type="text" name="faqs[0][question]" class="form-control mb-2"
                            placeholder="Enter Question">
                        <textarea name="faqs[0][answer]" class="form-control" placeholder="Enter Answer"></textarea>
                        <button type="button" class="btn btn-sm btn-danger mt-2 remove-faq d-none">
                            Remove
                        </button>
                    </div>
                </div>
                <div class="card-footer bg-white">
                    <button type="button" id="add-faq" class="btn btn-outline-primary btn-sm">
                        + Add More
                    </button>
                </div>
            </div>
        </div>
        {{-- RIGHT: EXISTING FAQ --}}
        <div class="col-md-12">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-header bg-dark text-white fw-bold">
                    📋 Existing FAQs
                </div>
                <div class="card-body">
                    @if (!empty($data->faqs) && count($data->faqs))
                        <div class="accordion" id="faqAccordion">
                            @foreach ($data->faqs as $index => $faq)
                                <div class="accordion-item mb-2 border rounded">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#faq{{ $index }}">
                                            {{ $faq['question'] }}
                                        </button>
                                    </h2>
                                    <div id="faq{{ $index }}" class="accordion-collapse collapse"
                                        data-bs-parent="#faqAccordion">
                                        <div class="accordion-body">
                                            {{ $faq['answer'] }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No FAQs added yet.</p>
                    @endif
                </div>
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
