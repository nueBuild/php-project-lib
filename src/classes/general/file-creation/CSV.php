<?php
/**
 * CSV.
 *
 * @package    NBPL
 * @subpackage NBPL/General/File_Creation
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 *
 * @version 1.0.1
 */

namespace NBPL\General\File_Creation;

use NBPL\Base;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\\CSV' ) ) {

	/**
	 * CSV.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class CSV extends Base {

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param array $args {
		 *     $args $args The arguments.
		 *
		 *     @type string  $filename           (Required) The name of the CSV file. Default: ''.
		 *     @type array   $data               (Required) A multidimensional array of used to build csv file. Default: Array.
		 *     @type string  $header             (Optional) The column headers for the cvs file. Default: Array.
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
		protected function set_defaults() {
			return [
				'filename' => '',
				'data'     => [],
				'header'   => [],
			];
		}

		/**
		 * Build
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @throws \Exception If the file nane is not set.
		 * @throws \Exception If no data is set.
		 *
		 * @return void
		 */
		public function build() {
			set_time_limit( 0 );

			$filename = $this->args->filename;

			try {
				$output = fopen( 'php://output', 'w' );

				header( 'Content-Type:application/csv' );

				if ( ! empty( $filename ) ) {
					header( "Content-Disposition:attachment;filename=${filename}.csv" );
				} else {
					throw new \Exception( 'A file name is required!' );
				}

				if ( ! empty( $this->args->header ) ) {
					$header_array = array();
					foreach ( $this->args->header as $header ) {
						foreach ( $header as $key => $value ) {
							$header_arrayout[] = $key;
						}
					}
					fputcsv( $output, $header_array );
				}

				if ( ! empty( $this->args->data ) ) {
					foreach ( $this->args->data as $line ) {
						fputcsv( $output, $line );
					}
				} else {
					throw new \Exception( 'No data found!' );
				}

				fclose( $output ); // phpcs:ignore
				die();
			} catch ( \Exception $e ) {
				echo 'Caught exception: ',  $e->getMessage(), "\n"; // phpcs:ignore
				die();
			}
		}
	}
}
