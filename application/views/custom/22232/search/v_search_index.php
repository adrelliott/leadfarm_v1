<?php
$criteria = array(
    '0' => 'Any',
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
                    <h2><a href="#tab-2">Saved Searches/Reports</a></h2>
                </li>
            </ul>
            <div class="widget_inside">
                <div id="tab-1">
                    <?php     
                        if (element('tables', $this->data['view_setup'])) { ?>
                        <?php echo '<span class="notification information">' . $this->data['view_setup']['tables']['search_results']['count'] . ' records found. (<a href="' . site_url('search/export_as_csv/order') . '">Download as CSV</a>)</span>'; ?>
                            <table>
                                <tr>
                                    <?php foreach ($this->data['view_setup']['tables']['search_results']['table_headers'] as $col => $label): ?>
                                    <th><?php echo $label; ?></th>
                                    <?php endforeach; ?>
                                </tr>
                                <?php foreach ($this->data['view_setup']['tables']['search_results']['table_data'] as $row => $table_data) : ?>
                                <tr>
                                    <?php foreach ($table_data as $col => $val) : ?>
                                    <td><?php echo $val; ?></td>
                                    <?php endforeach; ?>
                                </tr>
                                <?php endforeach; ?>
                            </table>
                            <?php echo '<h4 class="margin_top_15">' . $this->data['view_setup']['tables']['search_results']['pagination_links'] . '</h4>'; ?>
                        <?php } else echo '<h3>Click on a tab to start a search</h3>'; ?>
                    <div class="clearfix">
                    <a href="<?php echo site_url('/search'); ?>" class="large red button right"><span>Create New Search</span></a>
                </div>
                </div>
                <div id="tab-2">
                    <h4 class="margin_bottom_25">What type of report do you want?</h4>
                    <h3 class="index toggle_icon" id="option1_toggle">Orders...</h3>
                    <div class="hide_toggle" id="option1">
                            <p>What would you like your report to show?</p>
                        <div class="col_8">
                            <div class="form">
                                <?php echo form_open('search/report/order'); ?>
                                <div class="clearfix" id="">
                                    <label for="order_type" class="" id="">What order type do you want to see?</label>
                                    <div class="input " id="">
                                        <h4><?php echo form_dropdown('order_type', array('0' => 'All Order Types', 'Adult Membership' => 'Adult Membership', 'Junior Membership' => 'Junior Membership'), '0'); ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix" id="">
                                    <label for="order_date_operator" class="" id="">Restrict by Order Date?</label>
                                    <div class="input " id="">
                                        <h4>Order date: <?php echo form_dropdown('order_date_operator',  array(
    '0' => 'Any',
    'equal' => 'Is on',
    'greaterthan' => 'Is after',
    'lessthan' => 'Is before'
), '0');
                                        echo form_input('order_date_value', '','class="datepicker_thisyear" readonly="true"');
                                        ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix" id="">
                                    <label for="order_expire" class="" id="">What Season?</label>
                                    <div class="input " id="">
                                        <h4><?php echo form_dropdown('order_expire', array('0' => 'Any', '2010/11' => '2011/12', '2012/13' => '2012/13', '2013/14' => '2013/14')); ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button red right large' style='float:right' value='Start Search'></input>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <h3 class="index toggle_icon" id="option2_toggle">Contacts...</h3>
                    <div class="hide_toggle" id="option2">
                        <p>Coming soon...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //print_array($this->session->userdata('search_criteria')); ?>
<?php //print_array($this->data); ?>