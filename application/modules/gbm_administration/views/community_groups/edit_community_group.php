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
<div class="row">

  <section class="panel">

        <header class="panel-heading">
         <h2 class="panel-title"><?php echo $title;?> <?php echo $community_group_name;?> Details</h2>
         <a href="<?php echo site_url();?>tree-planting/community-groups" class="btn btn-info btn-sm pull-right" style="margin-top:-25px;">Back to Community Groups</a>
        </header>
        <div class="panel-body">
            
            <div class="row">
                <div class="col-md-12">
                    <?php
                        $success = $this->session->userdata('success_message');
                        $error = $this->session->userdata('error_message');
                        
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
                    <div class="tabs">
                        <ul class="nav nav-tabs nav-justified">
                            <li class="active">
                                <a class="text-center" data-toggle="tab" href="#general"><i class="fa fa-user"></i> General details</a>
                            </li>
                            <li>
                                <a class="text-center" data-toggle="tab" href="#account"><i class="fa fa-lock"></i> Group Attachments</a>
                            </li>
                    
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="general">
                                <?php
                                    $v_data['company_array'] = $row;
                                     echo $this->load->view('edit/about', $v_data, TRUE);?>
                            </div>
                            <div class="tab-pane" id="account">
                                <?php echo $this->load->view('edit/group_members', '', TRUE);?>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>