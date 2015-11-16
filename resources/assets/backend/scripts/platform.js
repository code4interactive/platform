(function($, window, document) {
    'use strict';
    var defaults = {
        path_assets: "/packages/code4/platform/",
        menuMinified: false
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

            //Load from cookies
            /*var retrievedObject = $.cookie('platform');

            if (retrievedObject) {
                this.opt = $.extend({}, this.opt, JSON.parse(retrievedObject));
            }

            if (this.opt.menuMinified) { $('body').addClass('minified'); }*/

            this._timers();
        },
        _timers: function() {
            var self = this;
        },
        store: function(item, value) {
            /*this.opt[item] = value;
            $.removeCookie('platform');
            $.cookie('platform', JSON.stringify(this.opt), { expires: 365, path: '/' });*/
        }
    };
    $.platform = new Platform();

})(jQuery, window, document);


$( document ).ready( function(){

    //$.cookie.json = true;
    $.platform._init();
    $.notifications.check();

    $.notifications.showInfo('aaa','sss');

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


function code4Loading(action) {
    if (action == 'start') {
        $('#code4-loading').css('right', '0px');
    }
    else {
        $('#code4-loading').css('right', '-135px');
    }

}

