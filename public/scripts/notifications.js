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

