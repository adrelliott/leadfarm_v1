<?php 
    //if ($this->data['message']) {echo '<span class="notification information">'
    //    . $this->data['message'] . '</span>';} 
?>
<style>
    .leadBox {
        text-align: center;
    }
</style>
<div class="row clearfix">
    <div class="col_3">
        <div class="widget clearfix">
            <h2>Contacts</h2>
            <div class="widget_inside">
                <?php foreach($tables['leads_by_type']['Contact'] as $k => $array) { echo '<p class="button leadBox"><a href="' . site_url(DATAOWNER_ID . '/lead/view/edit/' . $array['Id'] . '/' . $array['ContactID']) . '" class="iframe">' . $array['FirstName'] . ' ' . $array['LastName'] . '</a></p>';} ?>
            </div>
        </div>
    </div>
    <div class="col_3">
        <div class="widget clearfix">
            <h2>Leads</h2>
            <div class="widget_inside">
                 <?php foreach($tables['leads_by_type']['Lead'] as $k => $array) { echo '<p class="button leadBox"><a href="' . site_url(DATAOWNER_ID . '/lead/view/edit/' . $array['Id'] . '/' . $array['ContactID']) . '" class="iframe">' . $array['FirstName'] . ' ' . $array['LastName'] . '</a></p>';} ?>
            </div>
        </div>
    </div>
    <div class="col_3">
        <div class="widget clearfix">
            <h2>Suspects</h2>
            <div class="widget_inside">
                 <?php foreach($tables['leads_by_type']['Suspect'] as $k => $array) { echo '<p class="button leadBox"><a href="' . site_url(DATAOWNER_ID . '/lead/view/edit/' . $array['Id'] . '/' . $array['ContactID']) . '" class="iframe">' . $array['FirstName'] . ' ' . $array['LastName'] . '</a></p>';} ?>
            </div>
        </div>
    </div>
    <div class="col_3 last">
        <div class="widget clearfix">
            <h2>Prospects</h2>
            <div class="widget_inside">
                 <?php foreach($tables['leads_by_type']['Prospect'] as $k => $array) { echo '<p class="button leadBox"><a href="' . site_url(DATAOWNER_ID . '/lead/view/edit/' . $array['Id'] . '/' . $array['ContactID']) . '" class="iframe">' . $array['FirstName'] . ' ' . $array['LastName'] . '</a></p>';} ?>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Active Leads</h2>
            <div class="widget_inside">   
                 <?php 
                    $this->table->set_template_custom(array ('anchor_uri' => 'lead/view/edit', 'ContactId_name' => 'ContactID', 'anchor_attr' => 'class="iframe"'));    
                    $this->table->set_heading_custom($tables['leads']['table_headers']);
                    echo $this->table->generate_custom($tables['leads']['table_data']); 
                ?>
            </div>
        </div>
    </div>
</div>