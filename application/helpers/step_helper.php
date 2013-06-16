<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

function step_manager($output = 'get', $step_number = 1) {
    //Check that the step is set up & default to 1 if not
    if ( ! isset($_SESSION['step_include'])) $_SESSION['step_include'] = 1;
    
    return $_SESSION['step_include'];
}