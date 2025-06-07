<?php
/**
 * Template overrides WooCommerce cart layout
 * Wraps default cart.php template in a centered container with margins
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

// Start wrapper div for centering and spacing
?>
<div class="woo-cart-wrapper container my-5">
    <?php
    // Load original WooCommerce cart template from plugin
    wc_get_template( 'cart/cart.php', array(), '', WC()->plugin_path() . '/templates/' );
    ?>
</div>
