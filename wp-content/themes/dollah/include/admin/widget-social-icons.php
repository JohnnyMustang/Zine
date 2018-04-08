<?php
/**
 * Social Icons Widget
 *
 * @package    Hoot
 * @subpackage Dollah
 */

/**
* Class Dollah_Social_Icons_Widget
*/
class Dollah_Social_Icons_Widget extends HybridExtend_WP_Widget {

	function __construct() {

		$settings['id'] = 'dollah-social-icons-widget';
		$settings['name'] = __( 'Hoot > Social Icons', 'dollah' );
		$settings['widget_options'] = array(
			'description'	=> __('Display Social Icons', 'dollah'),
			// 'classname'		=> 'dollah-social-icons-widget', // CSS class applied to frontend widget container via 'before_widget' arg
		);
		$settings['control_options'] = array();
		$settings['form_options'] = array(
			//'name' => can be empty or false to hide the name
			array(
				'name'		=> __( "Title (optional)", 'dollah' ),
				'id'		=> 'title',
				'type'		=> 'text',
			),
			array(
				'name'		=> __( 'Icon Size', 'dollah' ),
				'id'		=> 'size',
				'type'		=> 'select',
				'std'		=> 'small',
				'options'	=> array(
					'small'		=> __( 'Small', 'dollah' ),
					'medium'	=> __( 'Medium', 'dollah' ),
					'large'		=> __( 'Large', 'dollah' ),
					'huge'		=> __( 'Huge', 'dollah' ),
				),
			),
			array(
				'name'		=> __( 'Social Icons', 'dollah' ),
				'id'		=> 'icons',
				'type'		=> 'group',
				'options'	=> array(
					'item_name'	=> __( 'Icon', 'dollah' ),
				),
				'fields'	=> array(
					array(
						'name'		=> __( 'Social Icon', 'dollah' ),
						'id'		=> 'icon',
						'type'		=> 'select',
						'options'	=> hybridextend_enum_social_profiles(),
					),
					array(
						'name'		=> __( 'URL (enter username for Skype, email address for Email)', 'dollah' ),
						'id'		=> 'url',
						'type'		=> 'text',
						'sanitize'	=> 'social_icons_sanitize_url',
					),
				),
			),
			array(
				'name'		=> __( 'Widget CSS', 'dollah' ),
				'id'		=> 'customcss',
				'type'		=> 'collapse',
				'fields'	=> array(
					array(
						'name'		=> __( 'Custom CSS Class', 'dollah' ),
						'desc'		=> __( 'Give this widget a custom css classname', 'dollah' ),
						'id'		=> 'class',
						'type'		=> 'text',
					),
					array(
						'name'		=> __( 'Margin Top', 'dollah' ),
						'desc'		=> __( '(in pixels) Leave empty to load default margins', 'dollah' ),
						'id'		=> 'mt',
						'type'		=> 'text',
						'settings'	=> array( 'size' => 3 ),
						'sanitize'	=> 'integer',
					),
					array(
						'name'		=> __( 'Margin Bottom', 'dollah' ),
						'desc'		=> __( '(in pixels) Leave empty to load default margins', 'dollah' ),
						'id'		=> 'mb',
						'type'		=> 'text',
						'settings'	=> array( 'size' => 3 ),
						'sanitize'	=> 'integer',
					),
					array(
						'name'		=> __( 'Widget ID', 'dollah' ),
						'id'		=> 'widgetid',
						'type'		=> '<span class="widgetid" data-baseid="' . $settings['id'] . '">' . __( 'Save this widget to view its ID', 'dollah' ) . '</span>',
					),
				),
			),
		);

		$settings = apply_filters( 'dollah_social_icons_widget_settings', $settings );

		parent::__construct( $settings['id'], $settings['name'], $settings['widget_options'], $settings['control_options'], $settings['form_options'] );

	}

	/**
	 * Echo the widget content
	 */
	function display_widget( $instance, $before_title = '', $title='', $after_title = '' ) {
		extract( $instance, EXTR_SKIP );
		include( hybridextend_locate_widget( 'social-icons' ) ); // Loads the widget/social-icons or template-parts/widget-social-icons.php template.
	}

}

/**
 * Register Widget
 */
function dollah_social_icons_widget_register(){
	register_widget('Dollah_Social_Icons_Widget');
}
add_action('widgets_init', 'dollah_social_icons_widget_register');

/**
 * Custom Sanitization Function
 */
function dollah_social_icons_sanitize_url( $value, $name, $instance ){
	if ( $name == 'social_icons_sanitize_url' ) {
		if ( !empty( $instance['icon'] ) && $instance['icon'] == 'fa-skype' )
			$new = sanitize_user( $value, true );
		elseif ( !empty( $instance['icon'] ) && $instance['icon'] == 'fa-envelope' )
			$new = ( is_email( $value ) ) ? sanitize_email( $value ) : '';
		else
			$new = esc_url_raw( $value );
		return $new;
	}
	return $value;
}
add_filter('widget_admin_sanitize_field', 'dollah_social_icons_sanitize_url', 10, 3);