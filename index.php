<?php
/*
 * The main template file.
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

			$is_post = isset($post->post_type) && $post->post_type == 'post';

			$post_link_start = $post_link_end = $article_attr = $article_content = $heading_attr = "";

			if($is_single)
			{
				if($is_post)
				{
					$article_attr .= " itemscope itemtype='http://schema.org/BlogPosting'";
					$heading_attr .= " itemprop='title'";
				}
			}

			else
			{
				$post_excerpt = $post->post_excerpt;

				$post_url = get_permalink($post);

				$post_link_start = "<a href='".$post_url."'>";
				$post_link_end = "</a>";
			}

			if($obj_theme->is_heading_visible($post))
			{
				$article_content .= "<h1".$heading_attr.">".apply_filters('filter_post_title', $post_link_start.$post_title.$post_link_end)."</h1>";

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

						$widget_content = ob_get_clean();

						if($widget_content != '')
						{
							$article_content .= "<div class='aside after_heading'>"
								.$widget_content
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
						$article_content .= "<p>".$post_excerpt."</p>"
						.apply_filters('the_content_read_more', "<p class='read_more'>".$post_link_start.__("Read More", 'lang_theme').$post_link_end."</p>", $post);
					}

					else if($post_content != '')
					{
						$article_content .= $post_content;
					}

					else
					{
						$article_content .= apply_filters('the_content_read_more', "<p class='read_more'>".$post_link_start.__("Read More", 'lang_theme').$post_link_end."</p>", $post);
					}

				$article_content .= "</section>";
			}

			else if($post_content != '')
			{
				if(has_post_thumbnail($post_id))
				{
					if($obj_theme->display_featured_image($post_id))
					{
						$post_thumbnail = get_the_post_thumbnail($post_id, 'full');

						if($post_thumbnail != '')
						{
							$article_content .= "<div class='image'>".$post_thumbnail."</div>";
						}
					}
				}

				$post_text_columns = get_post_meta($post_id, $obj_theme->meta_prefix.'text_columns', true);

				$article_content .= "<section".($post_text_columns > 1 ? " class='text_columns columns_".$post_text_columns."'" : "").">".$post_content."</section>";
			}

			if($article_content != '')
			{
				echo "<article".$article_attr." class='post_type_".$post->post_type."'>".$article_content."</article>";

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