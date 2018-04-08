<?php
/**
 * Premium Theme Options displayed in admin
 *
 * @package    Hoot
 * @subpackage Dollah
 * @return array Return Hoot Options array to be merged to the original Options array
 */

$dollah_options_premium = array();
$imagepath =  HYBRIDEXTEND_INCURI . 'admin/images/';
$dollah_cta_top = '<a class="button button-primary button-buy-premium" href="https://wphoot.com/themes/dollah/" target="_blank">' . __( 'Click here to know more', 'dollah' ) . '</a>';
$dollah_cta_top = $dollah_cta = '<a class="button button-primary button-buy-premium" href="https://wphoot.com/themes/dollah/" target="_blank">' . __( 'Buy Dollah Premium', 'dollah' ) . '</a>';
$dollah_cta_demo = '<a class="button button-secondary button-view-demo" href="https://demo.wphoot.com/dollah/" target="_blank">' . __( 'View Demo Site', 'dollah' ) . '</a>';
$dollah_cta_url = 'https://wphoot.com/themes/dollah/';
$dollah_cta_demo_url = 'https://demo.wphoot.com/dollah/';

$dollah_intro = array(
	'name' => __('Upgrade to <span>Dollah <strong>Premium</strong></span>', 'dollah'),
	'desc' => __("If you've enjoyed using Dollah, you're going to love <strong>Dollah Premium</strong>.<br>It's a robust upgrade to Dollah that gives you many useful features.", 'dollah'),
	);

$dollah_options_premium[] = array(
	'name' => __('Complete <br />Style <strong>Customization</strong>', 'dollah'),
	'desc' => __('Different looks and styles. Choose from an extensive range of customization features in Dollah Premium to setup your own unique front page. Give youe site the personality it deserves.', 'dollah'),
	// 'img' => $imagepath . 'premium-style.jpg',
	'style' => 'hero-top',
	);

$dollah_options_premium[] = array(
	'name' => __('Unlimited Colors', 'dollah'),
	'desc' => __('Dollah Premium lets you select unlimited colors for different sections of your site. Select pre-existing backgrounds for site sections like header, footer etc. or upload your own background images/patterns.', 'dollah'),
	'img' => $imagepath . 'premium-colors.jpg',
	);

$dollah_options_premium[] = array(
	'name' => __('Fonts and <span>Typography Control</span>', 'dollah'),
	'desc' => __('Assign different typography (fonts, text size, font color) to menu, topbar, logo, content headings, sidebar, footer etc.', 'dollah'),
	'img' => $imagepath . 'premium-typography.jpg',
	);

$dollah_options_premium[] = array(
	'name' => __('Unlimites Sliders, Unlimites Slides', 'dollah'),
	'desc' => __('Dollah Premium allows you to create unlimited sliders with as many slides as you need.<hr>You can use these sliders on your Frontpage, or add them anywhere using shortcodes - like in your Posts, Sidebars or Footer.', 'dollah'),
	'img' => $imagepath . 'premium-sliders.jpg',
	);

$dollah_options_premium[] = array(
	'name' => __('600+ Google Fonts', 'dollah'),
	'desc' => __("With the integrated Google Fonts library, you can find the fonts that match your site's personality, and there's over 600 options to choose from.", 'dollah'),
	'img' => $imagepath . 'premium-googlefonts.jpg',
	);

$dollah_options_premium[] = array(
	'name' => __('Shortcodes with <span>Easy Generator</span>', 'dollah'),
	'desc' => __('Enjoy the flexibility of using shortcodes throughout your site with Dollah premium. These shortcodes were specially designed for this theme and are very well integrated into the code to reduce loading times, thereby maximizing performance!<hr>Use shortcodes to insert buttons, sliders, tabs, toggles, columns, breaks, icons, lists, and a lot more design and layout modules.<hr>The intuitive Shortcode Generator has been built right into the Edit screen, so you dont have to hunt for shortcode syntax.', 'dollah'),
	'img' => $imagepath . 'premium-shortcodes.jpg',
	);

$dollah_options_premium[] = array(
	'name' => __('Image Carousels', 'dollah'),
	'desc' => __('Add carousels to your post, in your sidebar, on your frontpage or in your footer. A simple drag and drop interface allows you to easily create and manage carousels.', 'dollah'),
	'img' => $imagepath . 'premium-carousels.jpg',
	);

$dollah_options_premium[] = array(
	'name' => __("Floating <br /><span>'Sticky' Header</span> &amp; <span>'Goto Top'</span> button (optional)", 'dollah'),
	'desc' => __("The floating header follows the user down your page as they scroll, which means they never have to scroll back up to access your navigation menu, improving user experience.<hr>Or, use the 'Goto Top' button appears on the screen when users scroll down your page, giving them a quick way to go back to the top of the page.", 'dollah'),
	'img' => $imagepath . 'premium-header-top.jpg',
	);

$dollah_options_premium[] = array(
	'name' => __('One Page <span>Scrolling Website /</span> <span>Landing Page</span>', 'dollah'),
	'desc' => __("Make One Page websites with menu items linking to different sections on the page. Watch the scroll animation kick in when a user clicks a menu item to jump to a page section.<hr>Create different landing pages on your site. Change the menu for each page so that the menu items point to sections of the page being displayed.", 'dollah'),
	'img' => $imagepath . 'premium-scroller.jpg',
	'style' => 'side',
	);

$dollah_options_premium[] = array(
	'name' => __('3 Blog Layouts (including pinterest <span>type mosaic)</span>', 'dollah'),
	'desc' => __('Dollah Premium gives you the option to display your post archives in 3 different layouts including a mosaic type layout similar to pinterest.', 'dollah'),
	'img' => $imagepath . 'premium-blogstyles.jpg',
	);

$dollah_options_premium[] = array(
	'name' => __('Custom Widgets', 'dollah'),
	'desc' => __('Custom widgets crafted and designed specifically for Dollah Premium Theme to give you the flexibility of adding stylized content.', 'dollah'),
	'img' => $imagepath . 'premium-widgets.jpg',
	);

$dollah_options_premium[] = array(
	'name' => __('Menu Icons', 'dollah'),
	'desc' => __('Select from over 500 icons for your main navigation menu links.', 'dollah'),
	'img' => $imagepath . 'premium-menuicons.jpg',
	);

$dollah_options_premium[] = array(
	'name' => __('Premium Background Patterns (CC0)', 'dollah'),
	'desc' => __('Dollah Premium comes with many additional premium background patterns. You can always upload your own background image/pattern to match your site design.', 'dollah'),
	'img' => $imagepath . 'premium-backgrounds.jpg',
	);

$dollah_options_premium[] = array(
	'name' => __('Automatic Image Lightbox and <span>WordPress Gallery</span>', 'dollah'),
	'desc' => __('Automatically open image links on your site with the integrates lightbox in Dollah Premium.<hr>Automatically convert standard WordPress galleries to beautiful lightbox gallery slider.', 'dollah'),
	'img' => $imagepath . 'premium-lightbox.jpg',
	);

$dollah_options_premium[] = array(
	'name' => __('Developers <br />love {LESS}', 'dollah'),
	'desc' => __('CSS is passe. Developers love the modularity and ease of using LESS, which is why Dollah Premium comes with properly organized LESS files for the main stylesheet.', 'dollah'),
	'img' => $imagepath . 'premium-lesscss.jpg',
	);

$dollah_options_premium[] = array(
	'name' => __('Easy Import/Export', 'dollah'),
	'desc' => __('Moving to a new host? Or applying a new child theme? Easily import/export your customizer settings with just a few clicks - right from the backend.', 'dollah'),
	'img' => $imagepath . 'premium-import-export.jpg',
	);

$dollah_options_premium[] = array(
	'style' => 'aside',
	'blocks' => array(
		array(
			'name' => __('Custom Javascript &amp; <span>Google Analytics</span>', 'dollah'),
			'desc' => __("Easily insert any javascript snippet to your header without modifying the code files. This helps in adding scripts for Google Analytics, Adsense or any other custom code.", 'dollah'),
			'img' => $imagepath . 'premium-customjs.jpg',
			),
		array(
			'name' => __('Continued <br />Updates', 'dollah'),
			'desc' => __("You will help support the continued development of Dollah - ensuring it works with future versions of WordPress for years to come.", 'dollah'),
			'img' => $imagepath . 'premium-updates.jpg',
			),
		),
	);

$dollah_options_premium[] = array(
	'name' => __('Premium <br />Priority Support', 'dollah'),
	'desc' => __("Need help setting up Dollah? Upgrading to Dollah Premium gives you prioritized support. We have a growing support team ready to help you with your questions.<hr>Need small modifications? If you are not a developer yourself, you can count on our support staff to help you with CSS snippets to get the look you're after.", 'dollah'),
	'img' => $imagepath . 'premium-support.jpg',
	);