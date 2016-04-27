<?php

class Community_groups_model extends CI_Model 
{	
	/*
	*	Retrieve all community_group
	*
	*/
	public function all_community_groups()
	{
		$this->db->where('community_group_status = 1');
		$this->db->order_by('community_group_name');
		$query = $this->db->get('community_group');
		
		return $query;
	}
	
	/*
	*	Retrieve all community_group
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_community_groups($table, $where, $per_page, $page, $order = 'community_group_name', $order_method = 'ASC')
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
	*	Add a new company
	*	@param string $image_name
	*
	*/
	public function add_community_group($project_area_id)
	{
		$data = array(
				'community_group_name'=>$this->input->post('community_group_name'),
				'community_group_contact_person_name'=>$this->input->post('community_group_contact_person_name'),
				'community_group_contact_person_phone1'=>$this->input->post('community_group_contact_person_phone1'),
				'bank_name'=>$this->input->post('bank_name'),
				'account_name'=>$this->input->post('account_name'),
				'account_number'=>$this->input->post('account_number'),
				'now_activities'=>$this->input->post('now_activities'),
				'later_activities'=>$this->input->post('later_activities'),
				'chief'=>$this->input->post('chief_name'),
				'sub_chief'=>$this->input->post('sub_chief_name'),
				'address'=>$this->input->post('address'),
				'location'=>$this->input->post('location'),
				'county'=>$this->input->post('county'),
				'mp'=>$this->input->post('mp'),
				'community_group_status'=>0,
				'created'=>date('Y-m-d H:i:s'),
				'created_by'=>$this->session->userdata('personnel_id'),
				'modified_by'=>$this->session->userdata('personnel_id'),
				'project_area_id'=> $project_area_id
			);
			
		if($this->db->insert('community_group', $data))
		{
			
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an existing company
	*	@param string $image_name
	*	@param int $company_id
	*
	*/
	public function update_community_group($company_id)
	{
		$data = array(
				'community_group_name'=>$this->input->post('community_group_name'),
				'community_group_contact_person_name'=>$this->input->post('community_group_contact_person_name'),
				'community_group_contact_person_phone1'=>$this->input->post('community_group_contact_person_phone1'),
				'community_group_contact_person_phone2'=>$this->input->post('community_group_contact_person_phone2'),
				'community_group_contact_person_email1'=>$this->input->post('community_group_contact_person_email1'),
				'community_group_contact_person_email2'=>$this->input->post('community_group_contact_person_email2'),
				'community_group_description'=>$this->input->post('community_group_description'),
				'community_group_status'=>$this->input->post('community_group_status'),
				'modified_by'=>$this->session->userdata('personnel_id')
			);
			
		$this->db->where('community_group_id', $company_id);
		if($this->db->update('community_group', $data))
		{
			
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	get a single company's details
	*	@param int $company_id
	*
	*/
	public function get_community_group($company_id)
	{
		//retrieve all users
		$this->db->from('community_group');
		$this->db->select('*');
		$this->db->where('community_group_id = '.$company_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Delete an existing company
	*	@param int $company_id
	*
	*/
	public function delete_community_group($company_id)
	{
		if($this->db->delete('community_group', array('community_group_id' => $company_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated company
	*	@param int $company_id
	*
	*/
	public function activate_community_group($company_id)
	{
		$data = array(
				'community_group_status' => 1
			);
		$this->db->where('community_group_id', $company_id);
		
		if($this->db->update('community_group', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an activated company
	*	@param int $company_id
	*
	*/
	public function deactivate_community_group($company_id)
	{
		$data = array(
				'community_group_status' => 0
			);
		$this->db->where('community_group_id', $company_id);
		
		if($this->db->update('community_group', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
}
?>