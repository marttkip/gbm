<?php 
	$v_data['project_status_query'] = $project_status_query;
	//echo $this->load->view('inventory/search/search_orders', '' , TRUE); ?>
<?php
	$error = $this->session->userdata('error_message');
	$success = $this->session->userdata('success_message');
	$search_result ='';
	$search_result2  ='';
	if(!empty($error))
	{
		$search_result2 = '<div class="alert alert-danger">'.$error.'</div>';
		$this->session->unset_userdata('error_message');
	}
	
	if(!empty($success))
	{
		$search_result2 ='<div class="alert alert-success">'.$success.'</div>';
		$this->session->unset_userdata('success_message');
	}
			
	$search = $this->session->userdata('projects_search');
	
	if(!empty($search))
	{
		$search_result = '<a href="'.site_url().'inventory/close-orders-search" class="btn btn-danger">Close Search</a>';
	}


	$result = '<div class="padd">';	
	$result .= ''.$search_result2.'';
	$result .= '
			';
	
	//if users exist display them
	if ($query->num_rows() > 0)
	{
		$count = $page;
		
		$result .= 
		'
		<div class="row">
			<div class="col-md-12">
				<table class="example table-autosort:0 table-stripeclass:alternate table table-hover table-bordered " id="TABLE_2">
				  <thead>
					<tr>
					  <th >#</th>
					  <th class="table-sortable:default table-sortable" title="Click to sort">Date Created</th>
					  <th class="table-sortable:default table-sortable" title="Click to sort">Project Number</th>
					   <th class="table-sortable:default table-sortable" title="Click to sort">Project Start Date</th>
					   <th class="table-sortable:default table-sortable" title="Click to sort">Project End Date</th>
					  <th class="table-sortable:default table-sortable" title="Click to sort">Status</th>
					  <th colspan="2">Actions</th>
					</tr>
				  </thead>
				  <tbody>
				';
		
					//get all administrators
					// $personnel_query = $this->personnel_model->get_all_personnel();
					// var_dump($query->num_rows()); die();
					foreach ($query->result() as $row)
					{
						$project_id = $row->project_id;
						$project_number = $row->project_number;
						$project_status = $row->project_status_id;
						$project_instructions = $row->project_instructions;
						$project_status_name = $row->project_status_name;
						$created_by = $row->created_by;
						$created = $row->created;
						$modified_by = $row->modified_by;
						$last_modified = $row->last_modified;
						$project_approval_status = $row->project_approval_status;
						$project_start_date = $row->project_start_date;
						$project_end_date = $row->project_end_date;

						$total_price = 0;
						$total_items = 0;
						//creators & editors
						
						// if($personnel_query->num_rows() > 0)
						// {
						// 	$personnel_result = $personnel_query->result();
							
						// 	foreach($personnel_result as $adm)
						// 	{
						// 		$personnel_id2 = $adm->personnel_id;
								
						// 		if($created_by == $personnel_id2 ||  $modified_by == $personnel_id2 )
						// 		{
						// 			$created_by = $adm->personnel_fname;
						// 			break;
						// 		}
								
						// 		else
						// 		{
						// 			$created_by = '-';
						// 		}
						// 	}
						// }
						
						// else
						// {
						// 	$created_by = '-';
						// }
						$created_by = '-';
						
						$button = '';


						// $approval_levels = $this->projects_model->check_if_can_access($project_approval_status,$project_id); 
						
						// if($approval_levels == TRUE)
						// {	

							// $next_project_status = $project_approval_status+1;

							// $status_name = $this->projects_model->get_next_approval_status_name($next_project_status);
							// //pending order
							// if($project_approval_status == 0)
							// {
							// 	$status = '<span class="label label-info ">Wainting for '.$status_name.'</span>';
							// 	$button = '<td><a href="'.site_url().'vendor/cancel-order/'.$project_number.'" class="btn btn-danger btn-sm pull-right" onclick="return confirm(\'Do you really want to cancel this order '.$project_number.'?\');">Cancel</a></td>';
							// 	$button2 = '';
							// }
							// else if($project_approval_status == 1)
							// {
							// 	$status = '<span class="label label-info"> Waiting for '.$status_name.'</span>';
							// 	$button = '';
							// 	$button2 = '';
							// }
							// else if($project_approval_status == 2)
							// {
							// 	$status = '<span class="label label-info"> Waiting for '.$status_name.'</span>';
							// 	$button = '';
							// }
							// else if($project_approval_status == 3)
							// {
							// 	$status = '<span class="label label-info"> Waiting for '.$status_name.'</span>';
							// 	$button = '';
							// }
							// else if($project_approval_status == 4)
							// {
							// 	$status = '<span class="label label-info"> Waiting for '.$status_name.'</span>';
							// 	$button = '';
							// }
							// else if($project_approval_status == 5)
							// {
							// 	$status = '<span class="label label-info"> Waiting for '.$status_name.'</span>';
							// 	$button = '';
							// }
							// else if($project_approval_status == 6)
							// {
							// 	$status = '<span class="label label-danger">Waiting for '.$status_name.'</span>';
							// 	$button = '<a href="'.site_url().'vendor/cancel-order/'.$project_id.'" class="btn btn-danger  btn-sm" onclick="return confirm(\'Do you really want to cancel this order '.$project_number.'?\');">Cancel</a>';
							// 	$button2 = '';
							// }

							// just to mark for the next two stages
						
							$status = '<span class="label label-info"> Active </span>';
							$count++;
							$result .= 
							'
								<tr>
									<td>'.$count.'</td>
									<td>'.date('jS M Y H:i a',strtotime($created)).'</td>
									<td>'.$project_number.'</td>
									<td>'.$project_number.'</td>
									<td>'.date('jS M Y',strtotime($project_end_date)).'</td>
									<td>'.$status.'</td>
									<td><a href="'.site_url().'tree-planting/project-detail/'.$project_id.'/'.$project_number.'" class="btn btn-success  btn-sm fa fa-folder"> Detail</a></td>
									
									
								</tr> 
							';
						// }
					}
		
			$result .= 
			'
					  </tbody>
					</table>
				</div>
			</div>
			';
	}
	
	else
	{
		$result .= "There are no projects created";
	}
	$result .= '</div>';
	
?>

<section class="panel panel-featured panel-featured-info">
    <header class="panel-heading">
         <h2 class="panel-title pull-left"><?php echo $title;?></h2>
         <div class="widget-icons pull-right">
            	<a href="<?php echo base_url();?>tree-planting/add-project" class="btn btn-success btn-sm">Add Project</a>
          </div>
          <div class="clearfix"></div>
    </header>
    <div class="panel-body">
			<?php echo $result;?>
    </div>
</section>