var slug = function (str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "ąãàáäâęẽèéëêìíïîõòóöôùúüûñńçćśłżź·/_,:;";
    var to = "aaaaaaeeeeeeiiiiooooouuuunnccslzz------";
    for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return str;
};


$(document).ready(function () {

    $('#top-search').on('focusin', function () {
        if ($(this).val().length > 2) {
            $('.search-dropdown').show();
        }
    });

    $('body').not('.search-dropdown, #top-search').on('click', function (e) {
        $('.search-dropdown').hide();
    });

});