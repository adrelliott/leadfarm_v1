<div class="row clearfix"> 
    <div class="row">
        <div class="widget clearfix tabs">
            <ul>
                <li><h2><a href="#tab-1">Email</a></h2></li>
                <li><h2><a href="#tab-2">Letter</a></h2></li>
                <li><h2><a href="#tab-3">SMS text</a></h2></li>
            </ul>							
            <div class="widget_inside">
                <div id="tab-1"><!-- Start of tab 1 -->
                    <h3>Write an Email to <?php echo $view_setup['tables']['contact_info']['table_data']['FirstName'] . ' ' . $view_setup['tables']['contact_info']['table_data']['LastName']; ?></h3>
                    <div class="form">
                         <?php echo form_open( "/comms/add/new/$rID/$ContactId",  'class="ajax"' ) ; ?>
                            <?php echo display_field($fields['__Type'], array('label' => 'Communication Type', 'value' => 'Email', 'type' => 'hidden')); ?>
                            <?php echo display_field($fields['__From'], array('options' => $view_setup['dropdowns']['users'], 'value' => $view_setup['user_data']['Email'])); ?>
                            <?php echo display_field($fields['__To'], array('value' => $view_setup['tables']['contact_info']['table_data']['Email'])); ?>
                            <?php echo display_field($fields['__Subject']); ?>
                            <?php echo display_field($fields['__Content']); ?>
                            <div class="clearfix">
                                <input name='submit' type='submit' class='button red right large' style='float:right' value='Save'></input>
                            </div>
                        <?php echo form_close(); ?>
                    </div>
                </div>
                <div id="tab-2"><!-- Start of tab 1 -->
                    <h3>Send a Letter to <?php echo $view_setup['tables']['contact_info']['table_data']['FirstName'] . ' ' . $view_setup['tables']['contact_info']['table_data']['LastName']; ?></h3>
                <div class="form">
                    <?php echo form_open( "/comms/add/new/$rID/$ContactId", 'class="ajax"' ) ; ?>
                       <?php echo display_field($fields['__Type'], array('label' => 'Communication Type', 'value' => 'Letter', 'type' => 'hidden')); ?>
                       <?php echo display_field($fields['__Content'], array('extraHTMLInput' => 'rows=30')); ?>
                       <div class="clearfix">
                           <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                       </div>
                   <?php echo form_close(); ?>
                </div>
                <div id="tab-3"><!-- Start of tab 1 -->
                    <h3>Send an SMS text to <?php echo $view_setup['tables']['contact_info']['table_data']['FirstName'] . ' ' . $view_setup['tables']['contact_info']['table_data']['LastName']; ?></h3>
                    <div class="form">
                         <?php echo form_open( "/comms/add/new/$rID/$ContactId", 'class="ajax"' ) ; ?>
                            <?php echo display_field($fields['__Type'], array('label' => 'Communication Type', 'value' => 'Email', 'type' => 'text')); ?>
                            <?php echo display_field($fields['__From'], array('value' => $view_setup['user_data']['Email'])); ?>
                            <?php echo display_field($fields['__To'], array('value' => $view_setup['tables']['contact_info']['table_data']['Email'])); ?>
                            <?php echo display_field($fields['__Subject']); ?>
                            <?php echo display_field($fields['__Content']); ?>
                            <div class="clearfix">
                                <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                            </div>
                        <?php echo form_close(); ?>
                </div>
            </div>                
        </div>     
    </div>    
</div> 
        