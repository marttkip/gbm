<?php

$rs2 = $this->ctn_model->get_order_items($order_id);


echo "
<table align='center' class='table table-striped table-hover table-condensed'>
	<tr>
		
		<th align='center'>Seedling Type</th>
		<th align='center'>Species Name</th>
		<th align='center'>Quantity</th>
		<th align='center'> Unit Price</th>
		<th align='center'>Total Amount</th>
		<th></th>
		<th></th>
	</tr>		
";                     
		$total= 0;  
		if($rs2->num_rows() > 0){
			foreach ($rs2->result() as $key1):
				$v_procedure_id = $key1->order_item_id;
				$species_name = $key1->species_name;
				$seedling_type_name = $key1->seedling_type_name;
				$order_item_quantity = $key1->order_item_quantity;
				$order_item_price = $key1->order_item_price;
			
				$total= $total +($order_item_quantity * $order_item_price);
				
				echo"
						<tr> 
							<td align='center'>".$seedling_type_name."</td>
							<td align='center'>".$species_name."</td>
							<td align='center'>
								<input type='text' id='units".$v_procedure_id."' value='".$order_item_quantity."' size='3' onkeyup='calculatetotal(".$order_item_price.",".$v_procedure_id.",".$order_id.")'/>
							</td>
							<td align='center'>".number_format($order_item_price)."</td>
							<td align='center'><input type='text' readonly='readonly' size='5' value='".$order_item_quantity * $order_item_price."' id='total".$v_procedure_id."'></div></td>
							<td>
							<a class='btn btn-sm btn-primary' href='#' onclick='calculatetotal(".$order_item_price.",".$v_procedure_id.", ".$order_id.")'><i class='fa fa-pencil'></i></a>
							</td>
							<td>
								<a class='btn btn-sm btn-danger' href='#' onclick='delete_procedure(".$v_procedure_id.", ".$order_id.")'><i class='fa fa-trash'></i></a>
							</td>
						</tr>	
				";
				endforeach;

		}
echo"
<tr bgcolor='#D9EDF7'>
<td></td>
<td></td>
<th>Grand Total: </th>
<th colspan='3'><div id='grand_total'>".number_format($total)."</div></th>
</tr>
 </table>
";
?>