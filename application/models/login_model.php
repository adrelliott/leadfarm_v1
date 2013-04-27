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
            $this->table_name = 'contact';
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
            $retval = array
            (
                'result' => FALSE,
                'message' => '<span class="notification undone"><h4>I\'m sorry - username/password not recognised.</h4></span>'
            );
            $conditions = array 
            (
                '_IsCrmUserYN' => 1,
                'Username' => $this->input->post('username'),
                'Password' => md5($this->input->post('password'))
            );    
            
            //do query
            $this->db->select($this->fields);
            $query = $this->db->get_where($this->table_name, $conditions, 1);
            
            //Look at results
            //print_array($query->row_array());
            if ($query->num_rows() > 0)
            {
                $row = $query->row_array(); 
                
                //Is the user suspended?
                if ( $row['_SuspendedReason'] )
                {
                     $retval['message'] = '<span class="notification undone"><h4>I\'m sorry. There\'s a problem with your account.</h4><br/> Please call 0161 375 4444 (and quote Code ' . $row['_SuspendedReason'] . ')</span>';
                }
                else
                {
                    //Yup. All good. Set things up
                    unset($retval['message']);
                    $row['is_logged_in'] = TRUE;
                    $retval['result'] = TRUE;
                    
                    //Set up sessions
                    $this->session->set_userdata($row);
                    $_SESSION['dID'] = $row['_dID'];
                }               
            }
            
            return $retval;
        }
        
        
        public function validate_user_old() {
            //set up condition for query
            $retval = array
            (
                'results' => FALSE,
                'message' => '<span class="notification undone"><h4>I\'m sorry - username/password not recognised.</h4></span>'
            );
            $conditions = array 
            (
                '_IsCrmUserYN' => 1,
                'Username' => $this->input->post('username'),
                'Password' => md5($this->input->post('password'))
            );    
            
            //do query
            $this->db->select($this->fields);
            $query = $this->db->get_where($this->table_name, $conditions, 1);
            
            //Look at results
            print_array($query->row_array());
            if ($query->num_rows() > 0)
            {
                $retval['results'] = TRUE;
                $row = $query->row_array(); 
//$query['results'] = $query[0]; unset($query[0]);
                //$query = $query->result_array();
                //$query['results'] = $query[0]; unset($query[0]);
                
                //check for suspended reason
               // if ( $query['results']['_SuspendedReason'] ) //is there a suspended code reason?
                if ( $row['_SuspendedReason'] )
                {
                     $retval['message'] = '<span class="notification undone"><h4>I\'m sorry. There\'s a problem with your account.</h4><br/> Please call 0161 375 4444 (and quote Id = ' . $query['results']['_SuspendedReason'] . ')</span>';
                     //unset($query['results']);
                }
                else
                {
                    //$query['results']['is_logged_in'] = TRUE;
                    $retval['is_logged_in'] = TRUE;
                    $this->session->set_userdata($query->row_array());
                    //$_SESSION['dID'] = $this->session->userdata('_dID');
                    $_SESSION['dID'] = $row['_dID'];
                    //if ( ! defined('DATAOWNER_ID') )
                        //define('DATAOWNER_ID', $this->session->userdata('_dID'));
                }               
            }
            
            return $retval;
        }
        
        
        public function verify_password() {
            //print_array($this->input->post());
            //echo "password = ".md5($this->input->post('Password'));
            $retval = 0;
            $conditions = array 
            (
                'Id' => $this->input->post('Id'),
                'Password' => md5($this->input->post('Password'))
            );            
            
            //do query & see if we get a result
            $this->db->select('Id');
            $query = $this->db->get_where($this->table_name, $conditions, 1);
            //print_array($query->result_array(), 0, 'query resul');
            //Well? Any luck?
            if ($query->num_rows() > 0) $retval = 1;
            //echo "<br/>retval = $retval";
            return $retval;
            
        }
        
        
        
        
        
    }