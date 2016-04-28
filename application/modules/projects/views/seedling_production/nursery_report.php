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
if($nursery_info->num_rows()>0)
{
	$nursery = $nursery_info->result();
	foreach($nursery as $nurserys)
	{
		$nursery_name = $nurserys->nursery_name;
	}
}

$seedlings_rs = $this->seedling_production_model->get_months_seedling_tally($month,$year,$seedling_product_id);
$ready = 0;
$not_ready = 0;
$bags = 0;

$indeginous_not_ready = 0;
$fruits_not_ready = 0;
$exotic_not_ready = 0;
$total_not_ready = 0;
if($seedlings_rs->num_rows() > 0)
{   

    foreach ($seedlings_rs->result() as $key_value) {
        # code...
        $other_id = $key_value->nursery_tally_id;
        $checked_id = $key_value->seedling_status_id;
        

        if($checked_id == 1)
        {
            $ready = $key_value->quantity;
        }
        else if($checked_id == 2)
        {
            $not_ready = $key_value->quantity;
            $seedling_type_id = $key_value->seedling_type_id;
            // find the numbers for each seedling type
            if($seedling_type_id == 1)
            {
                $indeginous_not_ready = $not_ready;
            }
            else if($seedling_type_id == 2)
            {
                $exotic_not_ready = $not_ready;
            }
            else if($seedling_type_id == 3)
            {
                $fruits_not_ready = $not_ready;
            }
            $total_not_ready = $indeginous_not_ready+$exotic_not_ready+$fruits_not_ready;
        }

        else
        {
            $bags = $key_value->quantity;

        }



        


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
     <strong>FORM V(5)</strong>  
    </div> 
    </br>
    <div class="col-md-12 center-align">
     <strong>NURSERY REPORT</strong>  
    </div> 
    </br>
      
        <div class="row" >
        	<div class="col-md-6">
            	 <strong>
                  OUR ADDRESS IS: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
                  
            </div>
     
        	<div class="col-md-6">
            <strong>
                   DATE: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
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
          <div class="row" >
        	<div class="col-md-12">
            	 <strong>
                    To The ChairPerson:</strong><span style="text-decoration:underline"><?php echo'';?></span>
                  
            </div>
        </div>
        </br>
    	<div class="row" >
        	<div class="col-md-12">
            	 <strong>
                    1. Nursery Name:</strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $nursery_name;?></span>
                  
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
            	 <strong>
                  2. Report For the month of : </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $month;?></span>
                  
            </div>
         </div>
        </br>
      	<div class="row" >
        	<div class="col-md-6">
            <strong>
                    Sub-location: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
            <div class="col-md-6">
            <strong>
                    Location: </strong><span style=" text-decoration:underline"><?php echo '';?></span>
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
            <strong>
                  3. You must keep a record of the seedlings in your nursery.You can be asked to show them at any time. Failure to keep proper records, may cause the work of nursery facilitators and other workers to discontinue or come to a complete halt.Please submit your monthly nursery records for your seedlings at the end of every month using this form(Form V)</strong>
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
                   <strong>4. Please arrange the seedlings in the potting-bags according to the different species and provide the following information:</strong>
            </div>
        </div>
        </br>
 		<div class="row" >
        	<div class="col-md-12">
                   <strong>(i) Number of total potting bags in the nursery:</strong>
            </div>
        </div>
        <div class="row" >
        	<div class="col-md-6">
                    <strong>(a) Indigenous species: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
            <div class="col-md-6">
                   <strong>(b) Fruits: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
        </div>
        <div class="row" >
        	<div class="col-md-6">
                    <strong>(c)Foreign Species: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
            <div class="col-md-6">
                   <strong>(d) Total(all inclusive): </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
                   <strong>(ii) Seedlings ready for planting</strong>
            </div>
        </div>
            <div class="row" >
        	<div class="col-md-6">
                    <strong>(a) Indigenous species: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
            <div class="col-md-6">
                   <strong>(b) Fruits: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
        </div>
        <div class="row" >
        	<div class="col-md-6">
                    <strong>(c)Foreign Species: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
            <div class="col-md-6">
                   <strong>(d) Total(all inclusive): </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
                   <strong>(iii) Seedlings NOT ready for planting</strong>
            </div>
        </div>
            <div class="row" >
        	<div class="col-md-6">
                    <strong>(a) Indigenous species: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $indeginous_not_ready;?></span>
            </div>
            <div class="col-md-6">
                   <strong>(b) Fruits: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $fruits_not_ready;?></span>
            </div>
        </div>
        <div class="row" >
        	<div class="col-md-6">
                    <strong>(c)Foreign Species: </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $exotic_not_ready;?></span>
            </div>
            <div class="col-md-6">
                   <strong>(d) Total(all inclusive): </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo $total_not_ready;?></span>
            </div>
        </div>
        </br>
        <div class="row">
        	<div class="col-md-12">
                    <strong>5. Are there seedlings that are still in the seedling bed?: <?php echo '';?>
                    </br>
                    If yes, aproximately how many?...................
            		</strong>
            <p>Please ensure that your seedlings are put in potting bags. Your nursery can get the potting-bags but before they arrive, ensure that the seeedlingsa reput in bags such as milk packets, plastic bottles, etc. Try to use the bags as much as possible by removing the seedlings as carefully as possible to prevent damage.Most do that.</p>
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
                    <strong>6. Members of the different community nursery groups should know that the nursery is theirs and:</strong>
            </div>
        </div>
            <div class="row" >
        	<div class="col-md-12">
                    <strong>a) They should prepare the land for the seedling nursery</strong>
            </div>
         </div>
                     <div class="row">
        	<div class="col-md-12">
                    <strong>b) They should look for the seeds</strong>
            </div>
         </div>
                     <div class="row" >
        	<div class="col-md-12">
                   <strong>c) They should plant the seeds and put the seedlings in bags</strong>
            </div>
         </div>
                     <div class="row" >
        	<div class="col-md-12">
                    <strong>d) They should prepare the land for the seedling nursery</strong>
            </div>
         </div>
          <div class="row" >
        	<div class="col-md-12">
                   <strong>e) They should hold monitor the nursery attendants</strong>
            </div>
         </div>
         <div class="row" >
        	<div class="col-md-12">
                   <strong>f) They should ensure that the those planting the trees look at the holes and follow up on the trees</strong>
            </div>
         </div>
          <div class="row" >
        	<div class="col-md-12">
                    <strong>g) They should ensure that the nursery attendants assist them and guide them</strong>
            </div>
         </div>
         <div class="row" >
        	<div class="col-md-12">
                    <strong>h) They should prepare the land for the seedling nursery</strong>
            </div>
         </div>
          <div class="row" >
        	<div class="col-md-12">
                    <strong>i) They should pay their workers like road workers</strong>
            </div>
         </div>
         <div class="row" >
        	<div class="col-md-12">
                    <strong>j) The attendants and the members of the group help each other</strong>
            </div>
         </div>
         </br>
         <div class="row" >
        	<div class="col-md-12">
            <strong>
                  7. Have you started a plan to plant trees? If yes, use form VI(6). If you have not recieved the form(VI), make yours by writing the names of those who accepted and those who are willing to dig the holes.</strong>
            </div>
        </div>
        </br> 
        <div class="row" >
        	<div class="col-md-12">
            <strong>
                  8. Have you many holes have been dug and verified for the month of..............? Holes............. Have you sent the form VIII(8)?.................</strong>
            </div>
        </div>
        </br> 
 <div class="row" >
        	<div class="col-md-12">
                   <strong>9. All the money wll be depoited to your account. Please provide the details below. Account Number</strong><span style="text-decoration:underline"><?php echo '';?></span>
            </div>
        </div>
        <div class="row" >
        	<div class="col-md-12">
                   <strong>Signatories</strong>
            </div>
        </div>
            <div class="row" >
        	<div class="col-md-6">
                    <strong>(a)  </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
            <div class="col-md-6">
                   <strong>(b)  </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
        </div>
        <div class="row" >
        	<div class="col-md-6">
                    <strong>(c) </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
            <div class="col-md-6">
                   <strong>(d)  </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
                   <strong>10. How should your cheque be issued?</strong>...............................
            </div>
        </div>
        </br>
        <div class="row" >
        	<div class="col-md-12">
                   <strong>11. How many seedlings have been issued out in the month of.............?<p>The number of seedlings issued is?......</p>
                   Have you sent form IX(9)?
            </div>
        </div>
        </br> 
 <div class="row" >
        	<div class="col-md-12">
                   <strong>12. What is the name of the facilitator in your area?</strong><span style="text-decoration:underline"><?php echo '';?></span>
            </div>
        </div>
        <div class="row" >
        	<div class="col-md-12">
                   <strong>How many times times have they visited this month?</strong>
            </div>
        </div>
            <div class="row" >
        	<div class="col-md-6">
                    <strong>Date of First Visit  </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
            <div class="col-md-6">
                   <strong>Date of Second Visit   </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
        </div>
        <div class="row" >
        	<div class="col-md-6">
                    <strong>Date of Third Visit  </strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
            <div class="col-md-6">
                   <strong>Date of Fourth Visit</strong><span style="border-bottom: 1px dotted #000; padding-bottom:5px"><?php echo '';?></span>
            </div>
        </div>
        </br>
        <div class="row">
        	<div class="col-md-12">
            <strong>13. Write the names of the seedlings in your nursery. Fill in the names you know, the ones you don't are not a must.</strong>
            </div>
         </div>
         </br>
         <div>
         <table class="table table-bordered table-striped table-condensed">
         <th></th>
         <th>Local Language</th>
         <th>English Name</th>
         <th>Kiswahili name</th>
         <th>Scientific Name</th>
         <tr>
         <td>(i)</td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         </tr>
         <tr>
         <td>(ii)</td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         </tr>
         <tr>
         <td>(iii)</td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         </tr>
          <tr>
         <td>(iv)</td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         </tr>
         <tr>
         <td>(v)</td>
         <td></td>
         <td></td>
         <td></td>
         <td></td>
         </tr>
         </table>
         </div>
         <div class="row">
         	<div class="col-md-12">
            <strong>Total number of species:</strong>.....................
            </div>
         </div>
         </br>
         <div class="row">
        	<div class="col-md-12">
            <strong>14. Please give us any comments or feedback that you may have.</strong>
            </div>
         </div>
         <div class="row">
        	<div class="col-md-12">
            <strong>.............................................................</strong>
            </div>
         </div>
         </br>
         <div class="row">
        	<div class="col-md-12">
            <strong>15. We send you this information from our office.</strong>
            </div>
         </div>
         <div class="row">
        	<div class="col-md-12">
            <strong></strong>
            </div>
         </div>
         <div class="row">
        	<div class="col-md-12">
            <strong></strong>
            </div>
         </div>
         </br>
          <div class="row">
        	<div class="col-md-12">
            <strong>16. We thank you for all your wotk in restoring the country to its former state and saving our precious country. May you be blessed for all you hard work. Strive as hard as you can. 
            <p>
            Yours sincerely
            </p></strong>
            </div>
         </div>
    </body>
</html>