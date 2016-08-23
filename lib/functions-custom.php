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