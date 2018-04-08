<?php
/**
 * Posts List Widget
 *
 * @package    Hoot
 * @subpackage Dollah
 */

/**
* Class Dollah_Posts_List_Widget
*/
class Dollah_Posts_List_Widget extends HybridExtend_WP_Widget {

	function __construct() {

		$settings['id'] = 'dollah-posts-list-widget';
		$settings['name'] = __( 'Hoot > Posts List', 'dollah' );
		$settings['widget_options'] = array(
			'description'	=> __('Display Posts List (all or specific category).', 'dollah'),
			// 'classname'		=> 'dollah-post-list-widget', // CSS class applied to frontend widget container via 'before_widget' arg
		);
		$settings['control_options'] = array();
		$settings['form_options'] = array(
			//'name' => can be empty or false to hide the name
			array(
				'name'		=> __( 'Title (Optional)', 'dollah' ),
				'desc'		=> __( 'Leave empty to display category name', 'dollah' ),
				'id'		=> 'title',
				'type'		=> 'text',
			),
			// array(
			// 	'name'		=> __('Title Background', 'dollah'),
			// 	'desc'		=> __('Leave empty to use default category colors.', 'dollah'),
			// 	'id'		=> 'title_bg',
			// 	// 'std'		=> '#aa0000',
			// 	'type'		=> 'color',
			// ),
			// array(
			// 	'name'		=> __('Title Font', 'dollah'),
			// 	'desc'		=> __('Leave empty to use default category colors.', 'dollah'),
			// 	'id'		=> 'title_font',
			// 	// 'std'		=> '#aa0000',
			// 	'type'		=> 'color',
			// ),
			array(
				'name'		=> __( 'List Style', 'dollah' ),
				'id'		=> 'style',
				'type'		=> 'images',
				'std'		=> 'style1',
				'options'	=> array(
					'style1'	=> HYBRIDEXTEND_INCURI . 'admin/images/posts-list-style-1.png',
					'style2'	=> HYBRIDEXTEND_INCURI . 'admin/images/posts-list-style-2.png',
					//'style3'	=> HYBRIDEXTEND_INCURI . 'admin/images/posts-list-style-3.png',
				),
			),
			// array(
			// 	'name'		=> __( 'List Style', 'dollah' ),
			// 	'id'		=> 'style',
			// 	'type'		=> 'smallselect',
			// 	'std'		=> 'style1',
			// 	'options'	=> array(
			// 		'style1'	=> __( 'Small Thumbnails', 'dollah' ),
			// 		'style2'	=> __( 'Large Thumbnails', 'dollah' ),
			// 	),
			// ),
			array(
				'name'		=> __( 'Category', 'dollah' ),
				'desc'		=> __( 'Leave empty to display posts from all categories.', 'dollah' ),
				'id'		=> 'category',
				'type'		=> 'select',
				'options'	=> array( '0' => '' ) + HybridExtend_WP_Widget::get_tax_list('category') ,
			),
			array(
				'name'		=> __( 'No. Of Columns', 'dollah' ),
				'id'		=> 'columns',
				'type'		=> 'smallselect',
				'std'		=> '1',
				'options'	=> array(
					'1'	=> __( '1', 'dollah' ),
					'2'	=> __( '2', 'dollah' ),
					'3'	=> __( '3', 'dollah' ),
				),
			),
			array(
				'name'		=> __( 'Number of Posts - 1st Column', 'dollah' ),
				'desc'		=> __( 'Default: 3', 'dollah' ),
				'id'		=> 'count1',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
			),
			array(
				'name'		=> __( 'Number of Posts - 2nd Column', 'dollah' ),
				'desc'		=> __( 'Default: 3<br>(if selected 2 or 3 columns above)', 'dollah' ),
				'id'		=> 'count2',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
			),
			array(
				'name'		=> __( 'Number of Posts - 3rd Column', 'dollah' ),
				'desc'		=> __( 'Default: 3<br>(if selected 3 columns above)', 'dollah' ),
				'id'		=> 'count3',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
			),
			array(
				'name'		=> __( 'Skip Posts', 'dollah' ),
				'desc'		=> __( 'Number of posts to skip from start (By default, the list starts from latest post)', 'dollah' ),
				'id'		=> 'offset',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
			),
			array(
				'name'		=> __( "'View All Posts' link", 'dollah' ),
				'desc'		=> __( 'Links to your Blog page. If you have a Category selected above, then this will link to the Category Archive page.', 'dollah' ),
				'id'		=> 'viewall',
				'type'		=> 'select',
				'std'		=> 'none',
				'options'	=> array(
					'none'		=> __( 'Do not display', 'dollah' ),
					'top'		=> __( 'Show at Top', 'dollah' ),
					'bottom'	=> __( 'Show at Bottom', 'dollah' ),
				),
			),
			array(
				'name'		=> __( 'Individual Posts:', 'dollah' ),
				// 'desc'		=> __( 'INDIVIDUAL POSTS', 'dollah' ),
				'id'		=> 'seppost',
				'type'		=> 'separator',
			),
			array(
				'name'		=> __( 'Display First Post as Standard Size', 'dollah' ),
				'desc'		=> __( 'By default, first post is displayed bigger in size compared to other posts.', 'dollah' ),
				'id'		=> 'firstpost',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Show Author', 'dollah' ),
				'id'		=> 'show_author',
				'type'		=> 'checkbox',
				'std'		=> 1,
			),
			array(
				'name'		=> __( 'Show Post Date', 'dollah' ),
				'id'		=> 'show_date',
				'type'		=> 'checkbox',
				'std'		=> 1,
			),
			array(
				'name'		=> __( 'Show number of comments', 'dollah' ),
				'id'		=> 'show_comments',
				'type'		=> 'checkbox',
			),
			array(
				'name'		=> __( 'Show Categories', 'dollah' ),
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
				'id'		=> 'show_content',
				'type'		=> 'select',
				'std'		=> 'none',
				'options'	=> array(
					'excerpt'	=> __( 'Display Excerpt', 'dollah' ),
					'content'	=> __( 'Display Full Content', 'dollah' ),
					'none'		=> __( 'None', 'dollah' ),
				),
			),
			array(
				'name'		=> __( 'Custom Excerpt Length', 'dollah' ),
				'desc'		=> __( 'Leave empty to use default excerpt length', 'dollah' ),
				'id'		=> 'excerpt_length',
				'type'		=> 'text',
				'settings'	=> array( 'size' => 3, ),
				'sanitize'	=> 'absint',
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

		$settings = apply_filters( 'dollah_posts_list_widget_settings', $settings );

		parent::__construct( $settings['id'], $settings['name'], $settings['widget_options'], $settings['control_options'], $settings['form_options'] );

	}

	/**
	 * Echo the widget content
	 */
	function display_widget( $instance, $before_title = '', $title='', $after_title = '' ) {
		extract( $instance, EXTR_SKIP );
		include( hybridextend_locate_widget( 'posts-list' ) ); // Loads the widget/post-list or template-parts/widget-posts-list.php template.
	}

}

/**
 * Register Widget
 */
function dollah_posts_list_widget_register(){
	register_widget('Dollah_Posts_List_Widget');
}
add_action('widgets_init', 'dollah_posts_list_widget_register');