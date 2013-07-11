$(function(){

    //BOOTSTRAP TOOLTIPS and POPOVERS
    $("[rel=tooltip]").tooltip();
    $("[rel=popover]").popover();

    $('[data-rel=tooltip]').tooltip();
    $('[data-rel=popover]').popover({html:true});

    //Pobieramy eventy
    //parent.getEvents();



    var notification = new platform.notification();

    var currentTime = new Date();
    var seconds = currentTime.getSeconds();

    //$(document).ready( function() {
    notification.check();

    //});

    //var counter=setInterval(clock, 1000);


/*
    var oldie = $.browser.msie && $.browser.version < 9;

    var barColor = 'rgba(255,255,255,0.95)';
    var trackColor = barColor == 'rgba(255,255,255,0.95)' ? 'rgba(255,255,255,0.25)' : '#E2E2E2';
    var size = parseInt($('.code4-time').data('size')) || 50;
    $('.code4-time').easyPieChart({
        barColor: 'rgba(255,255,255,0.95)',
        trackColor: trackColor,
        scaleColor: false,
        lineCap: 'butt',
        lineWidth: parseInt(size/10),
        animate: oldie ? false : 1000,
        size: size
    });
*/


    function clock() {
        if (seconds > 60) seconds = 1;
        if (seconds == 1)

            currentTime = new Date();
        $('.code4-time .time').html( (currentTime.getHours()<10?'0':'') + currentTime.getHours() + ':' +  (currentTime.getMinutes()<10?'0':'') + currentTime.getMinutes() )


        $('.code4-time').data('easyPieChart').update(Math.floor((seconds/60)*100));

        //$('.code4-time').data('percent', Math.floor((seconds/60)*100) );
        seconds++;
    }
});
function code4Loading(action) {

    if (action == 'start') {
        $('.code4-loading').css('margin-bottom', '0px');
    }
    else {
        $('.code4-loading').css('margin-bottom', '-40px');
    }

}