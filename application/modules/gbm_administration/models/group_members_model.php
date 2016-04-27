<?php

class Group_members_model extends CI_Model 
{
	/*
	*	Count all items from a table
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function count_items($table, $where, $limit = NULL)
	{
		if($limit != NULL)
		{
			$this->db->limit($limit);
		}
		$this->db->from($table);
		$this->db->where($where);
		return $this->db->count_all_results();
	}
	
	/*
	*	Retrieve all community_group_member
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_community_group_members($table, $where, $per_page, $page, $order = 'community_group_member.community_group_name', $order_method = 'DESC')
	{
		//retrieve all community_group_member
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('community_group_member.community_group_member_name', $order_method);
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	/*
	*	Retrieve all administrators
	*
	*/
	public function get_active_community_group_member()
	{
		$this->db->from('personnel');
		$this->db->select('*');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve all front end community_group_member
	*
	*/
	public function get_all_front_end_community_group_member()
	{
		$this->db->from('community_group_member');
		$this->db->select('*');
		$this->db->where('community_group_level_id = 2');
		$query = $this->db->get();
		
		return $query;
	}
	

	public function get_all_countries()
	{
		//retrieve all community_group_member
		$query = $this->db->get('country');
		
		return $query;
	}
	
	/*
	*	Add a new community_group to the database
	*
	*/
	public function add_group_member($community_group_id)
	{
		$data = array(
				'community_group_member_name'=>ucwords(strtolower($this->input->post('community_group_member_name'))),
				'member_type_id'=>$this->input->post('member_type_id'),
				'community_group_member_national_id'=>$this->input->post('community_group_member_national_id'),
				'community_group_member_phone_number'=>$this->input->post('community_group_member_phone_number'),
				'created'=>date('Y-m-d H:i:s'),
				'community_group_member_status'=>1,
				'community_group_id'=>$community_group_id,
				'created_by'=>$this->session->userdata('personnel_id')
			);
			
		if($this->db->insert('community_group_member', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function add_community_group_to_unit($rental_unit_id)
	{
		$this->db->where('community_group_unit_status = 1 AND rental_unit_id = '.$rental_unit_id.'');
		$this->db->from('community_group_unit');
		$this->db->select('*');
		$query = $this->db->get();

		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$community_group_unit_id = $key->community_group_unit_id;
				$community_group_unit_status = $key->community_group_unit_status;
					// update the details the status to 1 
				$update_array = array('community_group_unit_status'=>0);
				$this->db->where('community_group_unit_id = '.$community_group_unit_id);
				$this->db->update('community_group_unit',$update_array);
			}
			$insert_array = array(
							'community_group_id'=>$this->input->post('community_group_id'),
							'rental_unit_id'=>$rental_unit_id,
							'created'=>date('Y-m-d'),
							'created_by'=>$this->session->userdata('personnel_id'),
							'community_group_unit_status'=>1,
							);
			$this->db->insert('community_group_unit',$insert_array);
			return TRUE;
		}
		else
		{
			// create the community_group unit number
			$insert_array = array(
							'community_group_id'=>$this->input->post('community_group_id'),
							'rental_unit_id'=>$rental_unit_id,
							'created'=>date('Y-m-d'),
							'created_by'=>$this->session->userdata('personnel_id'),
							'community_group_unit_status'=>1,
							);
			$this->db->insert('community_group_unit',$insert_array);
			$community_group_unit_id = $this->db->insert_id();

			return TRUE;
		}
	}
	public function create_community_group_number()
	{
		//select product code
		$this->db->where('branch_code = "'.$this->session->userdata('branch_code').'"');
		$this->db->from('community_group_member');
		$this->db->select('MAX(community_group_number) AS number');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$number =  $result[0]->number;
			$number++;//go to the next number
			if($number == 1){
				$number = "".$this->session->userdata('branch_code')."-000001";
			}
			
			if($number == 1)
			{
				$number = "".$this->session->userdata('branch_code')."-000001";
			}
			
		}
		else{//start generating receipt numbers
			$number = "".$this->session->userdata('branch_code')."-000001";
		}
		return $number;
	}
	
	/*
	*	Add a new front end community_group to the database
	*
	*/
	public function add_frontend_community_group()
	{
		$data = array(
				'community_group_name'=>ucwords(strtolower($this->input->post('community_group_name'))),
				'community_group_email'=>$this->input->post('community_group_email'),
				'community_group_national_id'=>$this->input->post('community_group_national_id'),
				'community_group_password'=>md5(123456),
				'community_group_phone_number'=>$this->input->post('community_group_phone_number'),
				'created'=>date('Y-m-d H:i:s'),
				'community_group_status'=>1,
				'created_by'=>$this->session->userdata('personnel_id'),
			);
			
		if($this->db->insert('community_group_member', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing community_group
	*	@param int $community_group_id
	*
	*/
	public function edit_community_group_member($community_group_member_id)
	{
		$data = array(
				'community_group_member_name'=>ucwords(strtolower($this->input->post('community_group_member_name'))),
				'community_group_member_email'=>$this->input->post('community_group_member_email'),
				'community_group_member_national_id'=>$this->input->post('community_group_member_national_id'),
				'community_group_member_phone_number'=>$this->input->post('community_group_member_phone_number'),
				'community_group_member_status'=>1,
				'modified_by'=>$this->session->userdata('personnel_id'),
			);
		
		
		$this->db->where('community_group_member_id', $community_group_member_id);
		
		if($this->db->update('community_group_member', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing community_group
	*	@param int $community_group_id
	*
	*/
	public function edit_frontend_community_group($community_group_id)
	{
		$data = array(
				'community_group_name'=>ucwords(strtolower($this->input->post('community_group_name'))),
				'other_names'=>ucwords(strtolower($this->input->post('last_name'))),
				'phone'=>$this->input->post('phone')
			);
		
		//check if community_group wants to update their password
		$pwd_update = $this->input->post('admin_community_group');
		if(!empty($pwd_update))
		{
			if($this->input->post('old_password') == md5($this->input->post('current_password')))
			{
				$data['password'] = md5($this->input->post('new_password'));
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'The current password entered does not match your password. Please try again');
			}
		}
		
		$this->db->where('community_group_id', $community_group_id);
		
		if($this->db->update('community_group_member', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Edit an existing community_group's password
	*	@param int $community_group_id
	*
	*/
	public function edit_password($community_group_id)
	{
		if($this->input->post('slug') == md5($this->input->post('current_password')))
		{
			if($this->input->post('new_password') == $this->input->post('confirm_password'))
			{
				$data['password'] = md5($this->input->post('new_password'));
		
				$this->db->where('community_group_id', $community_group_id);
				
				if($this->db->update('community_group_member', $data))
				{
					$return['result'] = TRUE;
				}
				else{
					$return['result'] = FALSE;
					$return['message'] = 'Oops something went wrong and your password could not be updated. Please try again';
				}
			}
			else{
					$return['result'] = FALSE;
					$return['message'] = 'New Password and Confirm Password don\'t match';
			}
		}
		
		else
		{
			$return['result'] = FALSE;
			$return['message'] = 'You current password is not correct. Please try again';
		}
		
		return $return;
	}
	
	/*
	*	Retrieve a single community_group
	*	@param int $community_group_id
	*
	*/
	public function get_community_group_member($community_group_member_id)
	{
		//retrieve all community_group_member
		$this->db->from('community_group_member');
		$this->db->select('*');
		$this->db->where('community_group_member_id = '.$community_group_member_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve a single community_group by their email
	*	@param int $email
	*
	*/
	public function get_community_group_by_email($email)
	{
		//retrieve all community_group_member
		$this->db->from('community_group_member');
		$this->db->select('*');
		$this->db->where('email = \''.$email.'\'');
		$query = $this->db->get();
		
		return $query;
	}

	
	
	/*
	*	Delete an existing community_group
	*	@param int $community_group_id
	*
	*/
	public function delete_community_group_member($community_group_id)
	{
		if($this->db->delete('community_group_member', array('community_group_id' => $community_group_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Activate a deactivated community_group
	*	@param int $community_group_id
	*
	*/
	public function activate_community_group_member($community_group_id)
	{
		$data = array(
				'community_group_member_status' => 1
			);
		$this->db->where('community_group_id', $community_group_id);
		
		if($this->db->update('community_group_member', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Deactivate an community_group_status community_group
	*	@param int $community_group_id
	*
	*/
	public function deactivate_community_group_member($community_group_id)
	{
		$data = array(
				'community_group_member_status' => 0
			);
		$this->db->where('community_group_id', $community_group_id);
		
		if($this->db->update('community_group_member', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Reset a community_group's password
	*	@param string $email
	*
	*/
	public function reset_password($email)
	{
		//reset password
		$result = md5(date("Y-m-d H:i:s"));
		$pwd2 = substr($result, 0, 6);
		$pwd = md5($pwd2);
		
		$data = array(
				'password' => $pwd
			);
		$this->db->where('email', $email);
		
		if($this->db->update('community_group_member', $data))
		{
			//email the password to the community_group
			$community_group_details = $this->community_group_member_model->get_community_group_by_email($email);
			
			$community_group = $community_group_details->row();
			$community_group_name = $community_group->community_group_name;
			
			//email data
			$receiver['email'] = $this->input->post('email');
			$sender['name'] = 'Fad Shoppe';
			$sender['email'] = 'info@fadshoppe.com';
			$message['subject'] = 'You requested a password change';
			$message['text'] = 'Hi '.$community_group_name.'. Your new password is '.$pwd;
			
			//send the community_group their new password
			if($this->email_model->send_mail($receiver, $sender, $message))
			{
				return TRUE;
			}
			
			else
			{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	
	public function create_web_name($field_name)
	{
		$web_name = str_replace(" ", "-", strtolower($field_name));
		
		return $web_name;
	}
	public function change_password()
	{
		
		$data = array(
				'personnel_password' => md5($this->input->post('new_password'))
			);
		$this->db->where('personnel_password = "'.md5($this->input->post('current_password')).'" AND personnel_id ='.$this->session->userdata('personnel_id'));
		
		if($this->db->update('personnel', $data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function get_tenancy_details($community_group_id,$rental_unit_id)
	{
		$this->db->from('community_group_unit');
		$this->db->select('*');
		$this->db->where('community_group_id = '.$community_group_id.' AND rental_unit_id ='.$rental_unit_id);
		$query = $this->db->get();
		
		return $query;
	}

	public function check_for_account($rental_unit_id)
	{

		$this->db->from('community_group_unit');
		$this->db->select('*');
		$this->db->where('community_group_unit_status = 1 AND rental_unit_id ='.$rental_unit_id);
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	public function get_community_group_member_list($table, $where, $order)
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by($order,'asc');
		$query = $this->db->get('');
		
		return $query;
	}
}
?>