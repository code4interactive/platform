$(function(){

    //BOOTSTRAP TOOLTIPS and POPOVERS
    $("[rel=tooltip]").tooltip();
    $("[rel=popover]").popover();

    //Pobieramy eventy
    //parent.getEvents();



    var notification = new platform.notification();

    var currentTime = new Date();
    var seconds = currentTime.getSeconds();

    //$(document).ready( function() {
        notification.check();

    //});

    var counter=setInterval(clock, 1000);

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