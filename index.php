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
		$options['heading_front_visible'] = get_theme_mod('heading_front_visible');

		$post_amount = $wp_query->found_posts;
		$show_h1 = $post_amount > 1 || $options['heading_front_visible'] == 2 || !is_front_page() ? true : false;

		while(have_posts())
		{
			the_post();

			$post_id = $post->ID;
			$post_title = $post->post_title;
			$post_content = apply_filters('the_content', $post->post_content);

			$post_url_start = $post_url_end = "";

			if($post_amount > 1)
			{
				$post_excerpt = $post->post_excerpt;

				$post_url = get_permalink($post);

				$post_url_start = "<a href='".$post_url."'>";
				$post_url_end = "</a>";
			}

			echo "<article>";

				if($show_h1 == true)
				{
					echo "<h1>"
						.$post_url_start
							.$post_title
						.$post_url_end;

						if(is_user_logged_in() && current_user_can('edit_post', $post_id))
						{
							echo "<div class='edit_mode'>
								<a href='".admin_url("post.php?post=".$post_id."&action=edit")."'>".__("Edit post", 'lang_theme')."</a>
							</div>";
						}

					echo "</h1>";
				}

				if($post_amount > 1)
				{
					echo "<section>
						<p>".$post_excerpt."</p>
						<p>"
							.$post_url_start
								.__("Read More", 'lang_theme')
							.$post_url_end
						."</p>
					</section>";
				}

				else
				{
					echo "<section>".$post_content."</section>";
				}

			echo "</article>";
		}
	}

	else if(isset($_REQUEST['s']))
	{
		$search = get_query_var('s') ? get_query_var('s') : "";

		echo "<article>
			<h1>".__("No results", 'lang_theme')."</h1>
			<section>
				<p>".sprintf(__("There were no results for '%s'", 'lang_theme'), $search)."</p>
			</section>
		</article>";
	}

get_footer();