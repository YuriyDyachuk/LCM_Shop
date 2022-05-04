$(document).ready(function() {

    $('#js-discount-edit-form').validate({
        rules: {
            name : {
                required: true,
                minlength: 3,
                maxlength : 255,
            },
            product_apply_type : {
                required: true,
            },
            type : {
                required: true,
                minlength: 1,
                maxlength : 255,
            },
            priority : {
                required: true,
                min: 1,
            },
            membership_type_id : {
                required: true,
                min: 1,
            },
        },
        messages: {
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.parent('div'));
        }
    });

    $('#js-discount-edit-form').on('submit', function(e) {
        if (!$(this).valid()) {
            return false;
        }
    });

    $('.js-membership-type-select2, .js-discount-type-select2, .js-product-apply-select2').on('select2:close', function (e) {
        $(this).valid();
    });

    $('.js-membership-type-select2').select2({
        placeholder: '',
        minimumResultsForSearch: 6
    });

    $('.js-discount-type-select2').select2({
        placeholder: '',
        minimumResultsForSearch: 6
    });

    function applyToControl()
    {
        if ($('.js-discount-type-select2').val() === window.typeCodeProductPriceFixed)
        {
            $('.js-product-apply-select2').val(window.productApplyTypeProductSeveral).trigger('change');
            $('.js-product-apply-select2').trigger('select2:select');
        }
    }

    // Show edditional settings based on type
    $('.js-discount-type-select2').on('select2:select', function (e) {
        applyToControl();

        let selectedType = $(this).val();

        $('.discount-type-wrap').each(function( index ) {

            if( $(this).data('discountType') == selectedType ) {
                $(this).removeClass('d-none');
            } else {
                $(this).addClass('d-none');
            }
        });
    });
    $('.js-discount-type-select2').trigger('select2:select');

    function discountTypeControl()
    {
        if ($('.js-product-apply-select2').val() === window.productApplyTypeAllProduct &&
            $('.js-discount-type-select2').val() === window.typeCodeProductPriceFixed
        )
        {
            $('.js-discount-type-select2').val('').trigger('change');
            $('.js-discount-type-select2').trigger('select2:select');
        }
    }
    $('.js-product-apply-select2').select2({
        placeholder: '',
        minimumResultsForSearch: Infinity,
    });
    $('.js-product-apply-select2').on('select2:select', function (e) {
        $(this).val() === window.productApplyTypeProductSeveral ? $('#js-products-box').removeClass('d-none') :
            $('#js-products-box').addClass('d-none');
        discountTypeControl();
    });
    $('.js-product-apply-select2').trigger('select2:select');

    // Add products
    let addItemSelect2Options = {
        placeholder: '',
        allowClear: true
    }

    $('.js-add-item-select2').select2(addItemSelect2Options);
    $('.js-quantity-discount-type-select2').select2();

    $('.repeater').repeater({
        show: function () {
            $(this).slideDown();
            $('.repeater').find('select').next('.select2-container').remove();
            $('.repeater').find('.js-add-item-select2').select2(addItemSelect2Options);
            $('.repeater').find('.js-quantity-discount-type-select2').select2();
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
