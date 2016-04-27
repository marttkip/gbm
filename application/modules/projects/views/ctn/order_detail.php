<section class="panel">
	<header class="panel-heading">
		<h2 class="panel-title">Order</h2>

		<a href="<?php echo site_url();?>tree-planting/ctn-detail/<?php echo $parent_project_area_id?>" class="btn btn-warning btn-sm pull-right" style="margin-top:-25px;"> <i class="fa fa-print"></i> GENERATE LPO</a>
		
	</header>
	<div class="panel-body">
		<div class="row">
			<?php echo form_open("tree-planting/add-order-item/".$order_id."/".$project_area_id."/".$ctn_id."", array("class" => "form-horizontal", "role" => "form"));?>
	          
            	<div class="row ">
	                <div class="col-md-6">
	                    <div class="form-group">
	                        <label class="col-lg-4 control-label">Seedling Type</label>
	                        <div class="col-lg-8">
	                            <select id='seedling_type_id' name='seedling_type_id' class='form-control custom-select ' required>
	                              <option value=''>None - Please Select a seedling Type</option>
	                              <?php echo $seedling_type_list;?>
	                            </select>
	                        </div>
	                    </div>
	                    <div class="form-group center-align">
	                        <label class="col-lg-4 control-label">Order Quantity</label>
	                        <div class="col-lg-7">
	                            <input type="text" class="form-control" name="quantity" placeholder="Area name" value="" required>
	                        </div>
	                    </div>

	                </div>
	                 <div class="col-md-6">
						<div class="form-group">
	                        <label class="col-lg-4 control-label">Seedling Species</label>
	                        <div class="col-lg-8">
	                            <select id='species_id' name='species_id' class='form-control custom-select ' required>
	                              <option value=''>None - Please Select a species</option>
	                              <?php echo $species_list;?>
	                            </select>
	                        </div>
	                    </div>
	                    <div class="form-group center-align">
	                        <label class="col-lg-4 control-label">Price</label>
	                        <div class="col-lg-7">
	                            <input type="text" class="form-control" name="price" placeholder="Area name" value="" required>
	                        </div>
	                    </div>
	                 </div>
	            </div>
	             <br />
	             <div class="row ">
		            <div class="form-actions center-align">
		                <button class="submit btn btn-sm btn-primary" type="submit">
		                    Create a Order
		                </button>
		            </div>
	            </div>
	            <br />
	        <?php echo form_close();?>
			
		</div>
		 <hr>
		<div class="row">
			<div id="order_items"></div>
		</div>
	</div>
</section>