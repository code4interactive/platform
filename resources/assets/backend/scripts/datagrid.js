$(document).on('change', 'input.row-checkbox', function(){

    var $bodyCheckboxes = $(this).closest('table').find('.row-checkbox').not('.row-checkbox-header');
    var $headerCheckboxes = $(this).closest('table').find('.row-checkbox-header');

    if ($(this).is(".row-checkbox-header")) {
        if ($(this).is(":checked")) {
            $bodyCheckboxes.prop('checked', true);
        } else {
            $bodyCheckboxes.prop('checked', false);
        }
    } else {
        var allChecked = true;
        var oneChecked = false;
        $bodyCheckboxes.each(function(i, el){
           if ($(el).is(":checked")) {
               oneChecked = true;
           } else {
                allChecked = false;
           }
        });
        if (allChecked && oneChecked) {
            $headerCheckboxes.prop('checked', true);
        } else {
            $headerCheckboxes.prop('checked', false);
        }
    }

    //Values
    var tokeny = '';
    $bodyCheckboxes.each(function(i, el){
        if ($(el).is(":checked")) {
            tokeny += $(el).val();
        }
    });
    tokeny = tokeny.substring(0,(tokeny.length-1));
    $('input[name="tokeny"]').val(tokeny);
});



