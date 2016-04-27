<?php
$contacts = $this->site_model->get_contacts();
$v_data['contacts'] = $contacts;
	if(count($contacts) > 0)
	{
		$logo = $contacts['logo'];
	}
	else
	{
		$logo = '';
	}

	// get project area details
	if(isset($parent_project_area_id))
	{
		$project_area_id = $parent_project_area_id;
	}
	$this->load->model('projects/project_areas_model');
	$project_area_rs = $this->project_areas_model->get_project_area($project_area_id);

	if($project_area_rs->num_rows() > 0)
	{
		$row = $project_area_rs->result();
		$project_area_id = $row[0]->project_area_id;
		$project_area_name = $row[0]->project_area_name;
		$project_area_latitude = $row[0]->project_area_latitude;
		$project_area_longitude = $row[0]->project_area_longitude;
	}


	$where = 'project_areas.parent_project_area_id  = '.$project_area_id;
	$table = 'project_areas';

	// count target areas
	$totol_areas = $this->users_model->count_items($table, $where);


	$meeting_where = 'meeting.project_area_id  = '.$project_area_id;
	$meeting_table = 'meeting';

	// count target areas
	$totol_meetings = $this->users_model->count_items($meeting_table, $meeting_where);


	$community_where = 'project_area_id  = '.$project_area_id;
	$community_table = 'community_group';

	// count target areas
	$totol_communities = $this->users_model->count_items($community_table, $community_where);

	$seedling_where = 'orders.order_id = order_receivables.order_id AND orders.project_area_id  = '.$project_area_id;
	$seedling_table = 'orders,order_receivables';
	$seedling_select = 'SUM(order_receivables.quantity_given) AS number';

	// count target areas
	$total_seedlings = $this->users_model->count_items_where($seedling_table, $seedling_where,$seedling_select);
?>
<div class="row">
	<div class="col-md-6 col-lg-6 col-xl-3">
		<section class="panel panel-featured-left panel-featured-success">
			<div class="panel-body">
				<div class="widget-summary">
					<div class="widget-summary-col widget-summary-col-icon">
						<div class="summary-icon bg-default">
							<img src="<?php echo base_url()?>assets/logo/<?php echo $logo?>" style="width:100%">
						</div>
					</div>
					<div class="widget-summary-col">
						<div class="summary">
							<h4 class="title"><?php echo $project_area_name;?></h4>
							<div class="info">
							<span class="label label-info">Latitude <?php echo $project_area_latitude;?></span>
							<span class="label label-warning">Logitude <?php echo $project_area_longitude;?></span>

							</div>
						</div>
						<div class="summary-footer">
							<!-- <a class="text-muted text-uppercase">(view all)</a> -->
							<a href="<?php echo base_url();?>tree-planting/edit-project-area/<?php echo $project_area_id?>" class="btn btn-success btn-xs"> <i class="fa fa-pencil"></i> Edit Information</a>
							<a href="<?php echo base_url();?>tree-planting/project-areas" class="btn btn-info btn-xs"> <i class="fa fa-arrow-left"></i> Back to project areas</a>
						</div>
					</div>
				</div>
			</div>
		</section>
	</div>
	<div class="col-md-6 col-lg-6 col-xl-3">
		<section class="panel panel-featured-right panel-featured-success">
			<div class="panel-body">
				<div class="widget-summary">
					<div class="widget-summary-col widget-summary-col-icon">
						<span class="label label-success">Total Nurseries : <?php echo $totol_communities;?></span><br>
						<span class="label label-success">Areas Covered : <?php echo $totol_areas;?></span><br>
						<span class="label label-success">Trainings Done :<?php echo $totol_meetings;?></span><br>
						<span class="label label-success">Seedlings CTN : <?php echo $total_seedlings;?></span><br>
					</div>
					<div class="widget-summary-col">
						<div class="summary">
							<div class="col-md-3 center-align">
								<div class="h4 text-weight-bold mb-none"><?php echo $total_seedlings?></div>
								<p class="text-xs text-muted mb-none">Seedlings</p>
							</div>
							<div class="col-md-3 center-align">
								<div class="h4 text-weight-bold mb-none">488</div>
								<p class="text-xs text-muted mb-none">Persons Hired</p>
							</div>
							<div class="col-md-3 center-align">
								
								<div class="h4 text-weight-bold mb-none">40</div>
								<p class="text-xs text-muted mb-none">Surviving Trees</p>
							</div>
							<div class="col-md-3 center-align">
								<div class="h4 text-weight-bold mb-none">100%</div>
								<p class="text-xs text-muted mb-none">Success Rate</p>
							</div>
						</div>
						<div class="summary-footer">
							<!-- <a class="text-muted text-uppercase">(view all)</a> -->
							<a href="#" class="btn btn-warning btn-xs"> <i class="fa fa-print"></i> Target Area</a>
							<a href="#" class="btn btn-warning btn-xs"> <i class="fa fa-print"></i> Seedling Survival</a>
						</div>
						
					</div>

				</div>
			</div>
		</section>
	</div>
</div>