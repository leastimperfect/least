<?php
/**
 * Class Least_Blocks
 * Manages blocks related stuff, styles/scripts and patterns
 */
class Least_Blocks {
	/** @var self Instance */
	private static $_instance;

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

	/** Least_Blocks constructor, private for only single instance */
	private function __construct() {}

	public function template_part_areas( $areas ) {
		$areas[] = array(
			'area'        => 'blog-content',
			'label'       => __( 'Blog post content', 'least' ),
			'description' => __( 'Templates in blog content area shows on page with multiple posts.', 'least' ),
			'icon'        => 'footer',
			'area_tag'    => 'section',
		);

		return $areas;
	}

	public function before_maybe_inline_styles() {
		wp_deregister_style( 'wp-block-post-template' );
	}
}