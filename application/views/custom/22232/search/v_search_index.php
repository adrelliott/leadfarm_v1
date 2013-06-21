<?php
$criteria = array(
    '0' => 'Any',
    'equal' => 'Equals',
    'notequal' => "Doesn't equal",
    'greaterthan' => 'Is greater than',
    'lessthan' => 'Is less than'
);

$order_types = array(
                'Adult Membership' => 'Adult Membership', 
                'Junior Membership' => 'Junior Membership', 
                'Season Ticket (Adult)' => 'Season Ticket (Adult)', 
                'Season Ticket (Junior)' => 'Season Ticket (Junior) ', 
                'Community Shares' => 'Community Shares',
                'TreasureLine' => 'TreasureLine', 
                'Holiday Draw' => 'Holiday Draw',
                '127 Club' => '127 Club',
                'Match Sponsor' => 'Match Sponsor',
                'Matchball Sponsor' => 'Matchball Sponsor',
                'Matchday Programme Sponsor' => 'Matchday Programme Sponsor',
                'Programme Adverts' => 'Programme Adverts',
                'Pitchside Hording' => 'Pitchside Hording',
                'Pink Sponsorship' => 'Pink Sponsorship',
                'Newsletter Sponsor' => 'Newsletter Sponsor',
                'Community Sponsor' => 'Community Sponsor',
                'Youth Team Sponsor' => 'Youth Team Sponsor',
                'Women Team Sponsor' => 'Women Team Sponsor',
                'Player Sponsor' => 'Player Sponsor',
                'Club Donations' => 'Club Donations', 
                'DF Donations' => 'DF Donations', 
                'Club Events' => 'Club Events', 
                'Merchanidise' => 'Merchanidise', 
                'Away Match Travel' => 'Away Match Travel'
    );
$role_types = array(
        'Volunteer (Office)' => 'Volunteer (Office)', 
        'Volunteer (Matchday)' => 'Volunteer (Matchday)', 
        'Paid Office Staff' => 'Paid Office Staff', 
        'Community Staff' => 'Community Staff', 
        'Board Member' => 'Board Member', 
        'External Supplier' => 'External Supplier', 
        'Coaching/Backroom Staff' => 'Coaching/Backroom Staff', 
        '1st Team Player' => '1st Team Player', 
        'Youth Team Player' => 'Youth Team Player', 
        'Women\'s Team Player' => 'Women\'s Team Player',
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
                    <div class="clearfix margin_bottom_25">
                        <?php 
                        $report_type = $this->session->userdata('report_type');
                        echo '<span class="notification information col_9">' . $this->data['view_setup']['tables']['search_results']['count'] . ' records found. (<a href="' . site_url('search/export_as_csv/' . $report_type) . '">Download as CSV</a>)</span>'; ?>
                        <a href="<?php echo site_url('/search'); ?>" class="large red button right col_2 last">
                            <span>Create New Search</span>
                        </a>
                    </div>
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
                    <a href="<?php echo site_url('/search'); ?>" class="large red button left"><span>Create New Search</span></a>
                </div>
                </div>
                <div id="tab-2">
                    <h4 class="margin_bottom_25">What type of report do you want?</h4>
                    <h3 class="index toggle_icon" id="option1_toggle">Orders...</h3>
                    <div class="hide_toggle" id="option1">
                            <p>What would you like your report to show?</p>
                        <div class="col_12">
                            <div class="form">
                                <?php echo form_open('search/report/order'); ?>
                                <div class="clearfix" id="">
                                    <label for="order_type" class="" id="">Order Type: </label>
                                    <div class="input " id="">
                                        <h4>Let's see all contacts that have
                                        <?php //echo form_dropdown('order_type_operator[]',array('equal' => 'have got'), 'equal');?>
                                        <?php echo form_dropdown('order_type', $order_types, '0'); ?> in season 
                                        <?php echo form_dropdown('order_expire', array('0' => 'Any', '2005/06' => '2005/06', '2006/07' => '2006/07','2007/08' => '2007/08', '2009/10' => '2009/10', '2010/11' => '2011/12', '2012/13' => '2012/13', '2013/14' => '2013/14'), '0'); ?></h4>
                                        
                                        <?php //echo form_dropdown('order_type_operator[]',array('0' => '', 'equal' => 'have got', 'notequal' => 'have not got'), '0');?>
                                        <?php //echo form_dropdown('order_type[]',array_merge(array('0' => ''),$order_types), '0'); ?> 
                                        <?php //echo form_dropdown('order_expire[]', array('' => '', '0' => 'Any', '2005/06' => '2005/06', '2006/07' => '2006/07','2007/08' => '2007/08', '2009/10' => '2009/10', '2010/11' => '2011/12', '2012/13' => '2012/13', '2013/14' => '2013/14'), '0'); ?>
                                        
                                    </div>
                                </div>
                                <div class="clearfix" id="">
                                    <label for="order_date_operator" class="" id="">Restrict by Order Date?</label>
                                    <div class="input " id="">
                                        <h4>...who's order date is <?php echo form_dropdown('order_date_operator',  array(
    '0' => 'Any',
    'equal' => 'on',
    'greaterthan' => 'after',
    'lessthan' => 'before',
    'between' => 'between'
), '0');
                                        echo form_input('order_date_value', '','class="datepicker_thisyear" readonly="true"');
                                        echo ' and ' . form_input('order_date_value_between', '','class="datepicker_thisyear" readonly="true"') . "(Only use for 'between')";
                                        ?></h4>
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
                    <h3 class="index toggle_icon" id="option3_toggle">Roles...</h3>
                    <div class="hide_toggle" id="option3">
                            <p>What would you like your report to show?</p>
                        <div class="col_12">
                            <div class="form">
                                <?php echo form_open('search/report/role'); ?>
                                <div class="clearfix" id="">
                                    <label for="role_type" class="" id="">Role Type: </label>
                                    <div class="input " id="">
                                        <h4>Let's see all volunteers who were a
                                        <?php //echo form_dropdown('order_type_operator[]',array('equal' => 'have got'), 'equal');?>
                                        <?php echo form_dropdown('role_type', $role_types, '0'); ?> 
                                        <?php //echo form_dropdown('role_type_2', $role_types, '0'); ?> (optional)
                                       
                                        
                                        <?php //echo form_dropdown('order_type_operator[]',array('0' => '', 'equal' => 'have got', 'notequal' => 'have not got'), '0');?>
                                        <?php //echo form_dropdown('order_type[]',array_merge(array('0' => ''),$order_types), '0'); ?> 
                                        <?php //echo form_dropdown('order_expire[]', array('' => '', '0' => 'Any', '2005/06' => '2005/06', '2006/07' => '2006/07','2007/08' => '2007/08', '2009/10' => '2009/10', '2010/11' => '2011/12', '2012/13' => '2012/13', '2013/14' => '2013/14'), '0'); ?>
                                        
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <label for="role_type" class="" id="">Season</label>
                                    <div class="input " id="">
                                        <h4>in season  <?php echo form_dropdown('order_expire', array('0' => 'Any', '2005/06' => '2005/06', '2006/07' => '2006/07','2007/08' => '2007/08', '2009/10' => '2009/10', '2010/11' => '2011/12', '2012/13' => '2012/13', '2013/14' => '2013/14'), '0'); ?></h4>
                                    </div>
                                </div>
                                <div class="clearfix">
                                    <input name='submit' type='submit' class='button red right large' style='float:right' value='Start Search'></input>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <h3 class="index toggle_icon" id="option4_toggle">Bespoke...</h3>
                    <div class="hide_toggle" id="option4">
                        <a href="<?php echo site_url('search/custom_search'); ?>" class="button">Get all contacts, without membership in 2012/13</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //print_array($this->session->userdata('search_criteria')); ?>
<?php //print_array($this->data); ?>