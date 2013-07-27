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
        //unscramble the url
        
        //then do the action
    }
    
    function show($cID = FALSE) {
        
        
        //if (! $dID OR ! $cID) show_error ('Ooops. That link didn\'t work');
       /// else
        
        if( ! defined('DATAOWNER_ID')) $this->_lookup_dID($cID);
        $this->load->model('contact_model', 'contact');
        $this->data['fields'] = $this->contact->get($cID);
            $this->rID = $cID;
            if (! $this->message) $this->message = '<span class="notification information">Please review and change your email preferences below</span>';
            
            $this->load->view('custom/' . DATAOWNER_ID . '/v_unsubscribe.php', $this->data);
        
    }
    
    function edit($cID, $input = FALSE) {
         if( ! defined('DATAOWNER_ID')) $this->_lookup_dID($cID);
        if ( ! $input) $input = clean_data($this->input->post());
        //define('DATAOWNER_ID', $dID);
        
        $this->load->model('contact_model', 'contact');
        $r = $this->contact->save($input, $cID);
        
        $this->message = '<span class="notification done">Your preferences have been updated!</span>';
        $this->show($cID);
    }
        
    function remove($cID) {
        //set all options to no
        $input = array(
            '_OptinEmailYN'=> 0,
            '_OptinSmsYN'=> 0,
            '_OptinSurfaceMailYN'=> 0,
            '_OptinMerchandiseYN'=> 0,
            '__ClubEventsYN'=> 0,
            '__AwayMatchYN'=> 0,
            'Email'=> '',
            
        );
        
        $this->edit($cID, $input);
    }
    
    function _lookup_dID($cID) {
        $this->db->select('_dID');
        $this->db->where('Id', $cID);
        $q = $this->db->get('contact')->result();
        
        if ($q->num_rows() > 0 ) 
        {
            $dID = $q->row(1)->_dID;
            if( ! defined('DATAOWNER_ID')) define('DATAOWNER_ID', $dID);
        }
        else
        {
            echo show_error ('This record does not exists');
            die();
        }
        
    }

}

/* End of file unsubscribe.php */
/* Location: ./application/controllers/XXXXXXXXXXXXXXXXXXXX/unsubscribe.php */