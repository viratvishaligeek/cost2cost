@extends('backend.include.layout')
@section('content')
    <h2 class="mb-4">{{ $pageName }}</h2>
    <div class="row">
        <div class="col-xl-9">
            <form class="row g-3 mb-6" action="{{ route('admin.setting.store') }}" method="post">
                @csrf
                <input type="hidden" name="tenant_id" value="0">
                <div class="col-sm-6 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" name="project_name"
                            value="{{ old('project_name') ?? GlobalSetting('project_name') }}" type="text"
                            placeholder="project_name" />
                        <label for="floatingInputGrid">Project Name</label>
                    </div>
                </div>
                <div class="col-12 gy-6">
                    <div class="row g-3 justify-content-end">
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary px-5 px-sm-15">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
