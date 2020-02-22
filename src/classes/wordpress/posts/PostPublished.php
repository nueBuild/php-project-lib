<?php
/**
 * Post Published
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

if ( ! class_exists( __NAMESPACE__ . '\\PostPublished' ) ) {

	/**
	 * Post Published
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class PostPublished extends Base {

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param array $args {
		 *     The arguments.
		 *
		 *     @type string $more_text The text for the more link.
		 *                             Default: 'Continue Reading'.
		 *     @type string $classes   The classes for the more text span tag.
		 *                             Defualt: null.
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
				'label'                => __( 'Published: ', 'nbpl' ),
				'time_classes'         => 'entry__published-time published-time',
				'time_updated_classes' => 'entry__published-time-updated published-time-updated',
				'classes'              => 'entry__published published',
			);
		}

		/**
		 * Time Classes Filter
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return string
		 */
		public function time_classes_filter() {
			return apply_filters( "{$this->prefix}_{$this->class_prefix}_time_classes", $this->args->time_classes );
		}

		/**
		 * Time Updated Classes Filter
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return string
		 */
		public function time_updated_classes_filter() {
			return apply_filters( "{$this->prefix}_{$this->class_prefix}_time_updated_classes", $this->args->time_updated_classes );
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

			$time_classes = ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) ? $this->time_classes_filter() : $this->time_updated_classes_filter();
			$time_tag     = '<time class="' . esc_attr( $time_classes ) . '" datetime="%1$s">%2$s</time>';
			$time         = sprintf( $time_tag, esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) );
			$classes      = ( $this->args->classes ) ? ' class="' . esc_attr( $this->classes_filter() ) . '"' : '';
			$output       = '<div' . $classes . '><span class="label">' . esc_html( $this->args->label ) . '</span> <a href="' . esc_url( get_the_permalink() ) . '" rel="bookmark">' . $time . '</a></div>';

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
