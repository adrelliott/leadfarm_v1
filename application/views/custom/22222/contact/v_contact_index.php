<?php 
    //if ($this->data['message']) {echo '<span class="notification information">'
    //    . $this->data['message'] . '</span>';} 
?>
<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Find Contacts</h2>
            <div class="widget_inside">                
               <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'contact/view/edit'));    
                    $this->table->set_heading_custom($tables['contacts']['table_headers']);
                    echo $this->table->generate_custom($tables['contacts']['table_data']); 
                ?> 
                <div class="margin_top_15"></div>
                <div class="clearfix">
                    <a href="<?php echo site_url() . DATAOWNER_ID; ?>/contact/view/edit/ind" class="large blue button right"><span>Create New Contact</span></a>
                </div>
            <h3 class="index" id="option1_toggle">Looking for an Organisation?</h3>
                <div class="hide_toggle" id="option1">
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
                </div>
            </div>
        </div>
    </div>
</div>













<h1>this is the custom!!! file for the CONTACT page..."</h1>
<p> FRONTEND! this what the view needs:</p>
    <ul>
        this on the left habnd col
    <li>Tab 1: a fieldset shwogin all contact details (esp datepicker, nickname & postcode lookup</li>
    <li>Tab 2: a contact note field note where it appends note the field</li>
    <li>Tab 3: a relatinships table and add new relaitonship button) and contacId = ContactId</li>
    <li>Tab 4: a vehciles table (and add new vehicle button) and contacId = ContactId</li>
    
    on right hand col
    <li>Tab 1: a tabel showing contacactions where type = task, phonecall, and contacId = ContactId</li>
    <li>Tab 2: a table showing contacactions where type = booking and contacId = ContactId</li>
    <li>Tab 3: a table showing communications senbt and contacId = ContactId</li>
    
    
    then, underneath, a drop down menu showing tyopes of emails (opens up a modal window with the emaiul template)
    
    then, underneath, a fieldset showign opt-ins
    
    DO WE NEED A TABLE SHWOING TAGS???
    </ul>
<code>For JQuery, we need a datepicker, a nickname, a drop down county list, default conutry to UK, modalbox,  </code>


    anything else? Check in the trello board<br/><br/><br/>"

    <p>BACKEND: This si the data that we need ot trrieve </p>
    <ul>
        <li>contact record where Id = contactId</li>
        <li>contactaxctions where conatcId = ContactId</li>
        <li>vehicles where conatcId = ContactId</li>
        <li>communications where conatcId = ContactId</li>
        <li>relationships (contactJoin) where conatcId = ContactId</li>
    </ul>
