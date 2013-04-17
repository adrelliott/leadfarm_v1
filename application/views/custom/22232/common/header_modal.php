<html lang="en-us">

    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
        <meta charset="utf-8" />

        <link rel="apple-touch-con" href="" />

        <title>LeadFarm.co.uk - Managed CRM</title>

        <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0">

        <!-- The Columnal Grid and mobile stylesheet -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/columnal/columnal.css" type="text/css" media="screen" />

        <!-- Fixes for IE -->

        <!--[if lt IE 9]>
            <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/columnal/ie.css" type="text/css" media="screen" />
            <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/ie8.css" type="text/css" media="screen" />
            <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
        <![endif]-->        


        <!-- Now that all the grids are loaded, we can move on to the actual styles. --> 
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/jqueryui/jqueryui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/global.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/config.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/custom_styles.php" type="text/css" media="screen" />

        <?php if ( strpos ( ENVIRONMENT, 'development') ) : //load local libs if in dev mode ?>
            <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/jquery-1.8.2.min.js"></script>	
            <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/jqueryui/1.9.1/jquery-ui.min.js"></script>  
        <?php else: ?>
            <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>	
            <script type="text/javascript" src="http://code.jquery.com/ui/1.9.1/jquery-ui.min.js"></script> 
        <?php endif; ?>

        <!-- Adds HTML5 Placeholder attributes to those lesser browsers (i.e. IE) -->
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/jquery.placeholder.1.2.min.shrink.js"></script>

        <!-- Sortable, searchable DataTable -->
        <script src="<?php echo site_url(); ?>assets/scripts/jquery.dataTables.min.js"></script>

        <!-- Custom Tooltips -->
        <script src="<?php echo site_url(); ?>assets/scripts/twipsy.js"></script>

        <!-- WYSIWYG Editor -->
        <script src="<?php echo site_url(); ?>assets/scripts/ckeditor/ckeditor.js"></script>

        <script src="<?php echo site_url(); ?>assets/scripts/cleditor/jquery.cleditor.min.js"></script>
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/cleditor/jquery.cleditor.css" type="text/css" media="screen" />

        <!-- Fullsized calendars -->
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/fullcalendar/fullcalendar.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/fullcalendar/fullcalendar.print.css" type="text/css" media="print" />
        <script src="<?php echo site_url(); ?>assets/scripts/fullcalendar/fullcalendar.min.js"></script>
        <script src="<?php echo site_url(); ?>assets/scripts/fullcalendar/gcal.js"></script>

        <!-- Colorbox is a lightbox alternative-->
        <script src="<?php echo site_url(); ?>assets/scripts/colorbox/jquery.colorbox-min.js"></script>
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/colorbox/colorbox.css" type="text/css" media="screen" />

        <!-- Uploadify -->
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/uploadify/jquery.uploadify.v2.1.4.min.js"></script>
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/uploadify/swfobject.js"></script>
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/scripts/uploadify/uploadify.css" type="text/css" media="screen" />

        <!-- Date & Time picker -->
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/timepicker/jquery-ui-timepicker-addon.js"></script>
        <link rel="stylesheet" media="all" type="text/css" href="<?php echo site_url(); ?>assets/scripts/timepicker/jquery-ui-timepicker-addon.css" />

        <!-- Pure CSS3 Validation & Masking -->
        <link rel="stylesheet" href="<?php //echo site_url();  ?>assets/scripts/PCSS3/css/pcss3fs.css" />
        <link rel="stylesheet" href="<?php //echo site_url();  ?>333assets/scripts/PCSS3/css/main.css" />
        <script src="<?php echo site_url(); ?>assets/scripts/PCSS3/js/jquery.maskedinput.min.js"></script>
        <script src="<?php echo site_url(); ?>assets/scripts/PCSS3/js/jquery.validate.min.js"></script>
        <!--[if lt IE 9]>
                <link rel="stylesheet" href="<?php //echo site_url();  ?>assets/scripts/PCSS3/css/pcss3fs-ie8.css" />
                <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
                <script src="<?php echo site_url(); ?>assets/scripts/PCSS3/js/ie8.js"></script>
        <![endif]-->

        <!-- Now call InputMask -->
        <script src="<?php echo site_url();  ?>assets/scripts/inputmask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="<?php echo site_url();  ?>assets/scripts/inputmask/jquery.inputmask.bundle.js" type="text/javascript"></script>



        <!-- All the js used in the demo -->
        <script src="<?php echo site_url(); ?>assets/scripts/app.js"></script>



    </head>
    <body>
        <div id="wrap">
            <div id="main">
                <div class="container" id="actualbody_modal"><!-- Start body -->
                    <?php echo anchor('/help/view/edit/___' . uri_string(), 'Help', 'id="help" class="left iframe "'); ?>