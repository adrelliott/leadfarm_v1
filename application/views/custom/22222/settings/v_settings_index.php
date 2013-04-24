<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">Your Products</a></h2></li>
                    <li><h2><a href="#tab-2">Your Users</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <h3>Create/edit your products</h3>
                        <div class="dataTable-container" data-table-source="<?php echo html_escape(base_url() . $this->uri->uri_string() . '/index/index/products') ?>">
                            <?php include('v_settings_index/products.php'); ?>
                        </div>
                        <div class="clearfix margin_top_15">
                            <a href="<?php echo site_url("product/view/edit/new"); ?>" class="large blue button right iframe" data-table-id="tab-1">
                                <span>Create New Product</span>
                            </a>
                        </div>
                    </div>
                    <div id="tab-2"><!-- Start of tab 2 -->
                        <h3>Create/edit your users</h3>
                        <div class="dataTable-container" data-table-source="<?php echo html_escape(base_url() . $this->uri->uri_string() . '/index/index/users') ?>">
                            <?php include('v_settings_index/users.php'); ?>
                        </div>
                        <div class="clearfix margin_top_15">
                            <a href="<?php echo site_url("user/view/edit_modal/new"); ?>" class="large blue button right iframe" data-table-id="tab-2">
                                <span>Create New User</span>
                            </a>
                        </div>
                    </div>
                </div>                
            </div>
        </div>      
    </div>    
</div> 
