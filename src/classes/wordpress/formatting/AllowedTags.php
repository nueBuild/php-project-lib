<?php
/**
 * Allowed Tags
 *
 * @package    NBPL
 * @subpackage NBPL/WordPress/Formatting
 * @author     Jason Witt <info@nuebuild.com>
 * @copyright  Copyright ((c) 2020, Jason Witt
 * @license    GNU General Public License v2 or later
 * @since      1.0.0
 *
 * @version 1.0.3
 */

namespace NBPL\WordPress\Formatting;

use NBPL\Base;

if ( ! class_exists( __NAMESPACE__ . '\\AllowedTags' ) ) {

	/**
	 * Allowed Tags
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class AllowedTags extends Base {

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @param array $args The arguments.
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
				'tags'       => array_merge( $this->args, $this->tags() ),
				'attributes' => array_merge( $this->args, $this->attributes() ),
			);
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
			add_filter( 'wp_kses_allowed_html', array( $this, 'data_atributes' ), 10, 2 );
		}

		/**
		 * Attributes
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return array
		 */
		public function attributes() {
			return array(
				'accept'           => 1,
				'accept-charset'   => 1,
				'accesskey'        => 1,
				'action'           => 1,
				'align'            => 1,
				'alt'              => 1,
				'aria-describedby' => 1,
				'aria-details'     => 1,
				'aria-label'       => 1,
				'aria-labelledby'  => 1,
				'aria-hidden'      => 1,
				'async'            => 1,
				'autocomplete'     => 1,
				'autofocus'        => 1,
				'autoplay'         => 1,
				'bgcolor'          => 1,
				'border'           => 1,
				'charset'          => 1,
				'checked'          => 1,
				'cite'             => 1,
				'class'            => 1,
				'color'            => 1,
				'cols'             => 1,
				'colspan'          => 1,
				'content'          => 1,
				'contenteditable'  => 1,
				'controls'         => 1,
				'coords'           => 1,
				'd'                => 1,
				'data-*'           => 1,
				'datetime'         => 1,
				'default'          => 1,
				'defer'            => 1,
				'dir'              => 1,
				'dirname'          => 1,
				'disabled'         => 1,
				'download'         => 1,
				'draggable'        => 1,
				'dropzone'         => 1,
				'enctype'          => 1,
				'fill'             => 1,
				'for'              => 1,
				'form'             => 1,
				'formaction'       => 1,
				'headers'          => 1,
				'height'           => 1,
				'hidden'           => 1,
				'high'             => 1,
				'href'             => 1,
				'hreflang'         => 1,
				'http-equiv'       => 1,
				'id'               => 1,
				'ismap'            => 1,
				'kind'             => 1,
				'label'            => 1,
				'lang'             => 1,
				'list'             => 1,
				'loop'             => 1,
				'low'              => 1,
				'max'              => 1,
				'maxlength'        => 1,
				'media'            => 1,
				'method'           => 1,
				'min'              => 1,
				'multiple'         => 1,
				'muted'            => 1,
				'name'             => 1,
				'novalidate'       => 1,
				'onabort'          => 1,
				'onafterprint'     => 1,
				'onbeforeprint'    => 1,
				'onbeforeunload'   => 1,
				'onblur'           => 1,
				'oncanplay'        => 1,
				'oncanplaythrough' => 1,
				'onchange'         => 1,
				'onclick'          => 1,
				'oncontextmenu'    => 1,
				'oncopy'           => 1,
				'oncuechange'      => 1,
				'oncut'            => 1,
				'ondblclick'       => 1,
				'ondrag'           => 1,
				'ondragend'        => 1,
				'ondragenter'      => 1,
				'ondragleave'      => 1,
				'ondragover'       => 1,
				'ondragstart'      => 1,
				'ondrop'           => 1,
				'ondurationchange' => 1,
				'onemptied'        => 1,
				'onended'          => 1,
				'onerror'          => 1,
				'onfocus'          => 1,
				'onhashchange'     => 1,
				'oninput'          => 1,
				'oninvalid'        => 1,
				'onkeydown'        => 1,
				'onkeypress'       => 1,
				'onkeyup'          => 1,
				'onload'           => 1,
				'onloadeddata'     => 1,
				'onloadedmetadata' => 1,
				'onloadstart'      => 1,
				'onmousedown'      => 1,
				'onmousemove'      => 1,
				'onmouseout'       => 1,
				'onmouseover'      => 1,
				'onmouseup'        => 1,
				'onmousewheel'     => 1,
				'onoffline'        => 1,
				'ononline'         => 1,
				'onpagehide'       => 1,
				'onpageshow'       => 1,
				'onpaste'          => 1,
				'onpause'          => 1,
				'onplay'           => 1,
				'onplaying'        => 1,
				'onpopstate'       => 1,
				'onprogress'       => 1,
				'onratechange'     => 1,
				'onreset'          => 1,
				'onresize'         => 1,
				'onscroll'         => 1,
				'onsearch'         => 1,
				'onseeked'         => 1,
				'onseeking'        => 1,
				'onselect'         => 1,
				'onstalled'        => 1,
				'onstorage'        => 1,
				'onsubmit'         => 1,
				'onsuspend'        => 1,
				'ontimeupdate'     => 1,
				'ontoggle'         => 1,
				'onunload'         => 1,
				'onvolumechange'   => 1,
				'onwaiting'        => 1,
				'onwheel'          => 1,
				'open'             => 1,
				'optimum'          => 1,
				'pattern'          => 1,
				'placeholder'      => 1,
				'poster'           => 1,
				'preload'          => 1,
				'readonly'         => 1,
				'rel'              => 1,
				'required'         => 1,
				'reversed'         => 1,
				'rows'             => 1,
				'rowspan'          => 1,
				'sandbox'          => 1,
				'scope'            => 1,
				'selected'         => 1,
				'shape'            => 1,
				'size'             => 1,
				'sizes'            => 1,
				'span'             => 1,
				'spellcheck'       => 1,
				'src'              => 1,
				'srcdoc'           => 1,
				'srclang'          => 1,
				'srcset'           => 1,
				'start'            => 1,
				'step'             => 1,
				'style'            => 1,
				'tabindex'         => 1,
				'target'           => 1,
				'title'            => 1,
				'translate'        => 1,
				'type'             => 1,
				'usemap'           => 1,
				'value'            => 1,
				'viewbox'          => 1,
				'width'            => 1,
				'wrap'             => 1,
				'xmlns'            => 1,
			);
		}

		/**
		 * Tags
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @return array
		 */
		public function tags() {
			return array(
				'a',
				'abbr',
				'address',
				'acronym',
				'area',
				'article',
				'aside',
				'audio',
				'b',
				'base',
				'bdi',
				'bdo',
				'big',
				'blockquote',
				'body',
				'br',
				'button',
				'caption',
				'cite',
				'code',
				'col',
				'colgroup',
				'data',
				'datalist',
				'dd',
				'del',
				'details',
				'dfn',
				'dialog',
				'div',
				'dl',
				'dt',
				'em',
				'embed',
				'fieldset',
				'figcaption',
				'figure',
				'font',
				'footer',
				'form',
				'g',
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
				'head',
				'header',
				'hgroup',
				'hr',
				'html',
				'i',
				'iframe',
				'img',
				'input',
				'ins',
				'kbd',
				'keygen',
				'label',
				'legend',
				'li',
				'link',
				'main',
				'map',
				'mark',
				'menu',
				'menuitem',
				'meta',
				'meter',
				'nav',
				'noscript',
				'object',
				'ol',
				'optgroup',
				'option',
				'output',
				'p',
				'param',
				'path',
				'pre',
				'progress',
				'q',
				'rb',
				'rp',
				'rt',
				'rtc',
				'ruby',
				's',
				'samp',
				'script',
				'section',
				'select',
				'small',
				'source',
				'span',
				'strong',
				'strike',
				'style',
				'sub',
				'svg',
				'summary',
				'sup',
				'table',
				'tbody',
				'td',
				'template',
				'textarea',
				'tfoot',
				'th',
				'thead',
				'time',
				'title',
				'tt',
				'tr',
				'track',
				'u',
				'ul',
				'var',
				'video',
				'wbr',
			);
		}

		/**
		 * Data Attributes
		 * Allow data attributes to pass through kses.
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param string|array $allowed The allowed tags ands attributes.
		 * @param string       $context The context in which to apply the changes.
		 *
		 * @return array
		 */
		public function data_atributes( $allowed, $context ) {
			if ( is_array( $context ) ) {
				return $allowed;
			}

			if ( $context === 'post' ) {
				foreach ( $this->args->tags as $tag ) {
					$allowed[ $tag ]['data-*'] = true;
				}
			}

			return $allowed;
		}

		/**
		 * Allowed
		 *
		 * @author Jason Witt
		 * @since  1.0.0
		 *
		 * @param string|array $tags       The the tag(s) to add to the allowed HTML tags list.
		 * @param string|array $attributes The the attribute(s) to add to the allowed HTML tags list.
		 *
		 * @return void
		 */
		public function allowed( $tags = '', $attributes = '' ) {

			global $allowedposttags;

			$tags_array       = $this->args->tags;
			$attributes_array = $this->args->attributes;

			if ( ! empty( $tag ) ) {
				if ( is_array( $tags ) ) {
					foreach ( $tags as $tag ) {
						array_push( $tags_array, $tag );
					}
				} else {
					array_push( $tags_array, $tags );
				}
			}

			if ( ! empty( $attributes ) ) {
				if ( is_array( $tags ) ) {
					foreach ( $attributes as $attribute ) {
						$attributes_array[ $attribute ] = array();
					}
				} else {
					$attributes_array[ $attributes ] = array();
				}
			}

			foreach ( $tags_array as $tag ) {
				$allowedposttags[ $tag ] = $attributes_array; // phpcs:ignore
			}
		}
	}
}
