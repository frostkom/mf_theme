<?php
/*
Template Name: Posts
*/

get_header();

	if(have_posts())
	{
		if(!isset($obj_theme))
		{
			$obj_theme = new mf_theme();
		}

		while(have_posts())
		{
			the_post();

			$post_id = $post->ID;
			$post_title = $post->post_title;
			$post_content = apply_filters('the_content', $post->post_content);

			if($post_content != '')
			{
				$post_meta = apply_filters('the_content_meta', "", $post);

				echo "<article>"
					.($post_meta != '' ? "<div class='meta'>".$post_meta."</div>" : "")
					."<section>".$post_content."</section>"
				."</article>";
			}

			else if($obj_theme->is_heading_visible($post))
			{
				echo "<h1>".$post_title."</h1>";
			}
		}

		echo $obj_theme->get_more_posts();
	}

get_footer();