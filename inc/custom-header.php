<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package responsiveblogily
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses responsiveblogily_header_style()
 */
function responsiveblogily_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'responsiveblogily_custom_header_args', array(
		'default-image'          => get_template_directory_uri().'/inc/starter_content/img/header-img.png',
		'default-text-color'     => '000000',
		'flex-width'         => true,
'flex-height'        => true,
'width'              => 1200,
'height'             => 500,
		'wp-head-callback'       => 'responsiveblogily_header_style',
	) ) );
	register_default_headers( array(
		'header-bg' => array(
			'url'           => get_theme_file_uri( '/inc/starter_content/img/header-img.png' ),
			'thumbnail_url' => get_theme_file_uri( '/inc/starter_content/img/header-img.png' ),
			'description'   => _x( 'Default', 'Default header image', 'responsive-blogily' )
		),	
				'header-bg' => array(
			'url'           => get_theme_file_uri( '/inc/starter_content/img/header-img-two.png' ),
			'thumbnail_url' => get_theme_file_uri( '/inc/starter_content/img/header-img-two.png' ),
			'description'   => _x( 'Default', 'Default header image', 'responsive-blogily' )
		),	
	) );

}
add_action( 'after_setup_theme', 'responsiveblogily_custom_header_setup' );

if ( ! function_exists( 'responsiveblogily_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see responsiveblogily_custom_header_setup().
	 */
	function responsiveblogily_header_style() {
		$header_text_color = get_header_textcolor();
		$header_image = get_header_image();

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( empty( $header_image ) && $header_text_color == get_theme_support( 'custom-header', 'default-text-color' ) ){
			return;
		}

	// If we get this far, we have custom styles. Let's do this.
		?>
		<style type="text/css">

			.site-title a,
			.site-description {
				color: #<?php echo esc_attr( $header_text_color ); ?>;
			}

			<?php if ( ! display_header_text() ) : ?>
				.site-title,
				.site-description {
					display:none;
				}
				.content-wrap.below-nav-img {
					margin-top: -8px;
				}
			<?php endif; ?>

			<?php header_image(); ?>"
			<?php
			if ( ! display_header_text() ) :
				?>

				<?php
			else :
				?>
				.site-title a,
				.site-description {
					color: #<?php echo esc_attr( $header_text_color ); ?>;
				}
			<?php endif; ?>
		</style>
		<?php
	}
endif;
