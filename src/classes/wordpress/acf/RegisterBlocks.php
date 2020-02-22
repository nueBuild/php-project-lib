<?php
/**
 * Register Gutenberg blocks.
 *
 * @package    NBPL
 * @subpackage NBPL/WordPress/ACF
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 *
 * @version 1.0.3
 */

namespace NBPL\WordPress\ACF;

use NBPL\Base;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\\RegisterBlocks' ) ) {

	/**
	 * Register Gutenberg blocks.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class RegisterBlocks extends Base {

		/**
		 * Args
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @var array
		 */
		protected $args;

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param array $args {
		 *     Array of gutenburg blocks to register.
		 *     array()
		 *         The array of arguments for the registering gutenburg blocks.
		 *
		 *         @type string       $name            (Required) A unique name that identifies the block . Default: ''.
		 *         @type boolean      $title           (Optional) The display title for your block. Default: ''.
		 *         @type boolean      $description     (Optional) This is a short description for your block. Default: ''.
		 *         @type string       $category        (Optional) Blocks are grouped into categories to help users browse and discover them. Default: ''.
		 *         @type string|array $icon            (Optional) An icon property can be specified to make it easier to identify a block. Default: ''.
		 *         @type array        $keywords        (Optional) An array of post types to restrict this block type to. Default: array().
		 *         @type string       $mode            (Optional) The display mode for your block. Default: 'preview'.
		 *         @type string       $align           (Optional) The default block alignment. Default: ''.
		 *         @type callable     $render_template (Optional) A callback function name may be specified to output the block’s HTML. Default: ''.
		 *         @type string       $enqueue_style   (Optional) The url to a .css file to be enqueued whenever your block is displayed. Default: ''.
		 *         @type string       $enqueue_script  (Optional) The url to a .js file to be enqueued whenever your block is displayed. Default: ''.
		 *         @type callable     $enqueue_assets  (Optional) A callback function that runs whenever your block is displayed and enqueues scripts and/or styles. Default: ''.
		 *         @type array        $supports {
		 *             (Optional) An array of features to support, Default: array()
		 *
		 *             @type boolean|array $align (Optional) This property adds block controls which allow the user to change the block’s alignment. Default: true.
		 *             @type boolean       $mode  (Optional) This property allows the user to toggle between edit and preview modes via a button. Default: true.
		 *             @type boolean       $multiple  (Optional) This property allows the block to be added multiple times. Default: true.
		 *         }
		 *     }
		 * }
		 *
		 * @see https://www.advancedcustomfields.com/resources/acf_register_block_type/
		 * @see https://developer.wordpress.org/block-editor/developers/block-api/block-registration/
		 *
		 * @return void
		 */
		public function __construct( $args = array() ) {
			$this->args = $args;
			$this->hooks();
		}

		/**
		 * Hooks
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function hooks() {
			add_action( 'acf/init', array( $this, 'register' ) );
		}

		/**
		 * Register
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function register() {
			if ( function_exists( 'acf_register_block_type' ) ) {
				foreach ( $this->args as $block ) {
					acf_register_block_type( (array) $block );
				};
			}
		}
	}
}
