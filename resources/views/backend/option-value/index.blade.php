@extends('backend.include.layout')
@section('content')
    <nav class="mb-3" aria-label="breadcrumb">
        <ol class="breadcrumb mb-0">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="">Product Module</a>
            </li>
            <li class="breadcrumb-item active">{{ $pageName }}</li>
        </ol>
    </nav>
    <div class="mb-9">
        <div class="row g-3 mb-4">
            <div class="col-auto">
                <h2 class="mb-0">{{ $pageName }}</h2>
            </div>
        </div>
        <div class="mb-4">
            <div class="row g-3">
                <div class="col-auto">
                    <div class="search-box">
                        <form class="position-relative">
                            <input class="form-control search-input search" type="search" placeholder="Search orders"
                                aria-label="Search" />
                            <span class="fas fa-search search-box-icon"></span>
                        </form>
                    </div>
                </div>
                <div class="col-auto scrollbar overflow-hidden-y flex-grow-1">
                    <div class="btn-group position-static" role="group">
                        <div class="btn-group position-static text-nowrap" role="group">
                            <button class="btn btn-phoenix-secondary px-7 flex-shrink-0" type="button"
                                data-bs-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false"
                                data-bs-reference="parent"> Payment status<span class="fas fa-angle-down ms-2">
                                </span>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="">Action</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">Another action</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">Something else here</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider" />
                                </li>
                                <li>
                                    <a class="dropdown-item" href="">Separated link</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-auto">
                    <button class="btn btn-link btn-info text-body dropdown-toggle dropdown-caret-none" type="button"
                        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="fa-solid fa-file-export fs-9 me-2"></span>Export
                    </button>
                    <div class="dropdown-menu dropdown-menu-end">
                        <a class="dropdown-item export-excel" href="#!">Excel</a>
                        <a class="dropdown-item export-csv" href="#!">CSV</a>
                        <a class="dropdown-item export-pdf" href="#!">PDF</a>
                        <a class="dropdown-item export-print" href="#!">Print</a>
                    </div>
                    @can('option_value-add')
                        <a href="{{ route('admin.option-value.create') }}" class="btn btn-primary"> <span
                                class="fas fa-plus me-2">
                            </span> Add</a>
                    @endcan
                </div>
            </div>
        </div>
        <div
            class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
            <div class="table-responsive scrollbar mx-n1 px-1">
                @can('option_value-browse')
                    <table id="dataTable" class="table fs-9 mb-0">
                        <thead>
                            <tr>
                                <th class="white-space-nowrap align-middle fs-9 ">Sr. No</th>
                                <th class="white-space-nowrap align-middle">Name</th>
                                <th class="white-space-nowrap align-middle ">Option</th>
                                <th class="white-space-nowrap align-middle ">Created At</th>
                                <th class="white-space-nowrap align-middle ">Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                @endcan
            </div>
        </div>

    </div>
@endsection
@section('script')
    @include('backend.partial.datatable-scripts')

    <script>
        $(document).ready(function() {
            const columns = [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'option',
                    name: 'option',
                    orderable: false,
                    searchable: false

                },
                {
                    data: 'created_at',
                    name: 'created_at'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                }
            ];
            initializeDataTable('#dataTable', "{{ route('admin.option-value.index') }}", columns,
                'Option Value List');
        });
    </script>
@endsection
