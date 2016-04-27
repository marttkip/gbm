<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";
class Meeting extends admin
{ 
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('meeting_model');
		$this->load->model('admin/users_model');
	}
    
	/*
	*
	*	Default action is to show all the meeting
	*
	*/
	public function index($project_area_id) 
	{
		// get my approval roles

		$where = 'meeting.project_area_id ='.$project_area_id;
		$table = 'meeting';
		// var_dump($table); die();
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'tree-planting/meeting/'.$project_area_id;
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = 4;
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
		
		$page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->meeting_model->get_all_meeting($table, $where, $config["per_page"], $page);
		
		$v_data['query'] = $query;
		$v_data['page'] = $page;
		$v_data['project_area_id'] = $project_area_id;
		// $v_data['level_status'] = $this->meeting_model->meeting_level_status();
		$v_data['title'] = "All meeting";
		$data['content'] = $this->load->view('meeting/all_meeting', $v_data, true);
		
		$data['title'] = 'All meeting';
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Add a new meeting
	*
	*/
	public function add_meeting($project_area_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('meeting_date', 'Meeting Date', 'required|xss_clean');
		$this->form_validation->set_rules('activity_title', 'Activity Title', 'required|xss_clean');
		$this->form_validation->set_rules('meeting_description', 'Meeting Description', 'required|xss_clean');
		$this->form_validation->set_rules('grant_county', 'Grant County', 'required|xss_clean');
		$this->form_validation->set_rules('grant_name', 'Grant Name', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			// var_dump($_POST); die();
			if($this->meeting_model->add_meeting($project_area_id))
			{
				$this->session->set_userdata('success_message', 'Youhave successfully added a meeting');
			}
			else
			{
				$this->session->set_userdata('error_message', 'Could not update meeting. Please try again');
			}
			
		}
		else
		{
			$this->session->set_userdata('success_message', 'Sorry, Please enter a number in the field');
		}
		redirect('tree-planting/trainings/'.$project_area_id);
	}
    
	public function meeting_detail($meeting_id,$meeting_number)
	{
		$v_data['title'] = 'Add meeting Item to '.$meeting_number;
		$data['title'] =$v_data['title'] ;
		$data['content'] = $this->load->view('meeting/meeting_detail', $v_data, true);

		$this->load->view('admin/templates/general_page', $data);
	}
    public function add_meeting_item($meeting_id,$meeting_number)
    {

		$this->form_validation->set_rules('product_id', 'Product', 'required|xss_clean');
		$this->form_validation->set_rules('quantity', 'Quantity', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->meeting_model->add_meeting_item($meeting_id))
			{
				$this->session->set_userdata('success_message', 'meeting created successfully');
			}	
			else
			{
				$this->session->set_userdata('error_message', 'Something went wrong, please try again');
			}
		}
		else
		{

		}
		$v_data['title'] = 'Add meeting Item to '.$meeting_number;
		$v_data['meeting_status_query'] = $this->meeting_model->get_meeting_status();
		$v_data['products_query'] = $this->products_model->all_products();
		$v_data['meeting_number'] = $meeting_number;
		$v_data['meeting_id'] = $meeting_id;
		$v_data['meeting_item_query'] = $this->meeting_model->get_meeting_items($meeting_id);
		$v_data['meeting_suppliers'] = $this->meeting_model->get_meeting_suppliers($meeting_id);

		$v_data['suppliers_query'] = $this->suppliers_model->all_suppliers();
		$data['content'] = $this->load->view('meeting/meeting_item', $v_data, true);

		$this->load->view('admin/templates/general_page', $data);
    }


	/*
	*
	*	Edit an existing meeting
	*	@param int $meeting_id
	*
	*/
	public function edit_meeting($meeting_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('meeting_instructions', 'meeting Instructions', 'required|xss_clean');
		$this->form_validation->set_rules('user_id', 'Customer', 'required|xss_clean');
		$this->form_validation->set_rules('payment_method', 'Payment Method', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//update meeting
			if($this->meeting_model->update_meeting($meeting_id))
			{
				$this->session->set_userdata('success_message', 'meeting updated successfully');
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Could not update meeting. Please try again');
			}
		}
		
		//open the add new meeting
		$data['title'] = 'Edit meeting';
		
		//select the meeting from the database
		$query = $this->meeting_model->get_meeting($meeting_id);
		
		if ($query->num_rows() > 0)
		{
			$v_data['meeting'] = $query->row();
			$query = $this->products_model->all_products();
			$v_data['products'] = $query->result();#
			$v_data['payment_methods'] = $this->meeting_model->get_payment_methods();
			
			$data['content'] = $this->load->view('meeting/edit_meeting', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'meeting does not exist';
		}
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Cancel an meeting
	*	@param int $meeting_id
	*
	*/
	public function cancel_meeting($meeting_id)
	{
		$data = array(
					'meeting_status'=>3
				);
				
		$this->db->where('meeting_id = '.$meeting_id);
		$this->db->update('meeting', $data);
		
		redirect('all-meeting');
	}
    
	/*
	*
	*	Deactivate an meeting
	*	@param int $meeting_id
	*
	*/
	public function deactivate_training($project_area_id,$meeting_id)
	{
		$data = array(
					'meeting_status'=>0
				);
				
		$this->db->where('meeting_id = '.$meeting_id);
		$this->db->update('meeting', $data);
		$this->session->set_userdata('success_message', 'Successfully deactivated meeting');
		
		redirect('tree-planting/trainings/'.$project_area_id);
	}
	/*
	*
	*	Deactivate an meeting
	*	@param int $meeting_id
	*
	*/
	public function activate_training($project_area_id,$meeting_id)
	{
		$data = array(
					'meeting_status'=>1
				);
				
		$this->db->where('meeting_id = '.$meeting_id);
		$this->db->update('meeting', $data);
		
		$this->session->set_userdata('success_message', 'Successfully activate meeting');
		redirect('tree-planting/trainings/'.$project_area_id);
	}
	public function training_attendees($project_area_id,$meeting_id)
	{
		$where = 'attendees.attendee_delete = 0 AND meeting_attendees.meeting_id ='.$meeting_id.' AND attendees.attendee_id = meeting_attendees.attendee_id';
		$table = 'attendees,meeting_attendees';
		// var_dump($table); die();
		//pagination
		$this->load->library('pagination');
		$config['base_url'] = base_url().'tree-planting/meeting/'.$project_area_id.'/'.$meeting_id;
		$config['total_rows'] = $this->users_model->count_items($table, $where);
		$config['uri_segment'] = 5;
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
		
		$page = ($this->uri->segment(5)) ? $this->uri->segment(5) : 0;
        $data["links"] = $this->pagination->create_links();
		$query = $this->meeting_model->get_all_attendees($table, $where, $config["per_page"], $page);
		
		$v_data['meeting_attendees'] = $query;
		$v_data['page'] = $page;
		$v_data['project_area_id'] = $project_area_id;
		$v_data['meeting_id'] = $meeting_id;
		// $v_data['level_status'] = $this->meeting_model->meeting_level_status();
		$v_data['title'] = "All meeting attendees";
		$data['content'] = $this->load->view('attendees/all_attendees', $v_data, true);
		
		$data['title'] = 'All meeting attendees';
		
		$this->load->view('admin/templates/general_page', $data);

	}
	public function add_meeting_attendee($project_area_id,$meeting_id)
	{
		$this->form_validation->set_rules('attendee_name', 'Attndee Name', 'required|xss_clean');
		$this->form_validation->set_rules('attendee_national_id', 'National ID', 'required|xss_clean');
		$this->form_validation->set_rules('attendee_number', 'Phone Number', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			if($this->meeting_model->add_meeting_attendee($meeting_id))
			{
				$this->session->set_userdata('success_message', 'meeting created successfully');
			}	
			else
			{
				$this->session->set_userdata('error_message', 'Something went wrong, please try again');
			}
		}
		else
		{
			$this->session->set_userdata('error_message', 'Something went wrong, please try again');
		}
		redirect('training-attendees/'.$project_area_id.'/'.$meeting_id);
	}
}
?>