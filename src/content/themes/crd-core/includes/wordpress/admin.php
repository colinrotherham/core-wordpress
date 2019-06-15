<?php

/**
 * Admin area
 */

// Remove unused admin features
add_action('admin_menu', function () {
    remove_menu_page('link-manager.php');
    remove_menu_page('edit-comments.php');
});


// Remove features for non-admin users
if (!current_user_can('edit_posts')) {
    add_filter('show_admin_bar', '__return_false');
}
