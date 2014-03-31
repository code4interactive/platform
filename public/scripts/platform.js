(function($, window, document) {

    'use strict';

    var defaults = {
        path_assets: "/packages/code4/platform/"

    };

    function Platform(options) {
        this.opt = $.extend({}, defaults, options);
        this.$body = $(document.body);
        this.$window = $(window);
    }

    Platform.prototype = {
        _init: function(){

            //BOOTSTRAP TOOLTIPS and POPOVERS
            $('[rel=tooltip],[data-rel=tooltip]').tooltip({html: true});
            $('[rel=popover],[data-rel=popover]').popover({html:true});

            this._timers();

        },
        _timers: function() {
            var self = this;
        },
        jsRedirect: function(redirectPath) {
            code4Loading('start');
            window.location=redirectPath;
        }
    };
    $.platform = new Platform();

})(jQuery, window, document);


$( document ).ready( function(){

    $.platform._init();
    $.c4forms._init();
    $.notifications.check();


    //Automatycznie sprawdza notyfikacje po kazdym wywolaniu przez ajax
    //wyjątkiem jest sytuacja kiedy wywolanie to sprawdzenie notyfikacji 
    $(document).ajaxSuccess(function(event, request, settings) {
        //console.log(settings);
        //if (!(isset(settings.data) && isset(settings.data.responseVariant))) $.notifications.check();
    });

    $(document).ajaxComplete(function(event, XMLHttpRequest, ajaxOptions){
        //console.log(ajaxOptions);
    });

} );



$(function(){




    //var notification = new platform.notification();

    var currentTime = new Date();
    var seconds = currentTime.getSeconds();

    //$(document).ready( function() {
    //notification.check();


    $(".table-striped").on("click change", "tbody tr", function(e) {

        if (e.target.nodeName === "BUTTON" || e.target.nodeName === "A") return;

        if ($(this).find(".row-checkbox")) {

            if ($(this).find(".row-checkbox").prop('checked')){
                $(this).find(".row-checkbox").prop('checked', false);
                $(this).removeClass("ui-state-highlight");
            }
            else {
                $(this).find(".row-checkbox").prop('checked', true);
                $(this).addClass("ui-state-highlight");
            }
        }
    });

    $(".table-striped").on("click change", "thead .row-checkbox", function(){

        if ($(this).prop('checked')) {
            $(this).prop('checked', false);
            $(this).closest('table').find('tbody .row-checkbox').prop('checked', false);
            $(this).closest('table').find('tr').removeClass("ui-state-highlight");
        }
        else {
            $(this).prop('checked', true);
            $(this).closest('table').find('tbody .row-checkbox').prop('checked', true);
            $(this).closest('table').find('tr').addClass("ui-state-highlight");
        }


    });

    code4Loading('stop');

});

function code4Loading(action) {
    if (action == 'start') {
        $('#code4-loading').css('right', '0px');
    }
    else {
        $('#code4-loading').css('right', '-135px');
    }

}

