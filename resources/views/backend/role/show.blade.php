@extends('backend.include.layout')
@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header row">
                <div class="col-lg-6">
                    <h3 class="page-title">Edit role</h3>
                </div>
            </div>
            <div class="card-body">
                <form class="row" action="{{ route('admin.role.update', encrypt($data->id)) }}" method="post">
                    @csrf
                    @method('patch')
                    <div class="col-sm-12 col-md-12 mb-3">
                        <div class="form-floating">
                            <input disabled class="form-control" id="floatingInputGrid" name="name"
                                value="{{ old('name') ?? $data->name }}" type="text" placeholder="name" required />
                            <label for="floatingInputGrid">Name</label>
                        </div>
                    </div>
                    @php
                        $groupedPermissions = $permission->groupBy(function ($permission) {
                            $segments = explode('-', $permission->name);
                            return count($segments) > 2 ? $segments[0] . '-' . $segments[1] : $segments[0];
                        });
                    @endphp
                    @foreach ($groupedPermissions as $group => $permissions)
                        <div class="form-group col-md-4 mb-3">
                            <h5>
                                <input disabled type="checkbox" id="selectAll{{ ucfirst(str_replace('-', '', $group)) }}"
                                    class="select-all-group" />
                                <label for="selectAll{{ ucfirst(str_replace('-', '', $group)) }}">
                                    {{ ucfirst(str_replace('-', ' ', $group)) }} Permissions
                                </label>
                            </h5>

                            @foreach ($permissions as $item)
                                <div style="margin-left: 25px">
                                    <input disabled type="checkbox" name="permission[]" value="{{ $item->id }}"
                                        id="dataId{{ $item->id }}"
                                        class="group-checkbox group-checkbox-{{ ucfirst(str_replace('-', '', $group)) }}"
                                        {{ in_array($item->id, $rolePermissions) ? 'checked' : '' }} />
                                    <label for="dataId{{ $item->id }}">{{ $item->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    @endforeach

                    <div class="col-12 gy-6">
                        <div class="row g-3 justify-content-end">
                            <div class="col-auto">
                                <a href="{{ route('admin.role.index') }}" class="btn btn-phoenix-primary px-5">Back</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
