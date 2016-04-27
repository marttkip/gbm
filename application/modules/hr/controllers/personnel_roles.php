<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Personnel_roles extends admin 
{
	
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('admin/users_model');
		$this->load->model('personnel_roles_model');
		$this->load->model('admin/file_model');
		
		
		
	}
    
	/*
	*
	*	Default action is to show all the personnel_roles
	*
	*/
	public function index($order = 'personnel_role_name', $order_method = 'ASC') 
	{
		$where = 'personnel_role_id > 0';
		$table = 'personnel_role';
		//pagination
		$segment = 5;
		$this->load->library('pagination');
		$config['base_url'] = site_url().'admin/personnel_roles/'.$order.'/'.$order_method;
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
		
		$config['cur_tag_open'] = '<li class="active">';
		$config['cur_tag_close'] = '</li>';
		
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$this->pagination->initialize($config);
		
		$page = ($this->uri->segment($segment)) ? $this->uri->segment($segment) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->personnel_roles_model->get_all_personnel_roles($table, $where, $config["per_page"], $page, $order, $order_method);
		
		//change of order method 
		if($order_method == 'DESC')
		{
			$order_method = 'ASC';
		}
		
		else
		{
			$order_method = 'DESC';
		}
		
		$data['title'] = 'Personnel Roles';
		$v_data['title'] = $data['title'];
		
		$v_data['order'] = $order;
		$v_data['order_method'] = $order_method;
		$v_data['query'] = $query;
		$v_data['all_personnel_roles'] = $this->personnel_roles_model->all_personnel_roles();

		$v_data['page'] = $page;
		$data['content'] = $this->load->view('personnel_roles/all_personnel_roles', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Add a new personnel_role
	*
	*/
	public function add_personnel_role() 
	{
		
		
		$personnel_role_error = $this->session->userdata('personnel_role_error_message');
		
		//form validation rules
		$this->form_validation->set_rules('personnel_role_name', 'personnel_role name', 'required|is_unique[personnel_role.personnel_role_name]|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			
			if($this->personnel_roles_model->add_personnel_role())
			{
				$this->session->set_userdata('success_message', 'personnel_role added successfully');
				redirect('human-resource/personnel-roles');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add personnel_role. Please try again');
			}
			
		}
		
		//open the add new personnel_role
		
		$data['title'] = 'Add personnel role';
		$v_data['title'] = $data['title'];
		$data['content'] = $this->load->view('personnel_roles/add_personnel_role', $v_data, true);
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Edit an existing personnel_role
	*	@param int $personnel_role_id
	*
	*/
	public function edit_personnel_role($personnel_role_id) 
	{
		//select the personnel_role from the database
		$query = $this->personnel_roles_model->get_personnel_role($personnel_role_id);
		$slide_row = $query->row();
		$v_data['query'] = $query;
		
	
		
		$personnel_role_error = $this->session->userdata('personnel_role_error_message');
		
		//form validation rules
		$this->form_validation->set_rules('personnel_role_name', 'personnel role name', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			
			if($this->personnel_roles_model->update_personnel_role($personnel_role_id))
			{
				$this->session->set_userdata('success_message', 'personnel role updated successfully');
				redirect('human-resource/personnel-roles');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update personnel role. Please try again');
			}
			
		}
		
		//open the add new personnel_role
		$data['title'] = 'Edit personnel role';
		$v_data['title'] = $data['title'];
		
		if ($query->num_rows() > 0)
		{
			$v_data['personnel_role'] = $query->row();
			
			$data['content'] = $this->load->view('personnel_roles/edit_personnel_role', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'Personnel roles does not exist';
		}
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing personnel_role
	*	@param int $personnel_role_id
	*
	*/
	public function delete_personnel_role($personnel_role_id)
	{
		//delete personnel_role image
		$query = $this->personnel_roles_model->get_personnel_role($personnel_role_id);
		
		if ($query->num_rows() > 0)
		{
			$result = $query->result();
			
		}
		$this->personnel_roles_model->delete_personnel_role($personnel_role_id);
		$this->session->set_userdata('success_message', 'personnel_role has been deleted');
		redirect('human-resource/personnel-roles');
	}
    
	/*
	*
	*	Activate an existing personnel_role
	*	@param int $personnel_role_id
	*
	*/
	public function activate_personnel_role($personnel_role_id)
	{
		$this->personnel_roles_model->activate_personnel_role($personnel_role_id);
		$this->session->set_userdata('success_message', 'personnel_role activated successfully');
		redirect('human-resource/personnel-roles');
	}
    
	/*
	*
	*	Deactivate an existing personnel_role
	*	@param int $personnel_role_id
	*
	*/
	public function deactivate_personnel_role($personnel_role_id)
	{
		$this->personnel_roles_model->deactivate_personnel_role($personnel_role_id);
		$this->session->set_userdata('success_message', 'personnel_role disabled successfully');
		redirect('human-resource/personnel-roles');
	}
}
?>