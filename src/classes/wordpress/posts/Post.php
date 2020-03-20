<?php
/**
 * Get Post Data
 *
 * @package    NBPL
 * @subpackage NBPL/WordPress/Posts
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 *
 * @version 1.0.5
 */

namespace NBPL\WordPress\Posts;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\\Post' ) ) {

	/**
	 * Get Post Data
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class Post {

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
		 * Get the Post ID
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return int
		 */
		public function get_id() {
			global $post, $wp_query;

			$post_id = '';

			if ( ! empty( get_the_ID() ) ) {
				$post_id = (int) get_the_ID();
			} elseif ( ! empty( $post ) ) {
				if ( ! empty( $post->ID ) ) {
					$post_id = $post->ID;
				}
			} elseif ( ! empty( $wp_query ) && ! empty( $wp_query->post->ID ) ) {
				$post_id = $wp_query->post->ID;
			} elseif ( ! empty( $wp_query ) && ! empty( $wp_query->get_queried_object_id() ) ) {
				$post_id = $wp_query->get_queried_object_id();
			} else {
				$scheme  = is_ssl() ? 'http' : 'https';
				$request = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : ''; // phpcs:ignore
				$url     = "$scheme://$_SERVER[HTTP_HOST]$request"; // phpcs:ignore
				$post_id = url_to_postid( $url );
			}

			return $post_id;
		}

		/**
		 * Posts Using Templates
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param string|array $templates The template(s) to check if a post uses template.
		 *
		 * @return array
		 */
		public function posts_using_templates( $templates ) {
			$list  = array();
			$pages = array();

			if ( is_array( $templates ) ) {
				foreach ( $templates as $template ) {
					$pages = $this->get_posts_using_templates( $template );

					foreach ( $pages as $page ) {
						$list[] = array(
							'template' => $template,
							'ID'        => $page->ID,
							'title'     => $page->post_title,
						);
					}
				}
			} else {
				$pages = $this->get_posts_using_templates( $templates );

				foreach ( $pages as $page ) {
					$list[] = array(
						'template' => $templates,
						'ID'        => $page->ID,
						'title'     => $page->post_title,
					);
				}
			}

			return $list;
		}

		/**
		 * Get Posts Using Templates
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return object
		 */
		public function get_posts_using_templates( $template ) {
			return get_posts(
				array(
					'post_type'      => array( 'page', 'post' ),
					'posts_per_page' => -1,
					'meta_key'       => '_wp_page_template',
					'meta_value'     => $template // phpcs:ignore
				)
			);
		}
	}
}
