(function($, window, document) {

    'use strict';

    var defaults = {
        requestData: {
            responseTarget: "default",
            responseVariant: "getEvents",
            responseType: "json"
        }
    }

    function C4forms(options) {
        this.opt = $.extend({}, defaults, options);
        this.$body = $(document.body);
        this.$window = $(window);
    }

    C4forms.prototype = {
        _init: function(){

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