<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/* This is the Login controller for all users.
 * 
 * USER = any page that a logged in client will see, e.g. the CRM part
 * 
 * Put any methods or vars in this file that you want available fort he login module
 * 
 * 
 * 
 */

  
class Index extends CI_Controller {
    
    
    
    public function __construct()    {
         parent::__construct();
         
    }

    public function index()
    {      
        echo "This si the standard index page!";
    }

}