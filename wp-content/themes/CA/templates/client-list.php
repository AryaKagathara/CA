<?php 
/* Template Name: Client List Template */
get_header(); 
?>
<?php
require_once (get_stylesheet_directory() . '/inc/custom_functions.php');

$su_message = $_GET['success'];

$message_delete = '';
$home_url = home_url();
$user_id = get_current_user_id();
$user_meta = get_userdata($user_id);
$user_roles = $user_meta->roles[0];
$args = array(
	'role'    => 'clients',
	'orderby' => 'user_nicename',
	'order'   => 'ASC'
);
$client_list = get_users($args);
$total_client = count($client_list);
foreach($client_list as $single_client){
	$clinet_id = $single_client->ID;
	$clinet_name = $single_client->display_name;
	$clinet_email = $single_client->user_email;
	$client_post_id = $single_client->post_id;
	$client_type = get_field('client_type',$client_post_id);
	$phone_number = get_field('phone_number',$client_post_id);
	$authorize_persons = get_field('authorize_persons',$client_post_id);
	foreach($authorize_persons as $single_person){
		$person_name = $single_person['auth_name'];
	}
	$client_status = get_field('client_status',$client_post_id);
}




function delete_user( $user_id ) {
	
	//Include the user file with the user administration API
	require_once( ABSPATH . 'wp-admin/includes/user.php' );
	
	//Delete a WordPress user by specifying its user ID. Here the user with an ID equal to $user_id is deleted.
	return wp_delete_user( $user_id );
	
}

function delete_post( $post_id, $force = false ){
	return wp_delete_post( $post_id, $force);
}

if(isset($_GET['action']) && $_GET['action'] == 'delete_client' && isset($_GET['client_id'])){
	
	$client_id = $_GET['client_id'];
	$post_id = get_user_meta( $client_id, 'post_id', true);
	save_message( 'success', __( 'Client deleted successfully.', 'genesis-block-theme' ) );
	$deleted_post = delete_post($post_id);
	$deleted_user = delete_user($client_id);
	?>
	<script>window.location = "<?php echo $home_url; ?>/client-list/?success=dtrue";</script>
	<?php
}

?>
<?php
if($user_roles == 'administrator' OR $user_roles == 'employees'){
	?>
<div class="wrapper_main">
	<div class="dash_wrap dashboard-container">
		<div class="dash_wrap_inner client-list-page">
			<div class="page-title">
				<h1><?php echo get_the_title(); ?></h1>
				<p><?php echo $total_client; ?> Clients</p>
			</div>
			<?php
			if($su_message == 'true'){
				?>
				<div class="success-message" style="color: green;">Client Updated successfully.</div>
				<?php
			}

			if($su_message == 'ntrue'){
				?>
				<div class="success-message" style="color: green;">New Client Add successfully.</div>
				<?php
			}

			if($su_message == 'dtrue'){
				?>
				<div class="success-message" style="color: green;">Client Deleted successfully.</div>
				<?php
			}
			?>
			<?php 
			if ( $messages = get_messages() ) {
				echo 'test';
				echo $messages;
			
				//clean_messages();
			}
			?>
			<div class="bottom_client_dtl">
				<div class="select_cat_description">
					<div class="tab-pane-wrap">
						<?php
						if($user_roles == 'administrator'){
							?>
							<div class="top_add_file">
								<a href="<?php echo $home_url; ?>/client-form/" class="modal_personal_file">
									Add Client
									<i>
										<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
											xmlns="http://www.w3.org/2000/svg">
											<path d="M10 4.16699V15.8337" stroke="#2C3E50" stroke-width="2"
												stroke-linecap="round" stroke-linejoin="round" />
											<path d="M4.16663 10H15.8333" stroke="#2C3E50" stroke-width="2"
												stroke-linecap="round" stroke-linejoin="round" />
										</svg>

									</i>
								</a>
							</div>
							<?php
						}
						?>

						<table id="client_list" class="table table-striped nowrap" style="width:100%" border="0">
							<thead>
								<tr>
									<th>
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
									<th>
										<div class="filter_wrap flxrow">
											<span>Contacts</span>
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
											<span>Authorized Persons</span>
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
									<th class="text-center">
										<div class="filter_wrap center flxrow">
											<span class="center">Status</span>
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
								foreach($client_list as $single_client){
									$client_id = $single_client->ID;
									$client_name = $single_client->display_name;
									$client_email = $single_client->user_email;
									$client_post_id = $single_client->post_id;
									$client_type = get_field('client_type',$client_post_id);
									$phone_number = get_field('phone_number',$client_post_id);
									$authorize_persons = get_field('authorize_persons',$client_post_id);
									foreach($authorize_persons as $single_person){
										$person_name = $single_person['auth_name'];
									}
									$client_status = get_field('client_status',$client_post_id);
									?>
									<tr>
										<td>
											<div class="client_dtls">
												<div class="client_dtls_top"><?php echo $client_name; ?></div>
												<?php
												if($client_type){
													?>
													<div class="client_dtls_bottom"><?php echo $client_type; ?></div>
													<?php
												}
												?>
											</div>
										</td>
										<td>
											<div class="client_dtls">
												<?php
												if($phone_number){
													?>
													<div class="client_dtls_top"><a href="tel:+91 <?php echo $phone_number; ?>">+91 <?php echo $phone_number; ?></a></div>
													<?php
												}
												if($client_email){
													?>
													<div class="client_dtls_bottom"><a
															href="mailto:<?php echo $client_email; ?>"><?php echo $client_email; ?></a>
													</div>
													<?php
												}
												?>
											</div>
										</td>
										<td>
											<?php 
											if($authorize_persons){ 
												?>
												<div class="client_dtls">
													<?php
													foreach($authorize_persons as $single_person){
														$person_name = $single_person['auth_name'];
														?>
														<div class="client_dtls_top"><?php echo $person_name; ?></div>
														<?php
													}
													?>
													<!-- <div class="client_dtls_bottom">Dr. S P Kagathara</div> -->
												</div>
												<?php
											}
											?>
										</td>
										<td class="text-center">
											<div class="status_main">
												<?php
												if($client_status == 'active'){
													?>
													<div class="status">
														<div class="status_color active"></div>
														<div class="status_text">Active</div>
													</div>
													<?php
												}else{
													?>
													<div class="status">
														<div class="status_color"></div>
														<div class="status_text">In-Active</div>
													</div>
													<?php
												}
												?>
											</div>
										</td>
										<td class="button_action">
											<div class="button_grp">
												<div class="button_box view_box_bnt">
													<a href="<?php echo $home_url; ?>/client-profile/?client_id=<?php echo $client_id; ?>">
														<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
															xmlns="http://www.w3.org/2000/svg">
															<path
																d="M10 11.6663C10.9205 11.6663 11.6667 10.9201 11.6667 9.99967C11.6667 9.0792 10.9205 8.33301 10 8.33301C9.07957 8.33301 8.33337 9.0792 8.33337 9.99967C8.33337 10.9201 9.07957 11.6663 10 11.6663Z"
																stroke="#A6ABBD" stroke-width="1.5"
																stroke-linecap="round" stroke-linejoin="round" />
															<path
																d="M18.3333 10.0003C16.1108 13.8895 13.3333 15.8337 9.99996 15.8337C6.66663 15.8337 3.88913 13.8895 1.66663 10.0003C3.88913 6.11116 6.66663 4.16699 9.99996 4.16699C13.3333 4.16699 16.1108 6.11116 18.3333 10.0003Z"
																stroke="#A6ABBD" stroke-width="1.5"
																stroke-linecap="round" stroke-linejoin="round" />
														</svg>
													</a>
												</div>
												<?php
												if($user_roles == 'administrator'){
													?>
													<div class="button_box edit_box_btn">
														<a href="<?php echo $home_url; ?>/client-edit?clientid=<?php echo $client_id; ?>">
															<svg width="15" height="15" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
																<path d="M1.3335 13.6668H4.66683L13.4168 4.91676C13.8589 4.47473 14.1072 3.87521 14.1072 3.25009C14.1072 2.62497 13.8589 2.02545 13.4168 1.58342C12.9748 1.1414 12.3753 0.893066 11.7502 0.893066C11.125 0.893066 10.5255 1.1414 10.0835 1.58342L1.3335 10.3334V13.6668Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
															</svg>                                                            
														</a>
													</div>
													<div class="button_box delete_box_btn">
														<a href="<?php echo $home_url. '/client-list?action=delete_client&client_id='. $client_id; ?>">
															<svg width="20" height="20" viewBox="0 0 20 20" fill="none"
																xmlns="http://www.w3.org/2000/svg">
																<path d="M3.33337 5.83301H16.6667" stroke="#A6ABBD"
																	stroke-width="1.5" stroke-linecap="round"
																	stroke-linejoin="round" />
																<path d="M8.33337 9.16699V14.167" stroke="#A6ABBD"
																	stroke-width="1.5" stroke-linecap="round"
																	stroke-linejoin="round" />
																<path d="M11.6666 9.16699V14.167" stroke="#A6ABBD"
																	stroke-width="1.5" stroke-linecap="round"
																	stroke-linejoin="round" />
																<path
																	d="M4.16663 5.83301L4.99996 15.833C4.99996 16.275 5.17555 16.699 5.48811 17.0115C5.80068 17.3241 6.2246 17.4997 6.66663 17.4997H13.3333C13.7753 17.4997 14.1992 17.3241 14.5118 17.0115C14.8244 16.699 15 16.275 15 15.833L15.8333 5.83301"
																	stroke="#A6ABBD" stroke-width="1.5"
																	stroke-linecap="round" stroke-linejoin="round" />
																<path
																	d="M7.5 5.83333V3.33333C7.5 3.11232 7.5878 2.90036 7.74408 2.74408C7.90036 2.5878 8.11232 2.5 8.33333 2.5H11.6667C11.8877 2.5 12.0996 2.5878 12.2559 2.74408C12.4122 2.90036 12.5 3.11232 12.5 3.33333V5.83333"
																	stroke="#A6ABBD" stroke-width="1.5"
																	stroke-linecap="round" stroke-linejoin="round" />
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
		window.location = "<?php echo $home_url; ?>/login/";
	</script>
	<?php
}
?>

<?php get_footer(); ?>


<script>
	jQuery(document).ready(function () {
		jQuery(".input_container .show_hide_pwd").click(function () {
			var paswd = jQuery(this).parent().find('input');
			if (paswd.attr("type") == "password") {
				paswd.attr("type", "text");
				jQuery(this).parent().addClass('show_password');
			}
			else {
				paswd.attr("type", "password");
				jQuery(this).parent().removeClass('show_password');
			}
		});

		jQuery('input[type="file"]').each(function () {
			jQuery(this).change(function (e) {
				var val = jQuery(this).val();
				var filename = val.replace(/^.*[\\\/]/, '');

				if (filename != '') {
					jQuery(this).parent().find('label').html(filename);
				} else {
					jQuery(this).parent().find('label').html('Browse file');
				}
				// setTimeout(function(){
				// jQuery(this).parent().find('label').html(filename);
				// alert(filename);
				//},1000)
			});
		});

		jQuery('.dash_filter .radio_list input[type="radio"]').each(function () {
			jQuery(this).change(function (e) {
				if (jQuery('input[id="company_form"]').is(":checked")) {
					jQuery('.dash_filter .company_dropdown').addClass('show_dropdown');
				} else {
					jQuery('.dash_filter .company_dropdown').removeClass('show_dropdown');
				}
			});
		});
	});
</script>

<script>
	jQuery(document).ready(function () {
		var table2 = jQuery('#client_list').DataTable({
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

	function removeParamFromURL(paramName) {
		const urlParams = new URLSearchParams(window.location.search);
		urlParams.delete(paramName);
		const newURL = window.location.pathname;
		history.replaceState({}, '', newURL);
	}

	// Example usage:
	// Assuming the current URL is: http://example.com/?param1=value1&param2=value2
	removeParamFromURL('success');
</script>