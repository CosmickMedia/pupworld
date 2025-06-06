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

woocommerce_content();

get_template_part( 'template-parts/section-end', 'woo' );
