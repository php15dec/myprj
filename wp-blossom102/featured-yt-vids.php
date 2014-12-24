<div class="featured videos yt">

	<div class="container clearfix">

		<div id="featured-yt-vids" class="flexslider yt-vids-slider">

			<ul class="slides">

<?php
$count = 1;
// Get RSS Feed(s)
include_once(ABSPATH . WPINC . '/feed.php');
$rss = fetch_feed($instance['ytrss']);
$maxitems = $rss->get_item_quantity($instance['numvids']);
$items = $rss->get_items(0, $maxitems);
foreach ( $items as $item ) :
$youtubeid = strchr($item->get_permalink(),'=');
$youtubeid = substr($youtubeid,1,11); 
?>

	    			<li id="feature-yt-vid-<?php echo $count; ?>">
					<div class="feature-video">
						<div class="video">
							<iframe id="widget_yt_player_<?php echo $count; ?>" width="400" height="300" src="http://www.youtube.com/embed/<?php echo $youtubeid; ?>?modestbranding=1&amp;controls=2&amp;rel=0&amp;showinfo=0&amp;wmode=transparent" frameborder="0"></iframe>
						</div>
					</div>
				</li>

<?php $count = $count + 1; endforeach; ?>

			</ul>

		</div>

		<div class="controls-container clearfix">

			<ul class="flexslide-custom-controls youtube-custom-controls clearfix">

<?php
$count = 1;
// Get RSS Feed(s)
include_once(ABSPATH . WPINC . '/feed.php');
$rss = fetch_feed($instance['ytrss']);
$maxitems = $rss->get_item_quantity($instance['numvids']);
$items = $rss->get_items(0, $maxitems);

foreach ( $items as $item ) :
$youtubeid = strchr($item->get_permalink(),'=');
$youtubeid = substr($youtubeid,1,11); ?>

				<li class="clearfix" >
					<a class="clearfix" href="#" title="<?php echo esc_html( $item->get_title() ); ?>">
						<img class="yt-thumb" src="http://img.youtube.com/vi/<?php echo $youtubeid; ?>/default.jpg" alt="<?php echo esc_html( $item->get_title() ); ?>" title="<?php echo esc_html( $item->get_title() ); ?>" />
						<span class="yt-title"><?php echo esc_html( $item->get_title() ); ?></span>
					</a>
				</li>

<?php $count = $count + 1; endforeach; ?>

			</ul>

		</div>

	</div>

</div>