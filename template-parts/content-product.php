<?php
/**
 * Single product content for standard WooCommerce products.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_template_part( 'template-parts/section-start', 'woo', [
    'section_class' => 'container py-5',
] );

// WooCommerce page header with breadcrumb and title.
get_template_part( 'template-parts/woocommerce', 'header' );

// Load the detailed single product layout if available.
if ( function_exists( 'wc_get_template_part' ) ) {
    // This allows WooCommerce templates under the theme's /woocommerce folder
    // to override the single product layout (e.g. content-single-product.php).
    wc_get_template_part( 'content', 'single-product' );
} else {
    get_template_part( 'template-parts/product-details' );
}

get_template_part( 'template-parts/section-end', 'woo' );
