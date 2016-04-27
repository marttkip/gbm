<?php
	if(count($contacts) > 0)
	{
		$email = $contacts['email'];
		$email2 = $contacts['email'];
		$logo = $contacts['logo'];
		$company_name = $contacts['company_name'];
		$phone = $contacts['phone'];
		
		if(!empty($facebook))
		{
			$facebook = '<li class="facebook"><a href="'.$facebook.'" target="_blank" title="Facebook">Facebook</a></li>';
		}
		
	}
	else
	{
		$email = '';
		$facebook = '';
		$twitter = '';
		$linkedin = '';
		$logo = '';
		$company_name = '';
		$google = '';
	}
?>
<?php
		
		$result = '';
		
		//if users exist display them
		if ($query->num_rows() > 0)
		{
			$count = $page;
			
			$result .= 
			'
			';
			
			//get all administrators
			$administrators = $this->personnel_model->retrieve_personnel();
			if ($administrators->num_rows() > 0)
			{
				$admins = $administrators->result();
			}
			
			else
			{
				$admins = NULL;
			}
			
			foreach ($query->result() as $row)
			{
				$project_area_id = $row->project_area_id;
				$project_area_name = $row->project_area_name;
				$project_area_status = $row->project_area_status;
				$project_area_latitude = $row->project_area_latitude;
				$project_area_longitude = $row->project_area_longitude;
				$created_by = $row->created_by;
				$modified_by = $row->modified_by;
				$last_modified = date('jS M Y H:i a',strtotime($row->last_modified));
				$created = date('jS M Y H:i a',strtotime($row->created));


				$where = 'project_areas.parent_project_area_id  = '.$project_area_id;
				$table = 'project_areas';

				// count target areas
				$totol_areas = $this->users_model->count_items($table, $where);


				$meeting_where = 'meeting.project_area_id  = '.$project_area_id;
				$meeting_table = 'meeting';

				// count target areas
				$totol_meetings = $this->users_model->count_items($meeting_table, $meeting_where);


				$community_where = 'is_ctn = 0 AND project_area_id  = '.$project_area_id;
				$community_table = 'community_group';

				// count target areas
				$totol_communities = $this->users_model->count_items($community_table, $community_where);



				$seedling_where = 'orders.order_id = order_receivables.order_id AND orders.project_area_id  = '.$project_area_id;
				$seedling_table = 'orders,order_receivables';
				$seedling_select = 'SUM(order_receivables.quantity_given) AS number';

				// count target areas
				$total_seedlings = $this->users_model->count_items_where($seedling_table, $seedling_where,$seedling_select);
				
				//create deactivated status display
				if($project_area_status == 0)
				{
					$status = '<span class="label label-default">Deactivated</span>';
					$button = '<a  href="'.site_url().'tree-planting/activate-project-area/'.$project_area_id.'" onclick="return confirm(\'Do you want to activate '.$project_area_name.'?\');" title="Activate '.$project_area_name.'"><i class="fa fa-thumbs-up mr-xs"></i> Activate</a>';
				}
				//create activated status display
				else if($project_area_status == 1)
				{
					$status = '<span class="label label-success">Active</span>';
					$button = '<a  href="'.site_url().'tree-planting/deactivate-project-area/'.$project_area_id.'" onclick="return confirm(\'Do you want to deactivate '.$project_area_name.'?\');" title="Deactivate '.$project_area_name.'"><i class="fa fa-thumbs-down mr-xs"></i> Deactivate</a>';
				}
				
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
				$count++;
				$result .= 
				'
					
					<div class="col-md-4">
						<section class="panel">
							<div class="panel-body panel-body-nopadding">
								<div class="owl-carousel owl-theme mb-md owl-loaded owl-drag owl-carousel-init" data-plugin-carousel="" data-plugin-options="{ &quot;dots&quot;: true, &quot;items&quot;: 1 }">
								<div class="panel-heading-picture center-align">
									<img src="'.base_url().'assets/logo/'.$logo.'">
								</div>
								<div class="p-md">

									<h4 class="text-weight-semibold mt-none center-align" style="margin-bottom:7px;">'.$project_area_name.'</h4>
									<div class="col-md-12">
										<div class="col-md-6">
											<p>Latitude <span class="pull-right label label-warning">'.$project_area_latitude.'</span></p>
										</div>
										<div class="col-md-6">
											<p> Longitude <span class="pull-right label label-info">'.$project_area_longitude.'</span></p>
										</div>
									</div>
									<div class="col-md-12">
										<div class="col-md-6">
											<p>Nurseries <span class="pull-right label label-default">'.$totol_communities.'</span></p>
										</div>
										<div class="col-md-6">
											<p> Areas Covered <span class="pull-right label label-default">'.$totol_communities.'</span></p>
										</div>
									</div>
									<div class="col-md-12">
										<div class="col-md-6">
											<p>Seedlings <span class="pull-right label label-default">'.$total_seedlings.'</span></p>
										</div>
										<div class="col-md-6">
											<p> Planted <span class="pull-right label label-default">0</span></p>
										</div>
									</div>
									<div class="col-md-12" style="margin-bottom:7px;">
									<p>
										<div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
											20% 
										</div>
									</p>
									</div>
									
								</div>
							</div>
							<div class="panel-footer panel-footer-btn-group" >
								<a href="'.site_url().'tree-planting/project-area-detail/'.$project_area_id.'" title="View '.$project_area_name.'"><i class="fa fa-folder-open mr-xs"></i> View</a>
								'.$button.'
								<a href="'.site_url().'tree-planting/delete-project-area/'.$project_area_id.'"  onclick="return confirm(\'Do you really want to delete '.$project_area_name.'?\');" title="Delete '.$project_area_name.'"><i class="fa fa-trash mr-xs"></i> Delete</a>

							</div>
						</section>
					</div>
				';
			}
			
			$result .= 
			'
			';
		}
		
		else
		{
			$result .= "There are no project areas";
		}
?>

<section class="panel">
	<header class="panel-heading">
		<h2 class="panel-title"><?php echo $title;?></h2>
		<a href="<?php echo site_url();?>tree-planting/add-project-area" class="btn btn-success btn-sm pull-right" style="margin-top:-25px;">Add Project Area</a>
	</header>
	<?php echo $this->load->view('projects/dashboard_header','',true)?>
</section>

<div class="row">
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
	
	<?php echo $result;?>

	<div class="panel-foot">
        
		<?php if(isset($links)){echo $links;}?>
    
        <div class="clearfix"></div> 
    
    </div>

</div>
<section class="panel">
	<div class="panel-body">
		<div class="col-md-12">
			<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		    <script type="text/javascript">
		      google.charts.load('current', {'packages':['corechart']});
		      google.charts.setOnLoadCallback(drawSeriesChart);

		    function drawSeriesChart() {

		      var data2 = google.visualization.arrayToDataTable([
		        ['ID', 'Life Expectancy', 'Fertility Rate', 'Region',     'Population'],
		        ['CAN',    80.66,              1.67,      'North America',  33739900],
		        ['DEU',    79.84,              1.36,      'Europe',         81902307],
		        ['DNK',    78.6,               1.84,      'Europe',         5523095],
		        ['EGY',    72.73,              2.78,      'Middle East',    79716203],
		        ['GBR',    80.05,              2,         'Europe',         61801570],
		        ['IRN',    72.49,              1.7,       'Middle East',    73137148],
		        ['IRQ',    68.09,              4.77,      'Middle East',    31090763],
		        ['ISR',    81.55,              2.96,      'Middle East',    7485600],
		        ['RUS',    68.6,               1.54,      'Europe',         141850000],
		        ['USA',    78.09,              2.05,      'North America',  307007000]
		      ]);

		      var options = {
		        title: 'Correlation between life expectancy, fertility rate ' +
		               'and population of some world countries (2010)',
		        hAxis: {title: 'Life Expectancy'},
		        vAxis: {title: 'Fertility Rate'},
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
	

