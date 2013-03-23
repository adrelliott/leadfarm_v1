<h4 class="left">
    <a href="<?php echo site_url(DATAOWNER_ID . "/booking?current_day=" . $dates['yesterday']); ?>" class="right"><--Previous Day</a>
</h4>
<h4>
    <a href="<?php echo site_url(DATAOWNER_ID . "/booking?current_day=" . $dates['tomorrow']); ?>" class="right">Next Day --></a>
</h4>

<div class="row clearfix"> 
    <div class="row">
        <div class="col_12">
            <div class="widget clearfix tabs">
                <ul>
                    <li>
                        <h2><a href="#tab-1">Awaiting Check In</a></h2>
                    </li>
                    <li>
                        <h2><a href="#tab-2">Checked In</a></h2>
                    </li>
                    <li>
                        <h2><a href="#tab-3">In Progress</a></h2>
                    </li>
                    <li>
                        <h2><a href="#tab-4">Paused</a></h2>
                    </li>
                    <li>
                        <h2><a href="#tab-5">Completed</a></h2>
                    </li>
                    <li>
                        <h2><a href="#tab-6">Abandoned</a></h2>
                    </li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <h3>NOT CHECKED IN: Jobs for <?php echo $dates['current_day_nice']; ?> (<a href="<?php echo site_url(DATAOWNER_ID . "/booking?current_day=" . $dates['today']); ?>">Back to Today</a>)</h3>
                        <?php if (  array_key_exists('0', $tables['bookings']['table_data'] ) )
                            {
                                arsort( $tables['bookings']['table_data'][0] );
                                foreach ( $tables['bookings']['table_data'][0]  as $k => $array )
                                    include("v_booking_workshop/v_booking_single_job.php");
                            }
                            else echo '<p class="largePrint">Nothing to see here</p>';
                        ?>
                    </div>
                    <div id="tab-2">
                        <h3>CHECKED IN: Jobs for <?php echo $dates['current_day_nice']; ?> (<a href="<?php echo site_url(DATAOWNER_ID . "/booking?current_day=" . $dates['today']); ?>">Back to Today</a>)</h3>
                        <?php if (  array_key_exists('1', $tables['bookings']['table_data'] ) )
                            {
                                arsort( $tables['bookings']['table_data'][1] );
                                foreach ( $tables['bookings']['table_data'][1]  as $k => $array )
                                    include("v_booking_workshop/v_booking_single_job.php");
                            }
                            else echo '<p class="largePrint">Nothing to see here</p>';
                        ?>
                    </div>
                    <div id="tab-3">
                        <h3>IN PROGRESS: Jobs for <?php echo $dates['current_day_nice']; ?> (<a href="<?php echo site_url(DATAOWNER_ID . "/booking?current_day=" . $dates['today']); ?>">Back to Today</a>)</h3>
                        <?php if (  array_key_exists('2', $tables['bookings']['table_data'] ) )
                            {
                                arsort( $tables['bookings']['table_data'][2] );
                                foreach ( $tables['bookings']['table_data'][2]  as $k => $array )
                                    include("v_booking_workshop/v_booking_single_job.php");
                            }
                            else echo '<p class="largePrint">Nothing to see here</p>';
                        ?>
                    </div>
                    <div id="tab-4">
                       <h3>JOBS PAUSED: Jobs for <?php echo $dates['current_day_nice']; ?> (<a href="<?php echo site_url(DATAOWNER_ID . "/booking?current_day=" . $dates['today']); ?>">Back to Today</a>)</h3>
                        <?php if (  array_key_exists('3', $tables['bookings']['table_data'] ) )
                            {
                                arsort( $tables['bookings']['table_data'][3] );
                                foreach ( $tables['bookings']['table_data'][3]  as $k => $array )
                                    include("v_booking_workshop/v_booking_single_job.php");
                            }
                            else echo '<p class="largePrint">Nothing to see here</p>';
                        ?>
                    </div>
                    <div id="tab-5">
                        <h3>JOBS COMPLETED: Jobs for <?php echo $dates['current_day_nice']; ?> (<a href="<?php echo site_url(DATAOWNER_ID . "/booking?current_day=" . $dates['today']); ?>">Back to Today</a>)</h3>
                        <?php if (  array_key_exists('5', $tables['bookings']['table_data'] ) )
                            {
                                arsort( $tables['bookings']['table_data'][5] );
                                foreach ( $tables['bookings']['table_data'][5]  as $k => $array )
                                    include("v_booking_workshop/v_booking_single_job.php");
                            }
                            else echo '<p class="largePrint">Nothing to see here</p>';
                        ?>
                    </div>
                    <div id="tab-6">
                        <h3>JOBS ABANDONED: Jobs for <?php echo $dates['current_day_nice']; ?> (<a href="<?php echo site_url(DATAOWNER_ID . "/booking?current_day=" . $dates['today']); ?>">Back to Today</a>)</h3>
                        <?php if (  array_key_exists('4', $tables['bookings']['table_data'] ) )
                            {
                                arsort( $tables['bookings']['table_data'][4] );
                                foreach ( $tables['bookings']['table_data'][4]  as $k => $array )
                                    include("v_booking_workshop/v_booking_single_job.php");
                            }
                            else echo '<p class="largePrint">Nothing to see here</p>';
                        ?>
                    </div>
                </div>                
            </div><p class="right"><a href="<?php echo site_url(DATAOWNER_ID . '/booking?full_cal'); ?>">See full calender</a></p>
        </div>
    </div>
</div>




<?php //print_array($currentRecord, 'current record');?>
											
