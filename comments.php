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

$obj_theme = new mf_theme();

echo "<article id='comments'>";

	if(have_comments())
	{
		echo "<h2>";

			$comments_number = get_comments_number();

			if('1' === $comments_number)
			{
				/* translators: %s: post title */
				echo sprintf(__("One Reply to %s", $obj_theme->lang_key), "&ldquo;".get_the_title()."&rdquo;");
			}

			else
			{
				printf(
					/* translators: 1: number of comments, 2: post title */
					_nx(
						'%1$s Reply to %2$s',
						'%1$s Replies to %2$s',
						$comments_number,
						$obj_theme->lang_key
					),
					number_format_i18n($comments_number),
					"&ldquo;".get_the_title()."&rdquo;"
				);
			}

		echo "</h2>
		<ol class='comment-list'>";

			wp_list_comments( array(
				'avatar_size' => 100,
				'style' => 'ol',
				'short_ping' => true,
				'reply_text' => "<i class='fa fa-reply'></i>",
			));

		echo "</ol>";

		the_comments_pagination( array(
			'prev_text' => "<i class='fa fa-chevron-left'></i> <span class='screen-reader-text'>".__("Previous", $obj_theme->lang_key)."</span>",
			'next_text' => "<span class='screen-reader-text'>".__("Next", $obj_theme->lang_key)."</span> <i class='fa fa-chevron-left'></i>",
		));
	}

	if(apply_filters('allow_comments', true, $post) == true)
	{
		if(!comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) )
		{
			echo "<p class='no-comments'>".__("Comments are closed", $obj_theme->lang_key)."</p>";
		}

		else
		{
			comment_form();
		}
	}

echo "</article>";