<?php
/**
 * Plugin Name: Hogan Module: Parallax Image
 * Plugin URI: https://github.com/dekodeinteraktiv/hogan-parallax-image
 * GitHub Plugin URI: https://github.com/dekodeinteraktiv/hogan-parallax-image
 * Description: Parallax Image Module for Hogan.
 * Version: 1.0.4
 * Author: Dekode
 * Author URI: https://dekode.no
 * License: GPL-3.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
 *
 * Text Domain: hogan-parallax-image
 * Domain Path: /languages/
 *
 * @package Hogan
 * @author Dekode
 */

declare( strict_types = 1 );

namespace Dekode\Hogan\Parallax_Image;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HOGAN_PARALLAX_IMAGE_VERSION', '1.0.4' );

add_action( 'plugins_loaded', __NAMESPACE__ . '\\hogan_load_textdomain' );
add_action( 'hogan/include_modules', __NAMESPACE__ . '\\hogan_register_module' );

/**
 * Register module text domain
 */
function hogan_load_textdomain() {
	\load_plugin_textdomain( 'hogan-parallax-image', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
}

/**
 * Register module in Hogan
 *
 * @param \Dekode\Hogan\Core $core Hogan Core instance.
 * @return void
 */
function hogan_register_module( \Dekode\Hogan\Core $core ) {
	require_once 'class-parallax-image.php';
	$core->register_module( new \Dekode\Hogan\Parallax_Image() );
}
