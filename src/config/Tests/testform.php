<?php
return array(

    'testform1' => array(

        array(
            'id'=>'formOpen',
            'type'=>'open',
            'action'=>'/tests/formsTest1Validate',
            'method'=>'post'
        ),

// text: hidden, password, date/time, autocomplete, file, mask, date from / to, color picker, spinners?, tags?
// select: multiple, 
// textarea
// radio: radio inline, columns, toggles, stars()
// checkbox: single / inline, columns, toggles

        array(
            'type' => 'row',
            'collection' => array(
                 array(
                    'id'=>'textfield3',
                    'type'=>'text',
                    'label'=>'Text field',
                    'placeholder' => 'textfield placeholder',
                    'tooltip'=>'Textfield tooltip',
                    'mask' => '999-999',
                    'icon' => 'fa-user',
                    'iconposition' => 'left',
                    'section' => 'col col-6',
                    'value' => 'test',
                    'description' => 'To jest description pola',
                    'validation' => array(
                        'required', 'num_only', 'min'=>3
                    )
                ),
                array(
                    'id'=>'textfield2',
                    'type'=>'text',
                    'label'=>'Text field',
                    'placeholder' => 'textfield placeholder',
                    'tooltip'=>'Textfield tooltip',
                    'mask' => '999-999',
                    'icon' => 'fa-user',
                    'iconposition' => 'left',
                    'section' => 'col col-6',
                    'value' => 'test',
                    'description' => 'To jest description pola',
                    'validation' => array(
                        'required', 'num_only', 'min'=>3
                    )
                ),
            )
        ),
    array(
        'type' => 'row',
        'collection' => array(

            array(
                'id'=>'textarea',
                'type'=>'textarea',
                'label'=>'Textarea',
                'placeholder' => 'textarea placeholder',
                'tooltip'=>'Textarea tooltip',
                'rows'=>5,
                'icon' => 'fa-user',
                'iconposition' => 'right',
                'section' => 'col col-4',
                'value' => 'test',
                'description' => 'To jest description pola',
                'validation' => array(
                    'required', 'num_only', 'min'=>3
                )
            ),

            array(
                'id'=>'selector',
                'type'=>'select',
                'label'=>'Multiple select - Select 2',
                'value'=>'Value2',
                'select2'=>true,
                'multiple'=>true,
                'section' => 'col col-4',
                'placeholder'=>'Wybierz no coś',
                'value'=>'Value3',
                'collection'=>array(
                    array(
                        'id'=>'option1',
                        'value'=>'Value1',
                        'type'=>'option'
                    ),
                    array(
                        'id'=>'option2',
                        'value'=>'Value2',
                        'type'=>'option'
                    ),
                    array(
                        'id'=>'option3',
                        'value'=>'Value3',
                        'type'=>'option'
                    )
                )
            ),

            array(
                'id'=>'selector2',
                'type'=>'select',
                'label'=>'Select - Select 2',
                'value'=>'Value2',
                'select2'=>true,
                'section' => 'col col-4',
                'placeholder'=>'Wybierz no coś',
                'value'=>'Value3',
                'collection'=>array(
                    array(
                        'id'=>'option1',
                        'value'=>'Value1',
                        'type'=>'option'
                    ),
                    array(
                        'id'=>'option2',
                        'value'=>'Value2',
                        'type'=>'option'
                    ),
                    array(
                        'id'=>'option3',
                        'value'=>'Value3',
                        'type'=>'option'
                    )
                )
            ),
        )
    ),
    array(

        'type' => 'row',
        'collection' => array(
            array(
                'id'=>'password',
                'type'=>'password',
                'value'=>'',
                'label'=>'Wprowadź hasło',
                'tooltip'=>'Minimum 8 znaków',
                'placeholder'=>'Haslo',

                'icon' => 'fa-lock',
                'iconposition' => 'right',
                'section' => 'col col-4',
                'description' => 'To jest description pola',
            )
        )
    )


/*
        ,
        array(
            'id' => 'hidden',
            'type' => 'hidden',
            'value' => 'Hidden value'
        ),
        array(
            'id'=>'textarea',
            'type'=>'textarea',
            'data-maxlength'=>40,
            'label'=>'Text area'
        ),
        array(
            'id'=>'submitButton',
            'type'=>'button'
        )*/,
        array(
            'id'=>'Button',
            'type'=>'button',
            'label'=>'Zapisz',
            'class'=>'bg-color-greenDark txt-color-white btn-xs',
            'icon'=>'fa-save'
        ),
        array(
            'id'=>'submitButton',
            'type'=>'submit',
            'label'=>'Zapisz',
            'confirm' => 'Komunikat dla confirmu. Ustawiany w konfiguracji formsa',
            'class'=>'btn-primary btn-lg',
            'icon'=>'fa-save'
        ),
        array(
            'id'=>'formClose',
            'type'=>'close'
        )

    )

);