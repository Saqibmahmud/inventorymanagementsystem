<?php

class Dashboards extends MY_Controller {


    public function __construct() {
        parent::__construct();
    }

    public function index() {
        $data['new_brands'] = 380;
        $data['new_bonus'] = 660;
        $data['new_users'] = 500;
        $data['new_visitors']=380;


        $this->layout('dashboard', $data);
    
        
    }
     

}

