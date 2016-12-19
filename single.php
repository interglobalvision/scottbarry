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

      <article <?php post_class('row justify-center'); ?>>

        <div class="col col-s-12 text-align-center">
          <h1 class="font-size-mid">
            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
          </h1>
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
        <div id="project-text-holder" class="col col-s-12 text-align-center font-size-large font-heavy underline-links margin-bottom-basic">
          <?php the_content(); ?>
        </div>
<?php
}

if (!empty($images)) {
  foreach ($images as $image) {
    if (!empty($image['image_id'])) {
      $single_row = empty($image['single_row']) ? '' : $image['single_row'];
      $percent_margin_top = empty($image['margin_top']) ? '0' : $image['margin_top'];
      $percent_margin_left = empty($image['margin_left']) ? '0' : $image['margin_left'];
      $percent_width = empty($image['percent_width']) ? '100' : $image['percent_width'];
      $degrees_rotate = empty($image['degrees_rotate']) ? '0' : $image['degrees_rotate'];
      

      $image_size = $single_row == 'on' ? 'col-12' : 'col-6';
?>
        <div class="custom-layout-item image-col text-align-center col <?php
          if ($single_row == 'on') {
            echo 'col-s-12';
          } else {
            echo 'col-s-12 col-m-6';
          }
        ?>" style="margin-top: <?php echo $percent_margin_top; ?>%; left: <?php echo $percent_margin_left; ?>%">

          <?php echo wp_get_attachment_image($image['image_id'], $image_size, false, array(
            'class' => 'custom-layout-image',
            'style'=>'max-width: ' . $percent_width . '%; transform: rotate(' . $degrees_rotate . 'deg);',
          )); ?>
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