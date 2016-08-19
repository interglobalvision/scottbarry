<?php
get_header();

$content_two = get_post_meta($post->ID, '_igv_content_two', true);
?>

<!-- main content -->

<main id="main-content" class="margin-bottom-large padding-top-large">

  <!-- main posts loop -->
  <section id="page" class="container">

    <article <?php post_class('row font-size-mid font-serif'); ?>>
      <div class="col col-s-12 col-m-6 col-l-5 offset-l-1">
        <?php the_content(); ?>
      </div>
      <div class="col col-s-12 col-m-6 col-l-5">
        <?php 
          if (!empty($content_two)) {
            echo apply_filters('the_content', $content_two);
          }
        ?>
      </div>
    </article>

  <!-- end posts -->
  </section>

  <?php get_template_part('partials/pagination'); ?>

<!-- end main-content -->

</main>

<?php
get_footer();
?>