<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Links') ) get_bespoke_controller();   //yup = go get it.
else
{   //nope? Use this default class then
  
    class Filebox extends CRM_Controller {

        public $controller_name = 'filebox';

        public function __construct()    {
            parent::__construct();
            $this->load->helper('download');
            
                $this->load->model('filebox_model');
        }


        public function download($id = FALSE) {
            if ( ! $id) show_error('Ooops. No file found.');
            
            else
            {
                //Get the record
                $r = $this->filebox_model->get($id);
            }
            
            if ( ! count($r)) show_error('No file found that matches this id');
            else
            {
                $file_name = $r['FileName'] . $r['Extension'];
                
                $path =  file_get_contents(APPPATH . '/uploads/' . DATAOWNER_ID . '/' . $file_name);
                force_download($file_name, $path);
                
            }
            
            
                
               
           
            
            //get the record
            
            
            
        }

    }
}
   