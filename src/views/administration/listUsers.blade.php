@extends('platform::template.layout')

@section('header')
<h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>&gt; My Dashboard</span></h1>

Lista użytkowników
@stop

@section('content')



<h1 class="page-title txt-color-blueDark"><i class="fa-fw fa fa-home"></i> Dashboard <span>&gt; My Dashboard</span></h1>


<ul id="dropdown21" class="dropdown-menu">
    <li>
        <a href="javascript:void(0);">Action</a>
    </li>
    <li>
        <a href="javascript:void(0);">Another action</a>
    </li>
    <li>
        <a href="javascript:void(0);">Something else here</a>
    </li>
    <li class="divider"></li>
    <li>
        <a href="javascript:void(0);">Separated link</a>
    </li>
</ul>

<?php



echo ViewHelper::foo();

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
    //return 'adas<br/>asdzxc<br/>zxcasc<br/>bcvbcv';

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