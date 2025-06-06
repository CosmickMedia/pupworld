<?php
get_header();

while ( have_posts() ) :
    the_post();

    global $product;

    $ukm_product_type = $product->get_meta( 'ukm_product_type' );

    if ( empty( $ukm_product_type ) || 'pet' === $ukm_product_type ) {
        get_template_part( 'template-parts/content-pet' );
    } else {
        get_template_part( 'template-parts/content-product' );
    }

endwhile;

get_footer();
