<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

session_start();
$_SESSION['dID'] = '22222';
$dID = $_SESSION['dID'];
// store session data
if ( ! isset($dID) || empty($dID) ) 
{
    header( 'Location: http://google.co.uk');
    return;
}

//do we have a bespoke controller for this client?
$file_path = APPPATH . 'controllers/bespoke_controllers/' . $dID . '/' . 'booking' . '.php';
/*if (file_exists($file_path)) 
{
    include ($file_path);
    return;
}*/


class Booking extends T_Booking {

    public function __construct()    {
        parent::__construct();
$this->output->enable_profiler(TRUE);
echo "<h1>This si the standard controller</h1>";
        $file_path = APPPATH . 'controllers/bespoke_controllers/' . '22222' . '/' . 'booking' . '.php';
        if (file_exists($file_path)) 
        {
            include ($file_path);
        }
    }

    public function index($view_file = 'index') {   
        parent::index($view_file);

         // Generate the view!
        $this->_generate_view($this->data);  


    }

    public function view($view_file = 'edit', $rID = 'new', $ContactId = FALSE, $pull = '') { 
        parent::view($view_file, $rID, $ContactId);

        $this->load_view($pull);

    }

    public function get_booking_array() {
       //this generates the data for the non-workshop view
       $this->load->model('booking_model');
       $results = $this->booking_model->get_all_bookings();
        header ('Content-Type: text/json');
        echo json_encode ($results);
        exit;
   }

    function test_gen() {
       echo 'hello - I am in the main folder';
    }


}

    



   