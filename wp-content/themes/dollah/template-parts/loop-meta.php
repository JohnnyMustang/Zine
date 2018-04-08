<?php
/**
 * Template modification Hooks
 */
$display_loop_meta = apply_filters( 'dollah_display_loop_meta', true );
do_action ( 'dollah_default_loop_meta', 'start' );

if ( !$display_loop_meta )
	return;

/**
 * If viewing a multi post page 
 */
if ( !is_front_page() && !is_singular() && !hybridextend_is_404() ) :

	$display_title = apply_filters( 'dollah_loop_meta_display_title', true, 'plural' );
	if ( $display_title !== 'hide' ) :
	?>

		<div <?php hybridextend_attr( 'loop-meta-wrap', 'archive' ); ?>>
			<div class="hgrid">

				<div <?php hybridextend_attr( 'loop-meta', 'archive', 'hgrid-span-12' ); ?>>

					<h1 <?php hybridextend_attr( 'loop-title', 'archive' ); ?>><?php echo get_the_archive_title(); // Displays title for archive type (multi post) pages. ?></h1>

					<?php if ( $desc = get_the_archive_description() ) : ?>
						<div <?php hybridextend_attr( 'loop-description', 'archive' ); ?>>
							<?php echo $desc; // Displays description for archive type (multi post) pages. ?>
						</div><!-- .loop-description -->
					<?php endif; // End paged check. ?>

				</div><!-- .loop-meta -->

			</div>
		</div>

	<?php
	endif;

/**
 * If viewing a single post/page (including frontpage not using Widgetized Template :redundant)
 */
elseif ( is_singular() && !hybridextend_is_404() ) :

	if ( have_posts() ) :

		// Begins the loop through found posts, and load the post data.
		while ( have_posts() ) : the_post();

			$display_title = apply_filters( 'dollah_loop_meta_display_title', '', 'singular' );
			if ( $display_title !== 'hide' ) :
			?>

				<div <?php hybridextend_attr( 'loop-meta-wrap', 'singular' ); ?>>
					<div class="hgrid">

						<div <?php hybridextend_attr( 'loop-meta', '', 'hgrid-span-12' ); ?>>
							<div class="entry-header">

								<?php
								global $post;
								$pretitle = ( !isset( $post->post_parent ) || empty( $post->post_parent ) ) ? '' : '<span class="loop-pretitle">' . get_the_title( $post->post_parent ) . ' &raquo; </span>';
								$pretitle = apply_filters( 'dollah_loop_pretitle_singular', $pretitle );
								?>
								<h1 <?php hybridextend_attr( 'loop-title' ); ?>><?php the_title( $pretitle ); ?></h1>

								<?php
								$hide_meta_info = apply_filters( 'dollah_hide_meta_info', false, 'top' );
								if ( !$hide_meta_info && 'top' == dollah_get_mod( 'post_meta_location' ) && !is_attachment() ):
									$metarray = ( is_page() ) ? dollah_get_mod('page_meta') : dollah_get_mod('post_meta');
									if ( dollah_meta_info_display( $metarray, 'loop-meta', true ) ) :
										?><div <?php hybridextend_attr( 'loop-description' ); ?>><?php
											dollah_meta_info_blocks( $metarray, 'loop-meta' );
										?></div><!-- .loop-description --><?php
									endif;
								endif;
								?>

							</div><!-- .entry-header -->
						</div><!-- .loop-meta -->

					</div>
				</div>

			<?php
			endif;

		endwhile;
		rewind_posts();

	endif;

endif;

/**
 * Template modification Hooks
 */
do_action ( 'dollah_default_loop_meta', 'end' );