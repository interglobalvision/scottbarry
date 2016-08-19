<?php
get_header();
?>

<!-- main content -->

<main id="main-content" class="padding-top-large margin-bottom-large">

  <!-- main posts loop -->
  <section id="posts" class="container">
    <div class="row">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $single_row = get_post_meta($post->ID, '_igv_single_row', true);
    $top_margin = get_post_meta($post->ID, '_igv_top_margin', true);
    $percent_width = get_post_meta($post->ID, '_igv_percent_width', true);
    $degrees_rotate = get_post_meta($post->ID, '_igv_degrees_rotate', true);

    $single_row = empty($single_row) ? '' : $single_row;
    $top_margin = empty($top_margin) ? '0' : $top_margin;
    $percent_width = empty($percent_width) ? '100' : $percent_width;
    $degrees_rotate = empty($degrees_rotate) ? '0' : $degrees_rotate;
?>

      <article <?php
        if ($single_row == 'on') {
          post_class('text-align-center col col-s-12 text-line-length');
        } else {
          post_class('text-align-center col col-s-12 col-m-6');
        }
      ?> id="post-<?php the_ID(); ?>" style="margin-top: <?php echo $top_margin; ?>px">

        <a href="<?php the_permalink() ?>">
          <?php the_post_thumbnail('gallery', array('style'=>'max-width: ' . $percent_width . '%; transform: rotate(' . $degrees_rotate . 'deg)')); ?>
          <h2 class="text-align-center margin-top-small"><?php the_title(); ?></h2>
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