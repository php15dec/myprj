<?php // Load Javascripts for Theme
function solostream_theme_js() {

	if ( !is_admin() && is_singular() ) {

		global $post;
		$featcontent = get_post_meta($post->ID, 'post_featcontent', true);
		$featpages = get_post_meta($post->ID, 'post_featpages', true);

		if ( $featcontent != "No" || $featpages == "Yes" || is_page_template('page-youtube.php') ) {
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'froogaloop', get_bloginfo('template_directory').'/js/froogaloop.js', array( 'jquery' ) );
			wp_enqueue_script( 'flexslider-min', get_bloginfo('template_directory').'/js/flexslider-min.js', array( 'jquery' ) );
			wp_enqueue_script( 'flex-script-main', get_bloginfo('template_directory').'/js/flex-script-main.js', array( 'jquery' ) );
		}

		if ( is_page_template('page-portfolio.php') ) {
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'framework', get_bloginfo('template_directory').'/js/framework.js', array( 'jquery' ) );
		}

	}

	if ( !is_admin() && is_home() ) {

		global $post;
		$page_id = get_option('page_for_posts');
		$featcontent = get_post_meta($page_id, 'post_featcontent', true);
		$featpages = get_post_meta($page_id, 'post_featpages', true);

		if ( $featcontent != "No" || $featpages == "Yes" ) {
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'froogaloop', get_bloginfo('template_directory').'/js/froogaloop.js', array( 'jquery' ) );
			wp_enqueue_script( 'flexslider-min', get_bloginfo('template_directory').'/js/flexslider-min.js', array( 'jquery' ) );
			wp_enqueue_script( 'flex-script-main', get_bloginfo('template_directory').'/js/flex-script-main.js', array( 'jquery' ) );
		}

	}

	if (!is_admin()) {

		wp_enqueue_script( 'external', get_bloginfo('template_directory').'/js/external.js', array( 'jquery' ), '', true );

		if ( get_option('solostream_show_topnav') == 'yes' ) {
			wp_enqueue_script( 'suckerfish', get_bloginfo('template_directory').'/js/suckerfish.js', '', '', true );
		}

		if ( get_option('solostream_show_catnav') == 'yes' ) {
			wp_enqueue_script( 'suckerfish-cat', get_bloginfo('template_directory').'/js/suckerfish-cat.js', '', '', true );
		}

		if ( get_option('solostream_responsive_off') != 'Yes' ) {
			wp_enqueue_script( 'mobilmenu', get_bloginfo('template_directory').'/js/jquery.mobilemenu.js', array( 'jquery' ), '', true );
		}

		if ( get_option('solostream_features_on') != 'No' || get_option('solostream_featpage_on') == 'Yes' || is_active_widget( false, false, 'videoslide-widget' ) || is_active_widget( false, false, 'catslide-widget' ) || is_active_widget( false, false, 'narrowpostslider-widget' ) || is_active_widget( false, false, 'widepostslider-widget' ) || is_active_widget( false, false, 'widepageslider-widget' ) ) {
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'froogaloop', get_bloginfo('template_directory').'/js/froogaloop.js', array( 'jquery' ) );
			wp_enqueue_script( 'flexslider-min', get_bloginfo('template_directory').'/js/flexslider-min.js', array( 'jquery' ) );
			wp_enqueue_script( 'flex-script-main', get_bloginfo('template_directory').'/js/flex-script-main.js', array( 'jquery' ) );
		}

		if ( is_active_widget( false, false, 'sidetabs-widget' ) ) {
			wp_enqueue_script('jquery');
			wp_enqueue_script( 'flexslider-min', get_bloginfo('template_directory').'/js/flexslider-min.js', array( 'jquery' ) );
			wp_enqueue_script( 'flex-script-main', get_bloginfo('template_directory').'/js/flex-script-main.js', array( 'jquery' ) );
		}

	}

}

add_action('wp_print_scripts', 'solostream_theme_js');

function mobilemenu_js() { ?>
	<!-- MobileMenu JS -->
	<script type="text/javascript">
		jQuery(function () {
			jQuery('.nav').mobileMenu({ defaultText: '<?php _e("Navigate to ...", "solostream"); ?>' });
			jQuery('.catnav').mobileMenu({ defaultText: '<?php _e("Navigate to ...", "solostream"); ?>', className: 'select-menu-catnav' });
		});
	</script>

	<!-- Media Queries Script for IE8 and Older -->
	<!--[if lt IE 9]>
		<script type="text/javascript" src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->
<?php }

if ( get_option('solostream_responsive_off') != 'Yes'  ) {
	add_action('wp_head', 'mobilemenu_js');
}

?>