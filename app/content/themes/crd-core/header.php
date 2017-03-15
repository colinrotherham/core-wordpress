<?php
namespace CRD;

/**
 * Header
 */

global $app, $wordpress, $router;

// Theme directory
$directory = get_stylesheet_directory();

?><!doctype html>
<html lang="en-GB">
	<head>
		<meta charset="utf-8">
		<title><?= esc_html($wordpress->getPageTitle()) ?></title>

		<!-- Handheld support -->
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<!-- Critical CSS -->
		<!--[if (gte IE 9)|!(IE)]><!-->
		<style><?php require_once("{$directory}/assets/css/starter.min.css"); ?></style>
		<!--<![endif]-->

		<!-- Critical JS -->
		<script>document.documentElement.className = 'advanced';
		<?php require_once("{$directory}/assets/js/starter.min.js"); ?></script>

		<!-- Lazy-load CSS -->
		<!--[if (gte IE 9)|!(IE)]><!-->
		<script>loadCSS('<?= $router->directory ?>/assets/css/main.min.css?v=<?= esc_attr($app->version) ?>');</script>
		<noscript><link rel="stylesheet" href="<?= $router->directory ?>/assets/css/main.min.css?v=<?= esc_attr($app->version) ?>"></noscript>
		<!--<![endif]-->
		<!--[if lt IE 9]>
		<link rel="stylesheet" href="<?= $router->directory ?>/assets/css/legacy.min.css?v={{timestamp}}">
		<script src="<?= $router->directory ?>/assets/js/legacy.min.js"></script>
		<![endif]-->
	</head>
	<body class="page page--<?= esc_attr(sanitize_title($wordpress->getTemplate())) ?>">
