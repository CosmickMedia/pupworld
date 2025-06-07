<?php
/**
 * Template part to display a product within loops when not a "pet" type.
 */

global $product;

if ( ! $product ) {
    return;
}

$link   = get_permalink( $product->get_id() );
$image  = $product->get_image( 'medium', [ 'class' => 'card-img-top object-fit-cover' ] );
$title  = get_the_title();
$price  = $product->get_price_html();
?>
<div class="card product-card shadow-sm border-0 rounded-3 overflow-hidden transition-hover h-100">
    <a href="<?php echo esc_url( $link ); ?>" class="text-decoration-none">
        <?php echo $image; ?>
    </a>
    <div class="card-body">
        <h5 class="card-title mb-2"><?php echo esc_html( $title ); ?></h5>
        <div class="product-price mb-3"><?php echo $price; ?></div>
        <a href="<?php echo esc_url( $link ); ?>" class="btn btn-gold">View Details</a>
    </div>
</div>
