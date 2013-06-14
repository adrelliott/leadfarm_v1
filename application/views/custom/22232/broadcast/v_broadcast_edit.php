<div class="col_8"><!-- Start Column 1-->
    <div class="row clearfix">
        <div class="widget clearfix">
            <h2>Edit/Create Broadcast Campaign</h2>
            <div class="widget_inside">
                <h3 class="index toggle_icon" id="option1_toggle">Step 1: Select recipients...</h3>
                <div class="hide_toggle" id="option1">
                    <?php if (isset($tables['recipients']['table_data'])) include('recipients_table.php');
                        else include('search_form.php'); ?>
                </div>
                <h3 class="index toggle_icon" id="option2_toggle">Step 2: Write Email...</h3>
                <div class="hide_toggle" id="option2">
                    <h3>Campaign Details:</h3>
                    <div class="form">
                        write email
                    </div>
                </div>
                <h3 class="index toggle_icon" id="option3_toggle">Step 3: Send the little monkey...</h3>
                <div class="hide_toggle" id="option3">
                    <h3>Campaign Details:</h3>
                    <div class="form">
                        write email
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Start Column 2-->
<div class="col_3 last">
    <div class="row clearfix">
        <div class="widget clearfix">
            <h2>Help</h2>
            <div class="widget_inside">
                
                instruction go here
            </div>
        </div>       
    </div>
</div>
