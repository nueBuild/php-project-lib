<?php
/**
 * Disable Templates
 *
 * @package    NBPL
 * @subpackage NBPL/Functions/General
 * @author     NueBuild
 * @copyright  Copyright (c) 2020, NueBuild
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 */

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! function_exists( 'nbpl_disable_templates' ) ) {
	/**
	 * Disable Templates
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 *
	 * @param array $args {
	 *     Array of arguments for the disabling the template pages.
	 *
	 *     @type boolean $archives       (Optional) The all archives page templates. Default: false.
	 *     @type boolean $attachment     (Optional) Disable the attachment page template. Default: false.
	 *     @type boolean $author         (Optional) Disable the author page template. Default: false.
	 *     @type array   $authors        (Optional) Disable an array of specific author page templates. Default: array().
	 *     @type boolean $category       (Optional) Disable the category page template. Default: false.
	 *     @type array   $category_types (Optional) Disable an array of specific category page templates. Default: array().
	 *     @type boolean $date           (Optional) Disable the date page template. Default: false.
	 *     @type boolean $day            (Optional) Disable the day page template. Default: false.
	 *     @type boolean $month          (Optional) Disable the month page template. Default: false.
	 *     @type boolean $search         (Optional) Disable the search page template. Default: false.
	 *     @type boolean $single         (Optional) Disable the single page template. Default: false.
	 *     @type array   $single_types   (Optional) Disable an array of specific single page templates. Default: array().
	 *     @type boolean $tag            (Optional) Disable the tag page template. Default: false.
	 *     @type array   $tag_types      (Optional) Disable an array of specific tag page templates. Default: array().
	 *     @type boolean $taxonomy       (Optional) Disable the taxonomy page template. Default: false.
	 *     @type array   $taxonomy_types (Optional) Disable an array of specific taxonomy page templates. Default: array().
	 *     @type boolean $time           (Optional) Disable the time page template. Default: false.
	 *     @type boolean $year           (Optional) Disable the year page template. Default: false.
	 *     @type string  $redirect_type  (Optional) The type of redirection, '404' page or 'home' page. Default: 'home'.
	 * }
	 *
	 * @return void
	 */
	function nbpl_disable_templates( $args = array() ) {
		new NBPL\WordPress\General\DisableTemplates( $args );
	}
}
