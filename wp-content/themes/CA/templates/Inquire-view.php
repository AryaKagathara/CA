<?php 
/* Template Name: Inquire View Template */
get_header();
?>
<?php
$home_url = home_url();
$inquireid = $_GET['inquireid'];
$name = get_the_title($inquireid);
$email = get_field('email',$inquireid);
$phone_number = get_field('phone_number',$inquireid);
$subject = get_field('subject',$inquireid);
$message = get_field('message',$inquireid);
$reference = get_field('reference',$inquireid);
?>
<div class="dash_wrap dashboard-container">

	<div class="inquire-list">
		<div class="titel">
			<h3>inquiry</h3>
		</div>

		<div class="inquire-view-main">
			<div class="top_sec">
				<?php
				if($subject){
					?>
					<h3><?php echo $subject; ?></h3>
					<?php
				}
				?>
				<div class="title_box">
					<span>Subject</span>
					<h5><?php if($subject){ echo $subject; }else{ echo 'N/A'; } ?></h5>
				</div>
				<div class="title_wraper flxrow">
					<div class="title_box">
						<span>Name</span>
						<h5><?php if($name){ echo $name; }else{ echo 'N/A'; } ?></h5>
					</div>
					<div class="title_box">
						<span>Email</span>
						<h5><?php if($email){ echo $email; }else{ echo 'N/A'; } ?></h5>
					</div>
					<div class="title_box">
						<span>Phone Number</span>
						<h5><?php if($phone_number){ echo $phone_number; }else{ echo 'N/A'; } ?></h5>
					</div>
				</div>
				<div class="title_wraper flxrow">
					<div class="title_box">
						<span>Reference</span>
						<h5><?php if($reference){ echo $reference; }else{ echo 'N/A'; } ?></h5>
					</div>
				</div>
			</div>
			<div class="buttom_sec">
				<span>Message</span>
				<p><?php if($message){ echo $message; }else{ echo 'N/A'; } ?></p>
				<div class="btnbox"><a href="<?php echo $home_url; ?>/inquire-list?action=delete_inquire&inquireid=<?php echo $inquireid; ?>" class="primary_btn">Delete</a></div>
			</div>
		</div>
	</div>

</div>

<?php
get_footer();
?>