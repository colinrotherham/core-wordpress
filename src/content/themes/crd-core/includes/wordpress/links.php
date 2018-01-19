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

// Make URLs relative in nav menus
add_action('nav_menu_link_attributes', function ($atts) {

	if (!empty($atts['href'])) {
		$atts['href'] = wp_make_link_relative($atts['href']);
	}

	return $atts;
});

// Make URLs relative in bespoke nav menus
add_action('wp_get_nav_menu_items', function ($items) {

	foreach ($items as $key => $item) {
		if (!empty($item->url)) {
			$item->url = wp_make_link_relative($item->url);
		}
	}

	return $items;
});
