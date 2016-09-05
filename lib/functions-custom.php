<?php

// Custom functions (like special queries, etc)

function cmb2_get_post_options($args) {

  $posts = get_posts($args);

  $post_options = array();

  if ($posts) {
    foreach ($posts as $post) {
      $post_options[$post->ID] = $post->post_title;
    }
  }

  return $post_options;
}

 function get_cpt_categories($post_type_array) {
  $args = array(
    'post_type' => $post_type_array,
    'posts_per_page' => -1
  );

  $query = new WP_Query( $args );

  $terms = array();

  while ($query->have_posts()){
    $query->the_post();

    $current_terms = wp_get_object_terms(get_the_ID(), 'category');

    foreach ($current_terms as $t){
      if (!in_array($t,$terms)){

        $terms[] = $t;
      }
    }
  }
  wp_reset_query();

  return $terms;
}
