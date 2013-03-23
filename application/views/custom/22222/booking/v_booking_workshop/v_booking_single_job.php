<div class="form widget_inside margin_top_25">    
    <?php echo form_open(DATAOWNER_ID . '/booking/mechanic_amend_booking/' . $array['Id'] . '/' . $dates['current_day']) ; ?>
        <div class="col_65 left">
                <h2 class="largePrint"><?php echo $array['time'] .' - ' . $array['_ActionSubtype']; ?></h2>
                <h4 class="largePrint"><?php
                        echo $array['__Make']
                         . ' ' . $array['__Model']
                         . ' <strong style="color:#345f0e">' . $array['__Registration']
                         . '</strong>';
                        ?>
                </h3>
                <h4>
                    <?php
                    echo 'For ' . $array['FirstName']
                    . ' ' . $array['LastName']
                    . ' (' . $array['_NotificationDetails']
                    . ' ' . $array['Phone1']
                    . ')';
                    ?>
                </h4>
                <h3 class="margin_top_25 margin_bottom_5">Notes on the Job:</h3>
                <p class="largePrint"><strong><?php echo $array['ActionDescription']; ?>: </strong><?php echo $array['CreationNotes']; ?></p>

        </div>

        <div class="col_44 right">
            
            <?php echo display_field($fields['UserID'], array('cssClassInputDiv' => ' largePrint ', 'cssClassInput' => ' largePrint', 'label' => 'Who\'s on it?', 'options' => $dropdowns['users'], 'value' => $array['UserID']));  ?>
            <?php echo display_field($fields['_EstimatedDuration'], array('cssClassInputDiv' => ' largePrint', 'cssClassInput' => ' largePrint', 'value' => $array['_EstimatedDuration']));  ?>
            <?php echo display_field($fields['_Status'], array('cssClassInputDiv' => ' largePrint width_95', 'cssClassInput' => ' largePrint', 'label' => '', 'blank_entry' => 'no', 'value' => $array['_Status'] ));  ?>
            <div class="clearfix">
                <input name='submit' type='submit' class='giant button blue right' style='float:right' value='SAVE!'></input>
            </div>

        </div>
        <?php echo form_close(); ?>
    <div class="clearfix"></div>
</div>

<?php /*
<div class="form widget_inside margin_top_25">    
    <?php echo form_open(DATAOWNER_ID . '/booking/mechanic_amend_booking/' . $array['Id'] . '/' . $_GET['current_day']) ; ?>
        <div class="col_65 left">
                <h2 class="largePrint"><?php echo $array['time'] .' - ' . $array['_ActionSubtype']; ?></h2>
                <h4 class="largePrint"><?php
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
                    . ' ' . $array['Phone1']
                    . ')';
                    ?>
                </h4>
                <h3 class="margin_top_25 margin_bottom_5">Notes on the Job:</h3>
                <p class="largePrint"><strong><?php echo $array['ActionDescription']; ?>: </strong><?php echo $array['CreationNotes']; ?></p>

        </div>

        <div class="col_44 right">
            <?php echo display_field($array['UserID'], array('cssClassInputDiv' => ' largePrint ', 'cssClassInput' => ' largePrint', 'label' => 'Who\'s on it?', 'options' => $dropdowns['users']));  ?>
            <?php echo display_field($array['_EstimatedDuration'], array('cssClassInputDiv' => ' largePrint', 'cssClassInput' => ' largePrint'));  ?>
            <?php echo display_field($array['_Status'], array('cssClassInputDiv' => ' largePrint width_95', 'cssClassInput' => ' largePrint', 'label' => '' ));  ?>
            <div class="clearfix">
                <input name='submit' type='submit' class='giant button blue right' style='float:right' value='SAVE!'></input>
            </div>

        </div>
        <?php echo form_close(); ?>
    <div class="clearfix"></div>
</div>
        */?>