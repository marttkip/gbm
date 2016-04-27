          
  <section class="panel">
        <header class="panel-heading">
          
            <h2 class="panel-title"><?php echo $title;?></h2>
              <a href="<?php echo site_url();?>human-resource/personnel-roles" class="btn btn-info btn-sm pull-right" style="margin-top: -25px;">Back to personnel roles</a>
        </header>
        <div class="panel-body">                
            <!-- Adding Errors -->
            <?php
            if(isset($error)){
                echo '<div class="alert alert-danger"> Oh snap! Change a few things up and try submitting again. </div>';
            }
            
            $validation_errors = validation_errors();
            
            if(!empty($validation_errors))
            {
                echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
            }
            ?>
            
            <?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <div class="row">
            	<div class="col-md-12 ">
                    <!-- Branch Name -->
                    <div class="form-group center-align">
                        <label class="col-lg-4 control-label">Personnel Role Name</label>
                        <div class="col-lg-6">
                            <input type="text" class="form-control" name="personnel_role_name" placeholder="Role Name" value="<?php echo set_value('personnel_role_name');?>">
                        </div>
                    </div>
                    
            	</div>
            </div>
            <br />
            <div class="form-actions center-align">
                <button class="submit btn btn-primary btn-sm" type="submit">
                    Add Personnel Role
                </button>
            </div>
            <br />
            <?php echo form_close();?>
        </div>
    </section>