<?php
/**
 * @package WordPress
 * @subpackage MF Theme
 */

 /*
Template Name: Posts
*/

get_header();

	if(have_posts())
	{
		while(have_posts())
		{
			the_post();

			$post_id = $post->ID;
			$post_title = $post->post_title;
			$post_content = apply_filters('the_content', $post->post_content);

			if($post_content != '')
			{
				$post_meta = apply_filters('the_content_meta', "", $post);

				echo "<article>
					<h1>".$post_title."</h1>"
					.($post_meta != '' ? "<div class='meta'>".$post_meta."</div>" : "")
					."<section>".$post_content."</section>
				</article>";
			}
		}

		echo get_more_posts();
	}

get_footer();