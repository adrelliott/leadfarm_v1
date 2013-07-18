
<div class="col_8"><!-- Start Column 1-->
    <div class="row clearfix">
        <div class="widget clearfix">
            <h2>Edit/Create Broadcast Campaign</h2>
            <div class="widget_inside">
                <?php include('step' . $_SESSION['step']['current'] . '.php'); ?>
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
<div class="clearfix"></div>

<?php print_array($_SESSION); ?>
<?php print_array($this->data); ?>