<?php

/*-----------------------------------------------------------------------------------*/
// Add theme support for Featured Images/Post Thumnbnails
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_theme_support' ) ) {
	add_theme_support( 'post-thumbnails' );
}

/*-----------------------------------------------------------------------------------*/
// Load Get the Image Plugin if Not Already Installed
/*-----------------------------------------------------------------------------------*/

if ( !function_exists('get_the_image')) { 
	require_once( trailingslashit( get_template_directory() ) . 'plugins/get-the-image.php' );
}

/*-----------------------------------------------------------------------------------*/
// Load Regenerate Thumbnails Plugin if Not Already Installed
/*-----------------------------------------------------------------------------------*/

if ( !function_exists('RegenerateThumbnails')) { 
	require_once( trailingslashit( get_template_directory() ) . 'plugins/regenerate-thumbnails/regenerate-thumbnails.php' );
}

/*-----------------------------------------------------------------------------------*/
// Add featured image sizes
/*-----------------------------------------------------------------------------------*/

if ( function_exists( 'add_image_size' ) ) { 
	add_image_size('narrow-featured-image', 680, 300, true);
	add_image_size('wide-featured-image', 800, 450, true);
	add_image_size('wide-thumbnail', 675, 240, true);
	add_image_size('small-wide-thumbnail', 352, 198, true);
	add_image_size('thumbnav', 140, 90, true);
	add_image_size('featured-page', 400, 160, true);
}

/*-----------------------------------------------------------------------------------*/
// Adds full-width class to featured posts
/*-----------------------------------------------------------------------------------*/

function solostream_featureclass() {
	$featureclass = '';
	global $post;
	if (has_tag('full-image')) { 
		$featureclass = ' class="full-width"';
	} else {
		$featureclass = '';
	}
	return $featureclass;
}

/*-----------------------------------------------------------------------------------*/
// Function to get thumbnail
/*-----------------------------------------------------------------------------------*/

function solostream_thumbnail() {
	global $post;
	if (get_option('solostream_default_thumbs') == 'yes') { 
		$defthumb = get_bloginfo('template_directory') . '/images/def-thumb.jpg';
	} else {
		$defthumb = false;
	}
	$solostream_img = get_the_image(array(
		'meta_key' => 'thumbnail',
		'size' => 'thumbnail',
		'default_image' => $defthumb,
		'format' => 'array',
		'image_scan' => true,
		'link_to_post' => false
	));
	if ( $solostream_img['url'] && get_option('solostream_show_thumbs') == 'yes' && get_post_meta( $post->ID, 'remove_thumb', true ) != 'Yes' ) { ?>
		<img class="thumbnail" src="<?php echo $solostream_img['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
	<?php }
}

/*-----------------------------------------------------------------------------------*/
// Function to get thumb-nav thumbnail
/*-----------------------------------------------------------------------------------*/

function solostream_thumbnav() {
	global $post;
	if (get_option('solostream_default_thumbs') == 'yes') { 
		$defthumb = get_bloginfo('template_directory') . '/images/def-thumb2.jpg';
	} else {
		$defthumb = false;
	}
	$solostream_img = get_the_image(array(
		'meta_key' => 'thumbnav',
		'size' => 'thumbnav',
		'default_image' => false,
		'format' => 'array',
		'image_scan' => true,
		'link_to_post' => false
	));
	if ( $solostream_img['url'] && get_option('solostream_show_thumbs') == 'yes' && get_post_meta( $post->ID, 'remove_thumb', true ) != 'Yes' ) { ?>
		<img class="thumbnail thumbnav" src="<?php echo $solostream_img['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
	<?php }
}

/*-----------------------------------------------------------------------------------*/
// Function to get wide-thumbnail
/*-----------------------------------------------------------------------------------*/

function solostream_wide_thumbnail() {
	global $post;
	$solostream_img = get_the_image(array(
		'meta_key' => 'wide-thumbnail',
		'size' => 'wide-thumbnail',
		'default_image' => false,
		'format' => 'array',
		'image_scan' => true,
		'link_to_post' => false
	));
	if ( $solostream_img['url'] && get_option('solostream_show_thumbs') == 'yes' && get_post_meta( $post->ID, 'remove_thumb', true ) != 'Yes' ) { ?>
		<img class="thumbnail wide" src="<?php echo $solostream_img['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
	<?php }
}

/*-----------------------------------------------------------------------------------*/
// Function to get small wide-thumbnail
/*-----------------------------------------------------------------------------------*/

function solostream_small_wide_thumbnail() {
	global $post;
	$solostream_img = get_the_image(array(
		'meta_key' => 'small-wide-thumbnail',
		'size' => 'small-wide-thumbnail',
		'default_image' => false,
		'format' => 'array',
		'image_scan' => true,
		'link_to_post' => false
	));
	if ( $solostream_img['url'] && get_option('solostream_show_thumbs') == 'yes' && get_post_meta( $post->ID, 'remove_thumb', true ) != 'Yes' ) { ?>
		<img class="thumbnail wide small" src="<?php echo $solostream_img['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
	<?php }
}

/*-----------------------------------------------------------------------------------*/
// Function to get catslide-thumbnail
/*-----------------------------------------------------------------------------------*/

function solostream_catslide_thumbnail() {
	global $post;
	$solostream_img = get_the_image(array(
		'meta_key' => 'catslide-thumbnail',
		'size' => 'small-wide-thumbnail',
		'default_image' => false,
		'format' => 'array',
		'image_scan' => true,
		'link_to_post' => false
	));
	if ( $solostream_img['url'] ) { ?>
		<img class="catslide-thumbnail" src="<?php echo $solostream_img['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
	<?php }
}

/*-----------------------------------------------------------------------------------*/
// Function to get the featured image for narrow featured content slider
/*-----------------------------------------------------------------------------------*/

function solostream_feature_image() {
	global $post;
	$featimgsize = 'narrow-featured-image';
	$solostream_img = get_the_image(array(
		'meta_key' => $featimgsize,
		'size' => $featimgsize,
		'default_image' => false,
		'format' => 'array',
		'image_scan' => true,
		'link_to_post' => false 
	));
	if ( $solostream_img['url'] && get_post_meta( $post->ID, 'remove_thumb', true ) != 'Yes' ) { ?>
		<img src="<?php echo $solostream_img['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
	<?php }
}

/*-----------------------------------------------------------------------------------*/
// Function to get the featured image for wide featured content slider
/*-----------------------------------------------------------------------------------*/

function solostream_feature_image_wide() {
	global $post;
	$featimgsizewide = 'wide-featured-image';
	$solostream_img = get_the_image(array(
		'meta_key' => $featimgsizewide,
		'size' => $featimgsizewide,
		'default_image' => false,
		'format' => 'array',
		'image_scan' => true,
		'link_to_post' => false 
	));
	if ( $solostream_img['url'] && get_post_meta( $post->ID, 'remove_thumb', true ) != 'Yes' ) { ?>
		<img src="<?php echo $solostream_img['url']; ?>" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
	<?php }
}

?>