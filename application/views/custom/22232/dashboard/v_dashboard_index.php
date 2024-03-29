<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h3 class="index speech_icon">"Hello <?php echo $this->session->userdata('Nickname'); ?> . Please select from the options below:"</h3>
            <a href="<?php echo site_url('contact'); ?>" style="text-decoration: none"><h3 class="index toggle_icon">Fans...</h3></a>
            <h3 class="index toggle_icon" id="option3_toggle">Campaigns...</h3>
            <div class="widget_inside hide_toggle" id="option3">
                <div class="margin_top_15"></div>
                <?php
                $this->table->set_template_custom(array('anchor_uri' => 'campaign/view/edit'));
                $this->table->set_heading_custom($tables['campaigns']['table_headers']);
                echo $this->table->generate_custom($tables['campaigns']['table_data']);
                ?>
                <div class="margin_top_15"></div>
                <div class="clearfix">
                    <a href="<?php echo site_url('/campaign/view/edit/new'); ?>" class="large red button right"><span>Create New Campaign</span></a>
                </div>
            </div>
            <div class="clearfix"></div>
            <h3 class="index toggle_icon" id="option2_toggle">Stats & Reports...</h3>
            <div class="widget_inside hide_toggle" id="option2">
                <table class="regular">
                    <thead>
                        <tr>
                            <th class="align-left"><h4>Contacts in FRM</h4></th>
                    <th class="align-left"><h4>Value</h4></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Total Number of Contacts</td>
                            <td><h4><?php echo $stats['count_all_records']; ?></h4></td>
                        </tr>
                        <tr>
                            <td>Total Number of Adult Contacts</td>
                            <td><h4><?php echo $stats['count_all_adult_records']; ?></h4></td>
                        </tr>
                        <tr>
                            <td>Total Number of Junior Contacts</td>
                            <td><h4><?php echo $stats['count_all_junior_records']; ?></h4></td>
                        </tr>
                    </tbody>
                </table>
                <table class="regular margin_top_30">
                    <thead>
                        <tr>
                            <th class="align-left"><h4>Members in FRM</h4></th>
                    <th class="align-left"><h4>Value</h4></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Number of Adult members</td>
                            <td><h4><?php echo $stats['count_all_adult_membership_records']; ?></h4></td>
                        </tr>
                        <tr>
                            <td>Number of Junior members</td>
                            <td><h4><?php echo $stats['count_all_junior_membership_records']; ?></h4></td>
                        </tr>
                    </tbody>
                </table>
                <table class="regular margin_top_30">
                    <thead>
                        <tr>
                            <th class="align-left"><h4>Season Ticket Holders in FRM</h4></th>
                    <th class="align-left"><h4>Value</h4></th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Number of Adult Season Tickets</td>
                            <td><h4><?php echo $stats['count_all_adult_seasonticket_records']; ?></h4></td>
                        </tr>
                        <tr>
                            <td>Number of Junior Season Tickets</td>
                            <td><h4><?php echo $stats['count_all_junior_seasonticket_records']; ?></h4></td>
                        </tr>
                    </tbody>
                </table>
                <div class="margin_top_15"></div>
                 <div class="clearfix">
                    <a href="<?php echo site_url('/search'); ?>" class="large red button right"><span>Create New Search</span></a>
                </div>

            </div>
        </div>        
    </div>
</div>
