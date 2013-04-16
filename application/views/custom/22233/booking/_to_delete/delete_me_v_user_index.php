<?php 
    //if ($this->data['message']) {echo '<span class="notification information">'
    //    . $this->data['message'] . '</span>';} 
?>
<div class="row clearfix">
    <div class="col_12">
        <div class="widget clearfix">
            <h2>Users</h2>
            <div class="widget_inside">                
               <?php echo form_open( '/user/add/edit/' . $rID ); ?>
                    <?php display_field($fields['Title']); ?>
                    <?php display_field($fields['FirstName']); ?>
                    <?php display_field($fields['LastName']); ?>
                    <?php display_field($fields['Nickname']); ?>
                    <?php display_field($fields['Username']); ?>
                    <?php display_field($fields['Password'], array('type' => 'password')); ?>
                    <?php display_field($fields['Email']); ?>
                    <?php display_field($fields['Phone1']); ?>
                    <?php //display_field($fields['_Signature']); ?>
                     <div class="clearfix">
                        <input name='submit' type='submit' class='button blue right large' style='float:right' value='Save'></input>
                    </div>
                    <?php if($var) include('file'); ?>
                </div>
            </div>
        </div>
    </div>
</div>