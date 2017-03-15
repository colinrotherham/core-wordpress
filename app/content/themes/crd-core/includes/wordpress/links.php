<?php

/**
 * Menus
 */

// Make URLs relative
add_action('template_redirect', function () {

	if (is_feed() || get_query_var('sitemap')) {
		return;
	}

	$filters = [
		'wp_get_attachment_image_src',
		'wp_get_attachment_thumb_url',
		'wp_get_attachment_url',
		'stylesheet_directory_uri',
		'theme_root_uri',
		'attachment_link'
	];

	foreach ($filters as $filter) {
		add_filter($filter, 'wp_make_link_relative');
	}
});
