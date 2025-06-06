<?php
/**
 * Generic WooCommerce content wrapper used for cart, checkout and account pages.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

get_template_part( 'template-parts/section-start', 'woo', [
    'section_class' => 'container py-5',
] );

// WooCommerce page header with breadcrumb and title.
get_template_part( 'template-parts/woocommerce', 'header' );

woocommerce_content();

get_template_part( 'template-parts/section-end', 'woo' );
