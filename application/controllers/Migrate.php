<?php

class Migrate extends CI_Controller
{

       function __construct()
	{
		# code...
		parent::__construct();
		$this->load->library("migration");

	}

	public function index(){

		if ($this->migration->current() === FALSE )
        {
            show_error($this->migration->error_string());
        }else{
        	echo 'migration success '. $this->migration->latest();
        }
	}


}