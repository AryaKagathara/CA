<?php 
/* Template Name: Dashboard Template */
get_header(); ?>
<?php
$user_id = get_current_user_id();
?>
<style>
.holder { 
	background-color:#ffffff;
  	width:100%;
  	overflow:hidden;
  	padding:39px 30px 39px 30px;
}
.holder .mask {
  	position: relative;
  	left: 0px;
  	top: 10px;
  	width:100%;
  	overflow: hidden;
}
.holder ul {
  	list-style:none;
  	margin:0;
  	padding:0;
  	position: relative;
}
.holder ul li {
  	padding:10px 0px;
}

</style>
<div class="dashboard-container flxflexi">
	<div class="announce-row flxrow">
		<div class="an-col-1">
			<div class="announcebox flxrow">
				<div class="info flxflexi">
					<h4>Important Announcements</h4>
					<p>Please check the latest announcements to stay updated.</p>
					<div class="btnbox"><a href="<?php echo site_url('/announcement-detail') ?>" class="primary_btn">Read more</a></div>
				</div>
				<div class="image flxfix">
					<img src="<?php echo get_stylesheet_directory_uri(); ?>/images/announce-img.png" alt="announce">
				</div>
			</div>
		</div>
		<div class="an-col-2">
			<?php 
			$args = array(
				'post_type' => 'announcements',
				'post_status' => 'publish',
				'posts_per_page' => -1,
			);
	
			$loop = new WP_Query( $args );
			if ($loop->have_posts()):
				?>
				<div class="holder">
					<ul id="ticker01" class="news-row">
					<?php
					while ($loop->have_posts()):
						$loop->the_post();
						$excerpt = get_the_excerpt();
						$permlink = get_the_permalink();
						//$excerpt = substr($excerpt, 0, 80);
						$result = substr($excerpt, 0, strrpos($excerpt, ' '));
						if(strlen($result) > 40){
							$result = $result .'...';
						}
						?>
						<li class="item"><a href="<?php echo home_url(); ?>/announcement-detail/"><h6><?php echo $excerpt; ?></h6></a><p><?php echo human_time_diff(get_the_time('U'), current_time('timestamp')) . ' ago'; ?></p></li>
						<?php
					endwhile;
					wp_reset_postdata();
					?>
					</ul>
				</div>
				<?php
			endif;
			?>
		</div>
	</div>
	
	<!-- <div class="chart-row flxrow">
		<div class="ch-col">
			<div class="chartbox barChart">
				<h3>Jobs</h3>
				<canvas id="barChart"></canvas>
			</div>
		</div>
		<div class="ch-col">
			<div class="chartbox pieChart">
				<h3>Client</h3>
				<canvas id="pieChart"></canvas>
			</div>
		</div>
	</div> -->
</div>

<?php get_footer(); ?>
<script>
jQuery.fn.liScroll = function(settings) {
	settings = jQuery.extend({
		travelocity: 0.03
	}, settings);		
	return this.each(function(){
		var $strip = jQuery(this);
		$strip.addClass("newsticker")
		var stripHeight = 1;
		$strip.find("li").each(function(i){
			stripHeight += jQuery(this, i).outerHeight(true); // thanks to Michael Haszprunar and Fabien Volpi
		});
		var $mask = $strip.wrap("<div class='mask newsbox'></div>");
		var $tickercontainer = $strip.parent().wrap("<div class='tickercontainer'></div>");								
		var containerHeight = $strip.parent().parent().height();	//a.k.a. 'mask' width 	
		$strip.height(stripHeight);			
		var totalTravel = stripHeight;
		var defTiming = totalTravel/settings.travelocity;	// thanks to Scott Waye		
		function scrollnews(spazio, tempo){
			$strip.animate({top: '-='+ spazio}, tempo, "linear", function(){$strip.css("top", containerHeight); scrollnews(totalTravel, defTiming);});
		}
		scrollnews(totalTravel, defTiming);				
		$strip.hover(function(){
			jQuery(this).stop();
		},
		function(){
			var offset = jQuery(this).offset();
			var residualSpace = offset.top + stripHeight;
			var residualTime = residualSpace/settings.travelocity;
			scrollnews(residualSpace, residualTime);
		});			
	});	
};

$(function(){
    $("ul#ticker01").liScroll();
});

var billing_address_1 = 'Ab cd1';
console.log(billing_address_1);
//const regex = /^(?=.*[0-9_])(?=.*[a-z_])(?=.*[A-Z_])[0-9a-zA-Z_]+$/;
const regex = /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z\s]+$/;
if(billing_address_1 != ''){
	//if (!/^[0-9a-zA-Z]+$/.test(billing_address_1))
	if (regex.test(billing_address_1))
	{
		console.log('1');
		jQuery('#billing_address_1_field').removeClass('new_errors');
		jQuery('#billing_address_1_field span span').hide();
	}else{
		console.log('2');
		jQuery('#billing_address_1_field').addClass('new_errors');
		jQuery('#billing_address_1 input').css('border-color','#ff6d6d');
		jQuery('#billing_address_1_field span span').show();
		jQuery('#billing_address_1_field span span').html('Sorry, but the address you provided does not contain a house number.');
	}

}
</script>