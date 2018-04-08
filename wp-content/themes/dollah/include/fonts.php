<?php
/**
 * Functions for sending list of fonts available.
 *
 * @package    Hoot
 * @subpackage Dollah
 */

/**
 * Build URL for loading Google Fonts
 * @credit http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 *
 * @since 1.0
 * @access public
 * @return void
 */
function dollah_google_fonts_enqueue_url() {
	$fonts_url = '';
	$query_args = apply_filters( 'dollah_google_fonts_enqueue_url_args', array() );

	/** If no google font loaded, load the default ones **/
	if ( !is_array( $query_args ) || empty( $query_args ) ):
 
		/* Translators: If there are characters in your language that are not
		* supported by this font, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$comfortaa = ( 'display' == dollah_get_mod( 'logo_fontface' ) || 'display' == dollah_get_mod( 'headings_fontface' ) ) ? _x( 'on', 'Comfortaa font: on or off', 'dollah' ) : 'off';
		$roboto = ( 'heading' == dollah_get_mod( 'logo_fontface' ) || 'heading' == dollah_get_mod( 'headings_fontface' ) ) ? _x( 'on', 'Roboto font: on or off', 'dollah' ) : 'off';

		/* Translators: If there are characters in your language that are not
		* supported by this font, translate this to 'off'. Do not translate
		* into your own language.
		*/
		$open_sans = _x( 'on', 'Open Sans font: on or off', 'dollah' );

		if ( 'off' !== $comfortaa || 'off' !== $roboto || 'off' !== $open_sans ) {
			$font_families = array();

			if ( 'off' !== $roboto ) {
				$font_families[] = 'Roboto:400,500,700';
			}

			if ( 'off' !== $comfortaa ) {
				$font_families[] = 'Comfortaa:300,400,700';
			}

			if ( 'off' !== $open_sans ) {
				$font_families[] = 'Open+Sans:300,400,400i,600,600i,700,700i,800';
			}

			if ( !empty( $font_families ) )
				$query_args = array(
					'family' => urlencode( implode( '|', $font_families ) ),
					//'subset' => urlencode( 'latin,latin-ext' ),
					'subset' => urlencode( 'latin' ),
				);

		}

	endif;

	if ( !empty( $query_args ) && !empty( $query_args['family'] ) )
		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );

	return $fonts_url;
}

/**
 * Modify the font (websafe) list
 * Font list should always have the form:
 * {css style} => {font name}
 *
 * @since 1.0
 * @access public
 * @return array
 */
function dollah_theme_fonts_list( $fonts ) {
	// Add Open Sans (google font) to the available font list
	// Even though the list isn't currently used in customizer options,
	// this is still needed so that sanitization functions recognize the font.
	$fonts['"Open Sans", sans-serif'] = 'Open Sans';
	$fonts['"Roboto", sans-serif'] = 'Roboto';
	$fonts['"Comfortaa", sans-serif'] = 'Comfortaa';
	return $fonts;
}
add_filter( 'hybridextend_fonts_list', 'dollah_theme_fonts_list' );