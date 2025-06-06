<?php
/**
 * Custom single product layout.
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product;

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
    echo get_the_password_form();
    return;
}
?>
<section id="product-<?php the_ID(); ?>" <?php wc_product_class( 'single-product-details row g-5 align-items-start', $product ); ?>>
    <div class="col-lg-7">
        <div class="product-media">
            <?php do_action( 'woocommerce_before_single_product_summary' ); ?>
        </div>
    </div>
    <div class="col-lg-5">
        <article class="summary entry-summary bg-white p-4 rounded-3 shadow-sm">
            <?php do_action( 'woocommerce_single_product_summary' ); ?>
        </article>
    </div>
    <div class="col-12">
        <?php do_action( 'woocommerce_after_single_product_summary' ); ?>
    </div>
</section>
<?php do_action( 'woocommerce_after_single_product' ); ?>
