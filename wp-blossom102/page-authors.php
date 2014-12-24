<?php
/*
Template Name: All Authors
*/
?>

<?php get_template_part( 'content', 'before' ); ?>	

						<div class="post entry clearfix">

							<?php the_post(); $content = get_the_content(); ?>

							<h1 class="page-title" id="post-<?php the_ID(); ?>"><?php the_title(); ?></h1>

							<?php if ( ! empty( $content ) ) : ?>
								<div class="content">
									<?php the_content(); ?>
								</div>
							<?php endif; ?>

							<?php
								// Get the authors from the database ordered by user nicename
								global $wpdb;
								global $curauth; 
								$query = "SELECT ID, user_nicename from $wpdb->users ORDER BY user_nicename";
								$author_ids = $wpdb->get_results($query);

								// Loop through each author
								foreach($author_ids as $author) :

								// Get user data
								$curauth = get_userdata($author->ID);

								// If user level is above 0 or login name is "admin", display profile
								if ($curauth->user_level > 0 && $curauth->description || $curauth->user_login == 'admin' && $curauth->description) :

								// Get link to author page
								$user_link = get_author_posts_url($curauth->ID);

							?>

							<div class="allauthors clearfix">

								<?php /* Get author name */ ?>
								<h2><span><?php echo $curauth->display_name; ?></span></h2>

								<?php /* Get author gravatar */ 
									$gravsize = get_option('solostream_grav_size');
								?>
								<a href="<?php echo $user_link; ?>" title="<?php echo $curauth->display_name; ?>"><?php echo get_avatar($curauth->user_email, '$gravsize'); ?></a>

								<?php /* Get author bio info */ ?>
								<p><?php echo $curauth->description; ?></p>

								<p><?php if ($curauth->user_url) /* Get author's website */ { ?><a href="<?php echo $curauth->user_url; ?>"><?php _e("Author Website", "solostream"); ?></a> | <?php } ?>

								<?php /* Get author link to recent posts */ ?>
								<a href="<?php echo $user_link; ?>" title="<?php echo $curauth->display_name; ?>"><?php _e("Author Archive Page", "solostream"); ?></a></p>

								<?php  /* Get author's social media icons */ ?>
								<?php get_template_part( 'auth-icons' ); ?>

							</div>

							<?php endif; ?>

							<?php endforeach; /* END THE ALL AUTHORS PAGE TEMPLATE CONTENT */ ?>
				
						</div>

<?php get_template_part( 'content', 'after' ); ?>