$(function(){

    $(".chzn-select").chosen();

    $('textarea[class*=autosize]').autosize({append: "\n"});
    $('textarea[class*=limited]').each(function() {
        var limit = parseInt($(this).attr('data-maxlength')) || 100;
        $(this).inputlimiter({
            "limit": limit,
            remText: '%n character%s remaining...',
            limitText: 'max allowed : %n.'
        });
    });

});