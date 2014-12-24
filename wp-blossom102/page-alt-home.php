<?php
/*
Template Name: Alternate Home
*/
?>

<?php global $solostream_options; get_header(); ?>

<?php solostream_before_page(); ?>

		<div id="page" class="clearfix" style="background:transparent;">

			<div class="page-border clearfix" style="background:transparent;">

<?php solostream_before_contentleft(); ?>

<?php solostream_before_content(); ?>

				<div id="alt-home-bottom" class="clearfix maincontent">

					<div class="home-widget-wide top clearfix">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Alt Home Page Full-Width Top') ) : ?>
						<?php endif; ?>
					</div> <!-- End .home-widget-wide div -->

					<div class="home-widget-1">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Alt Home Page Left') ) : ?>
						<?php endif; ?>
					</div> <!-- End .home-widget-1 div -->

					<div class="home-widget-2">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Alt Home Page Middle') ) : ?>
						<?php endif; ?>
					</div> <!-- End .home-widget-2 div -->

					<div class="home-widget-3">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Alt Home Page Right') ) : ?>
						<?php endif; ?>
					</div> <!-- End .home-widget-3 div -->

					<div class="home-widget-wide bottom clearfix">
						<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Alt Home Page Full-Width Bottom') ) : ?>
						<?php endif; ?>
					</div> <!-- End .home-widget-wide div -->

				</div> <!-- End #alt-home-bottom div -->

<?php get_footer(); ?>