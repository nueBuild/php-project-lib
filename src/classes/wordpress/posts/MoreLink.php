<?php
/**
 * More Link
 *
 * @package    NBPL
 * @subpackage NBPL/WordPress/Posts
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    1.0.0
 * @since      1.0.0
 */

namespace NBPL\WordPress\Posts;

use NBPL\Base;

if ( ! class_exists( __NAMESPACE__ . '\\MoreLink' ) ) {

	/**
	 * More Link
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class MoreLink extends Base {

		/**
		 * Initialize the class.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param array $args {
		 *     The arguments.
		 *
		 *     @type string $more_text (Optional) The text for the more link. Default: 'Continue Reading'.
		 *     @type string $wrapper   (Optional) The wrapper html tag. Default: 'div'.
		 *     @type string $classes   (Optional) The classes for the more text span tag. Defualt: 'more-text'.
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
				'more_text' => __( 'Continue Reading', 'nbpl' ),
				'wrapper'   => 'div',
				'classes'   => 'entry__more-link more-link',
			);
		}

		/**
		 * More Text Filter
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return string
		 */
		public function more_text_filter() {
			return apply_filters( "{$this->prefix}_{$this->class_prefix}_text", $this->args->more_text );
		}

		/**
		 * Classes Filter
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
		 * Output Filter
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
		 * Output
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
			$output  = sprintf( '<' . $this->args->wrapper . $classes . '><a href="' . esc_url( get_the_permalink() ) . '" rel="bookmark">%s</a></' . $this->args->wrapper . '>', esc_html( $this->more_text_filter() ) );

			/**
			 * Action before returing the output
			 *
			 * @author Jason Witt
			 * @since  1.0.0
			 */
			do_action( "{$this->prefix}_{$this->class_prefix}_before_output" );

			echo wp_kses_post( $this->output_filter( $output ) );
		}
	}
}
