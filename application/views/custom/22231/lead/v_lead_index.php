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
    <div class="col_4">
        <div class="widget clearfix">
            <h2>Prospect</h2>
            <div class="widget_inside">
                <?php if ( ! empty ( $tables['leads_by_type']['Prospect'] )) : ?>
                <?php foreach($tables['leads_by_type']['Prospect'] as $k => $array) { echo '<p class="button leadBox"><a href="' . site_url( '/lead/view/edit/' . $array['Id'] . '/' . $array['ContactID'] ) . '" class="iframe">' . $array['FirstName'] . ' ' . $array['LastName'] . '</a> (' . $array['OpportunityTitle'] . ')</p>'; } ?>
                <?php else: ?>
                <p>No records found...</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col_4">
        <div class="widget clearfix">
            <h2>Lead</h2>
            <div class="widget_inside">
                <?php if ( ! empty ( $tables['leads_by_type']['Lead'] )) : ?>
                <?php foreach($tables['leads_by_type']['Lead'] as $k => $array) { echo '<p class="button leadBox"><a href="' . site_url( '/lead/view/edit/' . $array['Id'] . '/' . $array['ContactID'] ) . '" class="iframe">' . $array['FirstName'] . ' ' . $array['LastName'] . '</a> (' . $array['OpportunityTitle'] . ')</p>'; } ?>
                <?php else: ?>
                <p>No records found...</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="col_4 last">
        <div class="widget clearfix">
            <h2>Potential</h2>
            <div class="widget_inside">
                <?php if ( ! empty ( $tables['leads_by_type']['Potential'] )) : ?>
                <?php foreach($tables['leads_by_type']['Potential'] as $k => $array) { echo '<p class="button leadBox"><a href="' . site_url( '/lead/view/edit/' . $array['Id'] . '/' . $array['ContactID'] ) . '" class="iframe">' . $array['FirstName'] . ' ' . $array['LastName'] . '</a> (' . $array['OpportunityTitle'] . ')</p>'; } ?>
                <?php else: ?>
                <p>No records found...</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<div class="row clearfix">
    <div class="row">
        <div class="widget clearfix tabs">
            <ul>
                <li><h2><a href='#tab-1'>All Active Opportunities</a></h2></li>
            </ul>
            <div class="widget_inside">
                <div id="tab-1">
                    <div class="dataTable-container" data-table-source="<?php echo html_escape (base_url () . $this->uri->uri_string () . '/index/edit/leads') ?>">
                        <?php include ('v_lead_edit/leads.php') ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //print_array($this->data); ?>