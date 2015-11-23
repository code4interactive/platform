(function($, window, document) {
    'use strict';
    var defaults = {
        activityFeedUrl: '/getActivityFeed',
        watchThreadUrl: '/watchThread'
    };

    function Activity(options) {
        this.opt = $.extend({}, defaults, options);
        this.$body = $(document.body);
        this.$window = $(window);
    }

    Activity.prototype = {
        _init: function(){
            var self = this;

            //data-action getActivityFeed
            $('[data-action=getActivityFeed]').each(function(i, el){
                self.getActivityFeed(el);
            });

            //data-action="watch_thread" data-thread="{!! $thread->id !!}"
            $(document).on('click', '[data-action=watchThread]', function(){
                var feedId = $(this).attr('data-thread');
                self.watchThread(feedId);
            });

        },

        getActivityFeed: function(target) {
            var self = this;
            var feedName = $(target).attr('data-activity-feed');
            var requestData = {
              'feedSubject': feedName
            };
            $.ajax({
                    url: self.opt.activityFeedUrl,
                    async: true,
                    global: false,
                    type: "POST",
                    data: requestData,
                    dataType: "html",
                    success: function( data, textStatus, jqXHR ){
                        self.showFeed(data, target);
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        self._handleServerError(jqXHR, textStatus, errorThrown);
                    }
                }
            );
            return null;
        },

        watchThread: function(feedId) {
            var self = this;
            $.ajax({
                url: self.opt.watchThreadUrl+'/'+feedId,
                async: true,
                global: false,
                type: "GET",
                dataType: "json",
                success: function( data, textStatus, jqXHR ){
                    $.platform._handleServerResponse(jqXHR);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    self._handleServerError(jqXHR, textStatus, errorThrown);
                }
            });
        },

        reloadFeed: function(feedName) {
            var self = this;
            $('[data-activity-feed='+feedName+']').each(function(i, el){
                self.getActivityFeed(el);
            });
        },

        _handleServerError: function(jqXHR, textStatus, errorThrown) {
            $.platform._handleServerError(jqXHR, textStatus, errorThrown);
        },

        showFeed: function (data, target) {
            $(target).html(data);
        }


    };

    $.activity = new Activity();

})(jQuery, window, document);



