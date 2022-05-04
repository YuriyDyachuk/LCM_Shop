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

    $('#js-product-category-add-form').on('submit', function(e)
    {
        e.preventDefault();
        if (!$(this).valid())
        {
            return;
        }

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            cache: false,
            success: function (result) {
                if (!('success' in result) || !result.success)
                {
                    alertShow('Unexpected error');
                }

                $('#addCategoryModal').modal('hide');
                window.location.reload();
            },
            error: function (jqXHR, exception)
            {
                ajaxErrorMessage(jqXHR, exception, $('#js-product-category-add-form').validate());
            },
        });

    });

    $('.js-product-category-validate-form').validate({
        rules: {
            name : {
                required: true,
                minlength: 3,
                maxlength : 255,
            },
        },
        messages: {
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        }
    });

    $('#addCategoryModal').on('hidden.bs.modal', function (event) {
        var form = $('#js-product-category-add-form');
        form.trigger('reset');
        form.validate().resetForm();
    });

    $('#editCategoryModal').on('show.bs.modal', function (event) {
        var link = $(event.relatedTarget);
        var form = $('#js-product-category-edit-form');
        form.find('[name="item_id"]').val(link.data('item-id'));
        form.attr('action', link.data('action-update'));

        $.ajax({
            type: 'GET',
            url: link.data('action-edit'),
            dataType: 'json',
            cache: false,
            success: function (result) {
                if (!('success' in result) || !result.success)
                {
                    alertShow('Unexpected error');
                }

                $.each(result.item, function(key, val) {
                    var field = form.find('[name="' + key + '"]');
                    if (!field)
                    {
                        return true;
                    }

                    switch (field.prop('tagName'))
                    {
                        case 'SELECT': field.val(val).trigger('change'); break;
                        default: field.val(val);
                    }
                });
            },
            error: function (jqXHR, exception)
            {
                ajaxErrorMessage(jqXHR, exception);
            },
        });
    });

    $('#js-product-category-edit-form').on('submit', function(e)
    {
        e.preventDefault();
        if (!$(this).valid())
        {
            return;
        }

        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            dataType: 'json',
            cache: false,
            success: function (result) {
                if (!('success' in result) || !result.success)
                {
                    alertShow('Unexpected error');
                }

                $('#editCategoryModal').modal('hide');
                window.location.reload();
            },
            error: function (jqXHR, exception)
            {
                ajaxErrorMessage(jqXHR, exception, $('#js-product-category-edit-form').validate());
            },
        });

    });

    $('#editCategoryModal').on('hidden.bs.modal', function (event) {
        var form = $('#js-product-category-edit-form');
        form.trigger('reset');
        form.validate().resetForm();
    });
});
