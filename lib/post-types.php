<?php
// Menu icons for Custom Post Types
// https://developer.wordpress.org/resource/dashicons/


function add_menu_icons_styles(){
?>

<style>
#menu-posts-conversation .dashicons-admin-post:before {
  content: '\f125';
}
</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );


//Register Custom Post Types

add_action( 'init', 'register_cpt_conversation' );

function register_cpt_conversation() {

  $labels = array( 
    'name' => _x( 'Conversations', 'conversation' ),
    'singular_name' => _x( 'Conversation', 'conversation' ),
    'add_new' => _x( 'Add New', 'conversation' ),
    'add_new_item' => _x( 'Add New Conversation', 'conversation' ),
    'edit_item' => _x( 'Edit Conversation', 'conversation' ),
    'new_item' => _x( 'New Conversation', 'conversation' ),
    'view_item' => _x( 'View Conversation', 'conversation' ),
    'search_items' => _x( 'Search Conversations', 'conversation' ),
    'not_found' => _x( 'No conversations found', 'conversation' ),
    'not_found_in_trash' => _x( 'No conversations found in Trash', 'conversation' ),
    'parent_item_colon' => _x( 'Parent Conversation:', 'conversation' ),
    'menu_name' => _x( 'Conversations', 'conversation' ),
  );

  $args = array( 
    'labels' => $labels,
    'hierarchical' => false,
    
    'supports' => array( 'title', 'editor', 'excerpt' ),
    
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    
    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'has_archive' => true,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => true,
    'capability_type' => 'post'
  );

  register_post_type( 'conversation', $args );
}