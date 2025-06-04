<?php
get_header();

if ( have_posts() ) : the_post(); endif;

global $product;

$ukm_product_type = $product->get_meta( 'ukm_product_type' );

if ( empty( $ukm_product_type ) || $ukm_product_type == 'pet' ) {
    get_template_part( 'template-parts/content-pet' );
} else {
    get_template_part( 'template-parts/content-product' );
}

get_footer();
