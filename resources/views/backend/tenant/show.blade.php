@extends('backend.include.layout')
@section('content')
    <h2 class="mb-4">{{ $pageName }}</h2>
    <div class="row">
        <div class="col-xl-9">
            <div class="row g-3 mb-6">
                <div class="col-sm-6 col-md-6">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" value="{{ $data->name }}" type="text"
                            placeholder="name" disabled />
                        <label for="floatingInputGrid">Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" value="{{ $data->domain }}" type="text"
                            placeholder="https://domain.com" disabled />
                        <label for="floatingInputGrid">Domain</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" value="{{ $data->notes }}" type="text"
                            placeholder="Project title" disabled />
                        <label for="floatingInputGrid">Note</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-6">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" value="{{ $data->status }}" type="text"
                            placeholder="Project title" disabled />
                        <label for="floatingInputGrid">Status</label>
                    </div>
                </div>
                <div class="col-12 gy-6">
                    <div class="row g-3 justify-content-end">
                        <div class="col-auto">
                            <a href="{{ route('admin.tenant.index') }}" class="btn btn-info px-5">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
