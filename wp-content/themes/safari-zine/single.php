<?php get_header(); ?>

<?php while(have_posts()): the_post(); ?>
  <?php if(has_post_thumbnail()): ?>
    <div id="banner" style="background-image: url(<?php the_post_thumbnail_url() ?>);">
      <div class="banner-image-wrapper flex vertically-centered">
        <img class="banner-image" src="<?php the_post_thumbnail_url() ?>">
      </div>
    </div>
  <?php endif; ?>
  
  <main id="page" class="single page-width">
    <?php 
      $author_id  = get_the_author_meta('ID');
      $author_url = get_author_posts_url($author_id);
      $avatar     = get_wp_user_avatar_src($author_id);
      $tags       = get_the_tags();
    ?>

    <div class="meta-wrapper flex vertically-centered one-growing-element">
      <div class="title-and-excerpt grows">
        <h1 class="title"><?php the_title() ?></h1>
        <p class="excerpt"><?php echo get_the_excerpt() ?></p>
      </div>

      <div class="meta flex vertically-centered one-growing-element">
        <div class="meta-text">
          <div class="author has-invisible-links">
            <a href="<?php echo $author_url ?>">
              Written by <?php the_author() ?>
            </a>
          </div>

          <div class="date">
            <?php the_date() ?>
          </div>
        </div>
        <div class="avatar-block invisible-links">
          <a href="<?php echo $author_url ?>">
            <img class="avatar" src="<?php echo $avatar ?>">
          </a>
        </div>
      </div>
    </div>

    <div class="small-divider"></div>

    <p class="content"><?php the_content() ?></p>
  </main>
<?php endwhile; ?>

<?php get_footer();?>