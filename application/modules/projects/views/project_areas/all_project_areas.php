<?php
		
		$result = '';
		
		//if users exist display them
		if ($query->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
			<table class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th>#</th>
						<th><a href="'.site_url().'tree-planting/project_areas/project_area_name/'.$order_method.'/'.$page.'">Project Area</a></th>
						<th><a href="'.site_url().'tree-planting/project_areas/last_modified/'.$order_method.'/'.$page.'">Latitude</a></th>
						<th><a href="'.site_url().'tree-planting/project_areas/modified_by/'.$order_method.'/'.$page.'">Longitude</a></th>
						<th><a href="'.site_url().'tree-planting/project_areas/last_modified/'.$order_method.'/'.$page.'">Last modified</a></th>
						<th><a href="'.site_url().'tree-planting/project_areas/modified_by/'.$order_method.'/'.$page.'">Modified by</a></th>
						<th><a href="'.site_url().'tree-planting/project_areas/project_area_status/'.$order_method.'/'.$page.'">Status</a></th>
						<th colspan="5">Actions</th>
					</tr>
				</thead>
				
				<tbody>
			';
			
			//get all administrators
			$administrators = $this->personnel_model->retrieve_personnel();
			if ($administrators->num_rows() > 0)
			{
				$admins = $administrators->result();
			}
			
			else
			{
				$admins = NULL;
			}
			
			foreach ($query->result() as $row)
			{
				$project_area_id = $row->project_area_id;
				$project_area_name = $row->project_area_name;
				$project_area_status = $row->project_area_status;
				$project_area_latitude = $row->project_area_latitude;
				$project_area_longitude = $row->project_area_longitude;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				$last_modified = date('jS M Y H:i a',strtotime($row->last_modified));
				$created = date('jS M Y H:i a',strtotime($row->created));
				
				//create deactivated status display
				if($project_area_status == 0)
				{
					$status = '<span class="label label-default">Deactivated</span>';
					$button = '<a class="btn btn-info btn-sm" href="'.site_url().'tree-planting/activate-project-area/'.$project_area_id.'" onclick="return confirm(\'Do you want to activate '.$project_area_name.'?\');" title="Activate '.$project_area_name.'"><i class="fa fa-thumbs-up"></i></a>';
				}
				//create activated status display
				else if($project_area_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default btn-sm" href="'.site_url().'tree-planting/deactivate-project-area/'.$project_area_id.'" onclick="return confirm(\'Do you want to deactivate '.$project_area_name.'?\');" title="Deactivate '.$project_area_name.'"><i class="fa fa-thumbs-down"></i></a>';
				}
				
				//creators & editors
				if($admins != NULL)
				{
					foreach($admins as $adm)
					{
						$user_id = $adm->personnel_id;
						
						if($user_id == $created_by)
						{
							$created_by = $adm->personnel_fname;
						}
						
						if($user_id == $modified_by)
						{
							$modified_by = $adm->personnel_fname;
						}
					}
				}
				
				else
				{
				}
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$project_area_name.'</td>
						<td>'.$project_area_latitude.'</td>
						<td>'.$project_area_longitude.'</td>
						<td>'.$last_modified.'</td>
						<td>'.$modified_by.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'tree-planting/edit-project-area/'.$project_area_id.'" class="btn btn-sm btn-info" title="Edit '.$project_area_name.'">Project Areas</a></td>
						<td><a href="'.site_url().'tree-planting/edit-project-area/'.$project_area_id.'" class="btn btn-sm btn-success" title="Edit '.$project_area_name.'"><i class="fa fa-pencil"></i></a></td>
						<td><a href="'.site_url().'tree-planting/project-area-detail/'.$project_area_id.'" class="btn btn-sm btn-warning" title="View '.$project_area_name.'"><i class="fa fa-eye"></i></a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'tree-planting/delete-project-area/'.$project_area_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$project_area_name.'?\');" title="Delete '.$project_area_name.'"><i class="fa fa-trash"></i></a></td>
					</tr> 
				';
			}
			
			$result .= 
			'
						  </tbody>
						</table>
			';
		}
		
		else
		{
			$result .= "There are no project areas";
		}
?>

						<section class="panel">
							<header class="panel-heading">
								<h2 class="panel-title"><?php echo $title;?></h2>
								<a href="<?php echo site_url();?>tree-planting/add-project-area" class="btn btn-success btn-sm pull-right" style="margin-top:-25px;">Add Project Area</a>
							</header>
							<div class="panel-body">
                                <?php
								$error = $this->session->userdata('error_message');
								$success = $this->session->userdata('success_message');
								
								if(!empty($success))
								{
									echo '
										<div class="alert alert-success">'.$success.'</div>
									';
									$this->session->unset_userdata('success_message');
								}
								
								if(!empty($error))
								{
									echo '
										<div class="alert alert-danger">'.$error.'</div>
									';
									$this->session->unset_userdata('error_message');
								}
								?>
								<div class="table-responsive">
                                	
									<?php echo $result;?>
							
                                </div>
							</div>
                            
                            <div class="panel-foot">
                                
								<?php if(isset($links)){echo $links;}?>
                            
                                <div class="clearfix"></div> 
                            
                            </div>
						</section>