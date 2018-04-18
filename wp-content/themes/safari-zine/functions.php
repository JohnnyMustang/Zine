<?php

  function scratch_setup() {
    add_theme_support('post-thumbnails');
    register_nav_menus(array('main-menu' => 'Main Menu'));
  }
  add_action('after_setup_theme', 'scratch_setup');

  function scratch_styles_and_scripts() {
    wp_enqueue_style('main-stylesheet', get_stylesheet_directory_uri() . '/styles.css');
    wp_enqueue_script('jquery');
    wp_enqueue_script('our-scripts', get_stylesheet_directory_uri() . '/script.js');
  }

  add_action('wp_enqueue_scripts', 'scratch_styles_and_scripts');

  // function create_footer_widgets() {
  //   register_sidebar(array(
  //     'name' => 'Footer Main',
  //     'id'   => 'footer-main',
  //     'before_widget' => '<div class="widget %2$s">',
  //     'after_widget' => '</div>'
  //   ));
  // }
  // add_action('widgets_init', 'create_footer_widgets');

  function fa($icon) {
    echo "<i class='fa fa-$icon'></i>";
  }
?>