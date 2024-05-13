<?php 
/* Template Name: Client Profile Template */
get_header();
require_once( ABSPATH . 'wp-admin/includes/file.php' );
require_once(ABSPATH . "wp-admin" . '/includes/image.php');

$cr_urls =  $_SERVER['REQUEST_URI'];
//echo $cr_urls;
$current_user_id = get_current_user_id();
$cr_user_meta = get_userdata($current_user_id);
$cr_user_roles = $cr_user_meta->roles[0];

if($current_user_id){

}else{
    ?>
    <script>
		window.location = "<?php echo $home_url; ?>";
	</script>
    <?php
}

$page_crt_url = "http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];

if(isset($_GET['client_id'])){
    $client_id = $_GET['client_id'];

    $client_info = get_userdata($client_id);
    $client_name = get_user_meta( $client_id, 'first_name', true );
    $client_username = $client_info->user_login;
    $client_email = $client_info->user_email;
    $posts_data = get_user_meta( $client_id, 'post_id', true);
    //echo $posts_data;
    $args = array('p' => $posts_data, 'post_type' => 'client-detail');
    $personal_file_list = get_field('file_details',$posts_data);
    $general_file_list = get_field('general_files',$posts_data);
    $loop = new WP_Query($args);
}

?>
<?php if(isset($_GET['client_id'])): ?>
<!--Wrapper Start-->
<!-- <div class="wrapper_main"> -->
    <div class="dash_wrap dashboard-container">
        <div class="dash_wrap_inner client-detai ">
            <?php 
            if ( $loop->have_posts() ) :
                while ( $loop->have_posts() ) : $loop->the_post();
                $p_id = get_the_ID();
                $client_type = get_field('client_type');
                $company_type = get_field('company_type');
                $category_type = get_field('category_type');
                $category_name = get_term( $category_type )->name;
            ?>
        
            <div class="page-title d-flex flex-wrap align-items-center justify-content-between">
                <h1><?php echo $client_name; ?></h1>
            </div>
            <div class="client_dtl_wrap">
                <div class="client_dtl_lista">
                    <h3>Clients details</h3>
                    <div class="client_dtl_row form_row">
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">Client type</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php if($client_type){ echo $client_type; }else{ echo 'N/A'; }?></span>
                                </div>
                            </div>
                        </div>
                        <?php if($client_type != 'individual'): ?>
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">Company type</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php if($company_type){ echo $company_type; }else{ echo 'N/A'; }?></span>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">Resident Status</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php echo get_field('resident_status'); ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="client_dtl_row form_row">
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">Username</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php if($client_username){ echo $client_username; }else{ echo 'N/A'; } ?></span> 
                                    <div class="copy_tag_box">
                                        <a href="javascript:void(0)" class="copy_tag">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.8333 2.5H7.49998C6.57951 2.5 5.83331 3.24619 5.83331 4.16667V12.5C5.83331 13.4205 6.57951 14.1667 7.49998 14.1667H15.8333C16.7538 14.1667 17.5 13.4205 17.5 12.5V4.16667C17.5 3.24619 16.7538 2.5 15.8333 2.5Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14.1667 14.1663V15.833C14.1667 16.275 13.9911 16.699 13.6785 17.0115C13.366 17.3241 12.942 17.4997 12.5 17.4997H4.16667C3.72464 17.4997 3.30072 17.3241 2.98816 17.0115C2.67559 16.699 2.5 16.275 2.5 15.833V7.49967C2.5 7.05765 2.67559 6.63372 2.98816 6.32116C3.30072 6.0086 3.72464 5.83301 4.16667 5.83301H5.83333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">Name</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php if($client_name){ echo $client_name; }else{ echo 'N/A'; } ?></span> 
                                    <div class="copy_tag_box">
                                        <a href="javascript:void(0)" class="copy_tag">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.8333 2.5H7.49998C6.57951 2.5 5.83331 3.24619 5.83331 4.16667V12.5C5.83331 13.4205 6.57951 14.1667 7.49998 14.1667H15.8333C16.7538 14.1667 17.5 13.4205 17.5 12.5V4.16667C17.5 3.24619 16.7538 2.5 15.8333 2.5Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14.1667 14.1663V15.833C14.1667 16.275 13.9911 16.699 13.6785 17.0115C13.366 17.3241 12.942 17.4997 12.5 17.4997H4.16667C3.72464 17.4997 3.30072 17.3241 2.98816 17.0115C2.67559 16.699 2.5 16.275 2.5 15.833V7.49967C2.5 7.05765 2.67559 6.63372 2.98816 6.32116C3.30072 6.0086 3.72464 5.83301 4.16667 5.83301H5.83333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">Email</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php if($client_email){ echo $client_email; }else{ echo 'N/A'; } ?></span>
                                    <div class="copy_tag_box">
                                        <a href="javascript:void(0)" class="copy_tag">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.8333 2.5H7.49998C6.57951 2.5 5.83331 3.24619 5.83331 4.16667V12.5C5.83331 13.4205 6.57951 14.1667 7.49998 14.1667H15.8333C16.7538 14.1667 17.5 13.4205 17.5 12.5V4.16667C17.5 3.24619 16.7538 2.5 15.8333 2.5Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14.1667 14.1663V15.833C14.1667 16.275 13.9911 16.699 13.6785 17.0115C13.366 17.3241 12.942 17.4997 12.5 17.4997H4.16667C3.72464 17.4997 3.30072 17.3241 2.98816 17.0115C2.67559 16.699 2.5 16.275 2.5 15.833V7.49967C2.5 7.05765 2.67559 6.63372 2.98816 6.32116C3.30072 6.0086 3.72464 5.83301 4.16667 5.83301H5.83333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">Phone Number</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php if(get_field('phone_number')){ echo get_field('phone_number'); }else{ echo 'N/A'; } ?></span>
                                    <div class="copy_tag_box">
                                        <a href="javascript:void(0)" class="copy_tag">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.8333 2.5H7.49998C6.57951 2.5 5.83331 3.24619 5.83331 4.16667V12.5C5.83331 13.4205 6.57951 14.1667 7.49998 14.1667H15.8333C16.7538 14.1667 17.5 13.4205 17.5 12.5V4.16667C17.5 3.24619 16.7538 2.5 15.8333 2.5Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14.1667 14.1663V15.833C14.1667 16.275 13.9911 16.699 13.6785 17.0115C13.366 17.3241 12.942 17.4997 12.5 17.4997H4.16667C3.72464 17.4997 3.30072 17.3241 2.98816 17.0115C2.67559 16.699 2.5 16.275 2.5 15.833V7.49967C2.5 7.05765 2.67559 6.63372 2.98816 6.32116C3.30072 6.0086 3.72464 5.83301 4.16667 5.83301H5.83333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">Birth Date</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php if(get_field('date_of_birth')){ echo get_field('date_of_birth'); }else{ echo 'N/A'; } ?></span> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="client_dtl_row form_row">
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">Category type</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php if($category_name){ echo $category_name; }else{ echo 'N/A'; } ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php 
                // Check rows existexists. 
                if( have_rows('personal_details') ):
                ?>
                <div class="client_dtl_lista">
                    <h3>Personal details</h3>
                    <div class="client_dtl_row form_row">
                        <?php
                        // Loop through rows.
                        while( have_rows('personal_details') ) : the_row();
                            $file_url = get_sub_field('pr_detail_file');
                            if($file_url){
                                $doc_name = basename($file_url);
                            }else{
                                $doc_name = '';
                            }
                        ?>
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">Field name</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php if(get_sub_field('pr_detail_name')){ echo get_sub_field('pr_detail_name'); }else{ echo 'N/A'; } ?></span> 
                                </div>
                            </div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">Detail</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php if(get_sub_field('pr_detail_text')){ echo get_sub_field('pr_detail_text'); }else{ echo 'N/A'; } ?></span>
                                    <div class="copy_tag_box">
                                        <a href="javascript:void(0)" class="copy_tag">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.8333 2.5H7.49998C6.57951 2.5 5.83331 3.24619 5.83331 4.16667V12.5C5.83331 13.4205 6.57951 14.1667 7.49998 14.1667H15.8333C16.7538 14.1667 17.5 13.4205 17.5 12.5V4.16667C17.5 3.24619 16.7538 2.5 15.8333 2.5Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14.1667 14.1663V15.833C14.1667 16.275 13.9911 16.699 13.6785 17.0115C13.366 17.3241 12.942 17.4997 12.5 17.4997H4.16667C3.72464 17.4997 3.30072 17.3241 2.98816 17.0115C2.67559 16.699 2.5 16.275 2.5 15.833V7.49967C2.5 7.05765 2.67559 6.63372 2.98816 6.32116C3.30072 6.0086 3.72464 5.83301 4.16667 5.83301H5.83333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">File</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php echo $doc_name; ?></span> 
                                    <div class="copy_tag_box">
                                        <a href="<?php if(get_sub_field('pr_detail_file')){ echo get_sub_field('pr_detail_file'); }else{ echo 'N/A'; } ?>" class="copy_tag" target="_blank">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.6666 2.5V5.83333C11.6666 6.05435 11.7544 6.26631 11.9107 6.42259C12.067 6.57887 12.2789 6.66667 12.5 6.66667H15.8333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14.1666 17.5H5.83329C5.39127 17.5 4.96734 17.3244 4.65478 17.0118C4.34222 16.6993 4.16663 16.2754 4.16663 15.8333V4.16667C4.16663 3.72464 4.34222 3.30072 4.65478 2.98816C4.96734 2.67559 5.39127 2.5 5.83329 2.5H11.6666L15.8333 6.66667V15.8333C15.8333 16.2754 15.6577 16.6993 15.3451 17.0118C15.0326 17.3244 14.6087 17.5 14.1666 17.5Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        // End loop.
                        endwhile;
                        ?>
                    </div>
                </div>
                <?php endif; ?>

               
                <?php 
                // Check rows existexists.
                if( have_rows('authorize_persons') ):
                ?>
                <div class="client_dtl_lista">
                    <h3>Authorize persons</h3>
                    <div class="client_dtl_row form_row">
                        <?php
                        // Loop through rows.
                        while( have_rows('authorize_persons') ) : the_row();
                        ?>
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">Name</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php if(get_sub_field('auth_name')){ echo get_sub_field('auth_name'); }else{ echo 'N/A'; } ?></span> 
                                    <div class="copy_tag_box">
                                        <a href="javascript:void(0)" class="copy_tag">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.8333 2.5H7.49998C6.57951 2.5 5.83331 3.24619 5.83331 4.16667V12.5C5.83331 13.4205 6.57951 14.1667 7.49998 14.1667H15.8333C16.7538 14.1667 17.5 13.4205 17.5 12.5V4.16667C17.5 3.24619 16.7538 2.5 15.8333 2.5Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14.1667 14.1663V15.833C14.1667 16.275 13.9911 16.699 13.6785 17.0115C13.366 17.3241 12.942 17.4997 12.5 17.4997H4.16667C3.72464 17.4997 3.30072 17.3241 2.98816 17.0115C2.67559 16.699 2.5 16.275 2.5 15.833V7.49967C2.5 7.05765 2.67559 6.63372 2.98816 6.32116C3.30072 6.0086 3.72464 5.83301 4.16667 5.83301H5.83333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">Phone Number</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php if(get_sub_field('auth_phone')){ echo get_sub_field('auth_phone'); }else{ echo 'N/A'; } ?></span> 
                                    <div class="copy_tag_box">
                                        <a href="javascript:void(0)" class="copy_tag">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.8333 2.5H7.49998C6.57951 2.5 5.83331 3.24619 5.83331 4.16667V12.5C5.83331 13.4205 6.57951 14.1667 7.49998 14.1667H15.8333C16.7538 14.1667 17.5 13.4205 17.5 12.5V4.16667C17.5 3.24619 16.7538 2.5 15.8333 2.5Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14.1667 14.1663V15.833C14.1667 16.275 13.9911 16.699 13.6785 17.0115C13.366 17.3241 12.942 17.4997 12.5 17.4997H4.16667C3.72464 17.4997 3.30072 17.3241 2.98816 17.0115C2.67559 16.699 2.5 16.275 2.5 15.833V7.49967C2.5 7.05765 2.67559 6.63372 2.98816 6.32116C3.30072 6.0086 3.72464 5.83301 4.16667 5.83301H5.83333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form_col_1-3">
                            <div class="client_dtl">
                                <div class="label_title">Email</div>
                                <div class="client_dtl_parsnal">
                                    <span><?php if(get_sub_field('auth_email')){ echo get_sub_field('auth_email'); }else{ echo 'N/A'; } ?></span> 
                                    <div class="copy_tag_box">
                                        <a href="javascript:void(0)" class="copy_tag">
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M15.8333 2.5H7.49998C6.57951 2.5 5.83331 3.24619 5.83331 4.16667V12.5C5.83331 13.4205 6.57951 14.1667 7.49998 14.1667H15.8333C16.7538 14.1667 17.5 13.4205 17.5 12.5V4.16667C17.5 3.24619 16.7538 2.5 15.8333 2.5Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M14.1667 14.1663V15.833C14.1667 16.275 13.9911 16.699 13.6785 17.0115C13.366 17.3241 12.942 17.4997 12.5 17.4997H4.16667C3.72464 17.4997 3.30072 17.3241 2.98816 17.0115C2.67559 16.699 2.5 16.275 2.5 15.833V7.49967C2.5 7.05765 2.67559 6.63372 2.98816 6.32116C3.30072 6.0086 3.72464 5.83301 4.16667 5.83301H5.83333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        // End loop.
                        endwhile;
                        ?>
                    </div>
                </div>
                <?php endif; ?>
            </div>
            <div class="bottom_client_dtl">

                <div class="error-message" style="color: red;"><?php echo isset($error) ? $error : ''; ?></div>
                <div class="success-message" style="color: green;"><?php echo isset($success) ? $success : ''; ?></div>
                <ul class="nav nav-tabs select_cat_link" id="select_cat" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php if(isset($_GET['genral'])){  }else{ echo 'active'; } ?>" id="select_cat_tab_1" data-bs-toggle="tab" data-bs-target="#select_cat_tab_pane_1" type="button" role="tab" aria-controls="select_cat_tab_pane_1" aria-selected="false">Personal files</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link <?php if(isset($_GET['genral'])){ echo 'active'; }else{  } ?>" id="select_cat_tab_1" data-bs-toggle="tab" data-bs-target="#select_cat_tab_pane_2" type="button" role="tab" aria-controls="select_cat_tab_pane_2" aria-selected="false">General Files</button>
                    </li>
                </ul>
                <div class="tab-content select_cat_description" id="myTabContent">
                    <div class="tab-pane fade <?php if(isset($_GET['genral'])){  }else{ echo 'show active'; } ?>" id="select_cat_tab_pane_1" role="tabpanel" aria-labelledby="select_cat_tab_1" tabindex="0">
                        <div class="tab-pane-wrap">
                            <?php
                            if($cr_user_roles == 'administrator'){
                                ?>
                                <div class="top_add_file">
                                    <a href="javascript:void(0)" class="modal_personal_file">
                                        Add personal file
                                        <i>
                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M10 4.16699V15.8337" stroke="#2C3E50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                                <path d="M4.16663 10H15.8333" stroke="#2C3E50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            </svg>  
                                        </i>
                                    </a>
                                </div>
                                <?php
                            }
                            ?>
                            <table id="personal_files" class="table table-striped nowrap" style="width:100%" border="0">
                                <thead>
                                    <tr>
                                        <th>
                                            <div class="filter_wrap flxrow">
                                                <span>File name</span>
                                                <div class="filter_box flxrow">
                                                    <a href="#">
                                                        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11 6L6 1L1 6H11Z" stroke="#A6ABBD" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="#">
                                                        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 1L6 6L11 1H1Z" stroke="#A6ABBD" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>                                                    
                                                    </a>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="filter_wrap flxrow">
                                                <span>Category</span>
                                                <div class="filter_box flxrow">
                                                    <a href="#">
                                                        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11 6L6 1L1 6H11Z" stroke="#A6ABBD" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="#">
                                                        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 1L6 6L11 1H1Z" stroke="#A6ABBD" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>                                                    
                                                    </a>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="filter_wrap flxrow">
                                                <span>Client name</span>
                                                <div class="filter_box flxrow">
                                                    <a href="#">
                                                        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11 6L6 1L1 6H11Z" stroke="#A6ABBD" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="#">
                                                        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 1L6 6L11 1H1Z" stroke="#A6ABBD" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>                                                    
                                                    </a>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="filter_wrap flxrow">
                                                <span>For Date</span>
                                                <div class="filter_box flxrow">
                                                    <a href="#">
                                                        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11 6L6 1L1 6H11Z" stroke="#A6ABBD" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="#">
                                                        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 1L6 6L11 1H1Z" stroke="#A6ABBD" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>                                                    
                                                    </a>
                                                </div>
                                            </div>
                                        </th>
                                        <th>
                                            <div class="filter_wrap flxrow">
                                                <span>Description</span>
                                                <div class="filter_box flxrow">
                                                    <a href="#">
                                                        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11 6L6 1L1 6H11Z" stroke="#A6ABBD" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                    <a href="#">
                                                        <svg width="12" height="7" viewBox="0 0 12 7" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1 1L6 6L11 1H1Z" stroke="#A6ABBD" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>                                                    
                                                    </a>
                                                </div>
                                            </div>
                                        </th>
                                        <th class="button_action"><span class="acttion_txt"></span></th>
                                    </tr>
                                </thead>
                                <tbody id="personal_file_posts" class="personal_file_posts">
                                    <?php
                                    $i = "0";
                                    foreach($personal_file_list as $single_pr_file){
                                        $personal_file = $single_pr_file['personal_file'];
                                        $pr_file_url = wp_get_attachment_url($personal_file);
                                        $filename = basename($pr_file_url);
                                        $personal_category_id = $single_pr_file['personal_category_type'][0];
                                        $category = get_term_by( 'id', $personal_category_id, 'client-category');
                                        $category_name = $category->name;
                                        $personal_month = $single_pr_file['personal_month'];
                                        $personal_year = $single_pr_file['personal_year'];
                                        $personal_description = $single_pr_file['personal_description'];
                                        ?>
                                        <tr>
                                            <td><?php echo $filename; ?></td>
                                            <td><?php echo $category_name; ?></td>
                                            <td>Alexander</td>
                                            <td><?php echo $personal_month; ?> <?php echo $personal_year; ?></td>
                                            <td><?php echo $personal_description; ?></td>
                                            <td class="button_action">
                                                <div class="button_grp">
                                                    <div class="button_box view_box_bnt">
                                                        <a href="<?php echo $pr_file_url; ?>" target="_blank">
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M10 11.6663C10.9205 11.6663 11.6667 10.9201 11.6667 9.99967C11.6667 9.0792 10.9205 8.33301 10 8.33301C9.07957 8.33301 8.33337 9.0792 8.33337 9.99967C8.33337 10.9201 9.07957 11.6663 10 11.6663Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M18.3333 10.0003C16.1108 13.8895 13.3333 15.8337 9.99996 15.8337C6.66663 15.8337 3.88913 13.8895 1.66663 10.0003C3.88913 6.11116 6.66663 4.16699 9.99996 4.16699C13.3333 4.16699 16.1108 6.11116 18.3333 10.0003Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <div class="button_box download_box_btn">
                                                        <a href="<?php echo $pr_file_url; ?>" download>
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.6666 2.5V5.83333C11.6666 6.05435 11.7544 6.26631 11.9107 6.42259C12.067 6.57887 12.2789 6.66667 12.5 6.66667H15.8333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M14.1666 17.5H5.83329C5.39127 17.5 4.96734 17.3244 4.65478 17.0118C4.34222 16.6993 4.16663 16.2754 4.16663 15.8333V4.16667C4.16663 3.72464 4.34222 3.30072 4.65478 2.98816C4.96734 2.67559 5.39127 2.5 5.83329 2.5H11.6666L15.8333 6.66667V15.8333C15.8333 16.2754 15.6577 16.6993 15.3451 17.0118C15.0326 17.3244 14.6087 17.5 14.1666 17.5Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M10 9.16699V14.167" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M7.5 11.667L10 14.167L12.5 11.667" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                    <?php
                                                    if($cr_user_roles == 'administrator'){
                                                        ?>
                                                        <div class="button_box delete_box_btn">
                                                            <a href="javascript:void(0)" class="file_delete_btn" data-id="<?php echo $i; ?>" data-name="personal" client-id="<?php echo $posts_data; ?>">
                                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M3.33337 5.83301H16.6667" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    <path d="M8.33337 9.16699V14.167" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    <path d="M11.6666 9.16699V14.167" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    <path d="M4.16663 5.83301L4.99996 15.833C4.99996 16.275 5.17555 16.699 5.48811 17.0115C5.80068 17.3241 6.2246 17.4997 6.66663 17.4997H13.3333C13.7753 17.4997 14.1992 17.3241 14.5118 17.0115C14.8244 16.699 15 16.275 15 15.833L15.8333 5.83301" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    <path d="M7.5 5.83333V3.33333C7.5 3.11232 7.5878 2.90036 7.74408 2.74408C7.90036 2.5878 8.11232 2.5 8.33333 2.5H11.6667C11.8877 2.5 12.0996 2.5878 12.2559 2.74408C12.4122 2.90036 12.5 3.11232 12.5 3.33333V5.83333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php
                                        $i++;
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="tab-pane fade <?php if(isset($_GET['genral'])){ echo 'show active'; }else{  } ?>" id="select_cat_tab_pane_2" role="tabpanel" aria-labelledby="select_cat_tab_1" tabindex="0">
                        <div class="tab-pane-wrap">
                        <?php
                        if($cr_user_roles == 'administrator'){
                            ?>
                            <div class="top_add_file">
                                <a href="javascript:void(0)" class="modal_general_file">
                                    Add General file
                                    <i>
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M10 4.16699V15.8337" stroke="#2C3E50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M4.16663 10H15.8333" stroke="#2C3E50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                            
                                    </i>
                                </a>
                            </div>
                            <?php
                        }
                        ?>
                            <table id="general_files" class="table table-striped nowrap" style="width:100%" border="0">
                                <thead>
                                    <tr>
                                        <th><span>File name</span></th>
                                        <th><span>Description</span></th>
                                        <th class="button_action"><span class="acttion_txt"></span></th>
                                    </tr>
                                </thead>
                                <tbody id="general_file_posts" class="general_file_posts">
                                    <?php
                                    $j = "0";
                                    if($general_file_list){
                                        foreach($general_file_list as $single_gn_file){
                                            $general_list_file = $single_gn_file['general_list_file'];
                                            $gn_file_url = wp_get_attachment_url($general_list_file);
                                            $filename = basename($gn_file_url);
                                            $general_list_description = $single_gn_file['general_list_description'];
                                            ?>
                                            <tr>
                                                <td><?php echo $filename; ?></td>
                                                <td><?php echo $general_list_description; ?></td>
                                                <td class="button_action">
                                                    <div class="button_grp">
                                                        <div class="button_box view_box_bnt">
                                                            <a href="<?php echo $gn_file_url; ?>" target="_blank">
                                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M10 11.6663C10.9205 11.6663 11.6667 10.9201 11.6667 9.99967C11.6667 9.0792 10.9205 8.33301 10 8.33301C9.07957 8.33301 8.33337 9.0792 8.33337 9.99967C8.33337 10.9201 9.07957 11.6663 10 11.6663Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    <path d="M18.3333 10.0003C16.1108 13.8895 13.3333 15.8337 9.99996 15.8337C6.66663 15.8337 3.88913 13.8895 1.66663 10.0003C3.88913 6.11116 6.66663 4.16699 9.99996 4.16699C13.3333 4.16699 16.1108 6.11116 18.3333 10.0003Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <div class="button_box download_box_btn">
                                                            <a href="<?php echo $gn_file_url; ?>" download>
                                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M11.6666 2.5V5.83333C11.6666 6.05435 11.7544 6.26631 11.9107 6.42259C12.067 6.57887 12.2789 6.66667 12.5 6.66667H15.8333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    <path d="M14.1666 17.5H5.83329C5.39127 17.5 4.96734 17.3244 4.65478 17.0118C4.34222 16.6993 4.16663 16.2754 4.16663 15.8333V4.16667C4.16663 3.72464 4.34222 3.30072 4.65478 2.98816C4.96734 2.67559 5.39127 2.5 5.83329 2.5H11.6666L15.8333 6.66667V15.8333C15.8333 16.2754 15.6577 16.6993 15.3451 17.0118C15.0326 17.3244 14.6087 17.5 14.1666 17.5Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    <path d="M10 9.16699V14.167" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    <path d="M7.5 11.667L10 14.167L12.5 11.667" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <?php
                                                        if($cr_user_roles == 'administrator'){
                                                            ?>
                                                            <div class="button_box delete_box_btn">
                                                                <a href="javascript:void(0)" class="file_delete_btn" data-id="<?php echo $j; ?>" data-name="general" client-id="<?php echo $posts_data; ?>">
                                                                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M3.33337 5.83301H16.6667" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        <path d="M8.33337 9.16699V14.167" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        <path d="M11.6666 9.16699V14.167" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        <path d="M4.16663 5.83301L4.99996 15.833C4.99996 16.275 5.17555 16.699 5.48811 17.0115C5.80068 17.3241 6.2246 17.4997 6.66663 17.4997H13.3333C13.7753 17.4997 14.1992 17.3241 14.5118 17.0115C14.8244 16.699 15 16.275 15 15.833L15.8333 5.83301" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                        <path d="M7.5 5.83333V3.33333C7.5 3.11232 7.5878 2.90036 7.74408 2.74408C7.90036 2.5878 8.11232 2.5 8.33333 2.5H11.6667C11.8877 2.5 12.0996 2.5878 12.2559 2.74408C12.4122 2.90036 12.5 3.11232 12.5 3.33333V5.83333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    </svg>
                                                                        
                                                                </a>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                            $j++;
                                        }
                                    }
                                    ?>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    </div>
<!-- </div> -->
<?php
// $cur_year = date('Y');
// $cur_yearadd = date('Y');
// for ($i=0; $i<=5; $i++) {
//     echo $cur_year-- . ',';
//     echo '<br>';
// }
// for ($i=0; $i<=5; $i++) {
//     echo $cur_yearadd++ . ',';
//     echo '<br>';
// }
?>
<div class="modal fade modal_cat_add modal_personal_file_add" id="modal_personal_file_add" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Personal file</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="file_add_personal">
                    <input type="hidden" name="client_gt_id" value="<?php echo $posts_data; ?>">
                    <div class="form_row">
                        <div class="form_col_1-2">
                            <div class="input_container">
                                <input type="file" name="file_upload" id="file_upload_2">
                                <label for="file_upload_2">Browse file</label>
                            </div>
                        </div>
                        <?php
                        $Category = get_terms('client-category', array(
							'hide_empty' => false,
						));
                        ?>
                        <div class="form_col_1-2">
                            <div class="input_container">
                                <select name="category_type" id="category_type">
                                    <option selected disabled>Category type</option>
                                    <?php
                                    foreach($Category as $value){
                                        ?>
                                        <option value="<?php echo $value->term_id; ?>"><?php echo $value->name ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form_col_1-2">
                            <div class="input_container">
                                <select name="month_tr" id="month">
                                    <option disabled selected>Month</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                        </div>
                        <div class="form_col_1-2">
                            <div class="input_container">
                                <select name="year_tr" id="year">
                                    <option disabled selected>Year</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                </select>
                            </div>
                        </div>
                        <div class="form_col_1-1">
                            <div class="input_container">
                                <textarea name="descriptionrt" id="description" placeholder="Description" class="input_field"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form_submit flxrow">
                        <input type="button" value="Submit" name="personal_file_btnadd_check" class="primary_btn personal_file_btnadd  personal_file_btnadd_check">
                        <input type="submit" value="Submit" name="personal_file_add" formaction="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="primary_btn main_btn_prt personal_file_add">
                        <input type="hidden" name="action" value="custom_actionr">
                        <?php wp_nonce_field('custom_actionr_nonce', 'custom_actionr_nonce'); ?>
                        <input type="button" value="Close" class="primary_btn cancle_btn" data-bs-dismiss="modal" aria-label="Close">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal for delete-->
<div class="modal fade" id="delete-pop" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="delete-box">
            <h3>Are you sure you want to delete</h3>
            <div class="box-wrap flxrow">
                <a href="#" class="primary_btn">Delete</a>
                <a href="#" class="primary_btn cancle_btn" data-bs-dismiss="modal" aria-label="Close" value="Close">Cancel</a>
            </div>
        </div>
      </div>
    </div>
  </div>
<!-- Modal for delete-->
<!--  -->
<div class="modal fade modal_cat_add modal_general_file_add" id="modal_general_file_add" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">General file</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="file_add_general">
                    <input type="hidden" name="client_gt_id" value="<?php echo $posts_data; ?>">
                    <div class="form_row">
                        <div class="form_col_1-1">
                            <div class="input_container">
                                <input type="file" name="file_uplaod" id="file_upload_3" required>
                                <label for="file_upload_3">Browse file</label>
                            </div>
                        </div>
                        <div class="form_col_1-1">
                            <div class="input_container">
                                <textarea name="description_gn" id="description_gn" required placeholder="Description" class="input_field"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form_submit flxrow">
                        <input type="submit" value="Submit" name="general_file_btnadd" formaction="<?php echo esc_url(admin_url('admin-post.php')); ?>" class="primary_btn general_file_btnadd">
                        <input type="hidden" name="action" value="custom_action">
                        <?php wp_nonce_field('custom_action_nonce', 'custom_action_nonce'); ?>
                        <input type="button" value="Close" class="primary_btn cancle_btn" data-bs-dismiss="modal" aria-label="Close">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Wrapper End-->
<?php endif; ?>

<?php
$client_title_message = get_field('client_title_message','option');
$client_text_message = get_field('client_text_message','option');
?>
<div class="main_success_popup">
    <div id="popupsucess" class="overlay">
        <div class="popup">
            <div class="card">
                <div style="border-radius:200px; height:200px; width:200px; background: #F8FAF5; margin:0 auto;">
                    <i class="checkmark">✓</i>
                </div>
                <?php
                if($client_title_message){
                    ?>
                    <h1><?php echo $client_title_message; ?></h1> 
                    <?php
                }
                if($client_text_message){
                    ?>
                    <p><?php echo $client_text_message; ?></p>
                    <?php
                }
                ?>
                <a href="#">OK</a>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        jQuery('.main_btn_prt').hide();
        jQuery('.copy_tag').on('click', function(){
            var copyText = jQuery(this).parents('.client_dtl_parsnal').find('span');
            copyText.select();

            navigator.clipboard.writeText(copyText.html());

            jQuery(this).find('svg').css('fill', 'green');

            setTimeout(function() {
                jQuery(this).find('svg').css('fill', '#00800000');
            },3000);

        });

        jQuery('.modal_personal_file').on('click', function(){
            jQuery('#modal_personal_file_add').modal('show');
        });

        jQuery('.modal_general_file').on('click', function(){
            jQuery('#modal_general_file_add').modal('show');
        });
    });
</script>
<script>
    jQuery('.file_delete_btn').click(function(){			   
        var fid = jQuery(this).attr('data-id');	
        var fname = jQuery(this).attr('data-name');
        var clientid = jQuery(this).attr('client-id');

        jQuery.ajax({
            type   : 'POST',
            url    : ca_ajax_object.ajax_url,
            data   : {
                fid:fid,
                fname:fname,
                clientid:clientid,
                action: 'files_delete',
            },
            success: function(response){
                if(fname == 'personal'){
                    jQuery('#personal_file_posts').html(response);
                }
                if(fname == 'general'){
                    jQuery('#general_file_posts').html(response);
                }
                
                jQuery('.success-message').html('File deleted successfully.');
            }
        });
    });

    jQuery('.personal_file_btnadd_check').click(function(){
        var files = jQuery('#file_upload_2').val();
        var desc = jQuery('#description').val();
        var category = jQuery('#category_type').val();
        var month = jQuery('#month').val();
        var year = jQuery('#year').val();
        if(files){ jQuery('#file_upload_2').parent().removeClass('error'); }else{ jQuery('#file_upload_2').parent().addClass('error'); }
        if(desc){ jQuery('#description').parent().removeClass('error'); }else{ jQuery('#description').parent().addClass('error'); }
        if(category){ jQuery('#category_type').parent().removeClass('error'); }else{ jQuery('#category_type').parent().addClass('error'); }
        if(month){ jQuery('#month').parent().removeClass('error'); }else{ jQuery('#month').parent().addClass('error'); }
        if(year){ jQuery('#year').parent().removeClass('error'); }else{ jQuery('#year').parent().addClass('error'); }

        if(files != '' && category != '' && month != '' && year != '' && desc != ''){
            jQuery('.personal_file_btnadd_check').hide();
            jQuery('.main_btn_prt').show();
            jQuery('.main_btn_prt').click();
        }
    });

    jQuery("#file_upload_2").on("change", function(e){
        var filename = e.target.files[0].name;
        jQuery(this).parent().find('label').html(filename);
    });

    jQuery("#file_upload_3").on("change", function(e){
        var filename = e.target.files[0].name;
        jQuery(this).parent().find('label').html(filename);
    });
</script>
<?php
get_footer();
?>
