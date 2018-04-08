<?php
/**
 * Data Sets
 *
 * @package    HybridExtend
 * @subpackage HybridHoot
 * @license    http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

/* == fonts == */

/**
 * Functions for sending list of fonts available.
 * 
 * Generates the font (websafe) list
 * Font list should always have the form:
 * {css style} => {font name}
 *
 * @since 1.0.0
 * @access public
 * @return array
 */
function hybridextend_fonts_list() {

	return apply_filters( 'hybridextend_fonts_list', array(
		'Arial, Helvetica, sans-serif'            => 'Arial',
		'Helvetica, sans-serif'                   => 'Helvetica',
		'Verdana, Geneva, sans-serif'             => 'Verdana, Geneva',
		'"Trebuchet MS", Helvetica, sans-serif'   => 'Trebuchet',
		'Georgia, serif'                          => 'Georgia',
		'"Times New Roman", serif'                => 'Times New Roman',
		'Tahoma, Geneva, sans-serif'              => 'Tahoma, Geneva',
		)
	);

}

/* == enum == */

/**
 * Get background repeat settings
 *
 * @param string $return array to return icons|sections|list/empty
 * @return array
 */
if ( !function_exists( 'hybridextend_enum_icons' ) ):
function hybridextend_enum_icons( $return = 'list' ) {
	$return = ( empty( $return ) ) ? 'list' : $return;
	$default = HybridExtend_Options_Helper::icons( $return );
	return apply_filters( 'hybridextend_enum_icons', $default, $return );
}
endif;

/**
 * Get background repeat settings
 *
 * @return array
 */
if ( !function_exists( 'hybridextend_enum_background_repeat' ) ):
function hybridextend_enum_background_repeat() {
	$default = array(
		'no-repeat' => __( 'No Repeat', 'hybrid-core' ),
		'repeat-x'  => __( 'Repeat Horizontally', 'hybrid-core' ),
		'repeat-y'  => __( 'Repeat Vertically', 'hybrid-core' ),
		'repeat'    => __( 'Repeat All', 'hybrid-core' ),
		);
	return apply_filters( 'hybridextend_enum_background_repeat', $default );
}
endif;

/**
 * Get background positions
 *
 * @return array
 */
if ( !function_exists( 'hybridextend_enum_background_position' ) ):
function hybridextend_enum_background_position() {
	$default = array(
		'top left'      => __( 'Top Left', 'hybrid-core' ),
		'top center'    => __( 'Top Center', 'hybrid-core' ),
		'top right'     => __( 'Top Right', 'hybrid-core' ),
		'center left'   => __( 'Middle Left', 'hybrid-core' ),
		'center center' => __( 'Middle Center', 'hybrid-core' ),
		'center right'  => __( 'Middle Right', 'hybrid-core' ),
		'bottom left'   => __( 'Bottom Left', 'hybrid-core' ),
		'bottom center' => __( 'Bottom Center', 'hybrid-core' ),
		'bottom right'  => __( 'Bottom Right', 'hybrid-core')
		);
	return apply_filters( 'hybridextend_enum_background_position', $default );
}
endif;

/**
 * Get background attachment settings
 *
 * @return array
 */
if ( !function_exists( 'hybridextend_enum_background_attachment' ) ):
function hybridextend_enum_background_attachment() {
	$default = array(
		'scroll' => __( 'Scroll Normally', 'hybrid-core' ),
		'fixed'  => __( 'Fixed in Place', 'hybrid-core'),
		);
	return apply_filters( 'hybridextend_enum_background_attachment', $default );
}
endif;

/**
 * Get background types
 *
 * @return array
 */
if ( !function_exists( 'hybridextend_enum_background_type' ) ):
function hybridextend_enum_background_type() {
	$default = array(
		'predefined' => __( 'Predefined Pattern', 'hybrid-core' ),
		'custom'     => __( 'Custom Image', 'hybrid-core' ),
		);
	return apply_filters( 'hybridextend_enum_background_type', $default );
}
endif;

/**
 * Get background patterns
 *
 * @return array
 */
if ( !function_exists( 'hybridextend_enum_background_pattern' ) ):
function hybridextend_enum_background_pattern() {
	$relative = trailingslashit( substr( HYBRIDEXTEND_IMAGES . 'patterns' , ( strlen( HYBRID_PARENT_URI ) ) ) );
	$default = array(
		0 => HYBRIDEXTEND_IMAGES . 'patterns/0_preview.jpg',
		$relative . '1.png' => HYBRIDEXTEND_IMAGES . 'patterns/1_preview.jpg',
		$relative . '2.png' => HYBRIDEXTEND_IMAGES . 'patterns/2_preview.jpg',
		$relative . '3.png' => HYBRIDEXTEND_IMAGES . 'patterns/3_preview.jpg',
		$relative . '4.png' => HYBRIDEXTEND_IMAGES . 'patterns/4_preview.jpg',
		$relative . '5.png' => HYBRIDEXTEND_IMAGES . 'patterns/5_preview.jpg',
		$relative . '6.png' => HYBRIDEXTEND_IMAGES . 'patterns/6_preview.jpg',
		$relative . '7.png' => HYBRIDEXTEND_IMAGES . 'patterns/7_preview.jpg',
		$relative . '8.png' => HYBRIDEXTEND_IMAGES . 'patterns/8_preview.jpg',
		);
	return apply_filters( 'hybridextend_enum_background_pattern', $default );
}
endif;

/**
 * Get font sizes.
 *
 * Returns an indexed array of all recognized font sizes.
 * Values are integers and represent a range of sizes from
 * smallest to largest.
 *
 * @return array
 */
if ( !function_exists( 'hybridextend_enum_font_sizes' ) ):
function hybridextend_enum_font_sizes( $min = 9, $max = 82 ) {
	static $cache = array();
	if ( empty( $cache ) || $min != 9 || $max != 82 ) {
		$range = wp_parse_args( apply_filters( 'hybridextend_enum_font_sizes', array() ), array(
			'min' => $min,
			'max' => $max,
			) );
		$sizes = range( $range['min'], $range['max'] );
		$sizes = array_map( 'absint', $sizes );
	}
	if ( empty( $cache ) && $min == 9 && $max -= 82 )
		$cache = $sizes;
	return $sizes;
}
endif;

/**
 * Get font sizes for optiosn array
 *
 * Returns an indexed array of all recognized font sizes.
 * Values are integers and represent a range of sizes from
 * smallest to largest.
 *
 * @return array
 */
if ( !function_exists( 'hybridextend_enum_font_sizes_array' ) ):
function hybridextend_enum_font_sizes_array( $min = 9, $max = 82, $postfix = 'px' ) {
	$sizes = hybridextend_enum_font_sizes( $min, $max );
	$output = array();
	foreach ( $sizes as $size )
		$output[ $size ] = $size . $postfix;
	return $output;
}
endif;

/**
 * Get font faces.
 *
 * Returns an array of all recognized font faces.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @param string $return array to return websafe|google-fonts|empty/list
 * @return array
 */
if ( !function_exists( 'hybridextend_enum_font_faces' ) ):
function hybridextend_enum_font_faces( $return = '' ) {
	$default = '';
	if ( class_exists( 'HybridExtend_Options_Helper' ) )
		$default = ( empty( $return ) || $return == 'list' ) ?
			array_merge( HybridExtend_Options_Helper::fonts('websafe'), HybridExtend_Options_Helper::fonts('google-fonts') ):
			HybridExtend_Options_Helper::fonts($return);
	return apply_filters( 'hybridextend_enum_font_faces', $default, $return );
}
endif;

/**
 * Get font styles.
 *
 * Returns an array of all recognized font styles.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return array
 */
if ( !function_exists( 'hybridextend_enum_font_styles' ) ):
function hybridextend_enum_font_styles() {
	$default = array(
		'none'                     => __( 'None', 'hybrid-core' ),
		'italic'                   => __( 'Italic', 'hybrid-core' ),
		'bold'                     => __( 'Bold', 'hybrid-core' ),
		'bold italic'              => __( 'Bold Italic', 'hybrid-core' ),
		'lighter'                  => __( 'Light', 'hybrid-core' ),
		'lighter italic'           => __( 'Light Italic', 'hybrid-core' ),
		'uppercase'                => __( 'Uppercase', 'hybrid-core' ),
		'uppercase italic'         => __( 'Uppercase Italic', 'hybrid-core' ),
		'uppercase bold'           => __( 'Uppercase Bold', 'hybrid-core' ),
		'uppercase bold italic'    => __( 'Uppercase Bold Italic', 'hybrid-core' ),
		'uppercase lighter'        => __( 'Uppercase Light', 'hybrid-core' ),
		'uppercase lighter italic' => __( 'Uppercase Light Italic', 'hybrid-core' )
		);
	return apply_filters( 'hybridextend_enum_font_styles', $default );
}
endif;

/**
 * Get social profiles and icons
 *
 * Returns an array of all recognized social profiles.
 * Keys are intended to be stored in the database
 * while values are ready for display in in html.
 *
 * @return array
 */
if ( !function_exists( 'hybridextend_enum_social_profiles' ) ):
function hybridextend_enum_social_profiles() {
	return apply_filters( 'hybridextend_enum_social_profiles', array(
		'fa-amazon'         => __( 'Amazon', 'hybrid-core' ),
		'fa-android'        => __( 'Android', 'hybrid-core' ),
		'fa-apple'          => __( 'Apple', 'hybrid-core' ),
		'fa-bandcamp'       => __( 'Bandcamp', 'hybrid-core' ),
		'fa-behance'        => __( 'Behance', 'hybrid-core' ),
		'fa-bitbucket'      => __( 'Bitbucket', 'hybrid-core' ),
		'fa-btc'            => __( 'BTC', 'hybrid-core' ),
		'fa-buysellads'     => __( 'BuySellAds', 'hybrid-core' ),
		'fa-codepen'        => __( 'Codepen', 'hybrid-core' ),
		'fa-codiepie'       => __( 'Codie Pie', 'hybrid-core' ),
		'fa-contao'         => __( 'Contao', 'hybrid-core' ),
		'fa-dashcube'       => __( 'Dash Cube', 'hybrid-core' ),
		'fa-delicious'      => __( 'Delicious', 'hybrid-core' ),
		'fa-deviantart'     => __( 'Deviantart', 'hybrid-core' ),
		'fa-digg'           => __( 'Digg', 'hybrid-core' ),
		'fa-dribbble'       => __( 'Dribbble', 'hybrid-core' ),
		'fa-dropbox'        => __( 'Dropbox', 'hybrid-core' ),
		'fa-eercast'        => __( 'Eercast', 'hybrid-core' ),
		'fa-envelope'       => __( 'Email', 'hybrid-core' ),
		'fa-etsy'           => __( 'Etsy', 'hybrid-core' ),
		'fa-facebook'       => __( 'Facebook', 'hybrid-core' ),
		'fa-flickr'         => __( 'Flickr', 'hybrid-core' ),
		'fa-forumbee'       => __( 'Forumbee', 'hybrid-core' ),
		'fa-foursquare'     => __( 'Foursquare', 'hybrid-core' ),
		'fa-free-code-camp' => __( 'Free Code Camp', 'hybrid-core' ),
		'fa-get-pocket'     => __( 'Pocket (getpocket)', 'hybrid-core' ),
		'fa-github'         => __( 'Github', 'hybrid-core' ),
		'fa-google'         => __( 'Google', 'hybrid-core' ),
		'fa-google-plus'    => __( 'Google Plus', 'hybrid-core' ),
		'fa-google-wallet'  => __( 'Google Wallet', 'hybrid-core' ),
		'fa-imdb'           => __( 'IMDB', 'hybrid-core' ),
		'fa-instagram'      => __( 'Instagram', 'hybrid-core' ),
		'fa-jsfiddle'       => __( 'JS Fiddle', 'hybrid-core' ),
		'fa-lastfm'         => __( 'Last FM', 'hybrid-core' ),
		'fa-leanpub'        => __( 'Leanpub', 'hybrid-core' ),
		'fa-linkedin'       => __( 'Linkedin', 'hybrid-core' ),
		'fa-meetup'         => __( 'Meetup', 'hybrid-core' ),
		'fa-mixcloud'       => __( 'Mixcloud', 'hybrid-core' ),
		'fa-paypal'         => __( 'Paypal', 'hybrid-core' ),
		'fa-pinterest'      => __( 'Pinterest', 'hybrid-core' ),
		'fa-quora'          => __( 'Quora', 'hybrid-core' ),
		'fa-reddit'         => __( 'Reddit', 'hybrid-core' ),
		'fa-rss'            => __( 'RSS', 'hybrid-core' ),
		'fa-scribd'         => __( 'Scribd', 'hybrid-core' ),
		'fa-skype'          => __( 'Skype', 'hybrid-core' ),
		'fa-slack'          => __( 'Slack', 'hybrid-core' ),
		'fa-slideshare'     => __( 'Slideshare', 'hybrid-core' ),
		'fa-snapchat'       => __( 'Snapchat', 'hybrid-core' ),
		'fa-soundcloud'     => __( 'Soundcloud', 'hybrid-core' ),
		'fa-spotify'        => __( 'Spotify', 'hybrid-core' ),
		'fa-stack-exchange' => __( 'Stack Exchange', 'hybrid-core' ),
		'fa-stack-overflow' => __( 'Stack Overflow', 'hybrid-core' ),
		'fa-steam'          => __( 'Steam', 'hybrid-core' ),
		'fa-stumbleupon'    => __( 'Stumbleupon', 'hybrid-core' ),
		'fa-trello'         => __( 'Trello', 'hybrid-core' ),
		'fa-tripadvisor'    => __( 'Trip Advisor', 'hybrid-core' ),
		'fa-tumblr'         => __( 'Tumblr', 'hybrid-core' ),
		'fa-twitch'         => __( 'Twitch', 'hybrid-core' ),
		'fa-twitter'        => __( 'Twitter', 'hybrid-core' ),
		'fa-viadeo'         => __( 'Viadeo', 'hybrid-core' ),
		'fa-vimeo-square'   => __( 'Vimeo', 'hybrid-core' ),
		'fa-vk'             => __( 'VK', 'hybrid-core' ),
		'fa-wikipedia-w'    => __( 'Wikipedia', 'hybrid-core' ),
		'fa-windows'        => __( 'Windows', 'hybrid-core' ),
		'fa-wordpress'      => __( 'Wordpress', 'hybrid-core' ),
		'fa-xing'           => __( 'Xing', 'hybrid-core' ),
		'fa-y-combinator'   => __( 'Y Combinator', 'hybrid-core' ),
		'fa-yelp'           => __( 'Yelp', 'hybrid-core' ),
		'fa-youtube'        => __( 'Youtube', 'hybrid-core' ),
	) );
}
endif;

/* == icons == */

/**
 * Generates the icon and section list
 *
 * @since 1.0.0
 * @access public
 * @param string $return array to return sections|icons
 * @return array
 */
function hybridextend_fonticons_list( $return = 'icons' ) {

	if ( 'sections' == $return ) :
		return apply_filters( 'hybridextend_fonticons_sections', array(
			'web_application_icons'  => __('Web Application', 'hybrid-core'),
			'accessibility_icons'    => __('Accessibility', 'hybrid-core'),
			'hand_icons'             => __('Hand Icons', 'hybrid-core'),
			'transportation_icons'   => __('Transportation', 'hybrid-core'),
			'gender_icons'           => __('Gender', 'hybrid-core'),
			'file_type_icons'        => __('File Type', 'hybrid-core'),
			'spinner_icons'          => __('Spinner', 'hybrid-core'),
			'form_control_icons'     => __('Form Control', 'hybrid-core'),
			'payment_icons'          => __('Payment', 'hybrid-core'),
			'chart_icons'            => __('Chart', 'hybrid-core'),
			'currency_icons'         => __('Currency', 'hybrid-core'),
			'text_editor_icons'      => __('Text Editor', 'hybrid-core'),
			'directional_icons'      => __('Directional', 'hybrid-core'),
			'video_player_icons'     => __('Video Player', 'hybrid-core'),
			'brand_icons'            => __('Brand', 'hybrid-core'),
			'medical_icons'          => __('Medical', 'hybrid-core'),
			)
		);
	endif;

	if ( 'icons' == $return ) :
		return apply_filters( 'hybridextend_fonticons_icons', array (

			'web_application_icons' => array (
				'fa-address-book',
				'fa-address-book-o',
				'fa-address-card',
				'fa-address-card-o',
				'fa-adjust',
				'fa-american-sign-language-interpreting',
				'fa-anchor',
				'fa-archive',
				'fa-area-chart',
				'fa-arrows',
				'fa-arrows-h',
				'fa-arrows-v',
				'fa-assistive-listening-systems',
				'fa-asterisk',
				'fa-at',
				'fa-audio-description',
				'fa-balance-scale',
				'fa-ban',
				'fa-bar-chart',
				'fa-barcode',
				'fa-bars',
				'fa-bath',
				'fa-battery-empty',
				'fa-battery-full',
				'fa-battery-half',
				'fa-battery-quarter',
				'fa-battery-three-quarters',
				'fa-bed',
				'fa-beer',
				'fa-bell',
				'fa-bell-o',
				'fa-bell-slash',
				'fa-bell-slash-o',
				'fa-bicycle',
				'fa-binoculars',
				'fa-birthday-cake',
				'fa-blind',
				'fa-bluetooth',
				'fa-bluetooth-b',
				'fa-bolt',
				'fa-bomb',
				'fa-book',
				'fa-bookmark',
				'fa-bookmark-o',
				'fa-braille',
				'fa-briefcase',
				'fa-bug',
				'fa-building',
				'fa-building-o',
				'fa-bullhorn',
				'fa-bullseye',
				'fa-bus',
				'fa-calculator',
				'fa-calendar',
				'fa-calendar-check-o',
				'fa-calendar-minus-o',
				'fa-calendar-o',
				'fa-calendar-plus-o',
				'fa-calendar-times-o',
				'fa-camera',
				'fa-camera-retro',
				'fa-car',
				'fa-caret-square-o-down',
				'fa-caret-square-o-left',
				'fa-caret-square-o-right',
				'fa-caret-square-o-up',
				'fa-cart-arrow-down',
				'fa-cart-plus',
				'fa-cc',
				'fa-certificate',
				'fa-check',
				'fa-check-circle',
				'fa-check-circle-o',
				'fa-check-square',
				'fa-check-square-o',
				'fa-child',
				'fa-circle',
				'fa-circle-o',
				'fa-circle-o-notch',
				'fa-circle-thin',
				'fa-clock-o',
				'fa-clone',
				'fa-cloud',
				'fa-cloud-download',
				'fa-cloud-upload',
				'fa-code',
				'fa-code-fork',
				'fa-coffee',
				'fa-cog',
				'fa-cogs',
				'fa-comment',
				'fa-comment-o',
				'fa-commenting',
				'fa-commenting-o',
				'fa-comments',
				'fa-comments-o',
				'fa-compass',
				'fa-copyright',
				'fa-creative-commons',
				'fa-credit-card',
				'fa-credit-card-alt',
				'fa-crop',
				'fa-crosshairs',
				'fa-cube',
				'fa-cubes',
				'fa-cutlery',
				'fa-database',
				'fa-deaf',
				'fa-desktop',
				'fa-diamond',
				'fa-dot-circle-o',
				'fa-download',
				'fa-ellipsis-h',
				'fa-ellipsis-v',
				'fa-envelope',
				'fa-envelope-o',
				'fa-envelope-open',
				'fa-envelope-open-o',
				'fa-envelope-square',
				'fa-eraser',
				'fa-exchange',
				'fa-exclamation',
				'fa-exclamation-circle',
				'fa-exclamation-triangle',
				'fa-external-link',
				'fa-external-link-square',
				'fa-eye',
				'fa-eye-slash',
				'fa-eyedropper',
				'fa-fax',
				'fa-female',
				'fa-fighter-jet',
				'fa-file-archive-o',
				'fa-file-audio-o',
				'fa-file-code-o',
				'fa-file-excel-o',
				'fa-file-image-o',
				'fa-file-pdf-o',
				'fa-file-powerpoint-o',
				'fa-file-video-o',
				'fa-file-word-o',
				'fa-film',
				'fa-filter',
				'fa-fire',
				'fa-fire-extinguisher',
				'fa-flag',
				'fa-flag-checkered',
				'fa-flag-o',
				'fa-flask',
				'fa-folder',
				'fa-folder-o',
				'fa-folder-open',
				'fa-folder-open-o',
				'fa-frown-o',
				'fa-futbol-o',
				'fa-gamepad',
				'fa-gavel',
				'fa-gift',
				'fa-glass',
				'fa-globe',
				'fa-graduation-cap',
				'fa-hand-lizard-o',
				'fa-hand-paper-o',
				'fa-hand-peace-o',
				'fa-hand-pointer-o',
				'fa-hand-rock-o',
				'fa-hand-scissors-o',
				'fa-hand-spock-o',
				'fa-handshake-o',
				'fa-hashtag',
				'fa-hdd-o',
				'fa-headphones',
				'fa-heart',
				'fa-heart-o',
				'fa-heartbeat',
				'fa-history',
				'fa-home',
				'fa-hourglass',
				'fa-hourglass-end',
				'fa-hourglass-half',
				'fa-hourglass-o',
				'fa-hourglass-start',
				'fa-i-cursor',
				'fa-id-badge',
				'fa-id-card',
				'fa-id-card-o',
				'fa-inbox',
				'fa-industry',
				'fa-info',
				'fa-info-circle',
				'fa-key',
				'fa-keyboard-o',
				'fa-language',
				'fa-laptop',
				'fa-leaf',
				'fa-lemon-o',
				'fa-level-down',
				'fa-level-up',
				'fa-life-ring',
				'fa-lightbulb-o',
				'fa-line-chart',
				'fa-location-arrow',
				'fa-lock',
				'fa-low-vision',
				'fa-magic',
				'fa-magnet',
				'fa-male',
				'fa-map',
				'fa-map-marker',
				'fa-map-o',
				'fa-map-pin',
				'fa-map-signs',
				'fa-meh-o',
				'fa-microchip',
				'fa-microphone',
				'fa-microphone-slash',
				'fa-minus',
				'fa-minus-circle',
				'fa-minus-square',
				'fa-minus-square-o',
				'fa-mobile',
				'fa-money',
				'fa-moon-o',
				'fa-motorcycle',
				'fa-mouse-pointer',
				'fa-music',
				'fa-newspaper-o',
				'fa-object-group',
				'fa-object-ungroup',
				'fa-paint-brush',
				'fa-paper-plane',
				'fa-paper-plane-o',
				'fa-paw',
				'fa-pencil',
				'fa-pencil-square',
				'fa-pencil-square-o',
				'fa-percent',
				'fa-phone',
				'fa-phone-square',
				'fa-picture-o',
				'fa-pie-chart',
				'fa-plane',
				'fa-plug',
				'fa-plus',
				'fa-plus-circle',
				'fa-plus-square',
				'fa-plus-square-o',
				'fa-podcast',
				'fa-power-off',
				'fa-print',
				'fa-puzzle-piece',
				'fa-qrcode',
				'fa-question',
				'fa-question-circle',
				'fa-question-circle-o',
				'fa-quote-left',
				'fa-quote-right',
				'fa-random',
				'fa-recycle',
				'fa-refresh',
				'fa-registered',
				'fa-reply',
				'fa-reply-all',
				'fa-retweet',
				'fa-road',
				'fa-rocket',
				'fa-rss',
				'fa-rss-square',
				'fa-search',
				'fa-search-minus',
				'fa-search-plus',
				'fa-server',
				'fa-share',
				'fa-share-alt',
				'fa-share-alt-square',
				'fa-share-square',
				'fa-share-square-o',
				'fa-shield',
				'fa-ship',
				'fa-shopping-bag',
				'fa-shopping-basket',
				'fa-shopping-cart',
				'fa-shower',
				'fa-sign-in',
				'fa-sign-language',
				'fa-sign-out',
				'fa-signal',
				'fa-sitemap',
				'fa-sliders',
				'fa-smile-o',
				'fa-snowflake-o',
				'fa-sort',
				'fa-sort-alpha-asc',
				'fa-sort-alpha-desc',
				'fa-sort-amount-asc',
				'fa-sort-amount-desc',
				'fa-sort-asc',
				'fa-sort-desc',
				'fa-sort-numeric-asc',
				'fa-sort-numeric-desc',
				'fa-space-shuttle',
				'fa-spinner',
				'fa-spoon',
				'fa-square',
				'fa-square-o',
				'fa-star',
				'fa-star-half',
				'fa-star-half-o',
				'fa-star-o',
				'fa-sticky-note',
				'fa-sticky-note-o',
				'fa-street-view',
				'fa-suitcase',
				'fa-sun-o',
				'fa-tablet',
				'fa-tachometer',
				'fa-tag',
				'fa-tags',
				'fa-tasks',
				'fa-taxi',
				'fa-television',
				'fa-terminal',
				'fa-thermometer-empty',
				'fa-thermometer-full',
				'fa-thermometer-half',
				'fa-thermometer-quarter',
				'fa-thermometer-three-quarters',
				'fa-thumb-tack',
				'fa-thumbs-down',
				'fa-thumbs-o-down',
				'fa-thumbs-o-up',
				'fa-thumbs-up',
				'fa-ticket',
				'fa-times',
				'fa-times-circle',
				'fa-times-circle-o',
				'fa-tint',
				'fa-toggle-off',
				'fa-toggle-on',
				'fa-trademark',
				'fa-trash',
				'fa-trash-o',
				'fa-tree',
				'fa-trophy',
				'fa-truck',
				'fa-tty',
				'fa-umbrella',
				'fa-universal-access',
				'fa-university',
				'fa-unlock',
				'fa-unlock-alt',
				'fa-upload',
				'fa-user',
				'fa-user-circle',
				'fa-user-circle-o',
				'fa-user-o',
				'fa-user-plus',
				'fa-user-secret',
				'fa-user-times',
				'fa-users',
				'fa-video-camera',
				'fa-volume-control-phone',
				'fa-volume-down',
				'fa-volume-off',
				'fa-volume-up',
				'fa-wheelchair',
				'fa-wheelchair-alt',
				'fa-wifi',
				'fa-window-close',
				'fa-window-close-o',
				'fa-window-maximize',
				'fa-window-minimize',
				'fa-window-restore',
				'fa-wrench',
			),

			'accessibility_icons' => array(
				'fa-american-sign-language-interpreting',
				'fa-assistive-listening-systems',
				'fa-audio-description',
				'fa-blind',
				'fa-braille',
				'fa-cc',
				'fa-deaf',
				'fa-low-vision',
				'fa-question-circle-o',
				'fa-sign-language',
				'fa-tty',
				'fa-universal-access',
				'fa-volume-control-phone',
				'fa-wheelchair',
				'fa-wheelchair-alt',
			),

			'hand_icons' => array(
				'fa-hand-lizard-o',
				'fa-hand-o-down',
				'fa-hand-o-left',
				'fa-hand-o-right',
				'fa-hand-o-up',
				'fa-hand-paper-o',
				'fa-hand-peace-o',
				'fa-hand-pointer-o',
				'fa-hand-rock-o',
				'fa-hand-scissors-o',
				'fa-hand-spock-o',
				'fa-thumbs-down',
				'fa-thumbs-o-down',
				'fa-thumbs-o-up',
				'fa-thumbs-up',
			),

			'transportation_icons' => array(
				'fa-ambulance',
				'fa-bicycle',
				'fa-bus',
				'fa-car',
				'fa-fighter-jet',
				'fa-motorcycle',
				'fa-plane',
				'fa-rocket',
				'fa-ship',
				'fa-space-shuttle',
				'fa-subway',
				'fa-taxi',
				'fa-train',
				'fa-truck',
				'fa-wheelchair',
				'fa-wheelchair-alt',
			),

			'gender_icons' => array(
				'fa-genderless',
				'fa-mars',
				'fa-mars-double',
				'fa-mars-stroke',
				'fa-mars-stroke-h',
				'fa-mars-stroke-v',
				'fa-mercury',
				'fa-neuter',
				'fa-transgender',
				'fa-transgender-alt',
				'fa-venus',
				'fa-venus-double',
				'fa-venus-mars',
			),

			'file_type_icons' => array (
				'fa-file',
				'fa-file-archive-o',
				'fa-file-audio-o',
				'fa-file-code-o',
				'fa-file-excel-o',
				'fa-file-image-o',
				'fa-file-o',
				'fa-file-pdf-o',
				'fa-file-powerpoint-o',
				'fa-file-text',
				'fa-file-text-o',
				'fa-file-video-o',
				'fa-file-word-o',
			),

			'spinner_icons' => array (
				'fa-circle-o-notch',
				'fa-cog',
				'fa-refresh',
				'fa-spinner',
			),

			'form_control_icons' => array (
				'fa-check-square',
				'fa-check-square-o',
				'fa-circle',
				'fa-circle-o',
				'fa-dot-circle-o',
				'fa-minus-square',
				'fa-minus-square-o',
				'fa-plus-square',
				'fa-plus-square-o',
				'fa-square',
				'fa-square-o',
			),

			'payment_icons' => array (
				'fa-cc-amex',
				'fa-cc-diners-club',
				'fa-cc-discover',
				'fa-cc-jcb',
				'fa-cc-mastercard',
				'fa-cc-paypal',
				'fa-cc-stripe',
				'fa-cc-visa',
				'fa-credit-card',
				'fa-credit-card-alt',
				'fa-google-wallet',
				'fa-paypal',
			),

			'chart_icons' => array (
				'fa-area-chart',
				'fa-bar-chart',
				'fa-line-chart',
				'fa-pie-chart',
			),

			'currency_icons' => array (
				'fa-btc',
				'fa-eur',
				'fa-gbp',
				'fa-gg',
				'fa-gg-circle',
				'fa-ils',
				'fa-inr',
				'fa-jpy',
				'fa-krw',
				'fa-money',
				'fa-rub',
				'fa-try',
				'fa-usd',
			),

			'text_editor_icons' => array (
				'fa-align-center',
				'fa-align-justify',
				'fa-align-left',
				'fa-align-right',
				'fa-bold',
				'fa-chain-broken',
				'fa-clipboard',
				'fa-columns',
				'fa-eraser',
				'fa-file',
				'fa-file-o',
				'fa-file-text',
				'fa-file-text-o',
				'fa-files-o',
				'fa-floppy-o',
				'fa-font',
				'fa-header',
				'fa-indent',
				'fa-italic',
				'fa-link',
				'fa-list',
				'fa-list-alt',
				'fa-list-ol',
				'fa-list-ul',
				'fa-outdent',
				'fa-paperclip',
				'fa-paragraph',
				'fa-repeat',
				'fa-scissors',
				'fa-strikethrough',
				'fa-subscript',
				'fa-superscript',
				'fa-table',
				'fa-text-height',
				'fa-text-width',
				'fa-th',
				'fa-th-large',
				'fa-th-list',
				'fa-underline',
				'fa-undo',
			),

			'directional_icons' => array (
				'fa-angle-double-down',
				'fa-angle-double-left',
				'fa-angle-double-right',
				'fa-angle-double-up',
				'fa-angle-down',
				'fa-angle-left',
				'fa-angle-right',
				'fa-angle-up',
				'fa-arrow-circle-down',
				'fa-arrow-circle-left',
				'fa-arrow-circle-o-down',
				'fa-arrow-circle-o-left',
				'fa-arrow-circle-o-right',
				'fa-arrow-circle-o-up',
				'fa-arrow-circle-right',
				'fa-arrow-circle-up',
				'fa-arrow-down',
				'fa-arrow-left',
				'fa-arrow-right',
				'fa-arrow-up',
				'fa-arrows',
				'fa-arrows-alt',
				'fa-arrows-h',
				'fa-arrows-v',
				'fa-caret-down',
				'fa-caret-left',
				'fa-caret-right',
				'fa-caret-square-o-down',
				'fa-caret-square-o-left',
				'fa-caret-square-o-right',
				'fa-caret-square-o-up',
				'fa-caret-up',
				'fa-chevron-circle-down',
				'fa-chevron-circle-left',
				'fa-chevron-circle-right',
				'fa-chevron-circle-up',
				'fa-chevron-down',
				'fa-chevron-left',
				'fa-chevron-right',
				'fa-chevron-up',
				'fa-exchange',
				'fa-hand-o-down',
				'fa-hand-o-left',
				'fa-hand-o-right',
				'fa-hand-o-up',
				'fa-long-arrow-down',
				'fa-long-arrow-left',
				'fa-long-arrow-right',
				'fa-long-arrow-up',
			),

			'video_player_icons' => array (
				'fa-arrows-alt',
				'fa-backward',
				'fa-compress',
				'fa-eject',
				'fa-expand',
				'fa-fast-backward',
				'fa-fast-forward',
				'fa-forward',
				'fa-pause',
				'fa-pause-circle',
				'fa-pause-circle-o',
				'fa-play',
				'fa-play-circle',
				'fa-play-circle-o',
				'fa-random',
				'fa-step-backward',
				'fa-step-forward',
				'fa-stop',
				'fa-stop-circle',
				'fa-stop-circle-o',
				'fa-youtube-play',
			),

			'brand_icons' => array (
				'fa-500px',
				'fa-adn',
				'fa-amazon',
				'fa-android',
				'fa-angellist',
				'fa-apple',
				'fa-bandcamp',
				'fa-behance',
				'fa-behance-square',
				'fa-bitbucket',
				'fa-bitbucket-square',
				'fa-black-tie',
				'fa-bluetooth',
				'fa-bluetooth-b',
				'fa-btc',
				'fa-buysellads',
				'fa-cc-amex',
				'fa-cc-diners-club',
				'fa-cc-discover',
				'fa-cc-jcb',
				'fa-cc-mastercard',
				'fa-cc-paypal',
				'fa-cc-stripe',
				'fa-cc-visa',
				'fa-chrome',
				'fa-codepen',
				'fa-codiepie',
				'fa-connectdevelop',
				'fa-contao',
				'fa-css3',
				'fa-dashcube',
				'fa-delicious',
				'fa-deviantart',
				'fa-digg',
				'fa-dribbble',
				'fa-dropbox',
				'fa-drupal',
				'fa-edge',
				'fa-eercast',
				'fa-empire',
				'fa-envira',
				'fa-etsy',
				'fa-expeditedssl',
				'fa-facebook',
				'fa-facebook-official',
				'fa-facebook-square',
				'fa-firefox',
				'fa-first-order',
				'fa-flickr',
				'fa-font-awesome',
				'fa-fonticons',
				'fa-fort-awesome',
				'fa-forumbee',
				'fa-foursquare',
				'fa-free-code-camp',
				'fa-get-pocket',
				'fa-gg',
				'fa-gg-circle',
				'fa-git',
				'fa-git-square',
				'fa-github',
				'fa-github-alt',
				'fa-github-square',
				'fa-gitlab',
				'fa-glide',
				'fa-glide-g',
				'fa-google',
				'fa-google-plus',
				'fa-google-plus-official',
				'fa-google-plus-square',
				'fa-google-wallet',
				'fa-gratipay',
				'fa-grav',
				'fa-hacker-news',
				'fa-houzz',
				'fa-html5',
				'fa-imdb',
				'fa-instagram',
				'fa-internet-explorer',
				'fa-ioxhost',
				'fa-joomla',
				'fa-jsfiddle',
				'fa-lastfm',
				'fa-lastfm-square',
				'fa-leanpub',
				'fa-linkedin',
				'fa-linkedin-square',
				'fa-linode',
				'fa-linux',
				'fa-maxcdn',
				'fa-meanpath',
				'fa-medium',
				'fa-meetup',
				'fa-mixcloud',
				'fa-modx',
				'fa-odnoklassniki',
				'fa-odnoklassniki-square',
				'fa-opencart',
				'fa-openid',
				'fa-opera',
				'fa-optin-monster',
				'fa-pagelines',
				'fa-paypal',
				'fa-pied-piper',
				'fa-pied-piper-alt',
				'fa-pied-piper-pp',
				'fa-pinterest',
				'fa-pinterest-p',
				'fa-pinterest-square',
				'fa-product-hunt',
				'fa-qq',
				'fa-quora',
				'fa-ravelry',
				'fa-rebel',
				'fa-reddit',
				'fa-reddit-alien',
				'fa-reddit-square',
				'fa-renren',
				'fa-safari',
				'fa-scribd',
				'fa-sellsy',
				'fa-share-alt',
				'fa-share-alt-square',
				'fa-shirtsinbulk',
				'fa-simplybuilt',
				'fa-skyatlas',
				'fa-skype',
				'fa-slack',
				'fa-slideshare',
				'fa-snapchat',
				'fa-snapchat-ghost',
				'fa-snapchat-square',
				'fa-soundcloud',
				'fa-spotify',
				'fa-stack-exchange',
				'fa-stack-overflow',
				'fa-steam',
				'fa-steam-square',
				'fa-stumbleupon',
				'fa-stumbleupon-circle',
				'fa-superpowers',
				'fa-telegram',
				'fa-tencent-weibo',
				'fa-themeisle',
				'fa-trello',
				'fa-tripadvisor',
				'fa-tumblr',
				'fa-tumblr-square',
				'fa-twitch',
				'fa-twitter',
				'fa-twitter-square',
				'fa-usb',
				'fa-viacoin',
				'fa-viadeo',
				'fa-viadeo-square',
				'fa-vimeo',
				'fa-vimeo-square',
				'fa-vine',
				'fa-vk',
				'fa-weibo',
				'fa-weixin',
				'fa-whatsapp',
				'fa-wikipedia-w',
				'fa-windows',
				'fa-wordpress',
				'fa-wpbeginner',
				'fa-wpexplorer',
				'fa-wpforms',
				'fa-xing',
				'fa-xing-square',
				'fa-y-combinator',
				'fa-yahoo',
				'fa-yelp',
				'fa-yoast',
				'fa-youtube',
				'fa-youtube-play',
				'fa-youtube-square',
			),

			'medical_icons' => array (
				'fa-ambulance',
				'fa-h-square',
				'fa-heart',
				'fa-heart-o',
				'fa-heartbeat',
				'fa-hospital-o',
				'fa-medkit',
				'fa-plus-square',
				'fa-stethoscope',
				'fa-user-md',
				'fa-wheelchair',
				'fa-wheelchair-alt',
			),

			)
		);
	endif;

}