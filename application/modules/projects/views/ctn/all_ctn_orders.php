<?php

$result = '';
// var_dump($query); die();
if($query->num_rows() == 1)
{
	$count = $page;
	$result .= 
	'
	<table class="table table-bordered mb-none">
		<thead>
			<tr>
				<th>#</th>
				<th>Order Number</th>
				<th>Nursery Name</th>
				<th>T. Request Seedlings</th>
				<th>T. Delivered Seedlings</th>
				<th>Modified by</th>
				<th>Status</th>
				<th colspan="5">Actions</th>
			</tr>
		</thead>
		
		<tbody>
	';
	$administrators = $this->personnel_model->retrieve_personnel();
	if ($administrators->num_rows() > 0)
	{
		$admins = $administrators->result();
	}
	
	else
	{
		$admins = NULL;
	}

	foreach ($query->result() as $key) {
		# code...
		$modified_by = $key->modified_by;
		$created_by = $key->created_by;

		$nursery_name  = $key->community_group_name;
		$order_number  = $key->order_number;
		$order_id  = $key->order_id;
		$order_status_id  = $key->order_status_id;
		$total_ordered_seedlings  = 0;
		$total_received_seedlings  = 0;

		//creators & editors
		if($admins != NULL)
		{
			foreach($admins as $adm)
			{
				$user_id = $adm->personnel_id;
				
				if($user_id == $created_by)
				{
					$created_by = $adm->personnel_fname;
				}
				
				if($user_id == $modified_by)
				{
					$modified_by = $adm->personnel_fname;
				}
			}
		}
		
		else
		{
		}
		//create deactivated status display
				if($order_status_id == 0)
				{
					$status = '<span class="label label-default">Deactivated</span>';
					$button = '<a class="btn btn-info btn-sm" href="'.site_url().'tree-planting/activate-area-location/'.$parent_project_area_id.'/'.$ctn_id.'/'.$order_id.'" onclick="return confirm(\'Do you want to activate '.$order_number.'?\');" title="Activate '.$order_number.'"><i class="fa fa-thumbs-up"></i></a>';
				}
				//create activated status display
				else if($order_status_id == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a class="btn btn-default btn-sm" href="'.site_url().'tree-planting/deactivate-area-location/'.$parent_project_area_id.'/'.$ctn_id.'/'.$order_id.'" onclick="return confirm(\'Do you want to deactivate '.$order_number.'?\');" title="Deactivate '.$order_number.'"><i class="fa fa-thumbs-down"></i></a>';
				}
				
		$count++;
		$result .= 
		'
			<tr>
				<td>'.$count.'</td>
				<td>'.$order_number.'</td>
				<td>'.$nursery_name.'</td>
				<td>'.$total_ordered_seedlings.'</td>
				<td>'.$total_received_seedlings.'</td>
				<td>'.$modified_by.'</td>
				<td>'.$status.'</td>
				<td>
					<a  class="btn btn-sm btn-success" id="open_tenant_info'.$order_id.'" onclick="get_tenant_info('.$order_id.');" ><i class="fa fa-folder"></i> Order Details</a>
					<a  class="btn btn-sm btn-warning" id="close_tenant_info'.$order_id.'" style="display:none;" onclick="close_tenant_info('.$order_id.')"><i class="fa fa-folder-open"></i> Close Order Deatil</a>
				</td>
				<td>
					<a  class="btn btn-sm btn-info" id="open_receivers'.$order_id.'" onclick="get_items_received('.$order_id.');" ><i class="fa fa-folder"></i> Receivables</a>
					<a  class="btn btn-sm btn-warning" id="close_receivers'.$order_id.'" style="display:none;" onclick="close_items_received('.$order_id.')"><i class="fa fa-folder-open"></i> Close Receivables</a>
				</td>
				<td>
					<a href="#user'.$order_id.'" class="btn btn-sm btn-warning" data-toggle="modal" title="Expand '.$order_number.'"><i class="fa fa-eye"></i></a>
					<!-- Button to trigger modal -->
							
							<!-- Modal -->
							<div id="user'.$order_id.'" class="modal fade modal-full" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
											<h4 class="modal-title">'.$order_number.'</h4>
										</div>
										
										<div class="modal-body">

										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default" data-dismiss="modal" aria-hidden="true">Close</button>
											
										</div>
									</div>
								</div>
							</div>
				</td>
				<td>'.$button.'</td>
				<td><a href="'.site_url().'tree-planting/delete-area-location/'.$order_id.'" class="btn btn-sm btn-danger" onclick="return confirm(\'Do you really want to delete '.$order_number.'?\');" title="Delete '.$order_number.'"><i class="fa fa-trash"></i></a></td>
			</tr>
		';
		$v_data['order_id'] = $order_id;
		$v_data['seedling_type_list'] = $seedling_type_list;
		$v_data['species_list'] = $species_list;
		$v_data['project_area_id'] = $parent_project_area_id;
		$v_data['personnel_list'] = $personnel_list;
		$v_data['ctn_id'] = $ctn_id;
		$result .= '<tr id="tenant_info'.$order_id.'" style="display:none;">
							<td colspan="12">
								'.$this->load->view("order_detail", $v_data, TRUE).'
							</td>
						</tr>';
		$result .= '<tr id="receivers'.$order_id.'" style="display:none;">
							<td colspan="12">
								'.$this->load->view("order_receivables", $v_data, TRUE).'
							</td>
						</tr>';


	}
	$result .= 
			'
						  </tbody>
						</table>
			';
}else
{
	$result .= 'Nothing added';
}
?>

<div class="row">
	<section class="panel">
		<header class="panel-heading">
			<h2 class="panel-title"><?php echo $title;?></h2>

			<a href="<?php echo site_url();?>tree-planting/ctn-detail/<?php echo $parent_project_area_id?>" class="btn btn-info btn-sm pull-right" style="margin-top:-25px;">Back to CTN Detail</a>
			
		</header>
		<div class="panel-body">

			<?php
			$error = $this->session->userdata('error_message');
			$success = $this->session->userdata('success_message');
			
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
			<div class="table-responsive">
				<?php echo $result;?>	
			</div>
		</div>
	</section>
</div>
<script type="text/javascript">
	$(function() {
	    $("#seedling_type_id").customselect();
	    $("#species_id").customselect();
	    $("#personnel_id").customselect();
	});
	$(document).ready(function(){
		$(function() {
			$("#seedling_type_id").customselect();
			$("#species_id").customselect();
			$("#personnel_id").customselect();
		});
	});
	// tenant_info
	function get_tenant_info(order_id){

		var myTarget3 = document.getElementById("receivers"+order_id);
		var button4 = document.getElementById("open_receivers"+order_id);
		var button5 = document.getElementById("close_receivers"+order_id);

		myTarget3.style.display = 'none';
		button4.style.display = '';
		button5.style.display = 'none';

		var myTarget2 = document.getElementById("tenant_info"+order_id);
		var button = document.getElementById("open_tenant_info"+order_id);
		var button2 = document.getElementById("close_tenant_info"+order_id);

		myTarget2.style.display = '';
		button.style.display = 'none';
		button2.style.display = '';
		order_items(order_id);
	}
	function close_tenant_info(order_id){
		var myTarget3 = document.getElementById("receivers"+order_id);
		var button4 = document.getElementById("open_receivers"+order_id);
		var button5 = document.getElementById("close_receivers"+order_id);

		myTarget3.style.display = 'none';
		button4.style.display = '';
		button5.style.display = 'none';

		var myTarget2 = document.getElementById("tenant_info"+order_id);
		var button = document.getElementById("open_tenant_info"+order_id);
		var button2 = document.getElementById("close_tenant_info"+order_id);

		myTarget2.style.display = 'none';
		button.style.display = '';
		button2.style.display = 'none';
		order_items(order_id);
	}
	function get_items_received(order_id)
	{

		var myTarget2 = document.getElementById("tenant_info"+order_id);
		var button = document.getElementById("open_tenant_info"+order_id);
		var button2 = document.getElementById("close_tenant_info"+order_id);

		myTarget2.style.display = 'none';
		button.style.display = '';
		button2.style.display = 'none';

		var myTarget3 = document.getElementById("receivers"+order_id);
		var button4 = document.getElementById("open_receivers"+order_id);
		var button5 = document.getElementById("close_receivers"+order_id);

		myTarget3.style.display = '';
		button4.style.display = 'none';
		button5.style.display = '';

		order_items(order_id);
	}
	function close_items_received(order_id){
		var myTarget2 = document.getElementById("tenant_info"+order_id);
		var button = document.getElementById("open_tenant_info"+order_id);
		var button2 = document.getElementById("close_tenant_info"+order_id);

		myTarget2.style.display = 'none';
		button.style.display = '';
		button2.style.display = 'none';
		

		var myTarget3 = document.getElementById("receivers"+order_id);
		var button4 = document.getElementById("open_receivers"+order_id);
		var button5 = document.getElementById("close_receivers"+order_id);

		myTarget3.style.display = 'none';
		button4.style.display = '';
		button5.style.display = 'none';

		order_items(order_id);
	}
	function order_items(order_id){
       
        var XMLHttpRequestObject = false;
            
        if (window.XMLHttpRequest) {
        
            XMLHttpRequestObject = new XMLHttpRequest();
        } 
            
        else if (window.ActiveXObject) {
            XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
        }
        
        var url = "<?php echo site_url();?>tree-planting/get-order-items/"+order_id;
       
         if(XMLHttpRequestObject) {
                    
            XMLHttpRequestObject.open("GET", url);
                    
            XMLHttpRequestObject.onreadystatechange = function(){
                
                if (XMLHttpRequestObject.readyState == 4 && XMLHttpRequestObject.status == 200) {

                    document.getElementById("order_items").innerHTML=XMLHttpRequestObject.responseText;
                }
            }
                    
            XMLHttpRequestObject.send(null);
        }

    }
     $(document).on("submit","form#action_point_form",function(e)
     {
     alert("sdagdshag");
      e.preventDefault();
      
      var formData = new FormData(this);
      alert(formData);
      
       var order_id = $(this).attr('order_id');
      $.ajax({
       type:'POST',
       url: $(this).attr('action'),
       data:formData,
       cache:false,
       contentType: false,
       processData: false,
       dataType: 'json',
       success:function(data){
        
        if(data.result == "success")
        {
            alert('The action point has been successfully added.');
             parent.location ='<?php echo base_url(); ?>calendar';   
        }
        else
        {
            alert('Sorry, something went wrong make sure your have rated and entered your name.');
        }
       },
       error: function(xhr, status, error) {
        alert("XMLHttpRequest=" + xhr.responseText + "\ntextStatus=" + status + "\nerrorThrown=" + error);
       
       }
      });
      return false;
     });

</script>