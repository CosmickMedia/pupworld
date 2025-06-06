<?php
/**
 * Single product content for pet type products.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_template_part( 'template-parts/section-start', 'woo', [
    'section_class' => 'container py-5',
] );

// WooCommerce page header with breadcrumb and title.
get_template_part( 'template-parts/woocommerce', 'header' );

get_template_part( 'template-parts/product-details' );

get_template_part( 'template-parts/section-end', 'woo' );
