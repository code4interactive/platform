<?php

$config = \Config::get('form.form1');
C4Form::loadConfig($config);
C4Form::render();
/*

echo C4Form::open('testItem')->render();

echo C4Form::text(array(
    'id'=>'sdfsdfsd',
    'label' => 'Test label',
    'tooltip' => 'Test tooltip'
));
echo C4Form::close();*/
/*
echo C4Form::findBy('id', 'sdfsdfsd')->getValue();

C4Form::select('test')->collection()->option('testOption')->option('testOption2');

echo C4Form::select('test')->collection()->option('testOption')->getName();

$temp = C4Form::text(array(

    'id'=>'testId',
    'name'=>'sdfsd',
    'value' => 'test',
    'label' => 'Label2',
    'tooltip' => 'BBB2',
    'placeholder' => 'assaas',
    'help' => 'Help'

));

echo $temp->getTooltip();

C4Form::render();
*/
?>



<?php if (false): ?>
{{ C4Form::open('temp', array('class'=>'form-vertical')) }}

<?php echo C4Form::text(array(

'text'=>'tedt',
'name'=>'sdfsdsdf',
'messages'=> 'asdasd<br>sdfsdf<br>sdsdfs',
'label' => 'Label1',
'value' => 'test',

)); ?>

<?php echo C4Form::text(array(

    'text'=>'tedt',
    'name'=>'sdfsd',
    'value' => 'test',
    'label' => 'Label2',
    'tooltip' => 'BBB2',
    'placeholder' => 'assaas',
    'help' => 'Help'

)); ?>

{{ C4Form::text(array('name' => 'asas'))->items() }}


{{-- C4Form::select(array('name'=> 'aa'))->options(function($item) {

    $array = array('temp' => 'temp');

    return $item->option()->setName('aaa')->setValue('aaa');

} --}}


{{--

C4Form::checkboxGroup()->items()

--}}

{{ C4Form::close() }}
<?php endif; ?>