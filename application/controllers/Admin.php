<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public $loggedin;
    
	function __construct()
    {
		
        parent::__construct();
       

        $this->load->library('email');
		$this->load->library('form_validation');
		$this->load->library('session');

        $this->load->model('admin_modal');
        $this->digital_upload_path = 'files/';
        $this->upload_path = 'assets/uploads/';
        $this->thumbs_path = 'assets/uploads/thumbs/';
        $this->image_types = 'gif|jpg|jpeg|png|tif';
        $this->digital_file_types = 'zip|psd|ai|rar|pdf|doc|docx|xls|xlsx|ppt|pptx|gif|jpg|jpeg|png|tif|txt';
        //$this->allowed_file_size = '1024';
        $this->allowed_file_size = '';
		$this->data = array();
		$this->loggedin =  $this->session->userdata('id');     	
    }

    function index()
    { 
		$user_id = $this->session->userdata('id');
		if (!empty($user_id) && isset($user_id)) {
            redirect('admin/dashboard');
        }
		
		$error_code = $this->uri->segment(3);
        $error_msg = "";
		if (isset($error_code) && !empty($error_code)) {
            switch ($error_code) {
                case 1: $error_msg = "Please fill all required fields...";
                    break;
                case 2: $error_msg = "Email or Password is invalid...";
                    break;
                default: $error_msg = "There is an critical error...";
            }
        }

        $this->data = array('error_msg' => $error_msg);
		
		
		$data = $this->data;
        $this->load->vars($this->data);
		$this->load->view('admin/login', $data);
    }
	
	public function login() {
		$error_code = $this->uri->segment(3);
        $error_msg = "";
		if (isset($error_code) && !empty($error_code)) {
            switch ($error_code) {
                case 1: $error_msg = "Please fill all required fields...";
                    break;
                case 2: $error_msg = "Email or Password is invalid...";
                    break;
                default: $error_msg = "There is an critical error...";
            }
        }

        $this->data = array('error_msg' => $error_msg);
		$data = $this->data;
		$this->load->vars($this->data);
		$this->load->view('admin/login', $data);
	}
	
	   public function login_check() {
        $user = $this->security->xss_clean($this->input->post('user_id'));
        $pass = $this->security->xss_clean($this->input->post('user_pass'));

        if (empty($user) || empty($pass)) {
            redirect('admin/login/1');
            exit;
        }

        $result = $this->admin_modal->admin_login($user, $pass);

        if (!$result) {
            redirect('admin/login/2');
            exit;
        } else {
            $loginData = array(
                'id' => $result->id,
                'first_name' => $result->user_fname,
				'last_name' => $result->user_lname,
                'role' => 'admin',
                'user_email' => $result->user_email,
                'user_type' => $result->user_type
            );

            $this->session->set_userdata($loginData);
            redirect('admin/dashboard');
            exit;
        }
    }
	
	
	function dashboard(){
		if(empty($this->loggedin)){
			redirect('admin/login');
		}
		
		$error_code = $this->uri->segment(3);
		$error_msg = '';

		// Prepare error message
        if (isset($error_code) && !empty($error_code)) {
			switch ($error_code) {
				case 1: $error_msg = "Category successfully updated.";
					break;
				case 2: $error_msg = "Something went wrong, please try again.";
					break;
				case 3: $error_msg = "Category successfully added.";
					break;
				case 4: $error_msg = "Something went wrong, please try again.";
					break;
				case 5: $error_msg = "Category already exists, please try again.";
					break;
				case 6: $error_msg = "Status has been changed.";
					break;
				case 7: $error_msg = "Record has been deleted.";
					break;
				
				default: $error_msg = "";
			}
		}
		$data = $this->data;
		$this->load->vars($this->data);
		$data['error_msg'] = $error_msg;
		$data['categories'] = $this->admin_modal->getCategories();
		$this->load->view('admin/categorylist', $data);
		//$this->load->view('admin/dashboard', $data);
		
    }
	
	
	function category(){ 
		if(empty($this->loggedin)){
			redirect('admin/login');
		}
	
		$error_code = $this->uri->segment(3);
		$error_msg = '';

		// Prepare error message
        if (isset($error_code) && !empty($error_code)) {
			switch ($error_code) {
				case 1: $error_msg = "Category successfully updated.";
					break;
				case 2: $error_msg = "Something went wrong, please try again.";
					break;
				case 3: $error_msg = "Category successfully added.";
					break;
				case 4: $error_msg = "Something went wrong, please try again.";
					break;
				case 5: $error_msg = "Category already exists, please try again.";
					break;
				case 6: $error_msg = "Status has been changed.";
					break;
				case 7: $error_msg = "Record has been deleted.";
					break;
				case 8: $error_msg = "Category successfully updated.";
					break;
				
				default: $error_msg = "";
			}
		}
		$data = $this->data;
		$this->load->vars($this->data);
		$data['error_msg'] = $error_msg;
		$data['categories'] = $this->admin_modal->getCategories();
		$this->load->view('admin/categorylist', $data);
	}
	
	function addcategory(){ 
		if(empty($this->loggedin)){
			redirect('admin/login');
		}
		$error_code = $this->uri->segment(3);
		$error_msg = '';

		// Prepare error message
        if (isset($error_code) && !empty($error_code)) {
			switch ($error_code) {
				case 1: $error_msg = "Category successfully updated.";
					break;
				case 2: $error_msg = "Something went wrong, please try again.";
					break;
				case 3: $error_msg = "Category successfully added.";
					break;
				case 4: $error_msg = "Something went wrong, please try again.";
					break;
				case 5: $error_msg = "Category already exists, please try again.";
					break;
				case 6: $error_msg = "Status has been changed.";
					break;
				default: $error_msg = "";
			}
		}
		
		$data = $this->data;
		$this->load->vars($this->data);
		$data['category'] = $this->admin_modal->getCategories();
		$data['catdata'] = '';
		$data['error_msg'] = $error_msg;
		$this->load->view('admin/addcategory', $data);
	}
	
	function editcategory(){ 
		if(empty($this->loggedin)){
			redirect('admin/login');
		}
		$cat_id = $this->uri->segment(3);
		$error_code = $this->uri->segment(4);
		$error_msg = '';

		// Prepare error message
        if (isset($error_code) && !empty($error_code)) {
			switch ($error_code) {
				case 1: $error_msg = "Category successfully updated.";
					break;
				case 2: $error_msg = "Something went wrong, please try again.";
					break;
				case 3: $error_msg = "Category successfully updated.";
					break;
				case 4: $error_msg = "Something went wrong, please try again.";
					break;
				case 5: $error_msg = "Category already exists, please try again.";
					break;
				default: $error_msg = "";
			}
		}
		
		$data = $this->data;
		$this->load->vars($this->data);
		$data['category'] = $this->admin_modal->getCategories();
		$data['catdata'] = $this->admin_modal->getCategory($cat_id);
		$data['error_msg'] = $error_msg;
		$this->load->view('admin/addcategory', $data);
	}
	
	
	function savecategory(){ 
		if(empty($this->loggedin)){
			redirect('admin/login');
		}
		if (isset($_POST) && !empty($_POST) ) {
			$cat_name = $this->input->post('cat_name');
			if(empty($cat_name)){
				redirect('admin/addcategory/1');
			}
			$cat_slug = $this->input->post('cat_slug');
			if(empty($cat_slug)){
			 	redirect('admin/addcategory/2');
			}
			$cat_id = $this->input->post('cat_id');
			if(!empty($cat_id)){
				$excat = $this->admin_modal->getCategorybyName($this->input->post('cat_name'));
				if(count($excat)>0){
					if($excat->cat_id!=$this->input->post('cat_id')){
						redirect('admin/addcategory/5');
					}
				}
				
			}else{
				if(count($this->admin_modal->getCategorybyName($this->input->post('cat_name')))>0){
					redirect('admin/addcategory/5');
				}
			}
			
			
				$insetData = array(
					'cat_name' => $this->input->post('cat_name'),
					'cat_slug' => $this->input->post('cat_slug'),
					'cat_parent' => $this->input->post('cat_parent'),
					'cat_home' => $this->input->post('cat_home'),
				);
			
			$cat_id = $this->input->post('cat_id');	
			if(!empty($cat_id)){
				if ($this->admin_modal->update('category', $insetData, 'cat_id', $this->input->post('cat_id'))) {
					if(!empty($this->input->post('cat_home'))){
						$upData = array(
							'cat_home' => 0,
						);
						$this->admin_modal->update('category', $upData, 'cat_id !=', $this->input->post('cat_id'));
					}
					redirect('admin/category/3');
				} else {
					redirect('admin/category/4');
				}
			}else{	
				if ($this->admin_modal->insert_data('category', $insetData)) {
					$cid =  $this->db->insert_id();
					if(!empty($this->input->post('cat_home'))){
						$upData = array(
							'cat_home' => 0,
						);
						$this->admin_modal->update('category', $upData, 'cat_id !=', $cid);
					}
					redirect('admin/category/8');
				} else {
					redirect('admin/category/4');
				}
			}
		}
	}
	
	
	function statuscategory(){ 
		if(empty($this->loggedin)){
			redirect('admin/login');
		}
		$status = $this->uri->segment(3);
		$cat_id = $this->uri->segment(4);
		$error_code = $this->uri->segment(5);
		$error_msg = '';

		// Prepare error message
        if (isset($error_code) && !empty($error_code)) {
			switch ($error_code) {
				case 1: $error_msg = "Category successfully updated.";
					break;
				case 2: $error_msg = "Something went wrong, please try again.";
					break;
				case 3: $error_msg = "Category successfully updated.";
					break;
				case 4: $error_msg = "Something went wrong, please try again.";
					break;
				case 5: $error_msg = "Category already exists, please try again.";
					break;
				case 6: $error_msg = "Status has been changed.";
					break;
				default: $error_msg = "";
			}
		}
		
		$data = $this->data;
		$this->load->vars($this->data);
		$data['category'] = $this->admin_modal->getCategories();
		if($status=='deactivate'){
			$chgstatus = 0;
		}else{
			$chgstatus = 1;
		}
		$this->admin_modal->changeStatus('category',"cat_id =$cat_id",array('cat_status'=> $chgstatus));
		$data['error_msg'] = $error_msg;
		redirect('admin/category/6');
	}
	
	function deleteCategory(){ 
		if(empty($this->loggedin)){
			redirect('admin/login');
		}
		$id = $this->uri->segment(3);
		$data = $this->data;
		$this->load->vars($this->data);
		$this->admin_modal->delete('category',"cat_id=$id");
		redirect('admin/category/7');
		
    }
	
	
	
	function products(){ 
	
		if(empty($this->loggedin)){
			redirect('admin/login');
		}
		$error_code = $this->uri->segment(3);
		$error_msg = '';

		// Prepare error message
        if (isset($error_code) && !empty($error_code)) {
			switch ($error_code) {
				case 1: $error_msg = "Category successfully updated.";
					break;
				case 2: $error_msg = "Something went wrong, please try again.";
					break;
				case 3: $error_msg = "Category successfully added.";
					break;
				case 4: $error_msg = "Something went wrong, please try again.";
					break;
				case 5: $error_msg = "Category already exists, please try again.";
					break;
				case 6: $error_msg = "Status has been changed.";
					break;
				case 7: $error_msg = "Record has been deleted.";
					break;
				
				default: $error_msg = "";
			}
		}
		$data = $this->data;
		$this->load->vars($this->data);
		$data['error_msg'] = $error_msg;
		$data['products'] = $this->admin_modal->getProducts();
		$this->load->view('admin/productlist', $data);
	}
	
	function addproduct(){ 
		if(empty($this->loggedin)){
			redirect('admin/login');
		}
		$error_code = $this->uri->segment(3);
		$error_msg = '';

		// Prepare error message
        if (isset($error_code) && !empty($error_code)) {
			switch ($error_code) {
				case 1: $error_msg = "Product successfully updated.";
					break;
				case 2: $error_msg = "Something went wrong, please try again.";
					break;
				case 3: $error_msg = "Product successfully added.";
					break;
				case 4: $error_msg = "Something went wrong, please try again.";
					break;
				case 5: $error_msg = "Product already exists, please try again.";
					break;
				case 6: $error_msg = "Status has been changed.";
					break;
				default: $error_msg = "";
			}
		}
		
		$data = $this->data;
		$this->load->vars($this->data);
		$data['category'] = $this->admin_modal->getCategories();
		$data['products'] = $this->admin_modal->getProducts();
		$data['catdata'] = '';
		$data['error_msg'] = $error_msg;
		$this->load->view('admin/addproduct', $data);
	}
	
	function editproduct(){ 
		if(empty($this->loggedin)){
			redirect('admin/login');
		}
		$p_id = $this->uri->segment(3);
		$error_code = $this->uri->segment(4);
		$error_msg = '';

		// Prepare error message
        if (isset($error_code) && !empty($error_code)) {
			switch ($error_code) {
				case 1: $error_msg = "Category successfully updated.";
					break;
				case 2: $error_msg = "Something went wrong, please try again.";
					break;
				case 3: $error_msg = "Category successfully updated.";
					break;
				case 4: $error_msg = "Something went wrong, please try again.";
					break;
				case 5: $error_msg = "Category already exists, please try again.";
					break;
				default: $error_msg = "";
			}
		}
		
		$data = $this->data;
		$this->load->vars($this->data);
		$data['category'] = $this->admin_modal->getCategories();
		$data['product'] = $this->admin_modal->getProducts();
		$data['pdata'] = $this->admin_modal->getProduct($p_id);
		$data['customdata'] = $this->admin_modal->getCustomFields($p_id);
		$data['error_msg'] = $error_msg;
		$this->load->view('admin/addproduct', $data);
	}
	
	
	function saveproduct(){ 
		if(empty($this->loggedin)){
			redirect('admin/login');
		}
		if (isset($_POST) && !empty($_POST) ) {
			$p_title =$this->input->post('p_title');
			$p_slug =$this->input->post('p_slug');
			$p_id =$this->input->post('p_id');
			
			if(empty($p_title)){
				redirect('admin/addcategory/1');
			}
			if(empty($p_slug)){
			 	redirect('admin/addcategory/2');
			}
			
			if(!empty($p_id)){
				$excat = $this->admin_modal->getProductbyName($this->input->post('p_title'));
				if(count($excat)>0){
					if($excat->p_id!=$this->input->post('p_id')){
						redirect('admin/addproduct/5');
					}
				}
				
			}else{
				if(count($this->admin_modal->getProductbyName($this->input->post('p_title')))>0){
					redirect('admin/addproduct/5');
				}
			}
			
			
				$insetData = array(
					'p_title' => $this->input->post('p_title'),
					'p_slug' => $this->input->post('p_slug'),
					'cat_id' => $this->input->post('cat_id'),
					'p_size' => $this->input->post('p_size'),
					'p_weight' => $this->input->post('p_weight'),
					'p_processor' => $this->input->post('p_processor'),
					'p_battery' => $this->input->post('p_battery'),
					'p_price' => $this->input->post('p_price'),
					
				);
			
				$pid = $this->input->post('p_id');
			if(!empty($p_id)){
				if ($this->admin_modal->update('products', $insetData, 'p_id', $this->input->post('p_id'))) {
					if(!empty($this->input->post('p_customlabel')) && !empty($this->input->post('p_customvalue'))){
						$this->admin_modal->delete('customfields',"p_id=$pid");
						for($i=0;$i<count($this->input->post('p_customlabel'));$i++){
							$insetCustomData = array(
								'p_id' => $pid,
								'c_label' => $_POST['p_customlabel'][$i],
								'c_value' => $_POST['p_customvalue'][$i],
								
							);
							$this->admin_modal->insert_data('customfields', $insetCustomData);
						}
					}
					
					if(basename($_FILES['p_image']['name']) != '')
						{
						$ext=strstr($_FILES['p_image']['name'],".");
						$dest="./assets/uploads/products/"."img-".$pid.$_FILES['p_image']['name'];
						$dest1="img-".$pid.$_FILES['p_image']['name'];
						if(move_uploaded_file($_FILES['p_image']['tmp_name'], $dest))
						{
							$this->db->query("update products set p_image='$dest1' where p_id=$pid");
						}else{
						echo "problem in copying image ,try again 2!";
						exit();	
						}
					}
					redirect('admin/addproduct/3');
				} else {
					redirect('admin/addproduct/4');
				}
			}else{	
				if ($this->admin_modal->insert_data('products', $insetData)) {
					 $pid =  $this->db->insert_id(); 
					
					
					if(!empty($this->input->post('p_customlabel')) && !empty($this->input->post('p_customvalue'))){
						for($i=0;$i<count($this->input->post('p_customlabel'));$i++){
							$insetCustomData = array(
								'p_id' => $pid,
								'c_label' => $_POST['p_customlabel'][$i],
								'c_value' => $_POST['p_customvalue'][$i],
								
							);
							$this->admin_modal->insert_data('customfields', $insetCustomData);
						}
					}
					
					if(basename($_FILES['p_image']['name']) != '')
						{ 
						$ext=strstr($_FILES['p_image']['name'],".");
						$dest="./assets/uploads/products/"."img-".$pid.$_FILES['p_image']['name'];
						$dest1="img-".$pid.$_FILES['p_image']['name'];
						if(move_uploaded_file($_FILES['p_image']['tmp_name'], $dest))
						{
							$this->db->query("update products set p_image='$dest1' where p_id=$pid");
						}else{
						echo "problem in copying image ,try again 2!";
						exit();	
						}
					}
					
					redirect('admin/addproduct/3');
				} else {
					redirect('admin/addproduct/4');
				}
			}
		}
	}
	
	
	function statusproduct(){ 
		if(empty($this->loggedin)){
			redirect('admin/login');
		}
		$status = $this->uri->segment(3);
		$p_id = $this->uri->segment(4);
		$error_code = $this->uri->segment(5);
		$error_msg = '';

		// Prepare error message
        if (isset($error_code) && !empty($error_code)) {
			switch ($error_code) {
				case 1: $error_msg = "Category successfully updated.";
					break;
				case 2: $error_msg = "Something went wrong, please try again.";
					break;
				case 3: $error_msg = "Category successfully updated.";
					break;
				case 4: $error_msg = "Something went wrong, please try again.";
					break;
				case 5: $error_msg = "Category already exists, please try again.";
					break;
				case 6: $error_msg = "Status has been changed.";
					break;
				case 7: $error_msg = "Record has been deleted.";
					break;
				default: $error_msg = "";
			}
		}
		
		$data = $this->data;
		$this->load->vars($this->data);
		$data['category'] = $this->admin_modal->getProducts();
		if($status=='deactivate'){
			$chgstatus = 0;
		}else{
			$chgstatus = 1;
		}
		$this->admin_modal->changeStatus('products',"p_id=$p_id",array('p_status'=> $chgstatus));
		//echo $this->db->last_query();exit;
		$data['error_msg'] = $error_msg;
		redirect('admin/products/6');
	}
	
	function deleteProduct(){ 
		if(empty($this->loggedin)){
			redirect('admin/login');
		}
		
		$id = $this->uri->segment(3);
		$data = $this->data;
		$this->load->vars($this->data);
		$this->admin_modal->delete('products',"p_id=$id");
		redirect('admin/products/7');
		
    }
	
	
	public function logout() {

        $this->session->sess_destroy();
        redirect('admin');
    }
	
	

}
