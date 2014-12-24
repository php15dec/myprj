<?php

/*-----------------------------------------------------------------------------------*/
// This starts the Side Tabs widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'sidetabs_load_widgets' );

function sidetabs_load_widgets() {
	register_widget( 'Sidetabs_Widget' );
}

class Sidetabs_Widget extends WP_Widget {

	function Sidetabs_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'sidetabs', 'description' => __('Adds the Side Tabs box for popular posts, archives, categories and tags.', "solostream") );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'sidetabs-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'sidetabs-widget', __('Side Tabs Widget', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Call the featured-sidetabs file. */
		get_template_part( 'featured-sidetabs' );

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		return $instance;
	}

}


/*-----------------------------------------------------------------------------------*/
// This starts the Subscribe Box widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'subscribebox_load_widgets' );

function subscribebox_load_widgets() {
	register_widget( 'SubscribeBox_Widget' );
}

class SubscribeBox_Widget extends WP_Widget {

	function SubscribeBox_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'subscribebox', 'description' => __('Adds the Subscribe Box and/or social network icons.', "solostream") );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'subscribebox-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'subscribebox-widget', __('Subscribe Box Widget', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$intro = $instance['intro'];
		$showicons = $instance['showicons'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		printf( '<div class="textwidget">' );

		/* Display intro from widget settings if one was input. */
		if ( $intro )
			printf( '<p class="intro">' . __('%1$s', "solostream") . '</p>', $intro ); ?>

			<?php if ( get_option('solostream_subscribe_settings') == 'Use Google/FeedBurner Email' && get_option('solostream_fb_feed_id') ) { ?>

				<div class="email-form">

					<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo get_option('solostream_fb_feed_id'); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">

						<input type="hidden" value="<?php echo get_option('solostream_fb_feed_id'); ?>" name="uri"/>

						<input type="hidden" name="loc" value="en_US"/>

						<input type="text" class="sub" name="email" value="<?php _e("email address", "solostream"); ?>" onfocus="if (this.value == '<?php _e("email address", "solostream"); ?>') {this.value = '';}" onblur="if (this.value == '') {this.value = '<?php _e("email address", "solostream"); ?>';}" />

						<input type="submit" value="<?php _e("submit", "solostream"); ?>" class="subbutton" />

						<div style="clear:both;"><small><?php _e("Privacy guaranteed. We never share your info.", "solostream"); ?></small></div>

					</form>

				</div>

			<?php } elseif ( get_option('solostream_subscribe_settings') == 'Use Alternate Email List Form' && get_option('solostream_alt_email_code') ) { ?>

				<div class="email-form">
					<?php echo stripslashes(get_option('solostream_alt_email_code')); ?>
				</div>

			<?php } ?>

			<?php if( $showicons ) { ?>

				<?php include (TEMPLATEPATH . '/sub-icons.php'); ?>

			<?php } ?>

		<?php printf( '</div>' ); ?>

		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and intro to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['intro'] = strip_tags( $new_instance['intro'] );
		$instance['showicons'] = $new_instance['showicons'];

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Subscribe', "solostream"),
			'intro' => __('Enter your email address below to receive updates each time we publish new content.', "solostream"),
			'showicons' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

		<!-- Intro: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'intro' ); ?>"><?php _e('Introduction:', "solostream"); ?></label>
		<textarea rows="3" id="<?php echo $this->get_field_id( 'intro' ); ?>" name="<?php echo $this->get_field_name( 'intro' ); ?>" style="width:100%;"><?php echo $instance['intro']; ?></textarea></p>

		<!-- Show Social Media Icons -->
		<p>
			<label for="<?php echo $this->get_field_id("showicons"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("showicons"); ?>" name="<?php echo $this->get_field_name("showicons"); ?>"<?php checked( (bool) $instance["showicons"], true ); ?> />
				<?php _e( 'Show Social Media Icons' ); ?>
			</label>
		</p>

	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
// This starts the Category Posts widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'catposts_load_widgets' );

function catposts_load_widgets() {
	register_widget( 'Catposts_Widget' );
}

class Catposts_Widget extends WP_Widget {

	function Catposts_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'catposts', 'description' => __('Adds posts from a specific category .', "solostream") );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'catposts-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'catposts-widget', __('Category Posts Widget', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $post;
		$post_old = $post; // Save the post object.

		extract( $args );

		// If no title, use the name of the category.
		if( !$instance["title"] ) {
			$category_info = get_category($instance["cat"]);
			$instance["title"] = $category_info->name;
		}

		// Get array of post info.
		$cat_posts = new WP_Query("showposts=" . $instance["num"] . "&cat=" . $instance["cat"]);

		/* Before widget (defined by themes). */
		echo $before_widget;

		// Widget title
		echo $before_title;
		if( $instance["title_link"] )
			echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["title"] . '</a>';
		else
			echo $instance["title"];
		echo $after_title;

		// Post list
		echo "<div class='cat-posts-widget textwidget'>\n";

		while ( $cat_posts->have_posts() )
		{
			$cat_posts->the_post();
		?>
				<div class="post">
					<div class="entry clearfix">
						<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_thumbnail(); ?></a>
						<h3 class="post-title"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
						<?php include (TEMPLATEPATH . "/postinfo.php"); ?>
						<?php the_excerpt(); ?>
					</div>
					<div style="clear:both;"></div>
				</div>
		<?php }

		echo "</div>\n";

		echo $after_widget;

		$post = $post_old; // Restore the post object.
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['cat'] = $new_instance['cat'];
		$instance['num'] = $new_instance['num'];
		$instance['title_link'] = $new_instance['title_link'];

		return $instance;
	}

	function form($instance) {

		$defaults = array(
			'title' => '',
			'cat' => '',
			'num' => 0,
			'title_link' => '',
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id("title"); ?>">
				<?php _e( 'Title' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
			</label>
		</p>

		<p>
			<label>
				<?php _e( 'Category' ); ?>:
				<?php wp_dropdown_categories( array( 'name' => $this->get_field_name("cat"), 'selected' => $instance["cat"] ) ); ?>
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id("num"); ?>">
				<?php _e('Number of Posts to Show'); ?>:
				<input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo absint($instance["num"]); ?>" size='3' />
			</label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id("title_link"); ?>">
				<input type="checkbox" class="checkbox" id="<?php echo $this->get_field_id("title_link"); ?>" name="<?php echo $this->get_field_name("title_link"); ?>"<?php checked( (bool) $instance["title_link"], true ); ?> />
				<?php _e( 'Make widget title link' ); ?>
			</label>
		</p>

	<?php }
}

/*-----------------------------------------------------------------------------------*/
// This starts the 300x250 Banner Ad widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'banner300_load_widgets' );

function banner300_load_widgets() {
	register_widget( 'Banner300_Widget' );
}

class Banner300_Widget extends WP_Widget {

	function Banner300_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'banner300', 'description' => __('Adds 300x250 banner ad.', "solostream") );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'banner300-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'banner300-widget', __('300x250 Banner Ad Widget', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$adcode = $instance['adcode'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display ad code. */
		echo $adcode;

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['adcode'] = $new_instance['adcode'];

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Sponsor Ad', "solostream"),
			'adcode' => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

		<!-- adcode: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'adcode' ); ?>"><?php _e('Banner Ad Code:', "solostream"); ?></label>
		<textarea rows="3" id="<?php echo $this->get_field_id( 'adcode' ); ?>" name="<?php echo $this->get_field_name( 'adcode' ); ?>" style="width:100%;"><?php echo $instance['adcode']; ?></textarea></p>

	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
// This starts the Banner Ad widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'bannerad_load_widgets' );

function bannerad_load_widgets() {
	register_widget( 'BannerAd_Widget' );
}

class BannerAd_Widget extends WP_Widget {

	function BannerAd_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'bannerad', 'description' => __('This a widget without any border or padding. You can use this for banner ads.', "solostream") );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'bannerad-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'bannerad-widget', __('Banner Ad Widget', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$banneradcode = $instance['banneradcode'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display ad code. */
		echo $banneradcode;

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['banneradcode'] = $new_instance['banneradcode'];

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Sponsor Ad', "solostream"),
			'banneradcode' => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

		<!-- banneradcode: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'banneradcode' ); ?>"><?php _e('Banner Ad Code:', "solostream"); ?></label>
		<textarea rows="3" id="<?php echo $this->get_field_id( 'banneradcode' ); ?>" name="<?php echo $this->get_field_name( 'banneradcode' ); ?>" style="width:100%;"><?php echo $instance['banneradcode']; ?></textarea></p>

	<?php
	}
}


/*-----------------------------------------------------------------------------------*/
// This starts the Social Media Icons widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'socialicons_load_widgets' );

function socialicons_load_widgets() {
	register_widget( 'Socialicons_Widget' );
}

class Socialicons_Widget extends WP_Widget {

	function Socialicons_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'socialicons', 'description' => __('Adds the Social Media Icons.', "solostream") );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'socialicons-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'socialicons-widget', __('Social Media Icons Widget', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$intro = $instance['intro'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		printf( '<div class="textwidget">' );

		/* Display intro from widget settings if one was input. */
		if ( $intro )
			printf( '<p>' . __('%1$s', "solostream") . '</p>', $intro ); ?>

		<?php include (TEMPLATEPATH . '/sub-icons.php'); ?>

		<?php printf( '</div>' ); ?>

		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and intro to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['intro'] = strip_tags( $new_instance['intro'] );

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */

		$defaults = array(
			'title' => __('Connect', "solostream"),
			'intro' => __('Connect with us on the following social media platforms.', "solostream")
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

		<!-- Intro: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'intro' ); ?>"><?php _e('Introduction:', "solostream"); ?></label>
		<textarea rows="3" id="<?php echo $this->get_field_id( 'intro' ); ?>" name="<?php echo $this->get_field_name( 'intro' ); ?>" style="width:100%;"><?php echo $instance['intro']; ?></textarea></p>

	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
// This starts the YouTube Videos widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'videoslide_load_widgets' );

function videoslide_load_widgets() {
	register_widget( 'VideoSlide_Widget' );
}

class VideoSlide_Widget extends WP_Widget {

	function VideoSlide_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'videoslide', 'description' => __('Adds the YouTube Video slider.', "solostream") );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'videoslide-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'videoslide-widget', __('YouTube Video Widget', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$numvids = $instance['numvids'];
		$ytrss = $instance['ytrss'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Include the Youtube Video slider file. */
		include (TEMPLATEPATH . '/featured-yt-vids.php');

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['numvids'] = $new_instance['numvids'];
		$instance['ytrss'] = $new_instance['ytrss'];

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Recent YouTube Videos', "solostream"),
			'numvids' => '5',
			'ytrss' => 'http://www.youtube.com/rss/user/mdp8593/videos.rss');

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

		<p><label for="<?php echo $this->get_field_id( 'numvids' ); ?>"><?php _e('Number of YouTube videos to show:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'numvids' ); ?>" name="<?php echo $this->get_field_name( 'numvids' ); ?>" value="<?php echo $instance['numvids']; ?>" style="width:100%;" /></p>

		<!-- ytrss: Textarea Input -->
		<p><label for="<?php echo $this->get_field_id( 'ytrss' ); ?>"><?php _e('Youtube RSS Feed:', "solostream"); ?></label>
		<textarea rows="3" id="<?php echo $this->get_field_id( 'ytrss' ); ?>" name="<?php echo $this->get_field_name( 'ytrss' ); ?>" style="width:100%;"><?php echo $instance['ytrss']; ?></textarea></p>

	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
// This starts the Featured Posts widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'featposts_load_widgets' );

function featposts_load_widgets() {
	register_widget( 'Featposts_Widget' );
}

class Featposts_Widget extends WP_Widget {

	function Featposts_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'featposts', 'description' => __('Displays multiple posts with a specific tag; include thumbnail and excerpt.', "solostream") );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'featposts-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'featposts-widget', __('Featured Posts Widget', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		global $post;
		$post_old = $post; // Save the post object.

		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$tag = $instance['tag'];

		// Get array of post info.
		$feat_posts = new WP_Query("showposts=" . $instance["num"] . "&tag=" . $tag);

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		// Post list
		echo "<div class='cat-posts-widget textwidget'>\n";

		while ( $feat_posts->have_posts() )
		{
			$feat_posts->the_post();
		?>
				<div class="post">
					<div class="entry clearfix">
						<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_thumbnail(); ?></a>
						<h3 class="post-title"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h3>
						<?php include (TEMPLATEPATH . "/postinfo.php"); ?>
						<?php the_excerpt(); ?>
					</div>
					<div style="clear:both;"></div>
				</div>
		<?php }

		echo "</div>\n";

		echo $after_widget;

		$post = $post_old; // Restore the post object.
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['num'] = $new_instance['num'];
		$instance['tag'] = $new_instance['tag'];

		return $instance;
	}

	function form($instance) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('Featured Posts', "solostream"),
			'tag' => 'featured',
			'num' => '3'
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id("title"); ?>">
				<?php _e( 'Title' ); ?>:
				<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" />
			</label>
		</p>


		<p>
			<label for="<?php echo $this->get_field_id('tag'); ?>"><?php _e('Show Posts With This Tag', 'solostream'); ?>:</label>
			<input type="text" id="<?php echo $this->get_field_id('tag'); ?>" name="<?php echo $this->get_field_name('tag'); ?>" value="<?php echo esc_attr( $instance['tag'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id("num"); ?>">
				<?php _e('Number of Posts to Show'); ?>:
				<input style="text-align: center;" id="<?php echo $this->get_field_id("num"); ?>" name="<?php echo $this->get_field_name("num"); ?>" type="text" value="<?php echo absint($instance["num"]); ?>" size='3' />
			</label>
		</p>

	<?php }
}

/*-----------------------------------------------------------------------------------*/
// This starts the Featured Post Widget.
/*-----------------------------------------------------------------------------------*/

add_action('widgets_init', create_function('', "register_widget('Featured_Post');"));

class Featured_Post  extends WP_Widget {

	function Featured_Post () {
		$widget_ops = array( 'classname' => 'featuredpage', 'description' => __('Displays a single featured post with thumbnail and excerpt.', 'solostream') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'featured-post' );
		$this->WP_Widget( 'featured-post', __('Featured Post', 'solostream'), $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);

		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
			'post_id' => '',
			'show_image' => 0,
			'image_alignment' => '',
			'image_size' => '',
			'show_title' => 0,
			'show_content' => 0,
			'content_limit' => '',
			'more_text' => ''
		));

		echo $before_widget;

		$featured_post = new WP_Query(array('p' => $instance['post_id']));
		if($featured_post->have_posts()) : while($featured_post->have_posts()) : $featured_post->the_post(); ?>

			<?php if (!empty($instance['show_title'])) : ?>
				<?php echo $before_title . '<a href="' . get_permalink() . '">' . apply_filters('widget_title', get_the_title()) . '</a>' . $after_title; ?>
			<?php elseif (!empty($instance['title'])) : ?>
				<?php echo $before_title . '<a href="' . get_permalink() . '">' . apply_filters('widget_title', $instance['title']) . '</a>' . $after_title; ?>
			<?php endif; ?>

			<div class="post clearfix">

				<?php global $post; if(!empty($instance['show_image'])) : ?>
					<?php if ($instance['image_alignment'] == "" ) {
						$featimgsizefeatpage = 'featured-page';
					} else {
						$featimgsizefeatpage = 'thumbnail';
					}
					$solostream_img = get_the_image(array(
						'meta_key' => $featimgsizefeatpage,
						'size' => $featimgsizefeatpage,
						'default_image' => false,
						'format' => 'array',
						'image_scan' => true,
						'link_to_post' => false, ));
					if ( $solostream_img['url'] && get_option('solostream_show_thumbs') == 'yes' && get_post_meta( $post->ID, 'remove_thumb', true ) != 'Yes' ) {
						if ( $instance['image_alignment'] == "" ) { ?>
							<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><img class="thumbnail" src="<?php echo $solostream_img['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a>
						<?php } else { ?>
							<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><img class="thumbnail <?php echo $instance['image_alignment']; ?>" src="<?php echo $solostream_img['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a>
						<?php }
					} ?>
				<?php endif; ?>

				<?php if(!empty($instance['show_content'])) : ?>
					<span class="featpage-excerpt"><?php $excerpt = get_the_excerpt(); echo string_limit_words($excerpt,$instance['content_limit']); ?></span>
				<?php endif; ?>

				<?php if(!empty($instance['more_text'])) : ?>
					 <span class="featpage-excerpt"><a class="more-link" href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php echo esc_html( $instance['more_text'] ); ?></a></span>
				<?php endif; ?>

			</div>

		<?php endwhile; endif;

		echo $after_widget;
		wp_reset_query();
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['post_id'] = $new_instance['post_id'];
		$instance['show_image'] = $new_instance['show_image'];
		$instance['image_alignment'] = $new_instance['image_alignment'];
		$instance['image_size'] = $new_instance['image_size'];
		$instance['show_title'] = $new_instance['show_title'];
		$instance['show_content'] = $new_instance['show_content'];
		$instance['content_limit'] = $new_instance['content_limit'];
		$instance['more_text'] = strip_tags( $new_instance['more_text'] );

		return $instance;
	}

	function form($instance) {

		$defaults = array(
			'title' => '',
			'post_id' => '',
			'show_image' => 0,
			'image_alignment' => '',
			'image_size' => '',
			'show_title' => 0,
			'show_content' => 0,
			'content_limit' => '30',
			'more_text' => '... Read More'
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'solostream'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:95%;" /></p>

		<p><label for="<?php echo $this->get_field_id('post_id'); ?>"><?php _e('Post ID', 'solostream'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('post_id'); ?>" name="<?php echo $this->get_field_name('post_id'); ?>" value="<?php echo esc_attr( $instance['post_id'] ); ?>" /></p>

		<p><input id="<?php echo $this->get_field_id('show_image'); ?>" type="checkbox" name="<?php echo $this->get_field_name('show_image'); ?>" value="1" <?php checked(1, $instance['show_image']); ?>/> <label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e('Show Post Image', 'solostream'); ?></label></p>

		<p><label for="<?php echo $this->get_field_id('image_alignment'); ?>"><?php _e('Image Alignment', 'solostream'); ?>:</label>
		<select id="<?php echo $this->get_field_id('image_alignment'); ?>" name="<?php echo $this->get_field_name('image_alignment'); ?>">
			<option style="padding-right:10px;" value="">- <?php _e('Top', 'solostream'); ?> -</option>
			<option style="padding-right:10px;" value="alignleft" <?php selected('alignleft', $instance['image_alignment']); ?>>- <?php _e('Left', 'solostream'); ?> -</option>
			<option style="padding-right:10px;" value="alignright" <?php selected('alignright', $instance['image_alignment']); ?>>- <?php _e('Right', 'solostream'); ?> -</option>
		</select></p>

		<p><input id="<?php echo $this->get_field_id('show_title'); ?>" type="checkbox" name="<?php echo $this->get_field_name('show_title'); ?>" value="1" <?php checked(1, $instance['show_title']); ?>/> <label for="<?php echo $this->get_field_id('show_title'); ?>"><?php _e('Show Post Title in Place of Widget Title', 'solostream'); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('show_content'); ?>" type="checkbox" name="<?php echo $this->get_field_name('show_content'); ?>" value="1" <?php checked(1, $instance['show_content']); ?>/> <label for="<?php echo $this->get_field_id('show_content'); ?>"><?php _e('Show Post Content', 'solostream'); ?></label></p>

		<p><label for="<?php echo $this->get_field_id('content_limit'); ?>"><?php _e('Word Limit', 'solostream'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('content_limit'); ?>" name="<?php echo $this->get_field_name('content_limit'); ?>" value="<?php echo esc_attr( $instance['content_limit'] ); ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id('more_text'); ?>"><?php _e('Read More Text', 'solostream'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('more_text'); ?>" name="<?php echo $this->get_field_name('more_text'); ?>" value="<?php echo esc_attr( $instance['more_text'] ); ?>" /></p>

	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
// This starts the Featured Page Widget.
/*-----------------------------------------------------------------------------------*/

add_action('widgets_init', create_function('', "register_widget('Featured_Page');"));

class Featured_Page extends WP_Widget {

	function Featured_Page() {
		$widget_ops = array( 'classname' => 'featuredpage', 'description' => __('Displays a featured page with thumbnail and excerpt.', 'solostream') );
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'featured-page' );
		$this->WP_Widget( 'featured-page', __('Featured Page', 'solostream'), $widget_ops, $control_ops );
	}

	function widget($args, $instance) {
		extract($args);

		$instance = wp_parse_args( (array)$instance, array(
			'title' => '',
			'page_id' => '',
			'show_image' => 0,
			'image_alignment' => '',
			'image_size' => '',
			'show_title' => 0,
			'show_content' => 0,
			'content_limit' => '',
			'more_text' => ''
		));

		echo $before_widget;

		$featured_page = new WP_Query(array('page_id' => $instance['page_id']));
		if($featured_page->have_posts()) : while($featured_page->have_posts()) : $featured_page->the_post(); ?>

			<?php if (!empty($instance['show_title'])) : ?>
				<?php echo $before_title . '<a href="' . get_permalink() . '">' . apply_filters('widget_title', get_the_title()) . '</a>' . $after_title; ?>
			<?php elseif (!empty($instance['title'])) : ?>
				<?php echo $before_title . '<a href="' . get_permalink() . '">' . apply_filters('widget_title', $instance['title']) . '</a>' . $after_title; ?>
			<?php endif; ?>

			<div class="post clearfix">

				<?php global $post; if(!empty($instance['show_image'])) : ?>
					<?php if ($instance['image_alignment'] == "" ) {
						$featimgsizefeatpage = 'featured-page';
					} else {
						$featimgsizefeatpage = 'thumbnail';
					}
					$solostream_img = get_the_image(array(
						'meta_key' => $featimgsizefeatpage,
						'size' => $featimgsizefeatpage,
						'default_image' => false,
						'format' => 'array',
						'image_scan' => true,
						'link_to_post' => false, ));
					if ( $solostream_img['url'] && get_option('solostream_show_thumbs') == 'yes' && get_post_meta( $post->ID, 'remove_thumb', true ) != 'Yes' ) {
						if ( $instance['image_alignment'] == "" ) { ?>
							<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><img class="thumbnail" src="<?php echo $solostream_img['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a>
						<?php } else { ?>
							<a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><img class="thumbnail <?php echo $instance['image_alignment']; ?>" src="<?php echo $solostream_img['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" /></a>
						<?php }
					} ?>
				<?php endif; ?>

				<?php if(!empty($instance['show_content'])) : ?>
					<span class="featpage-excerpt"><?php $excerpt = get_the_excerpt(); echo string_limit_words($excerpt,$instance['content_limit']); ?></span>
				<?php endif; ?>

				<?php if(!empty($instance['more_text'])) : ?>
					 <span class="featpage-excerpt"><a class="more-link" href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php echo esc_html( $instance['more_text'] ); ?></a></span>
				<?php endif; ?>

			</div>

		<?php endwhile; endif;

		echo $after_widget;
		wp_reset_query();
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['page_id'] = $new_instance['page_id'];
		$instance['show_image'] = $new_instance['show_image'];
		$instance['image_alignment'] = $new_instance['image_alignment'];
		$instance['image_size'] = $new_instance['image_size'];
		$instance['show_title'] = $new_instance['show_title'];
		$instance['show_content'] = $new_instance['show_content'];
		$instance['content_limit'] = $new_instance['content_limit'];
		$instance['more_text'] = strip_tags( $new_instance['more_text'] );

		return $instance;
	}

	function form($instance) {

		$defaults = array(
			'title' => '',
			'page_id' => '',
			'show_image' => 0,
			'image_alignment' => '',
			'image_size' => '',
			'show_title' => 0,
			'show_content' => 0,
			'content_limit' => '30',
			'more_text' => '... Read More'
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'solostream'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" style="width:95%;" /></p>

		<p><label for="<?php echo $this->get_field_id('page_id'); ?>"><?php _e('Page', 'solostream'); ?>:</label>
		<?php wp_dropdown_pages(array('name' => $this->get_field_name('page_id'), 'selected' => $instance['page_id'])); ?></p>

		<p><input id="<?php echo $this->get_field_id('show_image'); ?>" type="checkbox" name="<?php echo $this->get_field_name('show_image'); ?>" value="1" <?php checked(1, $instance['show_image']); ?>/> <label for="<?php echo $this->get_field_id('show_image'); ?>"><?php _e('Show Page Image', 'solostream'); ?></label></p>

		<p><label for="<?php echo $this->get_field_id('image_alignment'); ?>"><?php _e('Image Alignment', 'solostream'); ?>:</label>
		<select id="<?php echo $this->get_field_id('image_alignment'); ?>" name="<?php echo $this->get_field_name('image_alignment'); ?>">
			<option style="padding-right:10px;" value="">- <?php _e('Top', 'solostream'); ?> -</option>
			<option style="padding-right:10px;" value="alignleft" <?php selected('alignleft', $instance['image_alignment']); ?>>- <?php _e('Left', 'solostream'); ?> -</option>
			<option style="padding-right:10px;" value="alignright" <?php selected('alignright', $instance['image_alignment']); ?>>- <?php _e('Right', 'solostream'); ?> -</option>
		</select></p>

		<p><input id="<?php echo $this->get_field_id('show_title'); ?>" type="checkbox" name="<?php echo $this->get_field_name('show_title'); ?>" value="1" <?php checked(1, $instance['show_title']); ?>/> <label for="<?php echo $this->get_field_id('show_title'); ?>"><?php _e('Show Page Title in Place of Widget Title', 'solostream'); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('show_content'); ?>" type="checkbox" name="<?php echo $this->get_field_name('show_content'); ?>" value="1" <?php checked(1, $instance['show_content']); ?>/> <label for="<?php echo $this->get_field_id('show_content'); ?>"><?php _e('Show Page Content', 'solostream'); ?></label></p>

		<p><label for="<?php echo $this->get_field_id('content_limit'); ?>"><?php _e('Word Limit', 'solostream'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('content_limit'); ?>" name="<?php echo $this->get_field_name('content_limit'); ?>" value="<?php echo esc_attr( $instance['content_limit'] ); ?>" size="3" /></p>

		<p><label for="<?php echo $this->get_field_id('more_text'); ?>"><?php _e('Read More Text', 'solostream'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('more_text'); ?>" name="<?php echo $this->get_field_name('more_text'); ?>" value="<?php echo esc_attr( $instance['more_text'] ); ?>" /></p>

	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
// This starts the Welcome Box widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'welcomebox_load_widgets' );

function welcomebox_load_widgets() {
	register_widget( 'WelcomeBox_Widget' );
}

class WelcomeBox_Widget extends WP_Widget {

	function WelcomeBox_Widget() {

		/* Widget settings. */
		$widget_ops = array( 'classname' => 'welcomebox', 'description' => __('Adds the Welcome Box.', "solostream") );

		/* Widget control settings. */
		$control_ops = array( 'width' => 400, 'height' => 700, 'id_base' => 'welcomebox-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'welcomebox-widget', __('Welcome Box Widget', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$message = $instance['message'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Display message from widget settings if one was input. */
		if ( $message )
			printf( '<div class="welcome-message">' . __('%1$s', "solostream") . '</div>', $message ); ?>

		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['message'] = $new_instance['message'];
		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array(
			'title' => __('', "solostream"),
			'message' => __('', "solostream")
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

		<!-- Message: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'message' ); ?>"><?php _e('Welcome Message:', "solostream"); ?></label>
		<textarea rows="16" id="<?php echo $this->get_field_id( 'message' ); ?>" name="<?php echo $this->get_field_name( 'message' ); ?>" style="width:100%;"><?php echo $instance['message']; ?></textarea></p>

	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
// This starts the Category Slider Widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'catslide_load_widgets' );

function catslide_load_widgets() {
	register_widget( 'Catslide_Widget' );
}

class Catslide_Widget extends WP_Widget {

	function Catslide_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'catslide', 'description' => __('Shows content slider with posts from selected category.', "solostream") );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'catslide-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'catslide-widget', __('Featured Category Slider', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {

		extract( $args );

		// If no title, use the name of the category.
		if( !$instance["title"] ) {
			$category_info = get_category($instance["cat"]);
			$instance["title"] = $category_info->name;
		}

		/* Before widget (defined by themes). */
		echo $before_widget;

		$uniqueid = substr(md5(rand(0, 1000000)), 0, 4);
		$slideitems = $instance["slideitems"]; ?>

		<script type="text/javascript">
		//<![CDATA[

			(function() {

				// store the slider in a local variable
				var $window = jQuery(window),flexslider;

				function getSlideItems() {
					return (window.innerWidth < 353) ? 1 :
					(window.innerWidth < 769) ? 2 :
					(window.innerWidth < 961) ? 3 : <?php echo $instance["slideitems"]; ?>;
				}

				jQuery(window).load(function() {
					jQuery('#featured-cat-thumbnav-<?php echo $uniqueid; ?>').flexslider({
						animationLoop:true,
						animationSpeed:300,
						animation:'slide',
						slideshow: false,
						smoothHeight:true,
						controlNav:false,
						useCSS:false,
						itemWidth:100,
						itemMargin:0,
						minItems: getSlideItems(),
						maxItems: getSlideItems()
					});
				});

				// check grid size on resize event
				jQuery(window).resize(function() {
					var gridSize = getSlideItems();
				});

			}());

		//]]>
		</script>

		<div class="featured cat">

			<?php // Widget title
				echo $before_title;
				if( $instance['title_link'] && $instance["cat"]  )
					echo '<a href="' . get_category_link($instance["cat"]) . '">' . $instance["title"] . '</a>';
				else
					echo $instance["title"];
				echo $after_title;
			?>

			<?php if($instance["description"])
				echo '<div class="catslide-description">' . esc_html($instance["description"]) . '</div>';
			?>

			<div id="featured-cat-thumbnav-<?php echo $uniqueid; ?>" class="myflexslider thumbnav <?php echo $instance["cat"]; ?>">

				<ul class="slides">

					<?php
						global $post;
						global $do_not_duplicate;
						$count = 1;
						if ( empty($instance["nodupes"]) ) { $do_not_duplicate = NULL; }
						$my_query = new WP_Query(array(
							'post__not_in' =>  $do_not_duplicate,
							'cat' => $instance["cat"],
							'posts_per_page' => $instance["num"],
						));
						while ($my_query->have_posts()) : $my_query->the_post();
						$do_not_duplicate[] = $post->ID;
					?>

					<li>

						<div class="cat-container">

							<?php if ($instance["post_image"]) { ?>
								<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php solostream_catslide_thumbnail(); ?></a>
							<?php } ?>

							<div class="catslide-content">

								<?php if ($instance["post_title"]) { ?>
									<h3 class="post-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h3>
								<?php } ?>

								<?php if ( $instance["post_author"] || $instance["post_date"] || $instance["post_cats"] || $instance["post_comments"] ) { ?>
									<ul class="catslide-meta clearfix">
										<?php if ($instance["post_author"]) { ?><li class="catslide-author"><?php the_author_posts_link(); ?></li><?php }
										if ($instance["post_date"]) { ?><li class="catslide-date"><?php the_time( get_option( 'date_format' ) ); ?></li><?php }
										if ($instance["post_cat"]) { ?><li class="catslide-cat"><?php the_category(', '); ?></li><?php }
										if ($instance["post_comments"]) { ?><li class="catslide-comment"><a href="<?php comments_link(); ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Comments for", "solostream"); ?> <?php the_title(); ?>"><?php comments_number(__("0 Comments", "solostream"), __("1 Comment", "solostream"), __("% Comments", "solostream")); ?></a></li><?php } ?>
									</ul>
								<?php } ?>

								<?php if ($instance["show_content"] || $instance["read_more"]) { ?>
									<p class="catslide-excerpt">
										<?php if ($instance["show_content"]) { ?><?php $excerpt = get_the_excerpt(); echo string_limit_words($excerpt,$instance['content_limit']); ?><?php } ?>
										<?php if ($instance["read_more"]) { ?><a class="more-link" href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php echo esc_html( $instance['more_text'] ); ?></a><?php } ?>
									</p>
								<?php } ?>

							</div>

						</div>

					</li>

					<?php $count = $count + 1; endwhile; ?>

				</ul>

			</div>

		</div>

		<?php if ( $instance['bottomline'] )
			printf( '<div class="column-clear line"></div>' );

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title and name to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['description'] = strip_tags( $new_instance['description'] );
		$instance['cat'] = $new_instance['cat'];
		$instance['slideitems'] = $new_instance['slideitems'];
		$instance['num'] = $new_instance['num'];
		$instance['title_link'] = $new_instance['title_link'];
		$instance['post_image'] = $new_instance['post_image'];
		$instance['post_title'] = $new_instance['post_title'];
		$instance['show_content'] = $new_instance['show_content'];
		$instance['content_limit'] = $new_instance['content_limit'];
		$instance['read_more'] = strip_tags( $new_instance['read_more'] );
		$instance['more_text'] = strip_tags( $new_instance['more_text'] );
		$instance['post_author'] = $new_instance['post_author'];
		$instance['post_date'] = $new_instance['post_date'];
		$instance['post_cat'] = $new_instance['post_cat'];
		$instance['post_comments'] = $new_instance['post_comments'];
		$instance['bottomline'] = strip_tags( $new_instance['bottomline'] );
		$instance['nodupes'] = $new_instance['nodupes'];

		$instance['content_limit'] = strip_tags( $new_instance['content_limit'] );

		return $instance;
	}

	function form($instance) {

		/* Set up some default widget settings. */

		$defaults = array(
			'title' => __('Featured Items', "solostream"),
			'description' => '',
			'cat' => '0',
			'slideitems' => '1',
			'num' => '10',
			'title_link' => 'on',
			'post_image' => 'on',
			'post_title' => 'on',
			'show_content' => 'on',
			'content_limit' => '20',
			'read_more' => 'on',
			'more_text' => ' ... Read More',
			'post_author' => 'on',
			'post_date' => 'on',
			'post_cat' => 'on',
			'post_comments' => 'on',
			'bottomline' => '',
			'nodupes' => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p><label for="<?php echo $this->get_field_id("title"); ?>"><?php _e('Title:'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id("title"); ?>" name="<?php echo $this->get_field_name("title"); ?>" type="text" value="<?php echo esc_attr($instance["title"]); ?>" /></p>

		<p><label for="<?php echo $this->get_field_id('description'); ?>"><?php _e('Optional Description:', 'solostream'); ?></label>
		<textarea rows="3" id="<?php echo $this->get_field_id('description'); ?>" name="<?php echo $this->get_field_name('description'); ?>" style="width:100%;"><?php echo $instance['description']; ?></textarea></p>

		<p><label for="<?php echo $this->get_field_id("cat"); ?>"><?php _e('Category:'); ?></label>
		<?php wp_dropdown_categories(array(
			'show_option_all' => 'All',
			'name' => $this->get_field_name("cat"),
			'selected' => $instance["cat"],
			'hide_empty' => false
		)); ?></p>

		<p><label for="<?php echo $this->get_field_id('slideitems'); ?>"><?php _e('Number of Posts Per Slide:', 'solostream'); ?>:</label>
		<select id="<?php echo $this->get_field_id('slideitems'); ?>" name="<?php echo $this->get_field_name('slideitems'); ?>">
			<option style="padding:5px;" value="1"> 1 </option>
			<option style="padding:5px;" value="2" <?php selected('2', $instance['slideitems']); ?>> 2 </option>
			<option style="padding:5px;" value="3" <?php selected('3', $instance['slideitems']); ?>> 3 </option>
		</select></p>

		<p><label for="<?php echo $this->get_field_id('num'); ?>"><?php _e('Total Number of Posts:', 'solostream'); ?></label>
		<input style="text-align: center;" id="<?php echo $this->get_field_id('num'); ?>" name="<?php echo $this->get_field_name('num'); ?>" type="text" value="<?php echo absint($instance['num']); ?>" size='3' /></p>

		<p><input id="<?php echo $this->get_field_id('title_link'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('title_link'); ?>"<?php checked( (bool) $instance['title_link'], true ); ?> />
		<label for="<?php echo $this->get_field_id("title_link"); ?>"><?php _e('Make Widget Title a Link', 'solostream'); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('post_image'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('post_image'); ?>"<?php checked( (bool) $instance['post_image'], true ); ?> />
		<label for="<?php echo $this->get_field_id("post_title"); ?>"><?php _e('Show Post Image', 'solostream'); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('post_title'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('post_title'); ?>"<?php checked( (bool) $instance['post_title'], true ); ?> />
		<label for="<?php echo $this->get_field_id("post_title"); ?>"><?php _e('Show Post Title', 'solostream'); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('show_content'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('show_content'); ?>"<?php checked( (bool) $instance['show_content'], true ); ?> />
		<label for="<?php echo $this->get_field_id('show_content'); ?>"><?php _e('Show Post Excerpt', 'solostream'); ?></label></p>

		<p><label for="<?php echo $this->get_field_id('content_limit'); ?>"><?php _e('Excerpt Word Limit', 'solostream'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('content_limit'); ?>" name="<?php echo $this->get_field_name('content_limit'); ?>" value="<?php echo esc_attr( $instance['content_limit'] ); ?>" size="3" /></p>

		<p><input id="<?php echo $this->get_field_id('read_more'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('read_more'); ?>"<?php checked( (bool) $instance['read_more'], true ); ?> />
		<label for="<?php echo $this->get_field_id('read_more'); ?>"><?php _e('Show Read More Link', 'solostream'); ?></label></p>

		<p><label for="<?php echo $this->get_field_id('more_text'); ?>"><?php _e('Read More Text', 'solostream'); ?>:</label>
		<input type="text" id="<?php echo $this->get_field_id('more_text'); ?>" name="<?php echo $this->get_field_name('more_text'); ?>" value="<?php echo esc_attr( $instance['more_text'] ); ?>" /></p>

		<p><input id="<?php echo $this->get_field_id('post_author'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('post_author'); ?>"<?php checked( (bool) $instance['post_author'], true ); ?> />
		<label for="<?php echo $this->get_field_id('post_author'); ?>"><?php _e('Show Post Author', 'solostream'); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('post_date'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('post_date'); ?>"<?php checked( (bool) $instance['post_date'], true ); ?> />
		<label for="<?php echo $this->get_field_id('post_date'); ?>"><?php _e('Show Post Date', 'solostream'); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('post_cat'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('post_cat'); ?>"<?php checked( (bool) $instance['post_cat'], true ); ?> />
		<label for="<?php echo $this->get_field_id('post_cat'); ?>"><?php _e('Show Post Category', 'solostream'); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('post_comments'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('post_comments'); ?>"<?php checked( (bool) $instance['post_comments'], true ); ?> />
		<label for="<?php echo $this->get_field_id('post_comments'); ?>"><?php _e('Show Post Comments', 'solostream'); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('bottomline'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('bottomline'); ?>"<?php checked( (bool) $instance['bottomline'], true ); ?> />
		<label for="<?php echo $this->get_field_id('read_more'); ?>"><?php _e('Add line break to bottom of slider.', 'solostream'); ?></label></p>

		<p><input id="<?php echo $this->get_field_id('nodupes'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('nodupes'); ?>"<?php checked( (bool) $instance['nodupes'], true ); ?> />
		<label for="<?php echo $this->get_field_id('nodupes'); ?>"><?php _e('Eliminate duplicate posts.', 'solostream'); ?></label></p>

	<?php }
}

/*-----------------------------------------------------------------------------------*/
// This starts the Contact Widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'sscontact_load_widgets' );

function sscontact_load_widgets() {
	register_widget( 'SSContact_Widget' );
}

class SSContact_Widget extends WP_Widget {

	function SSContact_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'sscontact', 'description' => __('Adds the Contact Information Widget.', "solostream") );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'sscontact-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'sscontact-widget', __('Contact Information Widget', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {

		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$name = $instance['name'];
		$phone = $instance['phone'];
		$email = $instance['email'];
		$address = $instance['address'];
		$addinfo = $instance['addinfo'];

		/* Before widget (defined by themes). */
		echo $before_widget; ?>

		<div class="contactinfo">
			<div class="contactinfo-inner">
				<?php if ( $title ) { echo $before_title . $title . $after_title; } ?>
				<?php if(!empty($instance['name'])) : ?>
					<span class="name"><?php echo esc_html( $instance['name'] ); ?></span>
				<?php endif; ?>
				<?php if(!empty($instance['phone'])) : ?>
					<span class="phone"><?php echo esc_html( $instance['phone'] ); ?></span>
				<?php endif; ?>
				<?php if(!empty($instance['email'])) : ?>
					<span class="email"><a href="mailto:<?php echo antispambot(esc_html( $instance['email'] )); ?>">Email</a></span>
				<?php endif; ?>
				<?php if(!empty($instance['address'])) : ?>
					<span class="address"><?php echo esc_html( $instance['address'] ); ?></span>
				<?php endif; ?>
				<?php if(!empty($instance['addinfo'])) : ?>
					<span class="addinfo"><?php echo esc_html( $instance['addinfo'] ); ?></span>
				<?php endif; ?>
			</div>
		</div>

		<?php
		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['name'] =  strip_tags( $new_instance['name'] );
		$instance['phone'] =  strip_tags( $new_instance['phone'] );
		$instance['email'] =  strip_tags( $new_instance['email'] );
		$instance['address'] =  strip_tags( $new_instance['address'] );
		$instance['addinfo'] =  strip_tags( $new_instance['addinfo'] );

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */

		$defaults = array(
			'title' => __('Contact Information', "solostream"),
			'name' => '',
			'phone' => '',
			'email' => '',
			'address' => '',
			'addinfo' => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

		<!-- name: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'name' ); ?>"><?php _e('Contact Person:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'name' ); ?>" name="<?php echo $this->get_field_name( 'name' ); ?>" value="<?php echo $instance['name']; ?>" style="width:100%;" /></p>

		<!-- phone: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'phone' ); ?>"><?php _e('Contact Phone#:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php echo $instance['phone']; ?>" style="width:100%;" /></p>

		<!-- email: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e('Contact Email:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php echo $instance['email']; ?>" style="width:100%;" /></p>

		<!-- address: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'address' ); ?>"><?php _e('Contact Address:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>" value="<?php echo $instance['address']; ?>" style="width:100%;" /></p>

		<!-- addinfo: Textarea Input -->
		<p><label for="<?php echo $this->get_field_id( 'addinfo' ); ?>"><?php _e('Additional Info:', "solostream"); ?></label>
		<textarea rows="3" id="<?php echo $this->get_field_id( 'addinfo' ); ?>" name="<?php echo $this->get_field_name( 'addinfo' ); ?>" style="width:100%;"><?php echo $instance['addinfo']; ?></textarea></p>

	<?php
	}
}

/*-----------------------------------------------------------------------------------*/
// This starts the Full-Width Featured Posts Slider widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'widepostslider_load_widgets' );

function widepostslider_load_widgets() {
	register_widget( 'Widepostslider_Widget' );
}

class Widepostslider_Widget extends WP_Widget {

	function Widepostslider_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widepostslider', 'description' => __('Add the Full-Width Featured Posts slider.', "solostream") );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widepostslider-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'widepostslider-widget', __('Full-Width Featured Posts Slider', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$bottomline = $instance['bottomline'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Call the featured-wide file. */
		get_template_part( 'featured-wide' );

		if ( $bottomline )
			printf( '<div class="column-clear line"></div>' );

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['bottomline'] = strip_tags( $new_instance['bottomline'] );

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */

		$defaults = array(
			'title' => '',
			'bottomline' => ''
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

		<p><input id="<?php echo $this->get_field_id('bottomline'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('bottomline'); ?>"<?php checked( (bool) $instance['bottomline'], true ); ?> />
		<label for="<?php echo $this->get_field_id('read_more'); ?>"><?php _e('Add line break to bottom of slider.', 'solostream'); ?></label></p>

		<p><?php _e("Settings for the Featured Posts slider can be managed via the Theme Settings page.", "solostream"); ?></p>

	<?php }
}

/*-----------------------------------------------------------------------------------*/
// This starts the Full-Width Featured Pages Slider widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'widepageslider_load_widgets' );

function widepageslider_load_widgets() {
	register_widget( 'Widepageslider_Widget' );
}

class Widepageslider_Widget extends WP_Widget {

	function Widepageslider_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'widepageslider', 'description' => __('Add the Full-Width Featured Pages slider.', "solostream") );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'widepageslider-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'widepageslider-widget', __('Full-Width Featured Pages Slider', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$bottomline = $instance['bottomline'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Call the featured-pages file. */
		get_template_part( 'featured-pages' );

		if ( $bottomline )
			printf( '<div class="column-clear line"></div>' );

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['bottomline'] = strip_tags( $new_instance['bottomline'] );

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */

		$defaults = array(
			'title' => '',
			'bottomline' => 'on',
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

		<p><input id="<?php echo $this->get_field_id('bottomline'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('bottomline'); ?>"<?php checked( (bool) $instance['bottomline'], true ); ?> />
		<label for="<?php echo $this->get_field_id('read_more'); ?>"><?php _e('Add line break to bottom of slider.', 'solostream'); ?></label></p>

		<p><?php _e("Settings for the Featured Pages slider can be managed via the Theme Settings page.", "solostream"); ?></p>

	<?php }
}

/*-----------------------------------------------------------------------------------*/
// This starts the Narrow Featured Posts Slider widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'narrowpostslider_load_widgets' );

function narrowpostslider_load_widgets() {
	register_widget( 'Narrowpostslider_Widget' );
}

class Narrowpostslider_Widget extends WP_Widget {

	function Narrowpostslider_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'narrowpostslider', 'description' => __('Add the Narrow Featured Posts slider.', "solostream") );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'narrowpostslider-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'narrowpostslider-widget', __('Narrow Featured Posts Slider', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$bottomline = $instance['bottomline'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		/* Call the featured-narrow file. */
		get_template_part( 'featured-narrow' );

		if ( $bottomline )
			printf( '<div class="column-clear line"></div>' );

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		//Strip tags from title to remove HTML
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['bottomline'] = strip_tags( $new_instance['bottomline'] );

		return $instance;
	}

	function form( $instance ) {

		/* Set up some default widget settings. */

		$defaults = array(
			'title' => '',
			'bottomline' => 'on',
		);

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', "solostream"); ?></label>
		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" /></p>

		<p><input id="<?php echo $this->get_field_id('bottomline'); ?>" type="checkbox" class="checkbox" name="<?php echo $this->get_field_name('bottomline'); ?>"<?php checked( (bool) $instance['bottomline'], true ); ?> />
		<label for="<?php echo $this->get_field_id('read_more'); ?>"><?php _e('Add line break to bottom of slider.', 'solostream'); ?></label></p>

		<p><?php _e("Settings for the Featured Posts slider can be managed via the Theme Settings page.", "solostream"); ?></p>


	<?php }
}

/*-----------------------------------------------------------------------------------*/
// This starts the Line Break Widget.
/*-----------------------------------------------------------------------------------*/

add_action( 'widgets_init', 'mylinebreak_load_widgets' );

function mylinebreak_load_widgets() {
	register_widget( 'MyLineBreak_Widget' );
}

class MyLineBreak_Widget extends WP_Widget {

	function MyLineBreak_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'mylinebreak', 'description' => __('Add a simple line break.', "solostream") );
		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'mylinebreak-widget' );
		/* Create the widget. */
		$this->WP_Widget( 'mylinebreak-widget', __('Line Break', "solostream"), $widget_ops, $control_ops );
	}

	function widget( $args, $instance ) {
		extract( $args );

		/* Before widget (defined by themes). */
		echo $before_widget;

		printf( '<div class="line-break line"></div>' );

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		return $instance;
	}

	function form( $instance ) {

		$defaults = array();

		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p><?php _e("There are no settings for this widget. It merely displays a simple line break.", "solostream"); ?></p>

	<?php }
}

?>