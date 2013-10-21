(function($, window, document) {

    'use strict';

    var defaults = {
        requestData: {
            responseTarget: "default",
            responseVariant: "getEvents",
            responseType: "json"
        }
    }

    function Notifications(options) {
        this.opt = $.extend({}, defaults, options);
        this.$body = $(document.body);
        this.$window = $(window);
        this.id;
    }

    Notifications.prototype = {
        _init: function(){

        },

        clear: function() {

            $('#gritter-notice-wrapper').remove();
        },

        check: function(async) {
            var self = this
            async = typeof async !== 'undefined' ? async : false;
            $.ajax({
                    url: "/getNotifications",
                    async: async,
                    global: false,
                    type: "POST",
                    data: self.opt.requestData,
                    dataType: "json",
                    beforeSend: function(data){

                    },
                    success: function( data, textStatus, jqXHR ){
                        self._handleServerSuccess(data, textStatus, jqXHR);
                    },
                    complete: function(eCode){
                        //loadingLayer(false);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        self._handleServerError(jqXHR, textStatus, errorThrown);
                        //loadingLayer(data,true);
                    }
                }
            );
            return null;
        },

        _handleServerSuccess: function (data, textStatus, jqXHR) {
            var self = this;
            /*[
                {"message":"Success message","format":"<div class=\"alert alert-:type\">:message<\/div>","type":"success","flashable":false,"alias":null,"position":null},
                {"message":"Success message2","format":"<div class=\"alert alert-:type\">:message<\/div>","type":"success","flashable":false,"alias":null,"position":null},
                {"message":"Success message","format":"<div class=\"alert alert-:type\">:message<\/div>","type":"error","flashable":false,"alias":null,"position":null}
            ]*/

            $.each(data, function(l, n){

                if (typeof n == 'object') {

                    switch (n.type) {
                        case "info":
                            self.showInfo("Informacja", n.message);
                            break;
                        case "success":
                            self.showSuccess("Sukces", n.message);
                            break;
                        case "warning":
                            self.showWarning("Ostrzeżenie", n.message);
                            break;
                        case "error":
                            self.showError("Wystąpił błąd", n.message, true);
                            break;
                    }

                }

            });


        },

        showInfo: function (title, text, sticky, image) {
            this.showMessage(title, text, 'info', sticky, image);
        },

        showSuccess: function (title, text, sticky, image) {
            this.showMessage(title, text, 'success', sticky, image);
        },

        showWarning: function (title, text, sticky, image) {
            this.showMessage(title, text, 'warning', sticky, image);
        },

        showError: function (title, text, sticky, image) {
            this.showMessage(title, text, 'error', sticky, image);
        },

        showMessage: function (title, text, type, sticky, image) {

            title = typeof title == 'undefined' ? '' : title;
            text = typeof text == 'undefined' ? '' : text;
            type = typeof type == 'undefined' ? 'info' : type;
            sticky = typeof sticky == 'undefined' ? false : sticky;
            image = typeof image == 'undefined' ? false : image;
            var class_name = 'gritter-info';


            switch(type) {

                case 'info':
                    class_name = 'gritter-info';
                    break;
                case 'success':
                    class_name = 'gritter-success';
                    break;
                case 'warning':
                    class_name = 'gritter-warning';
                    break;
                case 'error':
                    class_name = 'gritter-error';
                    break;
            }


            this.id = $.gritter.add({
                // (string | mandatory) the heading of the notification
                title: title,
                // (string | mandatory) the text inside the notification
                text: text,
                // (string | optional) the image to display on the left
                image: image,
                // (bool | optional) if you want it to fade out on its own or just sit there
                sticky: sticky,
                // (int | optional) the time you want it to be alive for before fading out (milliseconds)
                time: 8000,
                // (string | optional) the class name you want to apply directly to the notification for custom styling
                class_name: class_name,
                fade_in_speed: 'medium', // how fast notifications fade in (string or int)
                fade_out_speed: 1, // how fast the notices fade out

                // (function | optional) function called before it opens
                before_open: function(){
                    //alert('I am a sticky called before it opens');
                },
                // (function | optional) function called after it opens
                after_open: function(e){
                    //alert("I am a sticky called after it opens: \nI am passed the jQuery object for the created Gritter element...\n" + e);
                },
                // (function | optional) function called before it closes
                before_close: function(e, manual_close){
                    // the manual_close param determined if they closed it by clicking the "x"
                    //alert("I am a sticky called before it closes: I am passed the jQuery object for the Gritter element... \n" + e);
                },
                // (function | optional) function called after it closes
                after_close: function(){
                    //alert('I am a sticky called after it closes');
                }
            });

        }
    }

    $.notifications = new Notifications();

})(jQuery, window, document);

/*
(function ($) {
    "use strict";


    platform.notification = function () {

        var t = this;
        this.$ = jQuery;
        this.objects = {};
        this.config = {

            'error': {
                'btnColor': 'btn-danger',
                'txtColor': 'text-error',
                'icon': 'icon-remove-sign'
            },

            'success': {
                'btnColor': 'btn-success',
                'txtColor': 'text-success',
                'icon': 'icon-ok-sign'
            },
            'warning': {
                'btnColor': 'btn-warning',
                'txtColor': 'text-warning',
                'icon': 'icon-warning-sign'
            },
            'info': {
                'btnColor': 'btn-info',
                'txtColor': 'text-info',
                'icon': 'icon-info-sign'
            }
        }


        this.check = function () {
            var sendData = {};
            sendData.responseTarget = "default";
            sendData.responseVariant = "getEvents";
            sendData.responseType = "json";
            $.ajax({
                    url: "/",
                    async: false,
                    global: false,
                    type: "POST",
                    data: sendData,
                    dataType: "json",
                    beforeSend: function(data){
                        //loadingLayer(true);
                    },
                    success: function( data, textStatus, jqXHR ){
                        t.handleServerSuccess(data, textStatus, jqXHR);
                    },
                    complete: function(eCode){
                        //loadingLayer(false);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        t.handleServerError(jqXHR, textStatus, errorThrown);
                        //loadingLayer(data,true);
                    }
                }
            );
            return null;
        };

        this.handleServerSuccess = function(data, textStatus, jqXHR){

            var errorCount = parseInt($('.all-notifications').html());

            if (data.length > 0) {

                $('.all-notifications').html(errorCount+data.length);
                $('.all-notifications-header span.count').html(errorCount+data.length);
                $('.notifications-dropdown').dropdown();

                var message = "";

                console.log(data);

                t.$.each(data, function (lp, note) {

                    message += '<li>';
                    message +='    <a href="#">';
                    message +='        <div class="clearfix">';
                    message +='            <span class="pull-left ' + t.config[note.type].txtColor + '">';
                    message +='                <i class="btn btn-mini no-hover ' + t.config[note.type].btnColor + ' ' + t.config[note.type].icon + '"></i>';
                    message +='               '+note.message;
                    message +='            </span>';
                    //message +='            <span class="pull-right badge badge-info">0</span>';
                    message +='       </div>';
                    message +='    </a>';
                    message +='</li>';


                });

                $('.notifications-dropdown li').eq(0).after(message);
                $('.notifications-toggle').dropdown('toggle');
            }
        }

        this.handleServerError = function(jqXHR, textStatus, errorThrown) {
            var errorCode = jqXHR.status;
            //var errorName = errorThrown;
            var errorMessage = jQuery.parseJSON(jqXHR.responseText).error;
            //type, message, line

            var message = '<li>';
            message +='     <a href="#">';
            message +='        <div class="clearfix">';
            message +='            <span class="pull-left">';
            message +='               <i class="btn btn-mini no-hover btn-danger icon-remove-sign"></i>';
            message +='            </span>';
            message +='            <span class="pull-right badge badge-important">status ' + errorCode + '</span>';
            message +='       </div>';
            message +='       <p style="text-align: left;">';
            message +='       ';
            message +='             <span class="span1 text-error">file:</span><span class="span11 text-info"> '+errorMessage.file + '</span><br/>';
            message +='             <span class="span1 text-error">line:</span><span class="span11 text-info"> '+errorMessage.line + '</span><br/>';
            message +='             <span class="span1 text-error">message:</span><span class="span11 text-info"> '+errorMessage.message + '</span><br/>';
            message +='             <span class="span1 text-error">type:</span><span class="span11 text-info"> '+errorMessage.type + '</span><br/>';
            message +='        ';
            message +='        </p>';
            message +='    </a>';
            message += '</li>';

            $('.notifications-dropdown li').eq(0).after(message);
            $('.notifications-toggle').dropdown('toggle');
        }



    };



}(jQuery));
*/
