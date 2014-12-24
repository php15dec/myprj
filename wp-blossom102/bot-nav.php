<div class="navigation clearfix">
<?php if ( is_single() ) { ?>
	<div class="alignleft single">
		<?php previous_post_link('%link', __("&laquo; Prev", "solostream")); ?>
	</div>
	<div class="alignright single">
		<?php next_post_link('%link', __("Next &raquo;", "solostream")); ?>
	</div>
<?php } else { ?>
	<?php if ( function_exists('wp_pagenavi') ) { ?>
		<?php wp_pagenavi(); ?>
	<?php } else { ?>
		<?php posts_nav_link(); ?>
	<?php } ?>
<?php } ?>
</div>