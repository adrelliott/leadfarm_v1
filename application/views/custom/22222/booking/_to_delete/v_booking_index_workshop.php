<h4 class="left">
    <a href="<?php echo site_url(DATAOWNER_ID . "/booking?current_day=" . $dates['yesterday']['date']); ?>" class="right"><--Previous Day</a>
</h4>
<h4>
    <a href="<?php echo site_url(DATAOWNER_ID . "/booking?current_day=" . $dates['tomorrow']['date']); ?>" class="right">Next Day --></a>
</h4>

<div class="row clearfix"> 
    <div class="row">
        <div class="col_12">
            <div class="widget clearfix tabs">
                <ul>
                    <li>
                        <h2><a href="#tab-1">Checked In</a></h2>
                    </li>
                    <li>
                        <h2><a href="#tab-2">Job Started</a></h2>
                    </li>
                    <li>
                        <h2><a href="#tab-3">Paused</a></h2>
                    </li>
                    <li>
                        <h2><a href="#tab-4">Completed</a></h2>
                    </li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <h3>Jobs for <?php echo $dates['today']['nice']; ?> (<a href="<?php echo site_url(DATAOWNER_ID . "/booking?current_day=" . date('Y-m-d')); ?>">Back to Today</a>)</h3>
                        <h4>Click on a job to assign it</h4>
                        <?php if ( !isset( $jobs['today'] ) ) 
                            echo "<p>No jobs on this day!</p>";
                            else foreach ( $jobs['today'] as $id => $array ) : ?>
                            <div class="form margin_top_30">
                                <div class="clearfix">
                                    <div class="input booking">
                                        <div class="booking_label">
                                            <h4><?php echo $array['time']; ?></h4>
                                        </div>
                                        <div class="booking_left">
                                            <h3>- <?php echo $array['ActionDescription']; ?></h3>
                                            <h3 class="green">
                                                - <?php 
                                                echo $array['__Make']
                                                    . ' ' . $array['__Model']
                                                    . ' (' . $array['__Registration']
                                                    . ')'; 
                                                ?>
                                            </h3>
                                            <h4>
                                                <?php 
                                                echo 'For ' . $array['FirstName']
                                                    . ' ' . $array['LastName']
                                                    . ' (' . $array['_NotificationDetails']
                                                    . '/' . $array['Phone1'] 
                                                    . ')'; 
                                                ?>
                                            </h4>
                                                <div class='clearfix'></div>
                                                <div class="left">
                                                    <label>Claim this Job</label>
                                                    <div class='largePrint'>
                                                            <!--<input class='large' type='text' name='Phone1' value='' id="listofProducts" />-->
                                                        <select id="choice"  class="largePrint"><?php //do not change this value- search demo.js for "#choice# ?> 
                                                            <option></option>
                                                            <option>Steve</option>
                                                            <option>Martin</option>
                                                            <option>Jason</option>
                                                            <option>Mick</option>
                                                            <option>Kevin</option>
                                                            <option>Melanie</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            <div class='clearfix left'>
                                                
                                                    <label>Claim this Job</label>
                                                    <div class=' largePrint'>
                                                            <!--<input class='large' type='text' name='Phone1' value='' id="listofProducts" />-->
                                                        <select id="choice"  class="largePrint"><?php //do not change this value- search demo.js for "#choice# ?> 
                                                            <option></option>
                                                            <option>Steve</option>
                                                            <option>Martin</option>
                                                            <option>Jason</option>
                                                            <option>Mick</option>
                                                            <option>Kevin</option>
                                                            <option>Melanie</option>
                                                        </select>
                                                    </div>
                                            </div>
                                            <div class='clearfix left'>
                                                    <label>Claim this Job</label>
                                                    <div class='input largePrint'>
                                                            <!--<input class='large' type='text' name='Phone1' value='' id="listofProducts" />-->
                                                        <select id="choice"  class="largePrint"><?php //do not change this value- search demo.js for "#choice# ?> 
                                                            <option></option>
                                                            <option>Steve</option>
                                                            <option>Martin</option>
                                                            <option>Jason</option>
                                                            <option>Mick</option>
                                                            <option>Kevin</option>
                                                            <option>Melanie</option>
                                                        </select>
                                                    </div>
                                                </div>
                                        </div>
                                            
                                            
                                            
                                            
                                            <?php echo display_field($array['field']['UserID'], array('cssClassInputDiv' => ' largePrint', 'cssClassInput' => ' largePrint', 'label' => 'Who\'s on this Job?', 'options' => $dropdowns['users']));  ?>
                                <?php echo display_field($array['field']['_EstimatedDuration'], array('cssClassInputDiv' => ' largePrint', 'cssClassInput' => ' largePrint'));  ?>
                                        </div>
                                        <div class="booking_right">
                                            <a href="<?php echo site_url(DATAOWNER_ID . "/booking/view/edit/" . $array['Id']); ?>" class="giant blue button"><span>START!</span></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div id="tab-2">
                        <div class="form  margin_top_30">
                            <div class="clearfix">
                                <label><h4>08:00</h4></label>
                                <div class="input booking">
                                    <div class="booking_left">
                                        <h3>Interim Service: Ford Fiesta (YG02 7YT)</h3>
                                        <h4>For Mrs Palmerston, 07703 34 56 33. 
                                    </div>
                                    <div class="booking_right">
                                        <a href="#" class="giant blue button"><span>DONE!</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-3">
                        <div class="form  margin_top_30">
                            <div class="clearfix">
                                <label><h4>08:00</h4></label>
                                <div class="input booking">
                                    <div class="booking_left">
                                        <h3>Interim Service: Ford Fiesta (YG02 7YT)</h3>
                                        <h4>For Mrs Palmerston, 07703 34 56 33. 
                                    </div>
                                    <div class="booking_right">
                                        <a href="#" class="giant blue button"><span>DONE!</span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php //print_array($currentRecord, 'current record');?>
											
