@extends('platform::layout')

@section('header')
Lista użytkowników
@stop

@section('content')


<?php



$dg = new \Code4\Platform\Support\DataGrid('/dataSrc', 'main2', array(

    array(
        'id' => 'actions',
        'label' => "",
        'width' => '10px',
        'sortable' => false,
        'searchable' => false
    ),
    array(
        'id' => 'id',
        'label' => "Id",
        'width' => '20px',
        'sortDir' => 'asc'
    ),
    array(
        'id' => 'konto',
        'label' => "Konto",
        'sortable' => false
    ),
    array(
        'id' => 'opis',
        'label' => "Opis"
    ),
    array(
        'id' => 'toolsColumn',
        'width' => '10px',
        'sortable' => false,
        'searchable' => false
    )

));

//$dg->id()->setSortDir('desc');

$dg->toolsColumn()->setDecorator(function($object){
   return addEditButton('/edit/[[id]]');
});

$dg->actions()->setDecorator(function($object){
    return addCheckbox('[[id]]');
});

$dg->actions()->setHeaderDecorator(function($object){
    return addCheckbox('all');
});

$dg->setTools(function($object){
    return addEditButton('test').addDeleteButton();
});

?>
<div class="table-header">
    Lista wyników
</div>
<?php $dg->render(); ?>





<button id="button2">
    Pokaz modal
</button>


<script>

    $("#button2").on("click", function(){

        $.ajax({
            url: "/administration/users/list/ajax"
        }).done(function( html ) {

                $.modal(createWidgetBox(html, {scroll: true}), {
                    closeHTML:"",
                    /*containerCss:{
                        backgroundColor:"#fff",
                        borderColor:"#fff",
                        height:450,
                        padding:0,
                        width:830
                    },*/
                    autoResize: true,
                    overlayClose:true
                });

        });
    });



    function createWidgetBox(html, params) {


        var widgetBox = $(document.createElement('div')).addClass("widget-box");

        var widgetHeader = $(document.createElement('div')).addClass("widget-header").addClass("header-color-green2").html('<h5><i class="icon-table"></i> Default Widget Box</h5>');

        var widgetToolbar = $(document.createElement('div')).addClass("widget-toolbar").html('<a href="#" class="simplemodal-close" data-action="close"><i class="icon-remove"></i></a>');

        widgetHeader.append(widgetToolbar);

        var widgetBody = $(document.createElement('div')).addClass("widget-body");
        var widgetMain = $(document.createElement('div')).addClass("widget-main");

            if (params && params.scroll) {
                var widgetScroll = $(document.createElement('div')).addClass("slim-scroll").html(html);;
                widgetMain.append(widgetScroll);
            } else {
                widgetMain.html(html);
            }



        widgetBody.append(widgetMain);

        widgetBox.append(widgetHeader).append(widgetBody);

        widgetBox.resizable().draggable({ handle: "div.widget-header" })

        return widgetBox;

    }

</script>


@stop





















<?php if(false){?>
@section('footer-scripts')

<script>
    $(function()
    {
        $.datagrid('main', '.results', '.pagination', '.applied', {
        loader: code4Loading,
        sort: {
            column: 'id',
            direction: 'asc'
        },
        callback: function(obj){

            //Leverage the Callback to show total counts or filtered count
           // $('#filtered').val(obj.filterCount);
           // $('#total').val(obj.totalCount);

        }
    });
    });
</script>

@stop
<?php } ?>