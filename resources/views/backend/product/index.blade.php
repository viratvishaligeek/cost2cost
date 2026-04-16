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
                    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#addProductModal">
                        <span class="fas fa-plus me-2"> </span> Add Product</button>
                    @include('backend.product.partial.form')
                </div>
            </div>
        </div>
        <div
            class="mx-n4 px-4 mx-lg-n6 px-lg-6 bg-body-emphasis border-top border-bottom border-translucent position-relative top-1">
            <div class="table-responsive scrollbar mx-n1 px-1">
                <table id="dataTable" class="table fs-9 mb-0">
                    <thead>
                        <tr>
                            <th class="white-space-nowrap align-middle fs-9 ">Sr. No</th>
                            <th class="white-space-nowrap align-middle">Name</th>
                            <th class="white-space-nowrap align-middle ">Tenant </th>
                            <th class="white-space-nowrap align-middle ">Status</th>
                            <th class="white-space-nowrap align-middle ">Created At</th>
                            <th class="white-space-nowrap align-middle ">Action </th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
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
                    data: 'tenant',
                    name: 'tenant',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'status',
                    name: 'status'
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
            initializeDataTable('#dataTable', "{{ route('admin.product.index') }}", columns, 'Products List');
        });
    </script>
    <script>
        $(document).ready(function() {
            // 1. Toggle Engine
            $('#floatingHasVariation').change(function() {
                $(this).val() === 'yes' ? $('#variationEngine').slideDown() : $('#variationEngine')
                    .slideUp();
            });

            // 2. Load Values when Attribute Checkbox is clicked
            $('.attr-checkbox').change(function() {
                let optionId = $(this).val();
                let optionName = $(this).data('name');
                let isChecked = $(this).is(':checked');

                if (isChecked) {
                    $('#placeholder-text').hide();
                    $.ajax({
                        url: `{{ route('admin.options.get-values') }}`,
                        method: 'POST',
                        data: {
                            "id": optionId,
                            "_token": "{{ csrf_token() }}"
                        },
                        success: function(response) {
                            let html = `<div class="col-md-6 attr-values-group" id="group-${optionId}">
                            <div class="value-card shadow-sm">
                                <h6 class="border-bottom pb-2 mb-2 text-primary">${optionName}</h6>
                                <div class="d-flex flex-wrap gap-2">
                                    ${response.values.map(v => `<div class="form-check me-2"><input class="form-check-input val-checkbox" type="checkbox" name="selected_values[${optionId}][]" value="${v.id}" data-vname="${v.name}" data-optname="${optionName}" id="val_${v.id}"> <label class="form-check-label" for="val_${v.id}">${v.name}</label></div>`).join('')}
                                </div>
                            </div>
                        </div>`;
                            $('#values-wrapper').append(html);
                        }
                    });
                } else {
                    $(`#group-${optionId}`).remove();
                    if ($('.attr-values-group').length === 0) $('#placeholder-text').show();
                }
            });

            // 3. Generate Combinations
            $('#generate-variants').click(function() {
                let selectedOptions = [];

                $('.attr-values-group').each(function() {
                    let optionGroup = $(this);
                    let vals = [];

                    optionGroup.find('.val-checkbox:checked').each(function() {
                        vals.push({
                            id: $(this).val(),
                            value: $(this).data('vname'),
                            optionId: $(this).closest('.attr-values-group').attr(
                                'id').replace('group-', '')
                        });
                    });

                    if (vals.length > 0) {
                        selectedOptions.push({
                            values: vals
                        });
                    }
                });

                if (selectedOptions.length === 0) {
                    alert('Please select at least one value for the attributes');
                    return;
                }

                let combinations = getCombinations(selectedOptions);
                $('#variants-container').empty();
                combinations.forEach((combo, index) => {
                    let variantText = combo.map(c => c.value).join('-');
                    let html = `
                <div class="variant-badge animate__animated animate__fadeIn">
                    <span>${variantText}</span>
                    ${combo.map(c => `<input type="hidden" name="variants[${index}][options][${c.optionId}]" value="${c.id}">`).join('')}
                    <i class="fas fa-times-circle remove-variant"></i>
                </div>`;
                    $('#variants-container').append(html);
                });
            });

            // Remove variant badge
            $(document).on('click', '.remove-variant', function() {
                $(this).closest('.variant-badge').remove();
            });

            // Cartesian Product Helper
            function getCombinations(options, combination = [], results = []) {
                if (options.length === 0) {
                    results.push(combination);
                } else {
                    let currentOption = options[0];
                    let remainingOptions = options.slice(1);
                    currentOption.values.forEach(value => {
                        getCombinations(remainingOptions, combination.concat([value]), results);
                    });
                }
                return results;
            }
        });
        // ------------------------
        $('#floatingSelectCategory').change(function() {
            const selectedValue = $(this).val();
            $.ajax({
                url: "{{ route('admin.product.get-subcategories', ':id') }}".replace(':id',
                    selectedValue),
                type: 'GET',
                success: function(response) {
                    let subCategorySelect = $('#floatingSelectSubCategory');
                    subCategorySelect.empty();
                    subCategorySelect.append(
                        '<option selected disabled>Select Sub Category</option>'
                    );

                    if (response.success) {
                        $.each(response.data, function(key, subCategory) {
                            subCategorySelect.append(
                                '<option value="' + subCategory.id + '">' +
                                subCategory.name + '</option>'
                            );
                        });
                    }
                },
                error: function(xhr) {
                    console.error('Error fetching subcategories:', xhr);
                }
            });
        });
    </script>
@endsection
