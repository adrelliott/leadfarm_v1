<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Contact') ) get_bespoke_controller();  //yup = go get it.
else
{   //nope? Use this default class then
    
/**
 * Controller - Search_page
 * @author Al Elliott
 * 
 * XXXXXXXXXXDescription_goes_hereXXXXXXXXXX
 * 
 */
class Search_page extends CRM_Controller {

    //Define vars here
    private $_results = array();    //Contains ythe results of the query
     public $controller_name = 'search_page';

    public function __construct() {
        parent::__construct();
        $this->load->model('search_page_model', 'search');
        $this->output->enable_profiler();
    }
    
    public function index() {   
        parent::index();
        $this->_load_view_data();
        $this->_generate_view($this->data);
    }
    
    public function search($main_table, $join_table, $query_type, $search_type) {
        print_array($this->input->post());
        //pass data to model & get results
        $this->_results = $this->search->do_search($main_table, $join_table, $query_type, $search_type);
        
        return;
        $this->data['view_setup']['tables']['search_results'] = $this->_results;
        
        //now display the page
        //load the view
        $this->report();
        return;
    }
    
    public function report() {
        parent::report();
        $this->_load_view_data();
        $this->_generate_view($this->data);
    }
    
    
    public function save_search() {
        //seve the search
        
    }
    
    public function load_search() {
        //load the search
        
    }
    
    public function export() {
        //export
        
    }
    
    

}
}

/* End of file Search_page.php */
/* Location: ./application/controllers/XXXXXXXXXXXXXXXXXXXX/Search_page.php */