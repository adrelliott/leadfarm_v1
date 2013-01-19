<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function print_array ($data, $die = FALSE, $message = '') {
    echo "<pre>here comes data ($message)";
    print_r($data);
    echo "</pre>";
    if ($die)
    {die;}
    
}