<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=Edge;chrome=1" >
	<meta charset="utf-8" />

        <link rel="apple-touch-con" href="" />

	<title>Unsubscribe</title>

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
        <style>.form div.clearfix label.radio_button {width: 25em;}</style>
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
                                <h2>Subscription Settings</h2>
                                <div class="widget_inside">
                                    <?php echo $this->message; ?>
                                    <div class="form margin_top_15">
                                        <div class="clearfix center" id="">
                                            <h4 class="">How do you want us to keep in touch with you?</h4>
                                        </div>
                                        <?php echo form_open('unsubscribe/edit/' . $this->rID); ?>
                                        <div class="clearfix" id="">
                                            <label class="radio_button" id="">I want to get general email messages: </label>
                                            <div class="input " id="">
                                                <input type="radio" id="_OptinEmailYN" name="_OptinEmailYN" value="1" <?php echo set_radio('_OptinEmailYN', '1', $fields['_OptinEmailYN'] == '1'); ?> />Yes
                                                <input type="radio" id="_OptinEmailYN" name="_OptinEmailYN" value="0" <?php echo set_radio('_OptinEmailYN', '0', $fields['_OptinEmailYN'] == '0'); ?> />No

                                            </div>
                                        </div>

                                        <div class="clearfix" id="">
                                            <label class="radio_button" id="">I want to get general text messages"</label>
                                            <div class="input " id="">
                                                <input type="radio" id="_OptinSmsYN" name="_OptinSmsYN" value="1" <?php echo set_radio('_OptinSmsYN', '1', $fields['_OptinSmsYN'] == '1'); ?> />Yes
                                                <input type="radio" id="_OptinSmsYN" name="_OptinSmsYN" value="0" <?php echo set_radio('_OptinSmsYN', '0', $fields['_OptinSmsYN'] == '0'); ?> />No

                                            </div>
                                        </div>

                                        <div class="clearfix" id="">
                                            <label class="radio_button" id="">I'm happy to get things through the post:</label>
                                            <div class="input " id="">
                                                <input type="radio" id="_OptinSurfaceMailYN" name="_OptinSurfaceMailYN" value="1" <?php echo set_radio('_OptinSurfaceMailYN', '1', $fields['_OptinSurfaceMailYN'] == '1'); ?> />Yes
                                                <input type="radio" id="_OptinSurfaceMailYN" name="_OptinSurfaceMailYN" value="0" <?php echo set_radio('_OptinSurfaceMailYN', '0', $fields['_OptinSurfaceMailYN'] == '0'); ?> />No

                                            </div>
                                        </div>

                                        <div class="clearfix" id="">
                                            <label class="radio_button" id="">I'm happy to get offers via email:</label>
                                            <div class="input " id="">
                                                <input type="radio" id="_OptinMerchandiseYN" name="_OptinMerchandiseYN" value="1" <?php echo set_radio('_OptinMerchandiseYN', '1', $fields['_OptinMerchandiseYN'] == '1'); ?> />Yes
                                                <input type="radio" id="_OptinMerchandiseYN" name="_OptinMerchandiseYN" value="0" <?php echo set_radio('_OptinMerchandiseYN', '0', $fields['_OptinMerchandiseYN'] == '0'); ?> />No

                                            </div>
                                        </div>

                                        <div class="clearfix" id="">
                                            <label class="radio_button" id="">I want to hear about events via email:</label>
                                            <div class="input " id="">
                                                <input type="radio" id="__ClubEventsYN" name="__ClubEventsYN" value="1" <?php echo set_radio('__ClubEventsYN', '1', $fields['__ClubEventsYN'] == '1'); ?> />Yes
                                                <input type="radio" id="__ClubEventsYN" name="__ClubEventsYN" value="0" <?php echo set_radio('__ClubEventsYN', '0', $fields['__ClubEventsYN'] == '0'); ?> />No
                                            </div>
                                        </div>

                                        <div class="clearfix" id="">
                                            <label class="radio_button" id="">I want to be contacted about Away Match travel arrangements:</label>
                                            <div class="input " id="">
                                                <input type="radio" id="__AwayMatchYN" name="__AwayMatchYN" value="1" <?php echo set_radio('__AwayMatchYN', '1', $fields['__AwayMatchYN'] == '1'); ?> />Yes
                                                <input type="radio" id="__AwayMatchYN" name="__AwayMatchYN" value="0" <?php echo set_radio('__AwayMatchYN', '0', $fields['__AwayMatchYN'] == '0'); ?> />No
                                            </div>
                                        </div>

                                        <div class="clearfix" id="">
                                            <label class="" id="">Change my email address:</label>
                                            <div class="input " id="">
                                                <input name="Email" type="text" class="larger" value="<? echo $fields['Email']; ?>" />
                                            </div>
                                        </div>
                                        <div class="clearfix grey-highlight">
                                            <div class="input no-label ">
                                                <input type='submit' name='submit' class='button large green right' value='Save These Preferences' />
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                    </div>
                                    <div class="form margin_top_45">
                                        <div class="clearfix center margin_top_15">
                                            <h3 class="margin_bottom_15 margin_top_15"><a href="<?php echo site_url(('unsubscribe/remove/' . $this->rID)); ?>" class="button red padding_top_15 padding_bottom_15 ">Unsubscribe from Everything</a></h3>
                                            <h4>NOTE: This will set all the above settings to 'NO' and DELETE your email address from our system</h4>
                                        </div>
                                    </div>
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
<?php //print_array($fields);?>