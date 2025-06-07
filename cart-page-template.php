<?php
/**
 * Template Name: Cart Page Template
 */
get_header();
?>
<main id="primary" class="site-main">
    <div class="container my-5" style="max-width:960px;">
        <h1 class="page-title text-center mb-4"><?php the_title(); ?></h1>
        <?php echo do_shortcode('[woocommerce_cart]'); ?>
    </div>
</main>
<?php
get_footer();
?>
