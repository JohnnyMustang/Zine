<?php
/**
 * Announce Widget
 *
 * @package    Hoot
 * @subpackage Dollah
 */

/**
* Class Dollah_Announce_Widget
*/
class Dollah_Announce_Widget extends HybridExtend_WP_Widget {

	function __construct() {

		$settings['id'] = 'dollah-announce-widget';
		$settings['name'] = __( 'Hoot > Announce', 'dollah' );
		$settings['widget_options'] = array(
			'description'	=> __('Display Announcement Message', 'dollah'),
			// 'classname'		=> 'dollah-announce-widget', // CSS class applied to frontend widget container via 'before_widget' arg
		);
		$settings['control_options'] = array();
		$settings['form_options'] = array(
			//'name' => can be empty or false to hide the name
			array(
				'name'		=> __( 'Message', 'dollah' ),
				'id'		=> 'message',
				'type'		=> 'text',
			),
			array(
				'name'		=> __('Background (optional)', 'dollah'),
				'desc'		=> __('Leave empty for no background.', 'dollah'),
				'id'		=> 'background',
				// 'std'		=> '#aa0000',
				'type'		=> 'color',
			),
			array(
				'name'		=> __('Font Color (optional)', 'dollah'),
				'desc'		=> __('Leave empty to use default font colors.', 'dollah'),
				'id'		=> 'fontcolor',
				// 'std'		=> '#aa0000',
				'type'		=> 'color',
			),
			array(
				'name'		=> __('Icon', 'dollah'),
				'id'		=> 'icon',
				'type'		=> 'icon',
			),
			array(
				'name'		=> __( 'Link URL (Optional)', 'dollah' ),
				'id'		=> 'url',
				'type'		=> 'text',
				'sanitize'	=> 'url',
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

		$settings = apply_filters( 'dollah_announce_widget_settings', $settings );

		parent::__construct( $settings['id'], $settings['name'], $settings['widget_options'], $settings['control_options'], $settings['form_options'] );

	}

	/**
	 * Echo the widget content
	 */
	function display_widget( $instance, $before_title = '', $title='', $after_title = '' ) {
		extract( $instance, EXTR_SKIP );
		include( hybridextend_locate_widget( 'announce' ) ); // Loads the widget/announce or template-parts/widget-announce.php template.
	}

}

/**
 * Register Widget
 */
function dollah_announce_widget_register(){
	register_widget('Dollah_Announce_Widget');
}
add_action('widgets_init', 'dollah_announce_widget_register');