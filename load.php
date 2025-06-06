<?php
/**
 * Pup World functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Pup World
 * @since Pup World 1.0
 */

declare( strict_types = 1 );

if ( ! function_exists( 'pupworld_unregister_patterns' ) ) :
	/**
	 * Unregister Jetpack patterns and core patterns bundled in WordPress.
	 */
        function pupworld_unregister_patterns() {
		$pattern_names = array(
			// Jetpack form patterns.
			'contact-form',
			'newsletter-form',
			'rsvp-form',
			'registration-form',
			'appointment-form',
			'feedback-form',
			// Patterns bundled in WordPress core.
			// These would be removed by remove_theme_support( 'core-block-patterns' )
			// if it's called on the init action with priority 9 from a plugin, not from a theme.
			'core/query-standard-posts',
			'core/query-medium-posts',
			'core/query-small-posts',
			'core/query-grid-posts',
			'core/query-large-title-posts',
			'core/query-offset-posts',
			'core/social-links-shared-background-color',
		);
		foreach ( $pattern_names as $pattern_name ) {
			$pattern = \WP_Block_Patterns_Registry::get_instance()->get_registered( $pattern_name );
			if ( $pattern ) {
				unregister_block_pattern( $pattern_name );
			}
		}
	}

endif;

if ( ! function_exists( 'pupworld_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
 * @since Pup World 1.0
	 *
	 * @return void
	 */
        function pupworld_setup() {

		// Enqueue editor styles.
		add_editor_style( 'style.css' );
		// Unregister Jetpack form patterns and core patterns bundled in WordPress.
		// Simple sites
                pupworld_unregister_patterns();
		add_filter( 'wp_loaded', function () {
			// Atomic sites
                        pupworld_unregister_patterns();
		} );
		// Remove theme support for the core and featured patterns coming from the Dotorg pattern directory.
		remove_theme_support( 'core-block-patterns' );
	}

endif;

add_action( 'after_setup_theme', 'pupworld_setup' );

if ( ! function_exists( 'pupworld_styles' ) ) :
        /**
         * Enqueue Bootstrap and theme styles.
         *
 * @since Pup World 1.0
         *
         * @return void
         */
        function pupworld_styles() {

                wp_register_style(
                        'bootstrap-css',
                        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css',
                        array(),
                        '5.3.2'
                );

               wp_register_style(
                       'font-awesome',
                       'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
                       array(),
                       '6.4.0'
               );

               wp_register_style(
                       'pupworld-google-fonts',
                       'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap',
                       array(),
                       null
               );

               wp_register_style(
                       'pupworld-style',
                       get_template_directory_uri() . '/style.css',
                       array( 'bootstrap-css' ),
                       PUPWORLD_VERSION
               );

               wp_register_style(
                       'swiper-css',
                       'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css',
                       array(),
                       '9.4.1'
               );

               wp_enqueue_style( 'bootstrap-css' );
               wp_enqueue_style( 'font-awesome' );
               wp_enqueue_style( 'pupworld-google-fonts' );
               wp_enqueue_style( 'swiper-css' );
               wp_enqueue_style( 'pupworld-style' );

               wp_register_script(
                       'bootstrap-js',
                       'https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js',
                       array(),
                       '5.3.2',
                       true
               );

               wp_register_script(
                       'swiper-js',
                       'https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js',
                       array(),
                       '9.4.1',
                       true
               );

               wp_register_script(
                       'pupworld-dropdown',
                       get_template_directory_uri() . '/assets/js/dropdown.js',
                       array( 'bootstrap-js' ),
                       PUPWORLD_VERSION,
                       true
               );

               wp_register_script(
                       'pupworld-product',
                       get_template_directory_uri() . '/assets/js/product.js',
                       array( 'swiper-js' ),
                       PUPWORLD_VERSION,
                       true
               );

               wp_enqueue_script( 'bootstrap-js' );
               wp_enqueue_script( 'pupworld-dropdown' );
               wp_enqueue_script( 'swiper-js' );
               wp_enqueue_script( 'pupworld-product' );

        }

endif;

add_action( 'wp_enqueue_scripts', 'pupworld_styles' );
