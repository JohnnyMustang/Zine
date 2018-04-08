<?php
// Get total columns and set column counter
$columns = ( intval( $columns ) >= 1 && intval( $columns ) <= 3 ) ? intval( $columns ) : 1;

// Create a custom WP Query
$posts_per_page = 0;
for ( $ci = 1; $ci <= 3; $ci++ ) {
	${ 'count' . $ci } = intval( ${ 'count' . $ci } );
	${ 'count' . $ci } = empty( ${ 'count' . $ci } ) ? 3 : ${ 'count' . $ci };
	if ( $ci <= $columns )
		$posts_per_page += ${ 'count' . $ci };
}
$query_args = array();
$query_args['posts_per_page'] = $posts_per_page;
if ( $category )
	$query_args['category'] = $category;
if ( $offset )
	$query_args['offset'] = $offset;
$posts_list_query = get_posts( $query_args );

// Temporarily remove read more links from excerpts
if ( apply_filters( 'dollah_posts_list_remove_readmore', true ) )
	dollah_remove_readmore_link();

// Add Pagination
if ( !function_exists( 'dollah_posts_list_pagination' ) ) :
	function dollah_posts_list_pagination( $posts_list_query, $query_args ) {
		global $hybridext_currentwidget;
		$base_url = ( !empty( $query_args['category'] ) ) ?
					esc_url( get_category_link( $query_args['category'] ) ) :
					( ( get_option( 'page_for_posts' ) ) ?
						esc_url( get_permalink( get_option( 'page_for_posts' ) ) ) :
						esc_url( home_url('/') )
						);
		$class = !empty( $hybridext_currentwidget['instance']['viewall'] ) ? sanitize_html_class( 'view-all-' . $hybridext_currentwidget['instance']['viewall'] ) : '';
		echo '<div class="view-all ' . $class . '"><a href="' . $base_url . '">' . __( 'View All', 'dollah' ) . '</a></div>';
	}
endif;
if ( $viewall == 'top' ) {
	add_action( 'dollah_posts_list_start', 'dollah_posts_list_pagination', 10, 2 );
} elseif ( $viewall == 'bottom' ) {
	add_action( 'dollah_posts_list_end', 'dollah_posts_list_pagination', 10, 2 );
} else {
	remove_action( 'dollah_posts_list_start', 'dollah_posts_list_pagination', 10, 2 );
	remove_action( 'dollah_posts_list_end', 'dollah_posts_list_pagination', 10, 2 );
}

// Template modification Hook
do_action( 'dollah_posts_list_wrap', $posts_list_query, $query_args );
?>

<div class="posts-list-widget posts-list-<?php echo $style; ?>">

	<?php
	if ( $category ) {
		if ( !$title ) $title = get_cat_name( $category );
	}

	/* Display Title */
	if ( $title )
		echo wp_kses_post( apply_filters( 'dollah_posts_list_title', $before_title . $title . $after_title, $title, $before_title, $after_title ) );

	// Template modification Hook
	do_action( 'dollah_posts_list_start', $posts_list_query, $query_args );

	// Variables
	global $post;
	$postcount = $colcount = 1;
	$count = $count1;
	$lastclass = ( $colcount == $columns ) ? 'hcol-last' : '';
	?>

	<div class="posts-list-columns">
		<div class="<?php echo "hcolumn-1-{$columns} posts-list-column-1 hcol-first {$lastclass}"; ?>">
			<?php
			foreach ( $posts_list_query as $post ) :

				// Init
				setup_postdata( $post );
				$visual = ( has_post_thumbnail() ) ? 1 : 0;
				$metadisplay = array();

				if ( $postcount == 1 )
					$factor = ( !empty( $firstpost ) ) ? 'small' : 'large';
				else
					$factor = 'small';
				if ( !empty( $show_author ) ) $metadisplay[] = 'author';
				if ( !empty( $show_date ) ) $metadisplay[] = 'date';
				if ( !empty( $show_comments ) ) $metadisplay[] = 'comments';
				if ( !empty( $show_cats ) ) $metadisplay[] = 'cats';
				if ( !empty( $show_tags ) ) $metadisplay[] = 'tags';
				$showcontent = $show_content;
				$excerptlength = intval( $excerpt_length );

				$img_size = ( $factor == 'small' ) ? 'thumbnail' : 'hoot-medium-thumb';
				$img_size = apply_filters( 'dollah_posts_list_img', $img_size, $columns, $postcount, $factor );

				// Start Block Display
				$gridunit_attr = array();
				$gridunit_attr['class'] = "posts-listunit posts-listunit-{$factor}";
				$gridunit_attr['class'] .= ($visual) ? ' visual-img' : ' visual-none';
				$gridunit_attr['data-unitsize'] = $factor;
				$gridunit_attr['data-columns'] = $columns;
				?>

				<div <?php echo hybridextend_get_attr( 'posts-listunit', '', $gridunit_attr ) ?>>

					<?php
					if ( $visual ) :
						$imgclass = 'attachment-bg-' . sanitize_html_class( $img_size );
						?><div class="posts-listunit-image <?php echo $imgclass; ?>">
							<?php
							dollah_post_thumbnail( 'posts-listunit-img', $img_size, false, esc_url( get_permalink( $post->ID ) ) );
							?>
						</div><?php
					endif;
					?>

					<div class="posts-listunit-content">
						<h4 class="posts-listunit-title"><?php echo '<a href="' . esc_url( get_permalink() ) . '" ' . hybridextend_get_attr( 'posts-listunit-link', 'permalink' ) . '>';
							the_title();
							echo '</a>'; ?></h4>
						<?php
						if ( dollah_meta_info_display( $metadisplay, 'posts-listunit-' . $postcount, true ) ) {
							echo '<div class="posts-listunit-subtitle small">';
							dollah_meta_info_blocks( $metadisplay, 'posts-listunit-' . $postcount );
							echo '</div>';
						}
						if ( $showcontent == 'excerpt' ) {
							echo '<div class="posts-listunit-text posts-listunit-excerpt">';
							echo hybridextend_get_excerpt( $excerptlength );
							echo '</div>';
						} elseif ( $showcontent == 'content' ) {
							echo '<div class="posts-listunit-text posts-listunit-fulltext">';
							the_content();
							echo '</div>';
						}
						?>
					</div>

					<div class="clearfix"></div>
				</div><?php
				if ( $postcount == $count && $colcount < $columns ) {
					$colcount++;
					$count += ${ 'count' . $colcount };
					$lastclass = ( $colcount == $columns ) ? 'hcol-last' : '';
					echo "</div><div class='hcolumn-1-{$columns} posts-list-column-{$colcount} {$lastclass}'>";
				}
				$postcount++;

			endforeach;

			wp_reset_postdata();
			?>
		</div>
		<div class="clearfix"></div>
	</div>

	<?php
	// Template modification Hook
	do_action( 'dollah_posts_list_end', $posts_list_query, $query_args );
	?>

</div>

<?php
// Reinstate read more links to excerpts
if ( apply_filters( 'dollah_posts_list_remove_readmore', true ) )
	dollah_reinstate_readmore_link();