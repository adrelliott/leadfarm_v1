<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends T_Booking {

	/**
	 * This acts as a template for every controller.
	 *
	 * Define methods/vars here in the construct (to run before anything else) 
	 * and/or define methods here that can be extended in other controllers
	 * 
	 */

    public function __construct()    {
        
        //$this->data['view_setup']['header_file'] = 'header_modal'; 
        parent::__construct();
    }
    
    public function index($view_file = 'index') {   
        $this->data['view_setup']['view_file'] = 'v_booking_' . $view_file;
        //$this->data['view_setup']['header_file'] = 'header_modal';
        parent::index();
      
          // Generate the view!
        $this->generate_view($this->data);
    }
   
    public function view($view_file = 'view', $rID = 'new', $ContactId = FALSE) {     
        $this->data['view_setup']['view_file'] = 'v_booking_' . $view_file;
        parent::view($rID, $ContactId);
        
            //check for expirations of MOT & service
        $this->load->library('garages/garage');
        $this->data['view_setup']['notifications'] = array();
        if (isset($this->data['view_setup']['tables']['vehicles']['table_data'][0]))
        {
            $this->data['view_setup']['notifications'] = 
                    $this->garage->check_vehicle_expiry 
                    (
                    $this->data['view_setup']['tables']['vehicles'],
                    $this->data['view_setup']['ContactId']
                    );
        }
          // Generate the view!
        $this->generate_view($this->data);
    }
   
    
    
    
    
      public function get_booking_array() {
       $results = array ();

        $title = 'Title with some <strong>HTML</strong> in';
        $description = '';
        $start_ts = mktime (8, 0, 0, 1, 30, 2013);
        $end_ts = mktime (10, 0, 0, 1, 30, 2013);
        $url = 'http://leadfarm-staging.co.uk/22222/booking';

        $results[] = array (
          'id' => 1,                      /* ID of the event */
          'title' => strip_tags ($title), /* Title that has been made HTML-safe */
          'htmlTitle' => $title,          /* Original title */
          'description' => $description,  /* HTML description */
          'start' => date ('Y-m-d H:i:s', $start_ts),
          //'start' => date ('Y-m-d', $start_ts),
          'end' => date ('Y-m-d H:i:s', $end_ts),
          //'end' => date ('Y-m-d', $end_ts),
          'allDay' => false,
          'url' => $url,
          'color' => '#cdcdcd'          /* Hex-code for background-colour */
        );

        header ('Content-Type: text/json');
        echo json_encode ($results);
        exit;
   }
    
    
    public function get_bookings() {
        //get all the booking data
        $year = date('Y');
        $month = date('m');

        echo json_encode(array(

		array(
			'id' => 111,
			'title' => "Event1",
			'start' => "$year-$month-10",
			'url' => "http://yahoo.com/"
		),

		array(
			'id' => 222,
			'title' => "Event2",
			'start' => "$year-$month-20",
			'end' => "$year-$month-22",
			'url' => "http://yahoo.com/"
		)

	));
        
        /*
         * {
                title: 'All Day Event',
                start: new Date(y, m, 1)
            },
            {
                title: 'Long Event',
                start: new Date(y, m, d - 5),
                end: new Date(y, m, d - 2)
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: new Date(y, m, d - 3, 16, 0),
                allDay: false
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: new Date(y, m, d + 4, 16, 0),
                allDay: false
            },
            {
                title: 'Meeting',
                start: new Date(y, m, d, 10, 30),
                allDay: false
            },
            {
                title: 'Lunch',
                start: new Date(y, m, d, 12, 0),
                end: new Date(y, m, d, 14, 0),
                allDay: false
            },
            {
                title: 'Birthday Party',
                start: new Date(y, m, d + 1, 19, 0),
                end: new Date(y, m, d + 1, 22, 30),
                allDay: false
            },
            {
                title: 'Click for Google',
                start: new Date(y, m, 28),
                end: new Date(y, m, 29),
                url: 'http://google.com/'
            }
         */

   }
      
}
   