<section class="panel">
	<div class="panel-body">
		<div class="col-md-12">
			<?php
			$this->load->model('projects/project_areas_model');
			$project_areas = $this->project_areas_model->all_project_areas_parent();
			$parameters2 = "";
			if($project_areas->num_rows() > 0)
			{
				foreach ($project_areas->result() as $key_areas) {
					# code...
					$project_area_id = $key_areas->project_area_id;
					$project_area_name = $key_areas->project_area_name;

					// get the project areas under all the 
					$project_areas_child = $this->project_areas_model->all_project_areas_children($project_area_id);
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

							$parameters2 .= "['$child_name',$survival,$seedlings,'$project_area_name',$population],";

						}
					}
				}
			}
				// var_dump($parameters2); die();
			?>
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		    <script type="text/javascript">
		      google.charts.load('current', {'packages':['corechart']});
		      google.charts.setOnLoadCallback(drawSeriesChart);


		    function drawSeriesChart() {

		      var data2 = google.visualization.arrayToDataTable([
		        ['ID', 'Surviving Trees', 'Planted Seedlings', 'Project Area',     'Total Seedlings'],
		        <?php echo $parameters2;?>
		      ]);

		      var options = {
		        title: 'Correlation between Planted Seedlings, Surviving Seedlings ' +
		               'and population of the whole seedlings (<?php echo date('Y');?>)',
		        hAxis: {title: 'Surviving Trees'},
		        vAxis: {title: 'Planted Seedlings'},
		        bubble: {textStyle: {fontSize: 11}}
		      };

		      var chart = new google.visualization.BubbleChart(document.getElementById('series_chart_div'));
		      chart.draw(data2, options);
		    }
		    </script>
		    <div id="series_chart_div" style="width: 100%; height: 500px;"></div>
		</div>
	</div>
</section>