<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";
class Ctn extends admin
{ 
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('ctn_model');
		$this->load->model('seedling_production_model');
		$this->load->model('meeting_model');
		$this->load->model('admin/users_model');
	}
    
	/*
	*
	*	Default action is to show all the projects
	*
	*/
	public function index($project_area_id) 
	{
		// get my approval roles

		// check for a central tree nursery
		$ctn_where = 'is_ctn = 1 AND project_area_id ='.$project_area_id;
		$ctn_table = 'community_group';

		$this->db->where($ctn_where);
		$ctn_query = $this->db->get($ctn_table);
		$v_data['ctn_query'] = $ctn_query;
		$v_data['project_area_id'] = $project_area_id;
		if($ctn_query->num_rows() > 0)
		{
			$community_group_order = 'community_group.community_group_name';
			$community_group_table = 'community_group,seedling_production';
			$community_group_where = 'community_group.community_group_status = 1 AND community_group.community_group_id = seedling_production.nursery_id AND community_group.community_group_id NOT IN (SELECT nursery_id FROM orders WHERE project_area_id = '.$project_area_id.')';

			$community_group_query = $this->seedling_production_model->get_active_list($community_group_table, $community_group_where, $community_group_order);
			$rs8 = $community_group_query->result();


			$community_group_list = '';
			foreach ($rs8 as $community_group_rs) :
				$community_group_id = $community_group_rs->community_group_id;
				$community_group_name = $community_group_rs->community_group_name;

			    $community_group_list .="<option value='".$community_group_id."'>".$community_group_name."</option>";

			endforeach;

			$v_data['community_group_list'] = $community_group_list;


			// get order made in this project
			$order_where = 'community_group.community_group_id = orders.nursery_id AND orders.project_area_id ='.$project_area_id;
			$order_table = 'orders,community_group';
			$order_by = 'community_group.community_group_id';
			$order_limit = 5;
			$orders_query = $this->ctn_model->get_from_tables($order_table,$order_where,$order_by,$order_limit);
			$v_data['orders_query'] = $orders_query;

		}
		
		$v_data['title'] = "CTN Detail";
		$data['content'] = $this->load->view('projects/ctn/ctn_detail', $v_data, true);
		
		$data['title'] = 'CTN Detail';
		
		$this->load->view('admin/templates/general_page', $data);
	}

	/*
	*
	*	Add a new project_area
	*
	*/
	public function add_ctn($project_area_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('ctn_name', 'Area Name', 'required|xss_clean');
		// $this->form_validation->set_rules('ctn_longitude', 'Longitude', 'required|xss_clean');
		// $this->form_validation->set_rules('ctn_latitude', 'Latitude', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->ctn_model->add_ctn($project_area_id))
			{
				$this->session->set_userdata('success_message', 'CTN added successfully');
				
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Sorry something went wrong. Please try again');
			}
		}
		redirect('tree-planting/ctn-detail/'.$project_area_id);
	}
	public function new_ctn_order($project_area_id,$ctn_id)
	{
		$this->form_validation->set_rules('community_group_id', '', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->ctn_model->add_ctn_order($project_area_id,$ctn_id))
			{
				$this->session->set_userdata('success_message', 'CTN added successfully');
			}			
			else
			{
				$this->session->set_userdata('error_message', 'Sorry something went wrong. Please try again');
			}
		}
		redirect('tree-planting/ctn-detail/'.$project_area_id);
	}
	public function ctn_orders($project_area_id,$ctn_id)
	{
		$where = 'community_group.community_group_id = orders.nursery_id AND orders.project_area_id  = '.$project_area_id;
		$table = 'orders,community_group';
		//pagination
		$segment = 5;
		$this->load->library('pagination');
		$config['base_url'] = site_url().'tree-planting/ctn-orders/'.$project_area_id.'/'.$ctn_id;
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = $segment;
		$config['per_page'] = 20;
		$config['num_links'] = 5;
		
		$config['full_tag_open'] = '<ul class="pagination pull-right">';
		$config['full_tag_close'] = '</ul>';
		
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		
		$config['next_tag_open'] = '<li>';
		$config['next_link'] = 'Next';
		$config['next_tag_close'] = '</span>';
		
		$config['prev_tag_open'] = '<li>';
		$config['prev_link'] = 'Prev';
		$config['prev_tag_close'] = '</li>';
		
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $v_data["links"] = $this->pagination->create_links();
		$query = $this->ctn_model->get_all_ctn_orders($table, $where, $config["per_page"], $page);
		
		//change of order method 

		$seedling_type_order = 'seedling_type.seedling_type_name';
		$seedling_type_table = 'seedling_type';
		$seedling_type_where = 'seedling_type.seedling_type_id > 0';

		$seedling_type_query = $this->seedling_production_model->get_active_list($seedling_type_table, $seedling_type_where, $seedling_type_order);
		$rs10 = $seedling_type_query->result();


		$seedling_type_list = '';
		foreach ($rs10 as $seedling_type_rs) :
			$seedling_type_id = $seedling_type_rs->seedling_type_id;
			$seedling_type_name = $seedling_type_rs->seedling_type_name;

		    $seedling_type_list .="<option value='".$seedling_type_id."'>".$seedling_type_name."</option>";

		endforeach;

		$v_data['seedling_type_list'] = $seedling_type_list;
		$v_data['seedling_type_rs'] = $rs10;


		$administrators = $this->personnel_model->retrieve_personnel();
		if ($administrators->num_rows() > 0)
		{
			$admins = $administrators->result();
			$personnel_list = '';
			foreach($admins as $adm)
			{
				$personnel_id = $adm->personnel_id;
				$personnel_fname = $adm->personnel_fname;
				$personnel_onames = $adm->personnel_onames;
				
				$personnel_list .="<option value='".$personnel_id."'>".$personnel_fname." ".$personnel_onames."</option>";
			}
		}
		
		else
		{
			$personnel_list = '';
		}
		$v_data['personnel_list'] = $personnel_list;

		$species_order = 'species.species_name';
		$species_table = 'species';
		$species_where = 'species.species_id > 0';

		$species_query = $this->seedling_production_model->get_active_list($species_table, $species_where, $species_order);
		$rs10 = $species_query->result();


		$species_list = '';
		foreach ($rs10 as $species_rs) :
			$species_id = $species_rs->species_id;
			$species_name = $species_rs->species_name;

		    $species_list .="<option value='".$species_id."'>".$species_name."</option>";

		endforeach;

		$v_data['species_list'] = $species_list;
		$v_data['species_rs'] = $rs10;
	
		
		$data['title'] = 'CTN Orders';
		$v_data['title'] = $data['title'];
		
		$v_data['parent_project_area_id'] = $project_area_id;
		$v_data['ctn_id'] = $ctn_id;
		$v_data['ctn_id'] = $ctn_id;
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$data['content'] = $this->load->view('ctn/all_ctn_orders', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}
	public function get_order_items($order_id)
	{
		$data = array('order_id'=>$order_id);
		$this->load->view('ctn/order_items',$data);
	}
	//print ctn orders
	public function print_ctn_recievable($order_id)
	{
		$this->db->select ('orders.*, community_group.*, order_receivables.*');
		$this->db->where('orders.order_id ='.$order_id.' AND order_receivables.order_id = orders.order_id AND orders.nursery_id = community_group.community_group_id');
		$this->db->from('orders, order_receivables, community_group');
		
		$ctn_order_details = $this->db->get();
		
		$data['ctn_order_details'] = $ctn_order_details;
		$data['branch_data'] = $this->meeting_model->get_branch_details();
		if($ctn_order_details->num_rows()>0)
		{
			$print_details = $ctn_order_details->result();
			
			foreach($print_details as $details)
			{
				$nursey_id = $details->community_group_id;
			}
		}
			//var_dump($nursey_id); die();
		$data['community_group_info'] = $this->seedling_production_model->get_community_info($nursey_id);
		$data['nursery_info'] = $this->seedling_production_model->get_nursery_details($nursey_id);
		
		$this->load->view('ctn/print_ctn',$data);
	}
	public function add_order_item($order_id,$project_area_id,$ctn_id)
	{
		

		$this->form_validation->set_rules('seedling_type_id', 'Seedling Type', 'required|xss_clean');
		$this->form_validation->set_rules('species_id', 'Species Id', 'required|xss_clean');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required|xss_clean');
		$this->form_validation->set_rules('price', 'Price', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			// var_dump($_POST); die();
			if($this->ctn_model->add_ctn_order_item($order_id))
			{
				$this->session->set_userdata('success_message', 'CTN added successfully');
			}			
			else
			{
				$this->session->set_userdata('error_message', 'Sorry something went wrong. Please try again');
			}
		}
		redirect('tree-planting/ctn-orders/'.$project_area_id.'/'.$ctn_id);

	}
	public function add_order_receivables($order_id,$project_area_id,$ctn_id)
	{
		

		$this->form_validation->set_rules('fruit_trees', 'Fruit Trees', 'required|xss_clean');
		$this->form_validation->set_rules('indegenous_trees', 'Indegenous Trees', 'required|xss_clean');
		$this->form_validation->set_rules('exotic_trees', 'Exotic Trees', 'required|xss_clean');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required|xss_clean');
		$this->form_validation->set_rules('personnel_id', 'Personnel id', 'required|xss_clean');
		$this->form_validation->set_rules('date_given', 'Date', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			// var_dump($_POST); die();
			if($this->ctn_model->add_order_receivables($order_id))
			{
				$this->session->set_userdata('success_message', 'Successfully');
			}			
			else
			{
				$this->session->set_userdata('error_message', 'Sorry something went wrong. Please try again');
			}
		}
		redirect('tree-planting/ctn-orders/'.$project_area_id.'/'.$ctn_id);

	}
}