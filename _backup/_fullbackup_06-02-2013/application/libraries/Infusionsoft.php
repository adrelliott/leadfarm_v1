<?php    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );
 /* Striclty speaking this should probably be a model, but we'll treat it as a Libarary
 * 
 * It loads the iSDK for infusionsoft and allows us to access infusionsoft 
  * 
  * 
  * Then the model inf_model extends this - this allows us to create a layer
  * between the actual infusionsoft commands and the controller.
  * 
  * If we ever decide to move to another CRM, all we need to do is load a new library
  * and amend the functions in inf_model, without having to touch the code itself
  * 
  * 
  */

    class Infusionsoft 
    {
        public $app;
        
        public function __construct()
        {
            require_once('infusionsoft/isdk.php');
            $this->app = new iSDK();
            $this->_infusion_connect();
        }

        protected function _infusion_connect () {
        //load the connection
            if (! $this->app->cfgCon("mmc"))
            {
                echo "IS_Connection failed!";
                die;
            }
        }


    }