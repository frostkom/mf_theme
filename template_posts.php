<?php
/**
 * @package WordPress
 * @subpackage MF Theme
 */

 /*
Template Name: Posts
*/

wp_enqueue_style('style_custom_lists', plugin_dir_url(__FILE__)."style.css");

get_header();

	if(have_posts())
	{
		echo "<article>";

			while(have_posts())
			{
				the_post();

				$post_id = $post->ID;
				$post_content = apply_filters('the_content', $post->post_content);

				echo "<section>".$post_content."</section>";
			}

			echo "<ul class='list_alternate'>"
				.get_more_posts()
			."</ul>
		</article>";
	}

get_footer();