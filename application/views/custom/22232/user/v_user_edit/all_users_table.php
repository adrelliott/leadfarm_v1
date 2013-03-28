<div class="clearfix margin_top_30">    
    <h4>All Other Users</h4>
    <?php
        $this->table->set_template_custom(array ('anchor_uri' => 'user/view/edit',  'anchor_uri_append' => '', 'primary_key_fieldname' => 'Id')); 
        $this->table->set_heading_custom($tables['users']['table_headers']);
        echo $this->table->generate_custom($tables['users']['table_data']); 
    ?>
    <div class="clearfix margin_top_15">
        <a href="<?php echo site_url( '/user/view_modal/edit_modal/new' ); ?>" class="large blue button right iframe" data-table-id="">
            <span>Create New User</span>
        </a>
    </div>
    
</div>