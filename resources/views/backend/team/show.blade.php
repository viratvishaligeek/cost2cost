@extends('backend.include.layout')
@section('content')
    <h2 class="mb-4">{{ $pageName }}</h2>
    <div class="row">
        <div class="col-xl-9">
            <div class="row g-3 mb-6">
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" disabled value="{{ $data->name }}"
                            placeholder="name" />
                        <label for="floatingInputGrid">Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" disabled value="{{ $data->email }}"
                            placeholder="email" />
                        <label for="floatingInputGrid">Email</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" disabled value="{{ $data->phone }}"
                            placeholder="phone" maxlength="10" />
                        <label for="floatingInputGrid">Phone</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" disabled
                            value="{{ TenantList($data->tenant_id)->name }}" placeholder="password_confirmation" />
                        <label for="floatingSelectPrivacy">Assign Tenant Access</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" disabled value="{{ $data->status }}"
                            placeholder="status" />
                        <label for="floatingSelectPrivacy">Status</label>
                    </div>
                </div>
                <div class="col-12 gy-6">
                    <div class="row g-3 justify-content-end">
                        <div class="col-auto">
                            <a href="{{ route('admin.team.index') }}" class="btn btn-info px-5">Back</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
