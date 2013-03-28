<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Test extends CI_Controller {

    public function __construct()    {
        parent::__construct();
    }


    public function index() {          
        echo "<h1>This is the index of test</h1>";
    }
    public function testing() {          
        echo "<h1>This is method 'testing' of controller 'test'</h1>";
    }
    public function error() {          
        echo "<h1>This is method 'error' of controller 'test'</h1>";
    }
    

   


}