<?php

require_once 'least-blocks.php';

/**
 * Class Least
 * Theme engine room
 */
class Least {

	/** @var self Instance */
	private static $_instance;

	/**
	 * Least constructor.
	 * Adds hooks for Least theme
	 */
	private function __construct() {
		$this->block_hooks();
		add_action( 'after_setup_theme', array( $this, 'support' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ) );
// Changing excerpt more
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ) );
	}

	/**
	 * Adds block hooks from Least_Blocks class
	 * @uses Least_Blocks
	 */
	private function block_hooks() {
		$blk = Least_Blocks::instance();
		add_filter( 'default_wp_template_part_areas', array( $blk, 'template_part_areas' ) );
		add_action( 'wp_head', array( $blk, 'before_maybe_inline_styles' ), 0 );
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

	/**
	 * Adds theme supports
	 * @action after_setup_theme
	 */
	public function support() {
		// Adding support for core block visual styles.
		add_theme_support( 'wp-block-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style.css' );
	}

	/**
	 * Enqueues theme styles/scripts
	 * @action wp_enqueue_scripts
	 */
	public function enqueue() {
		// Enqueue theme stylesheet.
		wp_enqueue_style( 'least-style', get_template_directory_uri() . '/style.css', array(), wp_get_theme()->get( 'Version' ) );
	}

	/**
	 * Adds read more link
	 * @param int $count
	 * @return string
	 */
	public function excerpt_length( $count ) {
		return 25;
	}

	/**
	 * Adds read more link
	 * @param $more
	 * @return string
	 */
	public function excerpt_more( $more ) {
		global $post;

		return '&hellip; <a href="' . get_permalink( $post->ID ) . '">Read More</a>';
	}
}