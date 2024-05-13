<?php 
/* Template Name: Employee Form Template */
get_header(); 


if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['action']) == 'add_employee'){
    $error = '';
    $success = '';
    $username = sanitize_user($_POST['username']);
    $name = $_POST['names'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if( username_exists($username) == null && email_exists($email) == false){
        $users_fields = array(
            'user_login' => $username,
            'first_name' => $name,
            'display_name' => $name,
            'user_email' => $email,
            'user_pass' => $password,
            'role' => 'employees',
            'show_admin_bar_front' => 'false',
        );

        $new_user_id = wp_insert_user($users_fields);
        if($new_user_id){
            $success .= 'Employee added successfully.';
        }
    }else{
        $error .= 'Username or Email already exist.';
        $employee_username = sanitize_user($_POST['username']);
        $employee_fname = $_POST['names'];
        $employee_email = $_POST['email'];
    }
}

if(isset($_POST['action']) == 'edit_employee' && isset($_GET['employee_id'])){
    $error = '';
    $success = '';
    $name = $_POST['names'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $user_id = $_GET['employee_id'];

    if(isset($password) && $password != null){
        if( email_exists($email) == $user_id ){
            $users_fields = array(
                'ID' => $user_id,
                'first_name' => $name,
                'display_name' => $name,
                'user_pass' => $password,
                'role' => 'employees',
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
                    'role' => 'employees',
                    'show_admin_bar_front' => 'false',
                );
                $updateid = wp_update_user($users_fields);
                if ( is_int( $updateid ) ) {
                    $success .= 'Employee updated successfully.';
                }
            }else{
                $error .= 'Email already exist.';
                $employee_fname = $_POST['names'];
                $employee_email = $_POST['email'];
            }
        }

    }else{
        if( email_exists($email) == $user_id ){
            $users_fields = array(
                'ID' => $user_id,
                'first_name' => $name,
                'display_name' => $name,
                'role' => 'employees',
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
                    'role' => 'employees',
                    'show_admin_bar_front' => 'false',
                );
                $updateid = wp_update_user($users_fields);
                if ( is_int( $updateid ) ) {
                    $success .= 'Employee updated successfully.';
                }
            }else{
                $error .= 'Email already exist.';
                $employee_fname = $_POST['names'];
                $employee_email = $_POST['email'];
            }
        }

    }
}

if(isset($_GET['employee_id'])){
    $employee_id = $_GET['employee_id'];
    $employee_info = get_userdata($employee_id);
    $employee_username = $employee_info->user_login;
    $employee_fname = get_user_meta( $employee_id, 'first_name', true );
    $employee_email = $employee_info->user_email;
}


$home_url = home_url();
$user_id = get_current_user_id();
$user_meta = get_userdata($user_id);
$user_roles = $user_meta->roles[0];
?>

<?php
if($user_roles == 'administrator'){
	?>

<!--Wrapper Start-->
<div class="wrapper_main">
    <!-- <div class=""> -->
        <div class="page-wrapper employee-create dashboard-container">
            <div class="page-title d-flex flex-wrap align-items-center justify-content-between">
                <?php if(isset($_GET['employee_id'])){ ?>
                    <h2>Edit Employee</h2>
                <?php }else{ ?>
                    <h2>Employee details</h2>
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
                                    <input class="input-text" type="text" placeholder="Username*" name="username" autocomplete="off" value="<?php echo isset($employee_username) ? $employee_username : ''; ?>" <?php echo isset($_GET['employee_id']) ? 'disabled' : ''; ?>>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-input">
                                    <input class="input-text" type="text" placeholder="Name*" name="names" value="<?php echo isset($employee_fname) ? $employee_fname : ''; ?>">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-input">
                                    <input class="input-text" type="email" placeholder="Email*" name="email"  value="<?php echo isset($employee_email) ? $employee_email : ''; ?>">
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
                                    <?php if(isset($_GET['employee_id'])){ ?>
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
<?php
}else{
	?>
	<script>
		window.location = "<?php echo $home_url; ?>/dashboard/";
	</script>
	<?php
}
?>

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