<?php
/**
 * Template overrides WooCommerce checkout layout
 * Wraps default form-checkout.php template in a centered container with margins
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}
?>
<div class="woo-checkout-wrapper container my-5">
    <?php
    wc_get_template( 'checkout/form-checkout.php', array(), '', WC()->plugin_path() . '/templates/' );
    ?>
</div>
