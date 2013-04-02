<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">View Communications</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <h3>Details of Comms sent</h3>
                        <div class="form">
                                <?php echo display_field($fields['__Type'], array('label' => 'Communication Type', 'extraHTMLInput' => 'disabled="disabled"')); ?>
                                <?php echo display_field($fields['__From'], array('type' => 'text', 'extraHTMLInput' => 'disabled="disabled"')); ?>
                                <?php echo display_field($fields['__To'], array('extraHTMLInput' => 'disabled="disabled"')); ?>
                                <?php echo display_field($fields['__Subject'], array('extraHTMLInput' => 'disabled="disabled"')); ?>
                                <?php echo display_field($fields['__Content'], array('extraHTMLInput' => 'disabled="disabled"rows=15')); ?>
                        </div>
                    </div>
                </div>                
            </div>
        </div>      
    </div>    
</div> 
        