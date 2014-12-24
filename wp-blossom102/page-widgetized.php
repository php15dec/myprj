<?php
/*
Template Name: Widgetized Page
*/
?>

<?php get_template_part( 'content', 'before' ); ?>

						<div id="widgetized-page" class="clearfix">

							<div class="page-widget-wide top clearfix">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Widgetized Page Full-Width Top') ) : ?>
								<?php endif; ?>
							</div> <!-- End .page-widget-wide div -->

							<div class="page-widget-1">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Widgetized Page Left') ) : ?>
								<?php endif; ?>
							</div> <!-- End .page-widget-1 div -->

							<div class="page-widget-2">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Widgetized Page Right') ) : ?>
								<?php endif; ?>
							</div> <!-- End .page-widget-2 div -->

							<div class="page-widget-wide bottom clearfix">
								<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('Widgetized Page Full-Width Bottom') ) : ?>
								<?php endif; ?>
							</div> <!-- End .page-widget-wide div -->

						</div> <!-- End #widgetized-page div -->

<?php get_template_part( 'content', 'after' ); ?>