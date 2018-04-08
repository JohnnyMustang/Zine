<?php

// Template modification Hook
do_action( 'dollah_template_before_menu', 'secondary');

if ( has_nav_menu( 'hoot-secondary' ) ) : // Check if there's a menu assigned to the 'Header Secondary' location.

	?>
	<h3 class="screen-reader-text"><?php _e( 'Navigation Menu', 'dollah' ); ?></h3>
	<nav <?php hybridextend_attr( 'menu', 'secondary' ); ?>>
		<div class="menu-toggle"><span class="menu-toggle-text"><?php _e( 'Menu', 'dollah' ); ?></span><i class="fa fa-bars"></i></div>

		<?php
		/* Create Menu Args Array */
		$menu_args = array(
			'theme_location'  => 'hoot-secondary',
			'container'       => false,
			'menu_id'         => 'menu-secondary-items',
			'menu_class'      => 'menu-items sf-menu menu menu-highlight',
			'fallback_cb'     => '',
			'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			);

		/* Display Main Menu */
		wp_nav_menu( $menu_args ); ?>

	</nav><!-- #menu-secondary -->
	<?php

endif; // End check for menu.

// Template modification Hook
do_action( 'dollah_template_after_menu', 'secondary');