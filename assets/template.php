<?php
/**
 * Template for parallax image module
 *
 * $this is an instance of the Image object.
 * Available properties:
 * $this->image (array|null) Image.
 * $this->options (array|null) Parallax options.
 *
 * @package Hogan
 */

declare( strict_types = 1 );

namespace Dekode\Hogan;

if ( ! defined( 'ABSPATH' ) || ! ( $this instanceof Parallax_Image ) ) {
	return; // Exit if accessed directly.
}

if ( empty( $this->image ) ) {
	return;
}
printf(
	'<figure class="%s" data-image="%s" data-width="%s" data-height="%s" data-cover-ratio="%s"></figure>',
	esc_attr(
		hogan_classnames(
			[ 'parallax-image' ],
			apply_filters( 'hogan/module/parallax_image/figure_classes', [], $this )
		)
	),
	esc_attr( $this->image['url'] ),
	esc_attr( $this->image['width'] ),
	esc_attr( $this->image['height'] ),
	esc_attr( $this->options['cover_ratio'] )
);
