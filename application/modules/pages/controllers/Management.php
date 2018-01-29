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

		$data['success'] = $this->session->flashdata("success");
		$data['error'] = $this->session->flashdata("error");

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

        	$tags = array();

        	foreach ($input['tag'] as $keyTags => $valueTags) {
        		# code...
	        	$tags[] = array(
	        		"id"	=> $keyTags,
	        		"id_post" => $saved,
	        		"tag_name" => $valueTags,
	        	);
        	}

        	try {
        		$this->Tags_model->updatebatch($tags);
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

	    $data = array();

		if(!empty($_FILES['thumbnail'])){
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

    		$saved = $this->Post_model->update($input['id'], $update);

        	$tags = array();

        	foreach ($input['tag'] as $keyTags => $valueTags) {
        		# code...
	        	$tags[] = array(
	        		"id"	=> $keyTags,
	        		"id_post" => $saved,
	        		"tag_name" => $valueTags,
	        	);
        	}

        	try {
        		$this->Tags_model->updatebatch($tags);
        		$this->session->set_flashdata("success", "Data has been created.");
        		
        		redirect("post");
        	} catch (Exception $e) {
	        	log_message("error", $e->getMessage());
	        	$this->session->set_flashdata("error", $e->getMessage());
	        	return false;
        	}
    		
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

	public function createtags(){
		$input = $this->security->xss_clean($this->input->get());

		$data = array(
			"tag_name" => $input['tag_name'],
			"created_at" => date("Y-m-d H:i:s"),
		);

		if(!empty($input['tag_name'])){
			$id = $this->Tags_model->insert($data);

			exit(json_encode($id)); 
		}else{
			exit(FALSE);
		}
	}

	public function deletetags(){
		$input = $this->security->xss_clean($this->input->get());

		if(!empty($input['id'])){
			$id = $this->Tags_model->delete($input['id']);

			exit(json_encode($id)); 
		}else{
			exit(FALSE);
		}
	}

	public function searchpost(){
		$input = $this->security->xss_clean($this->input->get());

		$data['setting'] = $this->Setting_model->select();
		$inputExplode = explode(" ", $input['search']);
		foreach ($inputExplode as $keyExplode => $valueExplode) {
			$conditionpost = "post_description LIKE '%".$valueExplode."%' OR post_title LIKE '%".$valueExplode."%'";
			$postsearch = $this->Post_model->search($conditionpost);
			for($key = 0; $key < count($postsearch); $key++){
				$checkTags = $this->Tags_model->select(array("id_post"=>$postsearch[$key]['id']));
				$tag = array();
				foreach ($checkTags as $keyV => $valueK) {
					# code...
					$tag[]	= $valueK['tag_name'];
				}
					$postsearch[$key]['tag_name'] = implode(", ", $tag);

			}

			$data['postsearch'] = $postsearch;

			$conditiontags = "tag_name LIKE '%".$valueExplode."%'";
			$data['tagssearch'] = $this->Tags_model->search($conditiontags);
		}

		$this->template->load($data['setting']['templateId'], "frontend/search", $data);
	}


	public function tagdetail($slug){
		
		$data['setting'] = $this->Setting_model->select();

		$data['tags'] = $this->Tags_model->select(array("tag_name" => str_replace("-", " ", $slug)));

		$data['post'] = $this->Post_model->select(array("id" => $data['tags'][0]['id_post']));


		$data['meta'] = array(
			"description" => substr($data['tags'][0]['tag_name'], 0, 150),
			"keywords" => $data['tags'][0]['tag_name'],
			"author" => $data['setting']['blog_title']
		);

		$data['title'] = $data['tags'][0]['tag_name']." | Blog ".$data['setting']['blog_title'];
		$this->template->load($data['setting']['templateId'], "frontend/tagsdetail", $data);
	}

	public function postdetail($slug){

		$data['setting'] = $this->Setting_model->select();

		$data['post'] = $this->Post_model->select(array("post_slug" => $slug));


		$data['title'] = $data['post'][0]['post_title']." | Blog ".$data['setting']['blog_title'];

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
		}else{
			redirect("/", "404");
		}

		$data['meta'] = array(
			"description" => substr($data['post'][0]['post_description'], 0, 150),
			"keywords" => $data['post'][0]['tag_name'],
			"author" => $data['setting']['blog_title']
		);

		$this->template->load($data['setting']['templateId'], "frontend/postdetail", $data);
	}

}

?>