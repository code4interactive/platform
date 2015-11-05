$(document).ready(function () {
    $('.i-checks').iCheck({
        checkboxClass: 'icheckbox_square-green',
        radioClass: 'iradio_square-green'
    });


    var config = {
        '.chosen-select'           : {},
        '.chosen-select-deselect'  : {allow_single_deselect:true},
        '.chosen-select-no-single' : {disable_search_threshold:10},
        '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
        '.chosen-select-width'     : {width:"95%"}
    };
    for (var selector in config) {
        $(selector).chosen(config[selector]);
    }


    /* PIETY */
    $("span.pie").peity("pie", {
        fill: ['#1ab394', '#d7d7d7', '#ffffff']
    });

    $(".line").peity("line",{
        fill: '#1ab394',
        stroke:'#169c81',
    });

    $(".bar").peity("bar", {
        fill: ["#1ab394", "#d7d7d7"]
    });

    $(".bar_dashboard").peity("bar", {
        fill: ["#1ab394", "#d7d7d7"],
        width:100
    });
    /* END PEITY */


    /* TOASTR */
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "progressBar": true,
        "positionClass": "toast-bottom-right",
        "onclick": null,
        "showDuration": "4000",
        "hideDuration": "5000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    };
    /* END TOASTR */


    /* SEARCH */
    $("#top-search").on('keyup', function(){

        var value = $(this).val();
        if (value.length > 2) {
            $('.search-dropdown').show();
            $.ajax({
                url: '/search',
                method: 'post',
                data: { searchString: value }
            }).done(function(result) {
                $('.search-dropdown').html(result);
            });

        } else {
            $('.search-dropdown').hide();
        }

    });
    /* END SEARCH */


    /** COLLAPSE **/
    /**
     * Zmiana ikony dla elementów COLLAPSE
     */
    $('button[data-toggle="collapse"]').on('click', function () {
        if ($(this).hasClass("collapsed")) {
            $(this).find('i').removeClass('fa-chevron-down').addClass('fa-chevron-up');
        } else {
            $(this).find('i').removeClass('fa-chevron-up').addClass('fa-chevron-down');
        }
    });
    /** END COLLAPSE **/

});