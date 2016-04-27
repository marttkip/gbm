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
        <title>Community Group Details</title>
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
     <strong>COMMUNITY GROUP REGISTRATION FORM</strong>  
    </div> 
    </br>
      
        
    	<div class="row" >
        	<div class="col-md-12">
            	 <strong>
                    {1} Group Name:</strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $community_group_name;?></span>
                  
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-6">
            	 <strong>
                  {2} Address: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $address;?></span>
                  
            </div>
     
        	<div class="col-md-6">
            <strong>
                   Phone/Fax: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $community_group_contact_person_phone1;?></span>
            </div>
        </div>
        </br>
      	<div class="row" >
        	<div class="col-md-6">
            <strong>
                    Sub-location: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $sub_location;?></span>
            </div>
            <div class="col-md-6">
            <strong>
                    Location: </strong><span style=" text-decoration:underline"><?php echo $location;?></span>
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-6">
            <strong>
                    Sub-Chief Name: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $sub_chief;?></span>
            </div>
            <div class="col-md-6   ">
            <strong>
                   Chief Name: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $chief;?></span>
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
            <strong>
                    Your MP is: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $mp;?></span>
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
            <strong>
                  {3} Name of Nearby GBM group:</strong>
            </div>
        </div>
           <div class="row" >
        	<div class="col-md-12">
                  .....................................................................
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
                   <strong>{4} Group Contact Person:</strong>
            </div>
        </div>
        <div class="row" >
        	<div class="col-md-6">
                    <strong>Contact Pesron Name: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $community_group_contact_person_name;?></span>
            </div>
            <div class="col-md-6">
                   <strong>Position: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
                   <strong>{5} Current Activities the group is currently participating in:</strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $now_activities;?></span>
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
                    <strong>{6} Reasons for joining GBM:</strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"> <?php echo '';?></span>
            </div>
        </div>
          <div class="row" >
        	<div class="col-md-12">
                    ..........................................................................
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
                    <strong>{7} Explain some of the activities that the group will be facilitating:</strong> <span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $later_activities;?></span>
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
                    <strong>Where will the activities listed above be carried out?:</strong> <?php echo '';?>
            </div>
        </div>
        <div class="row" >
        	<div class="col-md-12">
                   ................................................................................
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
                    <strong>{8} Any suggestions or recommendations you'd like to give to Green Belt Movement:</strong> <?php echo '';?>
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
                    <strong>Account Number: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $account_number;?></span>
            </div>
         </div>
         </br>
        <div class="row" >
        	<div class="col-md-6">
                    <strong>signature:</strong> ..........................................
            </div>
            <div class="col-md-6">
                   	<strong>signature: </strong>..........................................
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-6">
                    <strong>signature:</strong> ..........................................
            </div>
            <div class="col-md-6">
                   <strong>signature:</strong> ..........................................
            </div>
        </div>
        </br>
        <div class="receipt_bottom_border">
        <p align="center">
        <strong>
            After completing the phone,please return it to our GBM offices.
             NB   Write all the names of the members in the group and ensure that all of them append their signatures against their names.
             </strong>
            </p>
            </div>
            <div class="row">
            </div>
            <div class="row" >
        	<div class="col-md-4">
            	 <strong
                    E-mail: <?php echo $branch_email;?>.
                  </strong>
            </div>
            <div class="col-md-4">
            	 
                   Tel : <?php echo $branch_phone;?><br/>
                  
            </div>
             <div class="col-md-4">
            	 
                   Website: www.gbmovement.org<br/>
                  
            </div>
        </div>

    </body>
</html>