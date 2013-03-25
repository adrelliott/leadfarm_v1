<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    //starts PHP session (this holds the dID - allows us to use session to hold 
    //dID before initialising Codeignitor's base classes)
    session_start();
    
    //This accepts the controller name and tests to see if there is a bespoke file 
    //to call. We dontl use 'if_file_exists() as this seems to slow thre app down
    function bespoke_controller($controller_name) {
        if ( ! isset($_SESSION['dID']) || empty( $_SESSION['dID']) )
            header('location: login/log_out'); //Get out!
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
    
    
    //If we have a bespoke controller written, this method retrives it
    function get_bespoke_controller() {
        include(APPPATH . "controllers/bespoke_controllers/" . DATAOWNER_ID 
                . '/' . CONTROLLER_NAME . '.php');
        }
