$(document).ready(function() {
    $('input[name="phone"]').inputmask({"mask": "(999) 999-9999"});
    $.validator.setDefaults({ ignore: [] });
    $('#js-customer-edit-form').validate({
        rules: {
            first_name : {
                required: true,
                minlength: 3,
                maxlength : 255,
            },
            last_name : {
                required: true,
                minlength: 3,
                maxlength : 255,
            },
            email : {
                required: true,
                email: true
            },
            phone : {
                required: true,
            },
            password : {
                required: false,
                minlength : 6
            },
            password_confirmation: {
                required: false,
                minlength : 6,
                equalTo : "#nc_password"
            }
        },
        messages: {
        },
        errorPlacement: function (error, element) {
            error.appendTo(element.parent('div'));
        }
    });

    $('#js-customer-edit-form').on('submit', function(e) {
        if (!$(this).valid()) {
            return false;
        }
    });

    $('.js-state-select2').select2({
        placeholder: '',
        allowClear: true,
        tags: true,
        //Allow manually entered text in drop down.
        createSearchChoice: function (term, data) {
            if ($(data).filter(function () {
                return this.text.localeCompare(term) === 0;
            }).length === 0) {
                return { id: term, text: term };
            }
        },
    });
});
