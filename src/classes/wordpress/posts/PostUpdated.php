<?php
/**
 * Post Updated
 *
 * @package    NBPL
 * @subpackage NBPL/WordPress/Posts
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 *
 * @version 1.0.2
 */

namespace NBPL\WordPress\Posts;

use NBPL\Base;

if ( ! class_exists( __NAMESPACE__ . '\\PostUpdated' ) ) {

	/**
	 * Post Updated
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class PostUpdated extends Base {

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
				'text'         => __( 'Updated: ', 'nbpl' ),
				'time_classes' => 'entry__updated-time updated-time',
				'classes'      => 'entry__updated updated-on',
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

			$time_classes = ( $this->args->time_classes ) ? ' class="' . esc_attr( $this->time_classes_filter() ) . '"' : '';
			$time_tag     = '<time' . $time_classes . ' datetime="%1$s">%2$s</time>';
			$time         = sprintf( $time_tag, esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() ) );
			$classes      = ( $this->args->classes ) ? ' class="' . esc_attr( $this->classes_filter() ) . '"' : '';
			$output       = '<div' . $classes . '><span class="label">' . esc_html( $this->args->text ) . '</span> <a href="' . esc_url( get_the_permalink() ) . '" rel="bookmark">' . $time . '</a></div>';

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
