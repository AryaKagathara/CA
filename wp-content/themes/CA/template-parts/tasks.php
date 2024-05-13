<?php 
$status_id = $args['task_cat'];


$args = array(
'post_type' => 'tasks',
'posts_per_page' => -1,
'tax_query' => array(
    array(
    'taxonomy' => 'task-status',
    'field' => 'term_id',
    'terms' => $status_id
     )
  )
);
$query = new WP_Query( $args );
?>

<?php 
if ($query->have_posts()):
    while ($query->have_posts()):
        $query->the_post();
    ?>
    <div class="portlet">
        <div class="drg_full" task-id="<?php echo get_the_ID(); ?>">
            <div class="portlet-header-top">
                <div class="left_numb">
                    #<?php echo get_the_ID(); ?>
                </div>
                <div class="right_portlet_date">
                    23 March
                    <i>
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M10.5002 2.91602H3.50016C2.85583 2.91602 2.3335 3.43835 2.3335 4.08268V11.0827C2.3335 11.727 2.85583 12.2493 3.50016 12.2493H10.5002C11.1445 12.2493 11.6668 11.727 11.6668 11.0827V4.08268C11.6668 3.43835 11.1445 2.91602 10.5002 2.91602Z"
                                stroke="#959595" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M9.3335 1.75V4.08333" stroke="#959595" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M4.6665 1.75V4.08333" stroke="#959595" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M2.3335 6.41602H11.6668" stroke="#959595" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M5.83317 8.75H4.6665V9.91667H5.83317V8.75Z" stroke="#959595" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </i>
                </div>
            </div>
            <div class="portlet-header">
                <h3><?php echo get_the_title(); ?></h3>
                <?php echo wpautop(get_the_content()); ?>
            </div>
            <div class="user_specify">
                <i>
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M9 15.75C12.7279 15.75 15.75 12.7279 15.75 9C15.75 5.27208 12.7279 2.25 9 2.25C5.27208 2.25 2.25 5.27208 2.25 9C2.25 12.7279 5.27208 15.75 9 15.75Z"
                            stroke="#959595" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M9 9.75C10.2426 9.75 11.25 8.74264 11.25 7.5C11.25 6.25736 10.2426 5.25 9 5.25C7.75736 5.25 6.75 6.25736 6.75 7.5C6.75 8.74264 7.75736 9.75 9 9.75Z"
                            stroke="#959595" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M4.62598 14.1368C4.81161 13.5189 5.19145 12.9774 5.70916 12.5925C6.22687 12.2076 6.85486 11.9998 7.49998 12H10.5C11.1459 11.9998 11.7747 12.208 12.2928 12.5938C12.8108 12.9796 13.1906 13.5223 13.3755 14.1412"
                            stroke="#959595" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                </i>
                John Doe
            </div>
            <div class="portlet-bottom">
                <div class="task_priority">
                    Urgent
                </div>
                <div class="asap_txt">
                    ASAP
                </div>
                <div class="priority_status high_priority">
                    High
                    <i>
                        <svg width="14" height="19" viewBox="0 0 14 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7 9C9 6.04 7 2 6 1C6 4.038 4.227 5.741 3 7C1.774 8.26 1 10.24 1 12C1 13.5913 1.63214 15.1174 2.75736 16.2426C3.88258 17.3679 5.4087 18 7 18C8.5913 18 10.1174 17.3679 11.2426 16.2426C12.3679 15.1174 13 13.5913 13 12C13 10.468 11.944 8.06 11 7C9.214 10 8.209 10 7 9Z"
                                stroke="#198754" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </i>
                </div>
            </div>
        </div>
    </div>
    <?php
    endwhile;
    wp_reset_postdata();
endif;
?>
