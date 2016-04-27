<?php

class Personnel_roles_model extends CI_Model 
{	
	/*
	*	Retrieve all personnel_roles
	*
	*/
	public function all_personnel_roles()
	{
		$this->db->where('personnel_role_status = 1');
		$query = $this->db->get('personnel_role');
		
		return $query;
	}
	/*
	*	Retrieve latest category
	*
	*/
	public function latest_category()
	{
		$this->db->limit(1);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('personnel_role');
		
		return $query;
	}
	/*
	*	Retrieve all parent personnel_roles
	*
	*/
	public function all_parent_personnel_roles()
	{
		$this->db->where('personnel_role_status = 1 AND category_parent = 0');
		$this->db->order_by('personnel_role_name', 'ASC');
		$query = $this->db->get('personnel_role');
		
		return $query;
	}
	/*
	*	Retrieve all children personnel_roles
	*
	*/
	public function all_child_personnel_roles()
	{
		$this->db->where('personnel_role_status = 1 AND category_parent > 0');
		$this->db->order_by('personnel_role_name', 'ASC');
		$query = $this->db->get('personnel_role');
		
		return $query;
	}
	
	/*
	*	Retrieve all personnel_roles
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_personnel_roles($table, $where, $per_page, $page, $order = 'personnel_role_name', $order_method = 'ASC')
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Add a new category
	*	@param string $image_name
	*
	*/
	public function add_personnel_role()
	{
		$data = array(
				'personnel_role_name'=>ucwords(strtolower($this->input->post('personnel_role_name')))
			);
			
		if($this->db->insert('personnel_role', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing category
	*	@param string $image_name
	*	@param int $category_id
	*
	*/
	public function update_personnel_role($personnel_role_id)
	{
		$data = array(
					'personnel_role_name'=>ucwords(strtolower($this->input->post('personnel_role_name')))
			);
			
		$this->db->where('personnel_role_id', $personnel_role_id);
		if($this->db->update('personnel_role', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single category's children
	*	@param int $category_id
	*
	*/
	public function get_sub_personnel_roles($category_id)
	{
		//retrieve all users
		$this->db->from('personnel_role');
		$this->db->select('*');
		$this->db->where('category_parent = '.$category_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	get a single category's details
	*	@param int $category_id
	*
	*/
	public function get_personnel_role($personnel_role_id)
	{
		//retrieve all users
		$this->db->from('personnel_role');
		$this->db->select('*');
		$this->db->where('personnel_role_id = '.$personnel_role_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing category
	*	@param int $category_id
	*
	*/
	public function delete_personnel_role($personnel_role_id)
	{
		if($this->db->delete('personnel_role', array('personnel_role_id' => $personnel_role_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated category
	*	@param int $category_id
	*
	*/
	public function activate_personnel_role($personnel_role_id)
	{
		$data = array(
				'personnel_role_status' => 1
			);
		$this->db->where('personnel_role_id', $personnel_role_id);
		
		if($this->db->update('personnel_role', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated category
	*	@param int $category_id
	*
	*/
	public function deactivate_personnel_role($personnel_role_id)
	{
		$data = array(
				'personnel_role_status' => 0
			);
		$this->db->where('personnel_role_id', $personnel_role_id);
		
		if($this->db->update('personnel_role', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>