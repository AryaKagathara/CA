<?php 
/* Template Name: Contact US Template */
get_header();
?>
<script src="https://challenges.cloudflare.com/turnstile/v0/api.js?compat=recaptcha" async defer></script>
<?php
$su_message = $_GET['success'];
$contact_image = get_field('contact_image');
$contact_main_title = get_field('contact_main_title');
$contact_address = get_field('contact_address');
$contact_phone_number = get_field('contact_phone_number');
$contact_email = get_field('contact_email');
$contact_form_title = get_field('contact_form_title');
$home_url = home_url();

if(isset($_POST['submit'])){
    $cnname = $_POST['cnname'];
    $cnemail = $_POST['cnemail'];
    $cnphonenumber = $_POST['cnphonenumber'];
    $cnsubject = $_POST['cnsubject'];
    $cnmessage = $_POST['cnmessage'];
    $reference = $_POST['reference'];

    $my_post = array(
        'post_title' => $cnname,
        'post_content' => '',
        'post_status' => 'publish',
        'post_type' => 'inquire',
    );

    $post_idr = wp_insert_post($my_post);
    update_post_meta( $post_idr, 'email', $cnemail );
    update_post_meta( $post_idr, 'phone_number', $cnphonenumber );
    update_post_meta( $post_idr, 'subject', $cnsubject );
    update_post_meta( $post_idr, 'message', $cnmessage );
    update_post_meta( $post_idr, 'reference', $reference );
    ?>
    <script>window.location = "<?php echo $home_url; ?>/contact-us/?success=ntrue";</script>
    <?php
}

?>
	<div class="contact-page">
        <div class="contact-main flxrow">
            <?php
            if($contact_image){
                ?>
                <div class="logo">
                    <a href="<?php echo $home_url; ?>"><img src="<?php echo $contact_image; ?>" alt=""></a>
                </div>
                <?php
            }
            ?>
            <div class="contact-form flxrow">
                <div class="contact-form-left">
                    <?php
                    if($contact_main_title){
                        ?>
                        <h2><?php echo $contact_main_title; ?></h2>
                        <?php
                    }
                    ?>
                    <div class="contact-box">
                        <?php
                        if($contact_address){
                            ?>
                            <div class="contact-box-u flxrow">
                                <div class="icon"><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/location-pin.svg" alt=""></span></div>
                                <div class="contact-box-u-text">
                                    <h4> Address</h4>
                                    <a><?php echo $contact_address; ?></a>
                                </div>
                            </div>
                            <?php
                        }

                        if($contact_phone_number){
                            ?>
                            <div class="contact-box-u flxrow">
                                <div class="icon"><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/phone.svg" alt=""></span></div>
                                <div class="contact-box-u-text">
                                    <h4> Phone Number</h4>
                                    <a href="tel:<?php echo $contact_phone_number; ?>"><?php echo $contact_phone_number; ?></a>
                                </div>
                            </div>
                            <?php
                        }

                        if($contact_email){
                            ?>
                            <div class="contact-box-u flxrow">
                                <div class="icon"><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Mail.svg" alt=""></span></div>
                                <div class="contact-box-u-text">
                                    <h4> Email</h4>
                                    <a href="mailto:<?php echo $contact_email; ?>"><?php echo $contact_email; ?></a>
                                </div>
                            </div>
                            <?php
                        }
                        ?>

                    </div>
                </div>
                <div class="contact-form-right">
                    <?php
                    if($contact_form_title){
                        ?>
                        <h2><?php echo $contact_form_title; ?></h2>
                        <?php
                    }
                   
                    if($su_message == 'ntrue'){
                        ?>
                        <div class="success-message" style="color: green;">Form Submit successfully.</div>
                        <?php
                    }
                    ?>
                    <form method="POST" enctype="multipart/form-data" id="contact_forms">
                        <span class="form-row"><input type="text" name="cnname" placeholder="Name*" required /></span>
                        <span class="input-wrap flxrow">
                            <div class="form-row"><input type="email" name="cnemail" placeholder="Email" required /></div>
                            <p>or</p>
                            <div class="form-row"><input type="text" name="cnphonenumber" placeholder="Phone No" /></div>
                        </span>
                        <span class="form-row"><input type="text" name="cnsubject" placeholder="Subject*" required /></span>
                        <span class="form-row msg"><textarea name="cnmessage" placeholder="Message"></textarea></span>
                        <span class="form-row"><input type="text" name="reference" placeholder="From where did you get our reference?" /></span>
                        <div class="cf-turnstile" data-sitekey="0x4AAAAAAAJ_xPSyprcOgDcx" data-callback="javascriptCallback"></div>
                        <span class="input-btn"><input type="submit" name="submit" class="primary_btn contact_form_btn" value="Submit"></span>
                    </form>
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
	removeParamFromURL('?success');
</script>
