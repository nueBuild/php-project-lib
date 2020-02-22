<?php
/**
 * RWDImage.
 *
 * @package    NBPL
 * @subpackage NBPL/WordPress/Media
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 *
 * @version 1.0.4
 */

namespace NBPL\WordPress\Media;

use NBPL\Base;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\\RWDImage' ) ) {

	/**
	 * RWDImage.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class RWDImage extends Base {

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param array $args {
		 *     The arguments.
		 *
		 *     @type string  $id        The image ID.
		 *     @type string  $size      The image size.
		 *     @type string  $max_width The max width of the image to be displayed.
		 *     @type boolean $data      True to return an array of the image data.
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
				'id'        => '',
				'size'      => 'full',
				'max_width' => '1600',
				'data'      => false,
			);
		}

		/**
		 * Get.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return mixed
		 */
		public function get() {

			// Bail if image id is not set.
			if ( ! isset( $this->args->id ) || ! $this->args->id ) {
				return;
			}

			$image_src    = '';
			$image_data   = wp_get_attachment_metadata( $this->args->id );
			$image_sizes  = isset( $image_data['sizes'] ) ? $image_data['sizes'] : '';
			$image_srcset = array();
			$image_alt    = get_post_meta( $this->args->id, '_wp_attachment_image_alt', true );

			// Check if image has rentina size, else serve normal size.
			$image_size = array_key_exists( '@2x-' . $this->args->size, $image_sizes ) ? $image_sizes : substr( $this->args->size, 4 );
			$image_src  = wp_get_attachment_image_url( $this->args->id, $this->args->size );

			foreach ( $image_sizes as $key => $value ) {
				$url = wp_get_attachment_image_src( $this->args->id, $key );

				if ( isset( $url[0] ) ) {
					$image_srcset[] = $url[0];
				}
			}

			if ( $this->args->data ) {
				return array(
					'src'   => $image_src,
					'alt'   => $image_alt,
					'sizes' => $image_sizes,
				);
			}

			echo wp_kses_post( 'src="' . $image_src . '" srcset="' . implode( ' ', $image_srcset ) . '" sizes="(max-width: ' . $this->args->max_width . ') 100vw, ' . $this->args->max_width . '" alt="' . $image_alt . '"' );
		}
	}
}
