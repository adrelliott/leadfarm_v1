<div class="row clearfix"> 
    <div class="row">
        <div class="row clearfix"> 
            <div class="widget clearfix tabs">
                <ul>
                    <li><h2><a href="#tab-1">User's Profile</a></h2></li>
                </ul>							
                <div class="widget_inside">
                    <div id="tab-1"><!-- Start of tab 1 -->
                        <?php
                        if ($rID == 'new' OR $correct_password == 1)
                            include('v_user_edit/login_details.php');
                        else
                            include('v_user_edit/password_challenge.php');
                        ?>
                    </div>
                </div>
            </div>                
        </div>
    </div>      
</div>   