<div class="featured wide pages">

	<div id="featured-pages" class="myflexslider pages-slider">

		<ul class="slides">

<?php
global $do_not_duplicate;
$featpages = get_option('solostream_featpage_ids');
$featarr=split(",",$featpages);
$featarr = array_diff($featarr, array(""));
$count = 1;
foreach ( $featarr as $featitem ) {

	$my_query = new WP_Query(array(
		'post_type' => array('post', 'page'),
		'page_id' => $featitem
	));

	while ($my_query->have_posts()) : $my_query->the_post();
	$do_not_duplicate[] = $post->ID;

	// Grab the Video Embed Code if there is one.
	$embed = get_post_meta( $post->ID, 'video_embed', true);

	// Extract the Vimeo video ID from the Video Embed Code (if there is one), and create a proper Vimeo video URL.
	$vimurl = '';
	if (preg_match('/player\.vimeo\.com\/video\/([0-9]{1,10})/', $embed, $vimid)) { $vimid = $vimid[1]; }
	if ($vimid) { $vimurl = 'http://player.vimeo.com/video/' . $vimid . '?api=1&amp;player_id=pages_player_' . $count . '&amp;byline=0&amp;portrait=0&amp;title=0'; }

	// Extract the Youtube video ID from the Video Embed Code (if there is one), and create a proper Youtube video URL.
	$yturl = '';
	if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $embed, $ytid)) { $ytid = $ytid[1]; }
	if ($ytid) { $yturl = 'http://www.youtube.com/embed/' . $ytid . '?modestbranding=1&amp;controls=2&amp;rel=0&amp;showinfo=0'; }
?>

	    		<li id="pages-feature-post-<?php echo $count; ?>">

				<div class="slide-container clearfix">

					<?php if ( $embed ) { ?>
						<div class="feature-video">
							<div class="video">
								<?php if ($yturl != '') { ?>
									<iframe id="pages_player_<?php echo $count; ?>" src="<?php echo $yturl; ?>&amp;wmode=transparent" width="1280" height="720" frameborder="0"></iframe>
								<?php } elseif ($vimurl != '') { ?>
									<iframe id="pages_player_<?php echo $count; ?>" src="<?php echo $vimurl; ?>&amp;wmode=transparent" width="1280" height="720" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>
								<?php } else { ?>
									<?php
										if (preg_match_all('/(<iframe)/', $embed, $matches)) {
											echo preg_replace('/(<iframe)/', '<iframe id="pages_player_' . $count . '" ', $embed);
										} else {
											echo $embed;
										}
									?>
								<?php } ?>
							</div>
						</div>
					<?php } else { ?>
						<div class="feature-image">
							<a href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php solostream_feature_image_wide(); ?></a>
						</div>
					<?php } ?>

					<div class="flex-caption">
						<div class="my-excerpt">
							<h2 class="post-title"><a href="<?php the_permalink() ?>" rel="<?php _e("bookmark", "solostream"); ?>" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php the_title(); ?></a></h2>
							<?php the_excerpt(); ?>
						</div>
						<a class="more-link" href="<?php the_permalink() ?>" rel="nofollow" title="<?php _e("Permanent Link to", "solostream"); ?> <?php the_title(); ?>"><?php _e("Continue Reading &rarr;", "solostream"); ?></a>
					</div>

				</div>

			</li>

<?php
$count = $count + 1;
endwhile;
} ?>

		</ul>

	</div>

	<?php if (count($featarr) > 1) { ?>
	<div id="featured-pages-thumbnav" class="myflexslider thumbnav">

		<ul class="slides">

<?php
$featpages = get_option('solostream_featpage_ids');
$featarr=split(",",$featpages);
$featarr = array_diff($featarr, array(""));
$count = 1;
foreach ( $featarr as $featitem ) {

	$my_query = new WP_Query(array(
		'post_type' => array('post', 'page'),
		'page_id' => $featitem
	));

	while ($my_query->have_posts()) : $my_query->the_post();
?>

			<li title="<?php the_title(); ?>"><?php solostream_thumbnav(); ?></li>

<?php
$count = $count + 1;
endwhile;
} ?>

		</ul>

	</div>
	<?php } ?>

</div>