<?php
get_header();
?>

<!-- main content -->

<main id="main-content" class="padding-top-large margin-bottom-large">

  <!-- main posts loop -->
  <section id="posts" class="container">
    <div class="row justify-center">

<?php
$args = array (
  'posts_per_page'         => -1,
  'post_type'              => array('home_item',),
);

$query = new WP_Query( $args );

if( $query->have_posts() ) {
  while( $query->have_posts() ) {
    $query->the_post();

    $link_post_type = get_post_meta($post->ID, '_igv_post_type', true);

    if (!empty($link_post_type)) {

      $link_post_id = get_post_meta($post->ID, '_igv_' . $link_post_type . '_id', true);

      if (!empty($link_post_id)) {

        $categories = get_the_terms($link_post_id, 'category');

        $single_row = get_post_meta($post->ID, '_igv_single_row', true);
        $percent_margin_top = get_post_meta($post->ID, '_igv_margin_top', true);
        $percent_margin_left = get_post_meta($post->ID, '_igv_margin_left', true);

        $single_row = empty($single_row) ? '' : $single_row;
        $percent_margin_top = empty($percent_margin_top) ? '0' : $percent_margin_top;
        $percent_margin_left = empty($percent_margin_left) ? '0' : $percent_margin_left;
?>

      <article class="post custom-layout-item text-align-center col col-s-12 text-line-length js-sort-item <?php

        if ($single_row !== 'on') {
          echo 'col-m-6';
        }

        if ($categories) {
          foreach ($categories as $cat) {
            echo ' category-' . $cat->slug;
          }
        }

      ?>" id="post-<?php the_ID(); ?>" style="margin-top: <?php echo $percent_margin_top; ?>%; left: <?php echo $percent_margin_left; ?>%">

<?php
        if ($link_post_type == 'project') {

          $percent_width = get_post_meta($post->ID, '_igv_percent_width', true);
          $degrees_rotate = get_post_meta($post->ID, '_igv_degrees_rotate', true);
          
          $percent_width = empty($percent_width) ? '100' : $percent_width;
          $degrees_rotate = empty($degrees_rotate) ? '0' : $degrees_rotate;
?>
       
        <a href="<?php echo get_the_permalink($link_post_id); ?>" class="text-content-centered">
          <?php the_post_thumbnail('gallery', array(
              'class' => 'custom-layout-image',
              'style' => 'max-width: ' . $percent_width . '%; transform: rotate(' . $degrees_rotate . 'deg);',
          )); ?>
          <div class="text-align-center margin-top-tiny caption">
            <?php the_title(); ?>
          </div>
        </a>

<?php
        } else {
?>

        <a href="<?php echo get_the_permalink($link_post_id); ?>" class="text-content-centered">
          <div class="font-size-mid"><?php the_content(); ?></div>
          <div class="text-align-center margin-top-tiny caption">
            <?php the_title(); ?>
          </div>
        </a>

<?php
        }
?>

      </article>

<?php
      }
    }
  }
}
?>

    </div>
  <!-- end posts -->
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>