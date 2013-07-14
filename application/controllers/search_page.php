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
     public $pagination_config = array();

    public function __construct() {
        parent::__construct();
        $this->load->model('search_page_model', 'search');
        $this->output->enable_profiler();
             $this->load->library('pagination');
    }
    
    public function index() {   
        parent::index();
        $this->_load_view_data();
        $this->_generate_view($this->data);
    }
    
    public function search($main_table, $join_table, $query_type, $search_type, $start = 0) {
        //print_array($this->input->post());
        //pass data to model & get results
        
        
        //return;
        
        
        //Do the search
        $limit =50;
        //$this->session->set_userdata('report_type', $report_type);
        $this->_results = $this->search->do_search($main_table, $join_table, $query_type, $search_type, $start, $limit);
        
        //print_array($this->_results, 1);
        
        //$retval = $this->do_search(FALSE, $limit, $start, $report_type);
        $this->data['view_setup']['tables']['search_results']['table_data'] = $this->_results['results'];
        $this->data['view_setup']['tables']['search_results']['table_headers'] = $this->_results['cols'];
        $this->data['view_setup']['tables']['search_results']['count_results'] = $this->_results['count_results'];
        //$config['total_rows'] = $this->_results['count_results'];
        
        //now display the page
        //load the view
        //$url = $this->uri->uri_string();
        $this->set_up_pagination($this->_results['count_results']);
        $this->report();
        return;
    }
    
    public function report($start = FALSE) {
        if ($start)
        {
            //print_array($_SESSION, 1); 
            $this->_results = $this->search->do_query($this->session->userdata('last_query'), $start);
        
        //print_array($this->_results, 1);
        
        //$retval = $this->do_search(FALSE, $limit, $start, $report_type);
        $this->data['view_setup']['tables']['search_results']['table_data'] = $this->_results['results'];
        $this->data['view_setup']['tables']['search_results']['table_headers'] = $this->_results['cols'];
        $this->data['view_setup']['tables']['search_results']['count_results'] = $this->_results['count_results'];
        
        }
       
        parent::report();
        $this->pagination->initialize($this->pagination_config);
        //$this->data['view_setup']['tables']['search_results'] = $retval;
        $this->data['view_setup']['tables']['search_results']['pagination_links'] = $this->pagination->create_links();
        //$this->data['view_setup']['tables']['search_results']['total_records'] = $this->pagination_config['total_rows'];
        
        //.= ' LIMIT ' . $start . ',' . $limit;    
        $this->_load_view_data();
        $this->_generate_view($this->data);
        //echo "done";
    }
    
    function set_up_pagination($count) {
        $this->pagination_config = array();
        $this->pagination_config['base_url'] = base_url('search_page/report');
        $this->pagination_config['uri_segment'] = 7;
        $this->pagination_config['per_page'] = 50;
        $this->pagination_config['total_rows'] = $count;
        $limit = $this->pagination_config['per_page'];
        $start = $this->uri->segment(8);

        return;
                     
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