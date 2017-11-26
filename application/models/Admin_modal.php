<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Admin_modal extends CI_Model
{
    
    public function __construct()
    {
        parent::__construct();
    }

	public function admin_login($email, $password) {

		$pwd = md5($password);
		$this->db->where('user_id', $email);
		$this->db->where('user_pass', $pwd);
		$q = $this->db->get('admin');

		if ($q->num_rows() > 0) {
			$data = $q->result_object();
			$result = $data[0];
		} else {
			$result = false;
		}
		return $result;
	}
	
	
	
	public function insert_data($tablename, $insert_data) {
        if ($this->db->insert($tablename, $insert_data)) {
            $result = $this->db->insert_id();
        } else {
            $result = false;
        }
        return $result;
    }
	
	public function update($tablename, $update_data, $key, $value) {

        //$this->db->db_debug = FALSE;
        if( !empty($key) && !empty($value) )
        {
            $this->db->where($key, $value);
        }

        if ($this->db->update($tablename, $update_data)) {
            $result = TRUE;
        } else {
            $result = false;
        }
        return $result;
    }
	
	
	
	function getCategories()
    {
		$credential = array('cat_id !=' => 0);	
		 
         $query = $this->db->get_where('category', $credential);
		 return $query->result();
		 
		
	}
	
	function getCategory($id)
    {
         $credential = array('cat_id' => $id);
         $query = $this->db->get_where('category', $credential);
		 return $query->row();
		 
		
	}
	
	function changeStatus($table,$where,$data)
    {
         
		$this->db->where($where);
		$this->db->update($table,$data);
		
		 
		
	}
	
	function delete($table,$where)
    {
     	$this->db->where($where);
		$this->db->delete($table);
		
	}
	
	function getCategorybyName($name)
    {
         $credential = array('cat_name' => $name);
         $query = $this->db->get_where('category', $credential);
		 return $query->row();
		 
		
	}
	
	
	function getProducts()
    {
		$credential = array('p_id !=' => 0);	
		 
         $query = $this->db->get_where('products', $credential);
		 return $query->result();
		 
		
	}
	
	function getProduct($id)
    {
         $credential = array('p_id' => $id);
         $query = $this->db->get_where('products', $credential);
		 return $query->row();
		 
		
	}
	
	function getCustomFields($id)
    {
         $credential = array('p_id' => $id);
         $query = $this->db->get_where('customfields', $credential);
		 return $query->result();
		 
		
	}
	
	
	function getProductbyName($name)
    {
         $credential = array('p_title' => $name);
         $query = $this->db->get_where('products', $credential);
		 return $query->row();
		 
		
	}
	



    
}