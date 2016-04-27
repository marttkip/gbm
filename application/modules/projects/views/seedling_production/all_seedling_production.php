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
						<th>Nursery</th>
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
				$seedling_production_id = $row->seedling_production_id;
				$community_group_name = $row->community_group_name;
				$seedling_production_status = $row->seedling_production_status;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				$last_modified = date('jS M Y H:i a',strtotime($row->last_modified));
				$created = date('jS M Y H:i a',strtotime($row->created));
				
				//create deactivated status display
				if($seedling_production_status == 0)
				{
					$status = '<span class="label label-default">Deactivated</span>';
					$button = '<a class="btn btn-info btn-sm" href="'.site_url().'gbm-administration/activate-county/'.$seedling_production_id.'" onclick="return confirm(\'Do you want to activate '.$community_group_name.'?\');" title="Activate '.$community_group_name.'"><i class="fa fa-thumbs-up"></i></a>';
				}
				//create activated status display
				else if($seedling_production_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default btn-sm" href="'.site_url().'gbm-administration/deactivate-county/'.$seedling_production_id.'" onclick="return confirm(\'Do you want to deactivate '.$community_group_name.'?\');" title="Deactivate '.$community_group_name.'"><i class="fa fa-thumbs-down"></i></a>';
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
						<td>0</td>
						<td>0</td>
						<td>0</td>
						<td>'.$last_modified.'</td>
						<td>'.$modified_by.'</td>
						<td>'.$status.'</td>
						<td>
							<a  class="btn btn-sm btn-success" id="open_tenant_info'.$seedling_production_id.'" onclick="get_tenant_info('.$seedling_production_id.');" ><i class="fa fa-folder"></i> Production Detail</a>
							<a  class="btn btn-sm btn-warning" id="close_tenant_info'.$seedling_production_id.'"  onclick="close_tenant_info('.$seedling_production_id.')" style="display:none;"><i class="fa fa-folder-open"></i> Close Production Info</a>
						</td>
						<td><a href="'.site_url().'tree-planting/seedling-tally/'.$seedling_production_id.'/'.$project_area_id.'" class="btn btn-sm btn-warning" ><i class="fa fa-eye"></i></a></td>
						<td>'.$button.'</td>

						<td><a href="'.site_url().'gbm-administration/delete-county/'.$seedling_production_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$community_group_name.'?\');" title="Delete '.$community_group_name.'"><i class="fa fa-trash"></i></a></td>
					</tr> 
				';
				$v_data['seedling_production_id'] = $seedling_production_id;
				$result .= '<tr id="tenant_info'.$seedling_production_id.'" style="display:none;">
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
<?php echo $this->load->view('project_areas/project_area_header','',true);?>
<section class="panel">
	<header class="panel-heading">
		<h2 class="panel-title"><?php echo $title;?></h2>
		<a href="<?php echo site_url();?>tree-planting/project-area-detail/<?php echo $project_area_id;?>" class="btn btn-default btn-sm pull-right" style="margin-top:-25px;">Back to Project Detail</a>
		<a  class="btn btn-sm btn-success pull-right" id="open_new_community_group_member" onclick="get_new_community_group_member();" style="margin-top:-25px;margin-right:5px;">Add seedling production</a>
		<a  class="btn btn-sm btn-warning pull-right" id="close_new_community_group_member" style="display:none; margin-top:-25px;margin-right:5px;" onclick="close_new_community_group_member();">Close seedling production</a>
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
            						echo form_open("tree-planting/add-seedling-production/".$project_area_id."", array("class" => "form-horizontal", "role" => "form"));
            					
            				?>
                				<div class="col-md-12">
                					<div class="row">
                    					<div class="col-md-10">
                        					<div class="form-group">
									            <label class="col-lg-5 control-label">Community Group / Nursery: </label>
									            
									            <div class="col-lg-7">
									            	<select id='community_group_id' name='community_group_id' class='form-control custom-select ' required>
						                              <option value=''>None - Please Select a member type</option>
						                              <?php echo $community_group_list;?>
						                            </select>
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
	    $("#community_group_id").customselect();
	});
	$(document).ready(function(){
		$(function() {
			$("#community_group_id").customselect();
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
	function get_tenant_info(seedling_production_id){

		var myTarget2 = document.getElementById("tenant_info"+seedling_production_id);
		var myTarget3 = document.getElementById("new_tenant_allocation");
		var myTarget4 = document.getElementById("new_tenant");
		var button4 = document.getElementById("open_tenant_info"+seedling_production_id);
		var button5 = document.getElementById("close_tenant_info"+seedling_production_id);

		myTarget2.style.display = '';
		button4.style.display = 'none';
		button5.style.display = '';
		myTarget3.style.display = 'none';
		myTarget4.style.display = 'none';
	}
	function close_tenant_info(seedling_production_id){

		var myTarget2 = document.getElementById("tenant_info"+seedling_production_id);
		var button4 = document.getElementById("open_tenant_info"+seedling_production_id);
		var button5 = document.getElementById("close_tenant_info"+seedling_production_id);
		var myTarget3 = document.getElementById("new_tenant_allocation");
		var myTarget4 = document.getElementById("new_tenant");

		myTarget2.style.display = 'none';
		button4.style.display = '';
		button5.style.display = 'none';
		myTarget3.style.display = 'none';
		myTarget4.style.display = 'none';
	}

  </script>