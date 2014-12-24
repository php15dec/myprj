<?php get_template_part( 'content', 'before' ); ?>

						<?php if ( get_option('solostream_home_layout') == 'Option 2 - 2 Posts Aligned Side-by-Side') { ?>
							<?php get_template_part( 'index2' ); ?>
						<?php } elseif ( get_option('solostream_home_layout') == 'Option 3 - Posts Arranged by Category Side-by-Side') { ?>
							<?php get_template_part( 'index3' ); ?>
						<?php } elseif ( get_option('solostream_home_layout') == 'Option 4 - Posts Arranged by Category Stacked') { ?>
							<?php get_template_part( 'index4' ); ?>
						<?php } else { ?>
							<?php get_template_part( 'index1' ); ?>
						<?php } ?>

<?php get_template_part( 'content', 'after' ); ?>