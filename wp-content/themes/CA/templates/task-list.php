<?php 
/* Template Name: Task List Template */
get_header();
?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!--Wrapper Start-->
<div class="wrappers_main">
    <div class="page-wrapper admin-edit-page task-list-page dashboard-container">
        <div class="page-title d-flex flex-wrap align-items-center justify-content-between">
            <h1>Task manager</h1>
            <div class="top_add_file">
                <a href="javascript:void(0)">
                    Add Task
                    <i>
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 4.16699V15.8337" stroke="#2C3E50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M4.16663 10H15.8333" stroke="#2C3E50" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>

                    </i>
                </a>
            </div>
        </div>

        <div class="error-message" style="color: red;"><?php echo isset($error) ? $error : ''; ?></div>
        <div class="success-message" style="color: green;"><?php echo isset($success) ? $success : ''; ?></div>
       
        <div class="task-block">
            <div class="task_row">
                <?php 
                if( $terms = get_terms( array( 'taxonomy' => 'task-status', 'orderby' => 'id', 'hide_empty' => false ) ) ) :
                    foreach( $terms as $term ):
                ?>
                <div class="task_col">
                    <div class="top_titles d-flex flex-wrap align-items-center">
                        <h3><?php echo $term->name; ?></h3> 
                        <i>
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect y="0.5" width="20" height="20" rx="2" fill="#F6F9FF"/>
                                <path d="M10 4.66602V16.3327" stroke="#2A76F4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M4.1665 10.5H15.8332" stroke="#2A76F4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </i>
                    </div>
                    <div class="column" id="task_status_<?php echo $term->term_id; ?>">
                        <?php 
                            $args = array('task_cat' => $term->term_id);
                            get_template_part('template-parts/tasks', '', $args); 
                        ?>
                    </div>
                </div>
                <?php
                    endforeach;
                endif;
                ?>
            </div>
        </div>
       
        <div class="rightside_task_form">
            <div class="closed_task_form">
                <a href="javascript:void(0)">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <circle cx="14" cy="14" r="14" fill="#E44B4B"/>
                        <path d="M18.7432 9.74219L9.25788 19.2275" stroke="white" stroke-width="2"/>
                        <path d="M18.7432 19.2285L9.25788 9.74323" stroke="white" stroke-width="2"/>
                    </svg>
                </a>
            </div>
            <div class="rightside_task_form_inner">
                <form action="" method="post" id="task_manageform">
                    <div class="side_form">
                        <div class="form_row">
                            <div class="form_col_1-1">
                                <div class="input_container">
                                    <label for="">Task title</label>
                                    <input type="text" name="task_title" id="task_title" placeholder="Task title" class="input_field">
                                </div>
                            </div>
                            <div class="form_col_1-1">
                                <div class="input_container">
                                    <label for="">Description</label>
                                    <textarea name="task_info" id="task_info" placeholder="Description" class="input_field"></textarea>
                                </div>
                            </div>
                            <div class="form_col_1-2">
                                <div class="input_container">
                                    <label for="">Due date</label>
                                    <input type="text" id="duedatefield" name="duedatefield" placeholder="Due date" class="input_field">
                                </div>
                            </div>
                            <div class="form_col_1-2">
                                <div class="input_container">
                                    <label for="">Status</label>
                                    <?php 
                                    if( $terms = get_terms( array( 'taxonomy' => 'task-status', 'orderby' => 'id', 'hide_empty' => false ) ) ) :
                                    ?>
                                    <select name="task-status" id="task-status" class="task-status">
                                        <?php
                                        foreach ( $terms as $term ) :
                                        ?>
                                        <option value="<?php echo $term->term_id; ?>"><?php echo $term->name; ?></option>
                                        <?php
                                        endforeach;
                                    ?>
                                    </select>
                                    <?php
                                        endif;
                                    ?>
                                </div>
                            </div>
                            <div class="form_col_1-2">
                                <div class="input_container">
                                    <label for="">Assign to</label>
                                    <?php 
                                    $args = array(
                                        'role' => 'employees',
                                        'orderby' => 'user_nicename',
                                        'order'   => 'ASC'
                                    );
                                    $employee_list = get_users($args);
                                    $total_employee = count($employee_list);
                                    if($employee_list){
                                    ?>
                                    <select name="assign_users" id="assign_users" class="assignee">
                                    <?php
                                        foreach ($employee_list as $employee) {
                                            $employee_id = $employee->ID;
                                            $employee_name = $employee->display_name;
                                        ?>
                                        <option value="<?php echo $employee_id; ?>"><?php echo $employee_name; ?></option>
                                        <?php }
                                    ?>
                                    </select>
                                    <?php }
                                    ?>
                                </div>
                            </div>
                            <div class="form_col_1-2">
                                <div class="input_container">
                                    <label for="">Priority</label>
                                    <?php 
                                    $field = get_field_object('field_64b7d963bac6a');
                                    $choices = $field['choices'];
                                    ?>
                                    <select name="priority" id="priority">
                                    <?php
                                        foreach ($choices as $key => $choice) {
                                        ?>
                                        <option value="<?php echo $key; ?>"><?php echo $choice; ?></option>
                                        <?php }
                                    ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form_col_1-1">
                                <div class="input_container select_multiple_container">
                                    <label for="">Tags</label>
                                    <?php 
                                    if( $tags = get_terms( array( 'taxonomy' => 'task-tag', 'orderby' => 'id', 'hide_empty' => false ) ) ) :
                                    ?>
                                    <select name="task-tag[]" id="task-tag" class="task-tags form-control select-multiple" multiple="multiple">
                                        <?php
                                        foreach ( $tags as $tag ) :
                                        ?>
                                        <option value="<?php echo $tag->term_id; ?>"><?php echo $tag->name; ?></option>
                                        <?php
                                        endforeach;
                                    ?>
                                    </select>
                                    <?php
                                        endif;
                                    ?>
                                </div>
                            </div>
                            <div class="form_col_1-1">
                                <hr>
                            </div>
                            <div class="form_col_1-1 form_col_heading">
                                <h3>Time Tracking</h3>
                            </div>
                            <div class="form_col_1-2">
                                <div class="input_container">
                                    <label for="">Start date</label>
                                    <input type="text" name="search-from-date" id="search-from-date" class="input_field">
                                </div>
                            </div>
                            <div class="form_col_1-2">
                                <div class="input_container">
                                    <label for="">End date</label>
                                    <input type="text" name="search-to-date" id="search-to-date" class="input_field">
                                </div>
                            </div>
                            <div class="form_col_1-1">
                                <div class="form_submit flxrow">
                                    <input type="hidden" name="action" value="add_task" />
                                    <input class="primary_btn add_task" type="button" value="Save" name="task_submit" id="task_submit" data-action="add_task" data-task-id="">
                                    <input type="button" value="Delete" class="primary_btn cancle_btn" name="task_delete" id="task_delete" data-action="delete_task" data-task-id="">
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--Wrapper End-->

<script>
jQuery(function(){
    jQuery( ".column" ).sortable({
        connectWith: ".column",
        handle: ".drg_full",
        cancel: ".portlet-toggle",
        placeholder: "portlet-placeholder"
    });
    
    jQuery( ".portlet" )
        .addClass( "ui-widget ui-widget-content ui-helper-clearfix" )
        .find( ".portlet-header" )
        .addClass( "ui-widget-header" )
        .prepend( "<span class='ui-icon ui-icon-minusthick portlet-toggle'></span>");
    
    jQuery( ".portlet-toggle" ).on( "click", function() {
        var icon = jQuery( this );
        icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
        icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
    });
    //jQuery('.ui-sortable').draggable();
        
});

jQuery(document).ready(function () {
    jQuery('#search-from-date').datetimepicker({
        format:'d/m/Y H:i',
        onShow:function( ct ){
            this.setOptions({
                maxDate:jQuery('#search-to-date').val()?jQuery('#search-to-date').val():false
            })
        },
        //timepicker:false
    });
    jQuery('#search-to-date').datetimepicker({
        format:'d/m/Y H:i',
        onShow:function( ct ){
            this.setOptions({
                minDate:jQuery('#search-from-date').val()?jQuery('#search-from-date').val():false
            })
        },
        //timepicker:false
    });
    jQuery('#duedatefield').datetimepicker({
        format:'d/m/Y',
        timepicker:false
    });
});

jQuery(document).on('click','.top_add_file a, .task_col .top_titles i ,.ui-sortable .ui-widget.ui-widget-content', function(e) {
    jQuery('body').addClass('open_sidebar');
    jQuery('.rightside_task_form').addClass('active');
});

jQuery(".closed_task_form a").on('click', function(e) {
    jQuery('body').removeClass('open_sidebar');
    jQuery('.rightside_task_form').removeClass('active');
});
</script>

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
jQuery(".select-multiple").select2({
    tags: true,
    /*tokenSeparators: [',', ' ']*/
});
</script>

<script>
jQuery('#task_submit').on('click', function() {
    var action = jQuery(this).attr('data-action');
    if(action == 'add_task'){
        var formdata = jQuery('#task_manageform').serialize();
        var status = jQuery('#task-status').val();
        
        $.ajax({
            url: ca_ajax_object.ajax_url,
            data: {
                action: 'add_task_function',
                'formdata': formdata,
            },
            type: 'post',
            dataType: 'json',
            success: function (response) {
                console.log(response);
                if(response.status == 'success'){
                    jQuery('#task_status_'+ status).html(response.data);
                    jQuery('.success-message').html('Task added successfully.');
                    jQuery('body').removeClass('open_sidebar');
                    jQuery('.rightside_task_form').removeClass('active');
                }else{
                    jQuery('.error-message').html('Something went wrong with Announcement adding.');
                }
            }
        });

    }else{

    }
});
</script>

<?php 
get_footer();
?>