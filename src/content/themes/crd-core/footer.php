<?php
namespace CRD;

/**
 * Footer
 */

global $app, $wordpress, $router;
?>

        <!-- Shared footer -->
        <footer class="footer wrapper" role="contentinfo">
            <h2 class="headline">Footer include</h2>
            <p>Styles lazy-loaded via <strong>loadCSS</strong></p>
        </footer>

        <!-- Script includes -->
        <script src="<?= get_stylesheet_directory_uri() ?>/assets/js/main.min.js?v=<?= esc_attr($app->version) ?>" defer></script>
    </body>
</html>
