<h3 class="index toggle_icon" id="option1_toggle">Step 1: Choose Recipients...</h3>
<?php
    if (isset($tables['recipients']['table_data']))
        include('recipients_table.php');
    else
        include('search_form.php');
    ?>
<div class="clearfix margin_top_15"></div>
<h3 class="index toggle_icon">Step 2 - Write the Email</h3>
<h3 class="index toggle_icon">Step 3 - Send the Email</h3>