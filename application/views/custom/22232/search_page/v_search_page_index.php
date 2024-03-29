<?php
$criteria = array(
    '0' => 'Any',
    'equal' => 'Equals',
    'notequal' => "Doesn't equal",
    'greaterthan' => 'Is greater than',
    'lessthan' => 'Is less than'
);

$order_types = array(
    '' => '',            
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
    '' => '',
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
$seasons =  array(
    ''=>'',  
    //'0' => 'Any', 
    '2005/06' => '2005/06', 
    '2006/07' => '2006/07',
    '2007/08' => '2007/08', 
    '2008/09' => '2008/09', 
    '2009/10' => '2009/10', 
    '2010/11' => '2010/11', 
    '2011/12' => '2011/12',
    '2012/13' => '2012/13', 
    '2013/14' => '2013/14');
$date_choices = array(
    '0' => 'Any',
    'equal' => 'on',
    'greaterthan' => 'after',
    'lessthan' => 'before',
    'between' => 'between'
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
                    <h2><a href="#tab-2">Find People</a></h2>
                </li>
                <? /*<li>
                    <h2><a href="#tab-3" >Find Orders</a></h2>
                </li>
                <li>
                    <h2><a href="#tab-4" >Find Opportunities</a></h2>
                </li> */ ?>
            </ul>
            <div class="widget_inside">
                <div id="tab-1">
                    <?php if (element('search_results', $this->data['view_setup']['tables'])): ?>
                    <div class="clearfix">
                        <a href="<?php echo site_url('/search_page'); ?>" class="button red left margin_bottom_25"><< Start Over </a>
                    </div>
                    
                    <div class="clearfix margin_bottom_25">
                        <?php 
                        $report_type = $this->session->userdata('report_type');
                        echo '<span class="notification information clearfix">' . $this->data['view_setup']['tables']['search_results']['count_results'] . ' records found. <a href="' . current_url() . '?view_table" class="">See all results (could take a while)</a></span>'; ?>
                        <!--<div class='form padding_5'>
                            <?php //echo form_open(site_url('search_page/save_this_search')); ?>
                            <p>
                                Save this search as:  
                                <?php// echo form_input('Name', element('search_name', $view_setup, '')); ?>
                                <?php //echo form_hidden('Query', $this->session->userdata('last_query'));?>
                                <?php //echo form_submit('submit', 'Save'); ?>
                            </p>
                            <?php //echo form_close(); ?>
                        </div>-->
                        <div>
                            <?php if (isset($_GET['view_table'])) include ('results_table.php'); ?>
                        </div>
                    </div>
                    <?php else : ?>
                        <?php if ($this->session->flashdata('message')) :?>
                            <?php echo '<span class="notification information clearfix">Search Saved!</span>'; ?>
                        <?php endif; ?>
                    <h4>Use one of the tabs to start a search or choose a saved search to run below (your results appear here)</h4>
                    <?php
                    $this->table->set_template_custom(array('anchor_uri' => 'search_page/do_search'));
                    $this->table->set_heading_custom($tables['get_all_saved_searches']['table_headers']);
                    echo $this->table->generate_custom($tables['get_all_saved_searches']['table_data']);
                    ?>
                    <?php endif; ?>
                </div>
                <div id="tab-2">
                    <h3>What kind of search do you want to do?</h3>
                    <h3 class="index toggle_icon" id="option1_toggle">Find people with certain orders...</h3>
                    <div class="hide_toggle" id="option1">
                        <div class="widget_inside clearfix margin_bottom_25">
                            <div class="col_6">
                                <div class='form padding_5'>
                                    <?php echo form_open('search_page/search/contact/order/or/fc_order_search'); ?>
                                    <h4>They've ordered ANY of these...</h4>
                                    <table id="contact_or">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                        </thead>
                                        <tr>
                                            <td>
                                                <h4><?php echo form_dropdown('fc_order_item[]', $order_types, ''); ?>
                                             in season <?php echo form_dropdown('fc_order_expire[]',$seasons, ''); ?></h4>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </table>
                                    <a class="button add_row  left small" table-id="contact_or">Add Row</a>
                                    <div class="margin_top_60 clearfix">
                                        <!--<h4>...in this time period <?php //echo form_dropdown('date[operator]',  $date_choices, '', ' div-id="date_choice" class="dropdown_reveal" ');
                                        //echo form_input('date[start]', '','class="datepicker_thisyear" readonly="true"');
                                        //echo '<div class="hidden date_choice" id="date_choice_between"> and ' . form_input('date[end]', '','class="datepicker_thisyear" readonly="true"') . "(Only use for 'between')</div>";
                                        ?></h4>-->
                                    </div>
                                    <div class="clearfix">
                                        <input name='submit' type='submit' class='button red right large' style='float:right' value='Do This Search!'></input>

                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                            <div class="col_6 last">
                                <div class='form padding_5'>
                                    <?php echo form_open('search_page/search/contact/order/and/fc_order_search'); ?>
                                    <h4>OR They've ordered ALL of these:</h4>
                                    <table id="contact_and">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                        </thead>
                                        <tr>
                                            <td>
                                                <h4><?php echo form_dropdown('fc_order_item[]', $order_types, ''); ?>
                                             in season <?php echo form_dropdown('fc_order_expire[]',$seasons, ''); ?></h4>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </table>
                                    <a class="button add_row  left small" table-id="contact_and">Add Row</a>
                                    <div class="margin_top_60 clearfix">
                                        <!--<h4>...in this time period <?php //echo form_dropdown('date[operator]',  $date_choices, '', ' div-id="date_choice" class="dropdown_reveal" ');
                                        //echo form_input('date[start]', '','class="datepicker_thisyear" readonly="true"');
                                        //echo '<div class="hidden date_choice" id="date_choice_between"> and ' . form_input('date[end]', '','class="datepicker_thisyear" readonly="true"') . "(Only use for 'between')</div>";
                                        ?></h4>-->
                                    </div>
                                    <div class="clearfix">
                                        <input name='submit' type='submit' class='button red right large' style='float:right' value='Do This Search!'></input>

                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<h3 class="index toggle_icon" id="option2_toggle">Find people with certain roles...</h3>-->
                    <div class="hide_toggle" id="option2">
                        <div class="widget_inside clearfix margin_bottom_25">
                            <div class="col_6">
                                <div class='form padding_5'>
                                    <?php echo form_open('search_page/search/contact/contactaction/or/fc_role_search'); ?>
                                    <h4>They've had ANY of these roles...</h4>
                                    <table id="role_or">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                        </thead>
                                        <tr>
                                            <td>
                                                <h4><?php echo form_dropdown('fc_role[]', $role_types, ''); ?>
                                             in season <?php echo form_dropdown('fc_role_expire[]',$seasons, ''); ?></h4>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </table>
                                    <a class="button add_row  left small" table-id="role_or">Add Row</a>
                                    <div class="margin_top_60 clearfix">
                                        <!--<h4>...in this time period <?php //echo form_dropdown('date[operator]',  $date_choices, '', ' div-id="date_choice" class="dropdown_reveal" ');
                                        //echo form_input('date[start]', '','class="datepicker_thisyear" readonly="true"');
                                        //echo '<div class="hidden date_choice" id="date_choice_between"> and ' . form_input('date[end]', '','class="datepicker_thisyear" readonly="true"') . "(Only use for 'between')</div>";
                                        ?></h4>-->
                                    </div>
                                    <div class="clearfix">
                                        <input name='submit' type='submit' class='button red right large' style='float:right' value='Do This Search!'></input>

                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                            <div class="col_6 last">
                                <div class='form padding_5'>
                                    <?php echo form_open('search_page/search/contact/contactaction/and/fc_role_search'); ?>
                                    <h4>OR They've had ALL of these roles:</h4>
                                    <table id="role_and">
                                        <thead>
                                            <th></th>
                                            <th></th>
                                        </thead>
                                        <tr>
                                            <td>
                                                <h4><?php echo form_dropdown('fc_role[]', $role_types, ''); ?>
                                             in season <?php echo form_dropdown('fc_role_expire[]',$seasons, ''); ?></h4>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </table>
                                    <a class="button add_row  left small" table-id="role_and">Add Row</a>
                                    <div class="margin_top_60 clearfix">
                                        <!--<h4>...in this time period <?php //echo form_dropdown('date[operator]',  $date_choices, '', ' div-id="date_choice" class="dropdown_reveal" ');
                                        //echo form_input('date[start]', '','class="datepicker_thisyear" readonly="true"');
                                        //echo '<div class="hidden date_choice" id="date_choice_between"> and ' . form_input('date[end]', '','class="datepicker_thisyear" readonly="true"') . "(Only use for 'between')</div>";
                                        ?></h4>-->
                                    </div>
                                    <div class="clearfix">
                                        <input name='submit' type='submit' class='button red right large' style='float:right' value='Do This Search!'></input>

                                    </div>
                                    <?php echo form_close(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //print_array($this->session->userdata('search_criteria')); ?>
<?php 

//print_array($_SESSION);
//print_array($this->data); ?>