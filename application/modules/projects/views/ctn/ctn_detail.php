<?php
$result = '';
if($ctn_query->num_rows() == 1)
{
	$result .= 
	'
	<table class="table table-bordered mb-none">
		<thead>
			<tr>
				<th>#</th>
				<th>CTN Name</th>
				<th>Latitude</th>
				<th>Longitude</th>
				<th>In Stock</th>
				<th>Planted Seedlings</th>
				<th>Modified by</th>
			</tr>
		</thead>
		
		<tbody>
	';
	$administrators = $this->personnel_model->retrieve_personnel();
	if ($administrators->num_rows() > 0)
	{
		$admins = $administrators->result();
	}
	
	else
	{
		$admins = NULL;
	}
	foreach ($ctn_query->result() as $key) {
		# code...
		$community_group_id = $key->community_group_id;
		$ctn_name = $key->community_group_name;
		$modified_by = $key->modified_by;
		$created_by = $key->created_by;

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

		$result .= 
		'
			<tr>
				<td>1</td>
				<td>'.$ctn_name.'</td>
				<td>-</td>
				<td>-</td>
				<td>0</td>
				<td>0</td>
				<td>'.$modified_by.'</td>
			</tr>
		';


	}
	$result .= 
			'
						  </tbody>
						</table>
			';
	?>
	<div class="row " style="margin-top: 10px;">
			<div class="table-responsive">
				<?php echo $result;?>	
			</div>
	</div>
	

		<div class="row">
		<section class="panel">
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
				<div class="row">
					<div class="col-md-12">
					 <a href="<?php echo base_url();?>tree-planting/project-area-detail/<?php echo $project_area_id;?>" class="btn btn-info btn-sm pull-right">Back to Project Area Detail</a>
					</div>
				</div>
				 <div class="row">
				 	<div class="col-md-8">
				 		<section class="panel">
							<header class="panel-heading">
								<div class="pull-right">
									 <a href="<?php echo base_url();?>tree-planting/ctn-orders/<?php echo $project_area_id;?>/<?php echo $community_group_id?>" class="btn btn-warning btn-xs pull-right" style="margin-right:5px;"><i class="fa fa-eye"></i> View All</a>
								</div>
				
								<h2 class="panel-title">Transfers from Area Nurseries to CTN</h2>
							</header>
							<div class="panel-body">
								<div class="row">
									<?php echo form_open("tree-planting/ctn-new-order/".$project_area_id."/".$community_group_id."", array("class" => "form-horizontal", "role" => "form"));?>
							            <div class="row">
							            	<div class="col-sm-11">
								                <div class="col-sm-12">
								                    <div class="form-group center-align">
								                        <label class="col-lg-4 control-label">CTN Name</label>
								                        <div class="col-lg-8">
								                            <select id='community_group_id' name='community_group_id' class='form-control custom-select ' required>
								                              <option value=''>None - Please Select a Nursery</option>
								                              <?php echo $community_group_list;?>
								                            </select>
								                        </div>
								                    </div>

								                </div>
								            </div>
							            </div>
							             <br />
							            <div class="form-actions center-align">
							                <button class="submit btn btn-xs btn-primary" type="submit">
							                    Create a Order
							                </button>
							            </div>
							           
							        <?php echo form_close();?>
									
								</div>
								<br>
								<div class="table-responsive">
									<table class="table table-striped mb-none">
										<thead>
											<tr>
												<th>#</th>
												<th>Order Number</th>
												<th>Nursery Name</th>
												<th>T. Request Seedlings</th>
												<th>T. Delivered Seedlings</th>
											</tr>
										</thead>
										<tbody>
											<?php 
											if($orders_query->num_rows() > 0)
											{
												$q = 0;
												foreach ($orders_query->result() as $order_values) {
													# code...
													$nursery_name  = $order_values->community_group_name;
													$order_number  = $order_values->order_number;
													$total_ordered_seedlings  = 0;
													$total_received_seedlings  = 0;
													$q++;
													?>
													<tr>
														<td><?php echo $q;?></td>
														<td><?php echo $order_number;?></td>
														<td><?php echo $nursery_name;?></td>
														<td><?php echo $total_ordered_seedlings;?></td>
														<td><?php echo $total_received_seedlings;?></td>
													</tr>
													<?php
												}
											}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</section>
				 	</div>
				 </div>
			</div>
		</section>
		
	</div>

	
	<?php
}
else
{
	// create a ctn
	?>
		<section class="panel">
			  <header class="panel-heading">
		         <h2 class="panel-title pull-left"><?php echo $title;?></h2>
		         <div class="widget-icons pull-right">
		            	<a href="<?php echo base_url();?>tree-planting/project-area-detail/<?php echo $project_area_id;?>" class="btn btn-info btn-sm">Back to Project Area Detail</a>
		          </div>
		          <div class="clearfix"></div>
		    </header>
			
			<div class="panel-body">
				<div class="row">
					<?php echo form_open("tree-planting/add-ctn/".$project_area_id."", array("class" => "form-horizontal", "role" => "form"));?>
			            <div class="row">
			            	<div class="col-sm-11">
				                <div class="col-sm-12">
				                    <div class="form-group center-align">
				                        <label class="col-lg-4 control-label">CTN Name</label>
				                        <div class="col-lg-8">
				                            <input type="text" class="form-control" name="ctn_name" placeholder="Area name" value="" required>
				                        </div>
				                    </div>

				                </div>
				            </div>
			            </div>
			             <br />
			            <div class="form-actions center-align">
			                <button class="submit btn tbn-sm btn-primary" type="submit">
			                    Create CTN
			                </button>
			            </div>
			           
			        <?php echo form_close();?>
				</div>
				
			</div>
			
		</section>

	<?php
}
?>
<script type="text/javascript">
	$(function() {
	    $("#community_group_id").customselect();
	});
	$(document).ready(function(){
		$(function() {
			$("#community_group_id").customselect();
		});
	});
</script>