<?php 


/**
* 
*/
class Management extends MX_Controller
{
	
	function __construct()
	{
		# code...
		parent::__construct();
		$this->load->model(array("Setting_model", "Post_model", "Tags_model"));
	}

	public function index(){

		$data['currentpage'] = "sign-in";
		$data['title'] = "Sign in";

		if(isset($_POST['login'])){
			$this->__login();
			$data['error'] = $this->session->flashdata('error');
		};

		$this->load->view("login", $data);

	}

	private function __login(){
		$input = $this->security->xss_clean($this->input->post());

		$check = $this->Setting_model->select(array("blog_email" => $input['email']));

		if(!empty($check)){
			$this->session->set_userdata("setting", $check);

			redirect('post', 'refresh');
		}else{
			$this->session->set_flashdata("error", "Email is wrong!");

			return false;
		}
	}

	public function post(){
		if(empty($this->session->userdata("setting")['id'])){
			redirect("/");
		}

		$data['post'] = $this->Post_model->select();
		$data['currentpage'] = "post";
		$data['title'] = "Blogs Management | Post Management";

		if(!empty($data['post'])){
			for($key = 0; $key < count($data['post']); $key++){
				$checkTags = $this->Tags_model->select(array("id_post"=>$data['post'][$key]['id']));
				$tag = array();
				foreach ($checkTags as $keyV => $valueK) {
					# code...
					$tag[]	= $valueK['tag_name'];
				}
					$data['post'][$key]['tag_name'] = implode(", ", $tag);

			}
		}

		$this->template->load("template_admin", "backend/post", $data);
	}

	public function createpost($id = null){
		if(empty($this->session->userdata("setting")['id'])){
			redirect("/");
		}

		$data['currentpage'] = "post";
		$data['title'] = "Blogs Management | Post Management ~ Create";
		$data['js'] = "";
		$data['action']	= "create";

		if(!empty($id)){
			$data['action'] = "update";
			$data['post'] = $this->Post_model->select(array("id"=>$id));
			foreach ($data['post'] as $keyPost => $valuePost) {
				# code...
				$checkTags = $this->Tags_model->select(array("id_post"=>$valuePost['id']));
				$tags = array();
				foreach ($checkTags as $keyT => $valueT) {
					# code...
					$tags[] = $valueT;

					$data['post'][$keyPost]['tag_name'] = $tags;
				}
			}

		}else{
			$data['post'][0] = array(
				"post_title"	=> "",
				"post_slug"		=> "",
				"post_description"	=> "",
				"tag_name"		=> "",
				"thumbnail"		=> ""
			);
		}

		if(isset($_POST['create'])){
			$this->__createpost();
		}

		if(isset($_POST['update'])){
			$this->__updatepost();
		}

		$data['success'] = $this->session->flashdata("success");
		$data['error'] = $this->session->flashdata("error");

		$this->template->load("template_admin", "backend/form", $data);
	}

	private function __createpost(){
		$input = $this->security->xss_clean($this->input->post());

		$config['upload_path']          = './assets/media/';
        $config['allowed_types']        = 'gif|jpg|png';
        // $config['max_size']             = 100;
        // $config['max_width']            = 1024;
        // $config['max_height']           = 768;

        $this->load->library('upload', $config);
        $data = array();
        if ( ! $this->upload->do_upload('thumbnail'))
        {
                $error = array('error' => $this->upload->display_errors());

                log_message("error", $this->upload->display_errors());
	        	$this->session->set_flashdata("error", $this->upload->display_errors());
	        	return false;
        }
        else
        {
                $data = array('upload_data' => $this->upload->data());
        }

        $save = array(
        	"post_title" => $input['title'],
        	"post_description" => $input['description'],
        	"post_slug"	=> $input['slug'],
        	"thumbnail"	=> $data['upload_data']['file_name'],
        	"created_at"	=> date('Y-m-d H:i:s')
        );


        try {
        	$saved = $this->Post_model->save($save);
        	
        	$getTags = explode(",", $input['tag']);

        	$tags = array();

        	for($key = 0; $key < count($getTags); $key++){
	        	$tags[] = array(
	        		"id_post" => $saved,
	        		"tag_name" => $getTags[$key],
	        		"created_at" => date("Y-m-d H:i:s")
	        	);
        	}

        	try {
        		$this->Tags_model->save($tags);
        		$this->session->set_flashdata("success", "Data has been created.");
        		
        		redirect("post");
        	} catch (Exception $e) {
	        	log_message("error", $e->getMessage());
	        	$this->session->set_flashdata("error", $e->getMessage());
	        	return false;
        	}
        } catch (Exception $e) {
        	log_message("error", $e->getMessage());
        	$this->session->set_flashdata("error", $e->getMessage());
        	return false;
        }

	}

	private function __updatepost(){

		$input = $this->security->xss_clean($this->input->post());

		var_dump($input);exit();
	    $data = array();

		if(!empty($input['thumbnail'])){
			$config['upload_path']          = './assets/media/';
	        $config['allowed_types']        = 'gif|jpg|png';

	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('thumbnail'))
	        {
	                $error = array('error' => $this->upload->display_errors());

	                log_message("error", $this->upload->display_errors());
	        }
	        else
	        {
	                $data = array('upload_data' => $this->upload->data());
	        }
    	}

    	$update = array(
    		"thumbnail" => (!empty($data['upload_data']) ? $data['upload_data']['file_name'] : $input['thumbnailupdate']),
    		"post_slug"	=> $input['slug'],
    		"post_title"=> $input['title'],
    		"post_description"	=> $input['description'],
    		"updated_at"	=> date("Y-m-d H:i:s")
    	);

    	try {
    		
    	} catch (Exception $e) {
    		log_message("error", $e->getMessage());
    		$this->session->set_flashdata("error", $e->getMessage);
    		return false;
    	}
		
	}

	public function deletepost($id){
		if(empty($this->session->userdata("setting")['id'])){
			redirect("/");
		}

		$delete = $this->Post_model->delete($id);
		if($delete){
			$this->session->set_flashdata("success", "Delete has success");
			redirect("post");
		}else{
			$this->session->set_flashdata("error", "Delete has failed");
			redirect("post");
		}
	}



}?>