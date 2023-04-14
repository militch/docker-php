<?php
/**
 * Comments
 *
 * @package WordPress
 * @subpackage restoration
 * @since 1.0
 * @version 1.0
 */

if ( post_password_required() ) {
	return;
}

?>
<!-- Start #comments -->
<div id="comments">
	<h4>
		<?php
		printf(
			/* translators: %1$s: Comment Count */
			esc_html( _nx( '%1$s Comment for', '%1$s Comments for', get_comments_number(), 'comments', 'restoration' ) ),
			esc_html( number_format_i18n( get_comments_number() ) )
		);
		?>
		“<?php the_title(); ?>”
	</h4>
	<div class="comments-container">
		<?php if ( have_comments() ) : ?>
			<ul class="commentlist cf">
				<?php
					wp_list_comments(
						array(
							'type'        => 'comment',
							'style'       => 'ul',
							'short_ping'  => true,
							'avatar_size' => 56,
						)
					);
				?>
			</ul>

			<?php the_comments_navigation(); ?>

			<?php
			else :
				if ( ! comments_open() ) :
					?>
				<p class="nocomments"><?php esc_html_e( 'Comments are closed', 'restoration' ); ?></p>"
							<?php endif; ?>

		<?php endif; ?>
		<?php
			// Comment Form
			$commenter = wp_get_current_commenter();
			$req       = get_option( 'require_name_email' );
			$aria_req  = ( $req ? ' aria-required="true" data-required="true"' : '' );
			$defaults  = array(
				'fields'               => apply_filters(
					'comment_form_default_fields',
					array(
						'author' => '<div class="row"><div class="small-12 medium-6 large-4 columns"><label>' . esc_html__( 'Name', 'restoration' ) . ( $req ? '<span class="required">*</span>' : '' ) . '</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' class="full"/></div>',
						'email'  => '<div class="small-12 medium-6 large-4 columns"><label>' . esc_html__( 'E-mail', 'restoration' ) . ( $req ? '<span class  ="required">*</span>' : '' ) . '</label><input id="email" name="email" type="text" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size ="30"' . $aria_req . ' class="full" /></div>',
						'url'    => '<div class="small-12 medium-12 large-4 columns"><label>' . esc_html__( 'Website', 'restoration' ) . '</label><input name ="url" size="30" id="url" value   ="' . esc_attr( $commenter['comment_author_url'] ) . '" type ="text" class="full" /></div></div>',
					)
				),
				'comment_field'        => '<div class="row"><div class="small-12 columns"><label>' . esc_html__( 'Comment', 'restoration' ) . '</label><textarea name="comment" id="comment"' . $aria_req . ' rows="3" cols="58" class="full"></textarea></div></div>',
				'must_log_in'          => '<p class="must-log-in">' . sprintf(
					wp_kses(
						/* translators: %s: login link */
						__( 'You must be <a href="%s">logged in</a> to post a comment.', 'restoration' ),
						array(
							'a' => array(
								'href'  => array(),
								'title' => array(),
							),
						)
					),
					wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
				) . '</p>',
				'logged_in_as'         => '<p class="logged-in-as">' . sprintf(
					wp_kses(
						/* translators: %1$s: author link; %2$s: author name; %3$s: logout link; */
						__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'restoration' ),
						array(
							'a' => array(
								'href'  => array(),
								'title' => array(),
							),
						)
					),
					admin_url( 'profile.php' ),
					$user_identity,
					wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) )
				) . '</p>',
				'comment_notes_before' => '<p class="comment-notes">' . esc_html__( 'Your email address will not be published.', 'restoration' ) . '</p>',
				'comment_notes_after'  => '',
				'id_form'              => 'form-comment',
				'id_submit'            => 'submit',
				'title_reply'          => esc_html__( 'Leave a Reply', 'restoration' ),
				/* translators: %s: author being replied to */
				'title_reply_to'       => esc_html__( 'Leave a Reply to %s', 'restoration' ),
				'title_reply_before'   => '<h4 id="reply-title" class="comment-reply-title">',
				'title_reply_after'    => '</h4>',
				'cancel_reply_link'    => esc_attr__( 'Cancel reply', 'restoration' ),
				'class_submit'         => 'submit btn',
				'label_submit'         => esc_attr__( 'Submit Comment', 'restoration' ),
			);
			comment_form( $defaults );
			?>
	</div> <!-- .comments-container -->
</div>
