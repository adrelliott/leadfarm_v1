<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Automation Class
 *
 * Manages all automation steps
 *
 * @author Al Elliott.
 */

class Automation_1 extends CI_Controller {
  
    public function __construct() {
        parent::__construct();
       }
       
       function testing() {
           echo "*****this is a test fro  the automation controller";
       }
}