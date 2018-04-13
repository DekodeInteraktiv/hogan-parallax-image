<?php
/**
 * Parallax Image module class
 *
 * @package Hogan
 */

declare( strict_types = 1 );

namespace Dekode\Hogan;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( '\\Dekode\\Hogan\\Parallax_Image' ) && class_exists( '\\Dekode\\Hogan\\Module' ) ) {

	/**
	 * Parallax Image module class.
	 *
	 * @extends Modules base class.
	 */
	class Parallax_Image extends Module {

		/**
		 * Image
		 *
		 * @var array|null $image
		 */
		public $image = null;

		/**
		 * Parallax options
		 *
		 * @var array|null $options
		 */
		public $options = null;

		/**
		 * Module constructor.
		 */
		public function __construct() {

			$this->label    = __( 'Parallax Image', 'hogan-parallax-image' );
			$this->template = __DIR__ . '/assets/template.php';

			parent::__construct();
		}

		/**
		 * Enqueue module assets
		 */
		public function enqueue_assets() {
			$_debug   = defined( 'SCRIPT_DEBUG' ) && true === SCRIPT_DEBUG;
			$_version = $_debug ? time() : HOGAN_PARALLAX_IMAGE_VERSION;

			wp_enqueue_script( 'hogan-parallax-image-plugin', plugins_url( '/assets/jquery.imageScroll.min.js', __FILE__ ), [ 'jquery' ], $_version, true );
			wp_enqueue_script( 'hogan-parallax-image-effect', plugins_url( '/assets/parallax.js', __FILE__ ), [ 'hogan-parallax-image-plugin' ], $_version, true );
		}

		/**
		 * Field definitions for module.
		 *
		 * @return array $fields Fields for this module
		 */
		public function get_fields() : array {

			$constraints_defaults = [
				'min_width'  => '',
				'min_height' => '',
				'max_width'  => '',
				'max_height' => '',
				'min_size'   => '',
				'max_size'   => '',
				'mime_types' => '',
			];

			// Merge $args from filter with $defaults.
			$constraints_args = wp_parse_args( apply_filters( 'hogan/module/parallax_image/image_size/constraints', [] ), $constraints_defaults );

			$fields = [
				[
					'type'          => 'image',
					'key'           => $this->field_key . '_image_id',
					'name'          => 'image_id',
					'label'         => __( 'Add Image', 'hogan-parallax-image' ),
					'required'      => 1,
					'return_format' => 'id',
					'wrapper'       => [
						'width' => '50',
					],
					'preview_size'  => apply_filters( 'hogan/module/parallax_image/image/preview_size', 'medium' ),
					'library'       => apply_filters( 'hogan/module/parallax_image/image/library', 'all' ),
					'min_width'     => $constraints_args['min_width'],
					'min_height'    => $constraints_args['min_height'],
					'max_width'     => $constraints_args['max_width'],
					'max_height'    => $constraints_args['max_height'],
					'min_size'      => $constraints_args['min_size'],
					'max_size'      => $constraints_args['max_size'],
					'mime_types'    => $constraints_args['mime_types'],
				],
				[
					'type'          => 'range',
					'key'           => $this->field_key . '_cover_ratio',
					'name'          => 'cover_ratio',
					'label'         => __( 'Cover Ratio', 'hogan-parallax-image' ),
					'instructions'  => __( 'Select how many percent of the screen height the image should cover', 'hogan-parallax-image' ),
					'wrapper'       => [
						'width' => '50',
					],
					'default_value' => 50,
					'min'           => 30,
					'max'           => 100,
					'step'          => 10,
				],
			];

			return $fields;
		}

		/**
		 * Map raw fields from acf to object variable.
		 *
		 * @param array $raw_content Content values.
		 * @param int   $counter Module location in page layout.
		 *
		 * @return void
		 */
		public function load_args_from_layout_content( array $raw_content, int $counter = 0 ) {
			$image = wp_get_attachment_image_src( $raw_content['image_id'], apply_filters( 'hogan/module/parallax_image/image_size', 'full' ) );
			if ( ! empty( $image ) ) {
				$keys                      = [ 'url', 'width', 'height', 'is_intermediate' ];
				$this->image               = array_combine( $keys, array_values( $image ) );
				$mobile_image              = wp_get_attachment_image_src( $raw_content['image_id'], apply_filters( 'hogan/module/parallax_image/mobile_image_size', 'large' ) );
				$this->image['mobile_url'] = ! empty( $mobile_image ) ? $mobile_image[0] : $this->image['url'];
				$this->options             = [
					'cover_ratio' => $raw_content['cover_ratio'] / 100,
				];
			}

			parent::load_args_from_layout_content( $raw_content, $counter );
		}

		/**
		 * Validate module content before template is loaded.
		 *
		 * @return bool Whether validation of the module is successful / filled with content.
		 */
		public function validate_args() : bool {
			return ! empty( $this->image );
		}
	}
}
