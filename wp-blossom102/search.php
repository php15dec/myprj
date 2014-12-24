<?php get_template_part( 'content', 'before' ); ?>

						<h1 class="archive-title"><?php _e("Search Results for", "solostream"); ?> '<?php echo wp_specialchars($s, 1); ?>'</h1>

						<?php if ( get_option('solostream_archive_layout') == 'Option 2 - 2 Posts Aligned Side-by-Side') { ?>
							<?php get_template_part( 'index2' ); ?>
						<?php } else { ?>
							<?php get_template_part( 'index1' ); ?>
						<?php } ?>

<?php get_template_part( 'content', 'after' ); ?>