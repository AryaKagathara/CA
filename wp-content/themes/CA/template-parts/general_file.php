<?php
$client_id = $args['client_id'];

$general_file_list = get_field('general_files',$client_id);
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
						<a href="javascript:void(0)" class="file_delete_btn" data-id="<?php echo $j; ?>" data-name="general" client-id="<?php echo $client_id; ?>">
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
            dataType: "json",
            success: function(response){
                if(response.status == 'success'){
                    if(fname == 'personal'){
                        jQuery('#personal_file_posts').html(response.data);
                    }
                    if(fname == 'general'){
                        jQuery('#general_file_posts').html(response.data);
                    }
                    
                    jQuery('.success-message').html('File deleted successfully.');
                }else{
                    jQuery('.error-message').html('Something went wrong with File deleting.');
                }
            }
        });
    });
	</script>