<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" lang="<?php bloginfo('language'); ?>">

<head profile="http://gmpg.org/xfn/11">

<meta http-equiv="X-UA-Compatible" content="IE=edge" />

<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title(' '); ?> <?php if(wp_title(' ', false)) { echo ' : '; } ?><?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />

<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style-font.css" type="text/css" media="screen" />

<?php if ( get_option('solostream_responsive_off') != 'Yes'  ) { ?>
	<!-- Responsive Design Resources -->
	<link rel="stylesheet" href="<?php bloginfo('template_directory'); ?>/style-responsive.css" type="text/css" media="screen" />
	<meta name="viewport" content="width=device-width,initial-scale=1" />
<?php } ?>

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php wp_head(); ?>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>

</head>

<body <?php body_class(); ?>>

<div id="outer-wrap">

	<?php if ( get_option('solostream_show_topnav') != 'no' ) { ?>
		<div id="topnav">
			<div class="limit">
				<ul class="nav clearfix">
					<?php wp_nav_menu(array('container'=>false,'theme_location'=>'topnav','fallback_cb'=>'nav_fallback','items_wrap'=>'%3$s')); ?>
				</ul>
			</div>
		</div>
	<?php } ?>


	<div id="header" class="clearfix">

		<div class="limit clearfix">

			<div id="head-content" class="clearfix">
				<?php if ( get_option('solostream_site_title_option') == 'Image/Logo-Type Title' && get_option('solostream_site_logo_url') ) { ?>
					<div id="logo">
						<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo get_option('solostream_site_logo_url'); ?>" alt="<?php bloginfo('name'); ?>" /></a>
					</div>
				<?php } else { ?>
					<div id="sitetitle">
						<div class="title"><a href="<?php bloginfo('url'); ?>"><?php bloginfo('name'); ?></a></div> 
						<div class="description"><?php bloginfo('description'); ?></div>
					</div>
				<?php } ?>
				<?php get_template_part( 'banner468head' ); ?>
			</div>

			<?php if ( get_option('solostream_show_catnav') == 'yes' ) { ?>
				<div id="catnav">
					<ul class="catnav clearfix">
						<?php wp_nav_menu(array('container'=>false,'theme_location'=>'catnav','fallback_cb'=>'catnav_fallback','items_wrap'=>'%3$s')); ?>
					</ul>
				</div>
			<?php } ?>

		</div>

	</div>

<?php solostream_before_wrap(); ?>

	<div id="wrap">

		<?php get_template_part( 'banner728' ); ?>