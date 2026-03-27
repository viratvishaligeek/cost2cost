@extends('backend.include.layout')
@section('content')
    <h2 class="mb-4">{{ $pageName }}</h2>
    <div class="row">
        <div class="col-xl-9">
            <form class="row g-3 mb-6" action="{{ route('admin.option-value.update', encrypt($data->id)) }}" method="post">
                @csrf
                @method('PATCH')
                <div class="col-sm-4 col-md-4">
                    <div class="form-floating">
                        <input class="form-control" id="floatingInputGrid" name="name"
                            value="{{ old('name') ?? $data->name }}" type="text" placeholder="name" required />
                        <label for="floatingInputGrid">Name</label>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="form-floating">
                        <select class="form-select" name="option_id" id="floatingSelectPrivacy">
                            <option selected="selected" disabled>Select option</option>
                            @foreach ($options as $option)
                                <option value="{{ $option->id }}"
                                    {{ old('option_id') ?? $data->option_id == $option->id ? 'selected' : '' }}>
                                    {{ $option->name }}
                                </option>
                            @endforeach
                        </select>
                        <label for="floatingSelectPrivacy">Option</label>
                    </div>
                </div>
                <div class="col-12 gy-6">
                    <div class="row g-3 justify-content-end">
                        <div class="col-auto">
                            <a href="{{ route('admin.option-value.index') }}"
                                class="btn btn-phoenix-primary px-5">Cancel</a>
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary px-5 px-sm-15">Update</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
