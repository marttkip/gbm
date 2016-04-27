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
						<th><a href="'.site_url().'hr/personnel_role/personnel_role_name/'.$order_method.'/'.$page.'">Branch name</a></th>
						<th><a href="'.site_url().'hr/personnel_role/personnel_role_status/'.$order_method.'/'.$page.'">Status</a></th>
						<th colspan="5">Actions</th>
					</tr>
				</thead>
				  <tbody>
				  
			';
			
			//get all administrators
		
			foreach ($query->result() as $row)
			{
				$personnel_role_id = $row->personnel_role_id;
				$personnel_role_name = $row->personnel_role_name;
				$personnel_role_status = $row->personnel_role_status;
				
				//create deactivated status display
				if($personnel_role_status == 0)
				{
					$status = '<span class="label label-warning">Deactivated</span>';
					$button = '<a class="btn btn-info btn-sm" href="'.site_url().'human-resource/activate-personnel-role/'.$personnel_role_id.'" onclick="return confirm(\'Do you want to activate '.$personnel_role_name.'?\');" title="Activate '.$personnel_role_name.'"><i class="fa fa-thumbs-up"></i> Activate </a>';
				}
				//create activated status display
				else if($personnel_role_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default btn-sm" href="'.site_url().'human-resource/deactivate-personnel-role/'.$personnel_role_id.'" onclick="return confirm(\'Do you want to deactivate '.$personnel_role_name.'?\');" title="Deactivate '.$personnel_role_name.'"><i class="fa fa-thumbs-down"></i> Deactivate</a>';
				}
				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$personnel_role_name.'</td>
						<td>'.$status.'</td>
						<td><a href="'.site_url().'human-resource/edit-personnel-role/'.$personnel_role_id.'" class="btn btn-sm btn-success" title="Edit '.$personnel_role_name.'"><i class="fa fa-pencil"></i> Edit Role</a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'human-resource/delete-personnel-role/'.$personnel_role_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$personnel_role_name.'?\');" title="Delete '.$personnel_role_name.'"><i class="fa fa-trash"></i></a></td>
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
			$result .= "There are no personnel roles";
		}
?>

<section class="panel">
	<header class="panel-heading">
	
		<h2 class="panel-title"><?php echo $title;?></h2>
		<a href="<?php echo site_url();?>human-resource/add-personnel-role" class="btn btn-success btn-sm pull-right" style="margin-top: -25px;">Add personnel role</a>

	</header>
	<div class="panel-body">
    	
		<div class="table-responsive">
        	
			<?php echo $result;?>
	
        </div>
	</div>
</section>