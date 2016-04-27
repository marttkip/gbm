<?php   if ( ! defined('BASEPATH')) exit('No direct script access allowed');

require_once "./application/modules/admin/controllers/admin.php";

class Group_members extends admin {
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('group_members_model');
	}
    
	

	public function index($community_group_id,$project_area_id)
	{

			
		$where = 'community_group_member.community_group_member_id > 0 AND community_group_member.community_group_id = community_group.community_group_id AND community_group_member.community_group_id = '.$community_group_id;
		$table = 'community_group_member,community_group';
	
		$segment = 5;
		$community_group_members_search = $this->session->userdata('all_community_group_members_search');
		
		if(!empty($community_group_members_search))
		{
			$where .= $community_group_members_search;	
			
		}
		//pagination
		
		$this->load->library('pagination');
		$config['base_url'] = site_url().'tree-planting/group-members/'.$community_group_id.'/'.$project_area_id;
		$config['total_rows'] = $this->group_members_model->count_items($table, $where);
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
		$query = $this->group_members_model->get_all_community_group_members($table, $where, $config["per_page"], $page);
		

		$member_type_order = 'tng_member_type.member_type_name';
		$member_type_table = 'tng_member_type';
		$member_type_where = 'tng_member_type.member_type_id > 0';

		$member_type_query = $this->group_members_model->get_community_group_member_list($member_type_table, $member_type_where, $member_type_order);
		$rs8 = $member_type_query->result();
		$member_type_list = '';
		foreach ($rs8 as $community_group_member_rs) :
			$member_type_id = $community_group_member_rs->member_type_id;
			$member_type_name = $community_group_member_rs->member_type_name;

		    $member_type_list .="<option value='".$member_type_id."'>".$member_type_name."</option>";

		endforeach;

		$v_data['member_type_list'] = $member_type_list;

		
			$data['title'] = 'All community group members';
			$v_data['title'] = $data['title'];
			
		
		$v_data['community_group_id'] = $community_group_id;
		$v_data['community_group_members'] = $query;
		$v_data['page'] = $page;
		$v_data['project_area_id'] = $project_area_id;
		$data['content'] = $this->load->view('community_group_members/all_community_group_members', $v_data, true);
		
		$this->load->view('admin/templates/general_page', $data);
	}

	public function search_community_group_members()
	{
		$community_group_member_name = $this->input->post('community_group_member_name');
		$community_group_member_phone_number = $this->input->post('community_group_member_phone_number');
		$community_group_member_national_id = $this->input->post('community_group_member_national_id');
		
		$search_title = 'Showing reports for: ';
		
		
		if(!empty($community_group_member_name))
		{
			$community_group_member_name = ' AND community_group_members.community_group_member_name LIKE \'%'.$community_group_member_name.'%\'';
		}
		else
		{
			$community_group_member_name = '';
		}

		if(!empty($community_group_member_phone_number))
		{
			$community_group_member_phone_number = ' AND community_group_members.community_group_member_phone_number LIKE \'%'.$community_group_member_phone_number.'%\'';
		}
		else
		{
			$community_group_member_phone_number = '';
		}

		if(!empty($community_group_member_national_id))
		{
			$community_group_member_national_id = ' AND community_group_members.community_group_member_national_id LIKE \'%'.$community_group_member_national_id.'%\'';
		}
		else
		{
			$community_group_member_national_id = '';
		}

		$search = $community_group_member_name.$community_group_member_national_id.$community_group_member_phone_number;

		$community_group_members_search = $this->session->userdata('all_community_group_members_search');
		
		
		$this->session->set_userdata('all_community_group_members_search', $search);
		$this->all_community_group_members();
	}
	public function close_community_group_members_search()
	{
		$this->session->unset_userdata('all_community_group_members_search');
		$this->session->unset_userdata('search_title');
		
		
		redirect('tree-planting/group-members');
	}
    
	/*
	*
	*	Add a new community_group_member page
	*
	*/
	public function add_group_member($community_group_id,$project_area_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('community_group_member_name', 'Community Group Member name', 'required|xss_clean|is_unique[community_group_member.community_group_member_name]');
		$this->form_validation->set_rules('community_group_member_national_id', 'National Id', 'required|xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if community_group_member has valid login credentials
			if($this->group_members_model->add_group_member($community_group_id))
			{
				$this->session->unset_userdata('community_group_members_error_message');
				$this->session->set_userdata('success_message', 'community group member has been successfully added');

				redirect('tree-planting/group-members/'.$community_group_id.'/'.$project_area_id);
				
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Sorry something went wrong. Please try again');
				redirect('tree-planting/group-members/'.$community_group_id.'/'.$project_area_id);
				

			}
		}
		
		//open the add new community_group_member page
	}
	
	/*
	*
	*	Edit an existing community_group_member page
	*	@param int $community_group_member_id
	*
	*/
	public function edit_group_member($community_group_member_id,$community_group_id,$project_area_id) 
	{
		//form validation rules
		$this->form_validation->set_rules('community_group_member_email', 'Email', 'xss_clean|exists[community_group_members.community_group_member_email]|valid_email');
		$this->form_validation->set_rules('community_group_member_name', 'community_group_member name', 'required|xss_clean');
		$this->form_validation->set_rules('community_group_member_phone_number', 'community_group_member Phone Number', 'required|xss_clean|exists[community_group_members.community_group_member_phone_number]');
		$this->form_validation->set_rules('community_group_member_national_id', 'National Id', 'xss_clean');
		
		//if form has been submitted
		if ($this->form_validation->run())
		{
			//check if community_group_member has valid login credentials
			if($this->group_members_model->edit_community_group_member($community_group_member_id))
			{
				$this->session->set_userdata('success_message', 'community_group_member edited successfully');
				
				
			}
			
			else
			{
				$this->session->set_userdata('error_message', 'Something went wrong. Please try again');
			}

			redirect('tree-planting/group-members/'.$community_group_id.'/'.$project_area_id);
		}
		
		//open the add new community_group_member page
		$data['title'] = 'Edit community group member';
		$v_data['title'] = $data['title'];
		$v_data['community_group_id'] = $community_group_id;
		
		//select the community_group_member from the database
		$query = $this->group_members_model->get_community_group_member($community_group_member_id);
		if ($query->num_rows() > 0)
		{
			$v_data['query'] = $query;
			$data['content'] = $this->load->view('community_group_members/edit_community_group_member', $v_data, true);
		}
		
		else
		{
			$data['content'] = 'Community Group Member does not exist';
		}
		
		$this->load->view('admin/templates/general_page', $data);
	}
    
	/*
	*
	*	Delete an existing community_group_member page
	*	@param int $community_group_member_id
	*
	*/
	public function delete_community_group_member($community_group_member_id,$community_group_id,$project_area_id) 
	{
		if($this->group_members_model->delete_community_group_member($community_group_member_id))
		{
			$this->session->set_userdata('success_message', 'Administrator has been deleted');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Administrator could not be deleted');
		}
		
		redirect('tree-planting/group-members/'.$community_group_id.'/'.$project_area_id);
	}
    
	/*
	*
	*	Activate an existing community_group_member page
	*	@param int $community_group_member_id
	*
	*/
	public function activate_group_member($community_group_member_id,$community_group_id,$project_area_id) 
	{
		if($this->group_members_model->activate_community_group_member($community_group_member_id))
		{
			$this->session->set_userdata('success_message', 'Administrator has been activated');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Administrator could not be activated');
		}
		
		redirect('tree-planting/group-members/'.$community_group_id.'/'.$project_area_id);
	}
    
	/*
	*
	*	Deactivate an existing community_group_member page
	*	@param int $community_group_member_id
	*
	*/
	public function deactivate_group_member($community_group_member_id,$community_group_id,$project_area_id) 
	{
		if($this->group_members_model->deactivate_community_group_member($community_group_member_id))
		{
			$this->session->set_userdata('success_message', 'Administrator has been disabled');
		}
		
		else
		{
			$this->session->set_userdata('error_message', 'Administrator could not be disabled');
		}
		
		redirect('tree-planting/group-members/'.$community_group_id.'/'.$project_area_id);
	}
	
}
?>