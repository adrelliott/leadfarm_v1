<?php    if ( ! defined('BASEPATH') ) exit( 'No direct script access allowed' );

//Note - this class is taken from: http://www.moreofless.co.uk/using-native-php-sessions-with-codeigniter/


    class Nativesession
    {
        public function __construct()
        {
            session_start();
        }

        public function set_native_session( $key, $value )
        {
            $_SESSION[$key] = $value;
        }

        public function get_native_session( $key )
        {
            return isset( $_SESSION[$key] ) ? $_SESSION[$key] : null;
        }

        public function regenerateId( $delOld = false )
        {
            session_regenerate_id( $delOld );
        }

        public function delete_native_session( $key )
        {
            unset( $_SESSION[$key] );
        }
    }