<?php
/**
 * Comments Title
 *
 * @package    NBPL
 * @subpackage NBPL/WordPress/Posts
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 *
 * @version 1.0.4
 */

namespace NBPL\WordPress\Posts;

use NBPL\Base;

if ( ! class_exists( __NAMESPACE__ . '\\CommentsTitle' ) ) {

	/**
	 * Comments Title
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class CommentsTitle extends Base {

		/**
		 * Comment Count.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @var int
		 */
		protected $comment_count;

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param array $args {
		 *     The arguments.
		 *
		 *     @type string $singular (Optional) The Singular text. Default: 'Comment for'.
		 *     @type string $plural   (Optional) The plural text. Default: 'Comments for'.
		 *     @type string $wrapper  (Optional) The wrapper html tag. Default: 'span'.
		 *     @type string $classes  (Optional) The wrapper calsses. Default: 'comments__title'.
		 * }
		 *
		 * @return void
		 */
		public function __construct( $args = array() ) {
			$this->defaults = $this->set_defaults();
			parent::__construct( $args );
		}

		/**
		 * Set Defaults
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return array
		 */
		public function set_defaults() {
			return array(
				'singular' => __( 'Comment for', 'nbpl' ),
				'plural'   => __( 'Comments for', 'nbpl' ),
				'wrapper'  => 'span',
				'classes'  => 'comments__title',
			);
		}

		/**
		 * Comments Title Filter.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return string
		 */
		public function comments_title_filter() {
			$singular = $this->args->singular;
			$plural   = $this->args->plural;
			$text     = sprintf(
				_nx( '%1$s %2$s', '%1$s %3$s', $this->comment_count, 'comments title', 'nbpl' ), // phpcs:ignore
				esc_html( number_format_i18n( $this->comment_count ) ),
				esc_html( $singular ),
				esc_html( $plural )
			);

			return apply_filters( "{$this->prefix}_{$this->class_prefix}_text", $text );
		}

		/**
		 * Classes Filter.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return string
		 */
		public function classes_filter() {
			return apply_filters( "{$this->prefix}_{$this->class_prefix}_classes", $this->args->classes );
		}

		/**
		 * Output Filter.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param string $string The output text.
		 *
		 * @return string
		 */
		public function output_filter( $string ) {
			return apply_filters( "{$this->prefix}_{$this->class_prefix}_outout", $string );
		}

		/**
		 * Output.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function render() {
			$post = get_post();

			if ( $post ) {
				setup_postdata( $post );
			}

			$classes = ( $this->args->classes ) ? ' class="' . esc_attr( $this->classes_filter() ) . '"' : '';
			$output  = '<span' . $classes . '>' . esc_html( $this->comments_title_filter() ) . ' ' . esc_html( get_the_title() ) . '</span>';

			/**
			 * Action before returing the output.
			 *
			 * @author Jason Witt
			 * @since  1.0.0
			 */
			do_action( "{$this->prefix}_{$this->class_prefix}_before_output" );

			echo wp_kses_post( $this->output_filter( $output ) );
		}
	}
}
