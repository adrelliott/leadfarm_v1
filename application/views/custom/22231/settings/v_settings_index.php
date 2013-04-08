<div class="col_12"><!-- Start Column 1-->
    <div class="row clearfix">
        <div class="row"><!-- Tabs begin -->
            <div class="widget clearfix tabs">
                <ul>
                    <li>
                        <h2><a href="#tab-1">Users</a></h2>
                    </li>
                    <li>
                        <h2><a href="#tab-2">Products</a></h2>
                    </li>
                </ul>
                <div class="widget_inside">
                    <div id="tab-1">
                    </div>               
                    <div id="tab-2">
                        <div class="dataTable-container" data-table-source="<?php echo html_escape (base_url () . $this->uri->uri_string () . '/products') ?>">
                            <?php include ('v_settings_index/products.php') ?>
                        </div>
                        <div class="clearfix margin_top_15">
                           <a href="<?php echo site_url("product/view/edit/new"); ?>" class="large blue button right iframe" data-table-id="tab-2">
                               <span>Create New Action</span>
                           </a>
                       </div>
                    </div>              
                </div>
            </div>
        </div>        
    </div>
</div>