<?php 
/* Template Name: Announcement Detail Template */
get_header();

$home_url = home_url();
$user_id = get_current_user_id();
$user_meta = get_userdata($user_id);
$user_roles = $user_meta->roles[0];
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
<?php
if($user_id){
    ?>
    <div class="wrapper_main">
        <div class="dash_wrap_inner announcement-page ">
            <div class="announcements-main dashboard-container">
                <div class="ann-main-top flxrow">
                    <h3><?php echo get_the_title(); ?></h3>
                    <form id="announcement_filter" action="<?php echo site_url('/announcement-detail'); ?>">
                    <div class="ann-main-top__dropdown">
                            <a href="javascript:void(0)">Sort By Date <span><img src="<?php echo THEME_URI; ?>/images/drop-down__arrow.svg" alt=""></span></a>
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
                    <?php get_template_part('template-parts/announcements'); ?>
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
    <?php
}else{
    ?>
    <script>
		window.location = "<?php echo $home_url; ?>";
	</script>
    <?php
}
?>


<!--Wrapper End-->
<script>

jQuery(document).ready(function () {
    modelOpen();

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
    if(action == 'order_by' && order != 'desc'){
        $data += separator + action +'=' + order;
        history.pushState(null, null, '?'+$data);
    }else{
        $data = '';
        window.history.pushState({path:url},'',url+'/');
    }

    separator = ($data)?'&':'';
    $data += separator + 'pages=' + pages;

    ajaxCall = jQuery.ajax({
      'url' : url,
      'type' : 'get',
      'data' : $data,
      beforeSend: function (response) {
      },
      success: function(data){
        var response = jQuery(data);
        var results = response.find('#announce_posts').html();
        jQuery('#announce_posts').html(results);

        modelOpen();
      },
      error: function (error) {
      }
    });
}

function modelOpen(){

    jQuery(document).on('click','.add_btn a', function () {
        jQuery('#add-announcement').modal('show');
    });

    jQuery(document).on('click','.edit_btn a', function(){
        var pid =jQuery(this).attr('data-id');
        jQuery('#add-announcement-'+ pid).modal('show')
    });
}

var getUrlParameter = function getUrlParameter(sParam) {
    var sPageURL = window.location.search.substring(1),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : decodeURIComponent(sParameterName[1]);
        }
    }
    return false;
};


jQuery(document).on('click', '.pagenation_btn .flxrow a.page-numbers', function(e){
    e.preventDefault();
    var pages =jQuery(this).attr('data-page');
    if(getUrlParameter('order_by')){
        submit_form( pages, 'order_by', getUrlParameter('order_by') );    
    }else{
        submit_form( pages, '', '' );
    }
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
                    jQuery('.success-message').html('Announcement added successfully.');
                    jQuery('#add-announcement').modal('hide');
                }else{
                    jQuery('.error-message').html('Something went wrong with Announcement adding.');
                }
            }
        });
    }
});


jQuery(document).on('click', '.edit_announcement_btn', function() {
    var check = 0;
    var postid = jQuery(this).attr('data-announce-id');
    var announcetitle =jQuery(this).parents('#announcement_form_' + postid).find('input[name="announce_title"]').val();
    if(announcetitle){ check = 0; jQuery(this).parents('#announcement_form_' + postid).find('input[name="announce_title"]').removeClass('error'); }else{ check = 1; jQuery(this).parents('#announcement_form_' + postid).find('input[name="announce_title"]').addClass('error'); }
    var form_data = jQuery(this).parents('#announcement_form_' + postid).serialize();
    
    if(check == 0){
        $.ajax({
            url: ca_ajax_object.ajax_url,
            data: {
                action: 'edit_announcement',
                'formdata': form_data,
            },
            type: 'post',
            dataType: 'json',
            success: function (response) {
                if(response.status == 'success'){
                    jQuery(this).parents('#add-announcement-' + postid).find('.cancle_btn').click();
                    jQuery('.modal').each(function(){
                        jQuery(this).modal('hide');
                    });
                    setTimeout(function () {
                        jQuery('#announce_posts').html(response.data);
                        jQuery('.success-message').html('Announcement updated successfully.');
                    }, 800);
                }else{
                    jQuery('.error-message').html('Something went wrong with Announcement updating.');
                }
            }
        });
    }
});

jQuery(document).on('click', '.delete_announcement', function() {
    var postid = jQuery(this).attr('data-announce-id');

    if(postid != ''){
        $.ajax({
            url: ca_ajax_object.ajax_url,
            data: {
                action: 'delete_announcement',
                'postid': postid,
            },
            type: 'post',
            dataType: 'json',
            success: function (response) {
                if(response.status == 'success'){
                    jQuery('#announce_posts').html(response.data);
                    jQuery('.success-message').html('Announcement deleted successfully.');
                }else{
                    jQuery('.error-message').html('Something went wrong with Announcement deleting.');
                }
            }
        });
    }
});

</script>
<?php get_footer(); ?>