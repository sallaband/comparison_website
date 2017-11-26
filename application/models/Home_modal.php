<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_modal extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
    }

	
	
	function getCategories()
    {
		$credential = array('cat_id !=' => 0,'cat_status ' => 1);	
		 
         $query = $this->db->get_where('category', $credential);
		 return $query->result();
		 
		
	}
	
	function getHomeCategory()
    {
		$credential = array('cat_id !=' => 0,'cat_home ' => 1);	
		 
         $query = $this->db->get_where('category', $credential);
		 return $query->result();
		 
		
	}
	
	
	function getProducts($catid)
    {
		$credential = array('p_id !=' => 0,'p_status ' => 1,'cat_id =' => $catid);	
		 $this->db->order_by('p_price', 'ASC');
         $query = $this->db->get_where('products', $credential);
		 return $query->result();
		 
		
	}
	
	function getCustomFields($id)
    {
         $credential = array('p_id' => $id);
         $query = $this->db->get_where('customfields', $credential);
		 return $query->result();
		 
		
	}
	
	function getCustomLabels()
    {
         $query = $this->db->query('select c_label from customfields group by c_label');
		 return $query->result();
		 
		
	}
	
	

    
}