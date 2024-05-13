<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Genesis Block Theme
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-QT4955VLMG"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'G-QT4955VLMG');
    </script>
    <script defer src='https://static.cloudflareinsights.com/beacon.min.js' data-cf-beacon='{"token": "26c8d46ca8d64e78bf31f748e4fdefc1"}'></script>

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-WDLRD2VG');</script>
    <!-- End Google Tag Manager -->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
$home_url = home_url();
$page_id = get_the_ID();
$user_id = get_current_user_id();
if($user_id){
    $user_meta = get_userdata($user_id);
    $display_name = $user_meta->display_name;
    $user_roles = $user_meta->roles[0];
    $user_view = get_author_posts_url($user_id);
}
$logo = get_field('header_logo','option');

if($page_id != '9' AND $page_id != '277'){
?>
<header id="header">
    <div class="header_wrapper flxrow">
        <div class="ham_menubtn">
            <a href="javascript:void(0);">
                <span></span>
                <span></span>
                <span></span>
            </a>
        </div>
        <?php
        if($logo){
            ?>
            <div class="logo">
                <a href="<?php echo $home_url; ?>"><img src="<?php echo $logo; ?>" alt="logo"></a>
            </div>
            <?php
        }
        ?>
        <div class="search_head">
            <form action="">
                <div class="search_head_inner">
                    <input type="text" class="input-search" placeholder="Search here...">
                </div>
            </form>
        </div>
        <a href="#" class="mobile_src_btn">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M8.33333 14.1667C11.555 14.1667 14.1667 11.555 14.1667 8.33333C14.1667 5.11167 11.555 2.5 8.33333 2.5C5.11167 2.5 2.5 5.11167 2.5 8.33333C2.5 11.555 5.11167 14.1667 8.33333 14.1667Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                <path d="M17.5 17.5L12.5 12.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
            </svg>
        </a>
        <div class="user_login flxrow">
            <?php
            if(!$user_id){
                ?>
                <span class="form_row btnbox"><a href="<?php echo $home_url; ?>/login/" class="btn primary_btn">Login</a></span>
                <?php
            }else{
                ?>
                <a href="#" class="admin-btn">
                    <div class="img" style="background-image:url(<?php echo get_stylesheet_directory_uri(); ?>/images/user-img.png);"></div>
                    <div class="name">
                        <?php
                        $r_name = ''; 
                        if($user_roles == 'administrator'){
                            $r_name = 'Admin';
                        }else if($user_roles == 'clients'){
                            $r_name = 'Client';
                        }else if($user_roles == 'Empoloyees'){
                            $r_name = 'Empoloyee';
                        }
                        ?>
                        <p><?php echo $display_name; ?> <span><?php echo $r_name; ?></span></p>
                        <div class="down-caret">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5 7.5L10 12.5L15 7.5" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                </a>
                <div class="user_dropdown">
                    <ul>
                        <li><a href="<?php echo $user_view; ?>">Profile <span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/profile-icon.svg" alt="profile icon"></span></a></li>
                        <li><a href="#">Keyboard Shortcuts <span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/shortcut-icon.svg" alt="shortcut icon"></span></a></li>
                        <li><a href="<?php echo wp_logout_url(home_url()); ?>">Logout <span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/logout-icon.svg" alt="logout icon"></span></a></li>
                    </ul>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</header>


<div class="wrapper_main">
    <div class="dashboard">
        <aside class="sidebar flxfix">
            <div class="menu">
                <ul>
                    <li><a href="<?php echo $home_url; ?>"><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/home-icon.svg" alt="home icon"></span>Home</a></li>
                    <?php
                    if($user_roles == 'administrator' OR $user_roles == 'employees'){
                        ?>
                        <li><a href="<?php echo $home_url; ?>/client-list/"><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/clients-icon.svg" alt="clients icon"></span>Clients</a></li>
                        <?php
                    }
                    ?>
                    <!-- <li><a href="#"><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/job-icon.svg" alt="job icon"></span>Jobs</a></li> -->
                    <?php
                    if($user_roles == 'administrator'){
                        ?>
                        <li><a href="<?php echo $home_url; ?>/employee-list"><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/manage-icon.svg" alt="manage icon"></span>Manage Employees</a></li>
                        <li><a href="<?php echo $home_url; ?>/inquire-list/"><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/inquiry-icon.svg" alt="inquiry icon"></span>Inquiry</a></li>
                        <?php 
                    }
                    ?>
                    <li><a href="<?php echo $home_url; ?>/announcement-detail"><span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/announcements-icon.svg" alt="announcements icon"></span>Announcements</a></li>
                </ul>
            </div>
        </aside>
    <?php
}
?>