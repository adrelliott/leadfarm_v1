<?php

/*
 * 'Extends' the date helper to help deal with conversion from UK dates to 
 *  MySQL dates and vice versa
 */

function convert_date_field($field_name, $value) {
    $retval = array();
    
    //First explode the field name and work out what conversion to do
    $boom = explode('::::', $field_name);
    $direction = $boom[0];
    $retval['col_name'] = $boom[1];
    
    //now convert and return
    $retval['value'] = convert_DATE($a, $direction);
    return $retval;
}

/*  convert DATE to Uk Date & back again
 * 
 * e.g. YYYY-MM-DD will become DD/MM/YYYY
 * 
 */
function convert_DATE($date, $direction = 'to_DATE') {
    $retval = FALSE;
    $join = array('/','-'); //defaults to converting YYYY-MM-DD to DD/MM/YYYY
    
    //But, if $direction is passed, then converts from DD/MM/YYYY to YYYY-MM-DD
    if ($direction == 'to_DATE') $join = array('-', '/');
    
    //Do the work... (explodes array, then reverses it, then re-joins with new separator)
    $retval = join($join[0],array_reverse(explode($join[1],$date)));
    
    return $retval;
    
}

