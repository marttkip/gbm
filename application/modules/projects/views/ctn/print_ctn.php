<?php
if($branch_data->num_rows()>0)
{
	$branch_details = $branch_data->result();
	foreach($branch_details as $rows)
	{
		$branch_name = $rows->branch_name;
		$branch_address = $rows->branch_address;
		$branch_post_code = $rows->branch_post_code;
		$branch_city = $rows->branch_city;
		$branch_email = $rows->branch_email;
		$branch_phone = $rows->branch_phone;
		$branch_location = $rows->branch_location;
		$branch_image_name = $rows->branch_image_name;
	}
}
if($community_group_info->num_rows()>0)
{
	$community_group = $community_group_info->result();
	foreach($community_group as $community_groups)
	{
		$community_group_name = $community_groups->community_group_name;
		$address = $community_groups->address;
	}
}
if($nursery_info->num_rows()>0)
{
	$nursery = $nursery_info->result();
	foreach($nursery as $nurserys)
	{
		$nursery_name = $nurserys->nursery_name;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
	<style type="text/css">
		.receipt_spacing{letter-spacing:0px; font-size: 12px;}
		.center-align{margin:0 auto; text-align:center;}
		
		.receipt_bottom_border{border-bottom: #888888 medium solid;}
		.row .col-md-12 table {
			border:solid #000 !important;
			border-width:1px 0 0 1px !important;
			font-size:10px;
		}
		.row .col-md-12 th, .row .col-md-12 td {
			border:solid #000 !important;
			border-width:0 1px 1px 0 !important;
		}
		
		.row .col-md-12 .title-item{float:left;width: 130px; font-weight:bold; text-align:right; padding-right: 20px;}
		.title-img{float:left; padding-left:30px;}
		img.logo{max-height:70px; margin:0 auto;}
	</style>
    <head>
        <title>NURSERY REPORT</title>
        <!-- For mobile content -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- IE Support -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <!-- Bootstrap -->
        <link rel="stylesheet" href="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/bootstrap/css/bootstrap.css" />
        <link rel="stylesheet" href="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/stylesheets/theme-custom.css">
    </head>
    <body class="receipt_spacing">
    <div class="row" >
        	<img src="<?php echo base_url().'assets/logo/'.$branch_image_name;?>" alt="<?php echo $branch_name;?>" class="img-responsive logo"/>
        	<div class="col-md-12 center-align receipt_bottom_border">
            	 <strong>
                	<?php echo $branch_name;?><br/>
                    <?php echo $branch_address;?> <?php echo $branch_post_code;?> <?php echo $branch_city;?><br/>
                    E-mail: <?php echo $branch_email;?>. Tel : <?php echo $branch_phone;?><br/>
                    <?php echo $branch_location;?><br/>
                  </strong>
            </div>
    </div>
     <div class="col-md-12 center-align">
     <strong>FORM IX(9)</strong>  
    </div> 
    </br>
    <div class="col-md-12 center-align">
     <strong>TREES ISSUED</strong>  
    </div> 
    </br>
     <div class="row" >
        	<div class="col-md-6">
            	 <strong>
                  OUR ADDRESS IS: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $address;?></span>
                  
            </div>
     
        	<div class="col-md-6">
            <strong>
                   DATE: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo date('Y-m-d');?></span>
            </div>
         </div>
         <div class="row" >
        	<div class="col-md-6">
                  <span style="text-decoration:underline"></span>
            </div>
          </div>
           <div class="row" >
        	<div class="col-md-6">
                  <span style="text-decoration:underline"></span>
            </div>
          </div>
      </br>
      <div class="row" >
        	<div class="col-md-12">
            	 <strong>
                   Nursery Name:</strong><span style="border-bottom: 1px dotted #000; padding-bottom:4px"><?php echo $nursery_name;?></span>
                  
            </div>
        </div>
        </br>
        <div>
      
         <table class="table table-bordered table-striped table-condensed">
         <tr>
         <th colspan="4"></th>
         <th colspan="3">Trees Issued</th>
         </tr>  
		
         <th>Date of Issue</th>
         <th>Name of Reciever</th>
         <th>Total Trees Issued</th>
         <th>Fruit Trees</th>
         <th>Indigenous Trees</th>
         <th>Exotic Trees</th>
         
         <tbody>
         	 <?php
			 $count = 0;
			if($ctn_order_details->num_rows()>0)
			{
				$print_details = $ctn_order_details->result();
				foreach($print_details as $details)
				{
				$issue_date = $details->date_given;
				$personnel_id = $details->personnel_id;
				$fruit_trees = $details->fruit_trees;
				$exotic_trees = $details->exotic_trees;
				$indigenous_trees = $details->indegenous_trees;
				$receiver_name = $this->ctn_model->get_personnel_name($personnel_id);
				$count++;
				?>
                <tr>
                <td><?php echo $issue_date; ?></td>
                <td><?php echo $receiver_name; ?></td>
                <td><?php echo $fruit_trees+$exotic_trees+$indigenous_trees; ?></td>
                <td><?php echo $fruit_trees; ?></td>
                <td><?php echo $indigenous_trees; ?></td>
                <td><?php echo $exotic_trees; ?></td>
                <td></td>
                <?php
				}
			}
			?>
         </tbody>
         </table>
         </div>
         </br>
         <div class="row" >
        	<div class="col-md-6">
            	 <strong>
                  This from was filled and verified by: </strong>
                  
            </div>
     
        	<div class="col-md-6">
            <strong>
                   Meeting Date for filling and from verification: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
         </div>
         </br>
         <div class="row" >
        	<div class="col-md-6">
            <strong>Chairperson</strong>
                  <span style="text-decoration:underline"></span>
            </div>
        	<div class="col-md-6">
            <strong>First Meeting</strong>
                  <span style="text-decoration:underline"></span>
            </div>
          </div>
      </br>
      <div class="row" >
        	<div class="col-md-6">
            	 <strong>
                  Secretary </strong>
                  
            </div>
     
        	<div class="col-md-6">
            <strong>
                  Second Meeting: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
         </div>
         </br>
         <div class="row" >
        	<div class="col-md-6">
            <strong>Treasurer</strong>
                  <span style="text-decoration:underline"></span>
            </div>
        	<div class="col-md-6">
            <strong>Third Meeting</strong>
                  <span style="text-decoration:underline"></span>
            </div>
          </div>
      </br>
      <div class="row" >
        	<div class="col-md-6">
            	 <strong>
                  Care Taker</strong>
                  
            </div>
     
        	<div class="col-md-6">
            <strong>
                  Fourth Meeting: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
         </div>
         </br>