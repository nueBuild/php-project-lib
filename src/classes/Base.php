<?php
/**
 * Base Class
 *
 * @package    NBPL
 * @subpackage NBPL
 * @author     NueBuild
 * @copyright  Copyright (c) 2020, NueBuild
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 *
 * @version 1.0.5
 */

namespace NBPL;

use NBPL\General\Formatting\Parse;

/**
 * Base Class
 */
abstract class Base {

	/**
	 * Prefix.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @var string
	 */
	protected $prefix;

	/**
	 * Argument Defaults.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @var string
	 */
	protected $defaults = array();

	/**
	 * Arguments.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @var array
	 */
	protected $args = array();

	/**
	 * Class Prefix.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @var string
	 */
	protected $class_prefix = '';

	/**
	 * Initialize the class.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param array $args The arguments.
	 *
	 * @return void
	 */
	public function __construct( $args = array() ) {
		$this->args = Parse::array_to_object( $args, $this->defaults );

		// Get the Class Prefix.
		$this->get_class_prefix();
	}

	/**
	 * Get class prefix
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @return void
	 */
	private function get_class_prefix() {
		// Get the name of the class without the namespace.
		$name = ( new \ReflectionClass( $this ) )->getShortName();

		// Add underscore between the camelcase letters.
		$underscore = preg_replace( '/\B([A-Z])/', '_$1', $name );

		// Make the name all lower case and add an underscore at the end.
		$this->class_prefix = strtolower( $underscore );
	}
}
