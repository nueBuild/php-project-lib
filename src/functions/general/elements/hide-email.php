<?php
/**
 * Hide Email
 *
 * @package    NBPL
 * @subpackage NBPL/Functions/General/Elements
 * @author     NueBuild
 * @copyright  Copyright (c) 2020, NueBuild
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 */

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! function_exists( 'nbpl_hide_email' ) ) {
	/**
	 * Hide Email
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param string|array $args {
	 *     $args Can be an email address string or array of parameters.
	 *
	 *     @type string  $email              (Required) The email address. Default: ''.
	 *     @type string  $text               (Optional) Text to display in the link. Default: ''.
	 *     @type string  $id                 (Optional) The link id attribute. Default: ''.
	 *     @type string  $classes            (Optional) The link class attribute. Default: ''.
	 *     @type string  $attributes         (Optional) Any additional link attributes. Default: ''.
	 *     @type string  $wrapper            (Optional) The wrapper element. Default: ''.
	 *     @type string  $wrapper_id         (Optional) The wrapper id attribute. Default: ''.
	 *     @type string  $wrapper_classes    (Optional) The wrapper class attribute. Default: ''.
	 *     @type string  $wrapper_attributes (Optional) Any additional wrapper attributes. Default: ''.
	 *     @type boolean $link               (Optional) If true the email will be a mailto link. Default true.
	 * }
	 *
	 * @return string
	 */
	function nbpl_hide_email( $args = array() ) {
		$class = new NBPL\General\Elements\HideEmail( $args );
		return $class->email();
	}
}
