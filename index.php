<?php
get_header();
?>

<!-- main content -->

<main id="main-content" class="padding-top-large margin-bottom-large">

  <!-- main posts loop -->
  <section id="posts" class="container">
    <div class="row">

<?php
$args = array (
  'post_type'              => array( 'post' ),
  'posts_per_page'         => '-1',
);

$query = new WP_Query( $args );

if( $query->have_posts() ) {
  while( $query->have_posts() ) {
    $query->the_post();

    $link_post_type = get_post_meta($post->ID, '_igv_post_type', true);

    if (!empty($link_post_type)) {

      $link_post_id = get_post_meta($post->ID, '_igv_' . $link_post_type . '_id', true);

      if (!empty($link_post_id)) {

        $categories = get_categories($link_post_id);

        $single_row = get_post_meta($post->ID, '_igv_single_row', true);
        $top_margin = get_post_meta($post->ID, '_igv_top_margin', true);

        $single_row = empty($single_row) ? '' : $single_row;
        $top_margin = empty($top_margin) ? '0' : $top_margin;
?>

      <article class="post text-align-center col col-s-12 text-line-length js-sort-item <?php

        if ($single_row !== 'on') {
          echo 'col-m-6';
        }

        foreach ($categories as $cat) {
          echo ' category-' . $cat->slug;
        }

      ?>" id="post-<?php the_ID(); ?>" style="margin-top: <?php echo $top_margin; ?>px">

<?php
        if ($link_post_type == 'project') {

          $percent_width = get_post_meta($post->ID, '_igv_percent_width', true);
          $degrees_rotate = get_post_meta($post->ID, '_igv_degrees_rotate', true);

          $percent_width = empty($percent_width) ? '100' : $percent_width;
          $degrees_rotate = empty($degrees_rotate) ? '0' : $degrees_rotate;
?>

        <a href="<?php echo get_the_permalink($link_post_id); ?>" class="text-content-centered">
          <?php the_post_thumbnail('gallery', array(
              'style' => 'max-width: ' . $percent_width . '%; transform: rotate(' . $degrees_rotate . 'deg)', 
              'class'=>'margin-bottom-small'
          )); ?>
          <h2><?php the_title(); ?></h2>
        </a>

<?php
        } else {
?>

        <a href="<?php echo get_the_permalink($link_post_id); ?>" class="text-content-centered">
          <div class="font-size-mid margin-bottom-small"><?php the_content(); ?></div>
          <h2><?php the_title(); ?></h2>
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

  <?php get_template_part('partials/pagination'); ?>

<!-- end main-content -->

</main>

<?php
get_footer();
?>