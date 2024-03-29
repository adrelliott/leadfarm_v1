<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/* This is the User Model.
 * 
 * This controls access to the leadfarm_users->userdata database & table. 
 * The connection details are set up in the config file, and as this is called
 * before we call the bespoke config file (bespoke_cinfigs/22222.config.php), 
 * then the database setting are correct.
 * 
 * Note: The bespoke config file overwrites these db settings as user's  data 
 * is kept in separate databases
 * 
 * 
 */

    class Login_model  extends CI_Model {
         
        public function __construct()    {
            parent::__construct();
            // Load the database settings
            $dbConn = $this->config->item('database');        
            $this->load->database($dbConn, FALSE, TRUE);
            $this->contactId_fieldname = 'ContactId';
        }
        
        function validate_user()
        {
            
            $condition = array
            (
                '_IsCrmUserYN' => 1,
                'Username' => $this->input->post('username'),
                'Password' => md5($this->input->post('password'))
            );            
            //$this->db->select('FirstName,LastName,Id,Username,Company,Nickname,Email,Phone1,_SuspendedReason');
            $query = $this->db->get_where('contact', $condition);
            
            $retval = array('result' => FALSE, 'data' => '');
            
            if ($query->num_rows == 1)
            {
                $data = $query->result_array();
                $retval = array(
                    'result' => TRUE,
                    'data' => $data[0],
                );                
            }
            
            return $retval;
        }
    }