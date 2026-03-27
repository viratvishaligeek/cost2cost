@extends('backend.include.layout')
@section('content')
    <h2 class="mb-4">{{ $pageName }}</h2>
    <div class="row">
        <div class="col-xl-9">
            <div class="row g-3 mb-6">
                <div class="col-sm-4 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" value="{{ old('name') ?? $data->name }}"
                            placeholder="name" disabled />
                        <label for="floatingInputGrid">Name</label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" value="{{ $data->tenant->name ?? '' }}" disabled>
                        <label>Tenant</label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" value="{{ $data->status }}" disabled>
                        <label>Status</label>
                    </div>
                </div>
                <div class="col-12 gy-6">
                    <div class="row g-3 justify-content-end">
                        <div class="col-auto">
                            <a href="{{ route('admin.options.index') }}" class="btn btn-phoenix-primary px-5">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
@endsection
