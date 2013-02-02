
<div class="col_12 last">
    <div class="row clearfix">
        <div class="row"><!-- Tabs begin -->
            <div class="widget clearfix tabs">
                <ul>
                    <li>
                        <h2><a href="#tab-1">Schedule the Booking</a></h2>
                    </li>
                    <li style="<?php //echo $display_none; ?>"">
                        <h2><a href="#tab-2">Check Vehicle In</a></h2>
                    </li>
                    </li>
                    <li style="<?php //echo $display_none; ?>"">
                        <h2><a href="#tab-3">Manage Job</a></h2>
                    </li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                        <div class="col_5">
                            <div class="form">
                                <?php display_field($fields['_ActionSubtype']); ?>
                                <?php display_field($fields['ActionDescription']); ?>
                                <?php display_field($fields['_EstimatedDuration']); ?>
                                <?php display_field($fields['ActionDate']); ?>
                                <?php display_field($fields['_VehicleId'], array('options' => array(''=>'', 'YG02 YTR (Ford Fiesta)' => '1', 'T999 RTE (BMW 535d)' => '2'))); ?> 
                                <?php display_field($fields['_NotificationDetails'], array('options' => array(''=>'','Mobile' => '1', 'SMS Text' => '2', 'Work Number' => 3, 'Email' => 4))); ?>
                                <?php echo form_hidden('ActionType', 'Booking'); ?>
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right medium' style='float:right' value='Save'></input>
                                </div>
                            </div>
                        </div>
                        <div class="col_7 last">
                            <div id="calendar"></div>
                        </div>
                    </div>
                    <div id="tab-2">
                        <div class="col_8">
                            <div class="form">
                                <?php display_field($fields['_Status']); ?>
                                <?php display_field($fields['_ActionSubtype']); ?>
                                <?php display_field($fields['ActionDescription']); ?>
                                <?php display_field($fields['_EstimatedDuration']); ?>
                                <?php display_field($fields['EndDate']); ?>
                                 <?php display_field($fields['_NotificationDetails'], array('options' => array(''=>'','Mobile' => '1', 'SMS Text' => '2', 'Work Number' => 3, 'Email' => 4))); ?>
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right medium' style='float:right' value='Save'></input>
                                </div>
                            </div>
                        </div>
                        <div class="col_4 last">
                            <h3>Vehicle Notes:</h3>
                            <ul>
                                <li><h4>This job is described as: <strong>MOT</strong>,</h4></h4></li>
                                <li><h4>The reg of this vehicle is <strong>YG02 YTR</strong>,</h4></li>
                                <li><h4>The job is estimated to be <strong>3 hours</strong>,</h4></li>
                            </ul>
                                   <br/>
                            <p><strong>All Notes on the vehicle go here...</strong></p><p>Nulla et feugiat magna. Fusce fringilla purus vitae leo dapibus cursus. Maecenas id purus eget risus mattis volutpat. </p>
                                   <p>Fusce in ligula sit amet nisi volutpat volutpat. Mauris varius leo eu massa blandit nec faucibus nibh ullamcorper. Aenean auctor viverra justo eu placerat. Mauris sed lectus nibh. </p>
                                   <p>Praesent fermentum, mauris non aliquam fringilla, eros libero tempor ipsum, at pretium urna quam sed est. </p>
                                   <p>Nam libero purus, rhoncus a pulvinar a, sollicitudin eget quam. Curabitur semper, leo non tristique eleifend, neque tellus pellentesque leo, in fringilla purus mauris in magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                                   <p> Etiam semper tellus in metus dictum pretium.</p>                               
                        </div>
                    </div>
                    <div id="tab-3">
                        <div class="col_8">
                            <div class="form">
                                <?php display_field($fields['_Status']); ?>
                                <?php display_field($fields['UserID'], array( 'options' => array('George' => 1, 'Martin' => 2, 'Jason' => 3, 'Amanda' => 4))); ?>
                                <?php display_field($fields['CreationNotes']); ?>
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button blue right medium' style='float:right' value='Save'></input>
                                </div>
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button green right larger' style='float:right; margin-right: 20px' value='Job Complete'>
                                    <input name='submit' type='submit' class='button red right larger' style='float:right; margin-right: 20px' value='Job Paused'>                                    
                                </div>
                            </div>
                        </div>
                        <div class="col_4 last">
                            <h3>Vehicle Notes:</h3>
                            <ul>
                                <li><h4>This job is described as: <strong>MOT</strong>,</h4></h4></li>
                                <li><h4>The reg of this vehicle is <strong>YG02 YTR</strong>,</h4></li>
                                <li><h4>The job is estimated to be <strong>3 hours</strong>,</h4></li>
                            </ul>
                                   <br/>
                            <p><strong>All Notes on the vehicle go here...</strong></p><p>Nulla et feugiat magna. Fusce fringilla purus vitae leo dapibus cursus. Maecenas id purus eget risus mattis volutpat. </p>
                                   <p>Fusce in ligula sit amet nisi volutpat volutpat. Mauris varius leo eu massa blandit nec faucibus nibh ullamcorper. Aenean auctor viverra justo eu placerat. Mauris sed lectus nibh. </p>
                                   <p>Praesent fermentum, mauris non aliquam fringilla, eros libero tempor ipsum, at pretium urna quam sed est. </p>
                                   <p>Nam libero purus, rhoncus a pulvinar a, sollicitudin eget quam. Curabitur semper, leo non tristique eleifend, neque tellus pellentesque leo, in fringilla purus mauris in magna. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos.</p>
                                   <p> Etiam semper tellus in metus dictum pretium.</p>                               
                        </div>
                    </div>
                </div>
            </div>                            
        </div>                        
    </div>                    
</div>