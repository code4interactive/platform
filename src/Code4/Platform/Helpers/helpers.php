<?php
function debug($var) {

    echo '<pre>';
    //$trace = debug_backtrace();
    //$function = $trace[1]['function'];
    //$class = $trace[1]['class'];
   // print_r($class." -> ".$function);
   // echo '<br/>';
    print_r($var);
    echo '</pre>';

}

/**
 * Gets only selected pairs of key/values
 *
 * @param $keyList
 * @param $array
 * @return array
 */
function array_get_list($keyList, $array) {

    $temp = array();

    if (!is_array($keyList)) {
        $ex = explode(",",$keyList);
        $keyList = array();
        foreach($ex as $t) {
            $keyList[] = trim($t);
        }
    }

    foreach($keyList as $key) {
        if (array_key_exists($key, $array))
            $temp[$key] = $array[$key];

    }

    return $temp;
}

function ifelse($var, $default=null) {

    if ($var) return $var;
    else return $default;

}