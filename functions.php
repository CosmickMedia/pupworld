<?php
defined( 'ABSPATH' ) || exit;

function bark_scripts() {
    wp_enqueue_style( 'bark-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );
}
add_action( 'wp_enqueue_scripts', 'bark_scripts' );

class BARK_THEME {
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

$BARK_THEME = new BARK_THEME();

require_once ( dirname( __FILE__ ) . '/load.php' );
