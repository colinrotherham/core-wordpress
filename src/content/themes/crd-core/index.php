<?php
namespace CRD;

/**
 * Post index
 */

global $app, $router, $wordpress;

get_header();

if (have_posts()) {
?>

		<!-- Main content -->
		<main class="container group" role="main">
<?php
	// Loop all posts
	while (have_posts()) {
		the_post();
?>
			<div class="example wrapper">
				<h1 class="headline headline--section">Post index</h1>
				<?php the_content(); ?>
			</div>
<?php
	}
?>
		</main>

<?php
}

get_footer();
