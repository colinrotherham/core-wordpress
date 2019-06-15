<?php
namespace CRD;

/**
 * WordPress helper
 */

class WordPress
{
    private $template;
    private $routes;

    // Allow 404 override of Wordpress routes
    public function __construct($routes = null)
    {
        if (!empty($routes)) {
            $this->routes = $routes;
        }
    }

    // Get template name
    public function getTemplate()
    {
        if (empty($this->template)) {
            $override = $this->getRouteOverride();
            $pageId = $this->getPageId();
            $pageType = false;

            // Fetch override template file path
            if (!empty($override)) {
                $template = $override->template;
            }

            // Fetch regular template file path
            else if (!empty($pageId)) {

                // Get custom type
                if (get_post_type($pageId)) {
                    $pageType = get_post_type($pageId);
                }

                // Use custom type as slug
                if (!empty($pageType) && $pageType !== 'page') {
                    $template = get_post_type($pageId);
                }

                // Use template name
                else {
                    $template = get_page_template_slug($pageId);
                }
            }

            // Template name, default to index
            $this->template = !empty($template)?
                basename($template, '.php') : 'index';
        }

        return $this->template;
    }

    // Get template routes
    public function getRoutes()
    {
        return $this->routes;
    }

    // Get template route override
    public function getRouteOverride()
    {
        global $wp;

        // Query parameters etc
        $params = $wp->query_vars;
        $overrides = $this->routes;

        // Default to no override
        $override = false;

        // Check for overrides if category/name provided
        if (!empty($overrides) && (!empty($params['category_name']) || !empty($params['post_type']))) {
            $category = null;

            // Is this category a post type?
            if (!empty($params['post_type'])) {
                $typeData = get_post_type_object($params['post_type']);

                // Use post type as-is or use its rewrite?
                $category = !empty($typeData) && !empty($typeData->rewrite['slug'])?
                    $typeData->rewrite['slug'] : $params['post_type'];
            }

            // Use category name
            else {
                $category = $params['category_name'];
            }

            // Matching category
            if (array_key_exists($category, $overrides)) {

                // Name provided, does it match?
                if (!empty($params['name']) && array_key_exists($params['name'], $overrides[$category])) {
                    $override = $overrides[$category][$name];
                }

                // Otherwise, Wildcard route available?
                else if (array_key_exists('*', $overrides[$category])) {
                    $override = $overrides[$category]['*'];
                }
            }
        }

        return $override;
    }

    // Get page title
    public function getPageTitle()
    {
        $override = $this->getRouteOverride();

        // Default Wordpress title, override if empty
        $name = !empty($override)? $override->title : wp_title('|', false, 'right');
        $description = get_bloginfo('description');

        // No title?
        if (empty($name)) {
            $name = get_bloginfo('name');
        }

        // Add optional description
        $title = !empty($description)?
            "{$name} | {$description}" : "{$name}";

        // Clean up after Wordpress
        $title = rtrim($title, ' | ');
        $title = str_replace('|  | ', '| ', $title);
        $title = str_replace("{$name} | {$name},", "{$name},", $title);

        return $title;
    }

    // Get page ID
    public function getPageId()
    {
        global $post;

        if (empty($this->pageId)) {

            $this->pageId = !empty($post)?
                $post->ID : url_to_postid($_SERVER['REQUEST_URI']);

            // No page ID
            if (empty($this->pageId)) {
                $override = $this->getRouteOverride();

                // If no page ID, default to home
                if (empty($override)) {
                    $this->pageId = get_option('page_on_front');
                }
            }
        }

        return $this->pageId;
    }
}
