<?php
foreach ($query->result() as $key) {
	$community_group_member_id = $key->community_group_member_id;
	$community_group_member_national_id = $key->community_group_member_national_id;	
	$community_group_member_name = $key->community_group_member_name;
	$community_group_member_phone_number = $key->community_group_member_phone_number;
	$community_group_member_email = $key->community_group_member_email;
}
?>
<section class="panel">
		<header class="panel-heading">
			<div class="panel-actions">
			</div>
			<h2 class="panel-title">Edit <?php echo $community_group_member_name;?></h2>
		</header>
		<div class="panel-body">
			<div class="row" style="margin-bottom:20px;">
    			<div class="col-lg-12 col-sm-12 col-md-12">
    				<div class="row">
    				<?php echo form_open("tree-planting/edit-group-member/".$community_group_member_id."/".$community_group_id, array("class" => "form-horizontal", "role" => "form"));?>
        				<div class="col-md-12">
        					<div class="row">
            					<div class="col-md-6">
                					<div class="form-group">
							            <label class="col-lg-5 control-label">Member Name: </label>
							            
							            <div class="col-lg-7">
							            	<input type="text" class="form-control" name="community_group_member_name" placeholder="Name" value="<?php echo $community_group_member_name;?>">
							            </div>
							        </div>
							        <div class="form-group">
							            <label class="col-lg-5 control-label">National id: </label>
							            
							            <div class="col-lg-7">
							            	<input type="text" class="form-control" name="community_group_member_national_id" placeholder="National ID" value="<?php echo $community_group_member_national_id;?>">
							            </div>
							        </div>
							    </div>
							    <div class="col-md-6">
							    	<div class="form-group">
							            <label class="col-lg-5 control-label">Phone number: </label>
							            
							            <div class="col-lg-7">
							            	<input type="text" class="form-control" name="community_group_member_phone_number" placeholder="Phone" value="<?php echo $community_group_member_phone_number;?>">
							            </div>
							        </div>
							        <div class="form-group">
							            <label class="col-lg-5 control-label">Email address: </label>
							            
							            <div class="col-lg-7">
							            	<input type="email" class="form-control" name="community_group_member_email" placeholder="Email address" value="<?php echo $community_group_member_email;?>">
							            </div>
							        </div>
							    </div>
							</div>
						    <div class="row" style="margin-top:10px;">
								<div class="col-md-12">
							        <div class="form-actions center-align">
							            <button class="submit btn btn-primary" type="submit">
							                Edit Member details
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