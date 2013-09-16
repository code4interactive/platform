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

function addEditButton($url) {
    return '<a href="'.$url.'" data-rel="tooltip" data-placement="bottom" class="tooltip-info" data-original-title="Edycja">
                <i class="icon-pencil blue bigger-125"></i>
            </a>';

}

function addDeleteButton() {
    return '<a href="#" data-rel="tooltip" data-placement="bottom" class="tooltip-error" data-original-title="Usuń">
                <i class="icon-remove red bigger-125"></i>
            </a>';
}

function addButton($icon, $tooltip=null) {

    $tooltipstr = !is_null($tooltip) ? 'class="tooltip-info" data-original-title="'.$tooltip.'"' : '';

    return '
    <a href="#" '.$tooltipstr.'>
        <i class="'.$icon.' icon-2x blue"></i>
    </a>';


}