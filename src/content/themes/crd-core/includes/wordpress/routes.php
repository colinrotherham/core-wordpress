<?php

/**
 * Route overrides
 */

add_action('template_redirect', function() {
    global $wordpress, $wp_query;

    // Template route override
    $override = $wordpress->getRouteOverride();

    // Must have category name
    if (!empty($override) && $template = $override->template) {

        // Don't cache this page?
        if (empty($override->cache))
            define('DONOTCACHEPAGE', true);

        // Find optional override callback
        $callback = !empty($override->callback)? $override->callback : null;

        if (is_callable($callback))
            $override->viewData = $callback($override, $wp_query);

        // Suppress 404
        if ($wp_query->is_404) {
            status_header('200');
            $wp_query->is_404 = false;
        }

        // Load template
        require_once (TEMPLATEPATH . $template);
        exit;
    }
});
