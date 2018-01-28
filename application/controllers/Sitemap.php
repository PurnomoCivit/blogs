<?php

/**
 *
 */
class Sitemap extends CI_Controller
{
    protected $_data_template = array();
    function __construct()
    {
        # code...
        parent::__construct();
        $this->load->model('pages/Post_model');
    }

    public function index(){
        $this->_data_template = array(
            "post" => $this->Post_model->select(),
        );
        $this->load->view('frontend/sitemap',$this->_data_template);
    }
}
?>
