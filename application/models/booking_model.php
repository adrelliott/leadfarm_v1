<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Description of contact_model
 *
 * @author Al Elliott
 */

class Booking_model extends MY_Model {

    function __construct (){
        //parent::__construct();
        //$this->primary_key = 'Id'; This is set in MY_Model. Overwrite here if needs be
        $this->table_name = 'contactaction';
        $this->order_by = 'Id ASC';   
        //$this->contactId_fieldname = 'Id'; 
        if (isset($this->data['view_setup']['ContactId']))
        {
            $this->current_ContactId = $this->data['view_setup']['ContactId'];
        }
    }
    
    function add($input, $rID) {
       if ($rID == 'new')
       {
          $rID = NULL;
       }      
       
       return $this->save($input, $rID);
    }
    
    function get_all_bookings() {
        //set start & end date for query
        
        //set where action type = booking
        $this->db->where('ActionType =', 'Booking');
        
        //do query
        $query = $this->get();
        $results = array();
        
        foreach ($query as $row => $array)
        {
            switch ($array['_Status'])
            {
                //echo "color of status = " . $array['_Status'];die;
                case 0:
                    $color = '#99ccff'; //#ccc
                    break;
                case 1:
                    $color = '#99ccff'; //blue
                    break;
                case 2:
                    $color = '#ff9933'; //orange
                    break;
                case intval(3):
                    $color = '#ff0000'; //red
                    break;
                case 4:
                    $color = '#ffff66'; //yellow
                    break;
                case 5:
                    $color = '#99ff66'; //greeen
                    break;
                default:
                    break;
            }
            
            $url = 'booking/view/edit/' . $array['Id'] . '/' . $array['ContactId'];
            $results[] = array 
            (
                'id' => $array['Id'],
                'title' => $array['ActionDescription'],
                'htmlTitle' => $array['ActionDescription'],
                'description' => $array['CreationNotes'],
                'start' => $array['ActionDate'],
                'end' => $array['EndDate'],
                'allDay' => FALSE,
                'url' => $url,
                'color' => $color,
                'status' => $array['_Status'],
            );
            
        }
        
       return $results;
        
     
    }
   
        
    
    
    
    
    
    
    
    
    
    
    
    
   /* public function get_by_rID($rID) {
        //get one record with the ID of $rID
        parent::get($rID);
    }*/
    
    

}