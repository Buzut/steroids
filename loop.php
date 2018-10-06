<?php if (have_posts()): while (have_posts()) : the_post(); ?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<!-- post thumbnail -->
		<?php if (has_post_thumbnail()) : // Check if thumbnail exists ?>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<?php the_post_thumbnail(array(120,120)); // Declare pixel size you need inside the array ?>
			</a>
		<?php endif; ?>
		<!-- /post thumbnail -->

		<h2>
			<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
		</h2>

		<!-- post details -->
		<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
		<span class="author"><?php _e('Published by', 'steroids'); ?> <?php the_author_posts_link(); ?></span>
		<span class="comments"><?php if (comments_open(get_the_ID())) comments_popup_link(__('Leave your thoughts', 'steroids'), __('1 Comment', 'steroids'), __('% Comments', 'steroids')); ?></span>
		<!-- /post details -->

		<?php the_excerpt(); ?>
		<?php edit_post_link(); ?>
	</article>
<?php endwhile; ?>

<?php else: ?>
	<article>
		<h2><?php _e('Sorry, nothing to display.', 'steroids'); ?></h2>
	</article>
<?php endif; ?>
