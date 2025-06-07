<?php
defined( 'ABSPATH' ) || exit;

define( 'PUPWORLD_VERSION', '1.0.1' );

class PUPWORLD_THEME {
	function __construct() {
		add_action( 'after_setup_theme', [ $this, 'after_setup_theme' ] );
		add_action( 'init', [ $this, 'register_nav_menus' ] );
		//add_action( 'init', [ $this, 'register_acf_blocks' ] );
	}

        function after_setup_theme() {
                add_theme_support( 'menus' );
                add_theme_support( 'woocommerce' );
        }

	function register_nav_menus() {
		register_nav_menus( [ 
			'quick' => 'Quick Menu',
			'main' => 'Main Menu',
			'footer' => 'Footer Menu',
			'admin' => 'Admin Menu'
		] );
	}

	function register_acf_blocks() {
		register_block_type( __DIR__ . '/blocks/testimonial' );
	}
}

$PUPWORLD_THEME = new PUPWORLD_THEME();

require_once ( dirname( __FILE__ ) . '/load.php' );

require_once ( dirname( __FILE__ ) . '/reviews.php' );

function pupworld_output_product_gallery() {
    global $product;
    $main_id = $product->get_image_id();
    $gallery_ids = $product->get_gallery_image_ids();

    echo '<div class="swiper product-gallery-swiper">';
    echo '<div class="swiper-wrapper">';

    if ( $main_id ) {
        $html = wp_get_attachment_image( $main_id, 'large', false, array( 'class' => 'img-fluid' ) );
        echo '<div class="swiper-slide">' . $html . '</div>';
    }

    if ( $gallery_ids ) {
        foreach ( $gallery_ids as $gid ) {
            $html = wp_get_attachment_image( $gid, 'large', false, array( 'class' => 'img-fluid' ) );
            echo '<div class="swiper-slide">' . $html . '</div>';
        }
    }

    echo '</div>';
    echo '<div class="swiper-button-next"></div><div class="swiper-button-prev"></div><div class="swiper-pagination"></div>';
    echo '</div>';
}

add_action( 'init', function() {
    remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
    add_action( 'woocommerce_before_single_product_summary', 'pupworld_output_product_gallery', 20 );
} );

function pupworld_custom_product_badge() {
    $badge = get_post_meta( get_the_ID(), 'product_badge', true );
    if ( $badge ) {
        echo '<span class="product-badge badge bg-success position-absolute top-0 start-0 m-2">' . esc_html( $badge ) . '</span>';
    }
}
add_action( 'woocommerce_before_single_product_summary', 'pupworld_custom_product_badge', 5 );

function pupworld_product_highlights() {
    if ( function_exists( 'get_field' ) ) {
        $highlights = get_field( 'product_highlights' );
        if ( $highlights ) {
            echo '<ul class="product-highlights list-unstyled mt-3">';
            foreach ( $highlights as $text ) {
                echo '<li class="d-flex align-items-start mb-2"><i class="fa-solid fa-check me-2 text-success"></i><span>' . esc_html( $text ) . '</span></li>';
            }
            echo '</ul>';
        }
    }
}
add_action( 'woocommerce_single_product_summary', 'pupworld_product_highlights', 25 );

function pupworld_trust_badges() {
    echo '<div class="trust-badges mt-3">'
        . '<span class="me-3"><i class="fa-solid fa-lock"></i> SSL Secure</span>'
        . '<span class="me-3"><i class="fa-regular fa-credit-card"></i> Safe Payments</span>'
        . '<span><i class="fa-solid fa-thumbs-up"></i> Satisfaction Guarantee</span>'
        . '</div>';
}
add_action( 'woocommerce_single_product_summary', 'pupworld_trust_badges', 35 );

/**
 * Output cart icon markup used in the header.
 */
function pupworld_cart_link() {
    if ( ! function_exists( 'WC' ) ) {
        return;
    }
    $count = WC()->cart->get_cart_contents_count();
    echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="cart-icon text-light position-relative">'
        . '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">'
        . '<path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1.5 7A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.491-.408L1.01 3.607A.5.5 0 0 1 1 3.5V2H.5a.5.5 0 0 1-.5-.5zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4z"/>'
        . '</svg>';
    if ( $count > 0 ) {
        echo '<span class="cart-count position-absolute top-0 start-100 translate-middle badge rounded-pill">'
            . esc_html( $count ) . '</span>';
    }
    echo '</a>';
}

/**
 * Ensure cart icon fragments are updated via AJAX when products are added.
 */
function pupworld_cart_link_fragment( $fragments ) {
    ob_start();
    pupworld_cart_link();
    $fragments['a.cart-icon'] = ob_get_clean();
    return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'pupworld_cart_link_fragment' );

/**
 * Display result count above catalog ordering dropdown.
 */
function pupworld_shop_controls() {
    echo '<div class="pupworld-shop-controls">';
    woocommerce_result_count();
    woocommerce_catalog_ordering();
    echo '</div>';
}

add_action( 'init', function() {
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
    remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
    add_action( 'woocommerce_before_shop_loop', 'pupworld_shop_controls', 20 );
} );

/**
 * Add "Sort by Breed" option to the catalog ordering dropdown.
 */
function pupworld_sortby_breed_option( $options ) {
    $options = array( 'breed' => __( 'Sort by Breed', 'pupworld' ) ) + $options;
    return $options;
}
add_filter( 'woocommerce_catalog_orderby', 'pupworld_sortby_breed_option' );

/**
 * Make "Sort by Breed" the default catalog order.
 */
add_filter( 'woocommerce_default_catalog_orderby', function() {
    return 'breed';
} );

/**
 * Adjust ordering arguments for the custom breed sort option.
 */
function pupworld_sortby_breed_args( $args ) {
    $orderby = isset( $_GET['orderby'] ) ? wc_clean( wp_unslash( $_GET['orderby'] ) ) : get_option( 'woocommerce_default_catalog_orderby' );

    if ( 'breed' === $orderby ) {
        $args['orderby'] = 'breed';
        $args['order']   = 'ASC';
    }

    return $args;
}
add_filter( 'woocommerce_get_catalog_ordering_args', 'pupworld_sortby_breed_args' );

/**
 * Modify the main product query to sort products alphabetically by category.
 */
function pupworld_sortby_breed_clauses( $clauses, $query ) {
    if ( isset( $query->query_vars['orderby'] ) && 'breed' === $query->query_vars['orderby'] ) {
        global $wpdb;
        $clauses['join']   .= " LEFT JOIN {$wpdb->term_relationships} tr ON {$wpdb->posts}.ID = tr.object_id";
        $clauses['join']   .= " LEFT JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id = tt.term_taxonomy_id AND tt.taxonomy = 'product_cat'";
        $clauses['join']   .= " LEFT JOIN {$wpdb->terms} t ON tt.term_id = t.term_id";
        $clauses['groupby'] = "{$wpdb->posts}.ID";
        $clauses['orderby'] = 't.name ASC';
    }

    return $clauses;
}
add_filter( 'posts_clauses', 'pupworld_sortby_breed_clauses', 10, 2 );

/**
 * Ensure the default orderby value is applied to the main product query.
 */
function pupworld_set_default_breed_order( $query ) {
    if ( ! is_admin() && $query->is_main_query() && ( is_shop() || is_product_taxonomy() ) ) {
        if ( ! isset( $_GET['orderby'] ) ) {
            $query->set( 'orderby', 'breed' );
        }
    }
}
add_action( 'pre_get_posts', 'pupworld_set_default_breed_order' );

