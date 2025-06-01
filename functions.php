<?php
defined( 'ABSPATH' ) || exit;

class PUPWORLD_THEME {
	function __construct() {
		add_action( 'after_setup_theme', [ $this, 'after_setup_theme' ] );
		add_action( 'init', [ $this, 'register_nav_menus' ] );
		//add_action( 'init', [ $this, 'register_acf_blocks' ] );
	}

	function after_setup_theme() {
		add_theme_support( 'menus' );
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
