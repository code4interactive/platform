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
        this.userId = currentUserId;
    }

    Platform.prototype = {
        _init: function(){
            var self = this;
            //BOOTSTRAP TOOLTIPS and POPOVERS
            $('[rel=tooltip],[data-rel=tooltip]').tooltip({html: true});
            $('[rel=popover],[data-rel=popover]').popover({html:true});

            $('#testReload').on('click', function() {
                $.ajax({
                        url: '/testReload',
                        async: false,
                        global: false,
                        type: "GET",
                        dataType: "json",
                        success: function( data, textStatus, jqXHR ){
                            self._handleServerResponse(jqXHR);
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            self._handleServerError(jqXHR, textStatus, errorThrown);
                        }
                    }
                );
            });


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
        },

        //Login window
        login: function() {

        },

        //lockout
        lockout: function() {
            var self = this;
            $.ajax({
                    url: '/lockout/' + self.userId,
                    async: false,
                    global: false,
                    type: "GET",
                    dataType: "html",
                    success: function( data, textStatus, jqXHR ){
                        self.$body.find('.fullScreenModal').remove();
                        self.$body.addClass("modal-open");
                        self.$body.append('<div class="fullScreenModal gray-bg animated slideInDown">' + data + '</div>')
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        self._handleServerError(jqXHR, textStatus, errorThrown);
                    }
                }
            );
        },

        lockoutExit: function() {
            var self = this;
            self.$body.removeClass("modal-open");
            $('.fullScreenModal').removeClass('slideInDown').addClass('slideOutUp').delay(100).remove();
        },

        _handleServerResponse: function(jqXHR) {
            var self = this;
            if (jqXHR.status == 200) {
                var responseText = JSON.parse(jqXHR.responseText);
                if ('actions' in responseText) {
                    $.each(responseText.actions, function(i, actions){

                        for(var action in actions) {
                            var command = actions[action];
                            if (action === 'exitLockout') {
                                self.lockoutExit();
                            }
                            if (action === 'redirect') {
                                window.location.replace(command);
                            }
                            if (action === 'reload') {
                                window.location.reload(command);
                            }
                            if (action === 'eval') {
                                eval(command);
                            }
                            if (action === 'checkNotifications') {
                                $.notifications.check();
                            }
                            if (action === 'notifications') {
                                $.notifications.handleNotifications(command);
                            }
                            if (action === 'reloadDataTable') {
                                $(command).DataTable().ajax.reload(null, false);
                            }
                        }
                    });
                }
            }
        },

        _handleServerError: function(jqXHR, textStatus, errorThrown) {
            console.log(jqXHR);
            var self = this;
            if (jqXHR.status == 401) {
                //unauthorized
                $.platform.lockout();
            } else if (jqXHR.status == 302) {
                //redirect
                console.log('redirect ' + jqXHR.responseText);
                window.location.replace(jqXHR.responseText);
            } else if (jqXHR.status == 403) {
                //Forbidden
                $.notifications.showError("Brak uprawnień", "Nie masz uprawnień do tego zasobu!");
            }

            /*else  if (jqXHR.status == 200) {
                //OK
                var responseText = JSON.parse(jqXHR.responseText);
                if ('action' in responseText) {
                    if (responseText.action == 'exitLockout') {
                        self.lockoutExit();
                    }
                }

            }*/

        }
    };
    $.platform = new Platform();

})(jQuery, window, document);


$( document ).ready( function(){

    //$.cookie.json = true;
    $.platform._init();
    $.notifications._init();
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


function code4Loading(action) {
    if (action == 'start') {
        $('#code4-loading').css('right', '0px');
    }
    else {
        $('#code4-loading').css('right', '-135px');
    }

}

