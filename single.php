<?php
defined('ABSPATH') || exit;
get_header();
?>
<main>
	<?php if (have_posts()): while (have_posts()) : the_post(); ?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<!-- post thumbnail -->
			<?php if (has_post_thumbnail()) : // Check if Thumbnail exists ?>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
					<?php the_post_thumbnail(); // Fullsize image for the single post ?>
				</a>
			<?php endif; ?>
			<!-- /post thumbnail -->

			<h1>
				<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
			</h1>

			<!-- post details -->
			<span class="date"><?php the_time('F j, Y'); ?> <?php the_time('g:i a'); ?></span>
			<span class="author"><?php _e('Published by', 'steroids'); ?> <?php the_author_posts_link(); ?></span>
			<span class="comments"><?php if (comments_open(get_the_ID())) comments_popup_link(__('Leave your thoughts', 'steroids'), __('1 Comment', 'steroids'), __('% Comments', 'steroids')); ?></span>
			<!-- /post details -->

			<?php the_content(); // Dynamic Content ?>
			<?php the_tags(__('Tags: ', 'steroids'), ', ', '<br>'); // Separated by commas with a line break at the end ?>

			<p><?php _e('Categorised in: ', 'steroids'); the_category(', '); // Separated by commas ?></p>
			<p><?php _e('This post was written by ', 'steroids'); the_author(); ?></p>

			<?php edit_post_link(); // Always handy to have Edit Post Links available ?>
			<?php comments_template(); ?>

		</article>
	<?php endwhile; ?>

	<?php else: ?>
		<article>
			<h1><?php _e('Sorry, nothing to display.', 'steroids'); ?></h1>
		</article>
	<?php endif; ?>
</main>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
