<?php
if ( is_shop() || is_product_category() ) {
	get_template_part( 'taxonomy', 'product_cat' );

	return;
} elseif ( is_product() ) {
	get_template_part( 'single', 'product' );

	return;
}

get_header();

get_template_part( 'template-parts/content', 'woocommerce' );

get_footer();
