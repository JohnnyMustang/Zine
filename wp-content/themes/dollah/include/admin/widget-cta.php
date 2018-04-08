<?php
/**
 * Call To Action Widget
 *
 * @package    Hoot
 * @subpackage Dollah
 */

/**
* Class Dollah_CTA_Widget
*/
class Dollah_CTA_Widget extends HybridExtend_WP_Widget {

	function __construct() {

		$settings['id'] = 'dollah-cta-widget';
		$settings['name'] = __( 'Hoot > Call To Action', 'dollah' );
		$settings['widget_options'] = array(
			'description'	=> __('Display Call To Action block.', 'dollah'),
			// 'classname'		=> 'dollah-cta-widget', // CSS class applied to frontend widget container via 'before_widget' arg
		);
		$settings['control_options'] = array();
		$settings['form_options'] = array(
			//'name' => can be empty or false to hide the name
			array(
				'name'		=> __( 'Headline', 'dollah' ),
				'id'		=> 'headline',
				'type'		=> 'text',
			),
			array(
				'name'		=> __( 'Description', 'dollah' ),
				'id'		=> 'description',
				'type'		=> 'textarea',
			),
			array(
				'name'		=> __( 'Button Text', 'dollah' ),
				'desc'		=> __( 'Leave empty if you dont want to show button', 'dollah' ),
				'id'		=> 'button_text',
				'type'		=> 'text',
				'std'		=> __( 'KNOW MORE', 'dollah' ),
			),
			array(
				'name'		=> __( 'URL', 'dollah' ),
				'desc'		=> __( 'Leave empty if you dont want to show button', 'dollah' ),
				'id'		=> 'url',
				'type'		=> 'text',
				'sanitize'	=> 'url',
			),
			array(
				'name'		=> __( 'Border', 'dollah' ),
				'desc'		=> __( 'Top and bottom borders.', 'dollah' ),
				'id'		=> 'border',
				'type'		=> 'select',
				'std'		=> 'none none',
				'options'	=> array(
					'line line'		=> __( 'Top - Line || Bottom - Line', 'dollah' ),
					'line shadow'	=> __( 'Top - Line || Bottom - DoubleLine', 'dollah' ),
					'line none'		=> __( 'Top - Line || Bottom - None', 'dollah' ),
					'shadow line'	=> __( 'Top - DoubleLine || Bottom - Line', 'dollah' ),
					'shadow shadow'	=> __( 'Top - DoubleLine || Bottom - DoubleLine', 'dollah' ),
					'shadow none'	=> __( 'Top - DoubleLine || Bottom - None', 'dollah' ),
					'none line'		=> __( 'Top - None || Bottom - Line', 'dollah' ),
					'none shadow'	=> __( 'Top - None || Bottom - DoubleLine', 'dollah' ),
					'none none'		=> __( 'Top - None || Bottom - None', 'dollah' ),
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

		$settings = apply_filters( 'dollah_cta_widget_settings', $settings );

		parent::__construct( $settings['id'], $settings['name'], $settings['widget_options'], $settings['control_options'], $settings['form_options'] );

	}

	/**
	 * Echo the widget content
	 */
	function display_widget( $instance, $before_title = '', $title='', $after_title = '' ) {
		extract( $instance, EXTR_SKIP );
		include( hybridextend_locate_widget( 'cta' ) ); // Loads the widget/cta or template-parts/widget-cta.php template.
	}

}

/**
 * Register Widget
 */
function dollah_cta_widget_register(){
	register_widget('Dollah_CTA_Widget');
}
add_action('widgets_init', 'dollah_cta_widget_register');