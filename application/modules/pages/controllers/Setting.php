<?php


/**
* 
*/
class Setting extends MX_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model("Setting_model");
	}

	public function index(){
		$data['title'] = "Setting | Blog";
		$data['currentpage'] = "setting";

		$data['setting'] = $this->Setting_model->select();

		if(isset($_POST['updated_at'])){
			$this->__update($data['setting']['id']);
		}

		$data['success'] = $this->session->flashdata("success");
		$data['error'] = $this->session->flashdata("error");

		$this->template->load("template_admin", "backend/setting", $data);

	}

	private function __update($id){
		$input = $this->security->xss_clean($this->input->post());

		try {
			$this->Setting_model->update($id, $input);
			$this->session->set_flashdata("success", "Data updated");
			redirect("setting","refresh");
		} catch (Exception $e) {
			log_message("error", $e->getMessage());
			$this->session->set_flashdata("error", "Data failed to update");
			redirect("setting","refresh");
		}

	}
}