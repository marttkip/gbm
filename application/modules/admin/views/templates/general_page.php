<?php 
	
	if(!isset($contacts))
	{
		$contacts = $this->site_model->get_contacts();
	}
	$data['contacts'] = $contacts; 

?>
<!doctype html>
<html class="fixed sidebar-left-collapsed">
	<head>
        <?php echo $this->load->view('admin/includes/header', $contacts, TRUE); ?>
    </head>

	<body>
    	<input type="hidden" id="base_url" value="<?php echo site_url();?>">
    	<input type="hidden" id="config_url" value="<?php echo site_url();?>">
    	<!--[if lt IE 7]>
            <p class="chromeframe">You are using an outdated browser. <a href="http://browsehappy.com/">Upgrade your browser today</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to better experience this site.</p>
        <![endif]-->
    	<section class="body">
            <!-- Top Navigation -->
            <?php echo $this->load->view('admin/includes/top_navigation', $data, TRUE); ?>
            
            <div class="inner-wrapper">
            	<?php echo $this->load->view('admin/includes/sidebar', '', TRUE); ?>
                
                <section role="main" class="content-body">
                	
            		<header class="page-header">
						<h2><?php echo $title;?></h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<?php echo $this->admin_model->create_breadcrumbs($title);?>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>
                    
					<?php echo $content;?>
                
                </section>
            </div>
            
        </section>
        <script type="text/javascript">
    var map = new GMap2(document.getElementById("map_1"));
    //var start = new GLatLng(65,25);
    map.setCenter(new GLatLng(-1.265385,36.816444), 12);
    map.addControl(new GMapTypeControl(1));
    map.addControl(new GLargeMapControl());

    map.enableContinuousZoom();
    map.enableDoubleClickZoom();



    // "tiny" marker icon
    var icon = new GIcon();
    icon.image = "http://labs.google.com/ridefinder/images/mm_20_red.png";
    icon.shadow = "http://labs.google.com/ridefinder/images/mm_20_shadow.png";
    icon.iconSize = new GSize(12, 20);
    icon.shadowSize = new GSize(22, 20);
    icon.iconAnchor = new GPoint(6, 20);
    icon.infoWindowAnchor = new GPoint(5, 1);



    /////Draggable markers




    var point = new GLatLng(-1.265385,36.816444);
    var markerD2 = new GMarker(point, {icon:G_DEFAULT_ICON, draggable: true}); 
    map.addOverlay(markerD2);

    markerD2.enableDragging();

    GEvent.addListener(markerD2, "drag", function(){
    document.getElementById("location").value=markerD2.getPoint().toUrlValue();
    });





    ////Mouse pointer

    GEvent.addListener(map, "mousemove", function(point){
    document.getElementById("mouse").value=point.toUrlValue();
    });

    // second map items

    var map_destination = new GMap2(document.getElementById("map_2"));
    //var start = new GLatLng(65,25);
    map_destination.setCenter(new GLatLng(-1.265385,36.816444), 12);
    map_destination.addControl(new GMapTypeControl(1));
    map_destination.addControl(new GLargeMapControl());

    map_destination.enableContinuousZoom();
    map_destination.enableDoubleClickZoom();



    // "tiny" marker icon
    var icon = new GIcon();
    icon.image = "http://labs.google.com/ridefinder/images/mm_20_red.png";
    icon.shadow = "http://labs.google.com/ridefinder/images/mm_20_shadow.png";
    icon.iconSize = new GSize(12, 20);
    icon.shadowSize = new GSize(22, 20);
    icon.iconAnchor = new GPoint(6, 20);
    icon.infoWindowAnchor = new GPoint(5, 1);



    /////Draggable markers




    var point = new GLatLng(-1.265385,36.816444);
    var markerD2 = new GMarker(point, {icon:G_DEFAULT_ICON, draggable: true}); 
    map_destination.addOverlay(markerD2);

    markerD2.enableDragging();

    GEvent.addListener(markerD2, "drag", function(){
    document.getElementById("location_destination").value=markerD2.getPoint().toUrlValue();
    });





    ////Mouse pointer

    GEvent.addListener(map, "mousemove", function(point){
    document.getElementById("mouse").value=point.toUrlValue();
    });


    //]]>
    </script>
        
        <!-- Vendor -->
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jquery/jquery.js"></script>

		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jquery-cookie/jquery.cookie.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/bootstrap/js/bootstrap.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/nanoscroller/nanoscroller.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/magnific-popup/magnific-popup.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		
		<!-- Specific Page Vendor -->		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jquery-ui/js/jquery-ui-1.10.4.custom.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jquery-appear/jquery.appear.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/flot/jquery.flot.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/flot/jquery.flot.pie.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/flot/jquery.flot.categories.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/flot/jquery.flot.resize.js"></script>
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/raphael/raphael.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/morris/morris.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/gauge/gauge.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/snap-svg/snap.svg.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/liquid-meter/liquid.meter.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jqvmap/jquery.vmap.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jqvmap/data/jquery.vmap.sampledata.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jqvmap/maps/jquery.vmap.world.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jqvmap/maps/continents/jquery.vmap.africa.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jqvmap/maps/continents/jquery.vmap.asia.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jqvmap/maps/continents/jquery.vmap.australia.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jqvmap/maps/continents/jquery.vmap.europe.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jqvmap/maps/continents/jquery.vmap.north-america.js"></script>		
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/jqvmap/maps/continents/jquery.vmap.south-america.js"></script>	
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>			
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/vendor/select2/select2.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/assets/javascripts/";?>theme.js"></script>
		<script src="<?php echo base_url()."assets/themes/jasny/js/jasny-bootstrap.js";?>"></script>
		
		<!-- Theme Custom -->
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/javascripts/theme.init.js"></script>

		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/javascripts/forms/examples.wizard.js"></script>
		<!-- Example
		<script src="<?php echo base_url()."assets/themes/porto-admin/1.4.1/";?>assets/javascripts/dashboard/examples.dashboard.js"></script>
        s -->
        <!-- Full Google Calendar - Calendar -->
		<script src="<?php echo base_url()."assets/bluish/"?>js/fullcalendar.min.js"></script> 
        <!-- jQuery Flot -->
        <script src="<?php echo base_url()."assets/bluish/"?>js/excanvas.min.js"></script>
        <script src="<?php echo base_url()."assets/bluish/"?>js/jquery.flot.js"></script>
        <script src="<?php echo base_url()."assets/bluish/"?>js/jquery.flot.resize.js"></script>
        <script src="<?php echo base_url()."assets/bluish/"?>js/jquery.flot.axislabels.js"></script>
        <script src="<?php echo base_url()."assets/bluish/"?>js/jquery.flot.pie.js"></script>
        <script src="<?php echo base_url()."assets/bluish/"?>js/jquery.flot.stack.js"></script>
        <script src="<?php echo base_url()."assets/"?>js/main.js"></script>
        <script src='<?php echo base_url()."assets/bluish/"?>src/jquery-customselect.js'></script>
	    <link href='<?php echo base_url()."assets/bluish/"?>src/jquery-customselect.css' rel='stylesheet' />
		
	</body>
</html>
