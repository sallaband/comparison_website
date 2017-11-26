<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct()
    {
		
        parent::__construct();
       

        $this->load->library('session');
		$this->load->model('home_modal');
        $this->data = array();
      
    }
	public function index()
	{
		$data['category'] = $this->home_modal->getCategories();
		$homecategory = $this->home_modal->getHomeCategory();
		$data['products'] = $this->home_modal->getProducts($homecategory[0]->cat_id);
		$data['alllabels'] = $this->home_modal->getCustomLabels();
		/*$data['customdata'] = $this->home_modal->getCustomFields($data['products'][0]->p_id);*/
		
		$this->load->view('home',$data);
	}
	
	public function products()
	{
		$catid = $this->uri->segment(3);
		$data['category'] = $this->home_modal->getCategories();
		$data['products'] = $this->home_modal->getProducts($catid);
		$data['alllabels'] = $this->home_modal->getCustomLabels();
		/*$data['customdata'] = $this->home_modal->getCustomFields($data['products'][0]->p_id);*/
		
		$this->load->view('home',$data);
	}
}
