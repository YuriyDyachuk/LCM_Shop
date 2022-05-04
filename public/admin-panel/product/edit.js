$(document).ready(function() {
    function tinymceInit()
    {
        if(!$("#product_description").length)
        {
            return;
        }

        tinymce.init({
            selector: "textarea#product_description",
            height: 200,
            branding: false,
            menubar: false,
            plugins: [
                "advlist link lists",
            ],
            toolbar: "undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist",
        });
    }
    tinymceInit();

    $('#js-product-edit-form').validate({
        rules: {
            sku : {
                required: true,
                minlength: 3,
                maxlength : 255,
            },
            name : {
                required: true,
                minlength: 3,
                maxlength : 255,
            },
            category_id : {
                required: true,
                min: 1,
            },
            price : {
                required: true,
                min: 1,
            },
            quantity : {
                required: false,
                min: 0,
            },
        },
        messages: {
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.parent('div'));
        }
    });

    $('.js-product-edit-form-link').on('click', function(e) {
        e.preventDefault();

        $('#js-product-edit-form .js-is-apply').val($(this).data('is-apply'));

        $('#js-product-edit-form').submit();
    });

    $('#js-product-edit-form').on('submit', function(e) {
        if (!$(this).valid()) {
            return false;
        }
    });

    $('#product_category').on('select2:close', function (e) {
        $(this).valid();
    });

    $('.js-product-is-virtual').on('change', function (){
        productDisplayStockParams();
    });

    function productDisplayStockParams()
    {
        var isNotVirtualGoods = $('.js-product-is-virtual').prop('checked');
        if (isNotVirtualGoods)
        {
            $('.js-not-for-virtual-goods').hide();
            $('.js-not-for-virtual-goods select').val(0).trigger('change');
            $('.js-not-for-virtual-goods input').val('');
        } else {
            $('.js-not-for-virtual-goods').show();
        }
        
    }
    productDisplayStockParams();

});
