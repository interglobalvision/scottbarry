<?php

if( function_exists( 'add_theme_support' ) ) {
  add_theme_support( 'post-thumbnails' );
}

if( function_exists( 'add_image_size' ) ) {
  add_image_size( 'admin-thumb', 150, 150, false );
  add_image_size( 'opengraph', 1200, 630, true );

  add_image_size( 'list', 200, 9999, false );

  add_image_size( 'col-6', 1170, 9999, false );
  add_image_size( 'col-12', 2370, 9999, false );
}
