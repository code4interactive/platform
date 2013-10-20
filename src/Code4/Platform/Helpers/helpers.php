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

    $keyList = explode_comma_list($keyList);

    foreach($keyList as $key) {
        if (array_key_exists($key, $array))
            $temp[$key] = $array[$key];

    }

    return $temp;
}

function explode_comma_list($keyList) {

    if (!is_array($keyList)) {
        $ex = explode(",",$keyList);
        $keyList = array();
        foreach($ex as $t) {
            $keyList[] = trim($t);
        }
    }
    return $keyList;

}

function ifelse($var, $default=null) {

    if ($var) return $var;
    else return $default;

}

function ifthen($var, $default) {

    if ($var) return $default;
    return null;

}

function addCheckbox($idField) {

    return
    '<label>
        <input type="checkbox" class="ace row-checkbox" name="rowcheck[]" value="'.$idField.'">
        <span class="lbl"></span>
    </label>'.PHP_EOL;

}

function addDGEditButton($url, $size='bigger-125') {
    return '<a href="'.$url.'" data-rel="tooltip" data-placement="bottom" class="tooltip-info" data-original-title="Edycja">
                <i class="icon-pencil blue '.$size.'"></i>
            </a>';

}

function addDGDeleteButton($size='bigger-125') {
    return '<a href="#" data-rel="tooltip" data-placement="bottom" class="tooltip-error" data-original-title="Usuń">
                <i class="icon-remove red '.$size.'"></i>
            </a>';
}

/**
 * @param $icon
 * @param string $color - dark, white, red, light-red, blue, light-blue, green, light-green, orange, light-orange, orange2, purple, pink, pink2, brown, grey, light-grey
 * @param string $size - bigger-110>bigger-300, 123,175,225,275; smaller-90>smaller-20,75
 * @param null $tooltip
 * @return string
 */
function addDGButton($icon, $color='blue', $size='bigger-125', $tooltip=null) {

    $tooltipstr = !is_null($tooltip) ? 'class="tooltip-info" data-original-title="'.$tooltip.'"' : '';

    return '
    <a href="#" '.$tooltipstr.'>
        <i class="'.$icon.' '.$color.' '.$size.'"></i>
    </a>';


}