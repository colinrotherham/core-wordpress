<?php
namespace CRD;

/**
 * Single page
 */

global $app, $router, $wordpress;

get_header();

if (have_posts()) {
    the_post();
?>

        <!-- Main content -->
        <main class="container group" role="main">

            <div class="example wrapper">
                <h1 class="headline headline--section">Single page</h1>
                <?php the_content(); ?>
            </div>

        </main>

<?php
    the_content();
}

get_footer();
