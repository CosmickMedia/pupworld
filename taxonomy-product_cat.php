<?php
get_header();

get_template_part( 'template-parts/section-start', 'woo', [ 'section_class' => 'container py-5' ] );

// WooCommerce page header with breadcrumb, title and description.
get_template_part( 'template-parts/woocommerce', 'header' );

// Filters and result count before the products grid.
do_action( 'woocommerce_before_shop_loop' );

if ( have_posts() ) {
	get_template_part( 'template-parts/section-start', 'woo', [ 'section_class' => 'row g-0 row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 list-unstyled mb-5' ] );

	while ( have_posts() ) {
		the_post();

        global $product;

        if ( $product->get_catalog_visibility() == 'hidden' ) {
            continue;
        }

        $ukm_product_type = $product->get_meta( 'ukm_product_type' );

        get_template_part( 'template-parts/section-start', 'woo', [ 'section_class' => 'col' ] );

        if ( empty( $ukm_product_type ) || $ukm_product_type == 'pet' ) {
            get_template_part( 'template-parts/loop', 'pet' );
        } else {
            get_template_part( 'template-parts/loop', 'product' );
        }

        get_template_part( 'template-parts/section-end', 'woo' );
	}

        get_template_part( 'template-parts/section-end', 'woo' );

        // Pagination and additional actions.
        do_action( 'woocommerce_after_shop_loop' );
} else {
        do_action( 'woocommerce_no_products_found' );
}

get_template_part( 'template-parts/section-end', 'woo' );

get_footer();
