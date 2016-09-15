<?php
get_header();
?>

<!-- main content -->

<main id="main-content" class="margin-bottom-large padding-top-large">

  <!-- main posts loop -->
  <section id="post" class="container">

<?php
$tagline = get_post_meta($post->ID, '_igv_tagline', true);
$images = get_post_meta($post->ID, '_igv_image_gallery', true);
?>

      <article <?php post_class('row'); ?>>

        <div class="col col-s-12 text-align-center">
          <h1 class="font-size-mid"><?php the_title(); ?></h1>
<?php
if (!empty($tagline)) {
?>
          <div class="font-size-mid"><?php echo $tagline ?></div>
<?php
}
?>
        </div>
<?php
if (get_the_content()) {
?>
        <div id="project-text-holder" class="col col-s-12 text-align-center font-size-large font-bold underline-links font-condensed-y"><?php the_content(); ?></div>
<?php
}

if (!empty($images)) {
  foreach ($images as $image) {
    if (!empty($image['image_id'])) {
      $single_row = empty($image['single_row']) ? '' : $image['single_row'];
      $top_margin = empty($image['top_margin']) ? '0' : $image['top_margin'];
      $percent_width = empty($image['percent_width']) ? '100' : $image['percent_width'];
      $degrees_rotate = empty($image['degrees_rotate']) ? '0' : $image['degrees_rotate'];
      $percent_margin = empty($image['percent_margin']) ? '0' : $image['percent_margin'];

      $image_size = $single_row == 'on' ? 'col-12' : 'col-6';
?>
        <div class="<?php
          if ($single_row == 'on') {
            echo 'image-col text-align-center col col-s-12';
          } else {
            echo 'image-col text-align-center col col-s-12 col-m-6';
          }
        ?>" style="margin-top: <?php echo $top_margin; ?>px; left: <?php echo $percent_margin; ?>%">

          <?php echo wp_get_attachment_image($image['image_id'], $image_size, false, array('style'=>'max-width: ' . $percent_width . '%; transform: rotate(' . $degrees_rotate . 'deg);')); ?>
<?php
      if (!empty($image['caption'])) {
?>
          <div class="text-align-center margin-top-tiny caption">
            <?php echo $image['caption'] ?>
          </div>
<?php
      }
?>
        </div>
<?php
    }
  }
}
?>
      </article>
      
  <!-- end posts -->
  </section>

  <?php get_template_part('partials/pagination'); ?>

<!-- end main-content -->

</main>

<?php
get_footer();
?>