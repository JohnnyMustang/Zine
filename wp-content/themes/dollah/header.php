<!DOCTYPE html>
<html <?php language_attributes( 'html' ); ?> class="no-js">

<head>
<?php
// Fire the wp_head action required for hooking in scripts, styles, and other <head> tags.
wp_head();
?>
</head>

<body <?php hybridextend_attr( 'body' ); ?>>

	<?php
	// Displays a friendly note to visitors using outdated browser (Internet Explorer 8 or less)
	dollah_update_browser();

	// Display Topbar
	get_template_part( 'template-parts/topbar' );
	?>

	<div <?php hybridextend_attr( 'page-wrapper' ); ?>>

		<div class="skip-link">
			<a href="#content" class="screen-reader-text"><?php _e( 'Skip to content', 'dollah' ); ?></a>
		</div><!-- .skip-link -->

		<?php
		// Template modification Hook
		do_action( 'dollah_template_site_start' );
		?>

		<header <?php hybridextend_attr( 'header' ); ?>>

			<?php
			// Display Menu in Secondary Header Location
			dollah_header_menu( 'top' );
			?>

			<div <?php hybridextend_attr( 'header-part', 'primary' ); ?>>
				<div class="hgrid">
					<div class="table hgrid-span-12">
						<?php
						// Display Branding
						dollah_header_branding();

						// Display Primary Header location
						dollah_header_aside();
						?>
					</div>
				</div>
			</div>

			<?php
			// Display Menu in Secondary Header Location
			dollah_header_menu( 'bottom' );
			?>

		</header><!-- #header -->

		<?php hybridextend_get_sidebar( 'below-header' ); // Loads the template-parts/sidebar-below-header.php template. ?>

		<div <?php hybridextend_attr( 'main' ); ?>>
			<?php
			// Template modification Hook
			do_action( 'dollah_template_main_wrapper_start' );