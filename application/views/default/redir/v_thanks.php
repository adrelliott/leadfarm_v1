<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<meta charset="utf-8" />

        <link rel="apple-touch-con" href="" />

	<title>Oops...</title>

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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.4/jquery.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.min.js"></script>        

        <!-- Adds HTML5 Placeholder attributes to those lesser browsers (i.e. IE) -->
        <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/jquery.placeholder.1.2.min.shrink.js">
        </script>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Login</title>
    </head>
    <body>
        <div id="wrap">
            <div id="main">
                <div class="container">
                    <div class="row">
                        <div class="col_6 pre_3 padding_top_120">
                            <div class="widget clearfix">
                                <h2>Uh Oh...</h2>
                                 <div class="widget_inside">
                                    <h3>Well this is embarrassing...</h3>
                                    <h4>Seeing this page means either:</h4>
                                    <ul>
                                        <li><h4>- We've messed up and given you a link that doesn't work. (Please let us know if we have),</h4></li>
                                        <li><h4>- ...Or, you've entered a link into your browser that doesn't exist, (its OK - we all like to try new things from time to time)</h4></li>
                                    </ul>
                                    <br/>
                                    <h4>Either way, <strong>just press the back button on your browser</strong> and see time magically travel backwards as you find yourself in the same place you were before this whole sorry incident ever happened.</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row clearfix">
                    <div class="col_12">
                        <span class="left">&copy; 2009 - <?php echo date("Y") ?> Dallas Matthews Ltd.</span>
                        <span class="right">Dallas Matthews are <a href="http://DallasMatthews.co.uk">Relationship Marketing</a> Experts based in Manchester, UK.</span>
                    </div>
                </div>
            </div>
        </footer>
    </body>
</html>
<?php print_array($this->data);?>