<?php
/**
 * Disable Templates.
 *
 * @package    NBPL
 * @subpackage NBPL/WordPress/General
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    1.0.0
 * @since      1.0.0
 */

namespace NBPL\WordPress\General;

use NBPL\Base;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\\DisableTemplates' ) ) {

	/**
	 * Disable Templates.
	 *
	 * @author Jason Witt
	 * @since  Plugin_Boilerplate_Version
	 */
	class DisableTemplates extends Base {

		/**
		 * Initialize the class
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
		public function __construct( $args = array() ) {
			$this->defaults = $this->set_defaults();
			parent::__construct( $args );

			$this->hooks();
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
				'archives'       => false,
				'attachment'     => false,
				'author'         => false,
				'authors'        => array(),
				'category'       => false,
				'category_types' => array(),
				'date'           => false,
				'day'            => false,
				'month'          => false,
				'search'         => false,
				'single'         => false,
				'single_types'   => array(),
				'tag'            => false,
				'tag_types'      => array(),
				'taxonomy'       => false,
				'taxonomy_types' => array(),
				'time'           => false,
				'year'           => false,
				'redirect_type'  => 'home',
			);
		}

		/**
		 * Hooks.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function hooks() {
			add_action( 'wp', array( $this, 'disable_templates' ) );
			add_action( 'parse_query', array( $this, 'disable_search' ) );

			if ( true === $this->args->search && is_search() ) {
				add_filter(
					'get_search_form',
					function( $a ) {
						return null;
					}
				);
			}
		}

		/**
		 * Disable Templates.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function disable_templates() {
			$this->disable( 'is_category', 'category', 'category_types' ); // Category.
			$this->disable( 'is_tag', 'tag', 'tag_types' ); // Tags.
			$this->disable( 'is_tax', 'taxonomy', 'taxonomy_types' ); // Taxonomies.
			$this->disable( 'is_author', 'author', 'authors' ); // Authors.
			$this->disable( 'is_date', 'date' ); // Date.
			$this->disable( 'is_year', 'year' ); // Year.
			$this->disable( 'is_month', 'month' ); // Month.
			$this->disable( 'is_day', 'day' ); // Day.
			$this->disable( 'is_time', 'time' ); // Time.
			$this->disable( 'is_attachment', 'attachment' ); // Attachments.
			$this->disable( 'is_archive', 'archives' ); // Archives.
			$this->disable( 'is_single', 'single', 'single_types' ); // Single.
		}

		/**
		 * Disable Search.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param string $query The modified query.
		 *
		 * @return void
		 */
		public function disable_search( $query ) {
			if ( true === $this->args->search && is_search() ) {
				$query->is_search       = false;
				$query->query_vars[ s ] = false;
				$query->query[ s ]      = false;

				$this->redirection();
			}
		}

		/**
		 * Disable.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param callback $callback The funtion to use.
		 * @param string   $template The singlgular template type.
		 * @param array    $types    The specific template types.
		 *
		 * @return void
		 */
		public function disable( $callback, $template, $types = '' ) {
			$types = ( isset( $this->args->$types ) ) ? $this->args->$types : array();

			if ( ! empty( $types ) && call_user_func( $callback, $types ) ) {
				$this->redirection();
			}
			if ( true === $this->args->$template && call_user_func( $callback ) ) {
				$this->redirection();
			}
		}

		/**
		 * Redirection.
		 *
		 * @author Theme_Author
		 * @since  1.0.0
		 *
		 * @global $wp_query
		 *
		 * @return void
		 */
		public function redirection() {
			global $wp_query;

			if ( '404' === $this->args->redirect_type ) {
				$wp_query->set_404();
				return;
			}

			wp_safe_redirect( home_url() );
			exit;
		}
	}
}
