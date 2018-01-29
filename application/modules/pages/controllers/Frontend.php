<?php

/**
* 
*/
class Frontend extends MX_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model(array(
			"Setting_model", "Tags_model", "Post_model"
		));
	}

	public function index(){
		$checkSetting = $this->__checksetting();

		if(!$checkSetting){
			redirect("create-blog");
		}

		$data['tags'] = $this->Tags_model->select();
		$data['post'] = $this->Post_model->select();
		$data['setting'] = $this->Setting_model->select();

		$data['title'] = $data['setting']['blog_title']." | Blogs";
		$this->template->load($checkSetting['templateId'], 'frontend/home', $data);
	}

	private function __checksetting(){
		$check = $this->Setting_model->select();

		if(!empty($check)){
			return $check;
		}else{
			return FALSE;
		}
	}

	public function createblog(){
		$checkSetting = $this->__checksetting();

		if(!empty($checkSetting)){
			redirect("/");
		}

		$data['currentpage'] = "create-blog";
		$data['title'] = "Create Your Own Blog - FlagBlog";

		if(isset($_POST['created_at'])){
			$this->__saveblog();
		}

		$this->load->view("frontend/createblog", $data);
	}

	private function __saveblog(){
		$input = $this->security->xss_clean($this->input->post());

		try {
			$id = $this->Setting_model->save($input);
			$this->session->set_userdata("id", $id);

			redirect("choose-template", 'refresh');
		} catch (Exception $e) {
			log_message("error", $e->getMessage());
		}
	}

	public function choosetemplate(){
		$checkSetting = $this->__checksetting();

		if(empty($checkSetting)){
			redirect("/");
		}

		$data['currentpage'] = "choose-template";
		$data['title'] = "Create Your Own Blog - FlagBlog";

		if(isset($_POST['updated_at'])){
			$this->__updatetemplate();
		}

		$this->load->view("frontend/Choosetemplate", $data);
	}

	private function __updatetemplate(){
		$input = $this->security->xss_clean($this->input->post());

		$data = array(
			"templateId" => $input['templateId'],
			"updated_at" => $input['updated_at']
		);

		try {
			$this->Setting_model->update($input['id'], $data);

			redirect("finish", "refresh");	
		} catch (Exception $e) {
			log_message("error", $e->getMessage());
		}
	}

	public function finish(){
		$checkSetting = $this->__checksetting();

		if(empty($checkSetting)){
			redirect("/");
		}
		$data['currentpage']	= "finish";
		$data['title']			= "Your Blog Has Finish To Created";

		$this->load->view('frontend/finish', $data);

	}

}