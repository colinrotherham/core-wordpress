<?php
/**
 * Theme config
 */

// Money format and locale
setlocale(LC_ALL, 'en_GB.UTF-8');
setlocale(LC_MONETARY, 'en_GB.UTF-8');
date_default_timezone_set('Europe/London');

// Add composer autoload location
require_once ($_SERVER['DOCUMENT_ROOT'] . '/vendor/autoload.php');

// App info
$app = (object) [
    'version' => '0.1.0'
];

// Working directories
$router = (object) [
    'directory' => parse_url(get_bloginfo('template_directory'), PHP_URL_PATH),
    'route' => parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH)
];

// WordPress helper + route overrides
$wordpress = new \CRD\WordPress([

    // Route override: /example
    'example' => array
    (
        '*' => (object) array
        (
            'title' => 'Example',
            'template' => '/templates/example.php',
            'cache' => true
        )
    )
]);
