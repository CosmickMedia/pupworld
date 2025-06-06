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
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'row g-5 align-items-start single-product-details', $product ); ?>>
    <div class="col-lg-7">
        <?php do_action( 'woocommerce_before_single_product_summary' ); ?>
    </div>
    <div class="col-lg-5">
        <div class="summary entry-summary bg-white p-4 rounded-3 shadow-sm">
            <?php do_action( 'woocommerce_single_product_summary' ); ?>
        </div>
    </div>
</div>
<?php
    do_action( 'woocommerce_after_single_product_summary' );
    do_action( 'woocommerce_after_single_product' );
?>
