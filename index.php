<?php
get_header();
?>

<!-- main content -->

<main id="main-content">

  <!-- main posts loop -->
  <section id="posts" class="container">
    <div class="row">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $single_row = get_post_meta($post->ID, '_igv_single_row', true);
    $percent_width = get_post_meta($post->ID, '_igv_percent_width', true);
    $percent_rotate = get_post_meta($post->ID, '_igv_percent_rotate', true);

    $single_row = empty($single_row) ? '' : $single_row;
    $percent_width = empty($percent_width) ? '100' : $percent_width;
    $percent_rotate = empty($percent_rotate) ? '0' : $percent_rotate;
?>

      <article <?php 
        if ($single_row == 'on') {
          post_class('text-align-center col col-s-12'); 
        } else {
          post_class('text-align-center col col-s-12 col-m-6');
        }
      ?> id="post-<?php the_ID(); ?>">

        <a href="<?php the_permalink() ?>">
          <?php the_post_thumbnail('gallery', array('style'=>'max-width: ' . $percent_width . '%; transform: rotate(' . $percent_rotate . 'deg)')); ?>
          <h2 class="font-caption text-align-center margin-top-small"><?php the_title(); ?></h2>
        </a>

      </article>

<?php
  }
} 
?>
    </div>
  <!-- end posts -->
  </section>

  <?php get_template_part('partials/pagination'); ?>

<!-- end main-content -->

</main>

<?php
get_footer();
?>