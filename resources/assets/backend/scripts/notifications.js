(function($, window, document) {
    'use strict';
    var defaults = {
        notificationsUrl: '/getNotifications',
        requestData: {
            responseTarget: "default",
            responseVariant: "getEvents",
            responseType: "json"
        }
    };

    function Notifications(options) {
        this.opt = $.extend({}, defaults, options);
        this.$body = $(document.body);
        this.$window = $(window);
    }

    Notifications.prototype = {
        _init: function(){
            /* TOASTR INIT */
            toastr.options = {
                "closeButton": true,
                "debug": false,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "onclick": null,
                "showDuration": "4000",
                "hideDuration": "5000",
                "timeOut": "10000",
                "extendedTimeOut": "10000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            };
            var self = this;
            /*setInterval(function(){
                self.check();
            }, 10000);*/

        },

        clear: function() {

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
                    success: function( data ){
                        //No notifiactions in data? Exit!
                        if (!('notifications' in data)) { console.log('No notifications field in received data'); return false; }
                        self.handleNotifications(data.notifications);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        self._handleServerError(jqXHR, textStatus, errorThrown);
                    }
                }
            );
            return null;
        },

        _handleServerError: function(jqXHR, textStatus, errorThrown) {
            $.platform._handleServerError(jqXHR, textStatus, errorThrown);
        },

        handleNotifications: function (data) {
            var self = this;

            /*[
             0: {type: "error", notification: "Brak uprawnień do tworzenia tego zasobu", icon: "fa-times"}
             1: {type: "error", notification: "Brak uprawnień do tworzenia tego zasobu", icon: "fa-times"}
             2: {type: "error", notification: "Brak uprawnień do tworzenia tego zasobu", icon: "fa-times"}
            ]*/

            $.each(data, function(l, notification){

                if ('type' in notification) {

                    switch (notification.type) {
                        case "info":
                            self.showInfo("Informacja", notification.notification, notification.icon);
                            break;
                        case "success":
                            self.showSuccess("Sukces", notification.notification, notification.icon);
                            break;
                        case "warning":
                            self.showWarning("Ostrzeżenie", notification.notification, notification.icon);
                            break;
                        case "error":
                            self.showError("Wystąpił błąd", notification.notification, notification.icon);
                            break;
                    }
                }
            });
        },

        showInfo: function (title, text, icon) {
            toastr.options.closeButton = false;
            toastr.info(text, '<h2>' + title + '</h2>');
        },

        showSuccess: function (title, text, icon) {
            toastr.options.closeButton = false;
            toastr.success(text, '<h2>' + title + '</h2>');
        },

        showWarning: function (title, text, icon) {
            toastr.options.closeButton = true;
            toastr.warning(text, '<h2>' + title + '</h2>');
        },

        showError: function (title, text, icon) {
            toastr.options.closeButton = true;
            toastr.error(text, '<h2>' + title + '</h2>');
        }

    };

    $.notifications = new Notifications();

})(jQuery, window, document);
