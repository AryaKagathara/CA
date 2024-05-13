<?php
$user_id = get_current_user_id();
$user_meta = get_userdata($user_id);
$user_roles = $user_meta->roles[0];
?>
    <div class="ann-main-bottom_wrap" >
        <?php
        $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
        $orderby = ( get_query_var('order_by') ) ? get_query_var( 'order_by' ) : 'desc';
        $args = array(  
            'post_type' => 'announcements',
            'post_status' => 'publish',
            'posts_per_page' => 10,
            'paged' => $paged,
            'orderby' => 'date', 
            'order' => $orderby, 
        );

        $loop = new WP_Query( $args ); 

        if ($loop->have_posts()):
            while ($loop->have_posts()):
                $loop->the_post();
                ?>
                <div class="ann-main__box">
                    <h5>
                        <?php echo get_the_title(); ?>
                    </h5>
                    <span>
                        <?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?>
                    </span>
                    <?php echo wpautop(get_the_content()); ?>
                    <div class="btn-grp flxrow">
                    <?php
                    if($user_roles == 'administrator'){
                        ?>
                        <div class="btn-box edit_btn">
                            <a href="javascript:void(0)" data-toggle="modal" data-target="#add-announcement-<?php echo get_the_ID(); ?>"
                                data-id="<?php echo get_the_ID(); ?>">Add <span>
                                    <img src="<?php echo THEME_URI; ?>/images/add-btn_icon(+).svg" alt=""><svg
                                        width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M1.3335 13.6668H4.66683L13.4168 4.91676C13.8589 4.47473 14.1072 3.87521 14.1072 3.25009C14.1072 2.62497 13.8589 2.02545 13.4168 1.58342C12.9748 1.1414 12.3753 0.893066 11.7502 0.893066C11.125 0.893066 10.5255 1.1414 10.0835 1.58342L1.3335 10.3334V13.6668Z"
                                            stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                            </a>
                        </div>
                        <div class="btn-box delete_btn">
                            <a href="javascript:void(0)" data-announce-id="<?php echo get_the_ID(); ?>" class="delete_announcement">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M3.33337 5.83301H16.6667" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M8.33337 9.16699V14.167" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path d="M11.6666 9.16699V14.167" stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round"
                                        stroke-linejoin="round"></path>
                                    <path
                                        d="M4.16663 5.83301L4.99996 15.833C4.99996 16.275 5.17555 16.699 5.48811 17.0115C5.80068 17.3241 6.2246 17.4997 6.66663 17.4997H13.3333C13.7753 17.4997 14.1992 17.3241 14.5118 17.0115C14.8244 16.699 15 16.275 15 15.833L15.8333 5.83301"
                                        stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                    <path
                                        d="M7.5 5.83333V3.33333C7.5 3.11232 7.5878 2.90036 7.74408 2.74408C7.90036 2.5878 8.11232 2.5 8.33333 2.5H11.6667C11.8877 2.5 12.0996 2.5878 12.2559 2.74408C12.4122 2.90036 12.5 3.11232 12.5 3.33333V5.83333"
                                        stroke="#A6ABBD" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                </svg>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                        
                    <div class="modal fade" id="add-announcement-<?php echo get_the_ID(); ?>" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="add-announcement__popup">
                                    <div class="add-announcement_head">
                                        <h3>Update Announcement</h3>
                                    </div>
                                    <div class="add-announcement_body">
                                        <form action="" id="announcement_form_<?php echo get_the_ID(); ?>" method="post">
                                            <div class="form-row"><input type="text" placeholder="Add title" name="announce_title"
                                                    value="<?php echo get_the_title(); ?>"></div>
                                            <div class="form-row"><textarea name="announce_content" id="announce_content" cols=""
                                                    rows="" placeholder="Message"><?php echo get_the_content(); ?></textarea></div>
                                            <div class="btnbox_wrap flxrow">
                                                <div class="form-submit_btn"><input type="button" class="primary_btn edit_announcement_btn"
                                                        name="edit_announcement_<?php echo get_the_ID(); ?>" value="Update" data-announce-id="<?php echo get_the_ID(); ?>"></div>
                                                <input type="hidden" name="action" value="edit_announcement" />
                                                <input type="hidden" name="postid" value="<?php echo get_the_ID(); ?>" />
                                                <div class="form-close_btn"><input type="button" class="primary_btn cancle_btn"
                                                        data-bs-dismiss="modal" aria-label="Close" value="Close"></div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
    <div class="bottom-btn__box flxrow">
        <?php
        if($user_roles == 'administrator'){
            ?>
            <div class="add_btn">
                <a href="javascript:void(0)" class="primary_btn" data-toggle="modal" data-target="#add-announcement">Add<span><img src="<?php echo THEME_URI . 'images/add-btn_icon(+).svg'; ?>" alt=""></span></a>
            </div>
            <?php
        }
        ?>
        <div class="pagenation_btn"><span class="flxrow">
            <?php echo my_paginate_links(array('prev_text' => __('Previous', 'textdomain'), 'next_text' => __(' Next ', 'textdomain')), $loop); ?>
        </span>
        </div>
    </div>