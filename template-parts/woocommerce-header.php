<?php
/**
 * WooCommerce page header with breadcrumbs, title and description.
 */
defined( 'ABSPATH' ) || exit;
?>
<header class="page-header mb-4">
    <?php woocommerce_breadcrumb(); ?>
    <?php if ( is_shop() || is_product_taxonomy() ) : ?>
        <h1 class="page-title"><?php echo woocommerce_page_title( false ); ?></h1>
        <?php do_action( 'woocommerce_archive_description' ); ?>
    <?php else : ?>
        <?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
    <?php endif; ?>
</header>
