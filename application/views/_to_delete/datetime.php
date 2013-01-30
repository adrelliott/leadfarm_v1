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
        
       <!-- Load Main Jquery libraries -->
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.8.2.min.js"></script>	
    <script type="text/javascript" src="http://code.jquery.com/ui/1.9.1/jquery-ui.min.js"></script>  
     
    <!-- Adds HTML5 Placeholder attributes to those lesser browsers (i.e. IE) -->
    <script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/jquery.placeholder.1.2.min.shrink.js"></script>

    <!-- Sortable, searchable DataTable -->
    <script src="<?php echo site_url(); ?>assets/scripts/jquery.dataTables.min.js"></script>
    
    <!-- Custom Tooltips -->
    <script src="<?php echo site_url(); ?>assets/scripts/twipsy.js"></script>

    <!-- WYSIWYG Editor -->
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
     
    <!-- All the js used in the demo -->
    <script src="<?php echo site_url(); ?>assets/scripts/app.js"></script>
    
    <!--//############################ all new js #-->
		
		
		
		
	</head> 
	<body> 
            <input type="text" name="basic_example_1" class="datetimepicker" value="" />
		<div class="wrapper">
                    <h3 id="basic_examples">Basic Initializations</h3>
                        <div class="example-container">
                            <p>Add a simple datetimepicker to jQuery UI's datepicker</p>
                            <div>
                                <input type="text" name="basic_example_1" class="datetimepicker" value="" />
                            </div>					
<pre>
$('#basic_example_1').datetimepicker();
</pre>
					</div>


					<!-- ============= example -->
					<div class="example-container">
						<p>Add only a timepicker:</p>
						<div>
					 		<input type="text" name="basic_example_2" id="basic_example_2" value="" />
						</div>					
<pre>
$('#basic_example_2').timepicker();
</pre>
					</div>

					<!-- ============= example -->
					<div class="example-container">
						<p>Format the time:</p>
						<div>
					 		<input type="text" name="basic_example_3" id="basic_example_3" value="" />
						</div>					
<pre>
$('#basic_example_3').datetimepicker({
	timeFormat: "hh:mm tt"
});
</pre>
					</div>

					<h3 id="timezone_examples">Using Timezones</h3>

					<!-- ============= example -->
					<div class="example-container">
						<p>Simplest timezone usage:</p>
						<div>
					 		<input type="text" name="timezone_example_1" id="timezone_example_1" value="" />
						</div>					
<pre>
$('#timezone_example_1').datetimepicker({
	timeFormat: 'hh:mm tt z',
	showTimezone: true
});
</pre>
					</div>

					<!-- ============= example -->
					<div class="example-container">
						<p>Define your own timezone options:</p>
						<div>
					 		<input type="text" name="timezone_example_2" id="timezone_example_2" value="" />
						</div>					
<pre>
$('#timezone_example_2').datetimepicker({
	timeFormat: 'HH:mm z',
	showTimezone: true,
	timezoneList: [ 
			{ value: '-0500', label: 'Eastern'}, 
			{ value: '-0600', label: 'Central' }, 
			{ value: '-0700', label: 'Mountain' }, 
			{ value: '-0800', label: 'Pacific' } 
		]
});
</pre>
					</div>

					<!-- ============= example -->
					<div class="example-container">
						<p>Use timezone string abbreviations for values:</p>
						<div>
					 		<input type="text" name="timezone_example_3" id="timezone_example_3" value="" />
						</div>					
<pre>
$('#timezone_example_3').datetimepicker({
	timeFormat: 'HH:mm z',
	showTimezone: true,
	timezone: 'MT',
	timezoneList: [ 
			{ value: 'ET', label: 'Eastern'}, 
			{ value: 'CT', label: 'Central' }, 
			{ value: 'MT', label: 'Mountain' }, 
			{ value: 'PT', label: 'Pacific' } 
		]
});

</pre>
					</div>

					<h3 id="slider_examples">Slider Modifications</h3>

					<!-- ============= example -->
					<div class="example-container">
						<p>Add a grid to each slider:</p>
						<div>
					 		<input type="text" name="slider_example_1" id="slider_example_1" value="" />
						</div>					
<pre>
$('#slider_example_1').timepicker({
	hourGrid: 4,
	minuteGrid: 10,
	timeFormat: 'hh:mm tt'
});
</pre>
					</div>

					<!-- ============= example -->
					<div class="example-container">
						<p>Set the interval step of sliders:</p>
						<div>
					 		<input type="text" name="slider_example_2" id="slider_example_2" value="" />
						</div>					
<pre>
$('#slider_example_2').datetimepicker({
	showSecond: true,
	timeFormat: 'HH:mm:ss',
	stepHour: 2,
	stepMinute: 10,
	stepSecond: 10
});
</pre>
					</div>

					<!-- ============= example -->
					<div class="example-container">
						<p>Add sliderAccess plugin for touch devices:</p>
						<div>
					 		<input type="text" name="slider_example_3" id="slider_example_3" value="" />
						</div>					
<pre>
$('#slider_example_3').datetimepicker({
	addSliderAccess: true,
	sliderAccessArgs: { touchonly: false }
});</pre>
					</div>

					<!-- ============= example -->
					<div class="example-container">
						<p>Use dropdowns instead of sliders.  By default if slider is not available dropdowns will be used.</p>
						<div>
					 		<input type="text" name="slider_example_4" id="slider_example_4" value="" />
						</div>					
<pre>
$('#slider_example_4').datetimepicker({
	controlType: 'select',
	timeFormat: 'hh:mm tt'
});</pre>
					</div>

					<!-- ============= example -->
					<div class="example-container">
						<p>Create your own control by implementing the create, options, and value methods. If you want to use your new control for all instances use the $.timepicker.setDefaults({controlType:myControl}). Here we implement jQueryUI's spinner control (jQueryUI 1.9+).</p>
						<div>
					 		<input type="text" name="slider_example_5" id="slider_example_5" value="" />
						</div>					
<pre>var myControl=  {
	create: function(tp_inst, obj, unit, val, min, max, step){
		$('&lt;input class="ui-timepicker-input" value="'+val+'" style="width:50%"&gt;')
			.appendTo(obj)
			.spinner({
				min: min,
				max: max,
				step: step,
				change: function(e,ui){ // key events
						// don't call if api was used and not key press
						if(e.originalEvent !== undefined)
							tp_inst._onTimeChange();
						tp_inst._onSelectHandler();
					},
				spin: function(e,ui){ // spin events
						tp_inst.control.value(tp_inst, obj, unit, ui.value);
						tp_inst._onTimeChange();
						tp_inst._onSelectHandler();
					}
			});
		return obj;
	},
	options: function(tp_inst, obj, unit, opts, val){
		if(typeof(opts) == 'string' && val !== undefined)
				return obj.find('.ui-timepicker-input').spinner(opts, val);
		return obj.find('.ui-timepicker-input').spinner(opts);
	},
	value: function(tp_inst, obj, unit, val){
		if(val !== undefined)
			return obj.find('.ui-timepicker-input').spinner('value', val);
		return obj.find('.ui-timepicker-input').spinner('value');
	}
};

$('#slider_example_5').datetimepicker({
	controlType: myControl
});</pre>
					</div>

					<h3 id="alt_examples">Alternate Fields</h3>

					<!-- ============= example -->
					<div class="example-container">
						<p>Alt field in the simplest form:</p>
						<div>
					 		<input type="text" name="alt_example_1" id="alt_example_1" value="09/15/2012" />
					 		<input type="text" name="alt_example_1_alt" id="alt_example_1_alt" value="10:15" />
						</div>					
<pre>
$('#alt_example_1').datetimepicker({
	altField: "#alt_example_1_alt"
});
</pre>
					</div>

					<!-- ============= example -->
					<div class="example-container">
						<p>With datetime in both:</p>
						<div>
					 		<input type="text" name="alt_example_2" id="alt_example_2" value="" />
					 		<input type="text" name="alt_example_2_alt" id="alt_example_2_alt" value="" />
						</div>					
<pre>
$('#alt_example_2').datetimepicker({
	altField: "#alt_example_2_alt",
	altFieldTimeOnly: false
});
</pre>
					</div>

					<!-- ============= example -->
					<div class="example-container">
						<p>Format the altField differently:</p>
						<div>
					 		<input type="text" name="alt_example_3" id="alt_example_3" value="" />
					 		<input type="text" name="alt_example_3_alt" id="alt_example_3_alt" value="" />
						</div>					
<pre>
$('#alt_example_3').datetimepicker({
	altField: "#alt_example_3_alt",
	altFieldTimeOnly: false,
	altFormat: "yy-mm-dd",
	altTimeFormat: "h:m t",
	altSeparator: " @ "
});
</pre>
					</div>

					<!-- ============= example -->
					<div class="example-container">
						<p>With inline mode using altField:</p>
						<div>
					 		<input type="text" name="alt_example_4_alt" id="alt_example_4_alt" value="" />
					 		<span id="alt_example_4" ></span>
						</div>					
<pre>
$('#alt_example_4').datetimepicker({
	altField: "#alt_example_4_alt",
	altFieldTimeOnly: false
});
</pre>
					</div>

					<h3 id="rest_examples">Time Restraints</h3>

					<!-- ============= example -->
					<div class="example-container">
						<p>Set the min/max hour of every date:</p>
						<div>
					 		<input type="text" name="rest_example_1" id="rest_example_1" value="" />
						</div>					
<pre>
$('#rest_example_1').timepicker({
	hourMin: 8,
	hourMax: 16
});
</pre>
					</div>

					<!-- ============= example -->
					<div class="example-container">
						<p>Set the min/max date numerically:</p>
						<div>
					 		<input type="text" name="rest_example_2" id="rest_example_2" value="" />
						</div>					
<pre>
$('#rest_example_2').datetimepicker({
	numberOfMonths: 2,
	minDate: 0,
	maxDate: 30
});
</pre>
					</div>					

					<!-- ============= example -->
					<div class="example-container">
						<p>Set the min/max date and time with a Date object:</p>
						<div>
					 		<input type="text" name="rest_example_3" id="rest_example_3" value="" />
						</div>					
<pre>
$('#rest_example_3').datetimepicker({
	minDate: new Date(2010, 11, 20, 8, 30),
	maxDate: new Date(2010, 11, 31, 17, 30)
});
</pre>
					</div>									

					<!-- ============= example -->
					<div class="example-container">
						<p>Restrict a start and end date (also shows using onSelect and onClose events):</p>
						<div>
					 		<input type="text" name="rest_example_4_start" id="rest_example_4_start" value="" /> 
					 		<input type="text" name="rest_example_4_end" id="rest_example_4_end" value="" />
						</div>					
<pre>
var startDateTextBox = $('#rest_example_4_start');
var endDateTextBox = $('#rest_example_4_end');

startDateTextBox.datetimepicker({ 
	onClose: function(dateText, inst) {
		if (endDateTextBox.val() != '') {
			var testStartDate = startDateTextBox.datetimepicker('getDate');
			var testEndDate = endDateTextBox.datetimepicker('getDate');
			if (testStartDate > testEndDate)
				endDateTextBox.datetimepicker('setDate', testStartDate);
		}
		else {
			endDateTextBox.val(dateText);
		}
	},
	onSelect: function (selectedDateTime){
		endDateTextBox.datetimepicker('option', 'minDate', startDateTextBox.datetimepicker('getDate') );
	}
});
endDateTextBox.datetimepicker({ 
	onClose: function(dateText, inst) {
		if (startDateTextBox.val() != '') {
			var testStartDate = startDateTextBox.datetimepicker('getDate');
			var testEndDate = endDateTextBox.datetimepicker('getDate');
			if (testStartDate > testEndDate)
				startDateTextBox.datetimepicker('setDate', testEndDate);
		}
		else {
			startDateTextBox.val(dateText);
		}
	},
	onSelect: function (selectedDateTime){
		startDateTextBox.datetimepicker('option', 'maxDate', endDateTextBox.datetimepicker('getDate') );
	}
});
</pre>
					</div>

					
					<h3 id="utility_examples">Utilities</h3>

					<!-- ============= example -->
					<div class="example-container">
						<p>Get and Set Datetime:</p>
						<div>
							<input type="text" name="utility_example_1" id="utility_example_1" value="" /> 
							<button id="utility_example_1_setdt" value="1">Set Datetime</button> 
							<button id="utility_example_1_getdt" value="1">Get Datetime</button> 
						</div>
					
<pre>
var ex13 = $('#utility_example_1');

ex13.datetimepicker({
	dateFormat: "D MM d, yy",
	separator: ' @ '
});

$('#utility_example_1_setdt').click(function(){
	ex13.datetimepicker('setDate', (new Date()) );
});

$('#utility_example_1_getdt').click(function(){
	alert(ex13.datetimepicker('getDate'));
});
</pre>
					</div>

					<!-- ============= example -->
					<div class="example-container">
						<p>Use the utility function to format your own time. $.datepicker.formatTime(format, time, options)</p>
						<dl class="defs">
							<dt>format</dt><dd>required - string represenation of the time format to use</dd>
							<dt>time</dt><dd>required - hash: { hour, minute, second, millisecond, timezone }</dd>
							<dt>options</dt><dd>optional - hash of any options in regional translation (ampm, amNames, pmNames..)</dd>
						</dl>
						<p>Returns a time string in the specified format.</p>
						<div>
							<div id="utility_example_2"></div>
						</div>
					
<pre>
$('#utility_example_2').text(
	$.datepicker.formatTime('HH:mm z', { hour: 14, minute: 36, timezone: '+2000' }, {})
);
</pre>
					</div>

					<!-- ============= example -->
					<div class="example-container">
						<p>Use the utility function to parses a formatted time. $.datepicker.parseTime(format, timeString, options)</p>
						<dl class="defs">
							<dt>format</dt><dd>required - string represenation of the time format to use</dd>
							<dt>time</dt><dd>required - time string matching the format given in parameter 1</dd>
							<dt>options</dt><dd>optional - hash of any options in regional translation (ampm, amNames, pmNames..)</dd>
						</dl>
						<p>Returns an object with hours, minutes, seconds, milliseconds, timezone.</p>
						<div>
							<div id="utility_example_3"></div>
						</div>
					
<pre>
$('#utility_example_3').text(JSON.stringify( 
	$.datepicker.parseTime('HH:mm:ss:l z', "14:36:21:765 +2000", {}) 
));
</pre>
					</div>

				</div>
			</div>

				
	 	</div>
	 	
</html>
