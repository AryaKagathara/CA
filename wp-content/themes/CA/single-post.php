<?php get_header(); ?>
<?php
$banner_image = get_field('newsroom_banner_image','option');
$banner_title = get_field('newsrrom_banner_title','option');
$banner_text = get_field('newsroom_banner_text','option');
$all_news_link = get_field('view_all_news_link','option');
$post_id = get_the_ID();
$content_rt = get_the_content($post_id);
$postdate = get_the_date("M j, Y",$post_id );
?>
<section class="banner_main newsroom">
	<div class="home_banner">
		<?php 
		if($banner_image){ 
			?>
			<div class="banner_bg" style="background-image: url(<?php echo $banner_image; ?>);"></div>
			<?php 
		} 
		?>
		<div class="home_banner_caption">
			<div class="banner_text wow fadeInUp" data-wow-delay="0.2s">
				<div class="text_block ">
					<?php 
					if($banner_title){ 
						?>
						<h1><?php echo $banner_title; ?></h1>
						<?php 
					} 
					if($banner_text){
						?>
						<p><?php echo $banner_text; ?></p>
						<?php
					}
					?>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="news_room detail_page">
	<div class="newsroom_sec">
		<div class="container">
			<div class="newsroom_wrap">
				<div class="news_blog">
					<h4 class="wow fadeInUp" data-wow-delay="0.2s"><?php the_title();?></h4>
					<span><?php echo $postdate; ?></span>
				</div>
				<div class="news_dtl">
					<?php
						if(!empty($content_rt)){
							echo apply_filters("the_content", $content_rt);
						}
					?>
				</div>
			</div>

			<?php
			if (!empty($all_news_link)) {
				$link_title  = $all_news_link['title'];
				$link_url    = $all_news_link['url'];
				$link_target = $all_news_link['target'];
				if ($link_title  != '') {
					?>
					<div class="policy_btn">
						<a href="<?php echo $link_url == '#' ? 'javascript:void(0);' : $link_url; ?>" target="<?php echo $link_target; ?>"><?php echo $link_title; ?></a>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</section>
<?php get_footer(); ?>