<?php
// Get border classes
$top_class = dollah_widget_border_class( $border, 0, 'topborder-');
$bottom_class = dollah_widget_border_class( $border, 1, 'bottomborder-');

// Get custom style attribute
$mt = ( !isset( $customcss['mt'] ) ) ? '' : $customcss['mt'];
$mb = ( !isset( $customcss['mb'] ) ) ? '' : $customcss['mb'];
$custommargin = dollah_widget_margin_style( $mt, $mb );

// Get total columns and set column counter
$columns = ( intval( $columns ) >= 1 && intval( $columns ) <= 5 ) ? intval( $columns ) : 3;
$column = 1;

// Set clearfix to avoid error if there are no boxes
$clearfix = 1;

// Create a custom WP Query
$query_args = array();
$count = intval( $count );
$query_args['posts_per_page'] = ( empty( $count ) ) ? 4 : $count;
$offset = intval( $offset );
if ( $offset )
	$query_args['offset'] = $offset;
if ( $category )
	$query_args['category'] = $category;
$content_blocks_query = get_posts( $query_args );

// Temporarily remove read more links from excerpts
dollah_remove_readmore_link();
$excerptlength = intval( $excerptlength );

// Template modification Hook
do_action( 'dollah_content_blocks_wrap', 'posts', $content_blocks_query, $query_args );
?>

<div class="content-blocks-widget-wrap content-blocks-posts <?php echo sanitize_html_class( $top_class ); ?>">
	<div class="content-blocks-widget-box <?php echo sanitize_html_class( $bottom_class ); ?>">
		<div class="content-blocks-widget" <?php echo $custommargin; ?>>

			<?php
			/* Display Title */
			if ( $title )
				echo wp_kses_post( apply_filters( 'dollah_content_blocks_title', $before_title . $title . $after_title, $title, $before_title, $after_title ) );

			// Template modification Hook
			do_action( 'dollah_content_blocks_start', 'posts', $content_blocks_query, $query_args );
			?>

			<div class="flush-columns">
				<?php
						global $post;
						$fullcontent = ( empty( $fullcontent ) ) ? 'excerpt' :
										( ( $fullcontent === 1 ) ? 'content' : $fullcontent ); // Backward Compatible

						foreach ( $content_blocks_query as $post ) :

								// Init
								setup_postdata( $post );
								$visual = $visualtype = '';

								// Set image or icon
								if ( has_post_thumbnail() ) {
									$visualtype = 'image';
									if ( $style == 'style4' ) {
										switch ( $columns ) {
											case 1: $img_size = 2; break;
											case 2: $img_size = 4; break;
											default: $img_size = 5;
										}
									} else {
										$img_size = $columns;
									}
									$img_size = dollah_thumbnail_size( 'column-1-' . $img_size );
									$img_size = apply_filters( 'dollah_content_posts_block_img', $img_size, $columns, $style );
									$visual = 1;
								}

								// Set Block Class (if no visual for style 2/3, then dont highlight)
								$block_class = ( !empty( $visual ) && ( $style == 'style2' || $style == 'style3' ) ) ? 'highlight-typo' : 'no-highlight';
								$column_class = ( !empty( $visualtype ) ) ? "visual-{$visualtype}" : 'visual-none';

								// Set URL
								$linktag = '<a href="' . esc_url( get_permalink() ) . '" ' . hybridextend_get_attr( 'content-block-link', 'permalink' ) . '>';
								$linktagend = '</a>';

								// Start Block Display
								if ( $column == 1 ) echo '<div class="content-block-row">';
								?>

								<div class="content-block-column <?php echo 'hcolumn-1-' . $columns; ?> <?php echo sanitize_html_class( 'content-block-' . $style ) . ' ' . $column_class; ?>">
									<div class="content-block <?php echo $block_class; ?>">

										<?php if ( $visualtype == 'image' ) : ?>
											<div class="content-block-visual content-block-image">
												<?php echo $linktag;
												dollah_post_thumbnail( 'content-block-img', $img_size );
												echo $linktagend; ?>
											</div>
										<?php endif; ?>

										<div class="content-block-content<?php
											if ( $visualtype == 'image' ) echo ' content-block-content-hasimage';
											else echo ' no-visual';
											?>">
											<h4 class="content-block-title"><?php echo $linktag;
												the_title();
												echo $linktagend; ?></h4>
											<?php $metadisplay = array(); $metacontext = '';
											if ( !empty( $show_author ) ) $metadisplay[] = 'author';
											if ( !empty( $show_date ) ) $metadisplay[] = 'date';
											if ( !empty( $show_comments ) ) $metadisplay[] = 'comments';
											if ( !empty( $show_cats ) ) { $metadisplay[] = 'cats'; $metacontext .= 'cats,'; }
											if ( !empty( $show_tags ) ) { $metadisplay[] = 'tags'; $metacontext .= 'tags,'; }
											if ( dollah_meta_info_display( $metadisplay, $metacontext, true ) ) {
												echo '<div class="content-block-subtitle small">';
												dollah_meta_info_blocks( $metadisplay, $metacontext );
												echo '</div>';
											} ?>
											<?php
											if ( $fullcontent === 'content' ) {
												echo '<div class="content-block-text">';
												the_content();
												echo '</div>';
											} elseif( $fullcontent === 'excerpt' ) {
												echo '<div class="content-block-text">';
												if( !empty( $excerptlength ) )
													echo hybridextend_get_excerpt( $excerptlength );
												else
													the_excerpt();
												echo '</div>';
											}
											?>
										</div>

									</div>
									<?php if ( $fullcontent === 'excerpt' ) : ?>
										<?php
										$linktext = dollah_get_mod('read_more');
										$linktext = ( empty( $linktext ) ) ? sprintf( __( 'Read More %s', 'dollah' ), '&rarr;' ) : $linktext;
										echo '<p class="more-link">' . $linktag . esc_html( $linktext ) . $linktagend . '</p>';
										?>
									<?php endif; ?>
								</div><?php

								if ( $column == $columns ) {
									echo '</div>';
									$column = $clearfix = 1;
								} else {
									$clearfix = false;
									$column++;
								}

						endforeach;

						wp_reset_postdata();

				if ( !$clearfix ) echo '</div>';
				?>
			</div>

			<?php
			// Template modification Hook
			do_action( 'dollah_content_blocks_end', 'posts', $content_blocks_query, $query_args );
			?>

		</div>
	</div>
</div>

<?php
// Reinstate read more links to excerpts
dollah_reinstate_readmore_link();