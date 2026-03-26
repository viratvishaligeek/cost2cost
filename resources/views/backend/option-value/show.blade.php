@extends('backend.include.layout')
@section('content')
    <h2 class="mb-4">{{ $pageName }}</h2>
    <div class="row">
        <div class="col-xl-9">
            <div class="row g-3 mb-6">
                <div class="col-sm-12 col-md-12">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" value="{{ old('name') ?? $data->name }}"
                            placeholder="name" disabled />
                        <label for="floatingInputGrid">Name</label>
                    </div>
                </div>
                <div class="col-sm-12 col-md-12">
                    <div class="form-floating p-3">
                        {!! $data->description !!}
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-floating">
                        <input class="form-control" value="{{ $data->tenant->name ?? '' }}" disabled>
                        <label>Tenant</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-floating">
                        <input class="form-control" value="{{ $data->status }}" disabled>
                        <label>Status</label>
                    </div>
                </div>
                <div class="col-md-6" id="featured_holder">
                    <label for="name"> Preview</label>
                    <img src="{{ $data->featured_image }}" alt="" width="100%">
                </div>
                <div class="col-12 gy-6">
                    <div class="row g-3 justify-content-end">
                        <div class="col-auto">
                            <a href="{{ route('admin.brand.index') }}" class="btn btn-phoenix-primary px-5">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
