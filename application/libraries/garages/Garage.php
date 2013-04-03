<?php    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

class Garage extends CRM_Controller {
    public function __construct() {
        //construct methods go here
    }

    public function check_vehicle_expiry ($vehicles, $ContactId, $countdown = COUNTDOWN) {
        $n = array(); //holds notifications
        $countdown = ($countdown * 24 * 60 * 60 ); //Make days into seconds
        foreach ($vehicles['table_data'] as $row => $data)
        {
            $identifier = $data['__Registration'] . ' (' . $data['__Make'] . ' ' . $data['__Model'] . ')';
            //$n[$row] = $this->check_expiry_dates ($data, $identifier);
            $retval = array();
            foreach ($data as $key => $value)
            {
                switch ($key)
                {
                    case '__MOT_expiry':
                         $date = explode(' ', $data['__MOT_expiry']);
                         $date = explode('-', $date[0]);
                         $timestamp = mktime(0, 0, 0, $date[1], $date[2], $date[0]);
                         $date = $date[2] . '/' . $date[1] . '/' . $date[0];

                         if ($timestamp - time() <= $countdown)
                         {
                             $n[$data['__Id']][] =  '<span class="notification warning">The MOT is expired, or about to expire, for <a href="' . site_url( '/vehicles/view/edit/' . $data['__Id'] . '/' . $ContactId ) .  '" class="">' . $identifier . '</a>.(Expiry date recorded is <strong>' . $date . '</strong>)</span>';
                         }
                         break;
                    case '__Service_expiry':
                         $date = explode(' ', $data['__Service_expiry']);
                         $date = explode('-', $date[0]);
                         $timestamp = mktime(0, 0, 0, $date[1], $date[2], $date[0]);
                         $date = $date[2] . '/' . $date[1] . '/' . $date[0];

                         if ($timestamp - time() <= $countdown)
                         {
                            $n[$data['__Id']][] =  '<span class="notification warning">The SERVICE is expired, or about to expire, for <a href="' . site_url( '/vehicles/view/edit/' . $data['__Id'] . '/' . $ContactId ) . '" class="">' . $identifier . '</a>. (Expiry date recorded is <strong>' . $date . '</strong>)</span>';
                         }
                         break;
                }
            }
        } 
        return $n;
    }
       
}