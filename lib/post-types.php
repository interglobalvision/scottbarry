<?php
// Menu icons for Custom Post Types
// https://developer.wordpress.org/resource/dashicons/


function add_menu_icons_styles(){
?>

<style>
#menu-posts-conversation .dashicons-admin-post:before {
  content: '\f125';
}
#menu-posts-project .dashicons-admin-post:before {
  content: "\f232";
}
</style>

<?php
}
add_action( 'admin_head', 'add_menu_icons_styles' );


//Register Custom Post Types

add_action( 'init', 'register_cpt_igv' );

function register_cpt_igv() {

// Home Items

  $labels = array( 
    'name' => _x( 'Home Items', 'home_item' ),
    'singular_name' => _x( 'Home Item', 'home_item' ),
    'add_new' => _x( 'Add New', 'home_item' ),
    'add_new_item' => _x( 'Add New Home Item', 'home_item' ),
    'edit_item' => _x( 'Edit Home Item', 'home_item' ),
    'new_item' => _x( 'New Home Item', 'home_item' ),
    'view_item' => _x( 'View Home Item', 'home_item' ),
    'search_items' => _x( 'Search Home Items', 'home_item' ),
    'not_found' => _x( 'No home item found', 'home_item' ),
    'not_found_in_trash' => _x( 'No home item found in Trash', 'home_item' ),
    'parent_item_colon' => _x( 'Parent Home Item:', 'home_item' ),
    'menu_name' => _x( 'Home Items', 'home_item' ),
  );

  $args = array( 
    'labels' => $labels,
    'hierarchical' => false,
    
    'supports' => array( 'title', 'editor', 'thumbnail' ),
    
    'public' => false,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 5,
    
    'show_in_nav_menus' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => true,
    'has_archive' => false,
    'query_var' => true,
    'can_export' => true,
    'rewrite' => false,
    'capability_type' => 'post'
  );

  register_post_type( 'home_item', $args );

  $labels = array( 
    'name' => _x( 'Projects', 'project' ),
    'singular_name' => _x( 'Project', 'project' ),
    'add_new' => _x( 'Add New', 'project' ),
    'add_new_item' => _x( 'Add New Project', 'project' ),
    'edit_item' => _x( 'Edit Project', 'project' ),
    'new_item' => _x( 'New Project', 'project' ),
    'view_item' => _x( 'View Project', 'project' ),
    'search_items' => _x( 'Search Projects', 'project' ),
    'not_found' => _x( 'No project found', 'project' ),
    'not_found_in_trash' => _x( 'No project found in Trash', 'project' ),
    'parent_item_colon' => _x( 'Parent Project:', 'project' ),
    'menu_name' => _x( 'Projects', 'project' ),
  );

  $args = array( 
    'labels' => $labels,
    'hierarchical' => false,
    
    'supports' => array( 'title', 'editor', 'thumbnail' ),
    
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

  register_post_type( 'project', $args );

// Conversations

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
    
    'supports' => array( 'title', 'editor', 'thumbnail' ),
    
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

add_action('init', 'add_cpt_taxonomy');

function add_cpt_taxonomy() {

    register_taxonomy_for_object_type('category', 'project');
    register_taxonomy_for_object_type('category', 'conversation');

}
