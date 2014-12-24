<?php get_template_part( 'content', 'before' ); ?>

						<div class="auth-bio clearfix">

							<?php 
								global $curauth; 
								$curauth = get_userdata(intval($author));
								$gravsize = get_option('solostream_grav_size'); 
							?>

							<?php echo get_avatar($curauth->user_email,$size=$gravsize); ?>

							<h1><span><?php echo $curauth->display_name; ?></span></h1>

							<?php echo wpautop( $curauth->description, $br = 1 ); ?>

							<?php get_template_part( 'auth-icons' ); ?>

						</div>

						<?php if ( get_option('solostream_archive_layout') == 'Option 2 - 2 Posts Aligned Side-by-Side') { ?>
							<?php get_template_part( 'index2' ); ?>
						<?php } else { ?>
							<?php get_template_part( 'index1' ); ?>
						<?php } ?>

<?php get_template_part( 'content', 'after' ); ?>