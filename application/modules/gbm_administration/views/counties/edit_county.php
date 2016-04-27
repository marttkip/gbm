
          <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title"><?php echo $title;?></h2>
                     <a href="<?php echo site_url();?>gbm-administration/counties" class="btn btn-info btn-sm pull-right" style="margin-top:-25px;">Back to counties</a>
                </header>
                <div class="panel-body">
                <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! '.$error.' </div>';
            }
			
			//the county details
			$county_name = $county[0]->county_name;
			$county_status = $county[0]->county_status;
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
				$county_name = set_value('county_name');
				$county_status = set_value('county_status');
				
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
			
            ?>
            
            <?php echo form_open($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">county name</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" name="county_name" placeholder="county name" value="<?php echo $county_name;?>" required>
                        </div>
                    </div>
                </div>
                
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Activate county?</label>
                        <div class="col-lg-4">
                            <div class="radio">
                                <label>
                                    <?php
                                    if($county_status == 1){echo '<input id="optionsRadios1" type="radio" checked value="1" name="county_status">';}
                                    else{echo '<input id="optionsRadios1" type="radio" value="1" name="county_status">';}
                                    ?>
                                    Yes
                                </label>
                            </div>
                            <div class="radio">
                                <label>
                                    <?php
                                    if($county_status == 0){echo '<input id="optionsRadios1" type="radio" checked value="0" name="county_status">';}
                                    else{echo '<input id="optionsRadios1" type="radio" value="0" name="county_status">';}
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
                    Edit county
                </button>
            </div>
            <br />
            <?php echo form_close();?>
                </div>
            </section>