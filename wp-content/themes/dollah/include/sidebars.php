<?php
/**
 * Register sidebar widget areas for the theme
 * This file is loaded via the 'after_setup_theme' hook at priority '10'
 *
 * @package    Hoot
 * @subpackage Dollah
 */

/* Register sidebars. */
add_action( 'widgets_init', 'dollah_base_register_sidebars', 5 );
add_action( 'widgets_init', 'dollah_frontpage_register_sidebars' );

/**
 * Registers sidebars.
 *
 * @since 1.0
 * @access public
 * @return void
 */
function dollah_base_register_sidebars() {

	// Primary Sidebar
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-primary-sidebar',
			'name'         => _x( 'Primary Sidebar', 'sidebar', 'dollah' ),
			'description'  => __( 'The main sidebar used throughout the site.', 'dollah' ),
			'before_title' => '<h3 class="widget-title">',
			'after_title'  => '</h3>',
		)
	);

	// Secondary Sidebar
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-secondary-sidebar',
			'name'         => _x( 'Secondary Sidebar', 'sidebar', 'dollah' ),
			'description'  => __( 'The secondary sidebar used throughout the site (if you are using a 3 column layout with 2 sidebars).', 'dollah' ),
			'before_title' => '<h3 class="widget-title">',
			'after_title'  => '</h3>',
		)
	);

	// Topbar Left Widget Area
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-topbar-left',
			'name'         => _x( 'Topbar Left', 'sidebar', 'dollah' ),
			'description'  => __( 'Leave empty if you dont want to show topbar.', 'dollah' ),
			'before_title' => '<h3 class="widget-title">',
			'after_title'  => '</h3>',
		)
	);

	// Topbar Right Widget Area
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-topbar-right',
			'name'         => _x( 'Topbar Right', 'sidebar', 'dollah' ),
			'description'  => __( 'Leave empty if you dont want to show topbar.', 'dollah' ),
			'before_title' => '<h3 class="widget-title">',
			'after_title'  => '</h3>',
		)
	);

	// Header Side Widget Area
	if ( dollah_get_mod( 'primary_menuarea' ) == 'widget-area' )
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-header',
			'name'         => _x( 'Header Side', 'sidebar', 'dollah' ),
			'description'  => __( 'Appears in Header on right of logo', 'dollah' ),
			'before_title' => '<h3 class="widget-title">',
			'after_title'  => '</h3>',
		)
	);

	// Below Header Widget Area
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-below-header',
			'name'         => _x( 'Below Header', 'sidebar', 'dollah' ),
			'description'  => __( 'This area is often used for displaying context specific menus, advertisements, and third party breadcrumb plugins.', 'dollah' ),
			'before_title' => '<h3 class="widget-title">',
			'after_title'  => '</h3>',
		)
	);

	// Subfooter Widget Area
	hybrid_register_sidebar(
		array(
			'id'           => 'hoot-sub-footer',
			'name'         => _x( 'Sub Footer', 'sidebar', 'dollah' ),
			'description'  => __( 'Leave empty if you dont want to show subfooter.', 'dollah' ),
			'before_title' => '<h3 class="widget-title">',
			'after_title'  => '</h3>',
		)
	);

	// Footer Columns
	$footercols = dollah_get_footer_columns();

	if( $footercols ) :
		$alphas = range('a', 'z');
		for ( $i=0; $i < $footercols; $i++ ) :
			if ( isset( $alphas[ $i ] ) ) :
				hybrid_register_sidebar(
					array(
						'id'           => 'hoot-footer-' . $alphas[ $i ],
						'name'         => sprintf( _x( 'Footer %s', 'sidebar', 'dollah' ), strtoupper( $alphas[ $i ] ) ),
						'description'  => __( 'You can set footer columns in Theme Options page.', 'dollah' ),
						'before_title' => '<h3 class="widget-title">',
						'after_title'  => '</h3>',
					)
				);
			endif;
		endfor;
	endif;

}

/**
 * Registers frontpage widget areas.
 *
 * @since 1.0
 * @access public
 * @return void
 */
function dollah_frontpage_register_sidebars() {

	$areas = array();

	/* Set up defaults */
	$defaults = apply_filters( 'dollah_frontpage_widget_areas', array( 'a', 'b', 'c', 'd', 'e', 'f' ) );
	$locations = apply_filters( 'dollah_frontpage_widget_area_names', array(
		__( 'Left', 'dollah' ),
		__( 'Center Left', 'dollah' ),
		__( 'Center', 'dollah' ),
		__( 'Center Right', 'dollah' ),
		__( 'Right', 'dollah' ),
	) );

	// Get user settings
	$sections = hybridextend_sortlist( dollah_get_mod( 'frontpage_sections' ) );

	foreach ( $defaults as $key ) {
		$id = "area_{$key}";
		if ( empty( $sections[$id]['sortitem_hide'] ) ) {

			$columns = ( isset( $sections[$id]['columns'] ) ) ? $sections[$id]['columns'] : '';
			$count = count( explode( '-', $columns ) ); // empty $columns still returns array of length 1
			$location = '';

			for ( $c = 1; $c <= $count ; $c++ ) {
				switch ( $count ) {
					case 2: $location = ($c == 1) ? $locations[0] : $locations[4];
							break;
					case 3: $location = ($c == 1) ? $locations[0] : (
								($c == 2) ? $locations[2] : $locations[4]
							);
							break;
					case 4: $location = ($c == 1) ? $locations[0] : (
								($c == 2) ? $locations[1] : (
									($c == 3) ? $locations[3] : $locations[4]
								)
							);
				}
				$areas[ $id . '_' . $c ] = sprintf( __('Frontpage - Widget Area %1$s %2$s', 'dollah'), strtoupper( $key ), $location );
			}

		}
	}

	foreach ( $areas as $key => $name ) {
		hybrid_register_sidebar(
			array(
				'id'           => 'hoot-frontpage-' . $key,
				'name'         => $name,
				'description'  => __( "You can order Frontpage areas in Customizer > 'Content' panel > 'Frontpage - Modules' section.", 'dollah' ),
				'before_title' => '<h3 class="widget-title">',
				'after_title'  => '</h3>',
			)
		);
	}

}