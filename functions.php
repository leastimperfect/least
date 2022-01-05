<?php

if ( ! function_exists( 'least_support' ) ) :
	function least_support()  {

		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );
	}
	add_action( 'after_setup_theme', 'least_support' );
endif;

/**
 * Enqueue scripts and styles.
 */
function least_scripts() {
	// Enqueue theme stylesheet.
	wp_enqueue_style( 'least-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
}

add_action( 'wp_enqueue_scripts', 'least_scripts' );
