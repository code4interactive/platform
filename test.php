<?php
//config


array(

    'target' => '/user/save',
    ''

);


//Controller

$form = Form::load("forumlarz_usera");

$form->load("passwords")->after("costam");

$form->textfield("username")->setValue("Maciek");

$form->textfield()->setName("name")->setValue("Value")->before("username")->setValidation(array('required'));


\Illuminate\Support\Facades\View::make("widok", array("form"=>$form));


//VIEW
$form->render();

echo $form->textfield("maciek");



//user/save

$form = Form::load("forumlarz_usera");


$form->textfield()->setName("name")->setValidation(array('required'));


$form->validate();