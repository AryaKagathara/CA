<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package Genesis Block Theme
 */

 $page_id = get_the_ID();
if($page_id != '9' AND $page_id != '277'){
?>
	</div>
</div>
	<?php
}
?>
<?php wp_footer(); ?>
<script>
	jQuery(".ham_menubtn a").click(function () {
		jQuery("body").toggleClass("open-sidebar");
	});
</script>
</body>
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WDLRD2VG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
</html>
