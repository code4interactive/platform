(function($, window, document) {
    'use strict';
    var defaults = {
        unloadMessage: 'Zamierzasz opuścić stronę na której są niezapisane dane. Czy napewno?',
        monitorForUnsavedChanges: false,
        unsaved: false
    };

    function C4Forms(options) {
        this.opt = $.extend({}, defaults, options);
        this.$body = $(document.body);
        this.$window = $(window);
    }

    C4Forms.prototype = {
        _init: function(){
            var self = this;
            if (self.opt.monitorForUnsavedChanges === true) {
                self.alertUnsavedChanges();
            }

            //BIND FORMS
            $(document.body).on('click', 'form.ajax button[type="submit"], form.ajax input[type="submit"]', function(){
                var options = {
                    beforeSubmit:  self.showRequest,  // pre-submit callback
                    success:       self.showResponse,  // post-submit callback
                    error:         self.showErrors,

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
        },

        alertUnsavedChanges: function(){
            var self = this;

            $(document).on('change', 'form[method=post]:not([data-remote]) :input', function() {
                return self.opt.unsaved = true;
            });

            $(document).on('page:change', function() {
                return setTimeout((function() {
                    return self.opt.unsaved = false;
                }), 10);
            });

            $(document).on('submit', 'form[method=post]', function() {
                self.opt.unsaved = false;
            });

            $(window).bind('beforeunload', function() {
                if (self.opt.unsaved) {
                    return self.opt.unloadMessage;
                }
            });

            $(document).on('page:before-change', function(event) {
                if (self.opt.unsaved && !confirm(self.opt.unloadMessage)) {
                    return event.preventDefault();
                }
            });
        },

        // pre-submit callback
        showRequest: function(formData, jqForm, options) {

            $('.error').removeClass('error');
            $('.field-error').remove();
            $('.messageBox').empty();
            $('button[type="submit"], input[type="submit"]').attr("disabled", true);

            $('.processingIndicator').css( 'display', 'block');
            return true;
        },

        // post-submit callback
        showResponse: function(responseText, statusText, xhr, $form)  {
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
                    if (typeof responseText.evalScript !== "undefined") {
                        eval("("+responseText.evalScript+")");
                    }
                }
            }
        },

        // Iterując po tablicy błędów wyświetla je przy ospowiednich polach
        showFieldErrors: function($form, errors) {
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
        },
        // onError callback
        showErrors: function(response, status, statusText, $form) {
            var self = this;
            toastr.error("W przesłanym formularzu są błędy", "Błąd formularza");
            return $.c4forms.showFieldErrors($form, response.responseText);
        },
        ajaxSuccess: function() {}
    };

    $.c4forms = new C4Forms();

})(jQuery, window, document);



