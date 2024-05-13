<?php 
/* Template Name: Client Edit Template */
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

$clientid = $_GET['clientid'];
$user_info = get_userdata($clientid);
$user_data = get_user_meta($clientid);
$postid = $user_data['post_id'][0];

$client_username = $user_info->display_name;
$client_email = $user_info->user_email;
$client_name = $user_data['first_name'][0];

$client_type = get_field('client_type',$postid);
$company_type = get_field('company_type',$postid);
$phone_number = get_field('phone_number',$postid);
$resident_status = get_field('resident_status',$postid);
$category_type = get_field('category_type',$postid);
$date_of_birth = get_field('date_of_birth',$postid);
$personal_details = get_field('personal_details',$postid);
$authorize_persons = get_field('authorize_persons',$postid);
$status = get_field('client_status',$postid);

?>

<?php
if(isset($_POST['names'])){
    require_once( ABSPATH . 'wp-admin/includes/file.php' );
	require_once(ABSPATH . "wp-admin" . '/includes/image.php');

	$userids = $_POST['userids'];
	$postids = $_POST['postids'];
    $name = $_POST['names'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone_number'];

    $type_form = $_POST['type_form'];
    $company_type = $_POST['company_type'];
    $resident_type = $_POST['resident_type'];
    $category_type = $_POST['category_type'];
    $client_list = $_POST['client_list'];
    $date_of_birth = $_POST['date_of_birth'];
    if($user_roles == 'administrator'){
        $status_update = $_POST['status_type'];
        update_post_meta( $postids, 'client_status', $status_update );
    }

    $personal_details = $_POST['group-a'];
    $authorize_person = $_POST['group-b'];
    $detail_file = $_FILES;
   
    $user_data = get_user_by( 'id',$userids);
    $user_email = $user_data->user_email;
    if($user_email != $email){
        $email_exists_or_not = email_exists($email);
        if (email_exists($email) == false) {
            wp_update_user( $userids, 'user_email', $name);
        }else{
            ?>
            <div class="type_form_message" id="email_confirm">Email Address Does Not Exists!</div>
            <?php
        }
    }

    wp_update_user( $userids, 'first_name', $name);

    update_post_meta( $postids, 'client_type', $type_form );
    if($type_form != 'individual'){
        update_post_meta( $postids, 'company_type', $company_type );
    }
    update_post_meta( $postids, 'phone_number', $phone_number );
    update_post_meta( $postids, 'resident_status', $resident_type );
    update_post_meta( $postids, 'category_type', $category_type );
    update_post_meta( $postids, 'date_of_birth', $date_of_birth );


    $x = 0;
    $prpersons = array();
    foreach($personal_details as $single_personal){
        $detail_name = $single_personal['pr_detail_name'];
        $detail_text = $single_personal['pr_details'];
        $file_urls = $single_personal['file_urls'];
        $f_name = $detail_file['group-a']['name'][$x]['pr_file'];

        if($f_name){
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
        }else{
            $attach_id = attachment_url_to_postid($file_urls);
        }

        $field_key = "personal_details";
        if($detail_name != '' OR $detail_text != '' OR $attach_id != ''){
            $prpersons[] =  
                array(
                'pr_detail_name' => $detail_name,
                'pr_detail_text' => $detail_text,
                'pr_detail_file' => $attach_id
                );
            
        }
        $x++;
    }
    update_field( $field_key, $prpersons, $postids );


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
    update_field( $field_key_new, $authperson, $postids );

    ?>
    <script>window.location = "<?php echo $home_url; ?>/client-list/?success=true";</script>
     <?php
    
}
?>
<div class="wrapper_main">
    <div class="dash_wrap dashboard-container">
        <div class="dash_wrap_inner client-edit">
            <form method="post" enctype="multipart/form-data" id="client_edit">
				<input type="hidden" name="userids" value="<?php echo $clientid; ?>">
				<input type="hidden" name="postids" value="<?php echo $postid; ?>">
                <div class="part_form">
                    <div class="dash_wrap_filter form_row">
                        <div class="dash_filter form_col_1-3">
                            <div class="radio_grp_wrap">
                                <div class="radio_grp">
                                    <div class="radio_list">
                                        <input type="radio" value="individual" name="type_form" id="individual_form" <?php if($client_type == 'individual'){ echo 'checked'; } ?>>
                                        <label for="individual_form">Individual</label>
                                    </div>
                                    <div class="radio_list">
                                        <input type="radio" value="company" name="type_form" id="company_form" <?php if($client_type == 'company'){ echo 'checked'; } ?>>
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
                                    <option value="partnership-1" <?php if($company_type == 'partnership-1'){ echo ' selected="selected"'; } ?>>Artificial Juridical Person</option>
                                    <option value="partnership-2" <?php if($company_type == 'partnership-2'){ echo ' selected="selected"'; } ?>>Association of Persons (AOP)</option>
                                    <option value="partnership-3" <?php if($company_type == 'partnership-3'){ echo ' selected="selected"'; } ?>>Association of Persons (Trust)</option>
                                    <option value="partnership-4" <?php if($company_type == 'partnership-4'){ echo ' selected="selected"'; } ?>>Body of Individuals (BOI)</option>
                                    <option value="partnership-5" <?php if($company_type == 'partnership-5'){ echo ' selected="selected"'; } ?>>Company Other Tan Domestic Company</option>
                                    <option value="partnership-6" <?php if($company_type == 'partnership-6'){ echo ' selected="selected"'; } ?>>Co-Operative Society</option>
                                    <option value="partnership-7" <?php if($company_type == 'partnership-7'){ echo ' selected="selected"'; } ?>>Government</option>
                                    <option value="partnership-8" <?php if($company_type == 'partnership-8'){ echo ' selected="selected"'; } ?>>Hindu Undivided Family (HUF)</option>
                                    <option value="partnership-9" <?php if($company_type == 'partnership-9'){ echo ' selected="selected"'; } ?>>Local Authority</option>
                                    <option value="partnership-10" <?php if($company_type == 'partnership-10'){ echo ' selected="selected"'; } ?>>Partnership Firm</option>
                                    <option value="partnership-11" <?php if($company_type == 'partnership-11'){ echo ' selected="selected"'; } ?>>Private Limited</option>
                                    <option value="partnership-12" <?php if($company_type == 'partnership-12'){ echo ' selected="selected"'; } ?>>Public Limited</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="dash_wrap_filter form_row">
                        <div class="dash_filter form_col_1-3">
                            <div class="resident_dropdown">
                                <select name="resident_type" id="resident_type">
                                    <option disabled selected value>Resident Status</option>
                                    <option value="resident1" <?php if($resident_status == 'resident1'){ echo ' selected="selected"'; } ?>>Non Resident</option>
                                    <option value="resident2" <?php if($resident_status == 'resident2'){ echo ' selected="selected"'; } ?>>Resident</option>
                                    <option value="resident3" <?php if($resident_status == 'resident3'){ echo ' selected="selected"'; } ?>>Resident But Not odinarily Residents</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="part_form">
                    <h3>Clients details</h3>
                    <div class="form_row">
                        <div class="form_col_1-3">
                            <div class="input_container">
                                <input type="text" name="names" class="input_field" placeholder="Name*" value="<?php echo $client_name; ?>">
                            </div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="input_container">
                                <input type="email" name="email" class="input_field" placeholder="Email*" value="<?php echo $client_email; ?>">
                            </div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="input_container">
                                <input type="number" name="phone_number" class="input_field" placeholder="Phone Numbers*" value="<?php echo $phone_number; ?>">
                            </div>
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
                                        <option value="<?php echo $value->term_id; ?>" <?php if($category_type == $value->term_id){ echo ' selected="selected"'; } ?>><?php echo $value->name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="input_container">
                                <input type="date" name="date_of_birth" class="input_field" placeholder="DOB/DOI" value="<?php echo $date_of_birth; ?>">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="part_form repeater">
                    <h3>Personal details</h3>
                    <div data-repeater-list="group-a">
					<?php
					foreach($personal_details as $single_prdetail){
						$prdetail_name = $single_prdetail['pr_detail_name'];
						$prdetail_text = $single_prdetail['pr_detail_text']; 
						$prdetail_file = $single_prdetail['pr_detail_file'];
						?>
                        <div data-repeater-item>
                            <div class="form_row">
                                <div class="form_col_1-3">
                                    <div class="input_container">
                                        <input type="text" name="pr_detail_name" class="input_field" placeholder="Field name" value="<?php echo $prdetail_name; ?>">
                                    </div>
                                </div>
                                <div class="form_col_1-3">
                                    <div class="input_container">
                                        <input type="text" name="pr_details" class="input_field" placeholder="Details" value="<?php echo $prdetail_text; ?>">
                                    </div>
                                </div>
                                <input type="hidden" name="file_urls" value="<?php echo $prdetail_file; ?>">
                                <div class="form_col_1-3">
                                    <div class="input_container">
                                        <input type="file" name="pr_file" value="<?php echo $prdetail_file; ?>">
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
						<?php
					}
					?>
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
					<?php
					foreach($authorize_persons as $single_person){
						$person_name = $single_person['auth_name'];
						$person_email = $single_person['auth_email'];
						$person_phone = $single_person['auth_phone'];
						?>
                        <div data-repeater-item>
                            <div class="form_row">
                                <div class="form_col_1-3">
                                    <div class="input_container">
                                        <input type="text" name="auth_name" class="input_field" placeholder="Name" value="<?php echo $person_name; ?>">
                                    </div>
                                </div>
                                <div class="form_col_1-3">
                                    <div class="input_container">
                                        <input type="email" name="auth_email" class="input_field" placeholder="Email" value="<?php echo $person_email; ?>">
                                    </div>
                                </div>
                                <div class="form_col_1-3">
                                    <div class="input_container">
                                        <input type="number" name="auth_phone" class="input_field" placeholder="Phone Numbers" value="<?php echo $person_phone; ?>">
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
						<?php
					}
					?>
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
                <?php
                if($user_roles == 'administrator'){
                    ?>
                    <div class="part_form repeater">
                        <h3>Status</h3>
                        <div class="dash_wrap_filter form_row">
                            <div class="dash_filter form_col_1-3">
                                <div class="resident_dropdown">
                                    <select name="status_type" id="resident_type">
                                        <option value="active" <?php if($status == 'active'){ echo ' selected="selected"'; } ?>>Active</option>
                                        <option value="in-active" <?php if($status == 'in-active'){ echo ' selected="selected"'; } ?>>In-active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <div class="type_form_message" id="email_confirm">Email Address Does Not Exists!</div>
                <div class="form_submit">
                    <!-- <input type="submit" value="Submit" name="submitclient" class="primary_btn final_submit" style="display:none;">  -->
                    <input type="button" value="Submit" class="primary_btn client_edit_btn">
                </div>
            </form>
        </div>
    </div>
</div>

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
