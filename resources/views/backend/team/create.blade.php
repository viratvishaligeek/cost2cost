@extends('backend.include.layout')
@section('content')
    <h2 class="mb-4">{{ $pageName }}</h2>
    <div class="row">
        <div class="col-xl-9">
            <form class="row g-3 mb-6" action="{{ route('admin.team.store') }}" method="post">
                @csrf
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" name="name" value="{{ old('name') }}"
                            type="text" placeholder="name" required />
                        <label for="floatingInputGrid">Name</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" name="email" value="{{ old('email') }}"
                            type="email" placeholder="email" required />
                        <label for="floatingInputGrid">Email</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" name="phone" value="{{ old('phone') }}"
                            type="tel" placeholder="phone" required maxlength="10" />
                        <label for="floatingInputGrid">Phone</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" name="password" value="{{ old('password') }}"
                            type="text" placeholder="password" required />
                        <label for="floatingInputGrid">Password</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" name="password_confirmation"
                            value="{{ old('password_confirmation') }}" type="text" placeholder="password_confirmation"
                            required />
                        <label for="floatingInputGrid">Password Confirmation</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <select class="form-select" name="tenant_id" id="floatingSelectPrivacy">
                            <option selected="selected" disabled>Select Tenant</option>
                            @foreach ($tenants as $tenant)
                                <option value="{{ $tenant->id }}" {{ old('tenant_id') == $tenant->id ? 'selected' : '' }}>
                                    {{ $tenant->name }}</option>
                            @endforeach
                        </select>
                        <label for="floatingSelectPrivacy">Assign Tenant Access</label>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <select class="form-select" name="status" id="floatingSelectPrivacy">
                            <option selected="selected" disabled>Select status</option>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>In Active</option>
                        </select>
                        <label for="floatingSelectPrivacy">Status</label>
                    </div>
                </div>
                <div class="col-12 gy-6">
                    <div class="row g-3 justify-content-end">
                        <div class="col-auto">
                            <a href="{{ route('admin.team.index') }}" class="btn btn-phoenix-primary px-5">Cancel</a>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary px-5 px-sm-15">Create</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
