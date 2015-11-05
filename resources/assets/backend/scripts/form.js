// pre-submit callback
function showRequest(formData, jqForm, options) {

    $('.error').removeClass('error');
    $('.field-error').remove();
    $('.messageBox').empty();
    $('button[type="submit"], input[type="submit"]').attr("disabled", true);

    $('.processingIndicator').css( 'display', 'block');
    return true;
}

// post-submit callback
function showResponse(responseText, statusText, xhr, $form)  {
    $('.processingIndicator').css( 'display', 'none');
    $('button[type="submit"], input[type="submit"]').attr("disabled", false);

    if (typeof responseText.status !== "undefined") {

        if (responseText.status === "success") {

            //Obsługa jsRedirect
            if (typeof responseText.redirect !== "undefined") {
                $('.redirectOverlay').css('display','block');
                window.location.replace(responseText.redirect);
            }

            //Obsługa execScript
            if (typeof responseText.eval !== "undefined") {
                eval("("+responseText.eval+")");
            }


        }
    }
}

// Iterując po tablicy błędów wyświetla je przy ospowiednich polach
function showFieldErrors($form, errors) {
    $('.processingIndicator').css( 'display', 'none');
    $('button[type="submit"], input[type="submit"]').attr("disabled", false);

    //Jeżeli przeglądarka nie parsowała odpowiedzi serwera jako json robimy to ręcznie
    if (typeof errors === 'string') {
        errors = jQuery.parseJSON( errors );
    }

    //Przesłane błędy nie są w formacie JSON
    if (typeof errors !== 'object') { console.log('form.js: Errors are not in object form'); return false; }

    jQuery.each(errors, function(fieldName, messageArray) {
        var errorLabel = '';
        if (fieldName === 'messageBox') {
            var alertBox = $(document.createElement('div')).addClass('alert alert-danger');
            for (var op = 0; op < messageArray.length; op++) {
                alertBox.append('<p>'+messageArray[op]+'</p>');
            }
            $form.find('.messageBox').html(alertBox);
        } else if (fieldName === 'popup') {

        } else {
            for (var lp = 0; lp < messageArray.length; lp++) {
                errorLabel += '<label id="' + fieldName + '-error" class="error field-error" for="' + fieldName + '">' + messageArray[lp] + '</label>';
            }
            $form.find('#form-' + fieldName).addClass('error').parent().append(errorLabel);
        }
    });
    return true;
}

// onError callback
function showErrors(response, status, statusText, $form) {
    toastr.error("W przesłanym formularzu są błędy", "Błąd formularza");
    return showFieldErrors($form, response.responseText);
}

function ajaxSuccess() {

}



$(document).ready(function () {

    $(document.body).on('click', 'form.ajax button[type="submit"], form.ajax input[type="submit"]', function(){
        var options = {
            beforeSubmit:  showRequest,  // pre-submit callback
            success:       showResponse,  // post-submit callback
            error:         showErrors,

            type:          'post',
            dataType:      'json'
        };
        $('form.ajax').ajaxForm(options);
    });

    //CONFIRM DELETE
    $(document.body).on('click', '.confirmDelete', function(e){
        var message = 'Czy napewno usunąć "'+ $(this).data('name') +'"?';
        return confirm(message);
    });


});