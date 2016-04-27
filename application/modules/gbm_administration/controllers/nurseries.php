<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Nurseries extends admin 
{
	function __construct()
	{
		parent:: __construct();
		$this->load->model('nurseries_model');
		$this->load->model('admin/users_model');
		
		
	}
    
	/*
	*
	*	Default action is to show all the nurseries
	*
	*/
	public function index($order = 'nursery_name', $order_method = 'ASC') 
	{
		$where = 'nurseries.branch_code = \''.$this->session->userdata('branch_code').'\'';
		$table = 'nurseries';
		//pagination
		$segment = 5;
		$this->load->library('pagination');
		$config['base_url'] = site_url().'admin-administration/nurseries/'.$order.'/'.$order_method;
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
		$query = $this->nurseries_model->get_all_nurseries($table, $where, $config["per_page"], $page, $order, $order_method);
		
		//change of order method 
		if($order_method == 'DESC')
		{
			$order_method = 'ASC';
		}
		
		else
		{
			$order_method = 'DESC';
		}
		
		$data['title'] = 'nurseries';
		$v_data['title'] = $data['title'];
		
		$v_data['order'] = $order;
		$v_data['order_method'] = $order_method;
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$data['content'] = $this->load->view('nurseries/all_nurseries', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Add a new nursery
	*
	*/
	public function add_nursery() 
	{
		//form validation rules
		$this->form_validation->set_rules('nursery_name', 'nursery Name', 'required|xss_clean');
		$this->form_validation->set_rules('nursery_status', 'nursery Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->nurseries_model->add_nursery())
			{
				$this->session->set_userdata('success_message', 'nursery added successfully');
				redirect('gbm-administration/nurseries');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not add nursery. Please try again');
			}
		}
		
		$data['title'] = 'Add nursery';
		$v_data['title'] = $data['title'];
		$data['content'] = $this->load->view('nurseries/add_nursery', $v_data, true);
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Edit an existing nursery
	*	@param int $nursery_id
	*
	*/
	public function edit_nursery($nursery_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('nursery_name', 'nursery Name', 'required|xss_clean');
		$this->form_validation->set_rules('nursery_status', 'nursery Status', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//update nursery
			if($this->nurseries_model->update_nursery($nursery_id))
			{
				$this->session->set_userdata('success_message', 'nursery updated successfully');
				redirect('gbm-administration/nurseries');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update nursery. Please try again');
			}
		}
		
		//open the add new nursery
		$data['title'] = 'Edit nursery';
		$v_data['title'] = $data['title'];
		
		//select the nursery from the database
		$query = $this->nurseries_model->get_nursery($nursery_id);
		
		$v_data['nursery'] = $query->result();
		
		$data['content'] = $this->load->view('nurseries/edit_nursery', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing nursery
	*	@param int $nursery_id
	*
	*/
	public function delete_nursery($nursery_id)
	{
		$this->nurseries_model->delete_nursery($nursery_id);
		$this->session->set_userdata('success_message', 'nursery has been deleted');
		
		redirect('gbm-administration/nurseries');
	}
    
	/*
	*
	*	Activate an existing nursery
	*	@param int $nursery_id
	*
	*/
	public function activate_nursery($nursery_id)
	{
		$this->nurseries_model->activate_nursery($nursery_id);
		$this->session->set_userdata('success_message', 'nursery activated successfully');
		
		redirect('gbm-administration/nurseries');
	}
    
	/*
	*
	*	Deactivate an existing nursery
	*	@param int $nursery_id
	*
	*/
	public function deactivate_nursery($nursery_id)
	{
		$this->nurseries_model->deactivate_nursery($nursery_id);
		$this->session->set_userdata('success_message', 'nursery disabled successfully');
		
		redirect('gbm-administration/nurseries');
	}
}
?>