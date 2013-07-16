
{{ C4Form::open('temp', array('attributes'=>array('test'=>'test'))) }}

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
    'messages'=> 'asdasd<br>sdfsdf<br>sdsdfs',
    'value' => 'test',
    'label' => 'Label',
    'tooltip' => 'BBB2',
    'help' => 'Help'

)); ?>

{{ C4Form::close() }}