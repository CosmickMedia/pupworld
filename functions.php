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
