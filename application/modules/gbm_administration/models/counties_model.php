<?php

class Counties_model extends CI_Model 
{	
	/*
	*	Retrieve all counties
	*
	*/
	public function all_counties()
	{
		$this->db->where(array('county_status' => 1, 'branch_code' => $this->session->userdata('branch_code')));
		$this->db->order_by('county_name');
		$query = $this->db->get('counties');
		
		return $query;
	}
	
	/*
	*	Retrieve all counties
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_counties($table, $where, $per_page, $page, $order = 'county_name', $order_method = 'ASC')
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
	*	Add a new county
	*	@param string $image_name
	*
	*/
	public function add_county()
	{
		$data = array(
				'county_name'=>$this->input->post('county_name'),
				'county_status'=>$this->input->post('county_status'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('personnel_id'),
				'branch_code'=>$this->session->userdata('branch_code'),
				'modified_by'=>$this->session->userdata('personnel_id')
			);
			
		if($this->db->insert('counties', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing county
	*	@param string $image_name
	*	@param int $county_id
	*
	*/
	public function update_county($county_id)
	{
		$data = array(
				'county_name'=>$this->input->post('county_name'),
				'county_status'=>$this->input->post('county_status'),
				'branch_code'=>$this->session->userdata('branch_code'),
				'modified_by'=>$this->session->userdata('personnel_id')
			);
			
		$this->db->where('county_id', $county_id);
		if($this->db->update('counties', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single county's details
	*	@param int $county_id
	*
	*/
	public function get_county($county_id)
	{
		//retrieve all users
		$this->db->from('counties');
		$this->db->select('*');
		$this->db->where('county_id = '.$county_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing county
	*	@param int $county_id
	*
	*/
	public function delete_county($county_id)
	{
		if($this->db->delete('counties', array('county_id' => $county_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated county
	*	@param int $county_id
	*
	*/
	public function activate_county($county_id)
	{
		$data = array(
				'county_status' => 1
			);
		$this->db->where('county_id', $county_id);
		
		if($this->db->update('counties', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated county
	*	@param int $county_id
	*
	*/
	public function deactivate_county($county_id)
	{
		$data = array(
				'county_status' => 0
			);
		$this->db->where('county_id', $county_id);
		
		if($this->db->update('counties', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>