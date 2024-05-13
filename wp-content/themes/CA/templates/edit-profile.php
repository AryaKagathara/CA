<?php 
/* Template Name: Edit Profile Template */
get_header();
?>

<?php
$home_url = home_url();

if(isset($_POST['action']) == 'edit_employee' && isset($_GET['user_id'])){
    $error = '';
    $success = '';
    $name = $_POST['names'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_id = $_GET['user_id'];

    if(isset($password) && $password != null){
        if( email_exists($email) == $user_id ){
            $users_fields = array(
                'ID' => $user_id,
                'first_name' => $name,
                'display_name' => $name,
                'user_pass' => $password,
                'role' => 'clients',
                'show_admin_bar_front' => 'false',
            );
            $updateid = wp_update_user($users_fields);
            if ( is_int( $updateid ) ) {
                $success .= 'Employee updated successfully.';
            }
        }else{
            if( email_exists($email) == false ){
                $users_fields = array(
                    'ID' => $user_id,
                    'first_name' => $name,
                    'display_name' => $name,
                    'user_email' => $email,
                    'role' => 'clients',
                    'show_admin_bar_front' => 'false',
                );
                $updateid = wp_update_user($users_fields);
                if ( is_int( $updateid ) ) {
                    $success .= 'Employee updated successfully.';
                }
            }else{
                $error .= 'Email already exist.';
                $user_fname = $_POST['names'];
                $user_email = $_POST['email'];
            }
        }

    }else{
        if( email_exists($email) == $user_id ){
            $users_fields = array(
                'ID' => $user_id,
                'first_name' => $name,
                'display_name' => $name,
                'role' => 'clients',
                'show_admin_bar_front' => 'false',
            );
            $updateid = wp_update_user($users_fields);
            if ( is_int( $updateid ) ) {
                $success .= 'Employee updated successfully.';
            }
        }else{
            if( email_exists($email) == false ){
                $users_fields = array(
                    'ID' => $user_id,
                    'first_name' => $name,
                    'display_name' => $name,
                    'user_email' => $email,
                    'role' => 'clients',
                    'show_admin_bar_front' => 'false',
                );
                $updateid = wp_update_user($users_fields);
                if ( is_int( $updateid ) ) {
                    $success .= 'Employee updated successfully.';
                }
            }else{
                $error .= 'Email already exist.';
                $user_fname = $_POST['names'];
                $user_email = $_POST['email'];
            }
        }

    }
}

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
    $user_info = get_userdata($user_id);
    $user_username = $user_info->user_login;
    $user_fname = get_user_meta( $user_id, 'first_name', true );
    $user_email = $user_info->user_email;


	?>

<!--Wrapper Start-->
<div class="wrapper_main">
    <!-- <div class=""> -->
        <div class="page-wrapper employee-create dashboard-container">
            <div class="page-title d-flex flex-wrap align-items-center justify-content-between">
                <?php if(isset($_GET['user_id'])){ ?>
                    <h2>Edit User</h2>
                <?php } ?>
            </div>

            <div class="error-message" style="color: red;"><?php echo isset($error) ? $error : ''; ?></div>
            <div class="success-message" style="color: green;"><?php echo isset($success) ? $success : ''; ?></div>
            <div class="page-block">
                <div class="admin-edit-form">
                    <form method="post" id="employee_add">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="form-input">
                                    <input class="input-text" type="text" placeholder="Username*" name="username" autocomplete="off" value="<?php echo isset($user_username) ? $user_username : ''; ?>" <?php echo isset($_GET['user_id']) ? 'disabled' : ''; ?>>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-input">
                                    <input class="input-text" type="text" placeholder="Name*" name="names" value="<?php echo isset($user_fname) ? $user_fname : ''; ?>">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-input">
                                    <input class="input-text" type="email" placeholder="Email*" name="email"  value="<?php echo isset($user_email) ? $user_email : ''; ?>">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-input input_container">
                                    <input class="input-text" type="password" placeholder="Password*" name="password" autocomplete="off">
                                    <div class="icon show_hide_pwd"></div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-input input_container">
                                    <input class="input-text" type="password" placeholder="Conform password*" name="confirm_password">
                                    <div class="icon show_hide_pwd"></div>
                                    <div class="type_form_message" id="confirm_pass">Passwords do NOT match!</div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-submit">
                                    <?php if(isset($_GET['user_id'])){ ?>
                                        <input type="hidden" name="action" id="action" value="edit_employee" />
                                    <?php }else{ ?>
                                        <input type="hidden" name="action" id="action" value="add_employee" />
                                    <?php } ?>

                                    <!-- <input class="primary_btn" type="submit" value="Submit"> -->
                                    <input type="button" value="Submit" class="primary_btn employee_add_btn">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <!-- </div> -->
</div>
<!--Wrapper End-->

<?php }else{ ?>
    <script>
		window.location = "<?php echo $home_url; ?>/dashboard/";
	</script>
<?php } ?>

<script>
    jQuery(document).ready(function($) {

        jQuery(".input_container .show_hide_pwd").click(function() {
            var paswd= jQuery(this).parent().find('input');
            if(paswd.attr("type")== "password"){
                paswd.attr("type","text");
                jQuery(this).parent().addClass('show_password');
            }
            else{
                paswd.attr("type","password");
                jQuery(this).parent().removeClass('show_password');
            }
        });

        jQuery('.employee_add_btn').click(function(){

            const validateEmail = (email) => {
                return email.match(
                /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
                );
            };
            var action =jQuery('#action').val();
            var username = jQuery('input[name="username"]').val();
            var name = jQuery('input[name="names"]').val();
            var email = jQuery('input[name="email"]').val();
            if(username){ jQuery('input[name="username"]').removeClass('error'); }else{ jQuery('input[name="username"]').addClass('error'); }
            
            if(name){ jQuery('input[name="names"]').removeClass('error'); }else{ jQuery('input[name="names"]').addClass('error'); }

            if(email){ jQuery('input[name="email"]').removeClass('error'); }else{ jQuery('input[name="email"]').addClass('error'); }
            
            if(action == 'edit_employee'){
                var password = jQuery('input[name="password"]').val();
                var confirm_password = jQuery('input[name="confirm_password"]').val();
                if(password){
                    if(confirm_password){ jQuery('input[name="confirm_password"]').removeClass('error'); }else{ jQuery('input[name="confirm_password"]').addClass('error'); }
                    var checks = '';
                    if(password == confirm_password){
                        jQuery('input[name="confirm_password"]').removeClass('error');
                        var checks = '1';
                        //jQuery('#confirm_pass').hide();
                    }else{
                        jQuery('input[name="confirm_password"]').addClass('error');
                        //jQuery('#confirm_pass').show();
                    }
                }

                var valid = '';
                if(validateEmail(email)){
                    jQuery('input[name="email"]').removeClass('error');
                    var valid = 'true';
                }else{
                    jQuery('input[name="email"]').addClass('error');
                }
                if(valid != '' && checks != ''){
                    jQuery("#employee_add").submit();
                }

            }else{
                var password = jQuery('input[name="password"]').val();
                var confirm_password = jQuery('input[name="confirm_password"]').val();
                if(password){ jQuery('input[name="password"]').removeClass('error'); }else{ jQuery('input[name="password"]').addClass('error'); }
        
                if(confirm_password){ jQuery('input[name="confirm_password"]').removeClass('error'); }else{ jQuery('input[name="confirm_password"]').addClass('error'); }

                var checks = '';
                if(password == confirm_password){
                    jQuery('input[name="confirm_password"]').removeClass('error');
                    var checks = '1';
                    //jQuery('#confirm_pass').hide();
                }else{
                    jQuery('input[name="confirm_password"]').addClass('error');
                    //jQuery('#confirm_pass').show();
                }

                if(username == '' && name == '' && email == '' && password == '' && confirm_password == ''){
                    
                }else{
                    var valid = '';
                    if(validateEmail(email)){
                        jQuery('input[name="email"]').removeClass('error');
                        var valid = 'true';
                    }else{
                        jQuery('input[name="email"]').addClass('error');
                    }
                    if(valid != '' && checks != ''){
                        jQuery("#employee_add").submit();
                    }
                }
            }
        });
    });
</script>

<?php
get_footer();