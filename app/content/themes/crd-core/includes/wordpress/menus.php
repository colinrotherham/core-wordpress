<?php

/**
 * Menus
 */

// Reduce classes on navigation menus
add_filter('nav_menu_css_class', function ($array) {
	$allowed = array();

	// Only a single class string provided
	if (is_string($array)) {
		$array = array($array);
	}

	// Loop classes
	foreach ($array as $class) {
		if (stripos($class, 'item-', 0) === 0) {
			$allowed[] = $class;
		}
	}

	return $allowed;
}, 100, 1);

// Remove ID from navigation menus
add_filter('wp_nav_menu', function ($menu) {
	return $menu = preg_replace('/ id=\"(.*)\"/iU', '', $menu);
});
