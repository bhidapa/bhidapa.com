<?php

/**
 * Plugin Name: Disable archives
 * Description: Disables category, tag, date and author archives by redirecting to a 404.
 * Version: 1.0
 * Author: BHIDAPA
 * Author URI: https://bhidapa.com
 */

if (!defined('ABSPATH')) {
  exit; // Exit if accessed directly.
}

add_action('template_redirect', 'disable_wp_archives');

function disable_wp_archives()
{
  if (is_category() || is_tag() || is_date() || is_author()) {
    global $wp_query;
    $wp_query->set_404();
  }
}
