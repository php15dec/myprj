<?php global $solostream_options; get_header(); ?>

<?php solostream_before_page(); ?>

		<div id="page" class="clearfix">

			<div class="page-border clearfix">

<?php solostream_before_contentleft(); ?>

				<div id="contentleft" class="clearfix">

<?php if ($solostream_options['solostream_layout'] !== "Sidebar-Narrow | Content" && $solostream_options['solostream_layout'] !== "Content | Sidebar-Narrow") { ?>
	<?php solostream_before_content(); ?>
<?php } ?>

					<div id="content" class="clearfix">

<?php if ($solostream_options['solostream_layout'] == "Sidebar-Narrow | Content" || $solostream_options['solostream_layout'] == "Content | Sidebar-Narrow") { ?>
	<?php solostream_before_content(); ?>
<?php } ?>

<?php solostream_after_open_content(); ?>

						<?php if ( function_exists('yoast_breadcrumb') && !is_home() && !is_front_page() ) { 
							yoast_breadcrumb('<p id="breadcrumbs">','</p>'); 
						} ?>

						<?php get_template_part( 'banner468' ); ?>