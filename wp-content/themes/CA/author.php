<?php 
get_header(); 
global $wp_query;
$home_url = home_url();
$curauth = $wp_query->get_queried_object();
$user_id = $curauth->ID;
$user_info = get_userdata($user_id);
$user_data = get_user_meta($user_id);
$postid = $user_data['post_id'][0];

$client_display = $user_info->display_name;
$client_username = $user_info->user_login;
$client_email = $user_info->user_email;
$clinet_role = $user_info->roles[0];
$client_name = $user_data['first_name'][0];

$client_type = get_field('client_type',$postid);
$company_type = get_field('company_type',$postid);
$phone_number = get_field('phone_number',$postid);
$resident_status = get_field('resident_status',$postid);
$category_type = get_field('category_type',$postid);
$category_name = get_term( $category_type )->name;
$group_with = get_field('group_with',$postid);
$date_of_birth = get_field('date_of_birth',$postid);
$personal_details = get_field('personal_details',$postid);
$authorize_persons = get_field('authorize_persons',$postid);
$status = get_field('client_status',$postid);

$personal_file_list = get_field('file_details',$postid);
$general_file_list = get_field('general_files',$postid);

?>
        <div class="page-wrapper admin-profile-page dashboard-container">
            <?php
            if($clinet_role == 'employees' OR $clinet_role == 'administrator'){
                ?>
                <div class="page-title d-flex flex-wrap align-items-center justify-content-between">
                    <h1><?php echo $client_username; ?></h1>
                    <div class="title-icon">
                        <a class="icon" href="<?php echo $home_url.'/edit-profile?user_id='.$user_id; ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/profile-edit-icon.svg" alt=""></a>
                    </div>
                </div>
                <div class="page-block">
                    <div class="admin-profile-form">
                        <form>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-box">
                                        <label class="form-label">Username</label>
                                        <div class="form-input"><?php echo $client_username; ?><a class="icon" href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/copy-icon.svg" alt=""></a></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-box">
                                        <label class="form-label">Name</label>
                                        <div class="form-input"><?php echo $client_name; ?> <a class="icon" href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/copy-icon.svg" alt=""></a></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-box">
                                        <label class="form-label">Email</label>
                                        <div class="form-input"><?php echo $client_email; ?> <a class="icon" href="#"><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/copy-icon.svg" alt=""></a></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            }
            ?>

            <?php
            if($clinet_role == 'clients'){
                ?>
                <div class="dash_wrap_inner client-detai">
                    <div class="page-title d-flex flex-wrap align-items-center justify-content-between">
                        <h1><?php echo $client_username; ?></h1>
                    </div>
                    <div class="client_dtl_wrap">
                        <div class="client_dtl_lista">
                            <div class="client_dtl_row form_row">
                                <div class="form_col_1-3">
                                    <div class="client_dtl">
                                        <div class="label_title">Client type</div>
                                        <div class="client_dtl_parsnal">
                                            <span><?php echo $client_type; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_col_1-3">
                                    <div class="client_dtl">
                                        <div class="label_title">Company type</div>
                                        <div class="client_dtl_parsnal">
                                            <span><?php echo $company_type; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form_col_1-3">
                                    <div class="client_dtl">
                                        <div class="label_title">Resident Status</div>
                                        <div class="client_dtl_parsnal">
                                            <span><?php echo $resident_status; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="client_dtl_row form_row">
                                <div class="form_col_1-3">
                                    <div class="client_dtl">
                                        <div class="label_title">Username</div>
                                        <div class="client_dtl_parsnal">
                                            <span><?php echo $client_username; ?></span> 
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
                                            <span><?php echo $client_name; ?></span> 
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
                                            <span><?php echo $client_email; ?></span> 
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
                                            <span>+91 <?php echo $phone_number; ?></span> 
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
                            </div>
                            <div class="client_dtl_row form_row">
                                <div class="form_col_1-3">
                                    <div class="client_dtl">
                                        <div class="label_title">Category type</div>
                                        <div class="client_dtl_parsnal">
                                            <span><?php echo $category_name; ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php
                        if($personal_details){
                            ?>
                            <div class="client_dtl_lista">
                                <h3>Personal details</h3>
                                <?php
                                foreach($personal_details as $single_prdetail){
                                    $prdetail_name = $single_prdetail['pr_detail_name'];
                                    $prdetail_text = $single_prdetail['pr_detail_text'];
                                    $prdetail_file = $single_prdetail['pr_detail_file'];
                                    $filename = basename($prdetail_file);
                                    ?>
                                    <div class="client_dtl_row form_row">
                                        <div class="form_col_1-3">
                                            <div class="client_dtl">
                                                <div class="label_title">Field name</div>
                                                <div class="client_dtl_parsnal">
                                                    <span><?php echo $prdetail_name; ?></span> 
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form_col_1-3">
                                            <div class="client_dtl">
                                                <div class="label_title">Detail</div>
                                                <div class="client_dtl_parsnal">
                                                    <span><?php echo $prdetail_text; ?></span> 
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
                                                    <span><?php echo $filename; ?></span> 
                                                    <div class="copy_tag_box">
                                                        <a href="files/Dummy-Document.docx" class="copy_tag" target="_blank">
                                                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11.6666 2.5V5.83333C11.6666 6.05435 11.7544 6.26631 11.9107 6.42259C12.067 6.57887 12.2789 6.66667 12.5 6.66667H15.8333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                <path d="M14.1666 17.5H5.83329C5.39127 17.5 4.96734 17.3244 4.65478 17.0118C4.34222 16.6993 4.16663 16.2754 4.16663 15.8333V4.16667C4.16663 3.72464 4.34222 3.30072 4.65478 2.98816C4.96734 2.67559 5.39127 2.5 5.83329 2.5H11.6666L15.8333 6.66667V15.8333C15.8333 16.2754 15.6577 16.6993 15.3451 17.0118C15.0326 17.3244 14.6087 17.5 14.1666 17.5Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </svg>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                }
                                ?>
                                
                            </div>
                            <?php
                        }
                        ?>

                        <?php
                        if($authorize_persons){
                            ?>
                            <div class="client_dtl_lista">
                                <h3>Authorize persons</h3>
                                <?php
                                foreach($authorize_persons as $single_person){
                                    $person_name = $single_person['auth_name'];
                                    $person_email = $single_person['auth_email'];
                                    $person_phone = $single_person['auth_phone'];
                                    ?>
                                    <div class="client_dtl_row form_row">
                                        <div class="form_col_1-3">
                                            <div class="client_dtl">
                                                <div class="label_title">Name</div>
                                                <div class="client_dtl_parsnal">
                                                    <span><?php echo $person_name; ?></span> 
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
                                                    <span>+91 <?php echo $person_phone; ?></span> 
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
                                                    <span><?php echo $person_email; ?></span> 
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
                                    </div>
                                    <?php
                                }
                                ?>

                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="bottom_client_dtl">
                        <div class="error-message" style="color: red;"><?php echo isset($error) ? $error : ''; ?></div>
                        <div class="success-message" style="color: green;"><?php echo isset($success) ? $success : ''; ?></div>
                        <ul class="nav nav-tabs select_cat_link" id="select_cat" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="select_cat_tab_1" data-bs-toggle="tab" data-bs-target="#select_cat_tab_pane_1" type="button" role="tab" aria-controls="select_cat_tab_pane_1" aria-selected="true">Personal files</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="select_cat_tab_1" data-bs-toggle="tab" data-bs-target="#select_cat_tab_pane_2" type="button" role="tab" aria-controls="select_cat_tab_pane_2" aria-selected="false">General Files</button>
                            </li>
                        </ul>
                        <div class="tab-content select_cat_description" id="myTabContent">
                            <div class="tab-pane fade show active" id="select_cat_tab_pane_1" role="tabpanel" aria-labelledby="select_cat_tab_1" tabindex="0">
                                <div class="tab-pane-wrap">
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
                            <div class="tab-pane fade" id="select_cat_tab_pane_2" role="tabpanel" aria-labelledby="select_cat_tab_1" tabindex="0">
                                <div class="tab-pane-wrap">
                                    <?php
                                    if($clinet_role == 'administrator' OR $clinet_role == 'clients'){
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
                                                            if($clinet_role == 'administrator' OR $clinet_role == 'clients'){
                                                                ?>
                                                                <div class="button_box delete_box_btn">
                                                                    <a href="javascript:void(0)" class="file_delete_btn" data-id="<?php echo $j; ?>" data-name="general" client-id="<?php echo $postid; ?>">
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
                                            ?>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>

<div class="modal fade modal_cat_add modal_general_file_add" id="modal_general_file_add" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">General file</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" enctype="multipart/form-data" id="file_add_general">
                    <input type="hidden" name="client_gt_id" value="<?php echo $postid; ?>">
                    <div class="form_row">
                        <div class="form_col_1-1">
                            <div class="input_container">
                                <input type="file" name="file_uplaod" id="file_upload_3" required>
                                <label for="file_upload_3">Browse file</label>
                            </div>
                        </div>
                        <div class="form_col_1-1">
                            <div class="input_container">
                                <textarea name="description_gn" id="description_gn" placeholder="Description" class="input_field" required></textarea>
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

<?php get_footer(); ?>

<script>
    jQuery(document).ready(function(){
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
</script>