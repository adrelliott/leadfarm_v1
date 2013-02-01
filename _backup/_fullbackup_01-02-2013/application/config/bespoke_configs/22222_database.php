<?php

$config['database']['hostname'] = 'localhost';

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

$config['database']['dbdriver'] = 'mysql';
$config['database']['dbprefix'] = '';
$config['database']['pconnect'] = TRUE;
$config['database']['db_debug'] = TRUE;
$config['database']['cache_on'] = FALSE;
$config['database']['cachedir'] = '';
$config['database']['char_set'] = 'utf8';
$config['database']['dbcollat'] = 'utf8_general_ci';
$config['database']['swap_pre'] = '';
$config['database']['autoinit'] = TRUE;
$config['database']['stricton'] = FALSE;