(function($, window, document) {

    'use strict';

    var defaults = {
        options: {
            target:        '#output2',   // target element(s) to be updated with server response
            beforeSubmit:  showRequest,  // pre-submit callback
            success:       showResponse  // post-submit callback

            // other available options:
            //url:       url         // override for form's 'action' attribute
            //type:      type        // 'get' or 'post', override for form's 'method' attribute
            //dataType:  null        // 'xml', 'script', or 'json' (expected server response type)
            //clearForm: true        // clear all form fields after successful submit
            //resetForm: true        // reset the form after successful submit

            // $.ajax options can be used here too, for example:
            //timeout:   3000
        }
    }

    function C4forms(options) {
        this.opt = $.extend({}, defaults, options);
        this.$body = $(document.body);
        this.$window = $(window);
    }

    C4forms.prototype = {
        _init: function(){


        },
        _events: function() {

            $('form').not('no_ajax').on('submit', function(){



            })

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

        }
    }

    $.c4forms = new C4forms();

})(jQuery, window, document);






$(function(){

    $(".chzn-select").chosen();

    $('textarea[class*=autosize]').autosize({append: "\n"});
    $('textarea[class*=limited]').each(function() {
        var limit = parseInt($(this).attr('data-maxlength')) || 100;
        $(this).inputlimiter({
            "limit": limit,
            remText: '%n character%s remaining...',
            limitText: 'max allowed : %n.'
        });
    });

});