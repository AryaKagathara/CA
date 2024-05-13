<?php 
/* Template Name: Client Form Template */
get_header(); 
$fileData = get_attached_file(1059);
$user_id = get_current_user_id();
$user_meta = get_userdata($user_id);
$user_roles = $user_meta->roles[0];
$home_url = home_url();

if($user_id){
    if($user_roles == 'administrator'){

    }else{
        ?>
        <script>
		window.location = "<?php echo $home_url; ?>";
	    </script>
        <?php
    }
}else{
    ?>
    <script>
		window.location = "<?php echo $home_url; ?>";
	</script>
    <?php
}
?>
<?php
if(isset($_POST['username'])){
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');

    $username = $_POST['username'];
    $name = $_POST['names'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];

    $type_form = $_POST['type_form'];
    $company_type = $_POST['company_type'];
    $resident_type = $_POST['resident_type'];
    $category_type = $_POST['category_type'];
    $date_of_birth = $_POST['date_of_birth'];

    $personal_details = $_POST['group-a'];
    $authorize_person = $_POST['group-b'];
    $detail_file = $_FILES;
    $email_exists_or_not = email_exists($email);
    if (username_exists($username) == null && email_exists($email) == false) {
        $users_fields = [
            'user_login' => $username,
            'first_name' => $name,
            'user_email' => $email,
            'user_pass' => $password,
            'username' => $username,
            'role' => 'clients',
            'show_admin_bar_front' => 'false',
        ];

        $my_post = array(
            'post_title' => $name,
            'post_content' => '',
            'post_status' => 'publish',
            'post_type' => 'client-detail',
        );

        $new_user_id = wp_insert_user($users_fields);
        $post_idr = wp_insert_post($my_post);

        update_post_meta( $post_idr, 'user_id', $new_user_id );
        update_user_meta($new_user_id, 'post_id', $post_idr);

        update_post_meta( $post_idr, 'client_type', $type_form );
        if($type_form != 'individual'){
            update_post_meta( $post_idr, 'company_type', $company_type );
        }
        update_post_meta( $post_idr, 'phone_number', $phone_number );
        update_post_meta( $post_idr, 'resident_status', $resident_type );
        update_post_meta( $post_idr, 'category_type', $category_type );

        update_post_meta( $post_idr, 'date_of_birth', $date_of_birth );
        update_post_meta( $post_idr, 'client_status', 'active');

        $x = 0;
        $prpersons = array();
        foreach($personal_details as $single_personal){
            $detail_name = $single_personal['pr_detail_name'];
            $detail_text = $single_personal['pr_details'];

            $file = array(
                'name' => $detail_file['group-a']['name'][$x]['pr_file'],
                'type' => $detail_file['group-a']['type'][$x]['pr_file'],
                'tmp_name' => $detail_file['group-a']['tmp_name'][$x]['pr_file'],
                'error' => $detail_file['group-a']['error'][$x]['pr_file'],
                'size' => $detail_file['group-a']['size'][$x]['pr_file']
            );

            $_FILES = array("upload_file" => $file);
            $upload_overrides = array( 'test_form' => false );
            $movefile = wp_handle_upload($_FILES['upload_file'], $upload_overrides);
            
            $arr_file_type = wp_check_filetype(basename($_FILES['upload_file']['name']));
            $uploaded_file_type = $arr_file_type['type'];

            
            if(isset($movefile['file'])) {
                $file_name_and_location = $movefile['file'];
        
                $file_title_for_media_library = 'your title here';
        
                $attachment = array(
                    'post_mime_type' => $uploaded_file_type,
                    'post_title' => 'Uploaded image ' . addslashes($file_title_for_media_library),
                    'post_content' => '',
                    'post_status' => 'inherit'
                );
        
                $attach_id = wp_insert_attachment($attachment,$file_name_and_location);
                
                $attach_data = wp_generate_attachment_metadata( $attach_id, $file_name_and_location );
                wp_update_attachment_metadata($attach_id,  $attach_data);
                
                $imageUrl = wp_get_attachment_url($attach_id);
            }

            $field_key = "personal_details";
            if($detail_name != '' OR $detail_text != '' OR $attach_id != ''){
                $prpersons[] =  array(
                    'pr_detail_name' => $detail_name,
                    'pr_detail_text' => $detail_text,
                    'pr_detail_file' => $attach_id
                );
            }
            $x++;
        }

        update_field( $field_key, $prpersons, $post_idr );

        $field_key_new = "authorize_persons";
        $authperson = array();
        foreach($authorize_person as $single_person){
            $person_name = $single_person['auth_name'];
            $person_email = $single_person['auth_email'];
            $person_phone = $single_person['auth_phone'];
            if($person_name != '' OR $person_email != '' OR $person_phone != ''){
                $authperson[] =  
                    array(
                        'auth_name' => $person_name,
                        'auth_email' => $person_email,
                        'auth_phone' => $person_phone
                    );
            }
        }
        update_field( $field_key_new, $authperson, $post_idr );
        ?>
        <script>window.location = "<?php echo $home_url; ?>/client-list/?success=ntrue";</script>
        <?php
    }else{
        ?>
        <div class="type_form_message" id="email_confirm" style="display:block;">Username AND Email Address Does Not Exists!</div>
        <?php
    }
    ?>
    <?php
    
}

$user_meta = get_userdata($user_id);
$user_roles = $user_meta->roles[0];
?>
<?php
if($user_roles == 'administrator'){
	?>
<div class="wrapper_main">
    <div class="dash_wrap dashboard-container">
        <div class="dash_wrap_inner client-edit">
            <div class="form_confirm_message">New Client add Successfully.</div>
            <div class="type_form_message" id="email_confirm">Username AND Email Address Does Not Exists!</div>
            <form method="post" enctype="multipart/form-data" id="client_add">
                <div class="part_form">
                    <div class="dash_wrap_filter form_row">
                        <div class="dash_filter form_col_1-3">
                            <div class="radio_grp_wrap">
                                <div class="radio_grp">
                                    <div class="radio_list">
                                        <input type="radio" value="individual" name="type_form" id="individual_form">
                                        <label for="individual_form">Individual</label>
                                    </div>
                                    <div class="radio_list">
                                        <input type="radio" value="company" name="type_form" id="company_form">
                                        <label for="company_form">Company</label>
                                    </div>
                                </div>
                                <div class="type_form_message" id="types_form">Please Select Field</div>
                            </div>
                        </div>
                        <div class="dash_filter form_col_1-3">
                            <div class="company_dropdown">
                                <select name="company_type" id="company_type">
                                    <option disabled selected value>Type</option>
                                    <option value="partnership-1">Artificial Juridical Person</option>
                                    <option value="partnership-2">Association of Persons (AOP)</option>
                                    <option value="partnership-3">Association of Persons (Trust)</option>
                                    <option value="partnership-4">Body of Individuals (BOI)</option>
                                    <option value="partnership-5">Company Other Tan Domestic Company</option>
                                    <option value="partnership-6">Co-Operative Society</option>
                                    <option value="partnership-7">Government</option>
                                    <option value="partnership-8">Hindu Undivided Family (HUF)</option>
                                    <option value="partnership-9">Local Authority</option>
                                    <option value="partnership-10">Partnership Firm</option>
                                    <option value="partnership-11">Private Limited</option>
                                    <option value="partnership-12">Public Limited</option>
                                </select>
                            </div>
                            <div class="type_form_message" id="company_typer">Please Select Field</div>
                        </div>
                    </div>
                    <div class="dash_wrap_filter form_row">
                        <div class="dash_filter form_col_1-3">
                            <div class="resident_dropdown">
                                <select name="resident_type" id="resident_type">
                                    <option disabled selected value>Resident Status</option>
                                    <option value="resident1">Non Resident</option>
                                    <option value="resident2">Resident</option>
                                    <option value="resident3">Resident But Not odinarily Residents</option>
                                </select>
                            </div>
                            <div class="type_form_message" id="resident_typer">Please Select Field</div>
                        </div>
                    </div>
                </div>
                <div class="part_form">
                    <h3>Clients details</h3>
                    <div class="form_row">
                        <div class="form_col_1-3">
                            <div class="input_container">
                                <input type="text" name="username" class="input_field" placeholder="Username*">
                            </div>
                            <div class="type_form_message" id="username_typer">Please enter your Username.</div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="input_container">
                                <input type="text" name="names" class="input_field" placeholder="Name*">
                            </div>
                            <div class="type_form_message" id="names_typer">Please enter your Name.</div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="input_container">
                                <input type="email" name="email" class="input_field" placeholder="Email*">
                            </div>
                            <div class="type_form_message" id="email_typer">Please enter your Email.</div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="input_container">
                                <input type="number" name="phone_number" class="input_field" placeholder="Phone Numbers*">
                            </div>
                            <div class="type_form_message" id="phone_typer">Please enter your Phone Number.</div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="input_container">
                                <input type="password" name="password" class="input_field" placeholder="Password*">
                                <span class="show_hide_pwd"></span>
                            </div>
                            <div class="type_form_message" id="password_typer">Please enter your Password.</div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="input_container">
                                <input type="password" name="confirm_password" class="input_field" placeholder="Conform password*">
                                <span class="show_hide_pwd"></span>
                                <div class="type_form_message" id="confirm_pass">Passwords do NOT match!</div>
                            </div>
                            <div class="type_form_message" id="confirmpass_typer">Please enter your Conform password.</div>
                        </div>
                        <?php
                        $Category = get_terms('client-category', array(
							'hide_empty' => false,
						));
                        ?>
                        <div class="form_col_1-3">
                            <div class="input_container">
                                <select name="category_type" id="category_type">
                                    <option disabled selected value>Category type</option>
                                    <?php
                                    foreach ($Category as $value) {
                                        ?>
                                        <option value="<?php echo $value->term_id; ?>"><?php echo $value->name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="input_container">
                                <input type="date" name="date_of_birth" class="input_field" placeholder="DOB/DOI">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="part_form repeater">
                    <h3>Personal details</h3>
                    <div data-repeater-list="group-a">
                        <div data-repeater-item>
                            <div class="form_row">
                                <div class="form_col_1-3">
                                    <div class="input_container">
                                        <input type="text" name="pr_detail_name" class="input_field" placeholder="Field name">
                                    </div>
                                </div>
                                <div class="form_col_1-3">
                                    <div class="input_container">
                                        <input type="text" name="pr_details" class="input_field" placeholder="Details">
                                    </div>
                                </div>
                                <div class="form_col_1-3">
                                    <div class="input_container">
                                        <input type="file" name="pr_file">
                                        <label for="file_upload">Browse file</label>
                                    </div>
                                </div>
                                <div class="remove_btn">
                                    <a data-repeater-delete type="button" value="Delete" class="remove_field">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 5L5 15" stroke="#00003E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5 5L15 15" stroke="#00003E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="more_add">
                        <a data-repeater-create type="button" value="Add">
                            <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.00464 10V7.5C5.00464 6.83696 5.26827 6.20107 5.73755 5.73223C6.20682 5.26339 6.8433 5 7.50695 5H10.0093" stroke="#2C3E50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M5.00464 20V22.5C5.00464 23.163 5.26827 23.7989 5.73755 24.2678C6.20682 24.7366 6.8433 25 7.50695 25H10.0093" stroke="#2C3E50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20.0186 5H22.5209C23.1845 5 23.821 5.26339 24.2903 5.73223C24.7595 6.20107 25.0232 6.83696 25.0232 7.5V10" stroke="#2C3E50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M20.0186 25H22.5209C23.1845 25 23.821 24.7366 24.2903 24.2678C24.7595 23.7989 25.0232 23.163 25.0232 22.5V20" stroke="#2C3E50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.2604 15H18.7673" stroke="#2C3E50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M15.0139 11.25V18.75" stroke="#2C3E50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="part_form repeater">
                    <h3>Authorize persons</h3>
                    <div data-repeater-list="group-b">
                        <div data-repeater-item>
                            <div class="form_row">
                                <div class="form_col_1-3">
                                    <div class="input_container">
                                        <input type="text" name="auth_name" class="input_field" placeholder="Name">
                                    </div>
                                </div>
                                <div class="form_col_1-3">
                                    <div class="input_container">
                                        <input type="email" name="auth_email" class="input_field" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form_col_1-3">
                                    <div class="input_container">
                                        <input type="number" name="auth_phone" class="input_field" placeholder="Phone Numbers">
                                    </div>
                                </div>
                                <div class="remove_btn">
                                    <a data-repeater-delete type="button" value="Delete" class="remove_field">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M15 5L5 15" stroke="#00003E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M5 5L15 15" stroke="#00003E" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="more_add">
                        <a data-repeater-create type="button" value="Add">
                            <svg width="31" height="30" viewBox="0 0 31 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.00464 10V7.5C5.00464 6.83696 5.26827 6.20107 5.73755 5.73223C6.20682 5.26339 6.8433 5 7.50695 5H10.0093" stroke="#2C3E50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M5.00464 20V22.5C5.00464 23.163 5.26827 23.7989 5.73755 24.2678C6.20682 24.7366 6.8433 25 7.50695 25H10.0093" stroke="#2C3E50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M20.0186 5H22.5209C23.1845 5 23.821 5.26339 24.2903 5.73223C24.7595 6.20107 25.0232 6.83696 25.0232 7.5V10" stroke="#2C3E50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M20.0186 25H22.5209C23.1845 25 23.821 24.7366 24.2903 24.2678C24.7595 23.7989 25.0232 23.163 25.0232 22.5V20" stroke="#2C3E50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M11.2604 15H18.7673" stroke="#2C3E50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                <path d="M15.0139 11.25V18.75" stroke="#2C3E50" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            </svg>
                        </a>
                    </div>
                </div>
                <div class="type_form_message" id="email_confirm">Email Address Does Not Exists!</div>
                <div class="form_submit">
                    <!-- <input type="submit" value="Submit" name="submitclient" class="primary_btn final_submit" style="display:none;"> -->
                    <input type="button" value="Submit" class="primary_btn client_add_btn">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
}else{
	?>
	<script>
		window.location = "<?php echo $home_url; ?>/dashboard/";
	</script>
	<?php
}
?>

<?php get_footer(); ?>
<script>
	jQuery(document).ready(function() {
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

        jQuery('input[type="file"]').each(function() {
            jQuery(this).change(function(e){
                var val =jQuery(this).val();
                var filename = val.replace(/^.*[\\\/]/, '');

                if( filename != '' ){
                    jQuery(this).parent().find('label').html(filename);
                }else {
                    jQuery(this).parent().find('label').html('Browse file');
                }
                // setTimeout(function(){
                    // jQuery(this).parent().find('label').html(filename);
                    // alert(filename);
                //},1000)
            });
        });

        jQuery('.dash_filter .radio_list input[type="radio"]').each(function() {
            jQuery(this).change(function(e){
                 if(jQuery('input[id="company_form"]').is(":checked")){
                     jQuery('.dash_filter .company_dropdown').addClass('show_dropdown');
                } else{
                    jQuery('.dash_filter .company_dropdown').removeClass('show_dropdown');
                }
            });
        });
    });

    jQuery(document).ready(function () {
        "use strict";
        window.id = 0;
        function reindexCount(){
            jQuery('.client_list_count').each(function(index , data){
                jQuery(this).find('span').text(++index)
            })
        }  
        jQuery(".repeater").repeater({
            show: function () {
            jQuery(this).slideDown();
            reindexCount()
            },
            hide: function (deleteElement) {
                window.id--;
                
                jQuery("#cat-id").val(window.id);
                jQuery(this).slideUp(deleteElement);
                setTimeout(() => {
                    reindexCount()     
                }, 750);
            },
            isFirstItemUndeletable: true,
            ready: function (setIndexes) {
                reindexCount()
            }
        });

        jQuery(".repeater_end").repeater({
            show: function () {
            jQuery(this).slideDown();
            reindexCount()
            },
            hide: function (deleteElement) {
                window.id--;
                
                jQuery("#cat-id").val(window.id);
                jQuery(this).slideUp(deleteElement);
                setTimeout(() => {
                    reindexCount()     
                }, 750);
            },
            isFirstItemUndeletable: true,
            ready: function (setIndexes) {
                reindexCount()
            }
        });

    });

        
</script>
