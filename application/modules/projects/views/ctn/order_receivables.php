<section class="panel">
	<header class="panel-heading">
		<h2 class="panel-title">Order</h2>

		<a href="<?php echo site_url();?>tree-planting/ctn-detail/<?php echo $parent_project_area_id?>" class="btn btn-warning btn-sm pull-right" style="margin-top:-25px;"> <i class="fa fa-print"></i> GENERATE FORM 9</a>
		
	</header>
	<div class="panel-body">
		<div class="row">
			<?php echo form_open("tree-planting/add-order-receivables/".$order_id."/".$project_area_id."/".$ctn_id."", array("class" => "form-horizontal", "role" => "form"));?>
	          
            	<div class="row ">
	                <div class="col-md-6">
	                    <div class="form-group">
	                        <label class="col-lg-4 control-label">Seedling Type</label>
	                        <div class="col-lg-8">
	                            <select id='personnel_id' name='personnel_id' class='form-control custom-select ' required>
	                              <option value=''>None - Please Select GBM Personnel</option>
	                              <?php echo $personnel_list;?>
	                            </select>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-lg-4 control-label">Date Given</label>
	                        <div class="col-lg-7">
	                            <div class="input-group">
				                    <span class="input-group-addon">
				                        <i class="fa fa-calendar"></i>
				                    </span>
				                    <input data-format="yyyy-MM-dd" type="text" data-plugin-datepicker class="form-control" name="date_given" placeholder="Date Given" value="">
				                </div>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-lg-4 control-label">Quantity Given</label>
	                        <div class="col-lg-7">
	                            <input type="text" class="form-control" name="quantity" placeholder="Quantity Given" value="" required>
	                        </div>
	                    </div>

	                </div>
	                 <div class="col-md-6">
						<div class="form-group">
	                        <label class="col-lg-4 control-label">Fruit Tree</label>
	                        <div class="col-lg-7">
	                            <input type="text" class="form-control" name="fruit_trees" placeholder="Fruit Trees" value="" required>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-lg-4 control-label">Indegenous Tree</label>
	                        <div class="col-lg-7">
	                            <input type="text" class="form-control" name="indegenous_trees" placeholder="Indegenous Trees" value="" required>
	                        </div>
	                    </div>
	                    <div class="form-group">
	                        <label class="col-lg-4 control-label">Exotic Trees</label>
	                        <div class="col-lg-7">
	                            <input type="text" class="form-control" name="exotic_trees" placeholder="Exotic Trees" value="" required>
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