<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Define standard database settings
|--------------------------------------------------------------------------
|
| We define standard DB settings here. This applies to all environments
| This overides config/database.php and is 
| 'included' by bespoke_config.php/XXXXX_database.php
*/

$config['database']['hostname'] = 'localhost';
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
$config['database']['prefix'] = '';

//Each envirnment has a standard prefix for db users and databases
switch (ENVIRONMENT) 
{
case 'hn-development':
    $config['database']['prefix'] = '';
    break;	
case 'al-development':
    $config['database']['prefix'] = 'local_';
    break;
case 'staging':
    //$config['database']['prefix'] = 'leadfar2_';
    $config['database']['prefix'] = 'leadfarm_';
    break;
case 'demo':
    $config['database']['prefix'] = 'automati_';
    break;
case 'production':
    $config['database']['prefix'] = 'campaign_';
    break;
default:
    exit('The application environment is not set correctly.');
}




/* End of file global_database.php */
/* Location: ./application/config/bespoke_config/global_database.php */