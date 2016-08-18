<?php
get_header();
?>

<!-- main content -->

<main id="main-content" class="margin-bottom-large padding-top-large">

  <!-- main posts loop -->
  <section id="post" class="container">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $tagline = get_post_meta($post->ID, '_igv_tagline', true);
    $images = get_post_meta($post->ID, '_igv_image_gallery', true);

    //pr($images[0][0]['image_id']); die;
?>

      <article <?php post_class('row'); ?>>

        <div class="col col-s-12 text-align-center">
          <h1><?php the_title(); ?></h1>
<?php
    if (!empty($tagline)) {
?>
          <div><?php echo $tagline ?></div>
<?php
    }
?>
        </div>
<?php
    if (get_the_content()) {
?>
        <div class="col col-s-12 text-align-center"><?php the_content(); ?></div>
<?php
    }

    if ($images) {
      foreach ($images as $image) {

        $image_id = $image['image_id'];
        $single_row = empty($image['single_row']) ? '' : $image['single_row'];
        $top_margin = empty($image['top_margin']) ? '0' : $image['top_margin'];
        $percent_width = empty($image['percent_width']) ? '100' : $image['percent_width'];
        $degrees_rotate = empty($image['degrees_rotate']) ? '0' : $image['degrees_rotate'];

        $image_size = $single_row == 'on' ? 'col-12' : 'col-6'
?>
        <div class="<?php
          if ($single_row == 'on') {
            echo 'text-align-center col col-s-12';
          } else {
            echo 'text-align-center col col-s-12 col-m-6';
          }
        ?>" style="margin-top: <?php echo $top_margin; ?>px">

          <?php echo wp_get_attachment_image($image_id, $image_size, false, array('style'=>'max-width: ' . $percent_width . '%; transform: rotate(' . $degrees_rotate . 'deg)')); ?>
<?php
      if (!empty($image['caption'])) {
?>
          <div class="font-caption text-align-center margin-top-small"><?php echo $image['caption'] ?></div>
<?php
      }
?>

        </div>

<?php
      }
    }
?>
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