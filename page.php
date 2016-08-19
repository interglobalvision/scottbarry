<?php
get_header();
?>

<!-- main content -->

<main id="main-content" class="margin-bottom-large padding-top-large">

  <!-- main posts loop -->
  <section id="page" class="container">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $content_two = get_post_meta($post->ID, '_igv_content_two', true);
?>

      <article <?php post_class('row font-size-mid font-serif'); ?>>
        <div class="col col-s-12 col-m-6 col-l-4 offset-l-2">
          <?php the_content(); ?>
        </div>
        <div class="col col-s-12 col-m-6 col-l-4 offset-l-2">
          <?php 
            if (!empty($content_two)) {
              echo apply_filter('the_content', $content_two);
            }
          ?>
        </div>
      </article>


<?php
  }
}
?>
  <!-- end posts -->
  </section>

  <?php get_template_part('partials/pagination'); ?>

<!-- end main-content -->

</main>

<?php
get_footer();
?>