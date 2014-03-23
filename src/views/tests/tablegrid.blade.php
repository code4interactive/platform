@extends('platform::template.layout')

@section('header')
    <h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Datagrid <span>&gt; test page</span></h1>
@stop

@section('content')

<div class="jarviswidget" id="xcbvxcvb" data-widget-colorbutton="false" data-widget-editbutton="true">

    <!-- widget options:
    usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

    data-widget-colorbutton="false"
    data-widget-editbutton="false"
    data-widget-togglebutton="false"
    data-widget-deletebutton="false"
    data-widget-fullscreenbutton="false"
    data-widget-custombutton="false"
    data-widget-collapsed="true"
    data-widget-sortable="false"
    -->

    <header>
        <span class="widget-icon"> <i class="fa fa-map-marker"></i> </span>
        <h2>Birds Eye</h2>
    </header>

    <!-- widget div-->
    <div>

        <div class="widget-body no-padding">
            <!-- content goes here -->

            <!-- end content -->
        </div>

    </div>
    <!-- end widget div -->
</div>


<?php
//echo ViewHelper::foo();

$dg = new \Code4\Platform\Support\DataGrid('/dataSrc', 'main2', array(

    array(
        'id' => 'actions',
        'label' => "",
        'width' => '10px',
        'sortable' => false,
        'searchable' => false,
        'selectRow' => true,
        'selectAll' => true
    ),
    array(
        'id' => 'id',
        'label' => "Id",
        'width' => '50px',
        'sortDir' => 'asc'
    ),
    array(
        'id' => 'konto',
        'label' => "Konto",
        'sortable' => true
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

    return '<button class="btn btn-primary btn-xs dropdown-toggle" data-toggle="dropdown">
                Action <span class="caret"></span>
            </button>';

    return addDGEditButton('/edit/[[id]]');
});

$dg->actions()->setDecorator(function($object){
    return addCheckbox('[[id]]');
});

$dg->actions()->setHeaderDecorator(function($object){
    return addCheckbox('all');
});

$dg->setTools(function($object){
    return addDGEditButton('test').addDGDeleteButton().addDGButton(\Icons::$icon_apple, \Icons::$color_green, \Icons::$bigger_125, "opis opis");
});

?>

<?php $dg->render(); ?>
@stop




<?php if(false){?>
@section('footer-scripts')

<script>
    $(function() {
        $.datagrid('main', '.results', '.pagination', '.applied', {
            loader: code4Loading,
            sort: {
                column: 'id',
                direction: 'asc'
            },
            callback: function(obj){}
        });
    });
</script>

@stop
<?php } ?>