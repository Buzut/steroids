<?php defined('ABSPATH') || exit; ?>
<form class="search" method="get" action="<?php echo home_url(); ?>" role="search">
	<input class="search-input" type="search" name="s" placeholder="<?php _e('To search, type and hit enter.', 'steroids'); ?>">
	<button class="search-submit" type="submit"><?php _e('Search', 'steroids'); ?></button>
</form>
