<?php 
/* Template Name: Inquire List Template */
get_header();
?>
<?php
$su_message = $_GET['success'];
$home_url = home_url();

function delete_post( $post_id, $force = false ){
	return wp_delete_post( $post_id, $force);
}

if(isset($_GET['action']) && $_GET['action'] == 'delete_inquire' && isset($_GET['inquireid'])){
	
	$inquire_id = $_GET['inquireid'];
	$deleted_post = delete_post($inquire_id);
	?>
	<script>window.location = "<?php echo $home_url; ?>/inquire-list/?success=dtrue";</script>
	<?php
}

$args = array(
    'post_type' => 'inquire',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'orderby' => 'ID',
    'order' => 'DESC',
);
$query = new WP_Query($args);
$total_post = $query->found_posts;
?>
<div class="dash_wrap dashboard-container">
   
        <div class="inquire-list">
            <div class="titel">
                <h3>Inquires List</h3>
                <span><?php echo $total_post; ?> new inquiry</span>
            </div>
            <?php
            if($su_message == 'dtrue'){
				?>
				<div class="success-message" style="color: green;">Inquires Deleted successfully.</div>
				<?php
			}
            ?>
            <div class="inquire-main">
                <div class="tab-content select_cat_description" id="myTabContent">
                    <div class="tab-pane fade show active" id="select_cat_tab_pane_1" role="tabpanel" aria-labelledby="select_cat_tab_1" tabindex="0">
                        <div class="tab-pane-wrap">
                            <table id="personal_files" class="table table-striped nowrap" style="width:100%" border="0">
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
                                                <span>Email/Phone</span>
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
                                                <span>Subject</span>
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
                                                <span>Message</span>
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
                                                <span>Reference</span>
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
                                    if ($query->have_posts()) :
                                        while ($query->have_posts()) : $query->the_post();
                                            $post_id = get_the_ID();
                                            $post_title = get_the_title();
                                            $email = get_field('email',$post_id);
                                            $subject = get_field('subject',$post_id);
                                            $message = get_field('message',$post_id);
                                            $reference = get_field('reference',$post_id);
                                            ?>
                                            <tr>
                                                <td><?php echo $post_title; ?></td>
                                                <td><?php echo $email; ?></td>
                                                <td></td>
                                                <td><?php echo $message; ?></td>
                                                <td><?php echo $reference; ?></td>
                                                <td class="button_action">
                                                    <div class="button_grp">
                                                        <div class="button_box view_box_bnt">
                                                            <a href="<?php echo $home_url; ?>/inquires-view?inquireid=<?php echo $post_id; ?>">
                                                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M10 11.6663C10.9205 11.6663 11.6667 10.9201 11.6667 9.99967C11.6667 9.0792 10.9205 8.33301 10 8.33301C9.07957 8.33301 8.33337 9.0792 8.33337 9.99967C8.33337 10.9201 9.07957 11.6663 10 11.6663Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                    <path d="M18.3333 10.0003C16.1108 13.8895 13.3333 15.8337 9.99996 15.8337C6.66663 15.8337 3.88913 13.8895 1.66663 10.0003C3.88913 6.11116 6.66663 4.16699 9.99996 4.16699C13.3333 4.16699 16.1108 6.11116 18.3333 10.0003Z" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                                </svg>
                                                            </a>
                                                        </div>
                                                        <div class="button_box delete_box_btn">
                                                            <a href="<?php echo $home_url; ?>/inquire-list?action=delete_inquire&inquireid=<?php echo $post_id; ?>">
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
                                                </td>
                                            </tr>
                                        <?php
                                        endwhile;
                                    endif;
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
get_footer();
?>
<script>
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