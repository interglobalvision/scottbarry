<?php

/* Get post objects for select field options */
function get_post_objects( $query_args ) {
$args = wp_parse_args( $query_args, array(
    'post_type' => 'post',
) );
$posts = get_posts( $args );
$post_options = array();
if ( $posts ) {
    foreach ( $posts as $post ) {
        $post_options [ $post->ID ] = $post->post_title;
    }
}
return $post_options;
}


/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/WebDevStudios/CMB2
 */

/**
 * Hook in and add metaboxes. Can only happen on the 'cmb2_init' hook.
 */
add_action( 'cmb2_init', 'igv_cmb_metaboxes' );
function igv_cmb_metaboxes() {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_igv_';

	/**
	 * Metaboxes declarations here
   * Reference: https://github.com/WebDevStudios/CMB2/blob/master/example-functions.php
	 */

  $image_gallery_group = new_cmb2_box( array(
    'id'           => $prefix . 'image_gallery_metabox',
    'title'        => __( 'Image gallery', 'cmb2' ),
    'object_types' => array( 'post', ),
  ) );

  // $group_field_id is the field id string, so in this case: $prefix . 'demo'
  $image_gallery_field_id = $image_gallery_group->add_field( array(
    'id'          => $prefix . 'image_gallery',
    'type'        => 'group',
    'description' => __( '', 'cmb2' ),
    'options'     => array(
      'group_title'   => __( 'Image {#}', 'cmb2' ), // {#} gets replaced by row number
      'add_button'    => __( 'Add Another Image', 'cmb2' ),
      'remove_button' => __( 'Remove Image', 'cmb2' ),
      'sortable'      => true, // beta
      // 'closed'     => true, // true to have the groups closed by default
    ),
  ) );

  $image_gallery_group->add_group_field( $image_gallery_field_id, array(
    'name' => __( 'Image File', 'cmb2' ),
    'description' => __( '(Suggested min width 1150px)', 'cmb2' ),
    'id'   => 'image',
    'type' => 'file',
  ) );

  $image_gallery_group->add_group_field( $image_gallery_field_id, array(
    'name' => __( 'Image Caption', 'cmb2' ),
    'description' => __( '(Suggested max 20 words)', 'cmb2' ),
    'id'   => 'caption',
    'type' => 'text',
  ) );

  $image_gallery_group->add_group_field( $image_gallery_field_id, array(
    'name'        => __( 'Single image row', 'cmb2' ),
    'description' => __( '(Centered image in full-width column)', 'cmb2' ),
    'id'          => 'single_row',
    'type'        => 'checkbox',
  ) );

  $image_gallery_group->add_group_field( $image_gallery_field_id, array(
    'name'        => __( 'Percent width', 'cmb2' ),
    'description' => __( '% (Percent width in column / Default 100 / Max 100)', 'cmb2' ),
    'id'          => 'percent_width',
    'type'        => 'text_small',
  ) );

  $image_gallery_group->add_group_field( $image_gallery_field_id, array(
    'name'        => __( 'Percent rotate', 'cmb2' ),
    'description' => __( '% (Clockwise: # / Counter-clockwise: -# / Default 0 / Max 100)', 'cmb2' ),
    'id'          => 'percent_rotate',
    'type'        => 'text_small',
  ) );

}
?>
