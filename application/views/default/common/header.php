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
            <link rel="stylesheet" href="assets/styles/columnal/ie.css" type="text/css" media="screen" />
            <link rel="stylesheet" href="assets/styles/ie8.css" type="text/css" media="screen" />
            <script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js"></script>
	<![endif]-->        
        
	
	<!-- Now that all the grids are loaded, we can move on to the actual styles. --> 
        <link rel="stylesheet" href="assets/scripts/jqueryui/jqueryui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/style.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/global.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo site_url(); ?>assets/styles/config.css" type="text/css" media="screen" />
        
        <!-- Adds HTML5 Placeholder attributes to those lesser browsers (i.e. IE) -->
        <script type="text/javascript" src="assets/scripts/jquery.placeholder.1.2.min.shrink.js"></script>

        
        <!-- Use CDN on production server -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>
        
        <!-- Menu -->
        <link rel="stylesheet" href="assets/scripts/superfish/superfish.css" type="text/css" media="screen" />
        <script src="assets/scripts/superfish/superfish.js"></script>
		

        <!-- Js used in the theme -->
        <script src="assets/scripts/muse.js"></script>

</head>
<body>
<div id="wrap">
    <div id="main">
        <header class="container">
            <div class="row clearfix">
                <div class="left">
                    <a href="<?php echo site_url(); ?>" id="logo" style="height: 100px; 
			background: url('<?php echo site_url() . 'assets/images/logo/logo.png'; ?>) no-repeat; 
			text-indent: -9999em; 
			display: block; 
			float: left}"></a>
                </div>                
                <div class="right">
                    <ul id="toolbar">
                       <li><strong>Logged in as 
                            <?php //echo anchor('user/view/' . $this->session->userdata('UserId'), $this->session->userdata('FirstName') . ' ' . $this->session->userdata('LastName'));  ?></strong> (<?php// echo anchor('/login/log_out', 'Log out?'); ?>)</li>
                        <li><?php echo anchor('settings', 'Settings', 'id="settings"'); ?></li>
                    </ul>
                </div>
            </div>
        </header>
        <!-- Start Navbar-->
        <nav class="container">
            <ul class="sf-menu mobile-hide row clearfix">
                <?php echo $view_setup['navbar']; ?>
            </ul>
        </nav>
        <!-- End Navbar-->
        <div class="container" id="actualbody"><!-- Start body -->
            <?Php //print_array($view_setup);?>