<?php 
    echo form_open(site_url('broadcast/send/1/edit/' . $view_setup['rID'] . '/44')); ?>
    <h3>
        <?php echo form_radio('TemplateId', '0', TRUE) ?>
        I want to send to everyone who's opted in
    </h3>
    <h3>
        <?php echo form_radio('___search_type', 'specific', FALSE) ?>
        I want to send to a specific group of fans
    </h3>
    <div id="specific" class="hidden margin_bottom_30">
        <?php //echo form_dropdown('TemplateId', '', '')?>
        
        <?php
            $this->table->set_template_custom(
                    array('anchor_uri' => 'broadcast/send/2' ,
                    'radio_flag'                 => TRUE,    // set to TRUE for checkboxes
                    //'radio_class'                 => '',    // can be blank for no class
                    'radio_name'                 => 'TemplateId',    // <input name="XXX"
                    'radio_value_is_id'          => TRUE,  //do we use row[ID] as value for checkbox?
                    )
                        );
            $this->table->set_heading_custom($tables['get_all_saved_searches']['table_headers']);
            echo $this->table->generate_custom($tables['get_all_saved_searches']['table_data']);
            ?>
            <div class="margin_top_15"></div>
            <div class="clearfix">
                <a href="<?php echo site_url('/campaign/view/edit/new'); ?>" target="_blank" class="grey button left"><span>Create New Search</span></a>
            </div>
    </div>
    <div class="clearfix">
        <input name='submit' type='submit' class='button red right large' value='Write email'></input>
    </div>

<?php echo form_close();?>
</div>

