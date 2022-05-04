$(document).ready(function() {
    $('#js-promo-code-edit-form').validate({
        rules: {
            code : {
                required: true,
                minlength: 3,
                maxlength : 255,
            },
            amount : {
                required: true,
                min: 1,
            },
            apply_type : {
                required: true,
                minlength: 1,
                maxlength : 255,
            }

        },
        messages: {
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.parent('div'));
        }
    });

    $('#js-promo-code-edit-form').on('submit', function(e) {
        if (!$(this).valid()) {
            return false;
        }
    });

    $('.js-apply-select2').select2({
        minimumResultsForSearch: 6
    });

    $('.js-apply-select2').on('select2:select', function (e) {
        let selectedVal = $(this).val();

        $('.promocode-apply-wrap').each(function( index ) {

            if( $(this).data('promocodeApply') == selectedVal ) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        });
    });
    $('.js-apply-select2').trigger('select2:select');

    // Add products
    let addItemSelect2Options = {
        placeholder: '',
        allowClear: true,
        minimumResultsForSearch: 5
    }

    $('.js-add-item-select2').select2(addItemSelect2Options);

    $('.repeater').repeater({
        show: function () {
            $(this).slideDown();
            $('.repeater').find('select').next('.select2-container').remove();
            $('.repeater').find('.js-add-item-select2').select2(addItemSelect2Options);
        },

        hide: function (deleteElement) {
            Swal.fire({
                title: "Are you sure you want to delete this element?",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#34c38f",
                cancelButtonColor: "#f46a6a",
                confirmButtonText: "Confirm",
                preConfirm: function (result) {
                    // Ajax request
                },
            }).then(function (result) {
                console.log('result.value', result.value);
                if (result.value) {
                    $(this).slideUp(deleteElement);
                }
            });
        },

        ready: function (setIndexes) {
        },

        isFirstItemUndeletable: true
    })

});
