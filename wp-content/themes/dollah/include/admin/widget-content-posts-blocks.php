<?php
/**
 * Content Posts Blocks Widget
 *
 * @package    Hoot
 * @subpackage Dollah
 */

/**
* Class Dollah_Content_Posts_Blocks_Widget
*/
class Dollah_Content_Posts_Blocks_Widget extends HybridExtend_WP_Widget {

	function __construct() {

		$settings['id'] = 'dollah-posts-blocks-widget';
		$settings['name'] = __( 'Hoot > Content Blocks (Posts)', 'dollah' );
		$settings['widget_options'] = array(
			'description'	=> __('Display Styled Content Blocks.', 'dollah'),
			// 'classname'		=> 'dollah-posts-blocks-widget', // CSS class applied to frontend widget container via 'before_widget' arg
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
				'name'		=> __( 'Blocks Style', 'dollah' ),
				'id'		=> 'style',
				'type'		=> 'images',
				'std'		=> 'style1',
				'options'	=> array(
					'style1'	=> HYBRIDEXTEND_INCURI . 'admin/images/content-block-style-1.png',
					'style2'	=> HYBRIDEXTEND_INCURI . 'admin/images/content-block-style-2.png',
					// 'style3'	=> HYBRIDEXTEND_INCURI . 'admin/images/content-block-style-3.png',
					'style4'	=> HYBRIDEXTEND_INCURI . 'admin/images/content-block-style-4.png',
				),
			),
			array(
				'name'		=> __( 'Category (Optional)', 'dollah' ),
				'desc'		=> __( 'Leave empty to display posts from all categories.', 'dollah' ),
				'id'		=> 'category',
				'type'		=> 'select',
				'options'	=> array( '0' => '' ) + HybridExtend_WP_Widget::get_tax_list('category') ,
			),
			array(
				'name'		=> __( 'No. Of Columns', 'dollah' ),
				'id'		=> 'columns',
				'type'		=> 'smallselect',
				'std'		=> '4',
				'options'	=> array(
					'1'	=> __( '1', 'dollah' ),
					'2'	=> __( '2', 'dollah' ),
					'3'	=> __( '3', 'dollah' ),
					'4'	=> __( '4', 'dollah' ),
					'5'	=> __( '5', 'dollah' ),
				),
			),
			array(
				'name'		=> __( 'Number of Posts to show', 'dollah' ),
				'desc'		=> __( 'Default: 4', 'dollah' ),
				'id'		=> 'count',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
			),
			array(
				'name'		=> __( 'Offset', 'dollah' ),
				'desc'		=> __( 'Number of posts to skip from the start. Leave empty to start from the latest post.', 'dollah' ),
				'id'		=> 'offset',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
			),
			array(
				'name'		=> __( 'Show Author', 'dollah' ),
				'id'		=> 'show_author',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Show Post Date', 'dollah' ),
				'id'		=> 'show_date',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Show number of comments', 'dollah' ),
				'id'		=> 'show_comments',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Show categories', 'dollah' ),
				'id'		=> 'show_cats',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Show tags', 'dollah' ),
				'id'		=> 'show_tags',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Content', 'dollah' ),
				'id'		=> 'fullcontent',
				'type'		=> 'select',
				'std'		=> 'excerpt',
				'options'	=> array(
					'excerpt'	=> __( 'Display Excerpt', 'dollah' ),
					'content'	=> __( 'Display Full Content', 'dollah' ),
					'none'		=> __( 'None', 'dollah' ),
				),
			),
			array(
				'name'		=> __( 'Custom Excerpt Length', 'dollah' ),
				'desc'		=> __( 'Leave empty to use the automatically created excerpts.', 'dollah' ),
				'id'		=> 'excerptlength',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
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

		$settings = apply_filters( 'dollah_content_posts_blocks_widget_settings', $settings );

		parent::__construct( $settings['id'], $settings['name'], $settings['widget_options'], $settings['control_options'], $settings['form_options'] );

	}

	/**
	 * Echo the widget content
	 */
	function display_widget( $instance, $before_title = '', $title='', $after_title = '' ) {
		extract( $instance, EXTR_SKIP );
		include( hybridextend_locate_widget( 'content-posts-blocks' ) ); // Loads the widget/content-posts-blocks or template-parts/widget-content-posts-blocks.php template.
	}

}

/**
 * Register Widget
 */
function dollah_content_posts_blocks_widget_register(){
	register_widget('Dollah_Content_Posts_Blocks_Widget');
}
add_action('widgets_init', 'dollah_content_posts_blocks_widget_register');