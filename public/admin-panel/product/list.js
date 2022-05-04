$(document).ready(function() {
    // Warning Message on Delete
    $('.js-delete').click(function ()
    {
        var deleteAction = $(this).data('action');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes, delete it",
            showLoaderOnConfirm: true,
            preConfirm: function (result) {
                $.ajax({
                    type: 'POST',
                    url: deleteAction,
                    data: {_method: 'delete'},
                    dataType: 'json',
                    cache: false,
                    success: function (result) {
                        if (!('success' in result) || !result.success)
                        {
                            alertShow('Unexpected error');
                        }

                        window.location.reload();
                    },
                    error: function (jqXHR, exception)
                    {
                        ajaxErrorMessage(jqXHR, exception);
                    },
                });

            },
        });
    });

    // Datable
    var listTable = $('#productsTable').DataTable({
        processing: false,
        searching: true,
        paging: true,
        pageLength: 15,
        pagingType: 'full_numbers',
        aoColumnDefs: [
            {
                'bSortable': false,
                'aTargets': [1, 3, 9]
            }
        ],
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.listHiddenNodes()
            }
        },
        order: [[2, 'desc']],
        dom: "<'row'<'col-sm-12'tr>>" +
            "<'row mt-md-2'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 mt-3 mt-md-0'p>>",
        drawCallback: function(dt) {
            //for rendering the select
            $('.js-status-select2').select2({minimumResultsForSearch: Infinity});
        }
    });

    $('.js-in-stock-select').on('change', function (){
        var action = $(this).data('action');
        $.ajax({
            type: 'POST',
            url: action,
            data: {_method: 'put', in_stock: $(this).val()},
            dataType: 'json',
            cache: false,
            success: function (result) {
                if (!('success' in result) || !result.success)
                {
                    alertShow('Unexpected error');
                }

                window.location.reload();
            },
            error: function (jqXHR, exception)
            {
                ajaxErrorMessage(jqXHR, exception);
            },
        });
    });

    $('#applyBulkActions').on('click', function()
    {
        var ids = $('input.js-check-item-id:checkbox:checked').map(function(){
            return $(this).val();
        }).get();

        var action = $('#js-bulk-actions-list').find(':selected').data('action');
        switch (action)
        {
            case 'bulk-in-stock-update': {
                bulkInStockUpdate(ids, $('#js-bulk-actions-list').val());
            }
            break;
            case 'bulk-delete': {
                bulkDelete(ids);
            }
            break;
            default: toastr.warning('Please select an action');
        }
    });

    function bulkInStockUpdate(ids, inStock)
    {
        $('#applyBulkActions').prop('disabled', true);
        $.ajax({
            type: 'POST',
            url: window.bulkInStockUpdateAction,
            data: {_method: 'put', ids: ids, in_stock: inStock},
            dataType: 'json',
            cache: false,
            success: function (result) {
                if (!('success' in result) || !result.success)
                {
                    alertShow('Unexpected error');
                }

                window.location.reload();
            },
            error: function (jqXHR, exception)
            {
                $('#applyBulkActions').prop('disabled', false);
                ajaxErrorMessage(jqXHR, exception);
            },
        });
    }

    function bulkDelete(ids)
    {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes, delete it",
            showLoaderOnConfirm: true,
            preConfirm: function (result) {

                $('#applyBulkActions').prop('disabled', true);
                $.ajax({
                    type: 'POST',
                    url: window.bulkDeleteAction,
                    data: {_method: 'delete', ids: ids},
                    dataType: 'json',
                    cache: false,
                    success: function (result) {
                        if (!('success' in result) || !result.success)
                        {
                            alertShow('Unexpected error');
                        }

                        window.location.reload();
                    },
                    error: function (jqXHR, exception)
                    {
                        $('#applyBulkActions').prop('disabled', false);
                        ajaxErrorMessage(jqXHR, exception);
                    },
                });

            },
        });

    }

    // Bulk actions
    $('.js-bulk-actions-select2').select2({
        minimumResultsForSearch: Infinity,
        templateResult: function (data, container) {
            if (data.element) {
                $(container).addClass($(data.element).attr("class"));
                if($(data.element).hasClass('bulk-delete'))
                {
                    $data = $('<span class="d-inline-flex"><i class="mdi mdi-delete font-size-14 me-1"></i> <span>' + data.text + '</span></span>');
                    return $data;
                }
            }
            return data.text;
        }
    });

    $('#listSearch').keyup(function() {
        filter();
    });

    $('#categoryFilter').on('change', function()
    {
        filter();
    });

    $('#stockStatusFilter').on('change', function()
    {
        filter();
    });

    function filter()
    {
        var query = $('#listSearch').val();
        listTable.search(query);

        var categoryName = $('#categoryFilter').val() ? $('#categoryFilter').find(':selected').text() : '';
        listTable.column('#js-filter-category').search(categoryName);

        var inStockVal = $('#stockStatusFilter').val();
        listTable.column('#js-filter-in-stock').search(inStockVal);

        listTable.draw();
    }
});
