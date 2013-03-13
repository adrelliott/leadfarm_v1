<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/** sets up the CRUD for the non-core classes
 * 
 */

class Crud_lib extends CI_Controller {
    
    public $dID = '';    //set by $this->_set_DATAOWNER();
    var $crud = array();    //holds all data on the query

    //public function __construct()    {
    function Crud_lib()    {
        parent::__construct();
        $this->reset();    //set up the crud array
    }
    
    function crud_init() {
        //test to see if this exists - DO NOT DELETE ME!
    }
    
    public function set_up_db_conn($model_name) {
        $this->config->load('bespoke_configs/' . DATAOWNER_ID . '_config');
        $dbConn = $this->config->item('database');     //these are different for each dID           
        //Load DB & Model
        $this->load->database($dbConn, FALSE, TRUE); 
        $model_name = $model_name . '_model';
        $this->load->model($model_name);

        return $model_name;
    }

    public function set_DATAOWNER($dID) {
        $this->dID = $dID; 
        if ( ! defined('DATAOWNER_ID') ) define('DATAOWNER_ID', $this->dID);
    }

    public function reset() {  //resets the crud (query) array
        $this->crud = array
        (
            'model_name' => '',
            'select' => FALSE,
            'where' => FALSE,
            'where_in' => FALSE,
            'id' => FALSE,
            'assocYN' => FALSE
        );
    }

    public function crud($type, $method_name = FALSE) {
        $model = $this->set_up_db_conn($this->crud['model_name']);
        //For instructions on these see http://ellislab.com/codeigniter/user-guide/database/active_record.html
        if ($this->crud['select']) $this->db->select($this->crud['select']);
        if ($this->crud['where']) $this->db->where($this->crud['where']);
        if ($this->crud['where_in']) $this->db->where_in(
                $this->crud['where_in']['col'], 
                $this->crud['where_in']['values']
                );
        switch($type)
        {
            case 'create':
                $results = $this->$model->save($this->crud['input']);
                break;
            case 'retrieve':       
                if ($this->crud['id']) $results = $this->$model->get($this->crud['id']);
                else $results = $this->$model->get();
                break;
            case 'update':
                //do update
                break;
            case 'delete':
                //do update
                break;            
            case 'update_batch': //surpress error due to CI bug http://stackoverflow.com/questions/11279262/update-database-field-error-codeigniter 
                if ($this->crud['update_batch'])  $results = @$this->db->update_batch(
                        $this->crud['update_batch']['table'], //what table we updating? 
                        $this->crud['update_batch']['data'], //with what (array), 
                        $this->crud['update_batch']['col'] //What col are we matching?, 
                        ); 
                break;                
            case 'insert_batch': //surpress error due to CI bug http://stackoverflow.com/questions/11279262/update-database-field-error-codeigniter 
                if ($this->crud['insert_batch']) $results = $this->db->insert_batch(
                        $this->crud['insert_batch']['table'], //what table we updating? 
                        $this->crud['insert_batch']['data'] //with what (array), 
                        );
                break;                
            case 'where_in':
                $ids = $this->crud['where_in'];
                $this->db->where_in(
                        $this->crud['where_in']['col'], 
                        $this->crud['where_in']['values']
                        );
                if ($this->crud['id']) $results = $this->$model->get($this->crud['id']);
                else $results = $this->$model->get();
                break;            
            default:
                show_error("No CRUD chosen");
                break;         
        }

        $this->reset();    //reset the crud array

        //maybe some error reporting? what happens if this tag is not set?
        return $results;
    }  

    public function make_assoc($array, $field) {
        //rewrites array where $field is the key for each dimension
        $tmp = array();
        //Check and see if its an assoc array already
        if ( array_key_exists($field, $array) ) $array = array_chunk($array, count($array), TRUE);
        foreach ($array as $k => $a) $tmp[$a[$field]] = $a;
        return $tmp;
    }

}