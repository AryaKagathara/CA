<?php 
/* Template Name: Login Template */
get_header(); ?>
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js?compat=recaptcha" async defer></script>
<style>
	.cf-turnstile iframe{ max-width:100%; width:420px !important; }
	.cf-turnstile{ width:420px; margin:0px -10px; }
</style>
<?php
$redirect_to = home_url();
$user_id = get_current_user_id();
$contact_link = get_field('login_button','option');
$logo = get_field('header_logo','option');
if(!$user_id){
	?>
	<div class="wrapper_main">
		<div class="login_main">
			<div class="login_wrap">
				<?php
				if($logo){
					?>
					<div class="logo">
						<a href="<?php echo $redirect_to; ?>"><img src="<?php echo $logo; ?>" alt=""></a>
					</div>
					<?php
				}
				?>
				<div class="login_form">
					<form class="needs-validation" novalidate name="loginform" id="loginform" method="post">
						<span class="form_row">
							<input class="input_text form-control username" name="username" type="text" placeholder="Username / Email" required>
							<div class="invalid-feedback">Please choose a Username / Email.</div>
						</span>
						<span class="form_row password input_container">
							<input class="input_text form-control passwordr" name="password" type="password" placeholder="Password" required>
							<span class="show_hide_pwd"></span>
							<div class="invalid-feedback">Please choose a Password.</div>
						</span>
						<br>
						<div class="cf-turnstile" data-sitekey="0x4AAAAAAAJ_xPSyprcOgDcx" data-callback="javascriptCallback"></div>
						<span class="form_row btnbox"><input class="btn primary_btn" id="login_btn" name="submit" type="button" value="Login"></span>
						<div class="login_error_message"></div>
					</form>
				</div>
			</div>
			<?php
			if(!empty($contact_link)){
				$link_title  = $contact_link['title'];
				$link_url    = $contact_link['url'];
				$link_target = $contact_link['target'];
				if ($link_title  != '') {
					?>
					<div class="contact_link">
						<a href="<?php echo $link_url == '#' ? 'javascript:void(0);' : $link_url; ?>" target="<?php echo $link_target; ?>"><?php echo $link_title; ?></a>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
	<?php
}else{
	?>
	<script>
		window.location = "<?php echo $redirect_to; ?>/dashboard/";
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
            }else{
                paswd.attr("type","password");
                jQuery(this).parent().removeClass('show_password');
            }
        });
	});
</script>