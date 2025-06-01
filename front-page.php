<?php
/**
 * Front page template for PupWorld.
 *
 * Renders the block-based front page using the templates stored
 * in the database. Falls back to rendering the page content
 * directly if no block template exists.
 *
 * @package PupWorld
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

get_header();

// Determine whether a dedicated front-page template exists.
$template_slug = is_home() ? 'home' : 'front-page';
$template      = null;

if ( function_exists( 'get_block_template' ) ) {
    $template = get_block_template( get_stylesheet() . '//' . $template_slug, 'wp_template' );
}

if ( $template && ! empty( $template->content ) ) {
    // Output the saved block template content.
    echo do_blocks( $template->content );
} else {
    // Fallback to the content of the front page itself.
    while ( have_posts() ) : the_post();
        the_content();
    endwhile;
}

get_footer();
