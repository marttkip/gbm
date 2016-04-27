<section class="panel panel-featured panel-featured-info">
    <header class="panel-heading">
         <h2 class="panel-title pull-left"><?php echo $title;?></h2>
         <div class="widget-icons pull-right">
            	<a href="<?php echo base_url();?>tree-planting/project-areas" class="btn btn-info btn-sm">Back to project areas</a>
          </div>
          <div class="clearfix"></div>
    </header>
    <div class="panel-body">
    	<div class="row">
    		<div class="col-md-4">
    			<section class="panel">
					<header class="panel-heading bg-info">
						<h4 class="text-weight-semibold mt-sm text-center"><strong>STEP ONE :</strong> PRIORITIZING OF PROJECTS</h4>
					</header>
					<div class="panel-body text-center">
						<p>Target Areas (<?php echo $totol_areas;?>)</p>
						<p>
								<a href="<?php echo site_url();?>tree-planting/edit-project-area/<?php echo $project_area_id?>" class="btn btn-info btn-sm"><i class="fa fa-folder-open"></i> Project Area Detail</a>
								<a href="<?php echo site_url();?>tree-planting/area-locations/<?php echo $project_area_id?>" class="btn btn-warning btn-sm"><i class="fa fa-eye"></i> View Target Areas  </a>
							</p>
					</div>
				</section>
    		</div>
    		<div class="col-md-4">
    			<section class="panel">
					<header class="panel-heading bg-warning">
						<h4 class="text-weight-semibold mt-sm text-center"><strong>STEP TWO :</strong> TRAININGS AND WORKSHOPS </h4>
					</header>
					<div class="panel-body text-center">
						
						<p class="text-center">Total Trainings and Workshops (<?php echo $totol_meetings;?>)</p>
						<p>
							<a href="<?php echo site_url();?>tree-planting/trainings/<?php echo $project_area_id;?>" class="btn btn-info btn-sm"><i class="fa fa-folder-open"></i> View Meetings</a>
							<a class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add target Areas  </a>
						</p>
					</div>
				</section>
    		</div>
    		<div class="col-md-4">
    			<section class="panel">
					<header class="panel-heading bg-success">
						<h4 class="text-weight-semibold mt-sm text-center"><strong>STEP THREE :</strong> COMMUNITY / NURSERY GROUPS</h4>
					</header>
					<div class="panel-body text-center">
						<p class="text-center">Total Community groups (<?php echo $totol_communities;?>)</p>
						<p>
							<a href="<?php echo site_url();?>tree-planting/community-groups/<?php echo $project_area_id;?>" class="btn btn-info btn-sm"><i class="fa fa-folder-open"></i> Commmunity Groups</a>
							<a class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Add target Areas  </a>
						</p>
					</div>
				</section>
    		</div>
    		<div class="col-md-4">
    			<section class="panel">
					<header class="panel-heading bg-info">
						<h4 class="text-weight-semibold mt-sm text-center">STEP FOUR :</strong> SEEDLINGS PRODUCTION AND VERIFICATION (FORM 5) </h4>
					</header>
					<div class="panel-body text-center">
						
						<p class="text-center">Total Community groups (<?php echo $totol_communities;?>)</p>
						<p>
							<a href="<?php echo site_url();?>tree-planting/seedling-production/<?php echo $project_area_id;?>" class="btn btn-info btn-sm"><i class="fa fa-folder-open"></i> Seedling Production</a>
						</p>
					</div>
				</section>
    		</div>
    		<div class="col-md-4">
    			<section class="panel">
					<header class="panel-heading bg-warning">
						<h4 class="text-weight-semibold mt-sm text-center">STEP FIVE :</strong> GBM CENTRAL TREE NURSERY (FORM 9) </h4>
					</header>
					<div class="panel-body text-center">
						<p class="text-center">Total Community groups (<?php echo $totol_communities;?>)</p>
						<p>
							<a href="<?php echo site_url();?>tree-planting/ctn-detail/<?php echo $project_area_id;?>" class="btn btn-info btn-sm"><i class="fa fa-folder-open"></i> GO</a>
						</p>
					</div>
				</section>
    		</div>
    		<div class="col-md-4">
    			<section class="panel">
					<header class="panel-heading bg-primary">
						<div class="panel-heading-icon">
							<i class="fa fa-globe"></i>
						</div>
					</header>
					<div class="panel-body text-center">
						<h4 class="text-weight-semibold mt-sm text-center">Simple Block Title</h4>
						<p class="text-center">Nullam quiris risus eget urna mollis ornare vel eu leo. Soccis natoque penatibus et magnis dis parturient montes. Soccis natoque penatibus et magnis dis parturient montes.</p>
					</div>
				</section>
    		</div>

    		
    	</div>
		
	</div>

</section>

