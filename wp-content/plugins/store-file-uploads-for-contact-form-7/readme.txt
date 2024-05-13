=== Store file uploads for Contact Form 7 ===
Contributors: mirceatm
Donate link: https://paypal.me/mirceatm
Tags: contact, form, contact form, feedback, email, ajax, store, library, file, upload, multilingual
Requires at least: 4.9
Tested up to: 5.9.2
Stable tag: 1.2.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

When this is active, attachments sent trough Contact Form 7 shortcode [file ] will be stored in your Media Library

== Description ==

By default, [Contact Form 7](https://wordpress.org/plugins/contact-form-7/) dose not keep data it sends trough it's contact forms.
While plugins like [Flamingo](https://wordpress.org/plugins/flamingo/) save that data,  uploaded files are not added to Media Library.
This plugin will save uploaded files to Media Library before email is sent by CF7.
This plugin will raise an event with the the full file path & name. 
Subscribe to `nmr_create_attachment_file_name` filter to get and/or update data before attachment is added to media library.

`
// The filter callback function.
function example_callback( $file_name ) {
    // (maybe) modify $file_name.
    return $file_name;
}
add_filter( 'nmr_create_attachment_file_name', 'example_callback', 10, 1 );
`

Subscribe to `nmr_before_insert_attachment` filter to be able to change attachment attributes:  caption and description are ‘post_excerpt’ and ‘post_content’.
For other attributes, check documentation for [wp_insert_attachment](https://developer.wordpress.org/reference/functions/wp_insert_attachment/).

`
// The filter callback function.
function before_insert_attachment_callback( $attachment ) {
    // (maybe) modify $attachment array.
    return $attachment;
}
add_filter( 'before_insert_attachment_callback', 'example_callback', 10, 1 );
`

This plugin will send the final attachment id if you are interested in getting other details, like attachment url.
Listen to `nmr_create_attachment_id_generated` action.

`
// The action callback function.
function example_callback_id_generated( $attachment_id ) {
    // (maybe) do something with the args.
    $url = wp_get_attachment_url( $attachment_id );
}
add_action( 'nmr_create_attachment_id_generated', 'example_callback_id_generated', 10, 1 );
`

= Docs & Support =

Check the [support forum](https://wordpress.org/support/plugin/store-file-uploads-for-contact-form-7/) on WordPress.org. If you can't locate any topics that pertain to your particular issue, post a new topic for it.

= Store file uploads for Contact Form 7 Needs Your Support =

It is hard to continue development and support for this free plugin without contributions from users like you. If you enjoy using -Store file uploads for Contact Form 7- and find it useful, please consider [__making a donation__](https://paypal.me/mirceatm). Your donation will help encourage and support the plugin's continued development and better user support.

= Privacy Notices =

With the default configuration, this plugin, in itself, does not:

* track users by stealth;
* write any user personal data to the database;
* send any data to external servers;
* use cookies.

It will, however store uploaded files trough Contact Form 7 in Wordpress Media Library.
Make sure your website users are aware of this fact!!!

== Installation ==

1. Upload the entire  folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the 'Plugins' menu in WordPress.

After that check Media Library for uploaded files.


== Screenshots ==

1. screenshot-1.jpg

== Changelog ==

= 1.2.2 =

Add support for changing attachment attributes using `nmr_before_insert_attachment` filter

= 1.2.1 =

* Added support for media uploads (including mp3)

= 1.2.0 =

* Added filter `nmr_create_attachment_file_name` and action `nmr_create_attachment_id_generated`

= 1.1.0 =

* Contact Form 7 `WPCF7_Submission::get_instance()->uploaded_files` changed in CF7 5.4, so adjustments in this plugin were needed.


= 1.0.0 =

* First version.
