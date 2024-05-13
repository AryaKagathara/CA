<?php
get_header();

$home_url = home_url();

$result = '';

// function get_result(){
//     ob_start();

//     if ( have_posts() ) :
//         while ( have_posts() ) : the_post();
//         echo '<h1>'.get_the_title().'</h1>';
//         endwhile;
//     endif;
//     $result = ob_get_clean();

//     return $result;
// }

if( isset($_POST['action']) && $_POST['action'] == 'add_announcement' ){
    $error = '';
    $success = '';

    $title = $_POST['announce_title'];
    $content = $_POST['announce_content'];

    $wordpress_post = array(
        'post_title' => $title,
        'post_content' => $content,
        'post_status' => 'publish',
        'post_type' => 'announcements'
        );
         
    $new_announcement = wp_insert_post( $wordpress_post );
    //get_result();
    if($new_announcement){
        $success .= 'Announcement added successfully.';
    }else{
        $error .= 'Something went wrong with adding the announcement';
    }
}

if( isset($_POST['action']) && $_POST['action'] == 'edit_announcement' && $_POST['postid']){
    $postid = $_POST['postid'];
    $error = '';
    $success = '';

    $posttitle = $_POST['announce_title'];
    $postcontent = $_POST['announce_content'];

    $wordpress_post = array(
        'ID' =>  $postid,
        'post_title' => $posttitle,
        'post_content' => $postcontent,
        'post_status' => 'publish',
        'post_type' => 'announcements'
        );
         
    $edit_announcement = wp_update_post( $wordpress_post );
    if($edit_announcement){
        $success .= 'Announcement updated successfully.';
    }else{
        $error .= 'Something went wrong with updating the announcement';
    }
}

function delete_post( $post_id, $force = false ){
	return wp_delete_post( $post_id, $force);
}

if( isset($_GET['action']) && $_GET['action'] == 'delete_announcement' && $_GET['postid']){
    $postid = $_GET['postid'];
    

    $deleted_post = delete_post($postid);

    // if($deleted_post == true){
    //     $success = 'Announcement deleted successfully.';
    // }else{
    //     $error = 'Something went wrong with deleting the announcement';
    // }

    ?>
	<script>window.location = "<?php echo $home_url; ?>/announcement";</script>
	<?php
}

?>
<style>
.pagenation_btn a, .pagenation_btn .page-numbers {
    margin-left: 12px;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    justify-content: center;
    align-items: center;
    align-content: center;
    height: 30px;
    width: 30px;
    font-weight: 700;
    font-size: 14px;
    line-height: 1;
    background: #F6F9FF;
    border-radius: 5px;
    color: rgba(0, 0, 0, 0.5);
    padding: 0;
    border: none;
}
.pagenation_btn .current{
    background: #2A76F4;
    color: #ffffff;
}
.pagenation_btn .nav-links{display: flex;}
.pagenation_btn .page-numbers.next{width: 50px;}
.pagenation_btn .page-numbers.prev{width: 70px;}
</style>
<!--Wrapper Start-->
<div class="wrapper_main">
    <div class="dash_wrap_inner announcement-page ">
        <div class="announcements-main dashboard-container">
            <div class="ann-main-top flxrow">
                <h3><?php echo post_type_archive_title(); ?></h3>
                <form id="announcement_filter" action="<?php echo site_url('/announcement'); ?>">
                <div class="ann-main-top__dropdown">
                        <a href="javascript:void(0)">Sort By Date <span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/drop-down__arrow.svg" alt=""></span></a>
                        <div class="ann-main-top__dropdown_box flxrow">
                            <a href="javascript:void(0)" data-action="order_by" data-action-value="asc" class="orderby">Accending <span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Accending_icon.svg" alt=""></span></a>
                            <a href="javascript:void(0)" data-action="order_by" data-action-value="desc" class="orderby">Descending <span><img src="<?php echo get_stylesheet_directory_uri(); ?>/images/Descending.svg" alt=""></span></a>
                        </div>
                    </div>
                    <input type="hidden" id="pages" name="pages" value="1" />
                </form>
            </div>
            <div class="error-message" style="color: red;"><?php echo isset($error) ? $error : ''; ?></div>
            <div class="success-message" style="color: green;"><?php echo isset($success) ? $success : ''; ?></div>
            <div class="ann-main-bottom" id="announce_posts">
                <?php 
                global $wp_query;
                $args = array('main_query' => $wp_query, 'testdata' => 'testing data');
                ?>
                <?php get_template_part('template-parts/announcements', ' ', $args); ?>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="add-announcement" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="add-announcement__popup">
                        <div class="add-announcement_head">
                            <h3>Add Announcement</h3>
                        </div>
                        <div class="add-announcement_body">
                            <form action="" method="post" id="announcement_frm">
                                <div class="form-row"><input type="text" placeholder="Add title" name="announce_title"></div>
                                <div class="form-row"><textarea name="announce_content" id="" cols="" rows=""
                                        placeholder="Message"></textarea></div>
                                <div class="btnbox_wrap flxrow">
                                    <div class="form-submit_btn"><input type="button" class="primary_btn add_announcement"
                                            value="Submit"></div>
                                    <div class="form-close_btn"><input type="button" class="primary_btn cancle_btn "
                                            data-bs-dismiss="modal" aria-label="Close" value="Close"></div>
                                    <input type="hidden" name="action" value="add_announcement" /> 
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
    </div>
</div>


<!--Wrapper End-->
<script>

jQuery(document).ready(function () {
    modelOpen();

    jQuery(".add_btn a").click(function () {
        jQuery('#add-announcement').modal('show');
    });

    jQuery(".ann-main-top__dropdown > a").click(function () {
        jQuery(".ann-main-top__dropdown_box").toggleClass("show");
    });

    jQuery(".orderby").on('click', function (e) {
        e.preventDefault();
        var pages = 1;
        var order =jQuery(this).attr('data-action-value');
        var orderaction =jQuery(this).attr('data-action');

        submit_form(pages, orderaction, order);
    });
});





var ajaxCall;
function submit_form(  pages = 1, action = '', order = '' ){
    if(ajaxCall && ajaxCall.readyState != 4){
        ajaxCall.abort();
    }
    var ajaxURLData = url = jQuery('#announcement_filter').attr('action');
    var $data = '';
    
    separator = ($data)?'&':'';
    if(action == 'order_by'){
        $data += separator + action +'=' + order;
        history.pushState(null, null, '?'+$data);
    }else{
        history.pushState(null, null, $data);
    }

    separator = ($data)?'&':'';
    $data += separator + 'pages=' + pages;

    ajaxCall = jQuery.ajax({
      'url' : ajaxURLData,
      'type' : 'get',
      'data' : $data,
      beforeSend: function (response) {

      },
      success: function(data){
        var response = jQuery(data);
        
        var results = response.find('#announce_posts').html();
        jQuery('#announce_posts').html(results);

        var resultsBlogPagination = response.find('.pagenation_btn').html();
        jQuery('.pagenation_btn').html(resultsBlogPagination);

        modelOpen();
        //get_page_number();
      },
      error: function (error) {
        
      }
    });
}

function modelOpen(){
    jQuery('.edit_btn a').on('click', function(){
        var pid =jQuery(this).attr('data-id');
        jQuery('#add-announcement-'+ pid).modal('show')
    });
}


jQuery(document).on('click', '.pagenation_btn .flxrow a.page-numbers', function(e){
    e.preventDefault();
    var pages =jQuery(this).attr('data-page');
    submit_form( pages, '', '' );
});

jQuery('.add_announcement').on('click', function(){
    $check = 0;
    var announcetitle = jQuery('#add-announcement').find('input[name="announce_title"]').val();
    if(announcetitle){ $check = 0; jQuery('#add-announcement').find('input[name="announce_title"]').removeClass('error'); }else{ $check = 1; jQuery('input[name="announce_title"]').addClass('error'); }
    var form_data = jQuery('#announcement_frm').serialize();
    
    if($check == 0){
        //jQuery("#announcement_frm").submit();

        $.ajax({
            url: ca_ajax_object.ajax_url,
            data: {
                action: 'add_announcement',
                'formdata': form_data,
            },
            type: 'post',
            dataType: 'json',
            success: function (response) {
                if(response.status == 'success'){
                    jQuery('#announce_posts').html(response.data);
                    
                }
            }
        });
    }
});

</script>
<?php get_footer(); ?>