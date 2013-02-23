<?php 
    //if ($this->data['message']) {echo '<span class="notification information">'
    //    . $this->data['message'] . '</span>';} 
?>
<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Find Campaigns</h2>
            <div class="widget_inside">   
                 <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'campaign/view/edit'));    
                    $this->table->set_heading_custom($tables['campaigns']['table_headers']);
                    echo $this->table->generate_custom($tables['campaigns']['table_data']); 
                ?>
                <div class="margin_top_15"></div>
                <div class="clearfix">
                    <a href="<?php echo site_url() . DATAOWNER_ID; ?>/campaign/view/edit/new" class="large blue button right"><span>Create New Campaign</span></a>
                </div>
            </div>
        </div>
    </div>
</div>