<?php

define('THEME_URI', get_stylesheet_directory_uri() . '/');
add_filter('use_block_editor_for_post', '__return_false', 10);

// add_theme_support('title-tag');
// // add_theme_support('menus');

function project_scripts()
{
	wp_enqueue_style('w3n-bootstrap', THEME_URI . 'css/bootstrap.min.css');
	wp_enqueue_style('w3n-fonts', THEME_URI . 'fonts/fonts.css');
	wp_enqueue_style('w3n-nice-select', THEME_URI . 'css/nice-select.css');
	wp_enqueue_style('w3n-jquery-ui.min', THEME_URI . 'css/jquery-ui.min.css');
	wp_enqueue_style('w3n-jquery.mCustomScrollbar',THEME_URI . 'css/jquery.mCustomScrollbar.css');
	wp_enqueue_style('w3n-jquery.datetimepicker', THEME_URI . 'css/jquery.datetimepicker.css');
	wp_enqueue_style('w3n-style', THEME_URI . 'css/style.css');
	wp_enqueue_style('w3n-style-v3', THEME_URI . 'css/style-v3.css');
	wp_enqueue_style('w3n-style-v2', THEME_URI . 'css/style-v2.css');
	wp_enqueue_style('w3n-responsive', THEME_URI . 'css/responsive.css');

	wp_enqueue_script('w3n-jquery-3.6.1.min', THEME_URI . 'js/jquery-3.6.1.min.js', array('jquery'), true);
	wp_enqueue_script('w3n-new-add', THEME_URI . 'js/new-add.js', array('jquery'), true);
	//wp_enqueue_script('w3n-jquery-3.3.1.min', THEME_URI . 'js/jquery-3.3.1.min.js', array('jquery'), true);
	wp_enqueue_script('w3n-bootstrap', THEME_URI . 'js/bootstrap.min.js', array('jquery'), true);
	wp_enqueue_script('w3n-nice-select', THEME_URI . 'js/jquery.nice-select.js', array('jquery'), true);
	wp_enqueue_script('w3n-popper', THEME_URI . 'js/popper.min.js', array('jquery'), true);
	wp_enqueue_script('w3n-jquery-ui.min', THEME_URI . 'js/jquery-ui.min.js', array('jquery'), true);
	wp_enqueue_script('w3n-mCustomScrollbar-concat', THEME_URI . 'js/jquery.mCustomScrollbar.concat.min.js', array('jquery'), true);
	wp_enqueue_script('w3n-dataTables.responsive.min', THEME_URI . 'js/dataTables.responsive.min.js', array('jquery'), true);
	wp_enqueue_script('w3n-jquery.dataTables.min', THEME_URI . 'js/jquery.dataTables.min.js', array('jquery'), true);
	wp_enqueue_script('w3n-developer-chart', THEME_URI . 'js/developer-chart.js', array('jquery'), true);
	wp_enqueue_script('w3n-jquery.datetimepicker', THEME_URI . 'js/jquery.datetimepicker.full.min.js', array('jquery'), true);
	wp_enqueue_script('w3n-jquery.ui.touch-punch', THEME_URI . 'js/jquery.ui.touch-punch.min.js', array('jquery'), true);
	wp_enqueue_script('w3n-responsive.bootstrap.min', THEME_URI . 'js/responsive.bootstrap.min.js', array('jquery'),  true);
	wp_enqueue_script('w3n-charts', 'https://cdn.jsdelivr.net/npm/chart.js', array('jquery'), true);
	wp_enqueue_script('w3n-script', THEME_URI . 'js/script.js', array('jquery'), true);

	wp_enqueue_script( 'ajax-script-check', THEME_URI . 'js/ajax-script.js', array( 'jquery' ), '1.0.0', true );
	wp_localize_script( 'ajax-script-check', 'ca_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' )));
}
add_action('wp_enqueue_scripts', 'project_scripts', 20);

if (function_exists('acf_add_options_page')) {
	acf_add_options_page(array(
		'page_title'     => 'Theme General Settings',
		'menu_title'    => 'Theme Settings',
		'menu_slug'     => 'theme-general-settings',
		'capability'    => 'edit_posts',
		'redirect'        => false
	));
	acf_add_options_sub_page(array(
		'page_title'    => 'Header',
		'menu_title'    => 'Header',
		'parent_slug'   => 'theme-general-settings',
	));
	acf_add_options_sub_page(array(
		'page_title'    => 'Footer',
		'menu_title'    => 'Footer',
		'parent_slug'   => 'theme-general-settings',
	));
}



// add_filter('gform_submit_button', 'form_submit_buttons', 10, 2);
// function form_submit_buttons($button, $form)
// {
// 	if ($form['id'] == 1) {
// 		return "<button class='button gform_buttons globle_btn' id='gform_submit_button_1'><span>Submit</span><i></i></button>";
// 	}
// 	return $button;
// }
// function custom_gravity_form_upload_field($content, $field, $value, $lead_id, $form_id)
// {
// 	// Check if the field is of type 'fileupload'
// 	if ($field->type === 'fileupload') {
// 		// Modify the field content structure
// 		$content = '<div class="custom-upload-container">' . $content . '</div>';
// 	}
// 	return $content;
// }
// add_filter('gform_field_content', 'custom_gravity_form_upload_field', 10, 5);


/****** Team Members post type Start ******/
function wpdocs_codex_team_members_init()
{
	$labels = array(
		'name'                  => _x('Client Details', 'Post type general name', 'ca'),
		'singular_name'         => _x('Client Detail', 'Post type singular name', 'ca'),
		'menu_name'             => _x('Client Details', 'Admin Menu text', 'ca'),
		'name_admin_bar'        => _x('Client Detail', 'Add New on Toolbar', 'ca'),
		'add_new'               => __('Add New', 'ca'),
		'add_new_item'          => __('Add New Client Detail', 'ca'),
		'new_item'              => __('New Client Detail', 'ca'),
		'edit_item'             => __('Edit Client Detail', 'ca'),
		'view_item'             => __('View Client Detail', 'ca'),
		'all_items'             => __('All Client Detail', 'ca'),
		'search_items'          => __('Search Client Details', 'ca'),
		'parent_item_colon'     => __('Parent Client Details:', 'ca'),
		'not_found'             => __('No Client Details found.', 'ca'),
		'not_found_in_trash'    => __('No Client Details found in Trash.', 'ca'),
		'featured_image'        => _x('Client Detail Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'ca'),
		'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'ca'),
		'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'ca'),
		'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'ca'),
		'archives'              => _x('Client Detail archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'ca'),
		'insert_into_item'      => _x('Insert into Client Detail', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'ca'),
		'uploaded_to_this_item' => _x('Uploaded to this Client Detail', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'ca'),
		'filter_items_list'     => _x('Filter Client Details list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'ca'),
		'items_list_navigation' => _x('Client Details list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'ca'),
		'items_list'            => _x('Client Details list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'ca'),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'client-detail'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'      => 'dashicons-calendar',
		'supports'           => array('title', 'author'),
		'show_in_graphql'       => true,
		'graphql_single_name'   => 'Client Detail',
		'graphql_plural_name'   => 'Client Details',
	);
	register_post_type('client-detail', $args);
}
add_action('init', 'wpdocs_codex_team_members_init');
/****** Team Members post type End ******/



/****** Register Job post type Start ******/
function wpdocs_codex_job_init()
{
	$postIndustryLabels = array(
		'name'              => _x('Category', 'taxonomy general name', 'textdomain'),
		'singular_name'     => _x('Category', 'taxonomy singular name', 'textdomain'),
		'search_items'      => __('Search Category', 'textdomain'),
		'all_items'         => __('All Category', 'textdomain'),
		'view_item'         => __('View Category', 'textdomain'),
		'parent_item'       => __('Parent Category', 'textdomain'),
		'parent_item_colon' => __('Parent Category:', 'textdomain'),
		'edit_item'         => __('Edit Category', 'textdomain'),
		'update_item'       => __('Update Category', 'textdomain'),
		'add_new_item'      => __('Add New Category', 'textdomain'),
		'new_item_name'     => __('New Category Name', 'textdomain'),
		'not_found'         => __('No Category Found', 'textdomain'),
		'back_to_items'     => __('Back to Categorys', 'textdomain'),
		'menu_name'         => __('Category', 'textdomain'),
	);
	$args = array(
		'labels'            => $postIndustryLabels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'client-category'),
		'show_in_rest'      => true,
	);
	register_taxonomy('client-category', 'client-detail', $args);

	

	$labels = array(
		'name'                  => _x('Jobs', 'Post type general name', 'multia'),
		'singular_name'         => _x('Job', 'Post type singular name', 'multia'),
		'menu_name'             => _x('Jobs', 'Admin Menu text', 'multia'),
		'name_admin_bar'        => _x('Job', 'Add New on Toolbar', 'multia'),
		'add_new'               => __('Add New', 'multia'),
		'add_new_item'          => __('Add New Job', 'multia'),
		'new_item'              => __('New Job', 'multia'),
		'edit_item'             => __('Edit Job', 'multia'),
		'view_item'             => __('View Job', 'multia'),
		'all_items'             => __('All Jobs', 'multia'),
		'search_items'          => __('Search Jobs', 'multia'),
		'parent_item_colon'     => __('Parent Jobs:', 'multia'),
		'not_found'             => __('No Jobs found.', 'multia'),
		'not_found_in_trash'    => __('No Jobs found in Trash.', 'multia'),
		'featured_image'        => _x('Job Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'multia'),
		'set_featured_image'    => _x('Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'multia'),
		'remove_featured_image' => _x('Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'multia'),
		'use_featured_image'    => _x('Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'multia'),
		'archives'              => _x('Job archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'multia'),
		'insert_into_item'      => _x('Insert into Job', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'multia'),
		'uploaded_to_this_item' => _x('Uploaded to this Job', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'multia'),
		'filter_items_list'     => _x('Filter Jobs list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'multia'),
		'items_list_navigation' => _x('Jobs list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'multia'),
		'items_list'            => _x('Jobs list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'multia'),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'job'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'      => 'dashicons-calendar',
		'supports'           => array('title', 'author','editor', 'excerpt', 'comments','custom-fields'),
		'show_in_graphql'       => true,
		'graphql_single_name'   => 'job',
		'graphql_plural_name'   => 'jobs',
	);
	register_post_type('jobs', $args);

	$jobIndustriesLabels = array(
		'name'              => _x('Citizenships', 'taxonomy general name', 'textdomain'),
		'singular_name'     => _x('Citizenship', 'taxonomy singular name', 'textdomain'),
		'search_items'      => __('Search Citizenships', 'textdomain'),
		'all_items'         => __('All Citizenships', 'textdomain'),
		'view_item'         => __('View Citizenship', 'textdomain'),
		'parent_item'       => __('Parent Citizenship', 'textdomain'),
		'parent_item_colon' => __('Parent Citizenship:', 'textdomain'),
		'edit_item'         => __('Edit Citizenship', 'textdomain'),
		'update_item'       => __('Update Citizenship', 'textdomain'),
		'add_new_item'      => __('Add New Citizenship', 'textdomain'),
		'new_item_name'     => __('New Citizenship Name', 'textdomain'),
		'not_found'         => __('No Citizenships Found', 'textdomain'),
		'back_to_items'     => __('Back to Citizenships', 'textdomain'),
		'menu_name'         => __('Citizenships', 'textdomain'),
	);
	$args = array(
		'labels'            => $jobIndustriesLabels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'job-citizenship'),
		'show_in_rest'      => true,
	);
	register_taxonomy('job-citizenship', 'jobs', $args);

	$jobTypeLabels = array(
		'name'              => _x('Types', 'taxonomy general name', 'textdomain'),
		'singular_name'     => _x('Type', 'taxonomy singular name', 'textdomain'),
		'search_items'      => __('Search Types', 'textdomain'),
		'all_items'         => __('All Types', 'textdomain'),
		'view_item'         => __('View Type', 'textdomain'),
		'parent_item'       => __('Parent Type', 'textdomain'),
		'parent_item_colon' => __('Parent Type:', 'textdomain'),
		'edit_item'         => __('Edit Type', 'textdomain'),
		'update_item'       => __('Update Type', 'textdomain'),
		'add_new_item'      => __('Add New Type', 'textdomain'),
		'new_item_name'     => __('New Type Name', 'textdomain'),
		'not_found'         => __('No Types Found', 'textdomain'),
		'back_to_items'     => __('Back to Types', 'textdomain'),
		'menu_name'         => __('Types', 'textdomain'),
	);
	$args = array(
		'labels'            => $jobTypeLabels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'job-type'),
		'show_in_rest'      => true,
	);
	register_taxonomy('job-types', 'jobs', $args);

}
add_action('init', 'wpdocs_codex_job_init');
/****** Register Job post type End   ******/

/******  Register Announcements Post type START  ******/
function announcements_post_type_init(){
	$labels = array(
		'name'                  => _x('Announcements', 'Post type general name', 'ca'),
		'singular_name'         => _x('Announcement', 'Post type singular name', 'ca'),
		'menu_name'             => _x('Announcements', 'Admin Menu text', 'ca'),
		'name_admin_bar'        => _x('Announcement', 'Add New on Toolbar', 'ca'),
		'add_new'               => __('Add New', 'ca'),
		'add_new_item'          => __('Add New Announcement', 'ca'),
		'new_item'              => __('New Announcement', 'ca'),
		'edit_item'             => __('Edit Announcement', 'ca'),
		'view_item'             => __('View Announcement', 'ca'),
		'all_items'             => __('All Announcements', 'ca'),
		'search_items'          => __('Search Announcements', 'ca'),
		'parent_item_colon'     => __('Parent Announcements:', 'ca'),
		'not_found'             => __('No Announcements found.', 'ca'),
		'not_found_in_trash'    => __('No Announcements found in Trash.', 'ca'),
		'featured_image'        => _x('Announcement Cover Image', 'Overrides the "Featured Image" phrase for this post type. Added in 4.3', 'ca'),
		'set_featured_image'    => _x('Set cover image', 'Overrides the "Set featured image" phrase for this post type. Added in 4.3', 'ca'),
		'remove_featured_image' => _x('Remove cover image', 'Overrides the "Remove featured image" phrase for this post type. Added in 4.3', 'ca'),
		'use_featured_image'    => _x('Use as cover image', 'Overrides the "Use as featured image" phrase for this post type. Added in 4.3', 'ca'),
		'archives'              => _x('Announcement archives', 'The post type archive label used in nav menus. Default "Post Archives". Added in 4.4', 'ca'),
		'insert_into_item'      => _x('Insert into Announcements', 'Overrides the "Insert into post" phrase (used when inserting media into a post). Added in 4.4', 'ca'),
		'uploaded_to_this_item' => _x('Uploaded to this Announcement', 'Overrides the "Uploaded to this post" phrase (used when viewing media attached to a post). Added in 4.4', 'ca'),
		'filter_items_list'     => _x('Filter Announcements list', 'Screen reader text for the filter links heading on the post type listing screen. Default "Filter posts list". Added in 4.4', 'ca'),
		'items_list_navigation' => _x('Announcements list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default "Posts list navigation". Added in 4.4', 'ca'),
		'items_list'            => _x('Announcements list', 'Screen reader text for the items list heading on the post type listing screen. Default "Posts list". Added in 4.4', 'ca'),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'announcement'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'      => 'dashicons-megaphone',
		'supports'           => array('title', 'author','editor', 'excerpt', 'comments','custom-fields'),
	);
	register_post_type('announcements', $args);
}
add_action('init', 'announcements_post_type_init');

// Set Posts per page
//Filter announcements post by order
function set_posts_per_page_for_announcement_cpt( $query ) {
	if ( !is_admin() && is_page('announcement-detail') ) {

		$orderby = isset($_GET['order_by']) ? $_GET['order_by'] : '';
		$pages = isset($_GET['pages']) ? $_GET['pages'] : '';
		
		
		if($orderby == 'asc'){
			$query->set('orderby', 'date');
			$query->set('order', 'asc');
		}elseif($orderby == 'desc'){
			$query->set('orderby', 'date');
			$query->set('order', 'DESC');
		}
		if($pages){
			$query->set('paged', $pages);
		}
	}
	return $query;
}
add_action( 'pre_get_posts', 'set_posts_per_page_for_announcement_cpt' );


// Pagination
function my_paginate_links( $args = '', $main_query = array() ) {
	global $wp_query, $wp_rewrite;
	
	if(!empty($main_query)){
		$wp_query = $main_query;
	}
 
    // Setting up default values based on the current URL.
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $url_parts    = explode( '?', $pagenum_link );
 
    // Get max pages and current page out of the current query, if available.
    $total   = isset( $wp_query->max_num_pages ) ? $wp_query->max_num_pages : 1;
    $current = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
 
    // Append the format placeholder to the base URL.
    $pagenum_link = trailingslashit( $url_parts[0] ) . '%_%';
 
    // URL base depends on permalink settings.
    $format  = $wp_rewrite->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $wp_rewrite->using_permalinks() ? user_trailingslashit( $wp_rewrite->pagination_base . '/%#%', 'paged' ) : '?paged=%#%';
 
    $defaults = array(
        'base'               => $pagenum_link, // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
        'format'             => $format, // ?page=%#% : %#% is replaced by the page number
        'total'              => $total,
        'current'            => $current,
        'aria_current'       => 'page',
        'show_all'           => false,
        'prev_next'          => true,
        'prev_text'          => __( '&laquo; Previous' ),
        'next_text'          => __( 'Next &raquo;' ),
        'end_size'           => 1,
        'mid_size'           => 2,
        'type'               => 'plain',
        'add_args'           => array(), // array of query args to add
        'add_fragment'       => '',
        'before_page_number' => '',
        'after_page_number'  => '',
    );
 
    $args = wp_parse_args( $args, $defaults );
 
    if ( ! is_array( $args['add_args'] ) ) {
        $args['add_args'] = array();
    }
 
    // Merge additional query vars found in the original URL into 'add_args' array.
    if ( isset( $url_parts[1] ) ) {
        // Find the format argument.
        $format       = explode( '?', str_replace( '%_%', $args['format'], $args['base'] ) );
        $format_query = isset( $format[1] ) ? $format[1] : '';
        wp_parse_str( $format_query, $format_args );
 
        // Find the query args of the requested URL.
        wp_parse_str( $url_parts[1], $url_query_args );
 
        // Remove the format argument from the array of query arguments, to avoid overwriting custom format.
        foreach ( $format_args as $format_arg => $format_arg_value ) {
            unset( $url_query_args[ $format_arg ] );
        }
 
        $args['add_args'] = array_merge( $args['add_args'], urlencode_deep( $url_query_args ) );
    }
 
    // Who knows what else people pass in $args
    $total = (int) $args['total'];
    if ( $total < 2 ) {
        return;
    }
    $current  = (int) $args['current'];
    $end_size = (int) $args['end_size']; // Out of bounds?  Make it the default.
    if ( $end_size < 1 ) {
        $end_size = 1;
    }
    $mid_size = (int) $args['mid_size'];
    if ( $mid_size < 0 ) {
        $mid_size = 2;
    }
    $add_args   = $args['add_args'];
    $r          = '';
    $page_links = array();
    $dots       = false;
 
    if ( $args['prev_next'] && $current && 1 < $current ) :
        $link = str_replace( '%_%', 2 == $current ? '' : $args['format'], $args['base'] );
        $link = str_replace( '%#%', $current - 1, $link );
        if ( $add_args ) {
            $link = add_query_arg( $add_args, $link );
        }
        $link .= $args['add_fragment'];
 
        /**
         * Filters the paginated links for the given archive pages.
         *
         * @since 3.0.0
         *
         * @param string $link The paginated link URL.
         */
        $page_links[] = '<a class="prev page-numbers" data-page='. number_format_i18n( $current - 1 ) .' href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $args['prev_text'] . '</a>';
    endif;
    for ( $n = 1; $n <= $total; $n++ ) :
        if ( $n == $current ) :
            $page_links[] = "<span aria-current='" . esc_attr( $args['aria_current'] ) . "' data-page=". number_format_i18n( $n ) ." class='page-numbers current'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . '</span>';
            $dots         = true;
        else :
            if ( $args['show_all'] || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
                $link = str_replace( '%_%', 1 == $n ? '' : $args['format'], $args['base'] );
                $link = str_replace( '%#%', $n, $link );
                if ( $add_args ) {
                    $link = add_query_arg( $add_args, $link );
                }
                $link .= $args['add_fragment'];
 
                /** This filter is documented in wp-includes/general-template.php */
                $page_links[] = "<a class='page-numbers' data-page=". number_format_i18n( $n ) ." href='" . esc_url( apply_filters( 'paginate_links', $link ) ) . "'>" . $args['before_page_number'] . number_format_i18n( $n ) . $args['after_page_number'] . '</a>';
                $dots         = true;
            elseif ( $dots && ! $args['show_all'] ) :
                $page_links[] = '<span class="page-numbers dots">' . __( '&hellip;' ) . '</span>';
                $dots         = false;
            endif;
        endif;
    endfor;
    if ( $args['prev_next'] && $current && $current < $total ) :
        $link = str_replace( '%_%', $args['format'], $args['base'] );
        $link = str_replace( '%#%', $current + 1, $link );
        if ( $add_args ) {
            $link = add_query_arg( $add_args, $link );
        }
        $link .= $args['add_fragment'];
 
        /** This filter is documented in wp-includes/general-template.php */
        $page_links[] = '<a class="next page-numbers" data-page="'. number_format_i18n( $current + 1 ) .'" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $args['next_text'] . '</a>';
    endif;
    switch ( $args['type'] ) {
        case 'array':
            return $page_links;
 
        case 'list':
            $r .= "<ul class='page-numbers'>\n\t<li>";
            $r .= join( "</li>\n\t<li>", $page_links );
            $r .= "</li>\n</ul>\n";
            break;
 
        default:
            $r = join( "\n", $page_links );
            break;
    }
    return $r;
}


/******  Register Announcements Post type END  ******/

/******  Register Task Post type START  ******/

function tasks_post_type_init(){
	$labels = array(
		'name'                  => _x('Tasks', 'Post type general name', 'ca'),
		'singular_name'         => _x('Task', 'Post type singular name', 'ca'),
		'menu_name'             => _x('Tasks', 'Admin Menu text', 'ca'),
		'name_admin_bar'        => _x('Task', 'Add New on Toolbar', 'ca'),
		'add_new'               => __('Add New', 'ca'),
		'add_new_item'          => __('Add New Task', 'ca'),
		'new_item'              => __('New Task', 'ca'),
		'edit_item'             => __('Edit Task', 'ca'),
		'view_item'             => __('View Task', 'ca'),
		'all_items'             => __('All Tasks', 'ca'),
		'search_items'          => __('Search Tasks', 'ca'),
		'parent_item_colon'     => __('Parent Tasks:', 'ca'),
		'not_found'             => __('No Tasks found.', 'ca'),
		'not_found_in_trash'    => __('No Tasks found in Trash.', 'ca'),
		'featured_image'        => _x('Task Cover Image', 'Overrides the "Featured Image" phrase for this post type. Added in 4.3', 'ca'),
		'set_featured_image'    => _x('Set cover image', 'Overrides the "Set featured image" phrase for this post type. Added in 4.3', 'ca'),
		'remove_featured_image' => _x('Remove cover image', 'Overrides the "Remove featured image" phrase for this post type. Added in 4.3', 'ca'),
		'use_featured_image'    => _x('Use as cover image', 'Overrides the "Use as featured image" phrase for this post type. Added in 4.3', 'ca'),
		'archives'              => _x('Task archives', 'The post type archive label used in nav menus. Default "Post Archives". Added in 4.4', 'ca'),
		'insert_into_item'      => _x('Insert into Tasks', 'Overrides the "Insert into post" phrase (used when inserting media into a post). Added in 4.4', 'ca'),
		'uploaded_to_this_item' => _x('Uploaded to this Task', 'Overrides the "Uploaded to this post" phrase (used when viewing media attached to a post). Added in 4.4', 'ca'),
		'filter_items_list'     => _x('Filter Tasks list', 'Screen reader text for the filter links heading on the post type listing screen. Default "Filter posts list". Added in 4.4', 'ca'),
		'items_list_navigation' => _x('Tasks list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default "Posts list navigation". Added in 4.4', 'ca'),
		'items_list'            => _x('Tasks list', 'Screen reader text for the items list heading on the post type listing screen. Default "Posts list". Added in 4.4', 'ca'),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'task'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'      => 'dashicons-megaphone',
		'supports'           => array('title', 'author','editor', 'excerpt', 'custom-fields'),
	);
	register_post_type('tasks', $args);
	
	$labels = array(
		'name'                  => _x('Inquires', 'Post type general name', 'ca'),
		'singular_name'         => _x('Inquire', 'Post type singular name', 'ca'),
		'menu_name'             => _x('Inquires', 'Admin Menu text', 'ca'),
		'name_admin_bar'        => _x('Inquire', 'Add New on Toolbar', 'ca'),
		'add_new'               => __('Add New', 'ca'),
		'add_new_item'          => __('Add New Inquire', 'ca'),
		'new_item'              => __('New Inquire', 'ca'),
		'edit_item'             => __('Edit Inquire', 'ca'),
		'view_item'             => __('View Inquire', 'ca'),
		'all_items'             => __('All Inquires', 'ca'),
		'search_items'          => __('Search Inquires', 'ca'),
		'parent_item_colon'     => __('Parent Inquires:', 'ca'),
		'not_found'             => __('No Inquires found.', 'ca'),
		'not_found_in_trash'    => __('No Inquires found in Trash.', 'ca'),
		'featured_image'        => _x('Inquire Cover Image', 'Overrides the "Featured Image" phrase for this post type. Added in 4.3', 'ca'),
		'set_featured_image'    => _x('Set cover image', 'Overrides the "Set featured image" phrase for this post type. Added in 4.3', 'ca'),
		'remove_featured_image' => _x('Remove cover image', 'Overrides the "Remove featured image" phrase for this post type. Added in 4.3', 'ca'),
		'use_featured_image'    => _x('Use as cover image', 'Overrides the "Use as featured image" phrase for this post type. Added in 4.3', 'ca'),
		'archives'              => _x('Inquire archives', 'The post type archive label used in nav menus. Default "Post Archives". Added in 4.4', 'ca'),
		'insert_into_item'      => _x('Insert into Inquires', 'Overrides the "Insert into post" phrase (used when inserting media into a post). Added in 4.4', 'ca'),
		'uploaded_to_this_item' => _x('Uploaded to this Inquire', 'Overrides the "Uploaded to this post" phrase (used when viewing media attached to a post). Added in 4.4', 'ca'),
		'filter_items_list'     => _x('Filter Inquires list', 'Screen reader text for the filter links heading on the post type listing screen. Default "Filter posts list". Added in 4.4', 'ca'),
		'items_list_navigation' => _x('Inquires list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default "Posts list navigation". Added in 4.4', 'ca'),
		'items_list'            => _x('Inquires list', 'Screen reader text for the items list heading on the post type listing screen. Default "Posts list". Added in 4.4', 'ca'),
	);
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => true,
		'show_ui'            => true,
		'show_in_menu'       => true,
		'query_var'          => true,
		'rewrite'            => array('slug' => 'inquire'),
		'capability_type'    => 'post',
		'has_archive'        => true,
		'hierarchical'       => false,
		'menu_position'      => null,
		'menu_icon'      => 'dashicons-megaphone',
		'supports'           => array('title', 'custom-fields'),
	);
	register_post_type('inquire', $args);

	// Task Status Taxonomy
	$taskLabels = array(
		'name'              => _x('Task Status', 'taxonomy general name', 'ca'),
		'singular_name'     => _x('Task Status', 'taxonomy singular name', 'ca'),
		'search_items'      => __('Search Status', 'ca'),
		'all_items'         => __('All Status', 'ca'),
		'view_item'         => __('View Status', 'ca'),
		'parent_item'       => __('Parent Status', 'ca'),
		'parent_item_colon' => __('Parent Status:', 'ca'),
		'edit_item'         => __('Edit Status', 'ca'),
		'update_item'       => __('Update Status', 'ca'),
		'add_new_item'      => __('Add New Status', 'ca'),
		'new_item_name'     => __('New Status Name', 'ca'),
		'not_found'         => __('No Status Found', 'ca'),
		'back_to_items'     => __('Back to Status', 'ca'),
		'menu_name'         => __('Status', 'ca'),
	);
	$args = array(
		'labels'            => $taskLabels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array('slug' => 'task-status'),
		'show_in_rest'      => true,
	);
	register_taxonomy('task-status', 'tasks', $args);

	$labels = array(
		'name' => _x( 'Tags', 'taxonomy general name' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Tags' ),
		'popular_items' => __( 'Popular Tags' ),
		'all_items' => __( 'All Tags' ),
		'parent_item' => null,
		'parent_item_colon' => null,
		'edit_item' => __( 'Edit Tag' ), 
		'update_item' => __( 'Update Tag' ),
		'add_new_item' => __( 'Add New Tag' ),
		'new_item_name' => __( 'New Tag Name' ),
		'separate_items_with_commas' => __( 'Separate tags with commas' ),
		'add_or_remove_items' => __( 'Add or remove tags' ),
		'choose_from_most_used' => __( 'Choose from the most used tags' ),
		'menu_name' => __( 'Tags' ),
	  ); 
	
	  register_taxonomy('task-tag','tasks',array(
		'hierarchical' => false,
		'labels' => $labels,
		'show_ui' => true,
		'update_count_callback' => '_update_post_term_count',
		'query_var' => true,
		'rewrite' => array( 'slug' => 'task-tag' ),
		'show_in_rest'      => true,
	  ));
}
add_action('init', 'tasks_post_type_init');

/******  Register Task Post type END  ******/


add_action( 'transition_post_status', 'a_new_post', 100, 3 );

function a_new_post( $new_status, $old_status, $post )
{
	global $wp;
	$post_id = $post->ID;
	$post_name = $post->post_type;
	$currentDate = date('Ymd');
	
	if($post_name == 'jobs'){
		if($old_status == 'draft' AND $new_status == 'publish'){
			wp_update_post($post);
			update_post_meta($post_id, 'active_date', $currentDate);
			$current_url = home_url(add_query_arg(array(),$wp->request));
			wp_redirect($current_url);
		}
	}

}


add_action('admin_head', 'my_custom_fonts');
function my_custom_fonts() {
  echo '<style>
    .active_date_admin{
        display:none;
    }
	.user_id_hidden{ display:none; }
	.post-type-inquire .table-view-list .column-date{ display:none; }
	.post-type-inquire .table-view-list .author-other .column-title .row-actions .edit{ display:none; }
	.post-type-inquire .table-view-list .author-other .column-title .row-actions .hide-if-no-js{ display:none; }
  </style>';
}


add_filter('manage_inquire_posts_columns', 'hs_inquire_table_head');
function hs_inquire_table_head( $columns ) {

    $columns['title']  = 'Name';
	$columns['email']  = 'Email';
	$columns['subject']  = 'Subject';
	$columns['message']  = 'Message';
	$columns['reference']  = 'Reference';
 	return $columns;

}

add_action( 'manage_inquire_posts_custom_column', 'hs_inquire_table_content', 10, 2);
function hs_inquire_table_content( $column_name, $post_id ) {

	if( $column_name == 'title' ) {
		$coach_name = get_the_title($post_id);
        echo $coach_name;
    }

	if( $column_name == 'email' ) {
		$coach_email = get_post_meta( $post_id, 'email', true );
        echo $coach_email;
    }

	if( $column_name == 'subject' ) {
		$coach_subject = get_post_meta( $post_id, 'subject', true );
        echo $coach_subject;
    }

	if( $column_name == 'message' ) {
		$coach_message = get_post_meta( $post_id, 'message', true );
        echo $coach_message;
    }

	if( $column_name == 'reference' ) {
		$coach_refrence = get_post_meta( $post_id, 'reference', true );
        echo $coach_refrence;
    }
	// if( $column_name == 'cell_number' ) {
	// 	$coach_number = get_post_meta( $post_id, 'cell_number', true );
    //     echo $coach_number;
    // }
	// if( $column_name == 'transaction_type' ) {
	// 	$coach_trtype = get_post_meta( $post_id, 'transaction_type', true );
    //     echo $coach_trtype;
    // }
	// if( $column_name == 'property_located' ) {
	// 	$coach_located = get_post_meta( $post_id, 'property_located', true );
    //     echo $coach_located;
    // }

}


add_role('clients', 'Clients', array(
	'read' => true,
	'create_posts' => false,
	'edit_posts' => false,
	'edit_others_posts' => false,
	'publish_posts' => false,
	'manage_categories' => false,
));

add_role('employees', 'Employees', array(
	'read' => true,
	'create_posts' => false,
	'edit_posts' => false,
	'edit_others_posts' => false,
	'publish_posts' => false,
	'manage_categories' => false,
));


add_action('wp_ajax_login_forms', 'login_forms');
add_action('wp_ajax_nopriv_login_forms', 'login_forms');
function login_forms(){
	$username = $_POST['username'];
	$password = $_POST['password'];
	if($username != '' OR $password != ''){
		$login_data = array();
		$login_data['user_login'] = $username;
		$login_data['user_password'] = $password;
		$login_data['remember'] = "true";
		$user_verify = wp_signon($login_data, false);
		if(is_wp_error($user_verify)){
			echo json_encode(array('error_message' => 'Invalid login detail!'));
			wp_die();
		}else {
			$userid = $user_verify->ID;
			wp_set_current_user($userid);
			wp_set_auth_cookie($userid);
			$user = get_user_by('id', $userid);
			do_action('wp_login', $user->user_login);
			echo json_encode(array('success' => 'success'));
			wp_die();
		}
	}
}

add_action('wp_ajax_emails_check', 'emails_check');
add_action('wp_ajax_nopriv_emails_check', 'emails_check');
function emails_check(){
	$email = $_POST['email'];
	$email_exists_or_not = email_exists($email);
	if($email_exists_or_not){
		echo json_encode(array('error' => 'error'));
		wp_die();
	}else{
		// echo json_encode(array('error' => ''));
		// wp_die();
	}
}


// Add Announcement Data
add_action('wp_ajax_add_announcement', 'add_announcement');
add_action('wp_ajax_nopriv_add_announcement', 'add_announcement');

function add_announcement(){
	$output = '';
	$values = array();
	$data = array();
	$response = array();
	parse_str($_POST['formdata'], $values);
	$announce_title = $values['announce_title'];
	$announce_content = $values['announce_content'];
	
	$wordpress_post = array(
        'post_title' => $announce_title,
        'post_content' => $announce_content,
        'post_status' => 'publish',
        'post_type' => 'announcements'
        );
         
    $new_announcement = wp_insert_post( $wordpress_post );

	if($new_announcement){

		ob_start();
		get_template_part('template-parts/announcements');
		$output .= ob_get_clean();
		$data['status'] = 'success';
	}else{
		$output = '';
		$data['status'] = 'failed';
	}
	$data['data'] = $output;
	$response = json_encode($data);
	echo $response;
	die();
}

// Edit Announcement Details
add_action('wp_ajax_edit_announcement', 'edit_announcement_details');
add_action('wp_ajax_nopriv_edit_announcement', 'edit_announcement_details');

function edit_announcement_details(){
	$output = '';
	$values = array();
	$data = array();
	$response = array();
	parse_str($_POST['formdata'], $values);
	$announce_title = $values['announce_title'];
	$announce_content = $values['announce_content'];
	$post_id = $values['postid'];
	
	$wordpress_post = array(
        'ID' =>  $post_id,
        'post_title' => $announce_title,
        'post_content' => $announce_content,
        'post_status' => 'publish',
        'post_type' => 'announcements'
	);
         
    $edit_announcement = wp_update_post( $wordpress_post );

	if($edit_announcement){

		ob_start();
		get_template_part('template-parts/announcements');
		$output .= ob_get_clean();
		$data['status'] = 'success';
	}else{
		$output = '';
		$data['status'] = 'failed';
	}
	$data['data'] = $output;
	$response = json_encode($data);
	echo $response;
	die();
}

// Delete Announcement
add_action('wp_ajax_delete_announcement', 'delete_announcement_details');
add_action('wp_ajax_nopriv_delete_announcement', 'delete_announcement_details');

function delete_announcement_details(){
	$output = '';
	$data = array();
	$response = array();
	$post_id = $_POST['postid'];
	
	$delete_announcement = wp_delete_post( $post_id, false);

	if($delete_announcement){

		ob_start();
		get_template_part('template-parts/announcements');
		$output .= ob_get_clean();
		$data['status'] = 'success';
	}else{
		$output = '';
		$data['status'] = 'failed';
	}
	$data['data'] = $output;
	$response = json_encode($data);
	echo $response;
	die();
}


/****  Task Add START  ****/

add_action('wp_ajax_add_task_function', 'add_task_function');
add_action('wp_ajax_nopriv_add_task_function', 'add_task_function');

function add_task_function(){
	$output = '';
	$values = array();
	$data = array();
	$response = array();
	parse_str($_POST['formdata'], $values);
	$task_title = $values['task_title'];
	$task_info = $values['task_info'];
	$task_duedate = $values['duedatefield'];
	$task_status = $values['task-status'];
	$assign_user = $values['assign_users'];
	$priority = $values['priority'];
	$task_tags = $values['task-tag'];
	$start_date = $values['search-from-date'];
	$end_date = $values['search-to-date'];

	$task_post = array(
		'post_title' => $task_title,
		'post_content' => $task_info,
		'post_status' => 'publish',
		'post_type' => 'tasks',
	);
	$post_idr = wp_insert_post($task_post);

	if($post_idr){
		update_post_meta( $post_idr, 'duedate', $task_duedate );

		// Add Status category to task post
		$statustermObj = get_term_by( 'id', $task_status, 'task-status');
		wp_set_object_terms($post_idr, $statustermObj, 'task-status');

		// Add Tags to task post
		wp_set_object_terms($post_idr, $task_tags, 'task-tag', false);

		update_post_meta( $post_idr, 'assign_to', $assign_user);
		update_post_meta( $post_idr, 'priority', $priority);
		update_post_meta( $post_idr, 'start_date', $start_date);	
		update_post_meta( $post_idr, 'end_date', $end_date);

		$args = array('task_cat' => $task_status);
		
		ob_start();
		get_template_part('template-parts/tasks', '', $args);
		$output .= ob_get_clean();
		$data['status'] = 'success';
	}else{
		$output = '';
		$data['status'] = 'failed';
	}
	$data['data'] = $output;
	$response = json_encode($data);
	echo $response;
	die();
}


add_action('wp_ajax_files_delete', 'files_delete');
add_action('wp_ajax_nopriv_files_delete', 'files_delete');

function files_delete(){
	$output = '';
	$data = array();
	$response = array();
	$fid = $_POST['fid'];
	$fname = $_POST['fname'];
	$clientid = $_POST['clientid'];
	if($fid != '' AND $clientid != '' AND $fname != ''){
		if($fname == 'personal'){
			$personal_file_list = get_field('file_details',$clientid);
			unset($personal_file_list[$fid]);
			$personal_new = $personal_file_list;
			update_field( 'file_details', $personal_new, $clientid );

			$personal_file_list = get_field('file_details',$clientid);
			
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

							<div class="button_box delete_box_btn">
								<a href="javascript:void(0)" data-id="<?php echo $i; ?>" class="file_delete_btn" data-name="personal" client-id="<?php echo $clientid; ?>">
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
				$i++;
			}

		}else if($fname == 'general'){
			$general_file_list = get_field('general_files',$clientid);
			unset($general_file_list[$fid]);
			$general_new = $general_file_list;
			update_field( 'general_files', $general_new, $clientid );

			$general_file_list = get_field('general_files',$clientid);
			?>

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
								<div class="button_box delete_box_btn">
									<a href="javascript:void(0)" class="file_delete_btn" data-id="<?php echo $j; ?>" data-name="general" client-id="<?php echo $clientid; ?>">
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
					$j++;
				}

		}
	}
	?>
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
	<?php

}

/****  Task Add END  ****/


// add_action( 'wpcf7_init', 'wpcf7_add_form_tag_pathtag' );

// function wpcf7_add_form_tag_pathtag() {
//   wpcf7_add_form_tag(
//     array( 'pathtag', 'pathtag*'), 'pathtag_form_tag_handler',  array( 'name-attr' => true )
//   );
// }
// function pathtag_form_tag_handler( $tag ) {

// $tag = new WPCF7_FormTag( $tag );

// if ( empty( $tag->name ) ) {
//         return '';
//     }

//         $atts = array();

//     $class = wpcf7_form_controls_class( $tag->type );
//     $atts['class'] = $tag->get_class_option( $class );
//     $atts['id'] = $tag->get_id_option();

//     $atts['name'] = $tag->name;
//     $atts = wpcf7_format_atts( $atts );

//       $output = '';

//       $output .= '<textarea class="wpcf7-form-control wpcf7-textarea" aria-invalid="false" cols="40" rows="10" name="field-1235">';

//           foreach ( $_SESSION['question-path'] as $path ) {

//             $output .= $path ."\n\n";

//           }

//       $output .= '</textarea>';

//        return $output;

// }



// add_filter( 'wpcf7_validate_textarea*', 'custom_textarea_validation_filter', 1, 2 );

// function custom_textarea_validation_filter( $result, $tag ) {
// 	echo '<pre>';
// 	print_r($_POST['field-1235']);
// 	echo '</pre>';
// 	die;
//   $tag = new WPCF7_Shortcode($tag);
//   $result = (object)$result;

//   $name = 'project-synopsis';

//   if ( $name == $tag->name ) {
//     $project_synopsis = isset( $_POST[$name] ) ? trim( wp_unslash( (string) $_POST[$name] ) ) : '';

//     if ( empty( $project_synopsis ) ) {
//       $result->invalidate( $tag, "Please write a quick project synopsis." );
//     }
//   }

//   return $result;
// }



add_action('admin_post_custom_action', 'custom_action_handler');
add_action('admin_post_nopriv_custom_action', 'custom_action_handler'); // For non-logged-in users

function custom_action_handler() {
    // Verify nonce for security
    if (isset($_POST['custom_action_nonce']) && wp_verify_nonce($_POST['custom_action_nonce'], 'custom_action_nonce')) {
		$post_idt = $_POST['client_gt_id'];
		$cline_urls = $_POST['clients_url'];
		$description_gn = $_POST['description_gn'];
		$file_datar = $_FILES['file_uplaod'];
		$file_name = $file_datar['name'];
		$general_file = get_field('general_files',$post_idt);
		if($general_file){
			$total_general_file = count($general_file);
		}else{
			$total_general_file = '0';
		}
		
		if($description_gn != '' AND $file_name != ''){
			$_FILES = array("upload_file" => $file_datar);
			$upload_overrides = array( 'test_form' => false );
			$movefile = wp_handle_upload($_FILES['upload_file'], $upload_overrides);
			
			$arr_file_type = wp_check_filetype(basename($_FILES['upload_file']['name']));
			$uploaded_file_type = $arr_file_type['type'];
		
			if(isset($movefile['file'])) {
				$file_name_and_location = $movefile['file'];
		
				$file_title_for_media_library = 'your title here';
		
				$attachment = array(
					'post_mime_type' => $uploaded_file_type,
					'post_title' => 'Uploaded image ' . addslashes($file_title_for_media_library),
					'post_content' => '',
					'post_status' => 'inherit'
				);
		
				$attach_id = wp_insert_attachment($attachment,$file_name_and_location);
				
				$attach_data = wp_generate_attachment_metadata( $attach_id, $file_name_and_location );
				wp_update_attachment_metadata($attach_id,  $attach_data);
				
				$imageUrl = wp_get_attachment_url($attach_id);
			}
		
			$field_keysr = "field_64bf611f165ed";
			if($attach_id != '' OR $description_gn != ''){
				$prpersonsr[$total_general_file] =  array(
					'field_64bf612e165ee' => $attach_id,
					'field_64bf6147165ef' => $description_gn
				);
		
				if($general_file){
					$multiple_file = array_merge( $general_file , $prpersonsr );
					update_field( $field_keysr, $multiple_file, $post_idt );
				}else{
					update_field( $field_keysr, $prpersonsr, $post_idt );
				}
			}
		}
    }

    $redirect_url = wp_get_referer() ? wp_get_referer() : home_url();
    wp_safe_redirect($redirect_url.'&genral=0&#popupsucess');
    exit;
}

add_action('admin_post_custom_actionr', 'custom_actionr_handler');
add_action('admin_post_nopriv_custom_actionr', 'custom_actionr_handler'); // For non-logged-in users

function custom_actionr_handler() {
	$post_id = $_POST['client_gt_id'];
    $category_type = $_POST['category_type'];
    $month_tr = $_POST['month_tr'];
    $year_tr = $_POST['year_tr'];
    $descriptionrt = $_POST['descriptionrt'];
    $file_data = $_FILES['file_upload'];
    $file_name = $file_data['name'];
    $personal_file = get_field('file_details',$post_id);
    if($personal_file){
        $total_personal_file = count($personal_file);
    }else{
        $total_personal_file = '0';
    }

    if($file_name != '' AND $month_tr != '' AND $year_tr != '' AND $category_type != ''){
        $_FILES = array("upload_file" => $file_data);
        $upload_overrides = array( 'test_form' => false );
        $movefile = wp_handle_upload($_FILES['upload_file'], $upload_overrides);
        
        $arr_file_type = wp_check_filetype(basename($_FILES['upload_file']['name']));
        $uploaded_file_type = $arr_file_type['type'];

        if(isset($movefile['file'])) {
            $file_name_and_location = $movefile['file'];
    
            $file_title_for_media_library = 'your title here';
    
            $attachment = array(
                'post_mime_type' => $uploaded_file_type,
                'post_title' => 'Uploaded image ' . addslashes($file_title_for_media_library),
                'post_content' => '',
                'post_status' => 'inherit'
            );
    
            $attach_id = wp_insert_attachment($attachment,$file_name_and_location);
            
            $attach_data = wp_generate_attachment_metadata( $attach_id, $file_name_and_location );
            wp_update_attachment_metadata($attach_id,  $attach_data);
            
            $imageUrl = wp_get_attachment_url($attach_id);
        }

        $field_key = "file_details";
        if($category_type != '' OR $month_tr != '' OR $year_tr != '' OR $attach_id != '' OR $descriptionrt != ''){
            $prpersons[$total_personal_file] =  array(
                'personal_file' => $attach_id,
                'personal_category_type' => $category_type,
                'personal_month' => $month_tr,
                'personal_year' => $year_tr,
                'personal_description' => $descriptionrt
            );
            if($personal_file){
                $multiple_file = array_merge( $personal_file , $prpersons );
                update_field( $field_key, $multiple_file, $post_id );
            }else{
                update_field( $field_key, $prpersons, $post_id );
            }
        }
    }

	$redirect_url = wp_get_referer() ? wp_get_referer() : home_url();
    wp_safe_redirect($redirect_url.'&personal=0&#popupsucess');
    exit;
}


