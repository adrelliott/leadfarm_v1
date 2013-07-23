<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/**
 * Controller - unsubscribe
 * @author Al Elliott
 * 
 * XXXXXXXXXXDescription_goes_hereXXXXXXXXXX
 * 
 */
class Unsubscribe extends CI_Controller {

    public $message = '';
    public $rID = '';

    public function __construct() {
        parent::__construct();
    }
    
    function  index($secret_url) {
        //unsramble the url
        
        //then do the action
    }
    
    function show($dID = FALSE, $cID = FALSE) {
        if (! $dID OR ! $cID) show_error ('Ooops. That link didn\'t work');
        else
        {
            define('DATAOWNER_ID', $dID);
        $this->load->model('contact_model', 'contact');
            $this->rID = $cID;
            $this->load->view('custom/' . DATAOWNER_ID . '/v_unsubscribe.php');
        }
    }
        

}

/* End of file unsubscribe.php */
/* Location: ./application/controllers/XXXXXXXXXXXXXXXXXXXX/unsubscribe.php */