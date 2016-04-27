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
						<th><a href="'.site_url().'tree-planting/community-groups/community_group_name/'.$order_method.'/'.$page.'">Company name</a></th>
						<th><a href="'.site_url().'tree-planting/community-groups/community_group_contact_person_name/'.$order_method.'/'.$page.'">Contact person</a></th>
						<th><a href="'.site_url().'tree-planting/community-groups/community_group_contact_person_phone1/'.$order_method.'/'.$page.'">Primary phone</a></th>
						<th><a href="'.site_url().'tree-planting/community-groups/community_group_contact_person_email1/'.$order_method.'/'.$page.'">Primary email</a></th>
						<th><a href="'.site_url().'tree-planting/community-groups/last_modified/'.$order_method.'/'.$page.'">Last modified</a></th>
						<th><a href="'.site_url().'tree-planting/community-groups/modified_by/'.$order_method.'/'.$page.'">Modified by</a></th>
						<th><a href="'.site_url().'tree-planting/community-groups/company_status/'.$order_method.'/'.$page.'">Status</a></th>
						<th colspan="6">Actions</th>
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
				$community_group_id = $row->community_group_id;
				$community_group_name = $row->community_group_name;
				$community_group_contact_person_name = $row->community_group_contact_person_name;
				$community_group_contact_person_phone1 = $row->community_group_contact_person_phone1;
				$community_group_contact_person_phone2 = $row->community_group_contact_person_phone2;
				$community_group_contact_person_email1 = $row->community_group_contact_person_email1;
				$community_group_contact_person_email2 = $row->community_group_contact_person_email2;
				$community_group_description = $row->community_group_description;
				$community_group_status = $row->community_group_status;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				
				//create deactivated status display
				if($community_group_status == 0)
				{
					$status = '<span class="label label-default">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'tree-planting/activate-community-group/'.$community_group_id.'/'.$project_area_id.'" onclick="return confirm(\'Do you want to activate '.$community_group_name.'?\');" title="Activate '.$community_group_name.'"><i class="fa fa-thumbs-up"></i></a>';
				}
				//create activated status display
				else if($community_group_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'tree-planting/deactivate-community-group/'.$community_group_id.'/'.$project_area_id.'" onclick="return confirm(\'Do you want to deactivate '.$community_group_name.'?\');" title="Deactivate '.$community_group_name.'"><i class="fa fa-thumbs-down"></i></a>';
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
						<td>'.$community_group_name.'</td>
						<td>'.$community_group_contact_person_name.'</td>
						<td>'.$community_group_contact_person_phone1.'</td>
						<td>'.$community_group_contact_person_email1.'</td>
						<td>'.date('jS M Y H:i a',strtotime($row->last_modified)).'</td>
						<td>'.$modified_by.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'tree-planting/group-members/'.$community_group_id.'/'.$project_area_id.'" class="btn btn-sm btn-warning" title="Edit '.$community_group_name.'"><i class="fa fa-eye"></i></a></td>
						<td><a href="'.site_url().'tree-planting/edit-community-group/'.$community_group_id.'/'.$project_area_id.'" class="btn btn-sm btn-success" title="Edit '.$community_group_name.'"><i class="fa fa-pencil"></i></a></td>

						<td>'.$button.'</td>
						<td><a href="'.site_url().'tree-planting/delete-community-group/'.$community_group_id.'/'.$project_area_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$community_group_name.'?\');" title="Delete '.$community_group_name.'"><i class="fa fa-trash"></i></a></td>
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
			$result .= "There are no community groups";
		}
?>
<?php echo $this->load->view('projects/project_areas/project_area_header','',true);?>
<section class="panel">
	<header class="panel-heading">						
		<h2 class="panel-title"><?php echo $title;?></h2>
		<a href="<?php echo site_url();?>tree-planting/project-area-detail/<?php echo $project_area_id;?>" class="btn btn-default pull-right btn-sm" style="margin-top:-25px;">Back to Project Detail</a>
		<a href="<?php echo site_url();?>tree-planting/add-community-group/<?php echo $project_area_id;?>" class="btn btn-success pull-right btn-sm" style="margin-top:-25px; margin-right:5px;"> Add Community Group</a>

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
</section>