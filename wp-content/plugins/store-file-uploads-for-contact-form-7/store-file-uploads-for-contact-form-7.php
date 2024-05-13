<?php
/*
Plugin Name: Store file uploads for Contact Form 7
Plugin URI: https://namir.ro/store-file-uploads-for-contact-form-7/
Description: Store all files uploded trough Contact Form 7 in your Media Library
Author: Mircea N.
Text Domain: nmr-store-cf7-uploads
Domain Path: /languages/
Version: 1.2.2
*/

function nmr_create_attachment($filename)
{
    // Check the type of file. We'll use this as the 'post_mime_type'.
    $filetype = wp_check_filetype(basename($filename), null);

    // Get the path to the upload directory.
    $wp_upload_dir = wp_upload_dir();

    $attachFileName = $wp_upload_dir['path'] . '/' . basename($filename);
    $attachFileName = apply_filters('nmr_create_attachment_file_name', $attachFileName);
    copy($filename, $attachFileName);
    // Prepare an array of post data for the attachment.
    $attachment = array(
        'guid'           => $attachFileName,
        'post_mime_type' => $filetype['type'],
        'post_title'     => preg_replace('/\.[^.]+$/', '', basename($filename)),
        'post_content'   => '',
        'post_status'    => 'inherit'
    );
    // Notify subscribers with attachment data
    $attachment = apply_filters('nmr_before_insert_attachment', $attachment);
    // Insert the attachment.
    $attach_id = wp_insert_attachment($attachment, $attachFileName);

    // Make sure that this file is included, as wp_generate_attachment_metadata() depends on it.
    require_once(ABSPATH . 'wp-admin/includes/image.php');
    // Required for audio attachments
    require_once(ABSPATH . 'wp-admin/includes/media.php');

    // Generate the metadata for the attachment, and update the database record.
    $attach_data = wp_generate_attachment_metadata($attach_id, $attachFileName);
    wp_update_attachment_metadata($attach_id, $attach_data);
    do_action('nmr_create_attachment_id_generated', $attach_id);
    return $attach_data;
}

function nmr_on_before_cf7_send_mail(\WPCF7_ContactForm $contactForm)
{
    $submission = WPCF7_Submission::get_instance();
    if ($submission) {
        $uploaded_files = $submission->uploaded_files();
        if ($uploaded_files) {
            foreach ($uploaded_files as $fieldName => $filepath) {
                //cf7 5.4
                if (is_array($filepath)) {
                    foreach ($filepath as $key => $value) {
                        $data = nmr_create_attachment($value);
                    }
                } else {
                    $data = nmr_create_attachment($filepath);
                }
            }
        }
    }
}
// intercept contact form 7 before email send
add_action('wpcf7_before_send_mail', 'nmr_on_before_cf7_send_mail');
