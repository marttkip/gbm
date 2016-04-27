          
          <section class="panel">
                <header class="panel-heading">            
                    <h2 class="panel-title"><?php echo $title;?></h2>
                       <a href="<?php echo site_url();?>tree-planting/community-groups/<?php echo $project_area_id;?>" class="btn btn-info btn-sm pull-right" style="margin-top:-25px;">Back to Community Groups</a>
                </header>
                <div class="panel-body">
                        
                    <!-- Adding Errors -->
                    <?php
                    if(isset($error)){
                        echo '<div class="alert alert-danger"> Oh snap! '.$error.'. </div>';
                    }
                    
                    $validation_errors = validation_errors();
                    
                    if(!empty($validation_errors))
                    {
                        echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
                    }
                    ?>
                    
                    <?php echo form_open($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
                    <div class="row">
                    	<div class="col-sm-6">
                            <!-- Company Name -->
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Community Group Name</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="community_group_name" placeholder="Community Name" value="<?php echo set_value('community_group_name');?>" required>
                                </div>
                            </div>
                            
                            <!-- Company Name -->
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Concact Person Name</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="community_group_contact_person_name" placeholder="Concact Person Name" value="<?php echo set_value('community_group_contact_person_name');?>" required>
                                </div>
                            </div>
                            
                            <!-- Company Name -->
                            <div class="form-group">
                                <label class="col-lg-4 control-label">Contact Person Phone</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="community_group_contact_person_phone1" placeholder="Contact Person Phone 1" value="<?php echo set_value('community_group_contact_person_phone1');?>" required>
                                </div>
                            </div>
                        </div>
                        
                    	<div class="col-sm-6">
                            
                           <div class="form-group">
                                <label class="col-lg-4 control-label">Bank Name</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="bank_name" placeholder="Bank Name" value="<?php echo set_value('bank_name');?>" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-lg-4 control-label"> Account Name</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="account_name" placeholder="Account Name" value="<?php echo set_value('account_name');?>" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-lg-4 control-label"> Account Number</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control" name="account_number" placeholder="Account Number" value="<?php echo set_value('account_number');?>" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Address Details</h4>
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="col-lg-4 control-label">Address</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="address" placeholder="Address" value="<?php echo set_value('address');?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label"> Location</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="location" placeholder="Location" value="<?php echo set_value('location');?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-lg-4 control-label"> County</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="county" placeholder="county" value="<?php echo set_value('county');?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label class="col-lg-4 control-label"> Chief's Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="chief_name" placeholder="Chief's name" value="<?php echo set_value('chief_name');?>" required>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-lg-4 control-label"> Sub Chief's Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="sub_chief" placeholder="Contact Person email 2" value="<?php echo set_value('sub_chief');?>" required>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="col-lg-4 control-label"> MP</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" name="mp" placeholder="Member of Parliament" value="<?php echo set_value('mp');?>" required>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Address Details</h4>
                            <div class="col-md-6">
                                 <!-- Company Name -->
                                <div class="form-group">
                                    <label class="col-lg-4 control-label"> Current Activities</label>
                                    <div class="col-lg-8">
                                        <textarea name="now_activities" class="form-control" rows="5" placeholder="Current Activities"><?php echo set_value('now_activities');?></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                 <!-- Company Name -->
                                <div class="form-group">
                                    <label class="col-lg-4 control-label"> Later Activities</label>
                                    <div class="col-lg-8">
                                        <textarea name="later_activities" class="form-control" rows="5" placeholder="Later Activities"><?php echo set_value('later_activities');?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br/>
                    <div class="form-actions center-align">
                        <button class="submit btn btn-primary" type="submit">
                            Add Community Group
                        </button>
                    </div>
                    <br />


                    <?php echo form_close();?>
                </div>
            </section>