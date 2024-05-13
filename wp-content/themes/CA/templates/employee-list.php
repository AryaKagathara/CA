<?php 
/* Template Name: Employee List Template */
get_header();
?>


<?php
$home_url = home_url();
$args = array(
    'role' => 'employees',
    'orderby' => 'user_nicename',
	'order'   => 'ASC'
);
$employee_list = get_users($args);
$total_employee = count($employee_list);
foreach ($employee_list as $employee) {
    $employee_id = $employee->ID;
    $employee_name = $employee->display_name;
    $employee_username = $employee->user_login;
    $employee_email = $employee->user_email;
}

function delete_user( $user_id ) {

	//Include the user file with the user administration API
	require_once( ABSPATH . 'wp-admin/includes/user.php' );

	//Delete a WordPress user by specifying its user ID. Here the user with an ID equal to $user_id is deleted.
	return wp_delete_user( $user_id );

}

if(isset($_GET['action']) && $_GET['action'] == 'delete_employee' && isset($_GET['employee_id'])){
    $emp_id = $_GET['employee_id'];

    delete_user($emp_id);

    ?>
    <script>window.location = "<?php echo $home_url; ?>/employee-list";</script>
    <?php
}

$user_id = get_current_user_id();
$user_meta = get_userdata($user_id);
$user_roles = $user_meta->roles[0];
?>

<?php
if($user_roles == 'administrator'){
	?>
<div class="wrapper_main">
    <div class="dash_wrap_inner employees-list dashboard-container">
        <div class="titel_wrap flxrow">
            <div class="titel">
                <h3><?php echo get_the_title(); ?></h3>
                <span><?php echo $total_employee; ?> Employee</span>
            </div>
            <div class="title-btn">
                <a href="<?php echo $home_url; ?>/employee-form/" class="modal_personal_file">
                    Add Employee
                    <i>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 4.16699V15.8337" stroke="#2C3E50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M4.16663 10H15.8333" stroke="#2C3E50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </i>
                </a>
            </div>
        </div>

        <div class="inquire-main">
            <div class="tab-content select_cat_description" id="myTabContent">
                <div class="tab-pane fade show active" id="select_cat_tab_pane_1" role="tabpanel" aria-labelledby="select_cat_tab_1" tabindex="0">
                    <div class="tab-pane-wrap">
                        <table id="employee_list" class="table table-striped nowrap" style="width:100%" border="0">
                            <thead>
                                <tr>
                                    <th class="emp-tb-width-1">
                                        <div class="filter_wrap flxrow">
                                            <span>Name</span>
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
                                    <th class="emp-tb-width-2">
                                        <div class="filter_wrap flxrow">
                                            <span>Username</span>
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
                                            <span>Email</span>
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
                            <tbody>
                                <?php
                                foreach($employee_list as $employee){
                                    $employee_id = $employee->ID;
                                    $employee_name = $employee->display_name;
                                    $employee_username = $employee->user_login;
                                    $employee_email = $employee->user_email;
                                    ?>
                                    <tr class="odd">
                                        <td class="dtr-control" tabindex="0"><?php echo $employee_name; ?></td>
                                        <td><?php echo $employee_username; ?></td>
                                        <td><?php echo $employee_email; ?></td>
                                        <td class="button_action">
                                            <div class="button_grp">
                                                <div class="button_box view_box_bnt">
                                                    <a href="<?php echo $home_url.'/employee-detail?employee_id='. $employee_id; ?>">
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M10 11.6663C10.9205 11.6663 11.6667 10.9201 11.6667 9.99967C11.6667 9.0792 10.9205 8.33301 10 8.33301C9.07957 8.33301 8.33337 9.0792 8.33337 9.99967C8.33337 10.9201 9.07957 11.6663 10 11.6663Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M18.3333 10.0003C16.1108 13.8895 13.3333 15.8337 9.99996 15.8337C6.66663 15.8337 3.88913 13.8895 1.66663 10.0003C3.88913 6.11116 6.66663 4.16699 9.99996 4.16699C13.3333 4.16699 16.1108 6.11116 18.3333 10.0003Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="button_box view_box_bnt">
                                                    <a href="<?php echo $home_url.'/employee-form?employee_id='. $employee_id; ?>">
                                                        <svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M1.3335 13.6668H4.66683L13.4168 4.91676C13.8589 4.47473 14.1072 3.87521 14.1072 3.25009C14.1072 2.62497 13.8589 2.02545 13.4168 1.58342C12.9748 1.1414 12.3753 0.893066 11.7502 0.893066C11.125 0.893066 10.5255 1.1414 10.0835 1.58342L1.3335 10.3334V13.6668Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </a>
                                                </div>
                                                <div class="button_box delete_box_btn">
                                                    <a href="<?php echo $home_url. '/employee-list?action=delete_employee&employee_id='. $employee_id; ?>">
                                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M3.33337 5.83301H16.6667" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M8.33337 9.16699V14.167" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M11.6666 9.16699V14.167" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M4.16663 5.83301L4.99996 15.833C4.99996 16.275 5.17555 16.699 5.48811 17.0115C5.80068 17.3241 6.2246 17.4997 6.66663 17.4997H13.3333C13.7753 17.4997 14.1992 17.3241 14.5118 17.0115C14.8244 16.699 15 16.275 15 15.833L15.8333 5.83301" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path d="M7.5 5.83333V3.33333C7.5 3.11232 7.5878 2.90036 7.74408 2.74408C7.90036 2.5878 8.11232 2.5 8.33333 2.5H11.6667C11.8877 2.5 12.0996 2.5878 12.2559 2.74408C12.4122 2.90036 12.5 3.11232 12.5 3.33333V5.83333" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg> 
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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

<script>
	jQuery(document).ready(function () {
		var table2 = jQuery('#employee_list').DataTable({
			"pagingType": "numbers",
			displayLength: 10,
			language: {
				paginate: {
					next: '', // or '→'
					previous: '' // or '←' 
				}
			},
			responsive: true,
			"dom": '<"bottom"f>rt<"bottom_datatable"lp><"clear">',
			language: {
				searchPlaceholder: "Search here...",
				search: ""
			},
		});

	});
</script>

<?php 
get_footer();