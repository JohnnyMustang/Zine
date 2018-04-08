<?php
/**
 * Defines customizer options
 *
 * This file is loaded at 'after_setup_theme' hook with 10 priority.
 *
 * @package    Hoot
 * @subpackage Dollah
 */

/**
 * Build the Customizer options (panels, sections, settings)
 *
 * Always remember to mention specific priority for non-static options like:
 *     - options being added based on a condition (eg: if woocommerce is active)
 *     - options which may get removed (eg: logo_size, headings_fontface)
 *     - options which may get rearranged (eg: logo_background_type)
 *     This will allow other options inserted with priority to be inserted at
 *     their intended place.
 *
 * @since 1.0
 * @access public
 * @return array
 */
if ( !function_exists( 'dollah_theme_customizer_options' ) ) :
function dollah_theme_customizer_options() {

	// Stores all the settings to be added
	$settings = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Theme default colors and fonts
	extract( apply_filters( 'dollah_theme_options_defaults', array(
		'accent_color'         => '#f54423',
		'accent_font'          => '#ffffff',
		'box_background'       => '#ffffff',
		'site_background'      => '#ffffff',
		// 'site_background_patt' => 'hybrid/extend/images/patterns/4.png',
	) ) );

	// Directory path for radioimage buttons
	$imagepath =  HYBRIDEXTEND_INCURI . 'admin/images/';

	// Logo Sizes (different range than standard typography range)
	$logosizes = array();
	$logosizerange = range( 14, 110 );
	foreach ( $logosizerange as $isr )
		$logosizes[ $isr . 'px' ] = $isr . 'px';
	$logosizes = apply_filters( 'dollah_theme_options_logosizes', $logosizes);

	// Logo Font Options for Lite version
	$logofont = apply_filters( 'dollah_theme_options_logofont', array(
					'heading' => __("Logo Font (set in 'Typography' section)", 'dollah'),
					'standard' => __('Standard Body Font', 'dollah'),
					) );

	/*** Add Options (Panels, Sections, Settings) ***/

	/** Section **/

	$section = 'links';

	$sections[ $section ] = array(
		'title'       => __( 'Demo / Support', 'dollah' ),
		'priority'    => '2',
	);

	$lcontent = '';
	$lcontent .= '<a class="dollah-cust-link" href="' .
				 'https://demo.wphoot.com/dollah/' .
				 '" target="_blank"><span class="dollah-cust-link-head">' .
				 '<i class="fa fa-eye"></i> ' .
				 __( "Demo", 'dollah') . 
				 '</span><span class="dollah-cust-link-desc">' .
				 __( "Demo the theme features and options with sample content.", 'dollah') .
				 '</span></a>';
	$lcontent .= '<a class="dollah-cust-link" href="' .
				 'https://wphoot.com/support/' .
				 '" target="_blank"><span class="dollah-cust-link-head">' .
				 '<i class="fa fa-support"></i> ' .
				 __( "Documentation / Support", 'dollah') . 
				 '</span><span class="dollah-cust-link-desc">' .
				 __( "Get theme related support for both free and premium users.", 'dollah') .
				 '</span></a>';
	$lcontent .= '<a class="dollah-cust-link" href="' .
				 'https://wordpress.org/support/view/theme-reviews/dollah#postform' .
				 '" target="_blank"><span class="dollah-cust-link-head">' .
				 '5 <i class="fa fa-star"></i> ' .
				 __( "Rate Us", 'dollah') . 
				 '</span><span class="dollah-cust-link-desc">' .
				 __( "If you are happy with the theme, give us a 5 star rating on wordpress.org", 'dollah') .
				 '</span></a>';

	$settings['linksection'] = array(
		// 'label'       => __( 'Misc Links', 'dollah' ),
		'section'     => $section,
		'type'        => 'content',
		'priority'    => '8', // Non static options must have a priority
		'content'     => $lcontent,
	);

	/** Section **/

	$section = 'title_tagline';

	$sections[ $section ] = array(
		'title'       => __( 'Setup &amp; Layout', 'dollah' ),
	);

	$settings['site_layout'] = array(
		'label'       => __( 'Site Layout - Boxed vs Stretched', 'dollah' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'boxed'   => __('Boxed layout', 'dollah'),
			'stretch' => __('Stretched layout (full width)', 'dollah'),
		),
		'default'     => 'stretch',
		// 'description' => __("For boxed layouts, both backgrounds (site and content box) can be set in the Backgrounds' section.<br />For Stretched Layout, only site background is available.", 'dollah'),
	);

	$settings['site_width'] = array(
		'label'       => __( 'Max. Site Width (pixels)', 'dollah' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'1380' => __('1380px (wide)', 'dollah'),
			'1260' => __('1260px (normal)', 'dollah'),
			'1080' => __('1080px (compact)', 'dollah'),
		),
		'default'     => '1380',
	);

	$settings['load_minified'] = array(
		'label'       => __( 'Load Minified Styles and Scripts (when available)', 'dollah' ),
		'sublabel'    => __( 'Checking this option reduces data size, hence increasing page load speed.', 'dollah' ),
		'section'     => $section,
		'type'        => 'checkbox',
		// 'default'     => 1,
	);

	$settings['sidebar_desc'] = array(
		'label'       => __( 'Multiple Sidebars', 'dollah' ),
		'section'     => $section,
		'type'        => 'content',
		'content'     => sprintf( __( 'This theme can display different sidebar content on different pages of your site with the %1$1sCustom Sidebars%2$2s plugin. Simply install and activate the plugin to use it with this theme. Or if you are using %3$3sJetpack%4$4s, you can use the %5$5s"Widget Visibility"%6$6s module.', 'dollah' ), '<a href="https://wordpress.org/plugins/custom-sidebars/screenshots/" target="_blank">', '</a>', '<a href="https://wordpress.org/plugins/jetpack/" target="_blank">', '</a>', '<a href="https://jetpack.com/support/widget-visibility/" target="_blank">', '</a>' ),
	);

	$settings['sidebar'] = array(
		'label'       => __( 'Sidebar Layout (Site-wide)', 'dollah' ),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'wide-right'         => $imagepath . 'sidebar-wide-right.png',
			'narrow-right'       => $imagepath . 'sidebar-narrow-right.png',
			'wide-left'          => $imagepath . 'sidebar-wide-left.png',
			'narrow-left'        => $imagepath . 'sidebar-narrow-left.png',
			'narrow-left-right'  => $imagepath . 'sidebar-narrow-left-right.png',
			'narrow-left-left'   => $imagepath . 'sidebar-narrow-left-left.png',
			'narrow-right-right' => $imagepath . 'sidebar-narrow-right-right.png',
			'full-width'         => $imagepath . 'sidebar-full.png',
			'none'               => $imagepath . 'sidebar-none.png',
		),
		'default'     => 'wide-right',
		'description' => __("Set the default sidebar width and position for your site.", 'dollah'),
	);

	$settings['sidebar_pages'] = array(
		'label'       => __( 'Sidebar Layout (for Pages)', 'dollah' ),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'wide-right'         => $imagepath . 'sidebar-wide-right.png',
			'narrow-right'       => $imagepath . 'sidebar-narrow-right.png',
			'wide-left'          => $imagepath . 'sidebar-wide-left.png',
			'narrow-left'        => $imagepath . 'sidebar-narrow-left.png',
			'narrow-left-right'  => $imagepath . 'sidebar-narrow-left-right.png',
			'narrow-left-left'   => $imagepath . 'sidebar-narrow-left-left.png',
			'narrow-right-right' => $imagepath . 'sidebar-narrow-right-right.png',
			'full-width'         => $imagepath . 'sidebar-full.png',
			'none'               => $imagepath . 'sidebar-none.png',
		),
		'default'     => 'wide-right',
	);

	$settings['sidebar_posts'] = array(
		'label'       => __( 'Sidebar Layout (for single Posts)', 'dollah' ),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'wide-right'         => $imagepath . 'sidebar-wide-right.png',
			'narrow-right'       => $imagepath . 'sidebar-narrow-right.png',
			'wide-left'          => $imagepath . 'sidebar-wide-left.png',
			'narrow-left'        => $imagepath . 'sidebar-narrow-left.png',
			'narrow-left-right'  => $imagepath . 'sidebar-narrow-left-right.png',
			'narrow-left-left'   => $imagepath . 'sidebar-narrow-left-left.png',
			'narrow-right-right' => $imagepath . 'sidebar-narrow-right-right.png',
			'full-width'         => $imagepath . 'sidebar-full.png',
			'none'               => $imagepath . 'sidebar-none.png',
		),
		'default'     => 'wide-right',
	);

	/** Section **/

	$section = 'header';

	$sections[ $section ] = array(
		'title'       => __( 'Header', 'dollah' ),
	);

	$settings['primary_menuarea'] = array(
		'label'       => __( 'Header Area (right of logo)', 'dollah' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			// 'menu'        => __('Display Menu', 'dollah'),
			'search'      => __('Search / Social Icons', 'dollah'),
			// 'custom'      => __('Custom Text', 'dollah'),
			'widget-area' => __("'Header Side' widget area (Logo will get left aligned)", 'dollah'),
			'none'        => __('None', 'dollah'),
		),
		'default'     => 'none',
	);

	$searchicons = array(
		'search' => array(
			'label' => __( 'Show Search', 'dollah' ),
			'section'     => $section,
			'type'        => 'checkbox',
			'default'     => 1,
		)
	);
	$sictotal = apply_filters( 'dollah_headeroptions_socialicons', 5 );
	for ( $sic=1; $sic <= $sictotal; $sic++ ) {
		$searchicons['icon' . $sic] = array(
			'label'       => sprintf( __( 'Social Icon %1$s', 'dollah' ), $sic ),
			'section'     => $section,
			'type'        => 'select',
			'choices'     => hybridextend_enum_social_profiles(),
		);
		$searchicons['url' . $sic] = array(
			'label'       => sprintf( __( 'URL %1$s', 'dollah' ), $sic ),
			'type'        => 'url',
			'input_attrs' => array(
				'placeholder' => 'http://',
			),
		);
	}
	$settings['primary_header'] = array(
		'label'           => __( 'Header Search / Social Icons', 'dollah' ),
		'section'         => $section,
		'type'            => 'group',
		'button'          => __( 'Edit Icons', 'dollah' ),
		'options'         => $searchicons,
		// 'active_callback' => 'dollah_callback_show_primary_menuarea_search',
	);

	$settings['secondary_menu_location'] = array(
		'label'       => __( 'Full Width Menu Area (location)', 'dollah' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'top'        => __('Top (above logo)', 'dollah'),
			'bottom'     => __('Bottom (below logo)', 'dollah'),
			// 'none'       => __("Do not display full width menu (useful if you already have 'menu' selected in 'Header Area' above')", 'dollah'),
		),
		'default'     => 'top',
	);

	$settings['secondary_menu_align'] = array(
		'label'       => __( 'Full Width Menu Area (alignment)', 'dollah' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'left'      => __('Left', 'dollah'),
			'right'     => __('Right', 'dollah'),
			'center'    => __('Center', 'dollah'),
		),
		'default'     => 'center',
		// 'description' => __( "Menu will always be left aligned if there are widgets in the 'Menu Side' widget area", 'dollah' ),
	);

	$settings['disable_table_menu'] = array(
		'label'       => __( 'Disable Table Menu', 'dollah' ),
		'section'     => $section,
		'type'        => 'checkbox',
		// 'default'     => 1,
		'description' => "<img src='{$imagepath}menu-table.png'><br/>" . __( 'Disable Table Menu if you have a lot of Top Level menu items, <strong>and dont have menu item descriptions.</strong>', 'dollah' ),
	);

	$settings['mobile_menu'] = array(
		'label'       => __( 'Mobile Menu', 'dollah' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'inline' => __('Inline - Menu Slide Downs to open', 'dollah'),
			'fixed'  => __('Fixed - Menu opens on the left', 'dollah'),
		),
		'default'     => 'fixed',
	);

	$settings['mobile_submenu_click'] = array(
		'label'       => __( "[Mobile Menu] Submenu opens on 'Click'", 'dollah' ),
		'section'     => $section,
		'type'        => 'checkbox',
		'default'     => 1,
		'description' => __( "Uncheck this option to make all Submenus appear in 'Open' state. By default, submenus open on clicking (i.e. single tap on mobile).", 'dollah' ),
	);

	/** Section **/

	$section = 'logo';

	$sections[ $section ] = array(
		'title'       => __( 'Logo', 'dollah' ),
	);

	$settings['logo_background_type'] = array(
		'label'       => __( 'Logo Background', 'dollah' ),
		'section'     => $section,
		'type'        => 'radio',
		'priority'    => '265', // Non static options must have a priority
		'choices'     => array(
			'transparent' => __('None', 'dollah'),
			'accent'      => __('Accent Color', 'dollah'),
		),
		'default'     => 'transparent',
	);

	$settings['logo'] = array(
		'label'       => __( 'Site Logo', 'dollah' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'text'        => __('Default Text (Site Title)', 'dollah'),
			'custom'      => __('Custom Text', 'dollah'),
			'image'       => __('Image Logo', 'dollah'),
			'mixed'       => __('Image &amp; Default Text (Site Title)', 'dollah'),
			'mixedcustom' => __('Image &amp; Custom Text', 'dollah'),
		),
		'default'     => 'text',
		'description' => sprintf( __('Use %1$sSite Title%2$s as default text logo', 'dollah'), '<a href="' . esc_url( admin_url('options-general.php') ) . '" target="_blank">', '</a>' ),
	);

	$settings['logo_size'] = array(
		'label'       => __( 'Logo Text Size', 'dollah' ),
		'section'     => $section,
		'type'        => 'select',
		'priority'    => '275', // Non static options must have a priority
		'choices'     => array(
			'tiny'   => __( 'Tiny', 'dollah'),
			'small'  => __( 'Small', 'dollah'),
			'medium' => __( 'Medium', 'dollah'),
			'large'  => __( 'Large', 'dollah'),
			'huge'   => __( 'Huge', 'dollah'),
		),
		'default'     => 'medium',
		'active_callback' => 'dollah_callback_logo_size',
	);

	$settings['site_title_icon'] = array(
		'label'           => __( 'Site Title Icon (Optional)', 'dollah' ),
		'section'         => $section,
		'type'            => 'icon',
		// 'default'         => 'fa-anchor',
		'description'     => __( 'Leave empty to hide icon.', 'dollah' ),
		'active_callback' => 'dollah_callback_site_title_icon',
	);

	$settings['site_title_icon_size'] = array(
		'label'           => __( 'Site Title Icon Size', 'dollah' ),
		'section'         => $section,
		'type'            => 'select',
		'choices'         => $logosizes,
		'default'         => '50px',
		'active_callback' => 'dollah_callback_site_title_icon',
	);

	if ( ! function_exists( 'the_custom_logo' ) )
	$settings['logo_image'] = array(
		'label'           => __( 'Upload Logo', 'dollah' ),
		'section'         => $section,
		'type'            => 'image',
		'priority'        => '295', // Replaced by WP's custom_logo if available // Update in premium if needed
		'active_callback' => 'dollah_callback_logo_image',
	);

	$settings['logo_image_width'] = array(
		'label'           => __( 'Maximum Logo Width', 'dollah' ),
		'section'         => $section,
		'type'            => 'text',
		'priority'        => '296', // Keep it with image logo // Update in premium if needed
		'default'         => 200,
		'description'     => __( '(in pixels)<hr>The logo width may be automatically adjusted by the browser depending on title length and space available.', 'dollah' ),
		'input_attrs'     => array(
			'min'         => 0,
			'max'         => 3,
			'placeholder' => __( '(in pixels)', 'dollah' ),
		),
		'active_callback' => 'dollah_callback_logo_image_width',
	);

	$logo_custom_line_options = array(
		'text' => array(
			'label'       => __( 'Line Text', 'dollah' ),
			'type'        => 'text',
		),
		'size' => array(
			'label'       => __( 'Line Size', 'dollah' ),
			'type'        => 'select',
			'choices'     => $logosizes,
			'default'     => '24px',
		),
		'font' => array(
			'label'       => __( 'Line Font', 'dollah' ),
			'type'        => 'select',
			'choices'     => $logofont,
			'default'     => 'heading',
		),
	);

	$settings['logo_custom'] = array(
		'label'           => __( 'Custom Logo Text', 'dollah' ),
		'section'         => $section,
		'type'            => 'sortlist',
		'description'     => __( "Use &lt;em&gt; tag in 'Line Text' to emphasize a word. Example: <code>D&lt;em&gt;O&lt;/em&gt;LLAH</code>", 'dollah' ),
		'choices'         => array(
			'line1' => __('Line 1', 'dollah'),
			'line2' => __('Line 2', 'dollah'),
			'line3' => __('Line 3', 'dollah'),
			'line4' => __('Line 4', 'dollah'),
		),
		'options'         => array(
			'line1' => $logo_custom_line_options,
			'line2' => $logo_custom_line_options,
			'line3' => $logo_custom_line_options,
			'line4' => $logo_custom_line_options,
		),
		'attributes'      => array(
			'inactive' => array( 'line3', 'line4' ),
			'hideable' => true,
			'sortable' => false,
		),
		'active_callback' => 'dollah_callback_logo_custom',
	);

	$settings['show_tagline'] = array(
		'label'           => __( 'Show Tagline', 'dollah' ),
		'sublabel'        => __( 'Display site description as tagline below logo.', 'dollah' ),
		'section'         => $section,
		'type'            => 'checkbox',
		'default'         => 1,
		// 'active_callback' => 'dollah_callback_show_tagline',
	);

	/** Section **/

	$section = 'colors';

	// Redundant as 'colors' section is added by WP. But we still add it for brevity
	$sections[ $section ] = array(
		'title'       => __( 'Colors', 'dollah' ),
		'description' => __('Control various color options in the premium version for fonts, backgrounds, contrast, highlight, accent etc.', 'dollah'),
	);

	$settings['accent_color'] = array(
		'label'       => __( 'Accent Color', 'dollah' ),
		'section'     => $section,
		'type'        => 'color',
		'default'     => $accent_color,
	);

	$settings['accent_font'] = array(
		'label'       => __( 'Font Color on Accent Color', 'dollah' ),
		'section'     => $section,
		'type'        => 'color',
		'default'     => $accent_font,
	);

	if ( current_theme_supports( 'woocommerce' ) ) :
		$settings['woocommerce-colors-plugin'] = array(
			'label'       => __( 'Woocommerce Styling', 'dollah' ),
			'section'     => $section,
			'type'        => 'content',
			'priority'    => '335', // Non static options must have a priority
			'content'     => sprintf( __('Looks like you are using Woocommerce. Install %1$sthis plugin%2$s to change colors and styles for WooCommerce elements like buttons etc.', 'dollah'), '<a href="https://wordpress.org/plugins/woocommerce-colors/" target="_blank">', '</a>' ),
		);
	endif;

	/** Section **/

	$section = 'backgrounds';

	$sections[ $section ] = array(
		'title'       => __( 'Backgrounds', 'dollah' ),
		'description' => __('The premium version comes with background options for different sections of your site like header, menu dropdown, content area, logo background, footer etc.', 'dollah'),
	);

	$settings['background'] = array(
		'label'       => __( 'Site Background', 'dollah' ),
		'section'     => $section,
		'type'        => 'betterbackground',
		'default'     => array(
			'color'      => $site_background,
			// 'pattern'    => $site_background_patt,
		),
	);

	$settings['box_background_color'] = array(
		'label'       => __( 'Content Box Background', 'dollah' ),
		'section'     => $section,
		'type'        => 'color',
		'default'     => $box_background,
		// 'description' => __("This background is available only when <strong>Site Layout</strong> option is set to <strong>'Boxed'</strong> in the <strong>'Setup &amp; Layout'</strong> section.", 'dollah'),
		// 'active_callback' => 'dollah_callback_box_background_color',
	);

	/** Section **/

	$section = 'typography';

	$sections[ $section ] = array(
		'title'       => __( 'Typography', 'dollah' ),
		'description' => __('The premium version offers complete typography control (color, style, size) for various headings, header, menu, footer, widgets, content sections etc (over 600 Google Fonts to chose from)', 'dollah'),
	);

	$settings['logo_fontface'] = array(
		'label'       => __( 'Logo Font (Free Version)', 'dollah' ),
		'section'     => $section,
		'type'        => 'select',
		'priority'    => 455, // Non static options must have a priority
		'choices'     => array(
			'standard' => __( 'Standard Font (Open Sans)', 'dollah'),
			'display'  => __( 'Display Font (Comfortaa)', 'dollah'),
			'heading'  => __( 'Heading Font (Roboto)', 'dollah'),
		),
		'default'     => 'display',
	);

	$settings['logo_fontface_style'] = array(
		'label'       => __( 'Logo Font Style', 'dollah' ),
		'section'     => $section,
		'type'        => 'select',
		'priority'    => 455, // Non static options must have a priority
		'choices'     => array(
			'standard'  => __( 'Standard', 'dollah'),
			'uppercase' => __( 'Uppercase', 'dollah'),
		),
		'default'     => 'standard',
	);

	$settings['headings_fontface'] = array(
		'label'       => __( 'Headings Font (Free Version)', 'dollah' ),
		'section'     => $section,
		'type'        => 'select',
		'priority'    => 455, // Non static options must have a priority
		'choices'     => array(
			'standard' => __( 'Standard Font (Open Sans)', 'dollah'),
			'display'  => __( 'Display Font (Comfortaa)', 'dollah'),
			'heading'  => __( 'Heading Font (Roboto)', 'dollah'),
		),
		'default'     => 'heading',
	);

	$settings['headings_fontface_style'] = array(
		'label'       => __( 'Heading Font Style', 'dollah' ),
		'section'     => $section,
		'type'        => 'select',
		'priority'    => 455, // Non static options must have a priority
		'choices'     => array(
			'standard'  => __( 'Default (theme style.css)', 'dollah'),
			'uppercase' => __( 'Uppercase', 'dollah'),
		),
		'default'     => 'uppercase',
	);

	/** Section **/

	$section = 'frontpage';

	$sections[ $section ] = array(
		'title'       => __( 'Frontpage - Modules', 'dollah' ),
	);

	$widget_area_options = array(
		'columns' => array(
			'label'   => __( 'Columns', 'dollah' ),
			'type'    => 'select',
			'choices' => array(
				'100'         => __('One Column [100]', 'dollah'),
				'50-50'       => __('Two Columns [50 50]', 'dollah'),
				'33-66'       => __('Two Columns [33 66]', 'dollah'),
				'66-33'       => __('Two Columns [66 33]', 'dollah'),
				'25-75'       => __('Two Columns [25 75]', 'dollah'),
				'75-25'       => __('Two Columns [75 25]', 'dollah'),
				'33-33-33'    => __('Three Columns [33 33 33]', 'dollah'),
				'25-25-50'    => __('Three Columns [25 25 50]', 'dollah'),
				'25-50-25'    => __('Three Columns [25 50 25]', 'dollah'),
				'50-25-25'    => __('Three Columns [50 25 25]', 'dollah'),
				'25-25-25-25' => __('Four Columns [25 25 25 25]', 'dollah'),
			),
		),
		'modulebg' => array(
			'label'       => '',
			'type'        => 'content',
			'content'     => '<div class="button">' . __( 'Module Background', 'dollah' ) . '</div>',
		),
	);

	$settings['frontpage_sections'] = array(
		'label'       => __( 'Frontpage Widget Areas', 'dollah' ),
		'sublabel'    => sprintf( __("<p></p><ul><li>Sort different sections of the Frontpage in the order you want them to appear.</li><li>You can add content to widget areas from the %1$1sWidgets Management screen%2$2s.</li><li>You can disable areas by clicking the 'eye' icon. (This will hide them on the Widgets screen as well)</li></ul>", 'dollah'), '<a href="' . esc_url( admin_url('widgets.php') ) . '" target="_blank">', '</a>' ),
		'section'     => $section,
		'type'        => 'sortlist',
		'choices'     => array(
			'slider_html' => __('HTML Slider', 'dollah'),
			'slider_img'  => __('Image Slider', 'dollah'),
			'area_a'      => __('Widget Area A', 'dollah'),
			'area_b'      => __('Widget Area B', 'dollah'),
			'area_c'      => __('Widget Area C', 'dollah'),
			'area_d'      => __('Widget Area D', 'dollah'),
			'area_e'      => __('Widget Area E', 'dollah'),
			'area_f'      => __('Widget Area F', 'dollah'),
			'content'     => __('Frontpage Content', 'dollah'),
		),
		'default'     => array(
			// 'content' => array( 'sortitem_hide' => 1, ),
			'area_b'  => array( 'columns' => '50-50' ),
		),
		'options'     => array(
			'slider_html' => array(
				'modulebg' => array(
					'label'       => '',
					'type'        => 'content',
					'content'     => '<div class="button">' . __( 'Module Background', 'dollah' ) . '</div>',
				),
			),
			'slider_img'  => array(
				'modulebg' => array(
					'label'       => '',
					'type'        => 'content',
					'content'     => '<div class="button">' . __( 'Module Background', 'dollah' ) . '</div>',
				),
			),
			'area_a'      => $widget_area_options,
			'area_b'      => $widget_area_options,
			'area_c'      => $widget_area_options,
			'area_d'      => $widget_area_options,
			'area_e'      => $widget_area_options,
			'area_f'      => $widget_area_options,
			'content'     => array(
							'title' => array(
								'label'       => __( 'Title (optional)', 'dollah' ),
								'type'        => 'text',
							),
							'modulebg' => array(
								'label'       => '',
								'type'        => 'content',
								'content'     => '<div class="button">' . __( 'Module Background', 'dollah' ) . '</div>',
							), ),
		),
		'attributes'  => array(
			'hideable'      => true,
			'sortable'      => true,
		),
		// 'description' => sprintf( __('You must first save the changes you make here and refresh this screen for widget areas to appear in the Widgets panel (in customizer). Once you save the settings, you can add content to these widget areas using the %sWidgets Management screen%s.', 'dollah'), '<a href="' . esc_url( admin_url('widgets.php') ) . '" target="_blank">', '</a>' ),
	);

	$settings['frontpage_content_desc'] = array(
		'label'       => __( "Frontpage Content", 'dollah' ),
		'section'     => $section,
		'type'        => 'content',
		'content'     => sprintf( __( "The 'Frontpage Content' module in above list will show<ul style='list-style:disc;margin:1em 0 0 2em;'><li>the <strong>'Blog'</strong> if you have <strong>Your Latest Posts</strong> selectd in %1$1sReading Settings%2$2s</li><li>the <strong>Page Content</strong> of the page set as Front page if you have <strong>A static page</strong> selected in %3$3sReading Settings%4$4s</li></ul>", 'dollah' ), '<a href="' . esc_url( admin_url('options-reading.php') ) . '" target="_blank">', '</a>', '<a href="' . esc_url( admin_url('options-reading.php') ) . '" target="_blank">', '</a>' ),
	);

	$settings["frontpage_sectionbg_slider_html"] =
	$settings["frontpage_sectionbg_slider_img"] = array(
		'label'       => '',
		'section'     => $section,
		'type'        => 'group',
		'button'      => __( 'Module Background', 'dollah' ),
		'options'     => array(
			'description' => array(
				'label'       => '',
				'type'        => 'content',
				'content'     => '<span class="dollah-module-bg-title">' . __('Slider Background', 'dollah') . '</span>',
			),
			'type' => array(
				'label'   => __( 'Background Type', 'dollah' ),
				'type'    => 'radio',
				'choices' => array(
					'none'        => __('None', 'dollah'),
					'highlight'   => __('Highlight Color', 'dollah'),
					'accent'      => __('Accent Color', 'dollah'),
				),
				'default' => 'none',
			),
		),
	);

	$frontpagemodule_bg = array(
		'area_a'      => __('Widget Area A', 'dollah'),
		'area_b'      => __('Widget Area B', 'dollah'),
		'area_c'      => __('Widget Area C', 'dollah'),
		'area_d'      => __('Widget Area D', 'dollah'),
		'area_e'      => __('Widget Area E', 'dollah'),
		'area_f'      => __('Widget Area F', 'dollah'),
		'content'     => __('Frontpage Content', 'dollah'),
		);

	foreach ( $frontpagemodule_bg as $fpgmodid => $fpgmodname ) {

		$settings["frontpage_sectionbg_{$fpgmodid}"] = array(
			'label'       => '',
			'section'     => $section,
			'type'        => 'group',
			'button'      => __( 'Module Background', 'dollah' ),
			'options'     => array(
				'description' => array(
					'label'       => '',
					'type'        => 'content',
					'content'     => '<span class="dollah-module-bg-title">' . $fpgmodname . '</span>',
				),
				'type' => array(
					'label'   => __( 'Background Type', 'dollah' ),
					'type'    => 'radio',
					'choices' => array(
						'none'        => __('None', 'dollah'),
						'highlight'   => __('Highlight Color', 'dollah'),
						'image'       => __('Image', 'dollah'),
					),
					'default' => 'none',
					// 'default' => ( ( $fpgmodid == 'area_b' ) ? 'image' :
					// 											( ( $fpgmodid == 'area_d' ) ? 'highlight' : 'none' )
					// 			 ),
					// 'default' => ( ( $fpgmodid == 'area_b' ) ? 'image' : 'none' ),
				),
				'image' => array(
					'label'       => __( "Background Image (Select 'Image' above)", 'dollah' ),
					'type'        => 'image',
					// 'default' => ( ( $fpgmodid == 'area_b' ) ? HYBRID_PARENT_URI . 'images/modulebg.jpg' : '' ),
				),
				'parallax' => array(
					'label'   => __( 'Apply Parallax Effect to Background Image', 'dollah' ),
					'type'    => 'checkbox',
					'default' => 1,
					// 'default' => ( ( $fpgmodid == 'area_b' ) ? 1 : 0 ),
				),
			),
		);

	} // end for

	/** Section **/

	$section = 'slider_html';

	$sections[ $section ] = array(
		'title'       => __( 'Frontpage - HTML Slider', 'dollah' ),
	);

	$settings['wt_html_slider_width'] = array(
		'label'       => __( 'Slider Width', 'dollah' ),
		'sublabel'    => __( "Note: This option is useful only if the <strong>Site Layout</strong> option is set to <strong>Stretched</strong> in 'Setup &amp; Layout' section.", 'dollah' ),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'boxed'   => $imagepath . 'slider-width-boxed.png',
			'stretch' => $imagepath . 'slider-width-stretch.png',
		),
		'default'     => 'stretch',
	);

	$settings['wt_html_slider_min_height'] = array(
		'label'       => __( 'Minimum Slider Height (in pixels)', 'dollah' ),
		'section'     => $section,
		'type'        => 'text',
		'priority'    => 985, // Non static options must have a priority
		'default'     => 375,
		'description' => __('<strong>(in pixels)</strong><hr>Leave empty to let the slider height adjust automatically.', 'dollah'),
		'input_attrs' => array(
			'min' => 0,
			'max' => 3,
			'placeholder' => __( '(in pixels)', 'dollah' ),
		),
	);

	$settings['wt_html_slider'] = array(
		'label'       => __( 'Slides', 'dollah' ),
		'section'     => $section,
		'type'        => 'content',
		'priority'    => 985, // Non static options must have a priority
		'content'     => __( 'Premium version of this theme comes with capability to create <strong>Unlimited slides</strong>.', 'dollah' ),
	);

	for ( $slide = 1; $slide <= 4; $slide++ ) {

		$settings["wt_html_slide_{$slide}"] = array(
			'label'       => sprintf( __( 'Slide %s Content', 'dollah' ), $slide),
			'section'     => $section,
			'type'        => 'group',
			'priority'    => 985, // Non static options must have a priority
			'button'      => sprintf( __( 'Edit Slide %s', 'dollah' ), $slide),
			'options'     => array(
				'description' => array(
					'label'       => '',
					'type'        => 'content',
					'content'     => '<span class="dollah-module-bg-title">' . sprintf( __( 'Slide %s Content', 'dollah' ), $slide) . '</span>',
				),
				'image' => array(
					'label'       => __( 'Showcase Image (Right Column)', 'dollah' ),
					'type'        => 'content',
					'description' => __( 'If the page below has a featured image, it will be used as the Showcase Image (image in right column)', 'dollah' ),
				),
				'content' => array(
					'label'       => __( 'Content (Left Column)', 'dollah' ),
					'type'        => 'select',
					'choices'     => array( __( 'Select Page', 'dollah' ) ) + HybridExtend_Options_Helper::pages(),
				),
				// 'image' => array(
				// 	'label'       => __( 'Featured Image (Right Column)', 'dollah' ),
				// 	'type'        => 'image',
				// 	'description' => __( 'Content below will be center aligned if no image is present.', 'dollah' ),
				// ),
				// 'content' => array(
				// 	'label'       => __( 'Content (Left Column)', 'dollah' ),
				// 	'type'        => 'textarea',
				// 	'default'     => '<h3>Lorem Ipsum Dolor</h3>' . "\n" . __('<p>This is a sample description text for the slide.</p>', 'dollah'),
				// 	'description' => __('You can use the <code>&lt;h3&gt;Lorem Ipsum Dolor&lt;/h3&gt;</code> tag to create styled heading.', 'dollah'),
				// ),
				'content_bg' => array(
					'label'   => __( 'Content Styling', 'dollah' ),
					'type'    => 'select',
					'default' => 'light-on-dark',
					'choices' => array(
						'dark'          => __('Dark Font', 'dollah'),
						'light'         => __('Light Font', 'dollah'),
						'dark-on-light' => __('Dark Font / Light Background', 'dollah'),
						'light-on-dark' => __('Light Font / Dark Background', 'dollah'),
					),
				),
				'button' => array(
					'label'       => __( 'Button Text', 'dollah' ),
					'type'        => 'text',
				),
				'url' => array(
					'label'       => __( 'Button URL', 'dollah' ),
					'type'        => 'url',
					'description' => __( 'Leave empty if you do not want to show the button.', 'dollah' ),
					'input_attrs' => array(
						'placeholder' => 'http://',
					),
				),
			),
		);

		$settings["wt_html_slide_{$slide}-background"] = array(
			'label'       => sprintf( __( 'Slide %s Background', 'dollah' ), $slide),
			'section'     => $section,
			'type'        => 'betterbackground',
			'priority'    => 985, // Non static options must have a priority
			'default'     => array(
				'color'      => '#dddddd',
			),
			'options'     => array( 'color', 'image', 'pattern' ),
		);

	} // end for

	/** Section **/

	$section = 'slider_img';

	$sections[ $section ] = array(
		'title'       => __( 'Frontpage - Image Slider', 'dollah' ),
	);

	$settings['wt_img_slider_width'] = array(
		'label'       => __( 'Slider Width', 'dollah' ),
		'sublabel'    => __("Note: This option is useful only if the <strong>Site Layout</strong> option is set to <strong>Stretched</strong> in 'Setup &amp; Layout' section.", 'dollah'),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'boxed'   => $imagepath . 'slider-width-boxed.png',
			'stretch' => $imagepath . 'slider-width-stretch.png',
		),
		'default'     => 'stretch',
	);

	$settings['wt_img_slider'] = array(
		'label'       => __( 'Slides', 'dollah' ),
		'section'     => $section,
		'type'        => 'content',
		'priority'    => 995, // Non static options must have a priority
		'content'     => __( 'Premium version of this theme comes with capability to create <strong>Unlimited slides</strong>.', 'dollah' ),
	);

	for ( $slide = 1; $slide <= 4; $slide++ ) { 

		$settings["wt_img_slide_{$slide}"] = array(
			'label'       => '',//sprintf( __( 'Slide %s Content', 'dollah' ), $slide),
			'section'     => $section,
			'type'        => 'group',
			'priority'    => 995, // Non static options must have a priority
			'button'      => sprintf( __( 'Edit Slide %s', 'dollah' ), $slide),
			'options'     => array(
				'description' => array(
					'label'       => '',
					'type'        => 'content',
					'content'     => '<span class="dollah-module-bg-title">' . sprintf( __( 'Slide %s Content', 'dollah' ), $slide) . '</span>' . __( '<em>To hide this slide, simply leave the Image empty.</em>', 'dollah' ),
				),
				'image' => array(
					'label'       => __( 'Slide Image', 'dollah' ),
					'type'        => 'image',
					'description' => __( 'The main showcase image.', 'dollah' ),
				),
				'caption' => array(
					'label'       => __( 'Slide Caption (optional)', 'dollah' ),
					'type'        => 'textarea',
					'default'     => '<h3>Lorem Ipsum Dolor</h3>' . "\n" . __('<p>This is a sample description text for the slide.</p>', 'dollah'),
					'description' => __('You can use the <code>&lt;h3&gt;Lorem Ipsum Dolor&lt;/h3&gt;</code> tag to create styled heading.', 'dollah'),
				),
				'caption_bg' => array(
					'label'   => __( 'Caption Styling', 'dollah' ),
					'type'    => 'select',
					'default' => 'light-on-dark',
					'choices' => array(
						'dark'          => __('Dark Font', 'dollah'),
						'light'         => __('Light Font', 'dollah'),
						'dark-on-light' => __('Dark Font / Light Background', 'dollah'),
						'light-on-dark' => __('Light Font / Dark Background', 'dollah'),
					),
				),
				'url' => array(
					'label'       => __( 'Slide Link', 'dollah' ),
					'type'        => 'url',
					'description' => __( 'Leave empty if you do not want to link the slide.', 'dollah' ),
					'input_attrs' => array(
						'placeholder' => 'http://',
					),
				),
				'button' => array(
					'label'       => __( 'Button Text (Optional)', 'dollah' ),
					'type'        => 'text',
					'description' => __( 'Leave empty if you do not want to show the button and instead link the slide image (if you have a url set in the above field)', 'dollah' ),
				),
			),
		);

	} // end for

	/** Section **/

	$section = 'archives';

	$sections[ $section ] = array(
		'title'       => __( 'Archives (Blog, Cats, Tags)', 'dollah' ),
	);

	$settings['archive_type'] = array(
		'label'       => __( 'Archive (Blog) Layout', 'dollah' ),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'big'     => $imagepath . 'archive-big.png',
			'block2'  => $imagepath . 'archive-block2.png',
			'block3'  => $imagepath . 'archive-block3.png',
		),
		'default'     => 'block2',
	);

	$settings['archive_post_content'] = array(
		'label'       => __( 'Post Items Content', 'dollah' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'none' => __('None', 'dollah'),
			'excerpt' => __('Post Excerpt', 'dollah'),
			'full-content' => __('Full Post Content', 'dollah'),
		),
		'default'     => 'excerpt',
		'description' => __( 'Content to display for each post in the list', 'dollah' ),
	);

	$settings['archive_post_meta'] = array(
		'label'       => __( 'Meta Information for Post List Items', 'dollah' ),
		'sublabel'    => __( 'Check which meta information to display for each post item in the archive list.', 'dollah' ),
		'section'     => $section,
		'type'        => 'checkbox',
		'choices'     => array(
			'author'   => __('Author', 'dollah'),
			'date'     => __('Date', 'dollah'),
			'cats'     => __('Categories', 'dollah'),
			'tags'     => __('Tags', 'dollah'),
			'comments' => __('No. of comments', 'dollah')
		),
		'default'     => 'author, date, cats, comments',
	);

	$settings['excerpt_length'] = array(
		'label'       => __( 'Excerpt Length', 'dollah' ),
		'section'     => $section,
		'type'        => 'text',
		'description' => __( 'Number of words in excerpt. Default is 50. Leave empty if you dont want to change it.', 'dollah' ),
		'input_attrs' => array(
			'min' => 0,
			'max' => 3,
			'placeholder' => __( 'default: 50', 'dollah' ),
		),
	);

	$settings['read_more'] = array(
		'label'       => __( "'Read More' Text", 'dollah' ),
		'section'     => $section,
		'type'        => 'text',
		'description' => __( "Replace the default 'Read More' text. Leave empty if you dont want to change it.", 'dollah' ),
		'input_attrs' => array(
			'placeholder' => __( 'default: READ MORE &rarr;', 'dollah' ),
		),
	);

	/** Section **/

	$section = 'singular';

	$sections[ $section ] = array(
		'title'       => __( 'Single (Posts, Pages)', 'dollah' ),
	);

	$settings['page_header_full'] = array(
		'label'       => __( 'Stretch Page Header to Full Width', 'dollah' ),
		'sublabel'    => '<img src="' . $imagepath . 'page-header.png">',
		'section'     => $section,
		'type'        => 'checkbox',
		'choices'     => array(
			'default'    => __('Default (Archives, Blog, Woocommerce etc.)', 'dollah'),
			'posts'      => __('For All Posts', 'dollah'),
			'pages'      => __('For All Pages', 'dollah'),
			'no-sidebar' => __('Always override for full width pages (any page which has no sidebar)', 'dollah'),
		),
		'default'     => 'default, pages, no-sidebar',
		'description' => __('This is the Page Header area containing Page/Post Title and Meta details like author, categories etc.', 'dollah'),
	);

	$settings['post_featured_image'] = array(
		'label'       => __( 'Display Featured Image', 'dollah' ),
		'section'     => $section,
		'type'        => 'select',
		'choices'     => array(
			'none'   => __( 'Do not display', 'dollah'),
			'header' => __( 'Full width in header', 'dollah'),
			'start'  => __( 'Beginning of post/page content', 'dollah'),
		),
		'default'     => 'header',
		'description' => __('Display featured image on Post/Page page.', 'dollah'),
	);

	$settings['post_meta'] = array(
		'label'       => __( 'Meta Information on Posts', 'dollah' ),
		'sublabel'    => __( "Check which meta information to display on an individual 'Post' page", 'dollah' ),
		'section'     => $section,
		'type'        => 'checkbox',
		'choices'     => array(
			'author'   => __('Author', 'dollah'),
			'date'     => __('Date', 'dollah'),
			'cats'     => __('Categories', 'dollah'),
			'tags'     => __('Tags', 'dollah'),
			'comments' => __('No. of comments', 'dollah')
		),
		'default'     => 'author, date, cats, tags, comments',
	);

	$settings['page_meta'] = array(
		'label'       => __( 'Meta Information on Page', 'dollah' ),
		'sublabel'    => __( "Check which meta information to display on an individual 'Page' page", 'dollah' ),
		'section'     => $section,
		'type'        => 'checkbox',
		'choices'     => array(
			'author'   => __('Author', 'dollah'),
			'date'     => __('Date', 'dollah'),
			'comments' => __('No. of comments', 'dollah')
		),
		'default'     => 'author, date, comments',
	);

	$settings['post_meta_location'] = array(
		'label'       => __( 'Meta Information location', 'dollah' ),
		'section'     => $section,
		'type'        => 'radio',
		'choices'     => array(
			'top'    => __('Top (below title)', 'dollah'),
			'bottom' => __('Bottom (after content)', 'dollah'),
		),
		'default'     => 'top',
	);

	$settings['post_prev_next_links'] = array(
		'label'       => __( 'Previous/Next Posts', 'dollah' ),
		'sublabel'    => __( 'Display links to Prev/Next Post links at the end of post content.', 'dollah' ),
		'section'     => $section,
		'type'        => 'checkbox',
		'default'     => 1,
	);

	$settings['contact-form'] = array(
		'label'       => __( 'Contact Form', 'dollah' ),
		'section'     => $section,
		'type'        => 'content',
		'content'     => sprintf( __('This theme comes bundled with CSS required to style %1$sContact-Form-7%2$s forms. Simply install and activate the plugin to add Contact Forms to your pages.', 'dollah'), '<a href="https://wordpress.org/plugins/contact-form-7/" target="_blank">', '</a>'), // @todo update link to docs
	);

	if ( current_theme_supports( 'woocommerce' ) ) :

		/** Section **/

		$section = 'woocommerce';

		$sections[ $section ] = array(
			'title'       => __( 'WooCommerce', 'dollah' ),
			'priority'    => '58', // Non static options must have a priority
		);

		$wooproducts = range( 0, 99 );
		for ( $wpr=0; $wpr < 4; $wpr++ )
			unset( $wooproducts[$wpr] );
		$settings['wooshop_products'] = array(
			'label'       => __( 'Total Products per page', 'dollah' ),
			'section'     => $section,
			'type'        => 'select',
			'priority'    => '1115', // Non static options must have a priority
			'choices'     => $wooproducts,
			'default'     => '12',
			'description' => __( 'Total number of products to show on the Shop page', 'dollah' ),
		);

		$settings['wooshop_product_columns'] = array(
			'label'       => __( 'Product Columns', 'dollah' ),
			'section'     => $section,
			'type'        => 'select',
			'priority'    => '1115', // Non static options must have a priority
			'choices'     => array(
				'2' => '2',
				'3' => '3',
				'4' => '4',
				'5' => '5',
			),
			'default'     => '3',
			'description' => __( 'Number of products to show in 1 row on the Shop page', 'dollah' ),
		);

		$settings['sidebar_wooshop'] = array(
			'label'       => __( 'Sidebar Layout (Woocommerce Shop/Archives)', 'dollah' ),
			'section'     => $section,
			'type'        => 'radioimage',
			'priority'    => '1115', // Non static options must have a priority
			'choices'     => array(
				'wide-right'         => $imagepath . 'sidebar-wide-right.png',
				'narrow-right'       => $imagepath . 'sidebar-narrow-right.png',
				'wide-left'          => $imagepath . 'sidebar-wide-left.png',
				'narrow-left'        => $imagepath . 'sidebar-narrow-left.png',
				'narrow-left-right'  => $imagepath . 'sidebar-narrow-left-right.png',
				'narrow-left-left'   => $imagepath . 'sidebar-narrow-left-left.png',
				'narrow-right-right' => $imagepath . 'sidebar-narrow-right-right.png',
				'full-width'         => $imagepath . 'sidebar-full.png',
				'none'               => $imagepath . 'sidebar-none.png',
			),
			'default'     => 'wide-right',
			'description' => __("Set the default sidebar width and position for WooCommerce Shop and Archives pages like product categories etc.", 'dollah'),
		);

		$settings['sidebar_wooproduct'] = array(
			'label'       => __( 'Sidebar Layout (Woocommerce Single Product Page)', 'dollah' ),
			'section'     => $section,
			'type'        => 'radioimage',
			'priority'    => '1115', // Non static options must have a priority
			'choices'     => array(
				'wide-right'         => $imagepath . 'sidebar-wide-right.png',
				'narrow-right'       => $imagepath . 'sidebar-narrow-right.png',
				'wide-left'          => $imagepath . 'sidebar-wide-left.png',
				'narrow-left'        => $imagepath . 'sidebar-narrow-left.png',
				'narrow-left-right'  => $imagepath . 'sidebar-narrow-left-right.png',
				'narrow-left-left'   => $imagepath . 'sidebar-narrow-left-left.png',
				'narrow-right-right' => $imagepath . 'sidebar-narrow-right-right.png',
				'full-width'         => $imagepath . 'sidebar-full.png',
				'none'               => $imagepath . 'sidebar-none.png',
			),
			'default'     => 'wide-right',
			'description' => __("Set the default sidebar width and position for WooCommerce product page", 'dollah'),
		);

	endif;

	/** Section **/

	$section = 'footer';

	$sections[ $section ] = array(
		'title'       => __( 'Footer', 'dollah' ),
	);

	$settings['footer'] = array(
		'label'       => __( 'Footer Layout', 'dollah' ),
		'section'     => $section,
		'type'        => 'radioimage',
		'choices'     => array(
			'1-1' => $imagepath . '1-1.png',
			'2-1' => $imagepath . '2-1.png',
			'2-2' => $imagepath . '2-2.png',
			'2-3' => $imagepath . '2-3.png',
			'3-1' => $imagepath . '3-1.png',
			'3-2' => $imagepath . '3-2.png',
			'3-3' => $imagepath . '3-3.png',
			'3-4' => $imagepath . '3-4.png',
			'4-1' => $imagepath . '4-1.png',
		),
		'default'     => '3-1',
		'description' => sprintf( __('You must first save the changes you make here and refresh this screen for footer columns to appear in the Widgets panel (in customizer).<hr> Once you save the settings here, you can add content to footer columns using the %1$sWidgets Management screen%2$s.', 'dollah'), '<a href="' . esc_url( admin_url('widgets.php') ) . '" target="_blank">', '</a>' ),
	);

	$settings['site_info'] = array(
		'label'       => __( 'Site Info Text (footer)', 'dollah' ),
		'section'     => $section,
		'type'        => 'textarea',
		'default'     => __( '<!--default-->', 'dollah'),
		'description' => sprintf( __('Text shown in footer. Useful for showing copyright info etc.<hr>Use the <code>&lt;!--default--&gt;</code> tag to show the default Info Text.<hr>Use the <code>&lt;!--year--&gt;</code> tag to insert the current year.<hr>Always use %1$sHTML codes%2$s for symbols. For example, the HTML for &copy; is <code>&amp;copy;</code>', 'dollah'), '<a href="http://ascii.cl/htmlcodes.htm" target="_blank">', '</a>' ),
	);


	/*** Return Options Array ***/
	return apply_filters( 'dollah_theme_customizer_options', array(
		'settings' => $settings,
		'sections' => $sections,
		'panels'   => $panels,
	) );

}
endif;

/**
 * Add Options (settings, sections and panels) to HybridExtend_Customize class options object
 *
 * @since 1.0
 * @access public
 * @return void
 */
if ( !function_exists( 'dollah_theme_add_customizer_options' ) ) :
function dollah_theme_add_customizer_options() {

	$hybridextend_customize = HybridExtend_Customize::get_instance();

	// Add Options
	$options = dollah_theme_customizer_options();
	$hybridextend_customize->add_options( array(
		'settings' => $options['settings'],
		'sections' => $options['sections'],
		'panels' => $options['panels'],
		) );

}
endif;
add_action( 'init', 'dollah_theme_add_customizer_options', 0 ); // cannot hook into 'after_setup_theme' as this hook is already being executed (this file is loaded at after_setup_theme @priority 10) (hooking into same hook from within while hook is being executed leads to undesirable effects as $GLOBALS[$wp_filter]['after_setup_theme'] has already been ksorted)
// Hence, we hook into 'init' @priority 0, so that settings array gets populated before 'widgets_init' action ( which itself is hooked to 'init' at priority 1 ) for creating widget areas ( settings array is needed for creating defaults when user value has not been stored )

/**
 * Enqueue custom scripts to customizer screen
 *
 * @since 1.0
 * @return void
 */
function dollah_theme_customizer_enqueue_scripts() {
	// Enqueue Styles
	wp_enqueue_style( 'dollah-theme-customize-styles', HYBRIDEXTEND_INCURI . 'admin/css/customize.css', array(),  HYBRIDEXTEND_VERSION );
	// Enqueue Scripts
	wp_enqueue_script( 'dollah-theme-customize-script', HYBRIDEXTEND_INCURI . 'admin/js/customize.js', array( 'jquery', 'wp-color-picker', 'customize-controls', 'hybridextend-customize-script' ), HYBRIDEXTEND_VERSION, true );
}
// Load scripts at priority 12 so that Hoot Customizer Interface (11) / Custom Controls (10) have loaded their scripts
add_action( 'customize_controls_enqueue_scripts', 'dollah_theme_customizer_enqueue_scripts', 12 );

/**
 * Modify default WordPress Settings Sections and Panels
 *
 * @since 1.0
 * @param object $wp_customize
 * @return void
 */
function dollah_customizer_modify_default_options( $wp_customize ) {

	if ( function_exists( 'the_custom_logo' ) ) {
		$wp_customize->get_control( 'custom_logo' )->section = 'logo';
		$wp_customize->get_control( 'custom_logo' )->priority = 295; // Replaces theme's logo_image // Update in premium if needed
		$wp_customize->get_control( 'custom_logo' )->width = 300;
		$wp_customize->get_control( 'custom_logo' )->height = 180;
		// $wp_customize->get_control( 'custom_logo' )->type = 'image'; // Stored value becomes url instead of image ID (fns like the_custom_logo() dont work)
		// Defaults: [type] => cropped_image, [width] => 150, [height] => 150, [flex_width] => 1, [flex_height] => 1, [button_labels] => array(...), [label] => Logo
		$wp_customize->get_control( 'custom_logo' )->active_callback = 'dollah_callback_logo_image';
	}

	if ( function_exists( 'get_site_icon_url' ) )
		$wp_customize->get_control( 'site_icon' )->priority = 10;

	$wp_customize->get_section( 'static_front_page' )->priority = 3;

	// $wp_customize->get_section( 'title_tagline' )->panel = 'general';
	// $wp_customize->get_section( 'title_tagline' )->priority = 1;
	// $wp_customize->get_section( 'colors' )->panel = 'styling';

	// global $wp_version;
	// if ( version_compare( $wp_version, '4.3', '>=' ) ) // 'Creating Default Object from Empty Value' error before 4.3 since 'nav_menus' panel did not exist ( we did have 'nav' section till 4.1.9 i.e. before 4.2 )
	// 	$wp_customize->get_panel( 'nav_menus' )->priority = 999;
	// This will set the priority, however will give a 'Creating Default Object from Empty Value' error first.
	// $wp_customize->get_panel( 'widgets' )->priority = 999;

}
add_action( 'customize_register', 'dollah_customizer_modify_default_options', 100 );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @since 1.0
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * @return void
 */
function dollah_customizer_customize_register( $wp_customize ) {
	// $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
}
add_action( 'customize_register', 'dollah_customizer_customize_register' );

/**
 * Callback Functions for customizer settings
 */

function dollah_callback_logo_size( $control ) {
	$selector = $control->manager->get_setting('logo')->value();
	return ( $selector == 'text' || $selector == 'mixed' ) ? true : false;
}
function dollah_callback_site_title_icon( $control ) {
	$selector = $control->manager->get_setting('logo')->value();
	return ( $selector == 'text' || $selector == 'custom' ) ? true : false;
}
function dollah_callback_logo_image( $control ) {
	$selector = $control->manager->get_setting('logo')->value();
	return ( $selector == 'image' || $selector == 'mixed' || $selector == 'mixedcustom' ) ? true : false;
}
function dollah_callback_logo_image_width( $control ) {
	$selector = $control->manager->get_setting('logo')->value();
	return ( $selector == 'mixed' || $selector == 'mixedcustom' ) ? true : false;
}
function dollah_callback_logo_custom( $control ) {
	$selector = $control->manager->get_setting('logo')->value();
	return ( $selector == 'custom' || $selector == 'mixedcustom' ) ? true : false;
}
function dollah_callback_show_tagline( $control ) {
	$selector = $control->manager->get_setting('logo')->value();
	return ( $selector == 'text' || $selector == 'custom' || $selector == 'mixed' || $selector == 'mixedcustom' ) ? true : false;
}

function dollah_callback_box_background_color( $control ) {
	$selector = $control->manager->get_setting('site_layout')->value();
	return ( $selector == 'boxed' ) ? true : false;
}

/**
 * Specific Sanitization Functions for customizer settings
 * See specific settings above for more details.
 */
function dollah_custom_sanitize_textarea_allowscript( $value ) {
	global $allowedposttags;
	// Allow javascript to let users ad code for ads etc.
	$allow = array_merge( $allowedposttags, array(
		'script' => array( 'async' => true, 'charset' => true, 'defer' => true, 'src' => true, 'type' => true ),
	) );
	return wp_kses( $value , $allow );
}

/**
 * Helper function to return the theme mod value.
 * If no value has been saved, it returns $default provided by the theme.
 * If no $default provided, it checks the default value specified in the customizer settings..
 * 
 * @since 1.0
 * @access public
 * @param string $name
 * @param mixed $default
 * @return mixed
 */
function dollah_get_mod( $name, $default = NULL ) {

	if ( $name=='disable_sticky_header' ) return true;

	if ( is_customize_preview() ) {

		// We cannot use "if ( !empty( $mod ) )" as this will become false for empty values, and hence fallback to default. isset() is not an option either as $mod is always set. Hence we calculate the default here, and supply it as second argument to get_theme_mod()
		$default = ( $default !== NULL ) ? $default : hybridextend_customize_get_default( $name );
		$mod = get_theme_mod( $name, $default );

		return apply_filters( 'dollah_get_mod_customize', $mod, $name, $default );

	} else {

		/*** Return value if set ***/

		// Cache
		static $mods = NULL;

		// Get the values from database
		if ( !$mods ) {
			$mods = get_theme_mods();
			$mods = apply_filters( 'dollah_get_mod', $mods );
		}

		if ( isset( $mods[$name] ) ) {
			// Filter applied as in get_theme_mod() core function
			$returnvalue = apply_filters( "theme_mod_{$name}", $mods[$name] );
			return apply_filters( 'dollah_sanitize_get_mod', $returnvalue, $name );
		}

		/*** Return default if provided ***/
		if ( $default !== NULL )
			return apply_filters( "theme_mod_{$name}", $default );

		/*** Return default theme option value specified in customizer settings ***/
		$default = hybridextend_customize_get_default( $name );
		if ( !empty( $default ) )
			return apply_filters( "theme_mod_{$name}", $default );

	}

	/*** We dont have anything! ***/
	return false;
}

/**
 * Sanitization function for return value of theme mod
 * jnes No chan-ni applied
 * 
 * @since 1.0
 * @access public
 * @param mixed $value
 * @param string $name
 * @return mixed
 */
function dollah_sanitize_get_mod( $value, $name ) {

	/** Get Setting array from the Customizer Class **/
	$hybridextend_customize = HybridExtend_Customize::get_instance();
	$settings = $hybridextend_customize->get_options('settings');

	/** Load Sanitization functions if not loaded already (for frontend) **/
	if ( !function_exists( 'hybridextend_sanitize_enum' ) )
		require_once( HYBRIDEXTEND_DIR . 'includes/sanitization.php' );
	/** Load Sanitization functions if not loaded already (from frontend) **/
	if ( !function_exists( 'hybridextend_customize_sanitize_text' ) )
		require_once( HYBRIDEXTEND_DIR . 'customize/sanitization.php' );

	if ( isset( $settings[ $name ] ) ) {

		/** Sanitize values **/
		if ( isset( $settings[ $name ]['type'] ) && !empty( $settings[ $name ]['sanitize_callback'] ) && function_exists( $settings[ $name ]['sanitize_callback'] ) ) {

			$fn_name = $settings[ $name ]['sanitize_callback'];
			return $fn_name( $value );

		} elseif ( isset( $settings[ $name ]['type'] ) ) {
			switch ( $settings[ $name ]['type'] ) {

				// Text Field
				case 'text':
					$value = sanitize_text_field( $value ); // Alternately, can also use "hybridextend_customize_sanitize_text" to use wp_kses() instead
					break;

				// Textarea Field
				case 'textarea':
					$value = hybridextend_sanitize_textarea( $value );
					break;

				// Select, Radio, Image Radio
				case 'select':
				case 'radio':
				case 'radioimage':
					$value = hybridextend_sanitize_enum( $value, $settings[ $name ]['choices'] );
					break;

				// Image / Upload Field
				case 'image':
				case 'upload':
					$value = esc_url( $value );
					break;

				// URL Field
				case 'url':
					$value = esc_url( $value );
					break;

				// Range Field
				case 'range':
					$value = hybridextend_customize_sanitize_range( $value );
					break;

				// Dropdown Pages Field
				case 'dropdown-pages':
					$value = absint( $value );
					break;

				// Color Field
				case 'color':
					$value = sanitize_hex_color( $value );
					break;

				// Checkbox Field
				case 'checkbox':
					$value = hybridextend_sanitize_checkbox( $value );
					break;

				// MultiCheckbox Field
				case 'bettercheckbox':
					if ( !empty( $settings[ $name ]['choices'] ) && is_array( $settings[ $name ]['choices'] ) )
						$value = hybridextend_customize_sanitize_multicheckbox( $value, $name );
					else
						$value = hybridextend_sanitize_checkbox( $value );
					break;

				// Icon Field
				case 'icon':
					$value = hybridextend_sanitize_icon( $value, $name );
					break;

				// Sortlist Field
				case 'sortlist':
					$value = hybridextend_customize_sanitize_sortlist( $value, $name );
					break;

			} // endswitch
		} // endif

	} // endif

	return $value;
}