<?php
/**
 * Author Byline
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

if ( ! class_exists( __NAMESPACE__ . '\\AuthorByline' ) ) {

	/**
	 * Author Byline
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class AuthorByline extends Base {

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param array $args {
		 *     The arguments.
		 *
		 *     @type string $label           (Optional) The label text. Default: 'Author'.
		 *     @type string $wrapper         (Optional) The wrapper html tag. Default: 'div'.
		 *     @type string $link_classes    (Optional) The link classes. Default: 'rl fn n'.
		 *     @type string $byline_classes  (Optional) The Byline classes. Default: 'entry__byline byline'.
		 *     @type string $wrapper_classes (Optional) The Author classes. Default: 'entry__author author vcard'.
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
				'label'           => __( 'Author: ', 'nbpl' ),
				'wrapper'         => 'div',
				'link_classes'    => 'url fn n',
				'byline_classes'  => 'entry__byline byline',
				'wrapper_classes' => 'entry__author author vcard',
				'link'            => true,
			);
		}

		/**
		 * Author By Text Filter
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return string
		 */
		public function author_label_filter() {
			return apply_filters( "{$this->prefix}_{$this->class_prefix}_author_label", $this->args->label );
		}

		/**
		 * A Tag Classes Filter
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return string
		 */
		public function link_classes_filter() {
			return apply_filters( "{$this->prefix}_{$this->class_prefix}_link_classes", $this->args->link_classes );
		}

		/**
		 * Byline Classes Filter
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return string
		 */
		public function byline_classes_filter() {
			return apply_filters( "{$this->prefix}_{$this->class_prefix}_byline_classes", $this->args->byline_classes );
		}

		/**
		 * Author Classes Filter
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return string
		 */
		public function wrapper_classes_filter() {
			return apply_filters( "{$this->prefix}_{$this->class_prefix}_wrapper_classes", $this->args->wrapper_classes );
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

			$link_classes    = ( $this->args->link_classes ) ? ' class="' . esc_attr( $this->link_classes_filter() ) . '"' : '';
			$url             = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
			$link_markup     = '<a' . $link_classes . ' href="' . esc_url( $url ) . '">' . esc_html( get_the_author() ) . '</a>';
			$link            = ( $this->args->link ) ? $link_markup : esc_html( get_the_author() );
			$byline_classes  = ( $this->args->byline_classes ) ? ' class="' . esc_attr( $this->byline_classes_filter() ) . '"' : '';
			$wrapper_classes = ( $this->args->wrapper_classes ) ? ' class="' . esc_attr( $this->wrapper_classes_filter() ) . '"' : '';
			$output          = '<' . $this->args->wrapper . $byline_classes . '><span class="label">' . esc_html( $this->author_label_filter() ) . '</span> <span' . $wrapper_classes . '>' . $link . '</span></' . $this->args->wrapper . '>';

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
