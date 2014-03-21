(function($, window, document) {

    'use strict';

    var defaults = {
        options: {
            //target:        '#output2'   // target element(s) to be updated with server response
            //beforeSubmit:  showRequest,  // pre-submit callback
            //success:       showResponse  // post-submit callback

            // other available options:
            //url:       url         // override for form's 'action' attribute
            type:      'post'       // 'get' or 'post', override for form's 'method' attribute
            //dataType:  'json'        // 'xml', 'script', or 'json' (expected server response type)
            //clearForm: true        // clear all form fields after successful submit
            //resetForm: true        // reset the form after successful submit

            // $.ajax options can be used here too, for example:
            //timeout:   3000
        }
    };

    function C4forms(options) {
        this.opt = $.extend({}, defaults, options);
        this.opt.beforeSubmit = this.beforeSubmit;
        this.opt.success = this.showResponse;
        this.$body = $(document.body);
        this.$window = $(window);
    }

    C4forms.prototype = {
        _init: function(){

            this._events();

        },
        _events: function() {
            var self = this;

            $('form').not('.no_ajax').on('submit', function(e){
                e.preventDefault();
                //$(this).submit(function() {
                    // inside event callbacks 'this' is the DOM element so we first
                    // wrap it in a jQuery object and then invoke ajaxSubmit
                    $(this).ajaxSubmit(self.opt);

                    // !!! Important !!!
                    // always return false to prevent standard browser submit and page navigation
                    return false;
               // });

            });

        },

        submitForm: function() {

            //Take target url from hidden fields
            //Attach callbacks to handle response

                // bind to the form's submit event
                $('#myForm2').submit(function() {
                    // inside event callbacks 'this' is the DOM element so we first
                    // wrap it in a jQuery object and then invoke ajaxSubmit
                    $(this).ajaxSubmit(options);

                    // !!! Important !!!
                    // always return false to prevent standard browser submit and page navigation
                    return false;
                });

        },

        beforeSubmit: function(arr, $form, options) {
            // The array of form data takes the following form:
            // [ { name: 'username', value: 'jresig' }, { name: 'password', value: 'secret' } ]

            // return false to cancel submit
            $('.error-block').remove();
            $('.form-group').removeClass('has-error');
            $('#gritter-notice-wrapper').remove();

        },
        showResponse: function(responseText, statusText, xhr, $form)  {
            var self = this;
            // for normal html responses, the first argument to the success callback
            // is the XMLHttpRequest object's responseText property

            // if the ajaxSubmit method was passed an Options Object with the dataType
            // property set to 'xml' then the first argument to the success callback
            // is the XMLHttpRequest object's responseXML property

            // if the ajaxSubmit method was passed an Options Object with the dataType
            // property set to 'json' then the first argument to the success callback
            // is the json data object returned by the server

            /*alert('status: ' + statusText + '\n\nresponseText: \n' + responseText +
                '\n\nThe output div should have already been updated with the responseText.');*/

            if (responseText.length > 0) {

                for (var lp=0; responseText.length > lp; lp++) {

                    if (responseText[lp].id !=='undefined') {

                        var markup = '<span class="error-block help-block col-xs-12 col-sm-reset inline text-danger"><span class="middle">'+ responseText[lp].message+'</span></span>';
                        $('#'+responseText[lp].id).closest('.form-group').addClass('has-error').append(markup);

                    }

                }

            }

        },
        showErrors: function(id, message) {



        }
};

    $.c4forms = new C4forms();

})(jQuery, window, document);






$(function(){

    /*$(".chzn-select").chosen();

    $('textarea[class*=autosize]').autosize({append: "\n"});
    $('textarea[class*=limited]').each(function() {
        var limit = parseInt($(this).attr('data-maxlength')) || 100;
        $(this).inputlimiter({
            "limit": limit,
            remText: '%n character%s remaining...',
            limitText: 'max allowed : %n.'
        });
    });*/

});