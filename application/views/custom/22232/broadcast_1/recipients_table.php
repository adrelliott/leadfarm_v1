<div class="" id="option1">
    <?php if ($fields['BroadcastName']['value']) echo "<h3>Your search is saved as '" . $fields['BroadcastName']['value'] . "'</h3>"; ?>
    <?php
        $this->table->set_template_custom(array (
            //'anchor_uri' => 'contactaction/view/edit_action', 
            //'anchor_uri_append' => $ContactId, 
            //'anchor_attr' => 'class="iframe" data-table-id="tab-5"'
            ));    
        $this->table->set_heading_custom(array(
            'Id' => '#', 
            'FirstName' => 'First Name', 
            'LastName' => 'Last Name', 
            '_ItemBought' => 'Product', 
            '_ValidUntil' => 'Season', 
            ));
        echo $this->table->generate_custom($tables['recipients']['table_data']);
    ?>
    <div class="margin_top_15">
        <a href="<?php echo base_url('/broadcast/advance_step/1/edit/view/' . $view_setup['rID']); ?>" class="button large grey left">
            New Search
        </a>
        <?php if ($view_setup['rID'] === 'new') : ?>
            <?php echo form_open('broadcast/add/edit'); ?>
            <h3 class="margin_top_30 right">Name this broadcast: 
                <?php 
                    echo form_hidden('Sql', $tables['recipients']['Sql']); 
                    echo form_input('BroadcastName'); 
                    echo form_submit('submit', 'Continue') 
                ?>
            </h3>
        <?php echo form_close(); ?>
        <?php else: ?>
            <a href="<?php echo base_url('/broadcast/advance_step/2/edit/' . $view_setup['rID']); ?>" class="button large red right">
                Go to Step 2...
            </a>
        <?php endif; ?>
    </div>
</div>