$(document).ready(function() {
    // Warning Message on Delete
    $('.js-delete').click(function () {

        var deleteAction = $(this).data('action');

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#34c38f",
            cancelButtonColor: "#f46a6a",
            confirmButtonText: "Yes, delete it",
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

    $('#bulkDelete').on('click', function()
    {
        var ids = $('input.js-check-item-id:checkbox:checked').map(function(){
            return $(this).val();
        }).get();

        bulkDelete(ids);
    });

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

                $('#bulkDelete').prop('disabled', true);
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
                        $('#bulkDelete').prop('disabled', false);
                        ajaxErrorMessage(jqXHR, exception);
                    },
                });

            },
        });

    }

    var listTable = $('#discountTable').DataTable({
        processing: false,
        searching: true,
        paging: true,
        pageLength: 20,
        pagingType: 'full_numbers',
        columnDefs: [
            {
                orderable: false,
                targets: [1, 6]
            }
        ],
        responsive: {
            details: {
                renderer: $.fn.dataTable.Responsive.renderer.listHiddenNodes()
            }
        },
        order: [[2, 'asc']],
        dom: "<'row'<'col-sm-12'tr>>" +
            "<'row mt-md-2'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 mt-3 mt-md-0'p>>",
    });

    $('#listSearch').keyup(function() {
        listTable.search($(this).val()).draw();
    });

    $('body').on('change', '.js-category-switch', function() {
        if( $(this).is(':checked') ) {
            $(this).closest('tr').removeClass('list-row-disabled');
        } else {
            $(this).closest('tr').addClass('list-row-disabled');
        }

        var action = $(this).data('action');

        $.ajax({
            type: 'POST',
            url: action,
            data: {_method: 'put', is_active: $(this).prop('checked') ? 1 : 0},
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

});
