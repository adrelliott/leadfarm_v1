

    <div class="row clearfix">
        <div class="widget clearfix">
            <h2>Edit/Create Broadcast Campaign</h2>
            <div class="widget_inside">
                <?php include('name_broadcast.php'); ?>
                <?php if (! element('value', $fields['BroadcastName'], '')) : ?>
                    <div class="clearfix">
                         <input name='submit' type='submit' class='button red right large' value='Save'></input>
                    </div>
                <?php else: ?>
                    <div class="clearfix">
                        <input name='submit' type='submit' class='button red right large' value='Update'></input>
                   </div>
                <?php echo form_close(); ?>
                   <?php include ('write_email.php'); ?>
                    <?php if (element('value', $fields['Subject'], '')) include ('send_email.php'); ?>
                <?php endif; ?>
                
            </div>
        </div>
    </div>
<?php //print_array($_SESSION); ?>
<?php //print_array($this->data); ?>