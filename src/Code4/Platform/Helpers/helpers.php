<?php
function debug($var) {

    echo '<pre>';
    $trace = debug_backtrace();
    $function = $trace[1]['function'];
    $class = $trace[1]['class'];
    print_r($class." -> ".$function);
    echo '<br/>';
    print_r($var);
    echo '</pre>';

}