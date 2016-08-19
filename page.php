<?php
get_header();

$content_two = get_post_meta($post->ID, '_igv_content_two', true);
?>

<!-- main content -->

<main id="main-content" class="margin-bottom-large padding-top-large">

  <!-- main posts loop -->
  <section id="page" class="container">

    <article <?php post_class('row font-size-mid'); ?>>
      <div class="col col-s-12 col-m-6 p-line-length">
        <?php the_content(); ?>
      </div>
      <div class="col col-s-12 col-m-6 p-line-length">
        <?php 
          if (!empty($content_two)) {
            echo apply_filters('the_content', $content_two);
          }
        ?>
      </div>
    </article>

  <!-- end posts -->
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>