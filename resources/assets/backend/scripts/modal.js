$(document).ready(function () {

    $(document.body).on('click', '.loadInModal', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            method: 'get',
            success: function (data) {
                $id = $(data).find('.modal').attr('id');
                $(data).modal('show');
            },
            error: function (data) {
            }
        });
        return false;
    });

    $(document.body).on('click', '[data-modal]', function (e) {
        e.preventDefault();
        var url;
        if ($(this).attr('data-modal') !== '') {
            url = $(this).attr('data-modal');
        }
        else if ($(this).attr('href') !== '') {
            url = $(this).attr('href');
        }

        if (url === '') {
            console.log('No target/url for modal');
            return;
        }

        //Jeżeli url rozpoczyna się na # lub . to znaczy że jest to selector
        if (url.substr(0,1) === '#' || url.substr(0,1) === '.') {
            $(url).modal('show');
            return;
        }

        //url to url więc ładujemy z niego wszystko jako modal
        $.ajax({
            url: url,
            method: 'get',
            success: function (data) {
                $(data).modal('show');
            },
            error: function (data) {
            }
        });
        return false;

    });




    //EDIT MODAL
    $(document.body).on('click', '.editModal', function(e){
        e.preventDefault();
        var url = $(this).attr('href');

        $.ajax({
            url: url,
            method: 'get',
            success: function(data){
                $id = $(data).find('.modal').attr('id');
                $(data).modal('show');
            },
            error: function(data){}
        });

        return false;

    });


});