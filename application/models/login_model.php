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
    class Login_model  extends MY_Model {  
        
        public function __construct()    {
            parent::__construct();
            $this->table_name = 'contact';
            $this->order_by = 'Id';
            $this->fields = array //fields to retrive from the db
            (
                'Username',
                'FirstName',
                'LastName',
                'Nickname',
                'Email',
                'Phone1',
                'Company',
                'Id',
                '_JobCategory',
                '_AdminLevel',
                '_SuspendedReason',
                '_dID',
            );
        }
        
        public function validate_user() {
            //set up condition for query
            $query = array();
            $conditions = array 
            (
                '_IsCrmUserYN' => 1,
                'Username' => $this->input->post('username'),
                'Password' => md5($this->input->post('password'))
            );            
            $this->db->where($conditions);
            $this->db->select($this->fields);
            $this->db->limit(1);
            
            //do query
            $query = $this->get();
            
            if ($query)
            {
                $query['results'] = $query[0]; unset($query[0]);
                
                //check for suspended reason
                if ( $query['results']['_SuspendedReason'] ) //is there a suspended code reason?
                {
                     $query['message'] = '<span class="notification undone"><h4>I\'m sorry. There\'s a problem with your account.</h4><br/> Please call 0161 375 4444 (and quote Id = ' . $query['results']['_SuspendedReason'] . ')</span>';
                     unset($query['results']);
                }
                else
                {
                    $query['results']['is_logged_in'] = TRUE;
                    $this->session->set_userdata($query['results']);
                }                
            }
            else
                 $query['message'] = '<span class="notification undone"><h4>I\'m sorry - username/password not recognised.</h4></span>';
            
            return $query;
        }
        
        
        
        
        
       /* 
        function validate_user_old()
        {
            
            $condition = array
            (
               
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
        }*/
        
        
    }