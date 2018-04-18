<?php get_header(); ?>

<main id="page" class="page-width">
  <?php while(have_posts()): the_post(); ?>
    <a><?php the_content(); ?></a>
  <?php endwhile; ?>
</main>

<?php get_footer();?>