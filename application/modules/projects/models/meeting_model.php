<?php

class Meeting_model extends CI_Model 
{
	/*
	*	Retrieve all meeting
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_meeting($table, $where, $per_page, $page)
	{
		//retrieve all meeting
		$this->db->from($table);
		$this->db->select('meeting.*');
		$this->db->where($where);
		$this->db->order_by('created, meeting_number');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	
	//meeting attendees
	
	public function get_meeting_attendee($meeting_id)
	{
		$this->db->from('attendees,meeting_attendees');
		$this->db->select('attendees.*');
		$this->db->where('meeting_attendees.attendee_id = attendees.attendee_id AND meeting_attendees.meeting_id ='.$meeting_id);
		$query = $this->db->get();
		
		return $query;
	}
	
	//branch details
	public function get_branch_details()
	{
		$this->db->from('branch');
		$this->db->select('branch.*');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve all meeting of a user
	*
	*/
	public function get_user_meeting($user_id)
	{
		$this->db->where('user_id = '.$user_id);
		$this->db->order_by('created', 'DESC');
		$query = $this->db->get('meeting');
		
		return $query;
	}
	public function get_meeting_suppliers($meeting_id)
	{
		$this->db->where('supplier.supplier_id = supplier_meeting.supplier_id AND supplier_meeting.meeting_id = '.$meeting_id);
		$query = $this->db->get('supplier,supplier_meeting');
		
		return $query;
	}
	public function get_supplier_meeting_details($supplier_meeting_id)
	{
		$this->db->where('supplier.supplier_id = supplier_meeting.supplier_id AND meeting.meeting_id = supplier_meeting.meeting_id AND supplier_meeting.supplier_meeting_id = '.$supplier_meeting_id);
		$query = $this->db->get('supplier,supplier_meeting,meeting');
		
		return $query;
	}
	public function get_meeting_approval_status($meeting_id)
	{
		$this->db->select('meeting_approval_status');
		$this->db->where('meeting_id = '.$meeting_id);
		$query = $this->db->get('meeting');
		
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$meeting_approval_status = $key->meeting_approval_status;
			}
		}
		else
		{
			$meeting_approval_status = 0;
		}
		return $meeting_approval_status;
	}
	
	/*
	*	Retrieve an meeting
	*
	*/
	public function get_meeting($meeting_id)
	{
		$this->db->select('*');
		$this->db->where('meeting.meeting_status = meeting_status.meeting_status_id AND users.user_id = meeting.user_id AND meeting.meeting_id = '.$meeting_id);
		$query = $this->db->get('meeting, meeting_status, users');
		
		return $query;
	}
	/*
	*	Retrieve all meeting
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_meeting_status()
	{
		//retrieve all meeting
		$this->db->from('meeting_status');
		$this->db->select('*');
		$this->db->order_by('meeting_status_name');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Retrieve all meeting items of an meeting
	*
	*/
	public function get_meeting_items($meeting_id)
	{
		$this->db->select('product.product_name, meeting_item.*');
		$this->db->where('product.product_id = meeting_item.product_id AND meeting_item.meeting_id = '.$meeting_id);
		$query = $this->db->get('meeting_item, product');
		
		return $query;
	}
	
	/*
	*	Create meeting number
	*
	*/
	public function create_meeting_number()
	{
		//select product code
		$this->db->from('meeting');
		$this->db->where("meeting_number LIKE '".$this->session->userdata('branch_code')."".date('y')."-%'");
		$this->db->select('MAX(meeting_number) AS number');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$number =  $result[0]->number;
			$number++;//go to the next number
			
			if($number == 1){
				$number = "".$this->session->userdata('branch_code')."-M".date('y')."-001";
			}
		}
		else{//start generating receipt numbers
			$number = "".$this->session->userdata('branch_code')."-M".date('y')."-001";
		}
		
		return $number;
	}
	
	/*
	*	Create the total cost of an meeting
	*	@param int meeting_id
	*
	*/
	public function calculate_meeting_cost($meeting_id)
	{
		//select product code
		$this->db->from('meeting_item');
		$this->db->where('meeting_id = '.$meeting_id);
		$this->db->select('SUM(price * quantity) AS total_cost');
		$query = $this->db->get();
		
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$total_cost =  $result[0]->total_cost;
		}
		
		else
		{
			$total_cost = 0;
		}
		
		return $total_cost;
	}
	
	/*
	*	Add a new meeting
	*
	*/
	public function add_meeting($project_area_id)
	{
		$meeting_number = $this->create_meeting_number();
		
		$data = array(
				'meeting_number'=>$meeting_number,
				'created_by'=>$this->input->post('personnel_id'),
				'meeting_status'=>1,
				'project_area_id'=>$project_area_id,
				'meeting_description'=>$this->input->post('meeting_description'),
				'meeting_date'=>$this->input->post('meeting_date'),
				'activity_title'=>$this->input->post('activity_title'),
				'grant_name'=>$this->input->post('grant_name'),
				'grant_county'=>$this->input->post('grant_county'),
				'created'=>date('Y-m-d H:i:s'),
				'modified_by'=>$this->session->userdata('personnel_id')
			);
			
		if($this->db->insert('meeting', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}

	public function add_supplier_to_meeting($meeting_id)
	{
		$supplier_id = $this->input->post('supplier_id');

		$this->db->from('supplier_meeting');
		$this->db->where('meeting_id = '.$meeting_id.' AND supplier_id = '.$supplier_id);
		$this->db->select('*');
		$query = $this->db->get();

		if($query->num_rows() == 0)
		{

			$data = array(
					'meeting_id'=>$meeting_id,
					'supplier_id'=>$supplier_id,
					'created_by'=>$this->session->userdata('personnel_id'),
					'created'=>date('Y-m-d H:i:s'),
					'modified_by'=>$this->session->userdata('personnel_id')
				);
				
			if($this->db->insert('supplier_meeting', $data))
			{
				return $this->db->insert_id();
			}
			else{
				return FALSE;
			}
		}
		else
		{
			return FALSE;
		}
	}
	
	/*
	*	Update an meeting
	*	@param int $meeting_id
	*
	*/
	public function _update_meeting($meeting_id)
	{
		
		$data = array(
				'meeting_status'=>1,
				'meeting_description'=>$this->input->post('meeting_description'),
				'meeting_date'=>$this->input->post('meeting_date'),
				'activity_title'=>$this->input->post('activity_title'),
				'grant_name'=>$this->input->post('grant_name'),
				'grant_county'=>$this->input->post('grant_county'),
				'modified_by'=>$this->session->userdata('personnel_id')
			);
		
		$this->db->where('meeting_id', $meeting_id);
		if($this->db->update('meeting', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	/*
	*	Retrieve all meeting
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_payment_methods()
	{
		//retrieve all meeting
		$this->db->from('payment_method');
		$this->db->select('*');
		$this->db->order_by('payment_method_name');
		$query = $this->db->get();
		
		return $query;
	}
	
	/*
	*	Add a meeting product
	*
	*/
	public function add_meeting_item($meeting_id)
	{
		$product_id = $this->input->post('product_id');
		$quantity = $this->input->post('quantity');
		//Check if item exists
		$this->db->select('*');
		$this->db->where('product_id = '.$product_id.' AND meeting_id = '.$meeting_id);
		$query = $this->db->get('meeting_item');
		
		if($query->num_rows() > 0)
		{
			$result = $query->row();
			$qty = $result->quantity;
			
			$quantity += $qty;
			
			$data = array(
					'meeting_item_quantity'=>$quantity
				);
				
			$this->db->where('product_id = '.$product_id.' AND meeting_id = '.$meeting_id);
			if($this->db->update('meeting_item', $data))
			{
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
		
		else
		{
			$data = array(
					'meeting_id'=>$meeting_id,
					'product_id'=>$product_id,
					'meeting_item_quantity'=>$quantity
				);
				
			if($this->db->insert('meeting_item', $data))
			{
				return TRUE;
			}
			else{
				return FALSE;
			}
		}
	}
	public function update_meeting_item($meeting_id,$meeting_item_id)
	{
		$data = array(
					'meeting_item_quantity'=>$this->input->post('quantity')
				);
				
		$this->db->where('meeting_item_id = '.$meeting_item_id);
		if($this->db->update('meeting_item', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	public function update_meeting_item_price($meeting_id,$meeting_item_id)
	{
		$data = array(
					'supplier_unit_price'=>$this->input->post('unit_price')
				);
				
		$this->db->where('meeting_item_id = '.$meeting_item_id);
		if($this->db->update('meeting_item', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Update an meeting item
	*
	*/
	public function update_cart($meeting_item_id, $quantity)
	{
		$data = array(
					'quantity'=>$quantity
				);
				
		$this->db->where('meeting_item_id = '.$meeting_item_id);
		if($this->db->update('meeting_item', $data))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	
	/*
	*	Delete an existing meeting item
	*	@param int $product_id
	*
	*/
	public function delete_meeting_item($meeting_item_id)
	{
		if($this->db->delete('meeting_item', array('meeting_item_id' => $meeting_item_id)))
		{
			return TRUE;
		}
		else{
			return FALSE;
		}
	}
	public function get_next_approval_status_name($status)
	{
		$this->db->select('inventory_level_status_name');
		$this->db->where('inventory_level_status_id = '.$status);
		$query = $this->db->get('inventory_level_status');
		
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$inventory_level_status_name = $key->inventory_level_status_name;
			}
		}
		else
		{
			$inventory_level_status_name = 0;
		}
		return $inventory_level_status_name;	
	}
	public function check_assigned_next_approval($next_level_status)
	{
		$this->db->select('*');
		$this->db->where('approval_status_id = '.($next_level_status+1).' AND personnel_id = '.$this->session->userdata('personnel_id').'');
		$query = $this->db->get('personnel_approval');
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}	
	}
	public function check_if_can_access($meeting_approval_status,$meeting_id)
	{
		if($meeting_approval_status == 0)
		{
			$addition =' AND personnel_approval.approval_status_id = 1';
		}
		else
		{
			$addition = 'AND meeting_level_status.meeting_level_status_status = 1 AND personnel_approval.approval_status_id <= '.($meeting_approval_status+1);
		}
		$this->db->select('*');
		$this->db->where('meeting_level_status.meeting_id = '.$meeting_id.' '.$addition.'  AND personnel_approval.personnel_id = '.$this->session->userdata('personnel_id').'');
		$this->db->order_by('meeting_level_status.meeting_level_status_id','DESC');
		$this->db->limit(1);
		$query = $this->db->get('personnel_approval,meeting_level_status');
		
		if($query->num_rows() > 0)
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}
	public function get_rfq_authorising_personnel($meeting_id)
	{
		$this->db->select('*');
		$this->db->where('meeting_level_status.created_by = personnel.personnel_id AND job_title.job_title_id = personnel_job.job_title_id AND personnel.personnel_id = personnel_job.personnel_id AND meeting_level_status.meeting_level_status_status = 1 AND title.title_id = personnel.title_id AND meeting_level_status.personnel_meeting_approval_status = 2');
		$query = $this->db->get('personnel,meeting_level_status,title,personnel_job,job_title');
		
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$other_names = $key->personnel_onames;
				$first_name = $key->personnel_fname;
				$title_name = $key->title_name;
				$job_title_name = $key->job_title_name;

				$item = '<br>'.$title_name.' '.$first_name.' '.$other_names.' <br> '.$job_title_name.' <br> ';
			}

		}
		else
		{
			$item = '';
		}
		return $item;
	}
	public function update_meeting_status($meeting_id,$meeting_status)
	{
		$data = array(
					'meeting_approval_status'=>$meeting_status
				);
				
		$this->db->where('meeting_id = '.$meeting_id);
		if($this->db->update('meeting', $data))
		{
			$this->save_meeting_approval_status($meeting_id,$meeting_status);

			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
	public function save_meeting_approval_status($meeting_id,$meeting_status)
	{
		$insert_data = array(
					'meeting_id'=>$meeting_id,
					'personnel_meeting_approval_status'=>$meeting_status,
					'meeting_level_status_status'=>1,
					'created'=>date("Y-m-d H:i:s"),
					'created_by' => $this->session->userdata('personnel_id'),
					'modified_by' =>$this->session->userdata('personnel_id')
				);
		if($this->db->insert('meeting_level_status', $insert_data))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}


	}
	public function get_lpo_authorising_personnel($meeting_id)
	{
		$this->db->select('*');
		$this->db->where('meeting_level_status.created_by = personnel.personnel_id AND job_title.job_title_id = personnel_job.job_title_id AND personnel.personnel_id = personnel_job.personnel_id AND meeting_level_status.meeting_level_status_status = 1 AND title.title_id = personnel.title_id AND meeting_level_status.personnel_meeting_approval_status = 6');
		$query = $this->db->get('personnel,meeting_level_status,title,personnel_job,job_title');
		
		if($query->num_rows() > 0)
		{
			foreach ($query->result() as $key) {
				# code...
				$other_names = $key->personnel_onames;
				$first_name = $key->personnel_fname;
				$title_name = $key->title_name;
				$job_title_name = $key->job_title_name;

				$item = '<br>'.$title_name.' '.$first_name.' '.$other_names.' <br> '.$job_title_name.' <br> ';
			}

		}
		else
		{
			$item = '';
		}
		return $item;
	}

	/*
	*	Retrieve all meeting
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_attendees($table, $where, $per_page, $page)
	{
		//retrieve all meeting
		$this->db->from($table);
		$this->db->select('attendees.*');
		$this->db->where($where);
		$this->db->order_by('created','DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}

	public function add_meeting_attendee($meeting_id)
	{
		$array = array(
						'attendee_name' => $this->input->post('attendee_name'),
						'attendee_national_id' => $this->input->post('attendee_national_id'),
						'attendee_number'=>$this->input->post('attendee_number'),
						'created'=>date('Y-m-d'),
						'created_by'=>$this->session->userdata('personnel_id')
					   );
		if($this->db->insert('attendees',$array))
		{
			$insert_id = $this->db->insert_id();
			// submit the same to the meeting attendees 

			$array_two = array(
						'attendee_id' => $insert_id,
						'meeting_id' => $meeting_id
					   );

			if($this->db->insert('meeting_attendees',$array_two))
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
}