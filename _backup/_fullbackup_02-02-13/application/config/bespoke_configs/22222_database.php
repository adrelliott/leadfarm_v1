<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Define database settings for this user
|--------------------------------------------------------------------------
|
| We define standard DB settings here. This ifile is 'included' by the main 
| XXXXX_config.php file and is set up to serve both dev, staging and prod environs
*/



switch (ENVIRONMENT) 
{
case 'development':
		$config['database']['username'] = 'leadfarm_22222';
		$config['database']['password'] = 'DMmanch35';
		$config['database']['database'] = '22222_leadfarm_data';
		break;
	
case 'staging': //????? depends on the test!
		$config['database']['username'] = 'leadfar2_admin';
		$config['database']['password'] = 'DMmanch35';
		$config['database']['database'] = 'leadfar2_22222_1';
		break;
					
case 'production':
		error_reporting(0);
		$root = '/home/leadfarm/';
		break;

		default:
			exit('The application environment is not set correctly.');
}

include('global_database.php');

/* End of file xxxx_database.php */
/* Location: ./application/config/bespoke_config/ */
