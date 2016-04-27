<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Project_areas extends admin 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('project_areas_model');
		$this->load->model('admin/users_model');
		
		
	}
    
	/*
	*
	*	Default action is to show all the project_areas
	*
	*/
	public function index($order = 'project_area_name', $order_method = 'ASC') 
	{
		$where = 'project_areas.parent_project_area_id = 0 AND project_areas.branch_code = \''.$this->session->userdata('branch_code').'\'';
		$table = 'project_areas';
		//pagination
		$segment = 5;
		$this->load->library('pagination');
		$config['base_url'] = site_url().'tree-planting/project-areas/'.$order.'/'.$order_method;
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
		$query = $this->project_areas_model->get_all_project_areas($table, $where, $config["per_page"], $page, $order, $order_method);
		
		//change of order method 
		if($order_method == 'DESC')
		{
			$order_method = 'ASC';
		}
		
		else
		{
			$order_method = 'DESC';
		}


		
		
		$data['title'] = 'Project Areas';
		$v_data['title'] = $data['title'];
		
		$v_data['order'] = $order;
		$v_data['order_method'] = $order_method;
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$data['content'] = $this->load->view('project_areas/all_project_areas', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Add a new project_area
	*
	*/
	public function add_project_area() 
	{
		//form validation rules
		$this->form_validation->set_rules('project_area_name', 'Area Name', 'required|xss_clean');
		$this->form_validation->set_rules('project_area_status', 'Area Status', 'required|xss_clean');

		$this->form_validation->set_rules('project_area_longitude', 'Longitude', 'required|xss_clean');
		$this->form_validation->set_rules('project_area_latitude', 'Latitude', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->project_areas_model->add_project_area())
			{
				$this->session->set_userdata('success_message', 'project_area added successfully');
				redirect('tree-planting/project-areas');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add project_area. Please try again');
			}
		}
		
		$data['title'] = 'Add Project Area';
		$v_data['title'] = $data['title'];
		$data['content'] = $this->load->view('project_areas/add_project_area', $v_data, true);
		$this->load->view('admin/templates/general_page', $data);
	}
	public function project_area_detail($project_area_id)
	{
		$v_data['title'] = 'Project Area ';
		$v_data['project_area_id'] = $project_area_id;

		$where = 'project_areas.parent_project_area_id  = '.$project_area_id;
		$table = 'project_areas';

		// count target areas
		$v_data['totol_areas'] = $this->users_model->count_items($table, $where);


		$meeting_where = 'meeting.project_area_id  = '.$project_area_id;
		$meeting_table = 'meeting';

		// count target areas
		$v_data['totol_meetings'] = $this->users_model->count_items($meeting_table, $meeting_where);


		$community_where = 'project_area_id  = '.$project_area_id;
		$community_table = 'community_group';

		// count target areas
		$v_data['totol_communities'] = $this->users_model->count_items($community_table, $community_where);
		// end of counting
		$data['title'] =$v_data['title'] ;
		$data['content'] = $this->load->view('project_areas/project_area_detail', $v_data, true);

		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Edit an existing project_area
	*	@param int $project_area_id
	*
	*/
	public function edit_project_area($project_area_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('project_area_name', 'Area Name', 'required|xss_clean');
		$this->form_validation->set_rules('project_area_status', 'Area Status', 'required|xss_clean');

		$this->form_validation->set_rules('project_area_longitude', 'Longitude', 'required|xss_clean');
		$this->form_validation->set_rules('project_area_latitude', 'Latitude', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//update project_area
			if($this->project_areas_model->update_project_area($project_area_id))
			{
				$this->session->set_userdata('success_message', 'project_area updated successfully');
				redirect('tree-planting/project-areas');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update project_area. Please try again');
			}
		}
		
		//open the add new project_area
		$data['title'] = 'Edit project area';
		$v_data['title'] = $data['title'];
		$v_data['project_area_id'] = $project_area_id;
		
		//select the project_area from the database
		$query = $this->project_areas_model->get_project_area($project_area_id);
		
		$v_data['project_area'] = $query->result();
		
		$data['content'] = $this->load->view('project_areas/edit_project_area', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing project_area
	*	@param int $project_area_id
	*
	*/
	public function delete_project_area($project_area_id)
	{
		$this->project_areas_model->delete_project_area($project_area_id);
		$this->session->set_userdata('success_message', 'project_area has been deleted');
		
		redirect('tree-planting/project-areas');
	}
    
	/*
	*
	*	Activate an existing project_area
	*	@param int $project_area_id
	*
	*/
	public function activate_project_area($project_area_id)
	{
		$this->project_areas_model->activate_project_area($project_area_id);
		$this->session->set_userdata('success_message', 'project_area activated successfully');
		
		redirect('tree-planting/project-areas');
	}
    
	/*
	*
	*	Deactivate an existing project_area
	*	@param int $project_area_id
	*
	*/
	public function deactivate_project_area($project_area_id)
	{
		$this->project_areas_model->deactivate_project_area($project_area_id);
		$this->session->set_userdata('success_message', 'project_area disabled successfully');
		
		redirect('tree-planting/project-areas');
	}




	// project area locations



	/*
	*
	*	Default action is to show all the project_area_locations
	*
	*/
	public function area_locations($project_area_id,$order = 'project_area_name', $order_method = 'ASC') 
	{
		$where = 'project_areas.parent_project_area_id  = '.$project_area_id;
		$table = 'project_areas';
		//pagination
		$segment = 6;
		$this->load->library('pagination');
		$config['base_url'] = site_url().'tree-planting/area-locations/'.$project_area_id.'/'.$order.'/'.$order_method;
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
		$query = $this->project_areas_model->get_all_project_area_locations($table, $where, $config["per_page"], $page, $order, $order_method);
		
		//change of order method 
		if($order_method == 'DESC')
		{
			$order_method = 'ASC';
		}
		
		else
		{
			$order_method = 'DESC';
		}
		
		$data['title'] = 'Target Areas';
		$v_data['title'] = $data['title'];
		
		$v_data['order'] = $order;
		$v_data['parent_project_area_id'] = $project_area_id;
		$v_data['order_method'] = $order_method;
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$data['content'] = $this->load->view('project_area_locations/all_project_area_locations', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Add a new project_area
	*
	*/
	public function add_area_location($parent_project_area_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('project_area_name', 'Area Name', 'required|xss_clean');
		$this->form_validation->set_rules('project_area_status', 'Area Status', 'required|xss_clean');

		$this->form_validation->set_rules('project_area_longitude', 'Longitude', 'required|xss_clean');
		$this->form_validation->set_rules('project_area_latitude', 'Latitude', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->project_areas_model->add_area_location($parent_project_area_id))
			{
				$this->session->set_userdata('success_message', 'Target Area Location added successfully');
				
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add project_area. Please try again');
			}
		}
		redirect('tree-planting/area-locations/'.$parent_project_area_id);
	}

    
	/*
	*
	*	Edit an existing project_area
	*	@param int $project_area_id
	*
	*/
	public function edit_project_area_location($project_area_id,$parent_project_area_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('project_area_name', 'Area Name', 'required|xss_clean');
		$this->form_validation->set_rules('project_area_status', 'Area Status', 'required|xss_clean');

		$this->form_validation->set_rules('project_area_longitude', 'Longitude', 'required|xss_clean');
		$this->form_validation->set_rules('project_area_latitude', 'Latitude', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//update project_area
			if($this->project_areas_model->update_project_area_location($project_area_id,$parent_project_area_id))
			{
				$this->session->set_userdata('success_message', 'project_area updated successfully');
				redirect('tree-planting/area-locations');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update project_area. Please try again');
			}
		}
		
		//open the add new project_area
		$data['title'] = 'Edit project area';
		$v_data['title'] = $data['title'];
		$v_data['project_area_id'] = $project_area_id;
		
		//select the project_area from the database
		$query = $this->project_areas_model->get_project_area_location($project_area_id);
		
		$v_data['project_area'] = $query->result();
		
		$data['content'] = $this->load->view('project_area_locations/edit_project_area_location', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing project_area
	*	@param int $project_area_id
	*
	*/
	public function delete_project_area_location($project_area_id)
	{
		$this->project_areas_model->delete_project_area_location($project_area_id);
		$this->session->set_userdata('success_message', 'project_area has been deleted');
		
		redirect('tree-planting/area-locations');
	}
    
	/*
	*
	*	Activate an existing project_area
	*	@param int $project_area_id
	*
	*/
	public function activate_area_location($parent_project_area_id,$project_area_id)
	{
		$this->project_areas_model->activate_area_location($project_area_id);
		$this->session->set_userdata('success_message', 'project_area activated successfully');
		
		redirect('tree-planting/area-locations/'.$parent_project_area_id);
	}
    
	/*
	*
	*	Deactivate an existing project_area
	*	@param int $project_area_id
	*
	*/
	public function deactivate_area_location($parent_project_area_id,$project_area_id)
	{
		$this->project_areas_model->deactivate_area_location($project_area_id);
		$this->session->set_userdata('success_message', 'project_area disabled successfully');
		
		redirect('tree-planting/area-locations/'.$parent_project_area_id);
	}
}
?>