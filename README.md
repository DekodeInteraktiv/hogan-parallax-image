# Parallax Image Module for [Hogan](https://github.com/dekodeinteraktiv/hogan-parallax-image) [![Build Status](https://travis-ci.org/DekodeInteraktiv/hogan-parallax-image.svg?branch=master)](https://travis-ci.org/DekodeInteraktiv/hogan-image)

## Installation
Install the module using Composer `composer require dekodeinteraktiv/hogan-parallax-image` or simply by downloading this repository and placing it in `wp-content/plugins`

## Available filters
### Admin
- `hogan/module/parallax_image/image_size/constraints` : Image constraints for image size field.
Default (will be merged with return filter return values):
```php
[
    'min_width'  => '',
    'min_height' => '',
    'max_width'  => '',
    'max_height' => '',
    'min_size'   => '',
    'max_size'   => '',
    'mime_types' => '',
]
```
- `hogan/module/parallax_image/image/preview_size` : Admin preview size of uploaded image. Default: 'medium'
- `hogan/module/parallax_image/image/library` : Admin media library choice. Default: 'all'

###Frontend
- `hogan/module/parallax_image/image_size` : The image size that will be used for the parallax image. Default: 'full' (original image size)
- `hogan/module/parallax_image/mobile_image_size` : The image size that will be used if the parallax is disabled (screen width of 768 and below). Default: 'large'

### Template
- `hogan/module/parallax_image/figure_classes` : Add classes names to the figure tag. Default: `wp-caption`
