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

	if(!isset($obj_theme))
	{
		$obj_theme = new mf_theme();
	}

	if(have_posts())
	{
		$post_amount = $wp_query->found_posts;

		$is_single = ($post_amount == 1);

		while(have_posts())
		{
			the_post();

			$post_id = $post->ID;
			$post_title = $post->post_title;
			$post_content = apply_filters('the_content', $post->post_content);

			$post_link_start = $post_link_end = "";

			if($is_single == false)
			{
				$post_excerpt = $post->post_excerpt;

				$post_url = get_permalink($post);

				$post_link_start = "<a href='".$post_url."'>";
				$post_link_end = "</a>";
			}

			$article_content = "";

			if($obj_theme->is_heading_visible($post))
			{
				$article_content .= "<h1>".$post_link_start.$post_title.$post_link_end."</h1>";

				$post_meta = apply_filters('the_content_meta', "", $post);

				if($post_meta != '')
				{
					$article_content .= "<div class='meta'>".$post_meta."</div>";
				}

				if($is_single == true)
				{
					if(is_active_sidebar('widget_after_heading') && !post_password_required())
					{
						ob_start();

						dynamic_sidebar('widget_after_heading');

						$content = ob_get_clean();

						if($content != '')
						{
							$article_content .= "<div class='aside after_heading'>" // id='aside_after_heading'
								.$content
							."</div>";
						}
					}
				}
			}

			if($is_single == false)
			{
				$article_content .= "<section>";

					if($post_excerpt != '')
					{
						$article_content .= "<p>".$post_excerpt."</p>
						<p>".$post_link_start.__("Read More", 'lang_theme').$post_link_end."</p>";
					}

					else if($post_content != '')
					{
						$article_content .= $post_content;
					}

					else
					{
						$article_content .= "<p>".$post_link_start.__("Read More", 'lang_theme').$post_link_end."</p>";
					}

				$article_content .= "</section>";
			}

			else if($post_content != '')
			{
				if(has_post_thumbnail($post_id))
				{
					//$obj_theme_core = new mf_theme_core();

					if($obj_theme->display_featured_image($post_id))
					{
						$post_thumbnail = get_the_post_thumbnail($post_id, 'full');

						if($post_thumbnail != '')
						{
							$article_content .= "<div class='image'>".$post_thumbnail."</div>";
						}
					}
				}

				$obj_theme = new mf_theme();

				$post_text_columns = get_post_meta($post_id, $obj_theme->meta_prefix.'text_columns', true);

				$article_content .= "<section".($post_text_columns > 1 ? " class='text_columns columns_".$post_text_columns."'" : "").">".$post_content."</section>";
			}

			if($article_content != '')
			{
				echo "<article>".$article_content."</article>";

				if(is_single())
				{
					if(comments_open() || get_comments_number())
					{
						comments_template();
					}
				}
			}
		}
	}

	else
	{
		echo $obj_theme->get_search_page();
	}

get_footer();