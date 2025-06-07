<?php
/**
 * Template override for related products section.
 *
 * Displays related products using the same card layout as category pages.
 *
 * @package PupWorld
 */

defined( 'ABSPATH' ) || exit;

if ( empty( $related_products ) ) {
    return;
}
?>
<section class="related products my-5">
    <h2 class="mb-4"><?php esc_html_e( 'Related products', 'woocommerce' ); ?></h2>
    <?php
    // Grid wrapper matching category page layout.
    get_template_part(
        'template-parts/section-start',
        'woo',
        [ 'section_class' => 'row g-0 row-cols-1 row-cols-md-2 row-cols-lg-3 g-3 list-unstyled' ]
    );

    foreach ( $related_products as $related_product ) {
        $post_object = get_post( $related_product->get_id() );
        setup_postdata( $GLOBALS['post'] =& $post_object );

        global $product;
        $ukm_product_type = $product->get_meta( 'ukm_product_type' );

        get_template_part( 'template-parts/section-start', 'woo', [ 'section_class' => 'col' ] );
        if ( empty( $ukm_product_type ) || 'pet' === $ukm_product_type ) {
            get_template_part( 'template-parts/loop', 'pet' );
        } else {
            get_template_part( 'template-parts/loop', 'product' );
        }
        get_template_part( 'template-parts/section-end', 'woo' );
    }

    wp_reset_postdata();

    get_template_part( 'template-parts/section-end', 'woo' );
    ?>
</section>
