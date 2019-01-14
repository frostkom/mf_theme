<?php
/*
 * The template for displaying comments
*/

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if(post_password_required())
{
	return;
}

echo "<article id='comments'>";

	if(have_comments())
	{
		echo "<h2>";

			$comments_number = get_comments_number();

			if('1' === $comments_number)
			{
				/* translators: %s: post title */
				echo sprintf(__("One Reply to &ldquo;%s&rdquo;", 'lang_theme'), get_the_title());
			}

			else
			{
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Reply to &ldquo;%2$s&rdquo;',
						'%1$s Replies to &ldquo;%2$s&rdquo;',
						$comments_number,
						'lang_theme'
					),
					number_format_i18n($comments_number),
					get_the_title()
				);
			}

		echo "</h2>
		<ol class='comment-list'>";

			wp_list_comments( array(
				'avatar_size' => 100,
				'style'       => 'ol',
				'short_ping'  => true,
				'reply_text'  => "<i class='fa fa-reply'></i>",
			));

		echo "</ol>";

		the_comments_pagination( array(
			'prev_text' => "<i class='fa fa-chevron-left'></i> <span class='screen-reader-text'>".__("Previous", 'lang_theme')."</span>",
			'next_text' => "<span class='screen-reader-text'>".__("Next", 'lang_theme')."</span> <i class='fa fa-chevron-left'></i>",
		));
	}

	if(apply_filters('allow_comments', true, $post) == true)
	{
		if(!comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) )
		{
			echo "<p class='no-comments'>".__("Comments are closed", 'lang_theme')."</p>";
		}

		else
		{
			comment_form();
		}
	}

echo "</article>";