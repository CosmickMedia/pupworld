<?php
get_header();

if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();

        global $product;

        if ( $product->get_catalog_visibility() == 'hidden' ) {
            continue;
        }

        $ukm_product_type = $product->get_meta( 'ukm_product_type' );

        if ( empty( $ukm_product_type ) || $ukm_product_type == 'pet' ) {
            get_template_part( 'template-parts/loop', 'pet' );
        } else {
            get_template_part( 'template-parts/loop', 'product' );
        }
	}
}

get_footer();
