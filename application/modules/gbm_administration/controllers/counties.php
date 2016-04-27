<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Counties extends admin 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('counties_model');
		$this->load->model('admin/users_model');
		
		
	}
    
	/*
	*
	*	Default action is to show all the counties
	*
	*/
	public function index($order = 'county_name', $order_method = 'ASC') 
	{
		$where = 'counties.branch_code = \''.$this->session->userdata('branch_code').'\'';
		$table = 'counties';
		//pagination
		$segment = 5;
		$this->load->library('pagination');
		$config['base_url'] = site_url().'admin-administration/counties/'.$order.'/'.$order_method;
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
		$query = $this->counties_model->get_all_counties($table, $where, $config["per_page"], $page, $order, $order_method);
		
		//change of order method 
		if($order_method == 'DESC')
		{
			$order_method = 'ASC';
		}
		
		else
		{
			$order_method = 'DESC';
		}
		
		$data['title'] = 'counties';
		$v_data['title'] = $data['title'];
		
		$v_data['order'] = $order;
		$v_data['order_method'] = $order_method;
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$data['content'] = $this->load->view('counties/all_counties', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Add a new county
	*
	*/
	public function add_county() 
	{
		//form validation rules
		$this->form_validation->set_rules('county_name', 'county Name', 'required|xss_clean');
		$this->form_validation->set_rules('county_status', 'county Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->counties_model->add_county())
			{
				$this->session->set_userdata('success_message', 'county added successfully');
				redirect('gbm-administration/counties');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add county. Please try again');
			}
		}
		
		$data['title'] = 'Add county';
		$v_data['title'] = $data['title'];
		$data['content'] = $this->load->view('counties/add_county', $v_data, true);
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Edit an existing county
	*	@param int $county_id
	*
	*/
	public function edit_county($county_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('county_name', 'county Name', 'required|xss_clean');
		$this->form_validation->set_rules('county_status', 'county Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//update county
			if($this->counties_model->update_county($county_id))
			{
				$this->session->set_userdata('success_message', 'county updated successfully');
				redirect('gbm-administration/counties');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update county. Please try again');
			}
		}
		
		//open the add new county
		$data['title'] = 'Edit county';
		$v_data['title'] = $data['title'];
		
		//select the county from the database
		$query = $this->counties_model->get_county($county_id);
		
		$v_data['county'] = $query->result();
		
		$data['content'] = $this->load->view('counties/edit_county', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing county
	*	@param int $county_id
	*
	*/
	public function delete_county($county_id)
	{
		$this->counties_model->delete_county($county_id);
		$this->session->set_userdata('success_message', 'county has been deleted');
		
		redirect('gbm-administration/counties');
	}
    
	/*
	*
	*	Activate an existing county
	*	@param int $county_id
	*
	*/
	public function activate_county($county_id)
	{
		$this->counties_model->activate_county($county_id);
		$this->session->set_userdata('success_message', 'county activated successfully');
		
		redirect('gbm-administration/counties');
	}
    
	/*
	*
	*	Deactivate an existing county
	*	@param int $county_id
	*
	*/
	public function deactivate_county($county_id)
	{
		$this->counties_model->deactivate_county($county_id);
		$this->session->set_userdata('success_message', 'county disabled successfully');
		
		redirect('gbm-administration/counties');
	}
}
?>