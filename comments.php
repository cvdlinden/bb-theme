<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * The actual display of comments is handled by a callback to bb_comment() which is
 * located in the inc/template-tags.php file.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package BijBest
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

	<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<header>
			<h2 class="comments-title">
				<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'bb' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
				?>
			</h2>
		</header>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'bb' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'bb' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'bb' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list media-list">
			<?php
				/* Loop through and list the comments. Tell wp_list_comments()
				 * to use bb_comment() to format the comments.
				 * If you want to overload this in a child theme then you can
				 * define bb_comment() and that will be used instead.
				 * See bb_comment() in includes/template-tags.php for more.
				 */
				wp_list_comments( array( 
					'callback' => 'bb_comment', 
					'avatar_size' => 50 ,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'bb' ); ?></h2>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'bb' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'bb' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'bb' ); ?></p>

	<?php 
	endif; 
	
	comment_form( $args = array(
		'id_form'           => 'commentform',  // that's the wordpress default value! delete it or edit it ;)
		'id_submit'         => 'commentsubmit',
		'title_reply'       => esc_html__( 'Leave a Reply', 'bb' ),  // that's the wordpress default value! delete it or edit it ;)
		'title_reply_to'    => esc_html__( 'Leave a Reply to %s', 'bb' ),  // that's the wordpress default value! delete it or edit it ;)
		'cancel_reply_link' => esc_html__( 'Cancel Reply', 'bb' ),  // that's the wordpress default value! delete it or edit it ;)
		'label_submit'      => esc_html__( 'Post Comment', 'bb' ),  // that's the wordpress default value! delete it or edit it ;)

		'comment_field' =>  '<p><textarea placeholder="Start typing..." id="comment" class="form-control" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',

		'comment_notes_after' => '<p class="form-allowed-tags">' .
		esc_html__( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:', 'bb' ) .
		'</p><div class="alert alert-info">' . allowed_tags() . '</div>'

		// So, that was the needed stuff to have bootstrap basic styles for the form elements and buttons

		// Basically you can edit everything here!
		// Checkout the docs for more: http://codex.wordpress.org/Function_Reference/comment_form
		// Another note: some classes are added in the bootstrap-wp.js - ckeck from line 1
	));

	?>

</div><!-- #comments -->
