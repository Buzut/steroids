<?php defined('ABSPATH') || exit; ?>
<?php get_header(); ?>

	<main>
    <!-- about the author -->
	<?php if (have_posts()): the_post(); ?>
		<h1><?php _e('Author Archives for ', 'steroids'); echo get_the_author(); ?></h1>
	<?php if (get_the_author_meta('description')) : ?>

	<?php echo get_avatar(get_the_author_meta('user_email')); ?>
		<h2><?php _e('About ', 'steroids'); echo get_the_author() ; ?></h2>
		<?php echo wpautop(get_the_author_meta('description')); ?>
	<?php endif; ?>
    <!-- about the author -->

	<?php rewind_posts(); while (have_posts()) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- post thumbnail -->
			<?php if (has_post_thumbnail()) : // Check if Thumbnail exists ?>
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
			<span class="comments"><?php comments_popup_link(__('Leave your thoughts', 'steroids'), __('1 Comment', 'steroids'), __('% Comments', 'steroids')); ?></span>
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
		<?php get_template_part('pagination'); ?>
	</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
