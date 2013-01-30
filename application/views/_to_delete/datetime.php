<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">  
<html lang="en" xmlns="http://www.w3.org/1999/xhtml"> 
	<head> 
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<title>Adding a Timepicker to jQuery UI Datepicker</title> 
		<meta name="Description" content="jQuery Timepicker Addon.  Add a timepicker to your jQuery UI Datepicker.  With options to show only time, format time, and much more." />
		<meta name="Keywords" content="jQuery, UI, datepicker, timepicker, datetime, time, format" />
		
		<style type="text/css"> 
			body,img,p,h1,h2,h3,h4,h5,h6,form,table,td,ul,ol,li,dl,dt,dd,pre,blockquote,fieldset,label{
				margin:0;
				padding:0;
				border:0;
			}
			body{ background-color: #777; border-top: solid 10px #7b94b2; font: 90% Arial, Helvetica, sans-serif; padding: 20px; }
			h1,h2,h3{ margin: 10px 0; }
			h1{}
			h2{ color: #f66; }
			h3{ color: #6b84a2; }
			p{ margin: 10px 0; }
			a{ color: #7b94b2; }
			ul,ol{ margin: 10px 0 10px 40px; }
			li{ margin: 4px 0; }
			dl.defs{ margin: 10px 0 10px 40px; }
			dl.defs dt{ font-weight: bold; line-height: 20px; margin: 10px 0 0 0; }
			dl.defs dd{ margin: -20px 0 10px 160px; padding-bottom: 10px; border-bottom: solid 1px #eee;}
			pre{ font-size: 12px; line-height: 16px; padding: 5px 5px 5px 10px; margin: 10px 0; background-color: #e4f4d4; border-left: solid 5px #9EC45F; overflow: auto; }

			.wrapper{ background-color: #ffffff; width: 800px; border: solid 1px #eeeeee; padding: 20px; margin: 0 auto; }
			#tabs{ margin: 20px -20px; border: none; }
			#tabs, #ui-datepicker-div, .ui-datepicker{ font-size: 85%; }
			.clear{ clear: both; }
			
			.example-container{ background-color: #f4f4f4; border-bottom: solid 2px #777777; margin: 0 0 20px 40px; padding: 20px; }
			.example-container input{ border: solid 1px #aaa; padding: 4px; width: 175px; }
		</style> 
		
		<link rel="stylesheet" media="all" type="text/css" href="http://code.jquery.com/ui/1.10.0/themes/smoothness/jquery-ui.css" />
		<link rel="stylesheet" media="all" type="text/css" href="<?php echo site_url(); ?>assets/scripts/timepicker/jquery-ui-timepicker-addon.css" />
		
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.9.0.min.js"></script>
		<script type="text/javascript" src="http://code.jquery.com/ui/1.10.0/jquery-ui.min.js"></script>
		<script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/timepicker/jquery-ui-timepicker-addon.js"></script>
		<script type="text/javascript" src="<?php echo site_url(); ?>assets/scripts/timepicker/jquery-ui-sliderAccess.js"></script>
		<script type="text/javascript">
			
			$(function(){
				$('#tabs').tabs();
		
				$('.example-container > pre').each(function(i){
					eval($(this).text());
				});
			});
			
		</script>
	</head> 
	<body> 
		<div class="wrapper">
			<h1>Adding a Timepicker to jQuery UI Datepicker</h1> 
			
			<p>The timepicker addon adds a timepicker to jQuery UI Datepicker, thus the datepicker and slider components (jQueryUI) are required for using any of these.  In addition all datepicker options are still available through the timepicker addon.</p>
			
			<p>If you are interested in contributing to Timepicker Addon please <a href="http://github.com/trentrichardson/jQuery-Timepicker-Addon" title="Check out Timepicker on GitHub">check it out on GitHub</a>.  If you do make additions please keep in mind I enjoy tabs over spaces,.. But contributions are welcome in any form.</p>
			
			<p><a href="http://trentrichardson.com" title="Back to Blog">Back to Blog</a> or <a href="http://twitter.com/practicalweb" title="Follow Me on Twitter">Follow on Twitter</a></p>
		
			<a href="http://carbounce.com" title="Car Bounce" style="float: right;display: inline-block;width:380px;padding: 10px;background-color: #fbfbfb;border: dotted 4px #e8e8e8;color: #9EC45F;font-size: 16px;text-decoration:none;letter-spacing:1px;"><img src="http://carbounce.com/img/logo_small.png" alt="Car Bounce" align="left" style="margin-right: 20px;"/>Try my new app to keep you informed of your car's financing status and value.</a>	

			<h2>Donation</h2>
			<p>Has this Timepicker Addon been helpful to you?</p>
			<div class="donation">
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="C2QQHR7JQGD28">
				<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donate_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>
			</div>

			<div id="tabs">
				<ul>
					<li><a href="#tp-getting-started" title="Getting Started">Getting Started</a></li>
					<li><a href="#tp-options" title="Options">Options</a></li>
					<li><a href="#tp-formatting" title="Examples">Formatting</a></li>
					<li><a href="#tp-localization" title="Examples">Localization</a></li>
					<li><a href="#tp-examples" title="Examples">Examples</a></li>
				</ul>

				<!-- ############################################################################# -->
				<!-- Getting Started
				<!-- ############################################################################# -->
				<div id="tp-getting-started">
					<h2>Getting Started</h2>
					
					<h3>Highly Recommended</h3>
					<p><a href="http://trentrichardson.com" title="Subscribe to TrentRichardson.com via email">Subscribe to my blog via email</a> and follow <a href="http://twitter.com/practicalweb" title="Follow Me on Twitter">@PracticalWeb</a> on Twitter.  I post for nearly every new version, so you know about updates.</p>

					<h3>Download</h3>
					<p><a href="jquery-ui-timepicker-addon.js" title="Download Timepicker Addon">Download Timepicker Addon</a></p>
					<p><a href="http://github.com/trentrichardson/jQuery-Timepicker-Addon" title="Check out Timepicker on GitHub">Download/Contribute on GitHub</a> (Need the entire repo? Find a bug? See if its fixed here)</p>
					<p>There is a small bit of required CSS (<a href="jquery-ui-timepicker-addon.css" title="Download CSS">Download</a>):</p>
<pre>/* css for timepicker */
.ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
.ui-timepicker-div dl { text-align: left; }
.ui-timepicker-div dl dt { height: 25px; margin-bottom: -25px; }
.ui-timepicker-div dl dd { margin: 0 10px 10px 65px; }
.ui-timepicker-div td { font-size: 90%; }
.ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }

.ui-timepicker-rtl{ direction: rtl; }
.ui-timepicker-rtl dl { text-align: right; }
.ui-timepicker-rtl dl dd { margin: 0 65px 10px 10px; }
</pre>
					
					<h3>Requirements</h3>
					<p>You also need to include jQuery and jQuery UI with datepicker and slider wigits. You should include them in your page in the following order:</p>
					<ol>
						<li>jQuery</li>
						<li>jQueryUI (with datepicker and slider wigits)</li>
						<li>Timepicker</li>
					</ol>

					
					<h3>Version</h3>
					<p>Version 1.1.2</p>

					<p>Last updated on 01/19/2013</p>
					<p>jQuery Timepicker Addon is currently available for use in all personal or commercial projects under both MIT and GPL licenses. This means that you can choose the license that best suits your project, and use it accordingly. </p>
					<p><a href="http://trentrichardson.com/Impromptu/GPL-LICENSE.txt" title="GPL License">GPL License</a></p>
					<p><a href="http://trentrichardson.com/Impromptu/MIT-LICENSE.txt" title="MIT License">MIT License</a></p>

				</div>

				<!-- ############################################################################# -->
				<!-- Options
				<!-- ############################################################################# -->
				<div id="tp-options">
					<h2>Options</h2>

					<p>The timepicker does inherit all options from datepicker.  However, there are many options that are shared by them both, and many timepicker only options:</p>

					<h3>Localization Options</h3>
					<dl class="defs">
						<dt>currentText</dt>
							<dd><em>Default: "Now", A Localization Setting</em> - Text for the Now button.</dd>

						<dt>closeText</dt>
							<dd><em>Default: "Done", A Localization Setting</em> - Text for the Close button.</dd>

						<dt>amNames</dt>
							<dd><em>Default: ['AM', 'A'], A Localization Setting</em> - Array of strings to try and parse against to determine AM.</dd>

						<dt>pmNames</dt>
							<dd><em>Default: ['PM', 'P'], A Localization Setting</em> - Array of strings to try and parse against to determine PM.</dd>

						<dt>timeFormat</dt>
							<dd><em>Default: "HH:mm", A Localization Setting</em> - String of format tokens to be replaced with the time. <a href="#tp-formatting" title="Formatting" onclick="$('#tabs').tabs('select',2);">See Formatting</a>.</dd>

						<dt>timeSuffix</dt>
							<dd><em>Default: "", A Localization Setting</em> - String to place after the formatted time.</dd>

						<dt>timeOnlyTitle</dt>
							<dd><em>Default: "Choose Time", A Localization Setting</em> - Title of the wigit when using only timepicker.</dd>

						<dt>timeText</dt>
							<dd><em>Default: "Time", A Localization Setting</em> - Label used within timepicker for the formatted time.</dd>

						<dt>hourText</dt>
							<dd><em>Default: "Hour", A Localization Setting</em> - Label used to identify the hour slider.</dd>

						<dt>minuteText</dt>
							<dd><em>Default: "Minute", A Localization Setting</em> - Label used to identify the minute slider.</dd>

						<dt>secondText</dt>
							<dd><em>Default: "Second", A Localization Setting</em> - Label used to identify the second slider.</dd>

						<dt>millisecText</dt>
							<dd><em>Default: "Millisecond", A Localization Setting</em> - Label used to identify the millisecond slider.</dd>

						<dt>timezoneText</dt>
							<dd><em>Default: "Timezone", A Localization Setting</em> - Label used to identify the timezone slider.</dd>

						<dt>isRTL</dt>
							<dd><em>Default: false, A Localization Setting</em> - Right to Left support.</dd>
					</dl>

					<h3>Alt Field Options</h3>
					<dl class="defs">

						<dt>altFieldTimeOnly</dt>
							<dd><em>Default: true</em> - When altField is used from datepicker altField will only receive the formatted time and the original field only receives date.</dd>

						<dt>altSeparator</dt>
							<dd><em>Default: (separator option)</em> - String placed between formatted date and formatted time in the altField.</dd>

						<dt>altTimeSuffix</dt>
							<dd><em>Default: (timeSuffix option)</em> - String always placed after the formatted time in the altField.</dd>

						<dt>altTimeFormat</dt>
							<dd><em>Default: (timeFormat option)</em> - The time format to use with the altField.</dd>
					</dl>

					<h3>Timezone Options</h3>
					<dl class="defs">

						<dt>useLocalTimezone</dt>
							<dd><em>Default: false</em> - Whether to default timezone to the browser's set timezone.</dd>

						<dt>defaultTimezone</dt>
							<dd><em>Default: "+0000"</em> - If not set, the default timezone used.</dd>

						<dt>timezoneIso8601</dt>
							<dd><em>Default: false</em> - Whether to follow the ISO 8601 standard.</dd>

						<dt>timezoneList</dt>
							<dd><em>Default: [generated timezones]</em> - An array of timezones used to populate the timezone select. Can be an array of values or an array of objects: { label: "EST", value: "+0400" }</dd>
					</dl>

					<h3>Time Field Options</h3>
					<dl class="defs">

						<dt>controlType</dt>
							<dd><em>Default: 'slider'</em> - Whether to use 'slider' or 'select'. If 'slider' is unavailable through jQueryUI, 'select' will be used. For advanced usage you may pass an object which implements "create", "options", "value" methods to use controls other than sliders or selects.  See the _controls property in the source code for more details.
<pre>{
	create: function(tp_inst, obj, unit, val, min, max, step){	
		// generate whatever controls you want here, just return obj
	},
	options: function(tp_inst, obj, unit, opts, val){
		// if val==undefined return the value, else return obj
	},
	value: function(tp_inst, obj, unit, val){
		// if val==undefined return the value, else return obj
	}
}</pre>
							</dd>

						<dt>showHour</dt>
							<dd><em>Default: true</em> - Whether to show the hour slider.</dd>

						<dt>showMinute</dt>
							<dd><em>Default: true</em> - Whether to show the minute slider.</dd>

						<dt>showSecond</dt>
							<dd><em>Default: false</em> - Whether to show the second slider.</dd>

						<dt>showMillisec</dt>
							<dd><em>Default: false</em> - Whether to show the millisecond slider.</dd>

						<dt>showTimezone</dt>
							<dd><em>Default: false</em> - Whether to show the timezone select.</dd>

						<dt>showTime</dt>
							<dd><em>Default: true</em> - Whether to show the time selected within the datetimepicker.</dd>

						<dt>stepHour</dt>
							<dd><em>Default: 1</em> - Hours per step the slider makes.</dd>

						<dt>stepMinute</dt>
							<dd><em>Default: 1</em> - Minutes per step the slider makes.</dd>

						<dt>stepSecond</dt>
							<dd><em>Default: 1</em> - Seconds per step the slider makes.</dd>

						<dt>stepMilliSec</dt>
							<dd><em>Default: 1</em> - Milliseconds per step the slider makes.</dd>

						<dt>hour</dt>
							<dd><em>Default: 0</em> - Initial hour set.</dd>

						<dt>minute</dt>
							<dd><em>Default: 0</em> - Initial minute set.</dd>

						<dt>second</dt>
							<dd><em>Default: 0</em> - Initial second set.</dd>

						<dt>millisec</dt>
							<dd><em>Default: 0</em> - Initial millisecond set.</dd>

						<dt>timezone</dt>
							<dd><em>Default: 0</em> - Initial timezone set.</dd>

						<dt>hourMin</dt>
							<dd><em>Default: 0</em> - The minimum hour allowed for all dates.</dd>

						<dt>minuteMin</dt>
							<dd><em>Default: 0</em> - The minimum minute allowed for all dates.</dd>

						<dt>secondMin</dt>
							<dd><em>Default: 0</em> - The minimum second allowed for all dates.</dd>

						<dt>millisecMin</dt>
							<dd><em>Default: 0</em> - The minimum millisecond allowed for all dates.</dd>

						<dt>hourMax</dt>
							<dd><em>Default: 23</em> - The maximum hour allowed for all dates.</dd>

						<dt>minuteMax</dt>
							<dd><em>Default: 59</em> - The maximum minute allowed for all dates.</dd>

						<dt>secondMax</dt>
							<dd><em>Default: 59</em> - The maximum second allowed for all dates.</dd>

						<dt>millisecMax</dt>
							<dd><em>Default: 999</em> - The maximum millisecond allowed for all dates.</dd>

						<dt>hourGrid</dt>
							<dd><em>Default: 0</em> - When greater than 0 a label grid will be generated under the slider.  This number represents the units (in hours) between labels.</dd>

						<dt>minuteGrid</dt>
							<dd><em>Default: 0</em> - When greater than 0 a label grid will be generated under the slider.  This number represents the units (in minutes) between labels.</dd>

						<dt>secondGrid</dt>
							<dd><em>Default: 0</em> - When greater than 0 a label grid will be genereated under the slider.  This number represents the units (in seconds) between labels.</dd>

						<dt>millisecGrid</dt>
							<dd><em>Default: 0</em> - When greater than 0 a label grid will be genereated under the slider.  This number represents the units (in milliseconds) between labels.</dd>
					</dl>

					<h3>Other Options</h3>
					<dl class="defs">
						<dt>showButtonPanel</dt>
							<dd><em>Default: true</em> - Whether to show the button panel at the bottom.  This is generally needed.</dd>

						<dt>timeOnly</dt>
							<dd><em>Default: false</em> - Hide the datepicker and only provide a time interface.</dd>

						<dt>onSelect</dt>
							<dd><em>Default: null</em> - Function to be called when a date is chosen or time has changed (parameters: datetimeText, datepickerInstance).</dd>

						<dt>alwaysSetTime</dt>
							<dd><em>Default: true</em> - Always have a time set internally, even before user has chosen one.</dd>

						<dt>separator</dt>
							<dd><em>Default: " "</em> - When formatting the time this string is placed between the formatted date and formatted time.</dd>

						<dt>pickerTimeFormat</dt>
							<dd><em>Default: (timeFormat option)</em> - How to format the time displayed within the timepicker.</dd>
						
						<dt>pickerTimeSuffix</dt>
							<dd><em>Default: (timeSuffix option)</em> - String to place after the formatted time within the timepicker.</dd>

						<dt>showTimepicker</dt>
							<dd><em>Default: true</em> - Whether to show the timepicker within the datepicker.</dd>

						<dt>addSliderAccess</dt>
							<dd><em>Default: false</em> - Adds the <a href="http://trentrichardson.com/2011/11/11/jquery-ui-sliders-and-touch-accessibility/" title="jQueryUI Slider Access Plugin">sliderAccess plugin</a> to sliders within timepicker</dd>

						<dt>sliderAccessArgs</dt>
							<dd><em>Default: null</em> - Object to pass to sliderAccess when used.</dd>

						<dt>defaultValue</dt>
							<dd><em>Default: null</em> - String of the default time value placed in the input on focus when the input is empty.</dd>

						<dt>minDateTime</dt>
							<dd><em>Default: null</em> - Date object of the minimum datetime allowed.  Also available as minDate.</dd>

						<dt>maxDateTime</dt>
							<dd><em>Default: null</em> - Date object of the maximum datetime allowed. Also Available as maxDate.</dd>

						<dt>parse</dt>
							<dd><em>Default: 'strict'</em> - How to parse the time string.  Two methods are provided: 'strict' which must match the timeFormat exactly, and 'loose' which uses javascript's new Date(timeString) to guess the time.  You may also pass in a function(timeFormat, timeString, options) to handle the parsing yourself, returning a simple object: 
<pre>{
	hour: 19,
	minute: 10,
	second: 23,
	millisec: 45,
	timezone: '-0400'
}</pre>
							</dd>
					</dl>

				</div>


				<!-- ############################################################################# -->
				<!-- Formatting
				<!-- ############################################################################# -->
				<div id="tp-formatting">

					<h2>Formatting Your Time</h2>

					<p>The default format is "HH:mm".  To use 12 hour time use something similar to: "hh:mm tt".  When both "t" and lower case "h" are present in the timeFormat, 12 hour time will be used.</p>

					<dl class="defs">
						<dt>H</dt><dd>Hour with no leading 0 (24 hour)</dd>
						<dt>HH</dt><dd>Hour with leading 0 (24 hour)</dd>
						<dt>h</dt><dd>Hour with no leading 0 (12 hour)</dd>
						<dt>hh</dt><dd>Hour with leading 0 (12 hour)</dd>
						<dt>m</dt><dd>Minute with no leading 0</dd>
						<dt>mm</dt><dd>Minute with leading 0</dd>
						<dt>s</dt><dd>Second with no leading 0</dd>
						<dt>ss</dt><dd>Second with leading 0</dd>
						<dt>l</dt><dd>Milliseconds always with leading 0</dd>
						<dt>t</dt><dd>a or p for AM/PM</dd>
						<dt>T</dt><dd>A or P for AM/PM</dd>
						<dt>tt</dt><dd>am or pm for AM/PM</dd>
						<dt>TT</dt><dd>AM or PM for AM/PM</dd>
						<dt>z</dt><dd>Timezone as defined by timezoneList</dd>
						<dt>'...'</dt><dd>Literal text (Uses single quotes)</dd>
					</dl>

					<p>Formats are used in the following ways:</p>
					<ul>
						<li>timeFormat option</li>
						<li>altTimeFormat option</li>
						<li>pickerTimeFormat option</li>
						<li>$.datepicker.formatTime(format, timeObj, options) utility method</li>
						<li>$.datepicker.parseTime(format, timeStr, options) utility method</li>
					</ul>

					<p>For help with  formatting the date portion, visit the datepicker documentation for <a href="http://docs.jquery.com/UI/Datepicker/formatDate" title="jQuery UI Datepicker Formatting">formatting dates</a>.</p>
				</div>

				<!-- ############################################################################# -->
				<!-- Localization
				<!-- ############################################################################# -->
				<div id="tp-localization">

					<h2>Working with Localizations</h2>
					
					<p>Timepicker comes with many translations and localizations, thanks to all the contributors.  They can be found in the localization folder in the git repo.</p>

					<p>The quick and cheap way to use localizations is to pass in options to a timepicker instance:</p>
			
<pre>$('#example123').timepicker({
	timeOnlyTitle: 'Выберите время',
	timeText: 'Время',
	hourText: 'Часы',
	minuteText: 'Минуты',
	secondText: 'Секунды',
	currentText: 'Теперь',
	closeText: 'Закрыть'
});
</pre>
					<p>However, if you plan to use timepicker extensively you will need to include (build your own) localization.  It is simply assigning those same variables to an object.  As you see in the example below we maintain a separate object for timepicker.  This way we aren't bound to any changes within datepicker.</p>
		
<pre>$.datepicker.regional['ru'] = {
	closeText: 'Закрыть',
	prevText: '&#x3c;Пред',
	nextText: 'След&#x3e;',
	currentText: 'Сегодня',
	monthNames: ['Январь','Февраль','Март','Апрель','Май','Июнь',
	'Июль','Август','Сентябрь','Октябрь','Ноябрь','Декабрь'],
	monthNamesShort: ['Янв','Фев','Мар','Апр','Май','Июн',
	'Июл','Авг','Сен','Окт','Ноя','Дек'],
	dayNames: ['воскресенье','понедельник','вторник','среда','четверг','пятница','суббота'],
	dayNamesShort: ['вск','пнд','втр','срд','чтв','птн','сбт'],
	dayNamesMin: ['Вс','Пн','Вт','Ср','Чт','Пт','Сб'],
	weekHeader: 'Не',
	dateFormat: 'dd.mm.yy',
	firstDay: 1,
	isRTL: false,
	showMonthAfterYear: false,
	yearSuffix: ''
};
$.datepicker.setDefaults($.datepicker.regional['ru']);


$.timepicker.regional['ru'] = {
	timeOnlyTitle: 'Выберите время',
	timeText: 'Время',
	hourText: 'Часы',
	minuteText: 'Минуты',
	secondText: 'Секунды',
	millisecText: 'Миллисекунды',
	timezoneText: 'Часовой пояс',
	currentText: 'Сейчас',
	closeText: 'Закрыть',
	timeFormat: 'HH:mm',
	amNames: ['AM', 'A'],
	pmNames: ['PM', 'P'],
	isRTL: false
};
$.timepicker.setDefaults($.timepicker.regional['ru']);
</pre>
					<p>Now all you have to do is call timepicker and the Russian localization is used.  Generally you only need to include the localization file, it will setDefaults() for you.</p>
					<p>You can also visit <a href="http://docs.jquery.com/UI/Datepicker/Localization" title="localization for datepicker" target="_BLANK">localization for datepicker</a> for more information about datepicker localizations.</p>
				</div>

				<!-- ############################################################################# -->
				<!-- Examples
				<!-- ############################################################################# -->
				<div id="tp-examples">
					<h2>Examples</h2>

					<ul>
						<li><a href="#basic_examples" title="Basic Initializations">Basic Initializations</a></li>
						<li><a href="#timezone_examples" title="Using Timezones">Using Timezones</a></li>
						<li><a href="#slider_examples" title="Slider Modifications">Slider Modifications</a></li>
						<li><a href="#alt_examples" title="Alternate Field">Alternate Fields</a></li>
						<li><a href="#rest_examples" title="Time Restraints">Time Restraints</a></li>
						<li><a href="#utility_examples" title="Utilities">Utilities</a></li>
					</ul>

					<h3 id="basic_examples">Basic Initializations</h3>

					<!-- ============= example -->
					<div class="example-container">
						<p>Add a simple datetimepicker to jQuery UI's datepicker</p>
						<div>
					 		<input type="text" name="basic_example_1" id="basic_example_1" value="" />
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
	 	<script type="text/javascript"> /*
		var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
		document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		*/</script> 
		<script type="text/javascript"> /*
		try {
		var pageTracker = _gat._getTracker("UA-7602218-1");
		pageTracker._trackPageview();
		} catch(err) {}*/</script>
	</body> 
</html>
