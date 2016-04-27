
<?php 
//echo $this->load->view('search/community_group_members_search','', true);

 ?>

<?php	

		$result = '';
		$items = '';

		
		//if community_group_members exist display them
		if ($community_group_members->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
			<table class="table table-bordered table-striped table-condensed">
				<thead>
					<tr>
						<th>#</th>
						<th><a >Name</a></th>
						<th><a >National Id</a></th>
						<th><a >Phone Number</a></th>
						<th><a >Email Address</a></th>
						<th><a >Profile Status</a></th>
						'.$items.'
						<th colspan="5">Actions</th>
					</tr>
				</thead>
				  <tbody>
			';
			foreach ($community_group_members->result() as $row)
			{
				$community_group_member_id = $row->community_group_member_id;
				$community_group_member_name = $row->community_group_member_name;
				//create deactivated status display
				if($row->community_group_member_status == 0)
				{
					$status = '<span class="label label-warning">Deactivated</span>';
					$button = '<a class="btn btn-info" href="'.site_url().'tree-planting/activate-group-member/'.$community_group_member_id.'/'.$community_group_id.'/'.$project_area_id.'" onclick="return confirm(\'Do you want to activate '.$community_group_member_name.'?\');" title="Activate '.$community_group_member_name.'"><i class="fa fa-thumbs-up"></i></a>';
				}
				//create activated status display
				else if($row->community_group_member_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default" href="'.site_url().'tree-planting/deactivate-group-member/'.$community_group_member_id.'/'.$community_group_id.'/'.$project_area_id.'" onclick="return confirm(\'Do you want to deactivate '.$community_group_member_name.'?\');" title="Deactivate '.$community_group_member_name.'"><i class="fa fa-thumbs-down"></i></a>';
				}
				

				$count++;
				$result .= 
				'
					<tr>
						<td>'.$count.'</td>
						<td>'.$row->community_group_member_name.' </td>
						<td>'.$row->community_group_member_national_id.' </td>
						<td>'.$row->community_group_member_phone_number.' </td>
						<td>'.$row->community_group_member_email.' </td>
						<td>'.$status.'</td>						
						<td><a href="'.site_url().'tree-planting/edit-group-member/'.$community_group_member_id.'/'.$community_group_id.'/'.$project_area_id.'" class="btn btn-sm btn-success"title="Edit '.$community_group_member_name.'"><i class="fa fa-pencil"></i></a></td>
						<td>'.$button.'</td>
						<td><a href="'.site_url().'tree-planting/delete-group-member/'.$community_group_member_id.'/'.$community_group_id.'/'.$project_area_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$community_group_member_name.'?\');" title="Delete '.$community_group_member_name.'"><i class="fa fa-trash"></i></a></td>
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
			$result .= "There are no community group members";
		}

		
			$link = '<a href="'.site_url().'tree-planting/community-groups/'.$project_area_id.'" class="btn btn-sm btn-default pull-right" style="margin-left:5px; margin-top:-5px" >Back to comunity groups</a>';

		
		
		
?>
						<section class="panel">
							<header class="panel-heading">
								<h2 class="panel-title"><?php echo $title;?> <?php echo $link;?></h2>
								<a  class="btn btn-sm btn-success pull-right" id="open_new_community_group_member" onclick="get_new_community_group_member();" style="margin-top:-25px">Add community group member</a>
								<a  class="btn btn-sm btn-warning pull-right" id="close_new_community_group_member" style="display:none; margin-top:-25px;" onclick="close_new_community_group_member();">Close new community group member</a>
							</header>
							<div class="panel-body">
                                <div style="display:none;" class="col-md-12" style="margin-bottom:20px;" id="new_community_group_member" >
                                	<section class="panel">
										<header class="panel-heading">
											<div class="panel-actions">
											</div>
											<h2 class="panel-title">Add a new community group member</h2>
										</header>
										<div class="panel-body">
											<div class="row" style="margin-bottom:20px;">
                                    			<div class="col-lg-12 col-sm-12 col-md-12">
                                    				<div class="row">
                                    				<?php 
                                    						echo form_open("tree-planting/add-group-member/".$community_group_id."/".$project_area_id."", array("class" => "form-horizontal", "role" => "form"));
                                    					
                                    				?>
	                                    				<div class="col-md-12">
	                                    					<div class="row">
		                                    					<div class="col-md-6">
			                                    					<div class="form-group">
															            <label class="col-lg-5 control-label">Member Name: </label>
															            
															            <div class="col-lg-7">
															            	<input type="text" class="form-control" name="community_group_member_name" placeholder="Name" value="" required>
															            </div>
															        </div>
															        <div class="form-group">
															            <label class="col-lg-5 control-label">National id: </label>
															            
															            <div class="col-lg-7">
															            	<input type="text" class="form-control" name="community_group_member_national_id" placeholder="National ID" value="" required>
															            </div>
															        </div>
															    </div>
															    <div class="col-md-6">
															    	<div class="form-group">
															            <label class="col-lg-5 control-label">Phone number: </label>
															            
															            <div class="col-lg-7">
															            	<input type="text" class="form-control" name="community_group_member_phone_number" placeholder="Phone" value="" required>
															            </div>
															        </div>
															        <div class="form-group">
															            <label class="col-lg-5 control-label">Member Type: </label>
															            
															            <div class="col-lg-7">
															            	<select id='member_type_id' name='member_type_id' class='form-control custom-select ' required>
												                              <option value=''>None - Please Select a member type</option>
												                              <?php echo $member_type_list;?>
												                            </select>
															            </div>
															        </div>
															    </div>
															</div>
														    <div class="row" style="margin-top:10px;">
																<div class="col-md-12">
															        <div class="form-actions center-align">
															            <button class="submit btn btn-primary" type="submit">
															                Add community group member
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
                                <div style="display:none;" class="col-md-12" style="margin-bottom:20px;" id="new_community_group_member_allocation" >
                                	<section class="panel">
										<header class="panel-heading">
											<div class="panel-actions">
											</div>
											<h2 class="panel-title">Allocate community_group_member to <?php echo $title;?></h2>
										</header>
										<div class="panel-body">
											<div class="row" style="margin-bottom:20px;">
												<?php echo form_open("add-community-group-member-unit/".$rental_unit_id."", array("class" => "form-horizontal", "role" => "form"));?>
                                    			<div class="col-lg-12 col-sm-12 col-md-12">
                                    				<div class="row">
	                                    				<div class="col-md-12">
	                                    					<div class="row">
		                                    					<div class="col-md-10">
			                                    					<div class="form-group center-align">
															            <label class="col-lg-5 control-label">community_group_member Name: </label>
															            
															            <div class="col-lg-5">
															            	<select id='community_group_member_id' name='community_group_member_id' class='form-control custom-select '>
														                    <!-- <select class="form-control custom-select " id='procedure_id' name='procedure_id'> -->
														                      <option value=''>None - Please Select a community_group_member</option>
														                      <?php echo $community_group_members_list;?>
														                    </select>
															            </div>
															        </div>
															    </div>
															</div>
														    <div class="row" style="margin-top:10px;">
																<div class="col-md-12">
															        <div class="form-actions center-align">
															            <button class="submit btn btn-primary btn-sm" type="submit">
															                Allocate community_group_member to <?php echo $title;?>
															            </button>
															        </div>
															    </div>
															</div>
	                                    				</div>
	                                    			</div>
                                    				
                                    			</div>
                                    			<?php echo form_close();?>
	                                    				<!-- end of form -->
                                    			
                                    		</div>
										</div>
									</section>
                                </div>
                                <div class="col-md-12">
									<div class="table-responsive">
	                                	
										<?php 
										
										$success = $this->session->userdata('success_message');
			
										if(!empty($success))
										{
											echo '<div class="alert alert-success"> <strong>Success!</strong> '.$success.' </div>';
											$this->session->unset_userdata('success_message');
										}
										
										$error = $this->session->userdata('error_message');
										
										if(!empty($error))
										{
											echo '<div class="alert alert-danger"> <strong>Oh snap!</strong> '.$error.' </div>';
											$this->session->unset_userdata('error_message');
										}

										$search =  $this->session->userdata('all_community_group_members_search');
										if(!empty($search))
										{
											echo '<a href="'.site_url().'close_search_community_group_members" class="btn btn-sm btn-warning">Close Search</a>';
										}
				
										echo $result;
										
										?>
								
	                                </div>
	                                 <div class="widget-foot">
                                
										<?php if(isset($links)){echo $links;}?>
						            
						                <div class="clearfix"></div> 
						            
						            </div>
        
	                             </div>

							</div>
						</section>
<script type="text/javascript">
	$(function() {
	    $("#member_type_id").customselect();
	});
	$(document).ready(function(){
		$(function() {
			$("#member_type_id").customselect();
		});
	});

	function get_new_community_group_member(){

		var myTarget2 = document.getElementById("new_community_group_member");
		var myTarget3 = document.getElementById("new_community_group_member_allocation");
		var button = document.getElementById("open_new_community_group_member");
		var button2 = document.getElementById("close_new_community_group_member");

		myTarget2.style.display = '';
		button.style.display = 'none';
		myTarget3.style.display = 'none';
		button2.style.display = '';
	}
	function close_new_community_group_member(){

		var myTarget2 = document.getElementById("new_community_group_member");
		var button = document.getElementById("open_new_community_group_member");
		var button2 = document.getElementById("close_new_community_group_member");
		var myTarget3 = document.getElementById("new_community_group_member_allocation");

		myTarget2.style.display = 'none';
		button.style.display = '';
		myTarget3.style.display = 'none';
		button2.style.display = 'none';
	}


	function assign_new_community_group_member(){

		var myTarget2 = document.getElementById("new_community_group_member_allocation");
		var myTarget3 = document.getElementById("new_community_group_member");
		var button = document.getElementById("assign_new_community_group_member");
		var button2 = document.getElementById("close_assign_new_community_group_member");

		myTarget2.style.display = '';
		button.style.display = 'none';
		myTarget3.style.display = 'none';
		button2.style.display = '';
	}
	function close_assign_new_community_group_member(){

		var myTarget2 = document.getElementById("new_community_group_member_allocation");
		var button = document.getElementById("assign_new_community_group_member");
		var myTarget3 = document.getElementById("new_community_group_member");
		var button2 = document.getElementById("close_assign_new_community_group_member");

		myTarget2.style.display = 'none';
		button.style.display = '';
		myTarget3.style.display = 'none';
		button2.style.display = 'none';
	}


	// lease details


	function get_community_group_member_leases(community_group_member_id){

		var myTarget2 = document.getElementById("lease_details"+community_group_member_id);
		var myTarget3 = document.getElementById("new_community_group_member_allocation");
		var myTarget4 = document.getElementById("new_community_group_member");
		var button = document.getElementById("open_lease_details"+community_group_member_id);
		var button2 = document.getElementById("close_lease_details"+community_group_member_id);

		myTarget2.style.display = '';
		button.style.display = 'none';
		myTarget3.style.display = 'none';
		myTarget4.style.display = 'none';
		button2.style.display = '';
	}
	function close_community_group_member_leases(community_group_member_id){

		var myTarget2 = document.getElementById("lease_details"+community_group_member_id);
		var button = document.getElementById("open_lease_details"+community_group_member_id);
		var button2 = document.getElementById("close_lease_details"+community_group_member_id);
		var myTarget3 = document.getElementById("new_community_group_member_allocation");
		var myTarget4 = document.getElementById("new_community_group_member");

		myTarget2.style.display = 'none';
		button.style.display = '';
		myTarget3.style.display = 'none';
		myTarget4.style.display = 'none';
		button2.style.display = 'none';
	}

	// community_group_member_info
	function get_community_group_member_info(community_group_member_id){

		var myTarget2 = document.getElementById("community_group_member_info"+community_group_member_id);
		var myTarget3 = document.getElementById("new_community_group_member_allocation");
		var myTarget4 = document.getElementById("new_community_group_member");
		var button = document.getElementById("open_community_group_member_info"+community_group_member_id);
		var button2 = document.getElementById("close_community_group_member_info"+community_group_member_id);

		myTarget2.style.display = '';
		button.style.display = 'none';
		myTarget3.style.display = 'none';
		myTarget4.style.display = 'none';
		button2.style.display = '';
	}
	function close_community_group_member_info(community_group_member_id){

		var myTarget2 = document.getElementById("community_group_member_info"+community_group_member_id);
		var button = document.getElementById("open_community_group_member_info"+community_group_member_id);
		var button2 = document.getElementById("close_community_group_member_info"+community_group_member_id);
		var myTarget3 = document.getElementById("new_community_group_member_allocation");
		var myTarget4 = document.getElementById("new_community_group_member");

		myTarget2.style.display = 'none';
		button.style.display = '';
		myTarget3.style.display = 'none';
		myTarget4.style.display = 'none';
		button2.style.display = 'none';
	}

  </script>