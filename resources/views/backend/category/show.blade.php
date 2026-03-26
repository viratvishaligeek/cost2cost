@extends('backend.include.layout')
@section('content')
    <h2 class="mb-4">{{ $pageName }}</h2>
    <div class="row mb-3">
        <div class="col-xl-9">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-floating">
                        <input class="form-control" name="name" disabled value="{{ old('name') ?? $data->name }}"
                            type="text" placeholder="Name" />
                        <label>Name</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating p-3">
                        {!! old('description') ?? $data->description !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3">
            <div class="row g-3">
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="is_parent"
                            value="{{ old('is_parent') ?? $data->is_parent }}" disabled />
                        <label>Is Parent Category ?</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="parent_id"
                            value="{{ $data->parent?->name ?? 'N/A' }}" disabled />
                        <label>Category</label>
                    </div>
                </div>
                <div class="col-12">
                    <div class="form-floating">
                        <input type="text" class="form-control" name="status"
                            value="{{ old('status') ?? $data->status }}" disabled />
                        <label>Status</label>
                    </div>
                </div>
                <div class="col-12">
                    <label>Featured Image</label>
                    <a href="{{ $data->featured_image }}" target="_blank">
                        <img src="{{ $data->featured_image }}" alt="{{ $data->name }}" class="img-fluid" />
                    </a>
                </div>
                <div class="col-12 text-end mt-3">
                    <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
