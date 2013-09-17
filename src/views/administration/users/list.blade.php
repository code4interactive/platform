<?php

$dg = new \Code4\Platform\Support\DataGrid('/dataSrc', 'main8', array(

    array(
        'id' => 'actions',
        'label' => "",
        'width' => '10px',
        'sortable' => false,
        'searchable' => false
    ),
    array(
        'id' => 'toolsColumn',
        'width' => '50px',
        'sortable' => false,
        'searchable' => false
    ),
    array(
        'id' => 'id',
        'label' => "Id",
        'width' => '100px'
    ),
    array(
        'id' => 'konto',
        'label' => "Konto",
        'sortable' => false
    ),
    array(
        'id' => 'opis',
        'label' => "Opis"
    )

));

$dg->setPaginationCount(3);

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

$dg->render();