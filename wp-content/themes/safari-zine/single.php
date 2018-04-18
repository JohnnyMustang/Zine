<?php get_header(); ?>

  <?php while(have_posts()): the_post(); ?>
    <a><?php the_content(); ?></a>
  <?php endwhile; ?>

<?php get_footer();?>