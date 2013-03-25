<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    session_start();
    
    function bespoke_controller($controller_name) {
        if ( ! isset($_SESSION['dID']) || empty( $_SESSION['dID']) ) 
            header('location: http://google.co.uk');    //log back in!!!!        
        else 
        {
            define('DATAOWNER_ID', $_SESSION['dID']);
            define('CONTROLLER_NAME', $controller_name);
        }
    
        //Now check and see if there is a bespoke controller set up
        $path = APPPATH . 'controllers/controller_config/';
        include($path .'controller_config.php');
        if ( isset($controller_config[DATAOWNER_ID])
                && isset($controller_config[DATAOWNER_ID][CONTROLLER_NAME]) 
                && $controller_config[DATAOWNER_ID][CONTROLLER_NAME] == TRUE) 
        {
            return TRUE;
        }
        else return FALSE;
    }
    
    function get_bespoke_controller() {
        include(APPPATH . "controllers/bespoke_controllers/" . DATAOWNER_ID 
                . '/' . CONTROLLER_NAME . '.php');
        }
        
    
        
        
        
        
        
        
        
        
        
        
    /*
//start the session & check session is intact
    session_start();
    if ( ! isset($_SESSION["dID']) || empty( $_SESSION['dID']) ) header('location: http://google.co.uk');
    else $dID = $_SESSION['dID'];
    echo "<p>lets kick things off =- dID = $dID</p>";
    
    //Now check and see if there is a bespoke controller set up
    $path = APPPATH . 'controllers/controller_setup/';
    include($path . $dID . '.php');
    
    echo "<p>we are lookijng for $controller_name in here:</p>";print_r($controller_config);
    
    if ( isset($controller_config[$controller_name]) && $controller_config[$controller_name] == TRUE) 
    {
        echo "<h1>we need a bespooke </h1>";
        //include( $path . $controller_config[$controller_name] . $controller_name);
        
    }
        */