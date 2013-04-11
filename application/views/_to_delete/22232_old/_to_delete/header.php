<html lang="en-us">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<meta charset="utf-8" />

        <link rel="apple-touch-con" href="" />

	<title>MyMarketingCentre.co.uk</title>

        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">

	<!-- The Columnal Grid and mobile stylesheet -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/columnal/columnal.css" type="text/css" media="screen" />

	<!-- Fixes for IE -->

	<!--[if lt IE 9]>
            <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/columnal/ie.css" type="text/css" media="screen" />
            <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/ie8.css" type="text/css" media="screen" />
            <script src="https://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
            <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/flot/excanvas.min.js"></script>
	<![endif]-->

	<!-- Now that all the grids are loaded, we can move on to the actual styles. -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/jqueryui/jqueryui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/global.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/config.css" type="text/css" media="screen" />

         <!-- Use CDN on production server -->
        <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>  -->
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>	
        <script type="text/javascript" src="http://code.jquery.com/ui/1.9.1/jquery-ui.min.js"></script>    

        <!-- Adds HTML5 Placeholder attributes to those lesser browsers (i.e. IE) -->
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/jquery.placeholder.1.2.min.shrink.js"></script>

        <!-- Menu -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/superfish/superfish.css" type="text/css" media="screen" />
        <script src="<?php echo site_url(); ?>assets/scripts/superfish/superfish.js"></script>

        <!-- Adds charts -->
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/flot/jquery.flot.min.js"></script>
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/flot/jquery.flot.pie.min.js"></script>
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/flot/jquery.flot.stack.min.js"></script>


         <!-- Form Validation Engine -->
        <script src="<?php echo site_url(); ?>assets/scripts/formvalidator/jquery.validationEngine.js"></script>
        <script src="<?php echo site_url(); ?>assets/scripts/formvalidator/jquery.validationEngine-en.js"></script>
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/formvalidator/validationEngine.jquery.css" type="text/css" media="screen" />

        <!-- Sortable, searchable DataTable -->
        <script src="<?php echo site_url(); ?>assets/scripts/jquery.dataTables.min.js"></script>		
        
		
        <!-- Custom Tooltips -->
        <script src="<?php echo site_url(); ?>assets/scripts/twipsy.js"></script>

        <!-- WYSIWYG Editor -->
        <script src="<?php echo site_url(); ?>assets/scripts/cleditor/jquery.cleditor.min.js"></script>
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/cleditor/jquery.cleditor.css" type="text/css" media="screen" />

        <!-- Form Validation Engine -->
        <script src="<?php echo site_url(); ?>assets/scripts/formvalidator/jquery.validationEngine.js"></script>
        <script src="<?php echo site_url(); ?>assets/scripts/formvalidator/jquery.validationEngine-en.js"></script>
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/formvalidator/validationEngine.jquery.css" type="text/css" media="screen" />

        <!-- Fullsized calendars -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/fullcalendar/fullcalendar.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/fullcalendar/fullcalendar.print.css" type="text/css" media="print" />
        <script src="<?php echo site_url(); ?>assets/scripts/fullcalendar/fullcalendar.min.js"></script>
        <script src="<?php echo site_url(); ?>assets/scripts/fullcalendar/gcal.js"></script>

        <!-- Colorbox is a lightbox alternative-->
        <script src="<?php echo site_url(); ?>assets/scripts/colorbox/jquery.colorbox-min.js"></script>
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/colorbox/colorbox.css" type="text/css" media="screen" />

        <!-- Colorpicker -->
        <script src="<?php echo site_url(); ?>assets/scripts/colorpicker/colorpicker.js"></script>
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/colorpicker/colorpicker.css" type="text/css" media="screen" />

        <!-- Uploadify -->
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/uploadify/swfobject.js"></script>
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/uploadify/uploadify.css" type="text/css" media="screen" />

        <!-- Date & time picker -->
        <script type="text/javascript" src="assets/scripts/jquery-ui-timepicker-addon.js"></script>
        <script type="text/javascript" src="assets/scripts/jquery-ui-sliderAccess.js"></script>
        
        
         <!-- All the js used in the demo -->
         <script src="<?php echo site_url(); ?>assets/scripts/demo.js"></script>

		 <!-- Note: To include javascript script go to public_html/<?php echo site_url(); ?>assets/scripts/muse.js -->		 
         <script src="assets/scripts/muse.js"></script>
		
		<!-- Script to allow inline popups (when clicking on 'view record) -->
		<script>
				$(document).ready(function(){
					$(".inline").colorbox({inline:true, width:"50%"});
					$(".iframe").colorbox({iframe:true, width:"80%", height:"90%", escKey: false, overlayClose: false,  onClosed:function(){window.location.reload();} });
					
								
								//Example of preserving a JavaScript event for inline calls.
					$("#click").click(function(){ 
						$('#click').css({"background-color":"#f00", "color":"#fff", "cursor":"inherit"}).text("Open this window again and this message will still be here.");
						return false;
					});
				});
		</script>
		<!-- Allows show/hide of divs based on dropdown menu selection -->
		<script type="text/javascript">
		$(document).ready(function(){
		 $('.box').hide();
		  $('#dropdown').change(function() {
			$('.box').hide();
			$('#div' + $(this).val()).show();
		 });
		});
	</script>
</head>
<body>

<div id="wrap">
    <div id="main">
        <header class="container">
            <div class="row clearfix">
                <div class="left">
                    <a href="<?php echo site_url() . DATAOWNER_ID . '/dashboard'; ?>" id="logo" style="height: 100px; 
			background: url('<?php echo site_url() . PATH_TO_LOGO; ?>') no-repeat; 
			text-indent: -9999em; 
			display: block; 
			float: left}"></a>
                </div>                
                <div class="right">
                    <ul id="toolbar">
                       <li><strong>Logged in as 
                            <?php echo anchor(DATAOWNER_ID .'/user/view/' . $this->session->userdata('UserId'), $this->session->userdata('FirstName') . ' ' . $this->session->userdata('LastName'));  ?></strong> (<?php echo anchor('/login/log_out', 'Log out?'); ?>)</li>
                        <li><?php echo anchor(DATAOWNER_ID . '/settings', 'Settings', 'id="settings"'); ?></li>
                    </ul>
                </div>
            </div>
        </header>