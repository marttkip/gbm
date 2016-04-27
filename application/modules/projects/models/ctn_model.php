<?php

class Ctn_model extends CI_Model 
{
	
	
	/*
	*	Retrieve all meeting of a user
	*
	*/
	public function add_ctn($project_area_id)
	{
		$arrayName = array(
							'community_group_name' => $this->input->post('ctn_name'),
							'created' =>date('Y-m-d'),
							'created_by' => $this->session->userdata('personnel_id'),
							'is_ctn' => 1,
							'project_area_id' => $project_area_id
						  );
		if($this->db->insert('community_group',$arrayName))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
		
	}
	public function add_ctn_order($project_area_id,$ctn_id)
	{
		$arrayName = array(
							'order_status_id' => 1,
							'created' =>date('Y-m-d'),
							'created_by' => $this->session->userdata('personnel_id'),
							'ctn_id' => $ctn_id,
							'project_area_id' => $project_area_id,
							'nursery_id' => $this->input->post('community_group_id'),
							'order_number' => $this->create_order_number($project_area_id),

						  );
		if($this->db->insert('orders',$arrayName))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}
	public function create_order_number($project_area_id)
	{
		//select product code
		$this->db->where('project_area_id = '.$project_area_id);
		$this->db->from('orders');
		$this->db->select('MAX(order_number) AS number');
		$query = $this->db->get();
		if($query->num_rows() > 0)
		{
			$result = $query->result();
			$number =  $result[0]->number;
			$number++;//go to the next number
			if($number == 1){
				$number = "".$this->session->userdata('branch_code')."-".$project_area_id."-00001";
			}
			
			if($number == 1)
			{
				$number = "".$this->session->userdata('branch_code')."-".$project_area_id."-00001";
			}
			
		}
		else{//start generating receipt numbers
			$number = "".$this->session->userdata('branch_code')."-".$project_area_id."-00001";
		}
		return $number;
	}
	public function get_from_tables($table,$where,$order_by,$order_limit)
	{
		$this->db->where($where);
		$this->db->order_by($order_by,'DESC');
		$this->db->limit($order_limit);
		$query = $this->db->get($table);	

		return $query;
	}
	public function get_all_ctn_orders($table, $where, $per_page, $page)
	{
		//retrieve all meeting
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by('orders.order_number','DESC');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	public function get_order_items($order_id)
	{
		 $where = 'orders.order_id = order_item.order_id AND seedling_type.seedling_type_id = order_item.seedling_type_id AND species.species_id = order_item.species_id AND order_item.order_id ='.$order_id;

		$this->db->where($where);
		$query = $this->db->get('order_item,orders,species,seedling_type');

		return $query;
	}
	public function add_ctn_order_item($order_id)
	{
		$arrayName = array(
							'order_item_status' => 1,
							'order_id' => $order_id,
							'order_item_quantity' => $this->input->post('quantity'),
							'order_item_price' => $this->input->post('price'),
							'seedling_type_id' => $this->input->post('seedling_type_id'),
							'species_id' => $this->input->post('species_id'),
						  );
		if($this->db->insert('order_item',$arrayName))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}
	public function add_order_receivables($order_id)
	{
		$arrayName = array(
							'order_id' => $order_id,
							'quantity_given' => $this->input->post('quantity'),
							'fruit_trees' => $this->input->post('fruit_trees'),
							'indegenous_trees' => $this->input->post('indegenous_trees'),
							'exotic_trees' => $this->input->post('exotic_trees'),
							'date_given' => $this->input->post('date_given'),
							'personnel_id' => $this->input->post('personnel_id'),
							'created' => date('Y-m-d'),
							'created_by' => $this->session->userdata('personnel_id')
						  );
		if($this->db->insert('order_receivables',$arrayName))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}
}
?>