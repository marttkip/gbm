

<section class="panel panel-featured panel-featured-success">
   
    <div class="panel-body">
    	<?php echo $this->load->view('project_areas/project_area_header','',true);?>

    	<div class="row">

    		<div class="col-md-4">
    			<section class="panel">
					<header class="panel-heading bg-info">
						<h5 class="text-weight-semibold mt-sm text-center"><strong>STEP ONE :</strong> PRIORITIZING OF PROJECTS</h5>
					</header>
					<div class="panel-body text-center">
						<p>Target Areas (<?php echo $totol_areas;?>)</p>
					
					</div>
					<div class="panel-footer panel-footer-btn-group text-center" >
						<a href="<?php echo site_url();?>tree-planting/area-locations/<?php echo $project_area_id?>" ><i class="fa fa-folder-open mr-xs"></i> Target Areas</a>
					</div>
				</section>
    		</div>
    		<div class="col-md-4">
    			<section class="panel">
					<header class="panel-heading bg-info">
						<h5 class="text-weight-semibold mt-sm text-center"><strong>STEP TWO :</strong> TRAININGS AND WORKSHOPS </h5>
					</header>
					<div class="panel-body text-center">
						
						<p class="text-center">Total Trainings and Workshops (<?php echo $totol_meetings;?>)</p>
					
					</div>
					<div class="panel-footer panel-footer-btn-group text-center" >
						<a  href="<?php echo site_url();?>tree-planting/trainings/<?php echo $project_area_id;?>" ><i class="fa fa-folder-open mr-xs"></i> Meetings / Training</a>
					</div>
				</section>
    		</div>
    		<div class="col-md-4">
    			<section class="panel">
					<header class="panel-heading bg-info">
						<h5 class="text-weight-semibold mt-sm text-center"><strong>STEP THREE :</strong> COMMUNITY / NURSERY GROUPS</h5>
					</header>
					<div class="panel-body text-center">
						<p class="text-center">Total Community / Nursery groups (<?php echo $totol_communities;?>)</p>
						
					</div>
					<div class="panel-footer panel-footer-btn-group text-center" >
						<a  href="<?php echo site_url();?>tree-planting/community-groups/<?php echo $project_area_id;?>" ><i class="fa fa-folder-open mr-xs"></i> Commmunity / Nursery  Groups</a>
					</div>
				</section>
    		</div>
    		<div class="col-md-4">
    			<section class="panel">
					<header class="panel-heading bg-info">
						<h5 class="text-weight-semibold mt-sm text-center">STEP FOUR :</strong> SEEDLINGS PRODUCTION</h5>
					</header>
					<div class="panel-body text-center">
						
						<p class="text-center">Total Community groups (<?php echo $totol_communities;?>)</p>
						
					</div>
					<div class="panel-footer panel-footer-btn-group text-center" >
						<a href="<?php echo site_url();?>tree-planting/seedling-production/<?php echo $project_area_id;?>" ><i class="fa fa-folder-open mr-xs"></i>Seedling Production</a>
					</div>
				</section>
    		</div>
    		<div class="col-md-4">
    			<section class="panel">
					<header class="panel-heading bg-info">
						<h5 class="text-weight-semibold mt-sm text-center">STEP FIVE :</strong> GBM CENTRAL TREE NURSERY</h5>
					</header>
					<div class="panel-body text-center">
						<p class="text-center">Total Community groups (<?php echo $totol_communities;?>)</p>
						
					</div>
					<div class="panel-footer panel-footer-btn-group text-center" >
						<a href="<?php echo site_url();?>tree-planting/ctn-detail/<?php echo $project_area_id;?>" ><i class="fa fa-folder-open mr-xs"></i>CTN DETAILS</a>
					</div>
				</section>
    		</div>
    		<div class="col-md-4">
    			<section class="panel">
					<header class="panel-heading bg-info">
						<h5 class="text-weight-semibold mt-sm text-center">STEP FIVE :</strong> GBM CENTRAL TREE NURSERY</h5>
					</header>
					<div class="panel-body text-center">
						<p class="text-center">Total Community groups (<?php echo $totol_communities;?>)</p>
						
					</div>
					<div class="panel-footer panel-footer-btn-group text-center" >
						<a href="<?php echo site_url();?>tree-planting/ctn-detail/<?php echo $project_area_id;?>" ><i class="fa fa-folder-open mr-xs"></i>CTN DETAILS</a>
					</div>
				</section>
    		</div>

    		
    	</div>
		
	</div>

</section>
<div class="row">
	<div class="col-md-6">
		<section class="panel">
			<div class="panel-body">
				<?php
					$nursery_queries = $this->project_areas_model->get_project_areas_nurseries($project_area_id);
					$parameters3 = '';
					if($nursery_queries->num_rows() > 0)
					{
						
						foreach ($nursery_queries->result() as $key_items) {
							# code...
							$community_group_id = $key_items->community_group_id;
							$community_group_name = $key_items->community_group_name;

							// get the seedling supplied

							$seedling_where = 'community_group_id = '.$community_group_id;
							$seedling_table = 'community_group_member';

							// count target areas
							$group_members = $this->users_model->count_items($seedling_table, $seedling_where);

							$parameters3 .= "['$community_group_name',$group_members,'#b87333'],";

								
							}
						
					}
					// var_dump($parameters3); die();
				?>

				<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
				  <script type="text/javascript">
				    google.charts.load("current", {packages:['corechart']});
				    google.charts.setOnLoadCallback(drawChart);
				    function drawChart() {
				      var data = google.visualization.arrayToDataTable([
				        ["Nursery", "Members", { role: "style" } ],
				        <?php echo $parameters3;?>
				      ]);

				      var view = new google.visualization.DataView(data);
				      view.setColumns([0, 1,
				                       { calc: "stringify",
				                         sourceColumn: 1,
				                         type: "string",
				                         role: "annotation" },
				                       2]);

				      var options = {
				        title: "Density of Community / Nursery Groups , in No. of Members",
				        
				        height: 400,
				        bar: {groupWidth: "70%"},
				        legend: { position: "none" },
				      };
				      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
				      chart.draw(view, options);
				  }
				  </script>
				<div id="columnchart_values" style="width: 100%; height: 100%;"></div>

			</div>
		</section>
	</div>
	<div class="col-md-6">
		<section class="panel">
			<div class="panel-body">
					<?php
					
					$ctn_query = $this->project_areas_model->get_project_ctn($project_area_id);
						// var_dump($ctn_query); die();
					$parameters2 = "";
					if($ctn_query->num_rows() > 0)
					{
						// get the nurseries
						foreach ($ctn_query->result() as $key_ctn) {
							# code...
							$ctn_id = $key_ctn->community_group_id;
						}
						$nursery_queries = $this->project_areas_model->get_project_areas_nurseries($project_area_id);
					
						if($nursery_queries->num_rows() > 0)
						{
							
							foreach ($nursery_queries->result() as $key_items) {
								# code...
								$community_group_id = $key_items->community_group_id;
								$community_group_name = $key_items->community_group_name;

								// get the seedling supplied

								$seedling_where = 'orders.order_id = order_receivables.order_id AND orders.nursery_id = '.$community_group_id.' AND orders.ctn_id  = '.$ctn_id;
								$seedling_table = 'orders,order_receivables';
								$seedling_select = 'SUM(order_receivables.quantity_given) AS number';

								// count target areas
								$total_seedlings = $this->users_model->count_items_where($seedling_table, $seedling_where,$seedling_select);

								$parameters2 .= "['$community_group_name',$total_seedlings],";

									
								}
							
						}
					}
					?>
				    <script type="text/javascript">
				      google.charts.setOnLoadCallback(drawChart2);
				      function drawChart2() {
				        var data2 = google.visualization.arrayToDataTable([
				          ['Task', 'No. Of Seedlings'],
				          <?php echo $parameters2;?>
				        ]);

				        var options = {
				          title: 'Nurseries Seedling Contributions',
				          is3D: true,
				        };

				        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
				        chart.draw(data2, options);
				      }
				    </script>
			     <div id="piechart_3d" style="width: 100%; height: 400px;"></div>
			</div>
		</section>
	</div>
	<div class="col-md-12">
		<?php
		//  get community shades and the items they have planted
		// get the project areas under all the 
		$project_areas_child = $this->project_areas_model->all_project_areas_children($project_area_id);
		$parameters4 = '';
		if($project_areas_child->num_rows() > 0)
		{
			foreach ($project_areas_child->result() as $key_children) {
				# code...
				$child_id = $key_children->project_area_id;
				$child_name = $key_children->project_area_name;

				// generate number 

				// genetate another number

				// generate a greater number
				// $child_name = str_replace(' ', '', $child_name);

				// shorten the name
				// $shorten_name = $this->project_areas_model->get_random_string($child_name,3); 

				// $population = $this->project_areas_model->generateRandomInteger(7); 

				$seedlings = $this->project_areas_model->generateRandomInteger(4); 

				$survival = $this->project_areas_model->generateRandomInteger(3); 

				$population = $seedlings + $survival;
				$rate = $population/2;

				$parameters4 .= "['$child_name',$survival,$seedlings,$rate],";

			}
		}

		?>
		<script type="text/javascript">
		      google.charts.setOnLoadCallback(drawVisualization);


		      function drawVisualization() {
		        // Some raw data (not necessarily accurate)
		        var data = google.visualization.arrayToDataTable([
		         ['Target Areas', 'Planted Trees', 'Surviving Trees', 'Survival Rate'],
		         <?php echo $parameters4;?>
		      ]);

		    var options = {
		      title : 'Target Areas Survival Rate',
		      vAxis: {title: 'Survival Rate'},
		      hAxis: {title: 'Target Areas'},
		      seriesType: 'bars',
		      series: {2: {type: 'line'}}
		    };

		    var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
		    chart.draw(data, options);
		  }
		    </script>
		 <div id="chart_div" style="width: 100%; height: 400px;"></div>
	</div>
</div>
