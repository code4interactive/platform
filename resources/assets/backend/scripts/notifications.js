(function($, window, document) {

$.sound_path = "/packages/code4/platform/assets/SmartAdmin-1.3/sound/";

    'use strict';

    var defaults = {
        notificationsUrl: '/getNotifications',
        requestData: {
            responseTarget: "default",
            responseVariant: "getEvents",
            responseType: "json"
        },
        colors: {
            success: "#739E73",
            warning: "#C79121",
            error: "#C46A69",
            info: "#3276B1"
        }
    };

    function Notifications(options) {
        this.opt = $.extend({}, defaults, options);
        this.$body = $(document.body);
        this.$window = $(window);
//        this.id;
    }

    Notifications.prototype = {
        _init: function(){

        },

        clear: function() {
            $("#divSmallBoxes").empty();
        },

        check: function(async) {
            var self = this;
            async = typeof async !== 'undefined' ? async : false;
            $.ajax({
                    url: self.opt.notificationsUrl,
                    async: async,
                    global: false,
                    type: "POST",
                    data: self.opt.requestData,
                    dataType: "json",
                    beforeSend: function(data){
                    },
                    success: function( data, textStatus, jqXHR ){
                        //data = $.parseJSON(data);
                        if ('notifications' in data) {
                            self._handleServerSuccess(data.notifications, textStatus, jqXHR);
                        }
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
             0: {type: "error", notification: "Brak uprawnień do tworzenia tego zasobu", icon: "fa-times"}
             1: {type: "error", notification: "Brak uprawnień do tworzenia tego zasobu"}
             2: {type: "error", notification: "Brak uprawnień do tworzenia tego zasobu"}
            ]*/

            $.each(data, function(l, notification){

                if ('type' in notification) {
                    console.log(notification);

                    switch (notification.type) {
                        case "info":
                            self.showInfo("Informacja", notification.notification, false, notification.icon);
                            break;
                        case "success":
                            self.showSuccess("Sukces", notification.notification, false, notification.icon);
                            break;
                        case "warning":
                            self.showWarning("Ostrzeżenie", notification.notification, false, notification.icon);
                            break;
                        case "error":
                            self.showError("Wystąpił błąd", notification.notification, true, notification.icon);
                            break;
                    }

                }

            });


        },

        showInfo: function (title, text, sticky, icon) {
            this.showMessage(title, text, 'info', sticky, icon);
        },

        showSuccess: function (title, text, sticky, icon) {
            this.showMessage(title, text, 'success', sticky, icon);
        },

        showWarning: function (title, text, sticky, icon) {
            this.showMessage(title, text, 'warning', sticky, icon);
        },

        showError: function (title, text, sticky, icon) {
            this.showMessage(title, text, 'error', sticky, icon);
        },

        showMessage: function (title, text, type, sticky, icon) {

            title = typeof title == 'undefined' ? '' : title;
            text = typeof text == 'undefined' ? '' : text;
            type = typeof type == 'undefined' ? 'info' : type;
            sticky = typeof sticky == 'undefined' ? false : sticky;
            icon = typeof icon == 'undefined' ? 'fa-bell' : icon;

            var color;
            /*success: "#739E73",
            warning: "#C79121",
            info: "#C46A69",
            error: "#3276B1"*/

            switch(type) {
                case 'info':
                    toastr.info(title, text);
                    color = this.opt.colors.info;
                    break;
                case 'success':
                    toastr.success(title, text);
                    color = this.opt.colors.success;
                    break;
                case 'warning':
                    toastr.warning(title, text);
                    color = this.opt.colors.warning;
                    break;
                case 'error':
                    toastr.error(title, text);
                    color = this.opt.colors.error;
                    break;
            }


            $.smallBox({
                title : title,
                content : text,
                color : color,
                //timeout: 8000,
                icon : "fa " + icon
            });


        }
    }

    $.notifications = new Notifications();

})(jQuery, window, document);
