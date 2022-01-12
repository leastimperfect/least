<?php

class Least {

	/** @var self Instance */
	private static $_instance;

	private function __construct() {
		add_filter( 'default_wp_template_part_areas', array( $this, 'template_part_areas' ) );
		add_action( 'after_setup_theme', array( $this, 'support' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
	}

	/**
	 * Returns instance of current calss
	 * @return self Instance
	 */
	public static function instance() {
		if ( ! self::$_instance ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function support( $areas ) {
		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );
	}

	public function scripts( $areas ) {
		// Enqueue theme stylesheet.
		wp_enqueue_style( 'least-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	public function template_part_areas( $areas ) {
		$areas[] = array(
			'area'        => 'blog-content',
			'label'       => __( 'Blog post content', 'gutenberg' ),
			'description' => __(
				'Templates in blog content area shows on page with multiple posts.'
			),
			'icon'        => 'footer',
			'area_tag'    => 'footer',
		);

		return $areas;
	}
}