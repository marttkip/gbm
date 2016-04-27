<?php
 $row = $company_array;
 //the company details
    $community_group_id = $row->community_group_id;
    $community_group_name = $row->community_group_name;
    $community_group_contact_person_name = $row->community_group_contact_person_name;
    $community_group_contact_person_phone1 = $row->community_group_contact_person_phone1;
    $community_group_contact_person_phone2 = $row->community_group_contact_person_phone2;
    $community_group_contact_person_email1 = $row->community_group_contact_person_email1;
    $community_group_contact_person_email2 = $row->community_group_contact_person_email2;
    $community_group_description = $row->community_group_description;
    $community_group_status = $row->community_group_status;

    $validation_errors = validation_errors();

    if(!empty($validation_errors))
    {
        $community_group_id = set_value('$row->community_group_id');
        $community_group_name = set_value('$row->community_group_name');
        $community_group_contact_person_name = set_value('$row->community_group_contact_person_name');
        $community_group_contact_person_phone1 = set_value('$row->community_group_contact_person_phone1');
        $community_group_contact_person_phone2 = set_value('$row->community_group_contact_person_phone2');
        $community_group_contact_person_email1 = set_value('$row->community_group_contact_person_email1');
        $community_group_contact_person_email2 = set_value('$row->community_group_contact_person_email2');
        $community_group_description = set_value('$row->community_group_description');
        $community_group_status = set_value('$row->community_group_status');
        
        echo '<div class="alert alert-danger"> Oh snap! '.$validation_errors.' </div>';
    }
?>
<?php echo form_open_multipart($this->uri->uri_string(), array("class" => "form-horizontal", "role" => "form"));?>
    <div class="row">
    	<div class="col-sm-6">
            <!-- Company Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Community group Name</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="community_group_name" placeholder="Community Name" value="<?php echo $community_group_name;?>">
                </div>
            </div>
            
            <!-- Company Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Concact Person Name</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="community_group_contact_person_name" placeholder="Concact Person Name" value="<?php echo $community_group_contact_person_name;?>">
                </div>
            </div>
            
            <!-- Company Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Contact Person Phone 1</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="community_group_contact_person_phone1" placeholder="Contact Person Phone 1" value="<?php echo $community_group_contact_person_phone1;?>">
                </div>
            </div>
            
            <!-- Company Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Contact Person Phone 2</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="community_group_contact_person_phone2" placeholder="Contact Person Phone 2" value="<?php echo $community_group_contact_person_phone2;?>">
                </div>
            </div>
           
        </div>
        
    	<div class="col-sm-6">
            
            <!-- Company Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Contact Person email 1</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="community_group_contact_person_email1" placeholder="Contact Person email 1" value="<?php echo $community_group_contact_person_email1;?>">
                </div>
            </div>
            
            <!-- Company Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Contact Person email 2</label>
                <div class="col-lg-8">
                    <input type="text" class="form-control" name="community_group_contact_person_email2" placeholder="Contact Person email 2" value="<?php echo $community_group_contact_person_email2;?>">
                </div>
            </div>
            
            <!-- Company Name -->
            <div class="form-group">
                <label class="col-lg-4 control-label">Insurance Company Description</label>
                <div class="col-lg-8">
                	<textarea name="community_group_description" class="form-control" rows="5" placeholder="Insurance Company Description"><?php echo $community_group_description;?></textarea>
                </div>
            </div>
            <!-- Activate checkbox -->

           
        </div>
    </div>
    <div class="form-actions center-align">
        <button class="submit btn btn-sm btn-primary" type="submit">
            Edit company
        </button>
    </div>
    <br />
<?php echo form_close();?>