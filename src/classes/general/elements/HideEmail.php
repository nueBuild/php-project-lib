<?php
/**
 * Hide Email.
 *
 * @package    NBPL
 * @subpackage NBPL/General/Elements
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 *
 * @version 1.0.4
 */

namespace NBPL\General\Elements;

use NBPL\Base;

if ( ! defined( 'WPINC' ) ) {
	wp_die( 'No Access Allowed!', 'Error!', array( 'back_link' => true ) );
}

if ( ! class_exists( __NAMESPACE__ . '\\HideEmail' ) ) {

	/**
	 * Hide Email.
	 *
	 * @author Jason Witt
	 * @since  1.0.0
	 */
	class HideEmail extends Base {

		/**
		 * Initialize the class
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
		 * @return void
		 */
		public function __construct( $args = array() ) {
			$this->defaults = $this->set_defaults( $args );
			parent::__construct( $args );
		}

		/**
		 * Set Defaults
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param string|array $args Can be an email address string or array of parameters.
		 *
		 * @return array
		 */
		public function set_defaults( $args = array() ) {

			if ( is_array( $args ) ) {
				return [
					'email'              => '',
					'text'               => '',
					'id'                 => '',
					'classes'            => '',
					'attributes'         => '',
					'wrapper'            => '',
					'wrapper_id'         => '',
					'wrapper_classes'    => '',
					'wrapper_attributes' => '',
					'link'               => true,
				];
			}

			return (object) [
				'email'              => $args,
				'text'               => '',
				'id'                 => '',
				'classes'            => '',
				'attributes'         => '',
				'wrapper'            => '',
				'wrapper_id'         => '',
				'wrapper_classes'    => '',
				'wrapper_attributes' => '',
				'link'               => true,
			];
		}

		/**
		 * Email
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function email() {
			$parts              = explode( '@', $this->args->email );
			$part1              = $parts[0];
			$part2              = pow( 2, 6 );
			$part3              = chr( $part2 );
			$part4              = $parts[1];
			$part5              = $part1 . chr( $part2 ) . $part4;
			$id                 = ! empty( $this->args->id ) ? ' id="' . trim( $this->args->id ) . '"' : '';
			$classes            = ! empty( $this->args->classes ) ? ' class="' . trim( $this->args->classes ) . '"' : '';
			$attributes         = ! empty( $this->args->attributes ) ? ' ' . trim( $this->args->attributes ) : '';
			$wrapper            = ! empty( $this->args->wrapper ) ? trim( $this->args->wrapper ) : '';
			$wrapper_id         = ! empty( $this->args->wrapper_id ) ? ' id="' . trim( $this->args->wrapper_id ) . '"' : '';
			$wrapper_classes    = ! empty( $this->args->wrapper_classes ) ? ' class="' . trim( $this->args->wrapper_classes ) . '"' : '';
			$wrapper_attributes = ! empty( $this->args->wrapper_attributes ) ? ' ' . trim( $this->args->wrapper_attributes ) : '';
			$email_string       = $part1 . $part3 . $part4;
			$string             = ! empty( $this->args->text ) && $this->args->link ? $this->args->text : $email_string;
			$wrapper_attributes = $wrapper_id . $wrapper_classes . $wrapper_attributes;

			if ( $this->args->link ) {
				$string = '<a href="mailto:' . $part5 . '"' . $id . $classes . $attributes . '>' . $string . '</a>';
				if ( $wrapper ) {
					$string = '<' . $this->args->wrapper . $wrapper_attributes . '>' . $string . '</' . $this->args->wrapper . '>';
				}
			} elseif ( $wrapper ) {
				$string = '<' . $this->args->wrapper . $wrapper_attributes . '>' . $string . '</' . $this->args->wrapper . '>';
			} else {
				$string = '<span' . $wrapper_attributes . '>' . $email_string . '</span>';
				if ( $wrapper ) {
					$string = '<' . $this->args->wrapper . $wrapper_attributes . '>' . $email_string . '</' . $this->args->wrapper . '>';
				}
			}
			?>
			<script language="JavaScript" type="text/javascript">document.write('<?php echo $string; // phpcs:ignore ?>');</script>
			<?php
		}
	}
}
