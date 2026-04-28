<?php
/**
 * Custom Post Types.
 *
 * Registered programmatically so the definition lives in version control,
 * not the database. `show_in_rest: true` enables the block editor and the
 * WP REST API for this post type.
 *
 * @package SethPortfolio
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register the Case Study CPT.
 */
function portfolio_register_cpt(): void {
	$labels = [
		'name'               => _x( 'Case Studies', 'post type general name', 'seth-portfolio' ),
		'singular_name'      => _x( 'Case Study', 'post type singular name', 'seth-portfolio' ),
		'add_new'            => __( 'Add New', 'seth-portfolio' ),
		'add_new_item'       => __( 'Add New Case Study', 'seth-portfolio' ),
		'edit_item'          => __( 'Edit Case Study', 'seth-portfolio' ),
		'new_item'           => __( 'New Case Study', 'seth-portfolio' ),
		'view_item'          => __( 'View Case Study', 'seth-portfolio' ),
		'search_items'       => __( 'Search Case Studies', 'seth-portfolio' ),
		'not_found'          => __( 'No case studies found.', 'seth-portfolio' ),
		'not_found_in_trash' => __( 'No case studies found in Trash.', 'seth-portfolio' ),
	];

	register_post_type( 'case_study', [
		'labels'       => $labels,
		'public'       => true,
		'has_archive'  => false,
		'show_in_rest' => true,
		'supports'     => [ 'title', 'thumbnail', 'excerpt' ],
		'rewrite'      => [ 'slug' => 'work', 'with_front' => false ],
		'menu_icon'    => 'dashicons-portfolio',
		'menu_position' => 5,
	] );
}
add_action( 'init', 'portfolio_register_cpt' );
