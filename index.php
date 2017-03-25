<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query. 
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Theme
 */

get_header();

	if(have_posts())
	{
		$post_amount = $wp_query->found_posts;

		while(have_posts())
		{
			the_post();

			$post_id = $post->ID;
			$post_title = $post->post_title;
			$post_content = apply_filters('the_content', $post->post_content);

			$post_link_start = $post_link_end = "";

			if($post_amount > 1)
			{
				$post_excerpt = $post->post_excerpt;

				$post_url = get_permalink($post);

				$post_link_start = "<a href='".$post_url."'>";
				$post_link_end = "</a>";
			}

			$article_content = "";

			if(is_heading_visible($post) && ($post_amount > 1 || !is_front_page())) // || is_heading_front_visible()
			{
				$article_content .= "<h1>".$post_link_start.$post_title.$post_link_end."</h1>";

				$post_meta = apply_filters('the_content_meta', "", $post);

				if($post_meta != '')
				{
					$article_content .= "<div class='meta'>".$post_meta."</div>";
				}
			}

			if($post_amount > 1)
			{
				$article_content .= "<section>";

					if($post_excerpt != '')
					{
						$article_content .= "<p>".$post_excerpt."</p>
						<p>".$post_link_start.__("Read More", 'lang_theme').$post_link_end."</p>";
					}

					else
					{
						$article_content .= $post_content;
					}

				$article_content .= "</section>";
			}

			else if($post_content != '')
			{
				$article_content .= "<section>".$post_content."</section>";
			}

			if($article_content != '')
			{
				echo "<article>".$article_content."</article>";
			}
		}
	}

	else if(isset($_REQUEST['s']))
	{
		echo "<article>
			<h1>".__("No results", 'lang_theme')."</h1>
			<section>
				<p>".sprintf(__("There were no results for '%s'", 'lang_theme'), get_query_var('s'))."</p>
			</section>
		</article>";
	}

get_footer();