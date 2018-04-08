<?php
/**
 * Upsell page
 *
 * @package    Hoot
 * @subpackage Dollah
 */

/** Determine whether to load upsell subpage **/
$premium_features_file = HYBRIDEXTEND_INC . 'admin/premium.php';
$dollah_load_upsell_subpage = apply_filters( 'dollah_load_upsell_subpage', file_exists( $premium_features_file ) );
if ( !$dollah_load_upsell_subpage )
	return;

/* Add the admin setup function to the 'admin_menu' hook. */
add_action( 'admin_menu', 'dollah_appearance_subpage' );

/**
 * Unload the upsell section
 *
 * @since 1.2
 * @access public
 * @return void
 */
function dollah_unload_upsell_section( $val ) {
	return false;
}
add_filter( 'dollah_customize_load_premiumsection', 'dollah_unload_upsell_section' );

/**
 * Sets up the Appearance Subpage
 *
 * @since 1.0
 * @access public
 * @return void
 */
function dollah_appearance_subpage() {

	add_theme_page(
		__( 'Dollah Premium', 'dollah' ),	// Page Title
		__( 'Premium Options', 'dollah' ),	// Menu Title
		'edit_theme_options',					// capability
		'dollah-premium',						// menu-slug
		'dollah_theme_appearance_subpage'			// function name
		);

	add_action( 'admin_enqueue_scripts', 'dollah_admin_enqueue_upsell_styles' );

}

/**
 * Enqueue CSS
 *
 * @since 1.0
 * @access public
 * @return void
 */
function dollah_admin_enqueue_upsell_styles( $hook ) {
	if ( $hook == 'appearance_page_dollah-premium' )
		wp_enqueue_style( 'dollah-admin-upsell', HYBRIDEXTEND_INCURI . 'admin/css/upsell.css', array(),  HYBRIDEXTEND_VERSION );
}

/**
 * Display the Appearance Subpage
 *
 * @since 1.0
 * @access public
 * @return void
 */
function dollah_theme_appearance_subpage() {
	/** Load Premium Features Data **/
	include( HYBRIDEXTEND_INC . 'admin/premium.php' );

	/** Display Premium Teasers **/
	$dollah_cta = ( empty( $dollah_cta ) ) ? '<a class="button button-primary button-buy-premium" href="https://wphoot.com/" target="_blank">' . __( 'Click here', 'dollah' ) . '</a>' : $dollah_cta;
	$dollah_cta_top = ( empty( $dollah_cta_top ) ) ? $dollah_cta : $dollah_cta_top;
	$dollah_intro = ( !empty( $dollah_intro ) && is_array( $dollah_intro ) ) ? $dollah_intro : array();
	$dollah_intro = wp_parse_args( $dollah_intro, array(
		'name' => __('Upgrade to Premium', 'dollah'),
		'desc' => '',
		) );
	?>
	<div id="dollah-upsell" class="wrap">
		<h1 class="centered"><?php echo $dollah_intro['name']; ?></h1>
		<p class="dollah-upsell-intro centered"><?php echo $dollah_intro['desc']; ?></p>
		<p class="dollah-upsell-cta centered"><?php if ( !empty( $dollah_cta_demo ) ) echo $dollah_cta_demo; echo $dollah_cta_top; ?></p>
		<?php if ( !empty( $dollah_options_premium ) && is_array( $dollah_options_premium ) ): ?>
			<div class="dollah-upsell-sub">
				<?php foreach ( $dollah_options_premium as $key => $feature ) : ?>
					<?php $style = empty( $feature['style'] ) ? 'info' : $feature['style']; ?>
					<div class="section-premium <?php
						if ( $style == 'hero-top' || $style == 'hero-bottom' ) echo "premium-hero premium-{$style}";
						elseif ( $style == 'side' ) echo 'premium-sideinfo';
						elseif ( $style == 'aside' ) echo 'premium-asideinfo';
						else echo "premium-{$style}";
						?>">

						<?php if ( $style == 'hero-top' || $style == 'hero-bottom' ) : ?>
							<?php if ( $style == 'hero-top' ) : ?>
								<h4 class="heading"><?php echo $feature['name']; ?></h4>
								<?php if ( !empty( $feature['desc'] ) ) echo '<div class="premium-hero-text">' . $feature['desc'] . '</div>'; ?>
							<?php endif; ?>
							<?php if ( !empty( $feature['img'] ) ) : ?>
								<div class="premium-hero-img">
									<img src="<?php echo esc_url( $feature['img'] ); ?>" />
								</div>
							<?php endif; ?>
							<?php if ( $style == 'hero-bottom' ) : ?>
								<h4 class="heading"><?php echo $feature['name']; ?></h4>
								<?php if ( !empty( $feature['desc'] ) ) echo '<div class="premium-hero-text">' . $feature['desc'] . '</div>'; ?>
							<?php endif; ?>

						<?php elseif ( $style == 'side' ) : ?>
							<div class="premium-side-wrap">
								<div class="premium-side-img">
									<img src="<?php echo esc_url( $feature['img'] ); ?>" />
								</div>
								<div class="premium-side-textblock">
									<?php if ( !empty( $feature['name'] ) ) : ?>
										<h4 class="heading"><?php echo $feature['name']; ?></h4>
									<?php endif; ?>
									<?php if ( !empty( $feature['desc'] ) ) echo '<div class="premium-side-text">' . $feature['desc'] . '</div>'; ?>
								</div>
								<div class="clear"></div>
							</div>

						<?php elseif ( $style == 'aside' ) : ?>
							<?php if ( !empty( $feature['blocks'] ) ) : ?>
								<div class="premium-aside-wrap">
								<?php foreach ( $feature['blocks'] as $key => $block ) {
									echo '<div class="premium-aside-block premium-aside-'.($key+1).'">';
										if ( !empty( $block['img'] ) ) : ?>
											<div class="premium-aside-img">
												<img src="<?php echo esc_url( $block['img'] ); ?>" />
											</div>
										<?php endif;
										if ( !empty( $block['name'] ) ) : ?>
											<h4 class="heading"><?php echo $block['name']; ?></h4>
										<?php endif;
										if ( !empty( $block['desc'] ) ) echo '<div class="premium-aside-text">' . $block['desc'] . '</div>';
									echo '</div>';
								} ?>
								<div class="clear"></div>
								</div>
							<?php endif; ?>

						<?php else : ?>
							<?php if ( !empty( $feature['img'] ) ) : ?>
								<div class="premium-info-img">
									<img src="<?php echo esc_url( $feature['img'] ); ?>" />
								</div>
							<?php endif; ?>
							<div class="premium-info-textblock">
								<?php if ( !empty( $feature['name'] ) ) : ?>
									<div class="premium-info-heading"><h4 class="heading"><?php echo $feature['name']; ?></h4></div>
								<?php endif; ?>
								<?php if ( !empty( $feature['desc'] ) ) echo '<div class="premium-info-text">' . $feature['desc'] . '</div>'; ?>
								<div class="clear"></div>
							</div>
						<?php endif; ?>
					</div>
				<?php endforeach; ?>
				<div class="section-premium dollah-upsell-cta centered"><?php if ( !empty( $dollah_cta_demo ) ) echo $dollah_cta_demo; echo $dollah_cta; ?></p>
			</div>
		<?php endif; ?>
		<a class="dollah-premium-top" href="#wpbody"><span class="dashicons dashicons-arrow-up-alt"></span></a>
	</div>
	<?php
}