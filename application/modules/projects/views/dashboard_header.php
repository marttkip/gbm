<?php
// get total projects
$where = 'project_areas.project_area_status = 1 AND parent_project_area_id = 0';
$table = 'project_areas';

// count target areas
$total_projects = $this->users_model->count_items($table, $where);
// get active areas over projects
$area_where = 'project_areas.project_area_status = 1 AND parent_project_area_id <> 0';
$area_table = 'project_areas';

// count target areas
$total_project_areas = $this->users_model->count_items($area_table, $area_where);
// get commmunity groups / nurseries

$community_where = 'community_group_status = 1';
$community_table = 'community_group';

// count target areas
$totol_communities = $this->users_model->count_items($community_table, $community_where);


$community_where = 'community_group_member_status = 1';
$community_table = 'community_group_member';

// count target areas
$total_communities_members = $this->users_model->count_items($community_table, $community_where);

// hired persons


// Planted /surviving trees

// 

?>
<div class="panel-body center-align">
	<div class="col-md-2">
		<div class="h4 text-weight-bold mb-none"><?php echo $total_projects;?></div>
		<p class="text-xs text-muted mb-none">Total Projects</p>

	</div>
	<div class="col-md-2">
		<div class="h4 text-weight-bold mb-none"><?php echo $total_project_areas;?></div>
		<p class="text-xs text-muted mb-none">Areas Covered</p>
	</div>
	<div class="col-md-2">
		<div class="h4 text-weight-bold mb-none"><?php echo $totol_communities;?> | <?php echo $total_communities_members;?></div>
		<p class="text-xs text-muted mb-none">Community Groups | Members</p>
	</div>
	
	<div class="col-md-2">
		<div class="h4 text-weight-bold mb-none">488</div>
		<p class="text-xs text-muted mb-none">Hired Persons</p>
	</div>
	<div class="col-md-2">
		<div class="h4 text-weight-bold mb-none">48/200</div>
		<p class="text-xs text-muted mb-none">Planted / Surviving Trees</p>
	</div>
	<div class="col-md-2 success">
		<div class="h4 text-weight-bold mb-none">100%</div>
		<p class="text-xs text-muted mb-none"> Success Rate</p>
	</div>
</div>
