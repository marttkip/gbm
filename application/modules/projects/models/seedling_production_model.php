<?php

class Seedling_production_model extends CI_Model 
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
	
	//branch details
	
	public function get_branch_details()
	{
		$this->db->from('branch');
		$this->db->select('branch.*');
		$query = $this->db->get();
		
		return $query;
	}
	
	//tally details
	public function get_monthly_tally($seedling_product_id)
	{
		$this->db->from('seedling_production');
		$this->db->where('seedling_production_id = '.$seedling_product_id);
		$this->db->select('seedling_production.*');
		$query = $this->db->get();
		
		return $query;
	}
	
	//month
	public function get_selected_month($seedling_product_id)
	{
		$this->db->from('nursery_tally');
		$this->db->where('seedling_production_id = '.$seedling_product_id);
		$this->db->select('nursery_tally.*');
		$query = $this->db->get();
		
		return $query;
	}
	//nursery details
	public function get_nursery_details($nursery_id)
	{
		$this->db->from('nurseries');
		$this->db->where('nursery_id = '.$nursery_id);
		$this->db->select('nurseries.*');
		$query = $this->db->get();
		
		return $query;
	}
	/*
	*	Retrieve all community_group
	*
	*/
	public function all_community_groups()
	{
		$this->db->where('seedling_production_status = 1');
		$this->db->order_by('seedling_production.created','DESC');
		$query = $this->db->get('seedling_production');
		
		return $query;
	}
	
	/*
	*	Retrieve all community_group
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_all_seedling_records($table, $where, $per_page, $page, $order = 'community_group_name', $order_method = 'ASC')
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
	*	Retrieve all community_group
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_active_list($table, $where, $order, $order_method = 'ASC')
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$query = $this->db->get('');
		
		return $query;
	}
	public function add_seedling_production($project_area_id)
	{
		$arrayName = array(
			'project_area_id' => $project_area_id,
			'nursery_id' => $this->input->post('community_group_id'),
			'created' => date('Y-m-d'),
			'created_by' => $this->session->userdata('personnel_id')
			 );
		if($this->db->insert('seedling_production',$arrayName))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}

	}


	/*
	*	Retrieve all community_group
	*	@param string $table
	* 	@param string $where
	*
	*/
	public function get_monthly_records($table, $where, $per_page, $page, $order = 'month', $order_method = 'ASC')
	{
		//retrieve all users
		$this->db->from($table);
		$this->db->select('*');
		$this->db->where($where);
		$this->db->order_by($order, $order_method);
		$this->db->group_by('year,month');
		$query = $this->db->get('', $per_page, $page);
		
		return $query;
	}
	public function get_months_seedling_tally($month_id,$year,$production_id)
	{
		$where = 'nursery_tally_status = 1 AND month = "'.$month_id.'" AND year = '.$year.' AND seedling_production_id = '.$production_id;
		$this->db->where($where);
		$query = $this->db->get('nursery_tally');

		return $query;
	}

	public function add_seedling_production_tally($seedling_production_id)
	{
		$seedling_type_id = $this->input->post('seedling_type_id');
		$seedling_status_id = $this->input->post('seedling_status_id');
		$month_id = $this->input->post('month_id');
		$year = $this->input->post('year');
		$quantity = $this->input->post('quantity');
		$arrayName = array(
							'seedling_type_id' => $seedling_type_id, 
							'seedling_status_id' => $seedling_status_id,
							'seedling_production_id' => $seedling_production_id,
							'month' => $month_id,
							'year' => $year,
							'quantity' =>$quantity,
							'created' => date('Y-m-d'),
							'created_by' => $this->session->userdata('personnel_id')
						  );
		if($this->db->insert('nursery_tally',$arrayName))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}
}