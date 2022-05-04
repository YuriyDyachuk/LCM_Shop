function alertShow(text)
{
    'toastr' in window ? toastr.error(text) : alert(text);
}

function ajaxErrorMessage(jqXHR, exception, validator)
{
    if (validator && ('showErrors' in validator) && ('responseJSON' in jqXHR) && ('errors' in jqXHR.responseJSON))
    {
        $.each(jqXHR.responseJSON.errors, function(errorKey, errors) {
            var errorText = '';
            $.each(errors, function(key, error) {
                errorText += error + ' ';
            });
            validator.showErrors({[errorKey]: errorText});
        });

        return;
    }

    var msg = '';
    if (jqXHR.status === 0) {
        msg = 'Not connect.\n Verify Network.';
    } else if (jqXHR.status == 404) {
        msg = 'Requested page not found. [404]';
    } else if (jqXHR.status == 500) {
        msg = 'Internal Server Error [500].';
    } else if (exception === 'parsererror') {
        msg = 'Requested JSON parse failed.';
    } else if (exception === 'timeout') {
        msg = 'Time out error.';
    } else if (exception === 'abort') {
        msg = 'Ajax request aborted.';
    } else {
        msg = 'Uncaught Error.\n' + jqXHR.responseText;
    }

    alertShow(msg);
}

$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function serverShowMessages()
    {
        if (!('toastr' in window))
        {
            return;
        }

        var message = $.trim($('#js-server-message-success').html());
        if (message.length)
        {
            toastr.success(message);
        }

        message = $.trim($('#js-server-message-errors').html());
        if (message.length)
        {
            toastr.error(message);
        }

        $('#js-server-messages-box').remove();
    }
    serverShowMessages();

    $('.js-validation-alert-box .js-btn-close').on('click', function (){
       $(this).closest('.js-validation-alert-box').fadeOut('slow', function() {
          $(this).remove();
       });
    });


});
