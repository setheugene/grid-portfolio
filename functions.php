<?php
/**
 * Theme bootstrap — setup, enqueues, and module includes.
 *
 * @package SethPortfolio
 */

// Prevent direct file access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// -------------------------------------------------------------------------
// Theme setup
// -------------------------------------------------------------------------

/**
 * Register theme supports and nav menus.
 */
function portfolio_setup(): void {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', [ 'search-form', 'comment-form', 'gallery', 'caption', 'style', 'script' ] );

	register_nav_menus( [
		'primary' => __( 'Primary Navigation', 'seth-portfolio' ),
	] );
}
add_action( 'after_setup_theme', 'portfolio_setup' );

// -------------------------------------------------------------------------
// Enqueues
// -------------------------------------------------------------------------

/**
 * Enqueue styles and scripts.
 *
 * Google Fonts are loaded with a preconnect hint added separately in
 * portfolio_preconnect_hints(). The contact script is only enqueued on
 * the contact page to keep other pages lean.
 */
function portfolio_scripts(): void {
	$version = wp_get_theme()->get( 'Version' );

	// Fonts.
	wp_enqueue_style(
		'google-fonts',
		'https://fonts.googleapis.com/css2?family=Sora:wght@400;600;700&family=DM+Sans:wght@400;500&family=JetBrains+Mono:wght@400;500&display=swap',
		[],
		null
	);

	// Main stylesheet.
	wp_enqueue_style(
		'portfolio-main',
		get_template_directory_uri() . '/assets/css/main.css',
		[ 'google-fonts' ],
		$version
	);

	// Main script — deferred via the `in_footer` arg.
	wp_enqueue_script(
		'portfolio-main',
		get_template_directory_uri() . '/assets/js/main.js',
		[],
		$version,
		true
	);

	// Contact page only.
	if ( is_page( 'contact' ) ) {
		wp_enqueue_script(
			'portfolio-contact',
			get_template_directory_uri() . '/assets/js/contact.js',
			[],
			$version,
			true
		);

		wp_localize_script(
			'portfolio-contact',
			'portfolioData',
			[
				'restUrl' => esc_url_raw( rest_url( 'portfolio/v1/contact' ) ),
				'nonce'   => wp_create_nonce( 'wp_rest' ),
			]
		);
	}
}
add_action( 'wp_enqueue_scripts', 'portfolio_scripts' );

/**
 * Output preconnect resource hints for Google Fonts.
 *
 * These go in <head> before the stylesheet, reducing connection latency
 * and contributing to Lighthouse Performance score.
 */
function portfolio_preconnect_hints(): void {
	echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
	echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
}
add_action( 'wp_head', 'portfolio_preconnect_hints', 1 );

// -------------------------------------------------------------------------
// Head cleanup — remove WordPress noise from <head>
// -------------------------------------------------------------------------

remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wp_shortlink_wp_head' );
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
add_filter( 'the_generator', '__return_empty_string' );

// Disable emoji scripts — saves ~15 kB and a DNS lookup.
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );
remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

// -------------------------------------------------------------------------
// Modules
// -------------------------------------------------------------------------

require_once get_template_directory() . '/inc/cpt.php';
require_once get_template_directory() . '/inc/acf-fields.php';
require_once get_template_directory() . '/inc/rest-api.php';
