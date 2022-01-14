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

	public static function pattern( $slug, $title, $content = '', $props = [] ) {
		if ( is_array( $content ) ) {
			$props = $content;
			$content = '';
		}

		$pattern_content_file = get_theme_file_path( "patterns/$slug.html" );

		if ( ! $content && file_exists( $pattern_content_file ) ) {
			$content = file_get_contents( $pattern_content_file );
		}

		$pattern_name = "least/$slug";

		$props = wp_parse_args( $props, [
			'title'       => $title,
			'content'     => $content,
		] );

		register_block_pattern( $pattern_name, $props );
	}

	public function register_patterns() {
		self::pattern( 'least-branding', 'Least theme branding', '
<!-- wp:columns {"verticalAlignment":"bottom"} --><div class="wp-block-columns are-vertically-aligned-bottom"><!-- wp:column {"verticalAlignment":"bottom","width":"35%"} --><div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:35%">
<!-- wp:paragraph -->
<p>Copyright &copy;' . date( 'Y' ) . ' ' . get_bloginfo( 'name' ) . '</p>
<!-- /wp:paragraph -->
</div><!-- /wp:column --><!-- wp:column {"verticalAlignment":"bottom","width":"65%"} --><div class="wp-block-column is-vertically-aligned-bottom" style="flex-basis:65%"><!-- wp:paragraph {"align":"right"} -->
<p class="has-text-align-right">
Powered by <a href="https://wordpress.org">WordPress</a> | <a href="https://leastimperfect.com/least-theme" data-type="URL" data-id="https://leastimperfect.com/least-theme">Least theme</a> designed by <a href="https://leastimperfect.com/" data-type="URL" data-id="https://leastimperfect.com/">Least imperfect</a></p>
<!-- /wp:paragraph --></div><!-- /wp:column --></div><!-- /wp:columns -->' );
	}

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