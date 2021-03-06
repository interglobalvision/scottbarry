<?php
get_header();
?>

<!-- main content -->

<main id="main-content" class="margin-bottom-large padding-top-large">

  <!-- main posts loop -->
  <section id="post" class="container">

    <article <?php post_class('row'); ?>>

      <div class="col col-s-12 col-m-6 text-line-length">
        <h1 class="font-size-mid margin-bottom-1rem">
          <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h1>
<?php
$details = get_post_meta($post->ID, '_igv_conversation_details', true);

if (!empty($details)) {
?>
        <div class="font-size-mid underline-links">
          <?php echo apply_filters('the_content', $details); ?>
        </div>
<?php
}
?>
      </div>
<?php
if (get_the_content()) {
?>
      <div class="col col-s-12 col-m-6 text-line-length font-size-mid underline-links" id="conversation-holder">
        <?php the_content(); ?>
      </div>
<?php
}
?>
    </article>
      
  <!-- end posts -->
  </section>

<!-- end main-content -->

</main>

<?php
get_footer();
?>
