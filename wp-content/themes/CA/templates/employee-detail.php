<?php 
/* Template Name: Employee Detail Template */
get_header();

$home_url = home_url();
if(isset($_GET['employee_id'])){
    $employee_id = $_GET['employee_id'];
    $employee_info = get_userdata($employee_id);
    $employee_username = $employee_info->user_login;
    $employee_fname = get_user_meta( $employee_id, 'first_name', true );
    $employee_email = $employee_info->user_email;    
}


$user_id = get_current_user_id();
$user_meta = get_userdata($user_id);
$user_roles = $user_meta->roles[0];
?>

<?php
if($user_roles == 'administrator'){
	?>
<!--Wrapper Start-->
<div class="wrapper_main">
    <div class="dash_wrap_inner employes-details dashboard-container">
        <?php if(isset($_GET['employee_id'])): ?>
        <div class="emp_main">
            <div class="emp_title flxrow">
                <h3><?php echo $employee_fname; ?></h3>
                <div class="filter_right">
                    <!-- <div class="filter_right_list switch-box">
                        <div class="custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customswitch1">
                            <label class="custom-control-label" for="customswitch1"></label>
                        </div>
                    </div> -->
                    <div class="filter_right_list edit_file">
                        <a href="<?php echo $home_url.'/employee-form?employee_id='. $employee_id; ?>">
                            <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.33337 13.6663H4.66671L13.4167 4.91627C13.8587 4.47424 14.1071 3.87472 14.1071 3.2496C14.1071 2.62448 13.8587 2.02496 13.4167 1.58293C12.9747 1.14091 12.3752 0.892578 11.75 0.892578C11.1249 0.892578 10.5254 1.14091 10.0834 1.58293L1.33337 10.3329V13.6663Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                    <div class="filter_right_list delete_file">
                        <a href="<?php echo $home_url. '/employee-list?action=delete_employee&employee_id='. $employee_id; ?>" data-toggle="modal" data-target="#delete-pop">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.33337 5.83301H16.6667" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M8.33337 9.16699V14.167" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M11.6666 9.16699V14.167" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4.16663 5.83301L4.99996 15.833C4.99996 16.275 5.17555 16.699 5.48811 17.0115C5.80068 17.3241 6.2246 17.4997 6.66663 17.4997H13.3333C13.7753 17.4997 14.1992 17.3241 14.5118 17.0115C14.8244 16.699 15 16.275 15 15.833L15.8333 5.83301" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M7.5 5.83333V3.33333C7.5 3.11232 7.5878 2.90036 7.74408 2.74408C7.90036 2.5878 8.11232 2.5 8.33333 2.5H11.6667C11.8877 2.5 12.0996 2.5878 12.2559 2.74408C12.4122 2.90036 12.5 3.11232 12.5 3.33333V5.83333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div class="emp_bottom">
                <h3>Employee details</h3>
                <div class="emp_row form_row">
                    <div class="form_col_1-3">
                        <div class="client_dtl">
                            <div class="label_title">Username</div>
                            <div class="client_dtl_parsnal">
                                <span><?php echo isset($employee_username) ? $employee_username : ''; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form_col_1-3">
                        <div class="client_dtl">
                            <div class="label_title">Name</div>
                            <div class="client_dtl_parsnal">
                                <span><?php echo isset($employee_fname) ? $employee_fname : ''; ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="form_col_1-3">
                        <div class="client_dtl">
                            <div class="label_title">Email</div>
                            <div class="client_dtl_parsnal">
                                <span><?php echo isset($employee_email) ? $employee_email : ''; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php endif; ?>
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

<?php
get_footer();