<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Find Contacts</h2>

            <div class="widget_inside">                
               <?php
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => '0', 'ContactId_name' => 'Id'));    
                    $this->table->set_heading_custom($this->contactsearch_model->get_datatable_headers ());
                    echo $this->table->generate_custom($this->contactsearch_model->search ()); 
                ?> 
                <div class="margin_top_15"></div>
                <div class="clearfix">
                    <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contact/view/edit/new/new/0" class="large blue button right"><span>Create New Contact</span></a>
                </div>
                <h3 class="index toggle_icon" id="option1_toggle">Looking for an Organisation?</h3>
                <div class="hide_toggle" id="option1">
                    <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit', 'anchor_uri_append' => '1', 'ContactId_name' => 'Id'));    
                    $this->table->set_heading_custom($tables['organisations']['table_headers']);
                    echo $this->table->generate_custom($tables['organisations']['table_data']); 
                    ?> 
                    <div class="margin_top_15"></div>
                    <div class="clearfix">
                        <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contact/view/edit/new/new/1" class="large blue button right"><span>Create New Organisation</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Contact Search</h2>
            <div class="widget_inside">

<?php

$this->contactsearch_model->search ();

?>

                <form id="contact-search" method="post" action="<?php echo html_escape ($_SERVER['REQUEST_URI']) ?>"></form>

                <script type="text/javascript">
jQuery (document).ready (function ($) {
    var options;
    var plugin;

    options = {
        'operations' : <?php echo json_encode ($this->contactsearch_model->get_valid_operations ()) ?>,
        'tags' : <?php echo json_encode ($this->contactgroup_model->get ()) ?>,
        'fields' : <?php echo json_encode ($this->contactsearch_model->get_valid_fields ()) ?>,
        'searches' : <?php echo json_encode ($this->contactsearch_model->get_previous_searches ()) ?>
    };

    $('#contact-search').contactsearch (options);

    plugin = $('#contact-search').data ('contactsearch');

    <?php if ($this->contactsearch_model->get_id ()): ?>
    plugin.setSearch (<?php echo json_encode ($this->contactsearch_model->get_id ()) ?>, <?php echo json_encode ($this->contactsearch_model->get_name ()) ?>);
    <?php endif; ?>

    plugin.setCriteria (<?php echo json_encode ($this->contactsearch_model->get_criteria ()) ?>);
    plugin.includeTags (<?php echo json_encode ($this->contactsearch_model->get_included_tag_ids ()) ?>);
    plugin.excludeTags (<?php echo json_encode ($this->contactsearch_model->get_excluded_tag_ids ()) ?>);
    plugin.start ();

});
                </script>
            </div>
        </div>
    </div>
</div>
