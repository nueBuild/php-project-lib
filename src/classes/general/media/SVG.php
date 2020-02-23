<?php
/**
 * SVG.
 *
 * @package    NBPL
 * @subpackage NBPL/General/Media
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 *
 * @version 1.0.5
 */

namespace NBPL\General\Media;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\\SVG' ) ) {

	/**
	 * SVG.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class SVG {

		/**
		 * SVG Paths
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @var array
		 */
		protected static $svg_paths = array();

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function __construct() {}

		/**
		 * Set Paths
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param array $args The paths to svg files.
		 *
		 * @return void
		 */
		public static function set_paths( $args = array() ) {
			self::$svg_paths = $args;
		}

		/**
		 * Get
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param string $path       The path to the files.
		 * @param string $filename   The svg filename.
		 * @param array  $attributes Attributes for the image HTML output.
		 *
		 * @throws \Exception If the file cannot be found.
		 *
		 * @return void
		 */
		public static function get( $path, $filename, $attributes = array() ) {
			if ( ! empty( self::$svg_paths ) ) {
				foreach ( self::$svg_paths as $key => $value ) {
					if ( $key === $path ) {
						$path = $value;
					}
					break;
				}
			}

			$id      = ! empty( $attributes['id'] ) ? ' id="' . $attributes['id'] . '"' : '';
			$classes = ! empty( $attributes['classes'] ) ? ' class="' . $attributes['classes'] . '"' : '';
			$alt     = ! empty( $attributes['alt'] ) ? ' alt="' . $attributes['alt'] . '"' : '';
			$attrs   = ! empty( $attributes['attributes'] ) ? ' ' . $attributes['attributes'] : '';

			?>
				<span <?php echo $id . $classes . $alt . $attrs; // phpcs:ignore ?>>
					<?php
					try {
						if ( file_exists( $path . '/' . $filename . '.svg' ) ) {
							include $path . '/' . $filename . '.svg';
						} else {
							throw new \Exception( 'Image could not be found!' );
						}
					} catch ( \Exception $e ) {
						echo '<p><strong><em>' . $e->getMessage() . '</em></strong></p>'; // phpcs:ignore
					}
					?>
				</span>
			<?php
		}
	}
}
