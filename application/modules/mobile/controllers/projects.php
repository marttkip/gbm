<?php   

class Projects extends MX_Controller
{ 
	
	function __construct()
	{
		parent:: __construct();
		$this->load->model('projects_model');
	}
    
	/*
	*
	*	Default action is to show all the projects
	*
	*/
	public function index() 
	{
		$response = $this->projects_model->getregisteredlaboreres();
		echo json_encode($response);
	}

	public function submit_tenants($project_id)
	{
		$fname = $_POST['fname'];
		echo json_encode($fname);
	}
    
}
?>