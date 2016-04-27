<?php

class Project_areas_model extends CI_Model 
{	
	/*
	*	Retrieve all project_areas
	*
	*/
	public function all_project_areas()
	{
		$this->db->where(array('project_area_status' => 1, 'branch_code' => $this->session->userdata('branch_code')));
		$this->db->order_by('project_area_name');
		$query = $this->db->get('project_areas');
		
		return $query;
	}
	
	/*
	*	Retrieve all project_areas
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_project_areas($table, $where, $per_page, $page, $order = 'project_area_name', $order_method = 'ASC')
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
	*	Add a new project_area
	*	@param string $image_name
	*
	*/
	public function add_project_area()
	{
		$data = array(
				'project_area_name'=>$this->input->post('project_area_name'),
				'project_area_status'=>$this->input->post('project_area_status'),
				'project_area_longitude'=>$this->input->post('project_area_longitude'),
				'project_area_latitude'=>$this->input->post('project_area_latitude'),
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('personnel_id'),
				'branch_code'=>$this->session->userdata('branch_code'),
				'modified_by'=>$this->session->userdata('personnel_id')
			);
			
		if($this->db->insert('project_areas', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing project_area
	*	@param string $image_name
	*	@param int $project_area_id
	*
	*/
	public function update_project_area($project_area_id)
	{
		$data = array(
				'project_area_name'=>$this->input->post('project_area_name'),
				'project_area_status'=>$this->input->post('project_area_status'),
				'project_area_longitude'=>$this->input->post('project_area_longitude'),
				'project_area_latitude'=>$this->input->post('project_area_latitude'),
				'branch_code'=>$this->session->userdata('branch_code'),
				'modified_by'=>$this->session->userdata('personnel_id')
			);
			
		$this->db->where('project_area_id', $project_area_id);
		if($this->db->update('project_areas', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single project_area's details
	*	@param int $project_area_id
	*
	*/
	public function get_project_area($project_area_id)
	{
		//retrieve all users
		$this->db->from('project_areas');
		$this->db->select('*');
		$this->db->where('project_area_id = '.$project_area_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing project_area
	*	@param int $project_area_id
	*
	*/
	public function delete_project_area($project_area_id)
	{
		if($this->db->delete('project_areas', array('project_area_id' => $project_area_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated project_area
	*	@param int $project_area_id
	*
	*/
	public function activate_project_area($project_area_id)
	{
		$data = array(
				'project_area_status' => 1
			);
		$this->db->where('project_area_id', $project_area_id);
		
		if($this->db->update('project_areas', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated project_area
	*	@param int $project_area_id
	*
	*/
	public function deactivate_project_area($project_area_id)
	{
		$data = array(
				'project_area_status' => 0
			);
		$this->db->where('project_area_id', $project_area_id);
		
		if($this->db->update('project_areas', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}



	/*
	*	Retrieve all project_areas
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_project_area_locations($table, $where, $per_page, $page, $order = 'project_area_name', $order_method = 'ASC')
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
	*	Add a new project_area
	*	@param string $image_name
	*
	*/
	public function add_area_location($project_area_id)
	{
		$data = array(
				'project_area_name'=>$this->input->post('project_area_name'),
				'project_area_status'=>$this->input->post('project_area_status'),
				'project_area_longitude'=>$this->input->post('project_area_longitude'),
				'project_area_latitude'=>$this->input->post('project_area_latitude'),
				'parent_project_area_id'=>$project_area_id,
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('personnel_id'),
				'branch_code'=>$this->session->userdata('branch_code'),
				'modified_by'=>$this->session->userdata('personnel_id')
			);
			
		if($this->db->insert('project_areas', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing project_area
	*	@param string $image_name
	*	@param int $project_area_id
	*
	*/
	public function update_project_area_location($project_area_id,$parent_project_area_id)
	{
		$data = array(
				'project_area_name'=>$this->input->post('project_area_name'),
				'project_area_status'=>$this->input->post('project_area_status'),
				'project_area_longitude'=>$this->input->post('project_area_longitude'),
				'project_area_latitude'=>$this->input->post('project_area_latitude'),
				'parent_project_area_id'=>$parent_project_area_id,
				'branch_code'=>$this->session->userdata('branch_code'),
				'modified_by'=>$this->session->userdata('personnel_id')
			);
			
		$this->db->where('project_area_id', $project_area_id);
		if($this->db->update('project_areas', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	/*
	*	Activate a deactivated project_area
	*	@param int $project_area_id
	*
	*/
	public function activate_area_location($project_area_id)
	{
		$data = array(
				'project_area_status' => 1
			);
		$this->db->where('project_area_id', $project_area_id);
		
		if($this->db->update('project_areas', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated project_area
	*	@param int $project_area_id
	*
	*/
	public function deactivate_area_location($project_area_id)
	{
		$data = array(
				'project_area_status' => 0
			);
		$this->db->where('project_area_id', $project_area_id);
		
		if($this->db->update('project_areas', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

}
?>