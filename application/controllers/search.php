<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//Test to see if we have a bespoke controller class configured in controller_config.php
include('controller_config/init.php');
if( bespoke_controller('Contact') ) get_bespoke_controller();  //yup = go get it.
else
{   //nope? Use this default class then
    
    class Search extends CRM_Controller {
        
        public $controller_name = 'search';
        public $search_tables = array   //should this be private??
            (
                'contact', 'order'
            );

        public function __construct()    {
             parent::__construct();
             
           $this->output->enable_profiler();
             $this->load->library('pagination');
        }

        public function index() {   
            parent::index();
            $this->_load_view_data();
            $this->_generate_view($this->data);
        }
        
        public function report($report_type, $start = 0) {
             $retval = array();
             $export = FALSE;
             
             //set up config for pagination
             $config = array();
             $config['base_url'] = base_url('search/report/' . $report_type);
             $config['uri_segment'] = 4;
             $config['per_page'] = 50;
             $limit = $config['per_page'];
             $start = $this->uri->segment(4);

             //Do the search
             $retval = $this->do_search(FALSE, $limit, $start, $report_type);
             $config['total_rows'] = $retval['count'];
                     
             //Set up the view
            $this->pagination->initialize($config);
            $this->data['view_setup']['tables']['search_results'] = $retval;
            $this->data['view_setup']['tables']['search_results']['pagination_links'] = $this->pagination->create_links();
            $this->data['view_setup']['tables']['search_results']['total_records'] = $config['total_rows'];

            //load the view
            parent::report();
            $this->_load_view_data();
            
            $this->_generate_view($this->data);
            
        }
        
        function export_as_csv($report_type) {
            $retval = $this->do_search(TRUE, FALSE, 0, $report_type);
            //print_array($retval);
            //return;
            
            //load the view
            parent::report();
            $this->_load_view_data();
            
            $this->_generate_view($this->data);
            
             $this->load->helper('download');
            $csv = $retval['csv'];
            $name = "csv_export.csv";
            //print_array( $this->data['tables']['search_results']['csv_file'] , 1);
            force_download($name, $csv);
        }
        
        function do_search($export, $limit, $start, $report_type) {
            switch ($report_type)
             {
                 case 'order':
                     //load order model
                     $this->load->model('order_model');
                     $retval = $this->order_model->get_orders_join($export, $limit, $start);
                     //$config['total_rows'] = $this->order_model->record_count();
                     break;
                 default:
                     break;
             }
            
             //print_array($retval, 1);
             return $retval;
        }
        
        
        
    }
}   