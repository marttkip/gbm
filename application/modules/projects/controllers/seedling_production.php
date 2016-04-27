<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Seedling_production extends admin {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('seedling_production_model');
		$this->load->model('admin/users_model');
	}
    
	

	public function index($project_area_id)
	{

			
		$where = 'community_group.community_group_id = community_group.community_group_id AND community_group.project_area_id = project_areas.project_area_id AND seedling_production.project_area_id = '.$project_area_id;
		$table = 'seedling_production,community_group,project_areas';
	
		$segment = 4;
		$community_group_members_search = $this->session->userdata('all_community_group_members_search');
		
		if(!empty($community_group_members_search))
		{
			$where .= $community_group_members_search;	
			
		}
		//pagination
		
		$this->load->library('pagination');
		$config['base_url'] = site_url().'tree-planting/seedling-production/'.$project_area_id;
		$config['total_rows'] = $this->seedling_production_model->count_items($table, $where);
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
		$query = $this->seedling_production_model->get_all_seedling_records($table, $where, $config["per_page"], $page);
		

		$community_group_order = 'community_group.community_group_name';
		$community_group_table = 'community_group';
		$community_group_where = 'community_group.community_group_status = 1 AND community_group.community_group_id NOT IN (SELECT community_group_id FROM seedling_production)';

		$community_group_query = $this->seedling_production_model->get_active_list($community_group_table, $community_group_where, $community_group_order);
		$rs8 = $community_group_query->result();
		$community_group_list = '';
		foreach ($rs8 as $community_group_rs) :
			$community_group_id = $community_group_rs->community_group_id;
			$community_group_name = $community_group_rs->community_group_name;

		    $community_group_list .="<option value='".$community_group_id."'>".$community_group_name."</option>";

		endforeach;

		$v_data['community_group_list'] = $community_group_list;

		
		$data['title'] = 'Seedling Production';

		$v_data['title'] = $data['title'];
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$v_data['project_area_id'] = $project_area_id;
		$data['content'] = $this->load->view('seedling_production/all_seedling_production', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}

	public function add_seedling_production($project_area_id)
	{
		//form validation rules
		$this->form_validation->set_rules('community_group_id', 'Community Group', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if community_group_member has valid login credentials
			if($this->seedling_production_model->add_seedling_production($project_area_id))
			{
				$this->session->unset_userdata('community_group_members_error_message');
				$this->session->set_userdata('success_message', 'Seedling production data has been successfully added');

				redirect('tree-planting/seedling-production/'.$project_area_id);
				
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Sorry something went wrong. Please try again');
				redirect('tree-planting/seedling-production/'.$project_area_id);
			}
		}
	}

	public function tally_sheet($seedling_production_id , $project_area_id)
	{

			
		$where = 'seedling_production_id = '.$seedling_production_id;
		$table = 'nursery_tally';
	
		$segment = 5;
	
		//pagination
		
		$this->load->library('pagination');
		$config['base_url'] = site_url().'tree-planting/seedling-tally/'.$seedling_production_id.'/'.$project_area_id;
		$config['total_rows'] = $this->seedling_production_model->count_items($table, $where);
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
		$query = $this->seedling_production_model->get_monthly_records($table, $where, $config["per_page"], $page);
		

		$community_group_order = 'community_group.community_group_name';
		$community_group_table = 'community_group,seedling_production';
		$community_group_where = 'community_group.community_group_status = 1 AND community_group.community_group_id = seedling_production.nursery_id';

		$community_group_query = $this->seedling_production_model->get_active_list($community_group_table, $community_group_where, $community_group_order);
		$rs8 = $community_group_query->result();


		$community_group_list = '';
		foreach ($rs8 as $community_group_rs) :
			$community_group_id = $community_group_rs->community_group_id;
			$community_group_name = $community_group_rs->community_group_name;

		    $community_group_list .="<option value='".$community_group_id."'>".$community_group_name."</option>";

		endforeach;

		$v_data['community_group_list'] = $community_group_list;



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


		$seedling_status_order = 'seedling_status.seedling_status_name';
		$seedling_status_table = 'seedling_status';
		$seedling_status_where = 'seedling_status.seedling_status_id > 0';

		$seedling_status_query = $this->seedling_production_model->get_active_list($seedling_status_table, $seedling_status_where, $seedling_status_order);
		$rs11 = $seedling_status_query->result();


		$seedling_status_list = '';
		foreach ($rs11 as $seedling_status_rs) :
			$seedling_status_id = $seedling_status_rs->seedling_status_id;
			$seedling_status_name = $seedling_status_rs->seedling_status_name;

		    $seedling_status_list .="<option value='".$seedling_status_id."'>".$seedling_status_name."</option>";

		endforeach;

		$v_data['seedling_status_list'] = $seedling_status_list;
		$v_data['seedling_status_rs'] = $rs11;

		
		$data['title'] = 'Nursery Tally Sheet';

		$v_data['title'] = $data['title'];
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$v_data['project_area_id'] = $project_area_id;
		$v_data['seedling_production_id'] = $seedling_production_id;
		$data['content'] = $this->load->view('seedling_production/tally_sheet', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}

	public function add_seedling_production_tally($seedling_production_id,$project_area_id)
	{
		//form validation rules
		$this->form_validation->set_rules('seedling_type_id', 'Seedling Type', 'required|xss_clean');
		$this->form_validation->set_rules('seedling_status_id', 'Seedling Status', 'required|xss_clean');
		$this->form_validation->set_rules('month_id', 'Month', 'required|xss_clean');
		$this->form_validation->set_rules('year', 'year', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			// var_dump($_POST); die();
			//check if community_group_member has valid login credentials
			if($this->seedling_production_model->add_seedling_production_tally($seedling_production_id))
			{
				$this->session->unset_userdata('community_group_members_error_message');
				$this->session->set_userdata('success_message', 'Seedling production data has been successfully added');

				redirect('tree-planting/seedling-tally/'.$seedling_production_id.'/'.$project_area_id);
				
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Sorry something went wrong. Please try again');
				redirect('tree-planting/seedling-tally/'.$seedling_production_id.'/'.$project_area_id);
			}
		}
	}

}