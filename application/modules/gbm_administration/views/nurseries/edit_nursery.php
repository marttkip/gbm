
          <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title"><?php echo $title;?></h2>
                     <a href="<?php echo site_url();?>gbm-administration/nurseries" class="btn btn-info btn-sm pull-right" style="margin-top:-25px;">Back to nurseries</a>
                </header>
                <div class="panel-body">
                <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! '.$error.' </div>';
            }
			
			//the nursery details
			$nursery_name = $nursery[0]->nursery_name;
			$nursery_status = $nursery[0]->nursery_status;
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
				$nursery_name = set_value('nursery_name');
				$nursery_status = set_value('nursery_status');
				
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
			
            ?>
            
            <?php echo form_open($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">nursery name</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="nursery_name" placeholder="nursery name" value="<?php echo $nursery_name;?>" required>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Activate nursery?</label>
                        <div class="col-lg-4">
                            <div class="radio">
                                <label>
                                    <?php
                                    if($nursery_status == 1){echo '<input id="optionsRadios1" type="radio" checked value="1" name="nursery_status">';}
                                    else{echo '<input id="optionsRadios1" type="radio" value="1" name="nursery_status">';}
                                    ?>
                                    Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <?php
                                    if($nursery_status == 0){echo '<input id="optionsRadios1" type="radio" checked value="0" name="nursery_status">';}
                                    else{echo '<input id="optionsRadios1" type="radio" value="0" name="nursery_status">';}
                                    ?>
                                    No
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-actions center-align">
                <button class="submit btn btn-primary" type="submit">
                    Edit nursery
                </button>
            </div>
            <br />
            <?php echo form_close();?>
                </div>
            </section>