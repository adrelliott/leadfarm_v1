<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Dashboard') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then
    
    class Dashboard extends MY_Controller {
            
        public $controller_name = 'dashboard';

        public function __construct()    {
             parent::__construct();
        }


        public function index() {
            parent::index();    //Can send a $controller_setup array, see MY_Controlelr::index()

            $this->_load_view_data();   //retrieves and process all data for view
            $this->_generate_view($this->data);
        }

    }
}

