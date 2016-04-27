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
						<th>Month</th>
						<th>S.RP</th>
						<th>S.NRP</th>
						<th>S.IPB</th>
						<th>Last modified</th>
						<th>Modified by</th>
						<th>Status</th>
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

				$nursery_tally_id = $row->nursery_tally_id;
				$monthNum = $row->month;
				$year = $row->year;
				$nursery_tally_status = $row->nursery_tally_status;
				$production_id = $row->seedling_production_id;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				$last_modified = date('jS M Y H:i a',strtotime($row->last_modified));
				$created = date('jS M Y H:i a',strtotime($row->created));
			
				$monthName = date("F", mktime(0, 0, 0, $monthNum, 10));


				// select all the values in the respective months
						

						$seedlings_rs = $this->seedling_production_model->get_months_seedling_tally($monthNum,$year,$production_id);
						if($seedlings_rs->num_rows() > 0)
						{	
							$ready = 0;
							$not_ready = 0;
							$bags = 0;
							foreach ($seedlings_rs->result() as $key_value) {
								# code...
								$other_id = $key_value->nursery_tally_id;
								$checked_id = $key_value->seedling_status_id;
								if($checked_id == 1)
								{
									$ready = $key_value->quantity;
								}
								else if($checked_id == 2)
								{
									$not_ready = $key_value->quantity;
								}

								else
								{
									$bags = $key_value->quantity;
								}

								


							}
						}

				
				
				
				//create deactivated status display
				if($nursery_tally_status == 0)
				{
					$status = '<span class="label label-default">Deactivated</span>';
					$button = '<a class="btn btn-info btn-sm" href="'.site_url().'gbm-administration/activate-county/'.$nursery_tally_id.'" onclick="return confirm(\'Do you want to activate '.$monthName.'?\');" title="Activate '.$monthName.'"><i class="fa fa-thumbs-up"></i></a>';
				}
				//create activated status display
				else if($nursery_tally_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default btn-sm" href="'.site_url().'gbm-administration/deactivate-county/'.$nursery_tally_id.'" onclick="return confirm(\'Do you want to deactivate '.$monthName.'?\');" title="Deactivate '.$monthName.'"><i class="fa fa-thumbs-down"></i></a>';
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
						<td>'.$monthName.'</td>
						<td>'.$ready.'</td>
						<td>'.$not_ready.'</td>
						<td>'.$bags.'</td>
						<td>'.$last_modified.'</td>
						<td>'.$modified_by.'</td>
						<td>'.$status.'</td>
						<td>
							<a  class="btn btn-sm btn-success" id="open_tenant_info'.$nursery_tally_id.'" onclick="get_tenant_info('.$nursery_tally_id.');" ><i class="fa fa-folder"></i> Production Detail</a>
							<a  class="btn btn-sm btn-warning" id="close_tenant_info'.$nursery_tally_id.'"  onclick="close_tenant_info('.$nursery_tally_id.')" style="display:none;"><i class="fa fa-folder-open"></i> Close Production Info</a>
						</td>
						<td><a href="'.site_url().'tree-planting/seedling-tally/'.$nursery_tally_id.'/'.$project_area_id.'" class="btn btn-sm btn-warning" ><i class="fa fa-eye"></i></a></td>
						<td>'.$button.'</td>

						<td><a href="'.site_url().'gbm-administration/delete-county/'.$nursery_tally_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$monthName.'?\');" title="Delete '.$monthName.'"><i class="fa fa-trash"></i></a></td>
						
					</tr> 
				';
				$v_data['nursery_tally_id'] = $nursery_tally_id;
				$result .= '<tr id="tenant_info'.$nursery_tally_id.'" style="display:none;">
								<td colspan="12">
									'.$this->load->view("production_detail", $v_data, TRUE).'
								</td>
							</tr>';
			}
			
			$result .= 
			'
						  </tbody>
						</table>
			';
		}
		
		else
		{
			$result .= "There are no seedling productions added";
		}
?>

<section class="panel">
	<header class="panel-heading">
		<h2 class="panel-title"><?php echo $title;?></h2>
		<a href="<?php echo site_url();?>tree-planting/seedling-production/<?php echo $seedling_production_id;?>" class="btn btn-default btn-sm pull-right" style="margin-top:-25px;">Back to Seedling Production</a>
		<a  class="btn btn-sm btn-success pull-right" id="open_new_community_group_member" onclick="get_new_community_group_member();" style="margin-top:-25px;margin-right:5px;">Add seedling tally</a>
		<a  class="btn btn-sm btn-warning pull-right" id="close_new_community_group_member" style="display:none; margin-top:-25px;margin-right:5px;" onclick="close_new_community_group_member();">Close seedling tally</a>
	</header>
	<div class="panel-body">
		 <div style="display:none;" class="col-md-12" style="margin-bottom:20px;" id="new_community_group_member" >
        	<section class="panel">
				<header class="panel-heading">
					<div class="panel-actions">
					</div>
					<h2 class="panel-title">Add a seedling production area</h2>
				</header>
				<div class="panel-body">
					<div class="row" style="margin-bottom:20px;">
            			<div class="col-lg-12 col-sm-12 col-md-12">
            				<div class="row">
            				<?php 
            						echo form_open("tree-planting/add-tally-numbers/".$seedling_production_id."/".$project_area_id."", array("class" => "form-horizontal", "role" => "form"));
            					
            				?>
                				<div class="col-md-12">
                					<div class="row">
                    						<div class="col-md-6">
	                        					<div class="form-group">
										            <label class="col-lg-3 control-label">Month </label>
										            
										            <div class="col-lg-7">
										            	<select id='month_id' name='month_id' class='form-control custom-select ' required>
										            	<?php
										            	$month_id = date('m');
										            	$month_name = date('M', $month_id);
										            	?>
							                             <option value="01">January</option>
							                             <option value="02">February</option>
							                             <option value="03">March</option>
							                             <option value="04">April</option>
							                             <option value="05">May</option>
							                             <option value="06">June</option>
							                             <option value="07">July</option>
							                             <option value="08">August</option>
							                             <option value="09">September</option>
							                             <option value="10">October</option>
							                             <option value="11">November</option>
							                             <option value="12">December</option>
							                            </select>
										            </div>
										        </div>
										        <div class="form-group">
										            <label class="col-lg-3 control-label">Seedling Status </label>
										            
										            <div class="col-lg-7">
										            	<select id='seedling_status_id' name='seedling_status_id' class='form-control custom-select ' required>
							                             <?php echo $seedling_status_list?>
							                            </select>
										            </div>
										        </div>
										    </div>
										    <div class="col-md-6">
	                        					<div class="form-group">
										            <label class="col-lg-3 control-label">Year </label>
										            
										            <div class="col-lg-7">
										            	<select id='year' name='year' class='form-control custom-select ' required>
										            	<?php
										            	$year = date('Y');
										            	?>
										            	<option value="2014">2014</option>
										            	<option value="2016">2015</option>
							                            <option value='<?php echo $year;?>' selected><?php echo $year;?></option>
							                            </select>
										            </div>
										        </div>
										         <div class="form-group">
										            <label class="col-lg-3 control-label">Seedling Type </label>
										            
										            <div class="col-lg-7">
										            	<select id='seedling_type_id' name='seedling_type_id' class='form-control custom-select ' required>
							                             <?php echo $seedling_type_list?>
							                            </select>
										            </div>
										        </div>
										    </div>
									</div>
										<br>
								    <div class="row" >
										<div class="col-md-12">
									        <div class="form-actions center-align">
									            <label class="col-lg-3 control-label">Seedling Quantity </label>
										            
								            <div class="col-lg-7">
								            	<input type="text" id='quantity' name='quantity' class='form-control' required>
								            </div>
									        </div>
									    </div>
									</div>
									<br>
								    <div class="row" >
										<div class="col-md-12">
									        <div class="form-actions center-align">
									            <button class="submit btn btn-primary" type="submit">
									                Add seedling area
									            </button>
									        </div>
									    </div>
									</div>
                				</div>
                				<?php echo form_close();?>
                				<!-- end of form -->
                			</div>

            				
            			</div>
            			
            		</div>
				</div>
			</section>
        </div>
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
<script type="text/javascript">
	$(function() {
	    $("#month_id").customselect();
	    $("#year").customselect();
	    $("#seedling_type_id").customselect();
	    $("#seedling_status_id").customselect();
	});
	$(document).ready(function(){
		$(function() {
			$("#month_id").customselect();
			$("#year").customselect();
	   		$("#seedling_type_id").customselect();
	    	$("#seedling_status_id").customselect();
		});
	});

	function get_new_community_group_member(){

		var myTarget2 = document.getElementById("new_community_group_member");
		var myTarget3 = document.getElementById("new_community_group_member_allocation");
		var button = document.getElementById("open_new_community_group_member");
		var button2 = document.getElementById("close_new_community_group_member");
		var myTarget4 = document.getElementById("new_tenant");

		myTarget2.style.display = '';
		button.style.display = 'none';
		button2.style.display = '';
		myTarget3.style.display = 'none';
		myTarget4.style.display = 'none';
		
	}
	function close_new_community_group_member(){

		var myTarget2 = document.getElementById("new_community_group_member");
		var button = document.getElementById("open_new_community_group_member");
		var button2 = document.getElementById("close_new_community_group_member");
		var myTarget3 = document.getElementById("new_community_group_member_allocation");
		var myTarget4 = document.getElementById("new_tenant");

		myTarget2.style.display = 'none';
		button.style.display = '';
		button2.style.display = 'none';
		myTarget3.style.display = 'none';
		myTarget4.style.display = 'none';
	}


	// community_group_member_info
	function get_tenant_info(nursery_tally_id){

		var myTarget2 = document.getElementById("tenant_info"+nursery_tally_id);
		var myTarget3 = document.getElementById("new_tenant_allocation");
		var myTarget4 = document.getElementById("new_tenant");
		var button4 = document.getElementById("open_tenant_info"+nursery_tally_id);
		var button5 = document.getElementById("close_tenant_info"+nursery_tally_id);

		myTarget2.style.display = '';
		button4.style.display = 'none';
		button5.style.display = '';
		myTarget3.style.display = 'none';
		myTarget4.style.display = 'none';
	}
	function close_tenant_info(nursery_tally_id){

		var myTarget2 = document.getElementById("tenant_info"+nursery_tally_id);
		var button4 = document.getElementById("open_tenant_info"+nursery_tally_id);
		var button5 = document.getElementById("close_tenant_info"+nursery_tally_id);
		var myTarget3 = document.getElementById("new_tenant_allocation");
		var myTarget4 = document.getElementById("new_tenant");

		myTarget2.style.display = 'none';
		button4.style.display = '';
		button5.style.display = 'none';
		myTarget3.style.display = 'none';
		myTarget4.style.display = 'none';
	}

  </script>