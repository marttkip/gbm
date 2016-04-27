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
						<th><a href="'.site_url().'gbm-administration/counties/nursery_name/'.$order_method.'/'.$page.'">nursery</a></th>
						<th><a href="'.site_url().'gbm-administration/counties/last_modified/'.$order_method.'/'.$page.'">Last modified</a></th>
						<th><a href="'.site_url().'gbm-administration/counties/modified_by/'.$order_method.'/'.$page.'">Modified by</a></th>
						<th><a href="'.site_url().'gbm-administration/counties/nursery_status/'.$order_method.'/'.$page.'">Status</a></th>
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
				$nursery_id = $row->nursery_id;
				$nursery_name = $row->nursery_name;
				$nursery_status = $row->nursery_status;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				$last_modified = date('jS M Y H:i a',strtotime($row->last_modified));
				$created = date('jS M Y H:i a',strtotime($row->created));
				
				//create deactivated status display
				if($nursery_status == 0)
				{
					$status = '<span class="label label-default">Deactivated</span>';
					$button = '<a class="btn btn-info btn-sm" href="'.site_url().'gbm-administration/activate-nursery/'.$nursery_id.'" onclick="return confirm(\'Do you want to activate '.$nursery_name.'?\');" title="Activate '.$nursery_name.'"><i class="fa fa-thumbs-up"></i> Activate</a>';
				}
				//create activated status display
				else if($nursery_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default btn-sm" href="'.site_url().'gbm-administration/deactivate-nursery/'.$nursery_id.'" onclick="return confirm(\'Do you want to deactivate '.$nursery_name.'?\');" title="Deactivate '.$nursery_name.'"><i class="fa fa-thumbs-down"></i> Deactivate</a>';
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
						<td>'.$nursery_name.'</td>
						<td>'.$last_modified.'</td>
						<td>'.$modified_by.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'gbm-administration/edit-nursery/'.$nursery_id.'" class="btn btn-sm btn-info" title="Edit '.$nursery_name.'"><i class="fa fa-pencil"></i> Edit</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'gbm-administration/delete-nursery/'.$nursery_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$nursery_name.'?\');" title="Delete '.$nursery_name.'"><i class="fa fa-trash"></i> Delete</a></td>
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
			$result .= "There are no counties";
		}
?>

						<section class="panel">
							<header class="panel-heading">
								<h2 class="panel-title"><?php echo $title;?></h2>
								<a href="<?php echo site_url();?>gbm-administration/add-nursery" class="btn btn-success btn-sm pull-right" style="margin-top:-25px;">Add nursery</a>
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