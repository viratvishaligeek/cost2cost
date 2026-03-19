function initializeDataTable(tableId, ajaxUrl, columns, exportFileName = 'Data_Export') {
    var table = $(tableId).DataTable({
        processing: true,
        serverSide: true,
        dom: 'Bt<"d-flex flex-between-center py-3"ip>',
        ajax: {
            url: ajaxUrl,
            type: 'GET',
        },
        columns: columns,
        buttons: [
            { extend: 'excelHtml5', title: exportFileName, exportOptions: { columns: ':not(:last-child)' } },
            { extend: 'csvHtml5', title: exportFileName, exportOptions: { columns: ':not(:last-child)' } },
            { extend: 'pdfHtml5', title: exportFileName, exportOptions: { columns: ':not(:last-child)' } },
            { extend: 'print', title: exportFileName, exportOptions: { columns: ':not(:last-child)' } }
        ],
        language: {
            paginate: {
                previous: '<span class="fas fa-chevron-left"></span>',
                next: '<span class="fas fa-chevron-right"></span>'
            }
        }
    });

    // Global Search
    $('.search-input').on('keyup', function() {
        table.search(this.value).draw();
    });

    // Global Export Triggers
    $('.export-excel').on('click', function() { table.button('.buttons-excel').trigger(); });
    $('.export-csv').on('click', function() { table.button('.buttons-csv').trigger(); });
    $('.export-pdf').on('click', function() { table.button('.buttons-pdf').trigger(); });
    $('.export-print').on('click', function() { table.button('.buttons-print').trigger(); });

    return table;
}
