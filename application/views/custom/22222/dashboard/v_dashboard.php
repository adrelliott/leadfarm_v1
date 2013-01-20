<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>What now..?</h2>            
            <h3 class="index" id="option1_toggle">Find/create a contact...</h3>
            <div class="widget_inside hide_toggle" id="option1">
                <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit'));    
                    $this->table->set_heading_custom($tables['contacts']['table_headers']);
                    echo $this->table->generate_custom($tables['contacts']['table_data']); 
                ?> 
                <div class="margin_top_15"></div>
                <div class="clearfix">
                    <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contact/view/edit/ind" class="large blue button right"><span>Create New Contact</span></a>
                </div>
            </div>
            <h3 class="index" id="option2_toggle">Find/create an organisation...</h3>
            <div class="widget_inside hide_toggle" id="option2">
                <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit'));    
                    $this->table->set_heading_custom($tables['organisations']['table_headers']);
                    echo $this->table->generate_custom($tables['organisations']['table_data']); 
               ?> 
               <div class="margin_top_15"></div>
              <div class="clearfix">
                    <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contact/view/edit/org" class="large blue button right"><span>Create New Organisation</span></a>
                </div>
            </div>
            <h3 class="index" id="option3_toggle">Find a vehicle...</h3>
            <div class="widget_inside hide_toggle" id="option3">
            <?php 
                $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit/view', 'anchor_attr' => 'class="iframe"', 'primary_key_fieldname' => '__Id'));    
                $this->table->set_heading_custom($tables['vehicles']['table_headers']);
                echo $this->table->generate_custom($tables['vehicles']['table_data']); 
            ?>   			
            </div>
            <h3 class="index" id="option4_toggle">Find a Booking...</h3>
            <div class="widget_inside hide_toggle" id="option4">
            <?php 
                $this->table->set_template_custom(array ('anchor_uri' => 'pricelist/view', 'anchor_attr' => 'class="iframe"'));    
                $this->table->set_heading_custom($tables['bookings']['table_headers']);
                echo $this->table->generate_custom($tables['bookings']['table_data']); 
            ?>   	
            </div>        
        </div>        
    </div>
</div>
<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Standard Pricelist</h2>
            <div class="widget_inside">
                <?php echo form_open('pricelist/choose_recipients'); ?>
                <table class='dataTable'>
                    <thead>
                        <tr>
                            <th class="align-left">Job Type</th>
                            <th class="align-left">Time (hr:min)</th>
                            <th class="align-left">From (£)</th>
                            <th class="align-left">To (£)</th>
                            <th class="align-left">Skill level</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="gradeX selectJustOne">
                            <td><a href="pricelist/choose_recipients/1/Interim Service" class="iframe">Interim Service</a></td>
                            <td><a href="pricelist/choose_recipients/1/Interim Service" class="iframe">2:00</a></td>
                            <td><a href="pricelist/choose_recipients/1/Interim Service" class="iframe">125</a></td>
                            <td><a href="pricelist/choose_recipients/1/Interim Service" class="iframe">175</a></td>
                            <td><a href="pricelist/choose_recipients/1/Interim Service" class="iframe">Low</a></td>
                        </tr>
                        <tr class="gradeX selectJustOne">
                            <td><a href="pricelist/choose_recipients/2/Full Service" class="iframe">Full Service</a></td>
                            <td><a href="pricelist/choose_recipients/2/Full Service" class="iframe">400</a></td>
                            <td><a href="pricelist/choose_recipients/2/Full Service" class="iframe">225</a></td>
                            <td><a href="pricelist/choose_recipients/2/Full Service" class="iframe">275</a></td>
                            <td><a href="pricelist/choose_recipients/2/Full Service" class="iframe">Medium</a></td>
                        </tr>
                        <tr class="gradeX selectJustOne">
                            <td><a href="pricelist/choose_recipients/3/MOT" class="iframe">MOT</a></td>
                            <td><a href="pricelist/choose_recipients/3/MOT" class="iframe">1:30</a></td>
                            <td><a href="pricelist/choose_recipients/3/MOT" class="iframe">35</a></td>
                            <td><a href="pricelist/choose_recipients/3/MOT" class="iframe">35</a></td>
                            <td><a href="pricelist/choose_recipients/3/MOT" class="iframe">Low</a></td>
                        </tr>
                        <tr class="gradeX selectJustOne">
                            <td><a href="pricelist/choose_recipients/4/Cambelt Change" class="iframe">Cambelt Change</a></td>
                            <td><a href="pricelist/choose_recipients/4/Cambelt Change" class="iframe">4:00</a></td>
                            <td><a href="pricelist/choose_recipients/4/Cambelt Change" class="iframe">350</a></td>
                            <td><a href="pricelist/choose_recipients/4/Cambelt Change" class="iframe">390</a></td>
                            <td><a href="pricelist/choose_recipients/4/Cambelt Change" class="iframe">High</a></td>
                        </tr>
                        <tr class="gradeX selectJustOne">
                            <td><a href="pricelist/choose_recipients/5/Brake%20Replacement" class="iframe">Brake Replacement</a></td>
                            <td><a href="pricelist/choose_recipients/5/Brake Replacement" class="iframe">0:30</a></td>
                            <td><a href="pricelist/choose_recipients/5/Brake Replacement" class="iframe">75</a></td>
                            <td><a href="pricelist/choose_recipients/5/Brake Replacement" class="iframe">95</a></td>
                            <td><a href="pricelist/choose_recipients/5/Brake Replacement" class="iframe">Low</a></td>
                        </tr>
                        <tr class="gradeX selectJustOne">
                            <td><a href="pricelist/choose_recipients/6/Oil Filter Replacement" class="iframe">Oil Filter Replacement</a></td>
                            <td><a href="pricelist/choose_recipients/6/Oil Filter Replacement" class="iframe">0:45</a></td>
                            <td><a href="pricelist/choose_recipients/6/Oil Filter Replacement" class="iframe">15</a></td>
                            <td><a href="pricelist/choose_recipients/6/Oil Filter Replacement" class="iframe">25</a></td>
                            <td><a href="pricelist/choose_recipients/6/Oil Filter Replacement" class="iframe">Low</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>            
        </div>        
    </div>
</div>


    





















<h1>this is the custom!!! file for the dashboard..."</h1>
<p> FRONTEND! this what the view needs:</p>
    <ul>
    <li>a 'find client's link (& table)</li>
    <li>a 'find organisations link (& table)</li>
    <li>a 'find vehicles link (& table)</li>
    <li>a 'find bookings link (& table)</li>
    </ul>
    anything else? Check in the trello board<br/><br/><br/>"

    <p>BACKEND: This si the data that we need ot trrieve </p>
    <ul>
        <li>QUERY: contacts</li>
        <li>orgs</li>
        <li>QUERY: vehciles</li>
        <li>QUERY: actions (maybe as tasks?)</li>
        <li>Bookings</li>
    </ul>