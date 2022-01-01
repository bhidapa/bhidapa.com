<?php

/**
 * Plugin Name: Redirect postname to category
 * Description: Adds a 404 filter redirect from `/%postname%/` to `/%category%/%postname%/`.
 * Version: 1.0
 * Author: BHIDAPA
 * Author URI: https://bhidapa.com
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

add_filter('404_template', 'redirect_postname_to_category');

function redirect_postname_to_category($template)
{
  if (!is_404()) {
    return $template;
  }

  global $wp_rewrite;
  global $wp_query;

  if ('/%category%/%postname%/' !== $wp_rewrite->permalink_structure) {
    return $template;
  }

  if (!$post = get_page_by_path($wp_query->query['category_name'], OBJECT, 'post')) {
    return $template;
  }

  $permalink = get_permalink($post->ID);

  wp_redirect($permalink, 301);
  exit;
}
