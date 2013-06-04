<?php
$criteria = array(
    0 => 'Any',
    'equal' => 'Equals',
    'notequal' => "Doesn't equal",
    'greaterthan' => 'Is greater than',
    'lessthan' => 'Is less than'
);
?>
<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix tabs"> 
            <ul>
                <li>
                    <h2><a href="#tab-1">Search Results</a></h2>
                </li>
                <li>
                    <h2><a href="#tab-2">Search by Field</a></h2>
                </li>
                <li>
                    <h2><a href="#tab-3">Saved Searches/Reports</a></h2>
                </li>
            </ul>
            <div class="widget_inside">
                <div id="tab-1">
                    <?php
                    //if (element('table_headers', $this->data['view_setup']['tables']['search_results'])) {
                    if ($this->data) {
                        //$this->table->set_heading_custom($tables['search_results']['table_headers']);
                        //echo $this->table->generate_custom($tables['search_results']['table_data']);
                        /*echo form_open(site_url('contact/search/1'));
                        echo form_hidden('_::_query', $tables['search_results']['query']);
                        echo form_close();

                        //now create the export form
                        $post_data = $this->data['tables']['search_results']['post_data'];
                        echo form_open('contact/search/export');
                        echo form_hidden('FirstName[operation]', element('operation', $post_data['FirstName']));
                        echo form_hidden('FirstName[value]', element('value', $post_data['FirstName']));
                        echo form_hidden('LastName[operation]', element('operation', $post_data['LastName']));
                        echo form_hidden('LastName[value]', element('value', $post_data['LastName']));
                        echo form_submit('_::_submit', 'Export as CSV');
                        echo form_close();
                         * 
                         */
                        print '<div class="margin_top_15"></div>
                    <div class="clearfix">
                        <a href="' . site_url('contact/search') . '" class="large button left"><span>New Search</span></a>
                    </div>';
                    }
                    else
                        echo "<h3>Use the tabs above to search</h3>";
                    ?> 
                </div>
                <div id="tab-2">
                    <?php include('fieldsets/v_contact_searchform.php'); ?>
                </div>
                <div id="tab-3">
                    <h4 class="margin_bottom_25">What type of report do you want?</h4>
                    <h3 class="index toggle_icon" id="option1_toggle">Contact...</h3>
                    <div class="hide_toggle" id="option1">
                            <p>What would you like your report to show?</p>
                        <div class="col_8">
                            <div class="form">
                                <?php echo form_open('search/report/order'); ?>
                                <div class="clearfix" id="">
                                    <label for="order_type" class="" id="">What order type do you want to see?</label>
                                    <div class="input " id="">
                                        <h4><?php echo form_dropdown('order_type', array(0 => 'All Order Types', 'Adult Membership' => 'Adult Membership', 'Junior Membership' => 'Junior Membership'), 'Adult Membership'); ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix" id="">
                                    <label for="order_date_operator" class="" id="">Restrict by Order Date?</label>
                                    <div class="input " id="">
                                        <h4>Order date <?php echo form_dropdown('order_date_operator', array(
    0 => 'Any',
    'equal' => 'Is on',
    'greaterthan' => 'Is after',
    'lessthan' => 'Is before'
), 0);
                                        echo form_input('order_date_value', '','class="datepicker_thisyear" readonly="true"');
                                        ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix" id="">
                                    <label for="order_expire" class="" id="">What Season?</label>
                                    <div class="input " id="">
                                        <h4><?php echo form_dropdown('order_expire', array(0 => 'Any', '2010/11' => '2011/12', '2012/13' => '2012/13', '2013/14' => '2013/14')); ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix" id="">
                                    <label for="export" class="" id="">How do you want to see the results?</label>
                                    <div class="input " id="">
                                        <h4><?php echo form_dropdown('export', array(0 => 'Table on Screen', 1 => 'Export as CSV'), 0); ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button red right large' style='float:right' value='Start Search'></input>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                        <div class="col_4 last">
                            <h4>Headnline</h4>
                            <p>instructions</p>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <h3 class="index toggle_icon" id="option2_toggle">Order...</h3>
                    <div class="hide_toggle" id="option2">
                        <p>order</p>
                    </div>
                    <h3 class="index toggle_icon" id="option3_toggle">Other...</h3>
                    <div class="hide_toggle" id="option3">
                        <p>other</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php echo print_array($this->data); ?>