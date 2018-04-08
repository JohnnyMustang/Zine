<?php
/**
 * Miscellaneous template functions.
 * These functions are for use throughout the theme's various template files.
 * This file is loaded via the 'after_setup_theme' hook at priority '10'
 *
 * @package    Hoot
 * @subpackage Dollah
 */

/**
 * Display the branding area
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'dollah_header_branding' ) ):
function dollah_header_branding() {
	?>
	<div <?php hybridextend_attr( 'branding' ); ?>>
		<div id="site-logo" class="<?php
			echo 'site-logo-' . esc_attr( dollah_get_mod( 'logo' ) );
			if ( dollah_get_mod('logo_background_type') == 'accent' )
				echo ' accent-typo with-background';
			elseif ( dollah_get_mod('logo_background_type') == 'background' )
				echo ' with-background';
			?>">
			<?php
			// Display the Image Logo or Site Title
			dollah_logo();
			?>
		</div>
	</div><!-- #branding -->
	<?php
}
endif;

/**
 * Displays the branding logo
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'dollah_logo' ) ):
function dollah_logo() {
	$display = '';
	$dollah_logo = dollah_get_mod( 'logo' );

	if ( 'text' == $dollah_logo || 'custom' == $dollah_logo ) {

		$tag = ( is_front_page() ) ? 'h1' : 'div';
		$title_icon = dollah_get_mod( 'site_title_icon', NULL );

		$class = ( $title_icon ) ? ' site-logo-with-icon' : '';
		if ( !function_exists( 'dollah_theme_premium' ) ) {
			$class .= ( 'text' == $dollah_logo ) ? ' site-logo-text-' . dollah_get_mod( 'logo_size' ) : '';
		}
		$class = ( empty( $class ) ) ? '' : ' class="' . $class . '"';

		$display .= '<div id="site-logo-' . esc_attr( $dollah_logo ) . '"' . $class . '>';

			if ( $title_icon )
				$title_icon = '<i class="fa ' . sanitize_html_class( $title_icon ) . '"></i>';

			$display .= "<{$tag} " . hybridextend_get_attr( 'site-title' ) . '>' .
						'<a href="' . esc_url( home_url() ) . '" rel="home">' .
						$title_icon;
			$title = '';

			if ( 'text' == $dollah_logo ) {
				$title = get_bloginfo( 'name' );
			} elseif ( 'custom' == $dollah_logo ) {
				$title = dollah_get_custom_text_logo();
			}

			$display .= apply_filters( 'dollah_site_title', $title );
			$display .= "</a></{$tag}>";

			if ( dollah_get_mod( 'show_tagline' ) )
				$display .= hybrid_get_site_description();

		$display .= '</div><!--logotext-->';

	} elseif ( 'mixed' == $dollah_logo || 'mixedcustom' == $dollah_logo ) {

		$tag = ( is_front_page() ) ? 'h1' : 'div';
		$logo_image = ( function_exists( 'get_custom_logo' ) ) ?
						get_custom_logo() :
						'<a href="' . esc_url( home_url() ) . '" rel="home" itemprop="url">' .
							'<img src="' . esc_url( dollah_get_mod( 'logo_image' ) ) . '" />' .
						'</a>';
		$has_logo = ( function_exists( 'get_custom_logo' ) ) ? has_custom_logo() : dollah_get_mod( 'logo_image' );

		$class = ( $has_logo ) ? 'site-logo-with-image' : '';
		if ( !function_exists( 'dollah_theme_premium' ) ) {
			$class .= ( 'mixed' == $dollah_logo ) ? ' site-logo-text-' . dollah_get_mod( 'logo_size' ) : '';
		}
		$class = ( empty( $class ) ) ? '' : ' class="' . $class . '"';

		$display .= '<div id="site-logo-' . esc_attr( $dollah_logo ) . '"' . $class . '>';

			if ( $has_logo )
				$display .= '<div class="site-logo-mixed-image">' .
							$logo_image .
							'</div>';

			$display .= '<div class="site-logo-mixed-text">' .
						"<{$tag} " . hybridextend_get_attr( 'site-title' ) . '>' .
						'<a href="' . esc_url( home_url() ) . '" rel="home" itemprop="url">';

			$title = '';
			if ( 'mixed' == $dollah_logo ) {
				$title = get_bloginfo( 'name' );
			} elseif ( 'mixedcustom' == $dollah_logo ) {
				$title = dollah_get_custom_text_logo();
			}

			$display .= apply_filters( 'dollah_site_title', $title ) .
						'</a>' .
						"</{$tag}>";

			if ( dollah_get_mod( 'show_tagline' ) )
				$display .= hybrid_get_site_description();

			$display .= '</div><!--site-logo-mixed-text-->';

		$display .= '</div><!--logotext-->';

	} elseif ( 'image' == $dollah_logo ) {
		$display .= dollah_get_logo_image();
	}

	echo apply_filters( 'dollah_display_logo', $display, $dollah_logo );
}
endif;

/**
 * Returns the custom text logo
 *
 * @since 1.0
 * @access public
 * @return string
 */
if ( !function_exists( 'dollah_get_custom_text_logo' ) ):
function dollah_get_custom_text_logo() {
	$title = '';
	$logo_custom = apply_filters( 'dollah_logo_custom_text', hybridextend_sortlist( dollah_get_mod( 'logo_custom' ) ) );

	if ( is_array( $logo_custom ) && !empty( $logo_custom ) ) {
		$lcount = 1;
		foreach ( $logo_custom as $logo_custom_line ) {
			if ( !$logo_custom_line['sortitem_hide'] && !empty( $logo_custom_line['text'] ) ) {
				$line_class = 'site-title-line site-title-line' . $lcount;
				$line_class .= ( $logo_custom_line['font'] == 'standard' ) ? ' site-title-body-font' : '';
				$line_class .= ( $logo_custom_line['font'] == 'heading2' ) ? ' site-title-heading-font' : '';
				$title .= '<span class="' . $line_class . '">' . wp_kses_decode_entities( $logo_custom_line['text'] ) . '</span>';
			}
			$lcount++;
		}

	}
	return $title;
}
endif;

/**
 * Returns the image logo
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'dollah_get_logo_image' ) ):
function dollah_get_logo_image() {
	$tag = ( is_front_page() ) ? 'h1' : 'div';
	$logo_image = ( function_exists( 'get_custom_logo' ) ) ?
					get_custom_logo() :
					'<a href="' . esc_url( home_url() ) . '" rel="home" itemprop="url">' .
						'<img src="' . esc_url( dollah_get_mod( 'logo_image' ) ) . '" />' .
					'</a>';
	$has_logo = ( function_exists( 'get_custom_logo' ) ) ? has_custom_logo() : dollah_get_mod( 'logo_image' );
	$class = '';
	$class = ( empty( $class ) ) ? '' : ' class="' . $class . '"';
	if ( !empty( $has_logo ) ) {
		return '<div id="site-logo-image" ' . $class . '>'
				. "<{$tag} " . hybridextend_get_attr( 'site-title' ) . '>'
				. $logo_image
				. "</{$tag}>"
				.'</div>';
	}
}
endif;

/**
 * Display the primary menu area
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'dollah_header_aside' ) ):
function dollah_header_aside() {
	$area = esc_attr( dollah_get_mod( 'primary_menuarea' ) );
	if ( $area == 'none' )
		return;

	?><div <?php hybridextend_attr( 'header-aside', '', "header-aside-{$area}" ); ?>><?php

		if ( $area == 'search' ):
			if ( dollah_get_mod( 'primary_header-search' ) )
				get_search_form();
			$hicons = '';
			$sictotal = apply_filters( 'dollah_headeroptions_socialicons', 5 );
			for ( $sic=1; $sic <= $sictotal; $sic++ ) {
				$icon = dollah_get_mod( 'primary_header-icon' . $sic );
				$url = dollah_get_mod( 'primary_header-url' . $sic );
				if ( $icon && $url ) {
					$icon_class = sanitize_html_class( $icon ) . '-block';
						if ( $icon == 'fa-envelope' ) {
							$url = str_replace( array( 'http://', 'https://'), '', esc_url( $url ) );
							$url = 'mailto:' . $url;
						} else {
							$url = esc_url( $url );
						}
						$context = $icon;
						$hicons .=   '<a href="' . $url . '" ' . hybridextend_get_attr( 'social-icons-icon', $context, $icon_class ) . '>'
								. '<i class="fa ' . sanitize_html_class( $icon ) . '"></i>'
								. '</a>';
				}
			}
			if ( !empty( $hicons ) )
				echo '<div class="social-icons-widget social-icons-small">' . $hicons . '</div>';
		endif;

		if ( $area == 'widget-area' ):
			hybridextend_get_sidebar( 'header' );
		endif;

	?></div><?php

}
endif;

/**
 * Display the secondary header area menu
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'dollah_header_menu' ) ):
function dollah_header_menu( $location ) {
	$menu_location = dollah_get_mod( 'secondary_menu_location' );
	if ( $location == $menu_location ) {
		?>
		<div <?php hybridextend_attr( 'header-part', 'supplementary' ); ?>>
			<div class="hgrid">
				<div class="hgrid-span-12">
					<?php
					echo '<div ' . hybridextend_get_attr( 'menu-nav-box', 'menu-side-none' ) . '>';
					// Loads the template-parts/menu-secondary.php template.
					hybridextend_get_menu( 'secondary' );
					echo '</div>';
					?>
				</div>
			</div>
		</div>
		<?php
	}
}
endif;

/**
 * Display a friendly reminder to update outdated browser
 *
 * @since 1.0
 * @access public
 */
if ( !function_exists( 'dollah_update_browser' ) ):
function dollah_update_browser() {
	$notice = '<!--[if lte IE 9]><p class="chromeframe">' .
			  sprintf( __( 'You are using an outdated browser (IE 8 or before). For a better user experience, we recommend %1$1supgrading your browser today%2$2s or %3$3sinstalling Google Chrome Frame%4$4s', 'dollah' ), '<a href="http://browsehappy.com/">', '</a>', '<a href="http://www.google.com/chromeframe/?redirect=true">', '</a>' ) .
			  '</p><![endif]-->';
	echo apply_filters( 'dollah_update_browser_notice', $notice );
}
endif;

/**
 * Temporarily remove read more links from excerpts
 *
 * @since 1.0
 * @access public
 */
if ( !function_exists( 'dollah_remove_readmore_link' ) ):
function dollah_remove_readmore_link() {
	add_filter( 'dollah_readmore', 'dollah_readmore_empty_string' );
}
endif;
if ( !function_exists( 'dollah_readmore_empty_string' ) ):
function dollah_readmore_empty_string() {
	return '';
}
endif;

/**
 * Reinstate read more links to excerpts
 *
 * @since 1.0
 * @access public
 */
if ( !function_exists( 'dollah_reinstate_readmore_link' ) ):
function dollah_reinstate_readmore_link() {
	remove_filter( 'dollah_readmore', 'dollah_readmore_empty_string' );
}
endif;

/**
 * Display title area content
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'dollah_display_loop_title_content' ) ):
function dollah_display_loop_title_content( $location = 'pre', $context = '' ) {

	$pre_title_content_post = apply_filters( 'dollah_loop_meta_pre_title_content_post', '', $location, $context );
	if ( ( $location == 'pre' && !$pre_title_content_post ) ||
		 ( $location == 'post' && $pre_title_content_post ) ) : 

		$pre_title_content = apply_filters( 'dollah_loop_meta_pre_title_content', '', $location, $context );
		if ( !empty( $pre_title_content ) ) :

			$pre_title_content_stretch =  apply_filters( 'dollah_loop_meta_pre_title_content_stretch', '', $location, $context ); ?>
			<div id="custom-content-title-area" class="<?php
				echo $location . '-content-title-area ';
				echo ( ($pre_title_content_stretch) ? 'content-title-area-stretch' : 'content-title-area-grid' );
				?>">
				<div class="<?php echo ( ($pre_title_content_stretch) ? 'hgrid-stretch' : 'hgrid' ); ?>">
					<div class="hgrid-span-12">
						<?php echo do_shortcode( $pre_title_content ); ?>
					</div>
				</div>
			</div>
			<?php

		endif;

	endif;
}
endif;

/**
 * Return the display array of meta blocks to show
 *
 * @since 1.3
 * @access public
 * @param array|string $args (comma delimited) information to display
 * @param string $context context in which meta blocks are being displayed
 * @param bool $bool Return bool value
 * @return array|bool
 */
if ( !function_exists( 'dollah_meta_info_display' ) ):
function dollah_meta_info_display( $args = '', $context = '', $bool = false ) {

	if ( !is_array( $args ) )
		$args = array_map( 'trim', explode( ',', $args ) );

	$display = array();
	foreach ( array( 'author', 'date', 'cats', 'tags', 'comments' ) as $key ) {
		if ( in_array( $key, $args ) )
			$display[ $key ] = true;
	}

	// if ( is_page() ) { : returns true in post loop when frontpage set as static page
	if ( get_post_type() == ' post' ) {
		if ( isset( $display['cats'] ) ) unset( $display['cats'] );
		if ( isset( $display['tags'] ) ) unset( $display['tags'] );
	}

	if ( !empty( $display['author'] ) )
		$display['publisher'] = true;

	$display = apply_filters( 'dollah_meta_info_blocks_display', $display, $context );

	if ( $bool ) {
		if ( empty( $display ) ) return false; else return true;
	} else {
		return $display;
	}

}
endif;

/**
 * Display the meta information HTML for single post/page
 *
 * @since 1.0
 * @access public
 * @param array|string $args (comma delimited) information to display
 * @param string $context context in which meta blocks are being displayed
 * @return void
 */
if ( !function_exists( 'dollah_meta_info_blocks' ) ):
function dollah_meta_info_blocks( $args = '', $context = '' ) {

	if ( !is_array( $args ) )
		$args = array_map( 'trim', explode( ',', $args ) );

	$display = dollah_meta_info_display( $args, $context );

	if ( empty( $display ) ) {
		echo '<div class="entry-byline empty"></div>';
		return;
	}
	?>

	<div class="entry-byline">

		<?php
		$blocks = array();

		if ( !empty( $display['author'] ) ) :
			$blocks['author']['label'] = __( 'By:', 'dollah' );
			ob_start();
			the_author_posts_link();
			$blocks['author']['content'] = '<span ' . hybridextend_get_attr( 'entry-author' ) . '>' . ob_get_clean() . '</span>';
		endif;

		if ( !empty( $display['date'] ) ) :
			$blocks['date']['label'] = __( 'On:', 'dollah' );
			$blocks['date']['content'] = '<time ' . hybridextend_get_attr( 'entry-published' ) . '>' . get_the_date() . '</time>';
		endif;

		if ( !empty( $display['cats'] ) ) :
			$category_list = get_the_category_list(', ');
			if ( !empty( $category_list ) ) :
				$blocks['cats']['label'] = __( 'In:', 'dollah' );
				$blocks['cats']['content'] = $category_list;
			endif;
		endif;

		if ( !empty( $display['tags'] ) && get_the_tags() ) :
			$blocks['tags']['label'] = __( 'Tagged:', 'dollah' );
			$blocks['tags']['content'] = ( ! get_the_tags() ) ? __( 'No Tags', 'dollah' ) : get_the_tag_list( '', ', ', '' );
		endif;

		if ( !empty( $display['comments'] ) && comments_open() ) :
			$blocks['comments']['label'] = __( 'With:', 'dollah' );
			ob_start();
			comments_popup_link(__( '0 Comments', 'dollah' ),
								__( '1 Comment', 'dollah' ),
								__( '% Comments', 'dollah' ), 'comments-link', '' );
			$blocks['comments']['content'] = ob_get_clean();
		endif;

		if ( $edit_link = get_edit_post_link() ) :
			$blocks['editlink']['label'] = '';
			$blocks['editlink']['content'] = '<a href="' . $edit_link . '">' . __( 'Edit This', 'dollah' ) . '</a>';
		endif;

		$blocks = apply_filters( 'dollah_meta_info_blocks', $blocks, $context, $display );

		foreach ( $blocks as $key => $block ) {
			if ( !empty( $block['content'] ) ) {
				echo ' <div class="entry-byline-block entry-byline-' . $key . '">';
					if ( !empty( $block['label'] ) )
						echo ' <span class="entry-byline-label">' . $block['label'] . '</span> ';
					echo $block['content'];
				echo ' </div>';
			}
		}

		if ( !empty( $display['publisher'] ) ) {
			static $microdatapublisher;
			if ( empty( $microdatapublisher ) ) {
				$pname = get_bloginfo();
				if ( function_exists( 'get_custom_logo' ) ) {
					$iid = intval( get_theme_mod( 'custom_logo' ) );
					if ( !empty( $iid ) ) {
						$isrc = wp_get_attachment_image_src( $iid, 'full' );
						if( empty( $isrc ) ) $isrc = wp_get_attachment_image_src( $iid, 'full', true );
						if ( !empty( $isrc[0] ) ) {
							$ilogo = $isrc[0];
							$iwidth = ( empty( $isrc[1] ) ) ? '' : $isrc[1];
							$iheight = ( empty( $isrc[2] ) ) ? '' : $isrc[2];
						}
					}
				}
				if ( empty( $ilogo ) )
					$ilogo = $iwidth = $iheight = '';
				$microdatapublisher =
					'<span class="entry-publisher" itemprop="publisher" itemscope="itemscope" itemtype="http://schema.org/Organization">' .
						'<meta itemprop="name" content="' . $pname . '">' .
						'<span itemprop="logo" itemscope itemtype="https://schema.org/ImageObject">' .
							'<meta itemprop="url" content="' . $ilogo . '">' .
							'<meta itemprop="width" content="' . $iwidth . '">' .
							'<meta itemprop="height" content="' . $iheight . '">' .
						'</span>' .
					'</span>';
			}
			echo apply_filters( 'dollah_entry_byline_publisher', $microdatapublisher );
		}
		?>

	</div><!-- .entry-byline -->

	<?php
}
endif;

/**
 * Force meta info block display
 *
 * @since 1.2
 * @access public
 * @param array $display
 * @param $context
 * @return array
 */
if ( !function_exists( 'dollah_meta_info_blocks_forcedisplay' ) ):
function dollah_meta_info_blocks_forcedisplay( $display, $context ) {
	if ( empty( $context ) ) return $display;
	if ( !is_array( $context ) )
		$context = array_map( 'trim', explode( ',', $context ) );
	foreach ( $context as $key )
		$display[ $key ] = true;
	return $display;
}
endif;
add_filter( 'dollah_meta_info_blocks_display', 'dollah_meta_info_blocks_forcedisplay', 5, 2 );

/**
 * Display featured image in header
 *
 * @since 1.0
 * @access public
 * @param array $display
 * @param $context
 * @return array
 */
if ( !function_exists( 'dollah_featuredimg_before_main' ) ):
function dollah_featuredimg_before_main( $context ) {
	if ( $context == 'single.php' || ( $context == 'page.php' && !hybridextend_is_404() ) ) {
		if ( dollah_get_mod( 'post_featured_image' ) == 'header' ) {
			$img_size = apply_filters( 'dollah_post_image_singular', 'full', $context );
			$iid = get_post_thumbnail_id();
			if ( !empty( $iid ) ) {
				$isrc = wp_get_attachment_image_src( $iid, $img_size );
				if( empty( $isrc ) ) $isrc = wp_get_attachment_image_src( $iid, $img_size, true );
				if ( !empty( $isrc[0] ) ) {
					echo '<div ' . hybridextend_get_attr( 'entry-featured-img-headerwrap', '', array(
							'data-parallax' => 'scroll',
							'data-image-src' => esc_url( $isrc[0] ),
						) ) . '>';
					dollah_post_thumbnail( 'entry-content-featured-img', $img_size, true );
					echo '</div>';
				}
			}
		}
	}
}
endif;
add_action( 'dollah_template_before_content_grid', 'dollah_featuredimg_before_main' );

/**
 * Display the post thumbnail image
 *
 * @since 1.0
 * @access public
 * @param string $classes additional classes
 * @param string $size span or column size or actual image size name. Default is content width span.
 * @param bool $miscrodata true|false Add microdata or not
 * @param string $link image link url
 * @param bool $crop true|false|null Using null will return closest matched image irrespective of its crop setting
 * @return void
 */
if ( !function_exists( 'dollah_post_thumbnail' ) ):
function dollah_post_thumbnail( $classes = '', $size = '', $microdata = false, $link = '', $crop = NULL ) {

	/* Add custom Classes if any */
	$custom_class = '';
	if ( !empty( $classes ) ) {
		$classes = explode( " ", $classes );
		foreach ( $classes as $class ) {
			$custom_class .= ' ' . sanitize_html_class( $class );
		}
	}

	/* Calculate the size to display */
	$thumbnail_size = dollah_thumbnail_size( $size, $crop );

	/* Finally display the image */
	if ( $microdata ) {
		$iid = get_post_thumbnail_id();
		if ( !empty( $iid ) ) {
			$isrc = wp_get_attachment_image_src( $iid, $thumbnail_size );
			if( empty( $isrc ) ) $isrc = wp_get_attachment_image_src( $iid, $thumbnail_size, true );
			if ( !empty( $isrc[0] ) ) {
				$iwidth = ( empty( $isrc[1] ) ) ? '' : $isrc[1];
				$iheight = ( empty( $isrc[2] ) ) ? '' : $isrc[2];
				echo apply_filters( 'dollah_post_thumbnail_microdata',
					'<div itemprop="image" itemscope itemtype="https://schema.org/ImageObject" class="entry-featured-img-wrap">' .
					'<meta itemprop="url" content="' . $isrc[0] . '">' .
					'<meta itemprop="width" content="' . $iwidth . '">' .
					'<meta itemprop="height" content="' . $iheight . '">'
					, $isrc[0], $iwidth, $iheight );
				$microdatadisplay = true;
			}
		}
	}
	if ( empty( $microdatadisplay ) )
		echo '<div class="entry-featured-img-wrap">';
	$link  = esc_url( $link );
	if ( !empty( $link ) ) echo '<a href="' . $link . '" ' . hybridextend_get_attr( 'entry-featured-img-link' ) . '>';
	the_post_thumbnail( $thumbnail_size, array( 'class' => "attachment-$thumbnail_size $custom_class", 'itemscope' => '' ) );
	if ( !empty( $link ) ) echo '</a>';
	echo '</div>';

}
endif;

/**
 * Get the thumbnail size
 *
 * @since 1.0
 * @access public
 * @param string $size span or column size or actual image size name. Default is content width span.
 * @param bool $crop true|false|null Using null will return closest matched image irrespective of its crop setting
 * @return void
 */
if ( !function_exists( 'dollah_thumbnail_size' ) ):
function dollah_thumbnail_size( $size = '', $crop = NULL ) {

	/* Calculate the size to display */
	if ( !empty( $size ) ) {
		if ( 0 === strpos( $size, 'span-' ) || 0 === strpos( $size, 'column-' ) )
			$thumbnail_size = hybridextend_get_image_size_name( $size, $crop );
		else
			$thumbnail_size = $size;
	} else {
		$size = 'span-' . dollah_main_layout( 'content' );
		$thumbnail_size = hybridextend_get_image_size_name( $size, $crop );
	}

	/* Let child themes filter the size name */
	$thumbnail_size = apply_filters( 'dollah_post_thumbnail' , $thumbnail_size, $size, $crop );

	return $thumbnail_size;
}
endif;

/**
 * Utility function to extract border class for widget based on user option.
 *
 * @since 1.0
 * @access public
 * @param string $val string value separated by spaces
 * @param int $index index for value to extract from $val
 * @prefix string $prefix prefixer for css class to return
 * @return void
 */
if ( !function_exists( 'dollah_widget_border_class' ) ):
function dollah_widget_border_class( $val, $index=0, $prefix='' ) {
	$val = explode( " ", trim( $val ) );
	if ( isset( $val[ $index ] ) )
		return $prefix . trim( $val[ $index ] );
	else
		return '';
}
endif;

/**
 * Utility function to create style string attribute.
 *
 * @since 1.2
 * @access public
 * @param string $mt margin top
 * @param string $mb margin bottom
 * @return string
 */
if ( !function_exists( 'dollah_widget_margin_style' ) ):
function dollah_widget_margin_style( $mt='', $mb='' ) {
	$return = '';
	if ( $mt===0 || $mt==='0' ) {
		$return .= " margin-top:0px;";
	} else {
		$margin = intval( $mt );
		if ( !empty( $margin ) ) $return .= " margin-top:{$margin}px;";
	}
	if ( $mb===0 || $mb==='0' ) {
		$return .= " margin-bottom:0px;";
	} else {
		$margin = intval( $mb );
		if ( !empty( $margin ) ) $return .= " margin-bottom:{$margin}px;";
	}
	if ( !empty( $return ) ) $return = ' style="'.$return.'" ';
	return $return;
}
endif;

/**
 * Call the following hook at wp_loaded
 * It must be added after register_sidebars is called
 *
 * @since 1.2
 * @access public
 * @return void
 */
if ( !function_exists( 'dollah_widgetparam_hook' ) ):
function dollah_widgetparam_hook() {
	if ( ! is_admin() )
		add_filter( 'dynamic_sidebar_params', 'dollah_modify_widgetparams' );
}
endif;
add_action( 'wp_loaded', 'dollah_widgetparam_hook' );

/**
 * Add custom widget css class and styles
 *
 * @since 1.2
 * @access public
 * @param array $params
 * @return array
 */
if ( !function_exists( 'dollah_modify_widgetparams' ) ):
function dollah_modify_widgetparams( $params ) {
	global $wp_registered_widgets;
	if ( !isset( $params[0] ) || !isset( $params[0]['widget_id'] ) )
		return $params;
	$widget_id = $params[0]['widget_id']; // Current widget id Eg: dollah-content-blocks-widget-16

	if ( !isset( $wp_registered_widgets[ $widget_id ] ) || !isset( $wp_registered_widgets[ $widget_id ]['params'][0]['number'] ) || !isset( $wp_registered_widgets[ $widget_id ]['callback'][0]->option_name ) )
		return $params;
	$widget_obj = $wp_registered_widgets[ $widget_id ]; // Returns array of callback (Widget object with form options etc), params, classname, description, customize_selective_refresh, class
	$widget_num = $widget_obj['params'][0]['number']; // Get instance number of current widget (eg: 16)
	$widget_opt = get_option( $widget_obj['callback'][0]->option_name ); // all instance values of a particular widget (example: option_name = 'widget_dollah-content-blocks-widget' )
	$instance = ( isset ( $widget_opt[ $widget_num ] ) ) ? $widget_opt[ $widget_num ] : array(); // Get values of current widget

	if ( !empty( $instance['customcss'] ) ) {
		$custom = $instance['customcss'];
		$string = 'class="widget';
		if ( !empty( $custom['class'] ) ) {
			$classes = explode( " ", $custom['class'] );
			foreach ( $classes as $class )
				$string .= ' ' . sanitize_html_class( $class );
		}
		$mt = ( !isset( $custom['mt'] ) ) ? '' : $custom['mt'];
		$mb = ( !isset( $custom['mb'] ) ) ? '' : $custom['mb'];
		$string = dollah_widget_margin_style( $mt, $mb ) . $string;
		$params[0]['before_widget'] = str_replace( 'class="widget', $string, $params[0]['before_widget'] );
	}

	return $params;
}
endif;

/**
 * Utility function to map footer sidebars structure to CSS span architecture.
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'dollah_footer_structure' ) ):
function dollah_footer_structure() {
	$footers = dollah_get_mod( 'footer' );
	$structure = array(
				'1-1' => array( 12, 12, 12, 12 ),
				'2-1' => array(  6,  6, 12, 12 ),
				'2-2' => array(  4,  8, 12, 12 ),
				'2-3' => array(  8,  4, 12, 12 ),
				'3-1' => array(  4,  4,  4, 12 ),
				'3-2' => array(  6,  3,  3, 12 ),
				'3-3' => array(  3,  6,  3, 12 ),
				'3-4' => array(  3,  3,  6, 12 ),
				'4-1' => array(  3,  3,  3,  3 ),
				);
	if ( isset( $structure[ $footers ] ) )
		return $structure[ $footers ];
	else
		return array( 12, 12, 12, 12 );
}
endif;

/**
 * Get footer column option.
 *
 * @since 1.0
 * @access public
 * @return int
 */
function dollah_get_footer_columns() {
	$footers = dollah_get_mod( 'footer' );
	$columns = ( $footers ) ? intval( substr( $footers, 0, 1 ) ) : false;
	$columns = ( is_numeric( $columns ) && 0 < $columns ) ? $columns : false;
	return $columns;
}

/**
 * Utility function to map 2 column widths to CSS span architecture.
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'dollah_col_width_to_span' ) ):
function dollah_col_width_to_span( $col_width ) {
	$return = array();
	switch( $col_width ):
		case '100':
			$return[0] = 'hgrid-span-12';
			break;
		case '50-50': default:
			$return[0] = 'hgrid-span-6';
			$return[1] = 'hgrid-span-6';
			break;
		case '33-66':
			$return[0] = 'hgrid-span-4';
			$return[1] = 'hgrid-span-8';
			break;
		case '66-33':
			$return[0] = 'hgrid-span-8';
			$return[1] = 'hgrid-span-4';
			break;
		case '25-75':
			$return[0] = 'hgrid-span-3';
			$return[1] = 'hgrid-span-9';
			break;
		case '75-25':
			$return[0] = 'hgrid-span-9';
			$return[1] = 'hgrid-span-3';
			break;
		case '33-33-33':
			$return[0] = 'hgrid-span-4';
			$return[1] = 'hgrid-span-4';
			$return[2] = 'hgrid-span-4';
			break;
		case '25-25-50':
			$return[0] = 'hgrid-span-3';
			$return[1] = 'hgrid-span-3';
			$return[2] = 'hgrid-span-6';
			break;
		case '25-50-25':
			$return[0] = 'hgrid-span-3';
			$return[1] = 'hgrid-span-6';
			$return[2] = 'hgrid-span-3';
			break;
		case '50-25-25':
			$return[0] = 'hgrid-span-6';
			$return[1] = 'hgrid-span-3';
			$return[2] = 'hgrid-span-3';
			break;
		case '25-25-25-25':
			$return[0] = 'hgrid-span-3';
			$return[1] = 'hgrid-span-3';
			$return[2] = 'hgrid-span-3';
			$return[3] = 'hgrid-span-3';
			break;
	endswitch;
	return $return;
}
endif;

/**
 * Wrapper function for dollah_main_layout() to get the class names for current context.
 * Can only be used after 'posts_selection' action hook i.e. in 'wp' hook or later.
 *
 * @since 1.0
 * @access public
 * @param string $context content|primary-sidebar|sidebar|sidebar-primary
 * @return string
 */
if ( !function_exists( 'dollah_main_layout_class' ) ):
function dollah_main_layout_class( $context ) {
	return dollah_main_layout( $context, 'class' );
}
endif;

/**
 * Utility function to return layout size or classes for the context.
 * Can only be used after 'posts_selection' action hook i.e. in 'wp' hook or later.
 *
 * @since 1.0
 * @access public
 * @param string $context content|primary-sidebar|sidebar|sidebar-primary
 * @param string $return class|size return class name or just the span size integer
 * @return string
 */
if ( !function_exists( 'dollah_main_layout' ) ):
function dollah_main_layout( $context, $return = 'size' ) {

	// Set layout
	global $dollah_theme;
	if ( !isset( $dollah_theme->currentlayout ) )
		dollah_set_main_layout();

	$span_sidebar = $dollah_theme->currentlayout['sidebar'];
	$span_content = $dollah_theme->currentlayout['content'];
	$layout_class = ' layout-' . $dollah_theme->currentlayout['layout'];

	// Return Class or Span Size for the Content/Sidebar
	if ( $context == 'content' ) {

		if ( $return == 'class' ) {
			$extra_class = ( empty( $span_sidebar ) ) ? ' no-sidebar' : ' has-sidebar';
			return ' hgrid-span-' . $span_content . $extra_class . $layout_class . ' ';
		} elseif ( $return == 'size' ) {
			return intval( $span_content );
		}

	} elseif ( $context == 'sidebar' ||  $context == 'sidebar-primary' || $context == 'primary-sidebar' || $context == 'secondary-sidebar' || $context == 'sidebar-secondary' ) {

		if ( $return == 'class' ) {
			if ( !empty( $span_sidebar ) )
				return ' hgrid-span-' . $span_sidebar . $layout_class . ' ';
			else
				return '';
		} elseif ( $return == 'size' ) {
			return intval( $span_sidebar );
		}

	}

	return '';

}
endif;

/**
 * Utility function to calculate and set main (content+aside) layout according to the sidebar layout
 * set by user for the current view.
 * Can only be used after 'posts_selection' action hook i.e. in 'wp' hook or later.
 *
 * @since 1.0
 * @access public
 */
if ( !function_exists( 'dollah_set_main_layout' ) ):
function dollah_set_main_layout() {

	// Apply full width for front page
	if ( is_front_page() && !is_home() ) {
		$sidebar = 'full-width';
	}
	// Apply Sidebar Layout for Posts
	elseif ( is_singular( 'post' ) ) {
		$sidebar = dollah_get_mod( 'sidebar_posts' );
	}
	// Check for attachment before page (to handle images attached to a page - true for is_page and is_attachment)
	// Apply 'Full Width'
	elseif ( is_attachment() ) {
		$sidebar = 'none';
	}
	elseif ( is_page() ) {
		if ( hybridextend_is_404() )
			// Apply 'Full Width' if this page is being displayed as a custom 404 page
			$sidebar = 'none';
		else
			// Apply Sidebar Layout for Pages
			$sidebar = dollah_get_mod( 'sidebar_pages' );
	}
	// Apply Sidebar Layout for Site
	else {
		$sidebar = dollah_get_mod( 'sidebar' );
	}

	// Allow for custom manipulation of the layout by child themes
	$sidebar = esc_attr( apply_filters( 'dollah_main_layout', $sidebar ) );

	// Save the layout for current view
	dollah_set_current_layout( $sidebar );

}
endif;

/**
 * Utility function to calculate and set main (content+aside) layout according to the sidebar layout
 * set by user for the current view.
 * Can only be used after 'posts_selection' action hook i.e. in 'wp' hook or later.
 *
 * @since 1.0
 * @access public
 */
if ( !function_exists( 'dollah_set_current_layout' ) ):
function dollah_set_current_layout( $sidebar ) {
	$spans = apply_filters( 'dollah_main_layout_spans', array(
		'none' => array(
			'content' => 9,
			'sidebar' => 0,
		),
		'full' => array(
			'content' => 12,
			'sidebar' => 0,
		),
		'full-width' => array(
			'content' => 12,
			'sidebar' => 0,
		),
		'narrow-right' => array(
			'content' => 9,
			'sidebar' => 3,
		),
		'wide-right' => array(
			'content' => 8,
			'sidebar' => 4,
		),
		'narrow-left' => array(
			'content' => 9,
			'sidebar' => 3,
		),
		'wide-left' => array(
			'content' => 8,
			'sidebar' => 4,
		),
		'narrow-left-left' => array(
			'content' => 6,
			'sidebar' => 3,
		),
		'narrow-left-right' => array(
			'content' => 6,
			'sidebar' => 3,
		),
		'narrow-right-left' => array(
			'content' => 6,
			'sidebar' => 3,
		),
		'narrow-right-right' => array(
			'content' => 6,
			'sidebar' => 3,
		),
		'default' => array(
			'content' => 8,
			'sidebar' => 4,
		),
	) );

	/* Set the layout for current view */
	global $dollah_theme;
	$dollah_theme->currentlayout['layout'] = $sidebar;
	if ( isset( $spans[ $sidebar ] ) ) {
		$dollah_theme->currentlayout['content'] = $spans[ $sidebar ]['content'];
		$dollah_theme->currentlayout['sidebar'] = $spans[ $sidebar ]['sidebar'];
	} else {
		$dollah_theme->currentlayout['content'] = $spans['default']['content'];
		$dollah_theme->currentlayout['sidebar'] = $spans['default']['sidebar'];
	}

}
endif;

/**
 * Utility function to determine the location of page header
 *
 * @since 1.0
 * @access public
 */
if ( !function_exists( 'dollah_page_header_attop' ) ):
function dollah_page_header_attop() {

	$full = array_map( 'trim', explode( ',', dollah_get_mod( 'page_header_full' ) ) );

	/* Override For Full Width Pages (including 404 page) */
	if ( in_array( 'no-sidebar', $full ) ) {
		$sidebar_size = dollah_main_layout( 'primary-sidebar' );
		if ( empty( $sidebar_size ) || hybridextend_is_404() )
			return apply_filters( 'dollah_page_header_attop', true, 'no-sidebar', $full );
	}

	/* For Posts */
	if ( is_singular( 'post' ) ) {
		if ( in_array( 'posts', $full ) )
			return apply_filters( 'dollah_page_header_attop', true, 'posts', $full );
		else
			return apply_filters( 'dollah_page_header_attop', false, 'posts', $full );
	}

	/* For Pages */
	if ( is_page() ) {
		if ( in_array( 'pages', $full ) )
			return apply_filters( 'dollah_page_header_attop', true, 'pages', $full );
		else
			return apply_filters( 'dollah_page_header_attop', false, 'pages', $full );
	}

	/* Default */
	if ( in_array( 'default', $full ) )
		return apply_filters( 'dollah_page_header_attop', true, 'default', $full );
	else
		return apply_filters( 'dollah_page_header_attop', false, 'default', $full );

}
endif;

/**
 * Utility function to create slider slides array for lite version
 *
 * @since 1.0
 * @access public
 */
if ( !function_exists( 'dollah_get_lite_slider' ) ):
function dollah_get_lite_slider( $type ) {
	$slides = $data = array();
	switch ( $type ) {

		case 'html':
			for ( $i = 1; $i <= 4;  $i++ ) {
				$id = intval( dollah_get_mod( "wt_html_slide_{$i}-content" ) );
				if ( !empty( $id ) ) {
					$postobj = get_post( $id );
					$size = hybridextend_get_image_size_name('span-6');
					$data[$i]['title'] = ( !empty( $postobj->post_title ) ) ? $postobj->post_title : '';
					$data[$i]['content'] = ( !empty( $postobj->post_content ) ) ? apply_filters( 'the_content', $postobj->post_content ) : '';
					if ( has_post_thumbnail ( $id ) ) {
						$isrc = wp_get_attachment_image_src( get_post_thumbnail_id($id), $size );
						if( empty( $isrc ) ) $isrc = wp_get_attachment_image_src( get_post_thumbnail_id($id), $size, true );
						$data[$i]['image'] = $isrc[0];
					} else $data[$i]['image'] = '';
				}
			}
			for ( $i = 1; $i <= 4;  $i++ ) {
				if ( !empty( $data[$i] ) ) {
					$slides[ $i ]['image'] = esc_url( $data[$i]['image'] );
					$slides[ $i ]['content'] = '<h4>' . esc_html( $data[$i]['title'] ) . '</h4>' . $data[$i]['content'];
					// $slides[ $i ]['image'] = dollah_get_mod( "wt_html_slide_{$i}-image" );
					// $slides[ $i ]['content'] = dollah_get_mod( "wt_html_slide_{$i}-content" );
					$slides[ $i ]['content_bg'] = dollah_get_mod( "wt_html_slide_{$i}-content_bg" );
					$slides[ $i ]['button'] = dollah_get_mod( "wt_html_slide_{$i}-button" );
					$slides[ $i ]['url'] = dollah_get_mod( "wt_html_slide_{$i}-url" );
					$slides[ $i ]['background']['color'] = dollah_get_mod( "wt_html_slide_{$i}-background-color" );
					$slides[ $i ]['background']['type'] = dollah_get_mod( "wt_html_slide_{$i}-background-type" );
					$slides[ $i ]['background']['pattern'] = dollah_get_mod( "wt_html_slide_{$i}-background-pattern" );
					$slides[ $i ]['background']['image'] = dollah_get_mod( "wt_html_slide_{$i}-background-image" );
					// $slides[ $i ]['background']['repeat'] = dollah_get_mod( "wt_html_slide_{$i}-background-repeat" );
					// $slides[ $i ]['background']['position'] = dollah_get_mod( "wt_html_slide_{$i}-background-position" );
					// $slides[ $i ]['background']['attachment'] = dollah_get_mod( "wt_html_slide_{$i}-background-attachment" );
				}
			}
			break;

		case 'image':
		case 'img':
			for ( $i = 1; $i <= 4;  $i++ ) { 
				$slides[ $i ]['image'] = dollah_get_mod( "wt_img_slide_{$i}-image" );
				$slides[ $i ]['caption'] = dollah_get_mod( "wt_img_slide_{$i}-caption" );
				$slides[ $i ]['caption_bg'] = dollah_get_mod( "wt_img_slide_{$i}-caption_bg" );
				$slides[ $i ]['url'] = dollah_get_mod( "wt_img_slide_{$i}-url" );
				$slides[ $i ]['button'] = dollah_get_mod( "wt_img_slide_{$i}-button" );
			}
			break;

	}
	return apply_filters( 'dollah_get_lite_slider_slides', $slides, $data );
}
endif;

/**
 * Display function to render posts for Jetpack's infinite scroll module
 *
 * @since 1.0
 * @access public
 */
if ( !function_exists( 'dollah_jetpack_infinitescroll_render' ) ):
function dollah_jetpack_infinitescroll_render(){
	while ( have_posts() ) : the_post();
		// Loads the template-parts/content-{$post_type}.php template.
		hybridextend_get_content_template();
	endwhile;
}
endif;

/**
 * Hide title area on static frontpage (not using Widgetized Template)
 * @todo: Redundant
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'dollah_hide_loop_meta_static_frontpage' ) ) :
function dollah_hide_loop_meta_static_frontpage( $display ) {
	if ( is_front_page() )
		return 'hide';
	else
		return $display;
}
endif;
add_filter( 'dollah_loop_meta_display_title', 'dollah_hide_loop_meta_static_frontpage' );

/**
 * Define archive type selected in options
 *
 * @since 1.0
 * @param string $archive_type
 * @param string $context
 * @return string
 */
function dollah_default_archive_type( $archive_type, $context = '' ) {
	$archive_type = dollah_get_mod( 'archive_type' );
	return $archive_type;
}
add_filter( 'dollah_default_archive_type', 'dollah_default_archive_type', 5, 2 );

/**
 * Return Skype contact button code
 * Ref: https://www.skype.com/en/developer/create-contactme-buttons/
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'dollah_get_skype_button_code' ) ) :
function dollah_get_skype_button_code( $username ) {
	static $script = false;
	static $id = 1;
	$code = '';
	$action = apply_filters( 'dollah_skype_button_action', 'call' );

	if ( !$script )
		$code .= '<script type="text/javascript"' .
				 ' src="' . esc_url('https://secure.skypeassets.com/i/scom/js/skype-uri.js') . '"'.
				 '></script>';

	$code .= '<div id="SkypeButton_Call_' . $username . '_' . $id . '" class="dollah-skype-call-button">';
	$code .= '<script type="text/javascript">';
	$code .=  'Skype.ui({'
			. '"name": "' . $action . '",' // dropdown (doesnt work well), call, chat
			. '"element": "SkypeButton_Call_' . $username . '_' . $id . '",'
			. '"participants": ["' . $username . '"],'
			//. '"imageColor": "white",' // omit for blue
			. '"imageSize": 24' // 10, 12, 14, 16 (omit), 24, 32
			. '});';
	$code .= '</script>';
	$code .= '</div>';

	$code = apply_filters( 'dollah_get_skype_button_code', $code, $script, $id, $action );
	$script = true;
	$id++;
	return $code;
}
endif;