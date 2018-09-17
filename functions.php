<?php
/**
 * Setup Child Theme
 */
function alchemists_alnp_setup_child_theme() {
	load_child_theme_textdomain( 'alchemists-alnp', get_stylesheet_directory() . '/languages' );
}
add_action( 'after_setup_theme', 'alchemists_alnp_setup_child_theme', 99 );

/**
 * Enqueue Child Theme Assets
 */
function alchemists_alnp_child_assets() {
	if ( ! is_admin() ) {
		$version = wp_get_theme()->get( 'Version' );
		wp_enqueue_style( 'alchemists_alnp_child_css', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array(), $version, 'all' );

		if ( is_singular() && get_post_type() == 'post' ) {
			wp_register_script( 'alchemists-alnp-js-post-navigation', trailingslashit( get_stylesheet_directory_uri() ) . 'assets/js/alchemists-alnp-js-post-navigation.js', array( 'jquery' ), $version );
			wp_enqueue_script( 'alchemists-alnp-js-post-navigation' );
		}
	}
}
add_action( 'wp_enqueue_scripts', 'alchemists_alnp_child_assets', 99 );

/**
 * Enable Support for Auto Load Next Post.
 */
function alchemists_alnp_support() {
	add_theme_support( 'auto-load-next-post', array(
		'content_container'    => 'div#primary',
		'title_selector'       => 'h2.post__title',
		'navigation_container' => 'div.post-related__prev',
		'comments_container'   => 'div#comments',
	) );

	// Removes the need to load comments again.
	remove_action( 'alnp_load_after_content', 'auto_load_next_post_comments', 1, 5 );

	// Removes the compatible post navigation for Auto Load Next Post.
	remove_action( 'alnp_load_after_content', 'auto_load_next_post_navigation', 1, 10 );
}
add_action( 'after_setup_theme', 'alchemists_alnp_support' );

/**
 * Add your custom code below this comment.
 */
