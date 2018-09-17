<?php
/**
 * The Template for displaying a post when called.
 *
 * This template can be overridden by copying it to yourtheme/auto-load-next-post/content-partial.php.
 *
 * HOWEVER, on occasion Auto Load Next Post will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. I try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @author  Sébastien Dumont
 * @package Auto Load Next Post/Templates
 * @license GPL-2.0+
 * @version 1.4.10
*/

$alchemists_data   = get_option('alchemists_data');
$post_author_box   = isset( $alchemists_data['alchemists__opt-single-post-author'] ) ? esc_html( $alchemists_data['alchemists__opt-single-post-author'] ) : '';

if ( have_posts() ) :

	// Load content before the loop.
	do_action( 'alnp_load_before_loop' );

	// Check that there are posts to load.
	while ( have_posts() ) : the_post();

		// set post views
		if ( function_exists( 'alchemists_setPostViews' ) ) {
			alchemists_setPostViews( get_the_ID() );
		}

		$post_format = get_post_format(); // Post Format e.g. video

		// Load content before the post content.
		do_action( 'alnp_load_before_content' );

		// Load content before the post content for a specific post format.
		do_action( 'alnp_load_before_content_post_format_' . $post_format );

		get_template_part( 'template-parts/content', 'single' );

		// Load content after the post content for a specific post format.
		do_action( 'alnp_load_after_content_post_format_' . $post_format );

		// Load content after the post content.
		do_action( 'alnp_load_after_content' );

		// Post Social Sharing
		if ( function_exists( 'alc_post_social_share_buttons' ) ) {
			alc_post_social_share_buttons();
		}

		if ( $post_author_box != 0 ) {
			// Post Author
			get_template_part( 'template-parts/post/post', 'author' );
		}

		// Post Navigation
		get_template_part( 'template-parts/post/post', 'navigation' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

	// End the loop.
	endwhile;

		// Load content after the loop.
		do_action( 'alnp_load_after_loop' );

else :

	// Load content if there are no more posts.
	do_action( 'alnp_no_more_posts' );

endif; // END if have_posts()
