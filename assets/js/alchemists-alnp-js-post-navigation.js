var alnp_remove_comments = auto_load_next_post_params.alnp_remove_comments;

// Runs on initial load of the post.
jQuery( document ).ready( function($) {
	// Ensure auto_load_next_post_params exists to continue.
	if ( typeof auto_load_next_post_params === 'undefined' ) {
		return false;
	}

	// Don't do anything if post was loaded looking for comments.
	if ( window.location.href.indexOf( '#comments' ) > -1 || window.location.href.match(/#comment-*([0-9]+)/) ) {
		return;
	}

	// Remove Reply Form if Comments are removed.
	if ( alnp_remove_comments === 'yes' ) {
		$( 'div.post-comment-form' ).remove();
	}

	// Add rel attribute to previous post link.
	$( 'div.post-related__prev' ).find( 'a.btn-nav' ).attr( 'rel', 'prev' );

	// Remove Posts Related Next if previous post does not exist.
	if ( $( 'div.post-related__prev' ).length <= 0 && $( 'div.post-related__next' ).length > 0 ) {
		$( 'div.post-related__next' ).remove();
	}

	// Runs when triggered.
	$('body').on( 'alnp-post-loaded', function( e, post_title, post_url, post_ID, post_count ) {
		// Remove Reply Form if Comments are removed.
		if ( alnp_remove_comments === 'yes' ) {
			if ( $( 'body' ).find( 'div.post-comment-form' ).length > 0 ) {
				$( 'div.post-comment-form' ).remove();
			}
		}

		// Add rel attribute to previous post link.
		$( 'div.post-related__prev' ).find( 'a.btn-nav' ).attr( 'rel', 'prev' );

		// Remove Posts Related Next if previous post does not exist.
		if ( $( 'div.post-related__prev' ).length <= 0 && $( 'div.post-related__next' ).length > 0 ) {
			$( 'div.post-related__next' ).remove();
		}
	});

});
