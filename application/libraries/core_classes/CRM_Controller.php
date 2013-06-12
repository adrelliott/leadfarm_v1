<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class CRM_Controller extends CI_Controller {

	/**
	 * This acts as a template for every controller.
	 *
	 * Define methods/vars here in the construct (to run before anything else) 
	 * and/or define methods here that can be extended in other controllers
	 * 
	 */
    
    public $data = array
            (
                'config' => array   //store all the congif items here
                    (
                    
                    ),
                'model_setup' => array  //store all vars for queries
                    (
                    
                    ),
                'controller_setup' => array    //store all vars for controlle
                    (
                    
                    ),
                'view_setup' => array   //store all vars for view  
                    (
                        'header_file' => 'header', //turned into modal in T_Controller
                        'footer_file' => 'footer', //turned into modal in T_Controller
                        'modal' => FALSE, //set in T_Controller if true
                        'message' => FALSE, //to hold things like 'delete sucessful' messages
                    ),              
            );
    
    //public function __construct($controller_name) {
    public function __construct() {
        parent::__construct();
        //Allow the use of query strings as well as trad CI URL paras 
        //(note,  $config['uri_protocol'] = 'PATH_INFO' (was ['REQUEST_URI'] ) 
        //OLD LINE: parse_str(str_replace($_SERVER['QUERY_STRING'],'',
        //$_SERVER['REQUEST_URI']),$_GET); removed as new line below is better
        parse_str($_SERVER['QUERY_STRING'], $_GET); //using this one as it works!
        
        // Put any code here that is to be called before any other controller
         
        // 1. Test is_logged_in. This Redirects to login if not.
        $this->_is_logged_in(); 
        
        // 2. Define dID (this should be defined in  controller_config/init.php
        //if ( ! defined('DATAOWNER_ID') )
          //  define('DATAOWNER_ID', $this->session->userdata('_dID'));
        //define('DATAOWNER_ID', $this->session->userdata('_dID'));    
        
        // 3. Load the bespoke config
        $this->config->load('bespoke_configs/' . DATAOWNER_ID . '_config');

        // 4. Now start to set up the $data[config] array for the View_template
        $this->data['view_setup']['navbar'] = $this->config->item('navbar_setup');
        $this->data['config'] = $this->config->item($this->controller_name);
        //$this->data['config'] = $this->config->item($controller_name);
        $this->data['view_setup']['user_data'] = $this->session->all_userdata();
        
        // 5. now load the database settings
        //$dbConn = $this->config->item('database');     //these are different for each dID       
        //$this->load->database($dbConn, FALSE, TRUE); //load this dID's database 
        
        // 6. Finally set up last minute vars
        $this->data['controller_setup']['controller_name'] = $this->controller_name;
        
        if ( isset( $_GET['debug'] ) && strpos(ENVIRONMENT, 'development') ) $this->output->enable_profiler(TRUE);
    }
    
    
    //Is there any need for an index() function here?
   
    protected function index($view_file = 'index', $method_name = 'index') {
        $this->data['controller_setup']['method_name'] = $method_name;
        $this->data['view_setup']['view_file'] = 'v_'.$this->controller_name.'_' . $view_file; 
    }
    
    protected function search($view_file = 'search', $method_name = 'search') {
        $this->data['controller_setup']['method_name'] = $method_name;
        $this->data['view_setup']['view_file'] = 'v_'.$this->controller_name.'_' . $view_file; 
    }
    
    protected function report($view_file = 'index', $method_name = 'report') {
        $this->data['controller_setup']['method_name'] = $method_name;
        $this->data['view_setup']['view_file'] = 'v_'.$this->controller_name.'_' . $view_file; 
    }
   
    protected function view($view_file, $rID, $ContactId = NULL, $method_name = 'view'){
        $this->data['view_setup']['view_file'] = 'v_'.$this->controller_name.'_' . $view_file;      
        $this->data['controller_setup']['method_name'] = $method_name; 
        $ext = ''; if ($this->data['view_setup']['modal']) $ext = '_modal';
        $this->data['view_setup']['header_file'] .= $ext;
        $this->data['view_setup']['footer_file'] .= $ext;  
        $this->data['view_setup']['rID'] = $rID;
        $this->data['view_setup']['ContactId'] = $ContactId;   //in this context, $rID == ContactId
        $this->data['view_setup']['display_none'] = '';
    }    
    
    
    protected function _load_view_data($rID = NULL) {
        // 1. Set up the vars for this method
        
        extract($this->data); 
        extract($this->data['controller_setup']); 
        
        // 2. prepare the model_setup array (this controls the queries)
        $this->data['model_setup'] = $this->_prepare_model($config, $method_name);        
       
        // 3. Do the datasets query & hand over to the controller_setup to post-process data
        if (isset($this->data['model_setup']['datasets']))
        { 
            //do all querues for dropdowns and tables
            $this->data['controller_setup']['datasets'] = $this->_generate_datasets(
                    $this->data['model_setup']['datasets']
                    );
            
            $table_headers =  $this->data['config']['datasets'][$method_name];
            $datasets = $this->data['controller_setup']['datasets'];
            
            //set up table data array
            foreach ($datasets as $dataset => $array)
            {
               $this->data['view_setup']['tables'][$dataset]['table_headers'] = 
                        $this->_generate_table_headings($table_headers[$dataset]['fields']);
               $this->data['view_setup']['tables'][$dataset]['table_data'] = $array;
            }
                  
            //Generate an array of options for dropdown
            if (isset($this->data['config']['record'][$method_name]['dropdowns']))
            {            
                $dropdowns = $this->data['config']['record'][$method_name]['dropdowns']; 
                foreach ($dropdowns as $dropdown => $config)
                {
                    $this->data['view_setup']['dropdowns'][$dropdown] = $this->_create_dropdown(
                        $dropdowns[$dropdown], 
                        $datasets[$dropdown]
                        );
                }
            }
        }
        
        // 4. Now do the record query. store in ['controller_setup']['results']['record']
        // (This is the query that gets all the data for this record        
        if (isset($this->data['model_setup']['record']) && $rID != NULL)
        { 
            $this->data['view_setup']['fields'] = $this->_retrieve_record(
                   $rID, 
                   $this->data['model_setup']['record']
                   );
        }
        
        // 5. Now find any stats. store in ['controller_setup']['results']['stats']
        // (This is the query that gets all the data for this record        
        if (isset($this->data['config']['stats']))
        { 
            foreach ($this->data['config']['stats'][$method_name] as $stat => $array)
            {
                $this->data['view_setup']['stats'][$stat] = $this->_generate_stat($array);
            }            
        }
        
        // 6. Any post processing to be done?
        $method_name = 'post_process_' . $this->controller_name;
        if (method_exists($this, $method_name)) $this->$method_name($this->data);
        
           //print_array($this->data['view_setup']['fields'], 1, "method name = $method_name");
        // 6. Now add the fields to view set up, tidy up & generate the view        
        $this->data['view_setup']['method_name'] = $method_name;
        $this->data['view_setup']['controller_name'] = $controller_name;
        
               //Tidy up 
        unset($this->data['model_setup']); //Tidy up...
        unset($this->data['config']);       
        unset($this->data['controller_setup']);
        
        //Now let the individual controllers take over and fetch view
       
    }
    
    protected function _generate_stat($array) {
        //print_array($array, 0, 'this is array ');
        //return;
        $model_name = $array['model_name'];
        $table_name = explode('_', $model_name);
        //$this->db->where('_ActiveRecordYN', 1);
        //$this->db->where('_dID', DATAOWNER_ID);
        
        switch ($array['stat_type'])
        {
            case 'count':
                //straight count                
                if ($array['model_params']) $this->db->where($array['model_params']);
                
                $this->db->where('_ActiveRecordYN', 1);
                $this->db->where('_dID', DATAOWNER_ID);
                return $this->db->count_all_results($table_name[0]);                
                break;
            case 'count_FC_season':
                // count     
                $current_season = date(date('Y') - 1) . '/' . date(date('y'));
                if ( date('n') >= 7 ) $current_season = date(date('Y')) . '/' . date(date('y') + 1);
                $this->db->where('_ValidUntil', $current_season);
                if ($array['model_params']) $this->db->where($array['model_params']);
                
       $this->db->where('contact._ActiveRecordYN', 1);
       $this->db->where('order._ActiveRecordYN', 1);
       $this->db->where('order._dID', DATAOWNER_ID);
       $this->db->join('contact', 'contact.Id = order.ContactId');
                return $this->db->count_all_results($table_name[0]);                
                break;
            case 'average':
                break;
            case 'increase':
                //do we need a date range?
                break;
        }
    }
    
    
    
    
               
    /*
    |--------------------------------------------------------------------------
    | Data Manipulation Methods
    |--------------------------------------------------------------------------
    | These methods are post-processing of data retrieved from DB or API, or 
     *data that has been submitted and needs cleaning before instertion
    |
    */
       
    protected function _create_dropdown($config, $data, $direction = NULL) {
        //converts table results to a dropdown as defined in $config['controller_name']['dropdowns']
        $retval = array();
        extract($config);
        
        //cycle through each result
        foreach ($data as $row => $array)
        {
            $k = '';
            foreach ($label as $col_name)
            {
                $k .= $array[$col_name] . $label_separator;
            }
            
            $retval[$k] = $array[$value];
        }
        
        return $retval;
    } 
    
    protected function _generate_table_headings($fields) {
        $retval = array();
        foreach ($fields as $fieldName => $tableHeading)
        {
            if ($tableHeading != '')    //no value = no heading rqd
            {
                if (strpos($fieldName, '.')) //Strips out the table name
                { 
                    $fieldname_array = explode('.', $fieldName);
                        //creates [0] => table, and [1] => fieldname
                    $fieldName = $fieldname_array[1];
                }                        
                $retval[$fieldName] = $tableHeading;
            }
        }
        
        return $retval;
    }
    
    
    
   
    
    
    /*
    |--------------------------------------------------------------------------
    | CRUD methods
    |--------------------------------------------------------------------------
    | Methods for CRUD   
    |
    */
   protected function _prepare_model($config, $method_name) {
       $model_setup = '';  
       if (isset($config['datasets'][$method_name]))
        {
            $model_setup['datasets'] = 
                    $config['datasets'][$method_name];
        }        
        if (isset($config['record'][$method_name]))
        {
            $model_setup['record'] = 
                    $config['record'][$method_name];
        }
        
        return $model_setup;
    }
    
     protected function _generate_datasets($datasets) {
        $results = array(); 
        foreach ($datasets as $dataset => $config)
        {
            $results[$dataset] = $this->_generate_dataset ($config);
        }
        
        return $results;        
    }
    

    protected function _generate_dataset ($config) {

        if (isset($config['include_in_query']) && $config['include_in_query'])
        {
            $model_name = $config['model_name'];
            $model_method = $config['model_method'];
            $this->load->model($model_name );
            $this->db->select(array_keys($config['fields']));
            return $this->$model_name->$model_method(if_exists($config['model_params']));
        }
        else
        {
            return $config;
        }
    }

    protected function _retrieve_record ($rID, $config) {
        $results = $config['fields'];        
        //now either get the record or leave it as blank
        if (is_numeric($rID))
        {
            $model_name = $config['model_name'];
            $model_method = $config['model_method']; 
            $this->load->model($model_name );
            $col_names = array();
            foreach ($config['fields'] as $key => $array)
            {
                //echo "<br/>key = $key, ";print_r($array);
                if ($array['on'])
                {
                    $col_names[] = $array['name'];
                }
            }
           // print_array($col_names);
            $this->db->select($col_names);
            $query = $this->$model_name->
                $model_method($rID, if_exists($config['model_params']));
            foreach ($query as $col_name => $value)
            {
                $results[$col_name]['value'] = $value;                
            }
        }
        else
        {
            $this->data['view_setup']['display_none'] = 'display:none'; //hides the other parts fo the form
        }
		
        return $results;
    }
    
    function add_record($input, $rID) {        
        $model_name = $this->controller_name . '_model';
        $this->load->model($model_name);
        $rID = $this->$model_name->add($input, $rID); 
        
        return $rID;
    }
    
    function get_record($rID, $model_name = FALSE) {        
        if ( !$model_name ) $model_name = $this->controller_name . '_model';
        $this->load->model($model_name);
        $rID = $this->$model_name->get($rID); 
        
        return $rID;
    }
    
    //NOTE: This doesn't actually delete record, it just sets flag _ActiveRecordYN to 0
    function delete_record($id,  $id_field_name = 'Id') {   
        $this->load->model($this->controller_name . '_model', 'model');  
        
        //Set a success message
        if ( ! $this->model->make_inactive($id, $id_field_name) ) $message = "Delete Failed";
        else $message = "Delete successful!";            
        $this->data['view_setup']['message'] = $message;   
    }
    
    
    
    
    
    
      /*
    |--------------------------------------------------------------------------
    | View methods
    |--------------------------------------------------------------------------
    | Methods for loggin in and out. See also controllers/login.php   
    |
    */
    
    function load_view($pull) {
        if ($pull && array_key_exists ($pull, $this->data['view_setup']['tables']))
        {
          // Generate the dataset for this single table and return the HTML as JSON

          $data = $this->_generate_dataset($this->data['view_setup']['tables'][$pull]);
          $view_uri = $this->_custom_or_default_file($this->data['view_setup']['controller_name'], $this->data['view_setup']['view_file']);
          $view_uri = substr ($view_uri, 0, strlen ($view_uri) - strlen ('.php')) . '/' . $pull;
          $content = $this->load->view($view_uri, $this->data['view_setup'], true);

          $this->output->set_content_type("application/json");
          $this->output->set_output(json_encode($content));
          

        }
        else $this->_generate_view($this->data);
        return;
    }
    
     protected function _generate_view($data, $view_array = NULL) {
        // 1 . Set up the variables
        /*extract($data['controller_setup']);
        $data['view_setup']['method_name'] = $method_name;
        $data['view_setup']['controller_name'] = $controller_name;*/
        //This method talkes the view array and generates the header/navbar/body/footer

        // 2. Generate the navbar and output as HTML
        
         $navbar_setup = $data['view_setup']['navbar'];
            //Loop through each of the navbar setup properties and generate html <li>
        $html = '';
        foreach ( $navbar_setup as $navbar_item => $array )
        {
            if ($array['controller'] == $this->controller_name)
            {
                $array['css'] .= ' active';    //Sets CSS for current page
            }
            $html .= '<li class="' .$array['css'] . ' ">';
            //$html .= '<a href="' . base_url() . DATAOWNER_ID . '/' . $array['controller'];
            $html .= '<a href="' . base_url() . $array['controller'];
            $html .= '"><span>' . $array['icon'] . $array['pagename'] . '</span></a></li>';
        }
            //This is the HTML for the navbar
        $data['view_setup']['navbar'] = $html;
        $this->data['view_setup'] = $data['view_setup'];
        
        // 3. Load the views & pass the data
        extract($data['view_setup']);
        $this->load->view($this->_custom_or_default_file('common', $header_file), $data);
        $this->load->view($this->_custom_or_default_file($this->controller_name, $view_file), $data['view_setup']);
        $this->load->view($this->_custom_or_default_file('common', $footer_file), $data);
        
        
    }
    
  
     protected  function _custom_or_default_file($dir, $filename, $containing_dir = 'view', $file_ext = 'php') {
        //looks in views/custom/DATAOWNER_ID/dir for filename first then, if it is
        //not found, it looks in views/default/dir
        //This allows us to over-ride deafult views with cutom ones
         
        if (file_exists(APPPATH . "views/custom/" . DATAOWNER_ID . "/$dir/$filename.$file_ext"))
        {
            $retval = "custom/" . DATAOWNER_ID . "/$dir/$filename.$file_ext";
        }         
        elseif (file_exists(APPPATH . "views/default/$dir/$filename.$file_ext"))
        {
            $retval = "default/$dir/$filename.$file_ext";
        }
        else
        {
             show_error("Unable to load the requested file: $filename.$file_ext");
        }
        
        
        return $retval; //returns path & filename
        }
        
    protected function getQueryStringParams() {
        parse_str($_SERVER['QUERY_STRING'], $params);
        return $params;
    }
    
    
        
    
    
  
    
   
      /*
    |--------------------------------------------------------------------------
    | Loggin in/out
    |--------------------------------------------------------------------------
    | Methods for loggin in and out. See also controllers/login.php   
    |
    */
    private function _is_logged_in() {  //used as a test to see if all is well
         $status = $this->session->userdata('is_logged_in');
         //echo "status= $status and url para is" . $this->uri->segment(1);die;
         
         if (!isset($status) || $status !== TRUE)
         {
             //kick them out
             
             $message = "Oops. Your session has ended. Please log in";
             $this->data['view_setup']['message'] = $message;
             
             redirect('login');
             return;
         }
         //else echo "no, all seems ok"; die; kk
     }
     
        
}
/* End of file MY_Controller.php */
/* Location: ./application/core */
