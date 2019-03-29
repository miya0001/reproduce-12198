<?php
/**
 * Plugin Name:     Reproduce 12198
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     This is an exmaple to reproduce the problem #12198.
 * Author:          YOUR NAME HERE
 * Author URI:      YOUR SITE HERE
 * Text Domain:     reproduce-12198
 * Domain Path:     /languages
 * Version:         0.1.0
 *
 * @package         Reproduce_12198
 */

register_activation_hook( __FILE__, 'event_activation' );

/**
 * Registers the custom role at activation hook.
 */
function event_activation() {
	add_role( 'organizer', 'Orgzanizer', array(
		'read' => true,
	) );

	$role = get_role( 'organizer' );

	foreach ( get_event_caps() as $key => $value ) {
		$role->add_cap( $value );
	}

	$role->add_cap( 'upload_files' );
}

function get_event_caps() {
	return array(
		'read'                  => 'read_events',
		'read_private_posts'    => 'read_private_events',
		'edit'                  => 'edit_events',
		'edit_private_posts'    => 'edit_private_events',
		'edit_published_posts'  => 'edit_published_events',
		'edit_others_posts'     => 'edit_others_events',
		'publish'               => 'publish_events',
		'delete'                => 'delete_events',
		'delete_private_post'   => 'delete_private_events',
		'delete_published_post' => 'delete_published_events',
		'delete_others_post'    => 'delete_others_events',
	);
}

/**
 * Registers the `event` post type.
 */
function event_init() {
	register_post_type( 'event', array(
		'label'                => "Event",
		'public'                => true,
		'hierarchical'          => false,
		'show_ui'               => true,
		'show_in_nav_menus'     => true,
		'supports'              => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' ),
		'has_archive'           => true,
		'rewrite'               => true,
		'query_var'             => true,
		'menu_icon'             => 'dashicons-admin-post',
		'show_in_rest'          => true,
		'rest_base'             => 'Event',
		'rest_controller_class' => 'WP_REST_Posts_Controller',
		'capability_type'       => array('event','events'),
		'capabilities'          => get_event_caps(),
		'map_meta_cap'          => true,
	) );

}

add_action( 'init', 'event_init' );
