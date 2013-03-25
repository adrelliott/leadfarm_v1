<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Dashboard') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then
    
    class Dashboard extends CI_Controller {
            
        public $controller_name = 'dashboard';

        public function __construct()    {
             parent::__construct($this->controller_name);
        }


        public function index() {
            parent::index($view_file);

            $this->_load_view_data();   //retrieves and process all data for view
        }

    }
}

