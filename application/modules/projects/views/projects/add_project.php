<section class="panel panel-featured panel-featured-info">
    <header class="panel-heading">
         <h2 class="panel-title pull-left"><?php echo $title;?></h2>
         <div class="widget-icons pull-right">
            	<a href="<?php echo base_url();?>tree-planting/projects" class="btn btn-success btn-sm">Back to projects</a>
          </div>
          <div class="clearfix"></div>
    </header>
    <div class="panel-body">
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
            
            <?php echo form_open($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
            <div class="row">
                 <div class="col-md-6">
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Project Start Date</label>
                        <div class="col-lg-8">
                           <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input data-format="yyyy-MM-dd" type="text" data-plugin-datepicker class="form-control" name="project_start_date" placeholder="Project Start Date">
                            </div>
                        </div>
                    </div>
                </div>
                 <div class="col-md-6">
                 <!-- brand Name -->
                    <div class="form-group">
                        <label class="col-lg-4 control-label">Project End Date</label>
                        <div class="col-lg-8">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input data-format="yyyy-MM-dd" type="text" data-plugin-datepicker class="form-control" name="project_end_date" placeholder="Project End Date">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br />
     		<div class="row">
     			<div class="col-md-12">
     				 <!-- brand Name -->
			            <div class="form-group">
			                <label class="col-lg-3 control-label">Project Instructions</label>
			                <div class="col-lg-8">
			                	<textarea class="form-control" name="project_instructions"><?php echo set_value('project_instructions');?></textarea>
			                </div>
			            </div>
     			</div>
     		</div>
     		<br>
     		<div class="row">
	            <div class="form-actions center-align">
	                <button class="submit btn btn-primary btn-sm" type="submit">
	                    Create New Project
	                </button>
	            </div>
	         </div>
            <br />
            <?php echo form_close();?>
    </div>
</section>