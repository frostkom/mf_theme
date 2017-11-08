<?php

function cron_theme()
{
	list($options_params, $options) = get_params();

	if(isset($options['style_source']) && $options['style_source'] != '')
	{
		$style_source = trim($options['style_source'], "/");

		if($style_source != get_site_url())
		{
			if(filter_var($style_source, FILTER_VALIDATE_URL))
			{
				list($content, $headers) = get_url_content($style_source."/wp-content/themes/mf_theme/include/ajax.php?type=get_style_source", true);

				if(isset($headers['http_code']) && $headers['http_code'] == 200)
				{
					$json = json_decode($content, true);

					if(isset($json['success']) && $json['success'] == true)
					{
						$style_changed = $json['response']['style_changed'];
						$style_url = $json['response']['style_url'];

						update_option('option_theme_source_style_url', ($style_changed > get_option('option_theme_saved') ? $style_url : ""), 'no');
					}

					else
					{
						do_log(sprintf(__("The feed from %s returned an error", 'lang_theme'), $style_source));
					}
				}

				else
				{
					do_log(sprintf(__("The response from %s had an error (%s)", 'lang_theme'), $style_source, $headers['http_code']));
				}
			}

			else
			{
				do_log(sprintf(__("I could not process the feed from %s since the URL was not a valid one", 'lang_theme'), $style_source));
			}
		}
	}

	list($upload_path, $upload_url) = get_uploads_folder('mf_theme');
	get_file_info(array('path' => $upload_path, 'callback' => "delete_files"));
}

if(!function_exists('get_search_page'))
{
	function get_search_page()
	{
		return "<article>
			<h1>".__("No results", 'lang_theme')."</h1>
			<section>
				<p>".sprintf(__("I could not find any results for '%s'", 'lang_theme'), get_query_var('s'))."</p>
			</section>
		</article>";
	}
}

if(!function_exists('is_heading_visible'))
{
	function is_heading_visible($post)
	{
		if($post->post_type == 'page')
		{
			$meta_prefix = "mf_theme_";

			$post_meta = get_post_meta($post->ID, $meta_prefix.'display_heading', true);

			return $post_meta != 'no' ? true : false;
		}

		else
		{
			return true;
		}
	}
}

if(!function_exists('head_theme'))
{
	function head_theme()
	{
		enqueue_theme_fonts();

		$template_url = get_bloginfo('template_url');
		$theme_version = get_theme_version();

		mf_enqueue_style('style', $template_url."/include/style.php", $theme_version);

		list($options_params, $options) = get_params();

		$header_fixed = isset($options['header_fixed']) && $options['header_fixed'] == 2 ? true : false;

		mf_enqueue_script('script_theme', $template_url."/include/script.js", array('template_url' => $template_url, 'header_fixed' => $header_fixed), $theme_version);
	}
}

if(!function_exists('body_class_theme'))
{
	function body_class_theme($classes)
	{
		global $post;

		if(isset($post) && isset($post->ID) && $post->ID > 0)
		{
			$meta_prefix = "mf_theme_";

			$body_class = get_post_meta($post->ID, $meta_prefix.'body_class', true);

			if($body_class)
			{
				$classes[] = $body_class;
			}
		}

		return $classes;
	}
}

if(!function_exists('content_meta_theme'))
{
	function content_meta_theme($html, $post)
	{
		if($post->post_type == 'post')
		{
			$html .= "<span class='date grey'>".format_date($post->post_date)."</span>";
		}

		return $html;
	}
}

if(!function_exists('setup_theme'))
{
	function setup_theme()
	{
		load_theme_textdomain('lang_theme', get_template_directory()."/lang");

		register_nav_menus(array(
			'primary' => __("Primary Navigation", 'lang_theme'),
			'secondary' => __("Secondary Navigation", 'lang_theme'),
			//'footer' => __("Footer Navigation", 'lang_theme')
		));
	}
}

if(!function_exists('get_params'))
{
	function get_params()
	{
		//$bg_placeholder = "#ffffff, rgba(0, 0, 0, .3), url(background.png)";

		$options_params = get_params_theme_core();

				/*$options_params[] = array('category' => " - ".__("Text", 'lang_theme'), 'id' => 'mf_theme_content_text');
					$options_params[] = array('type' => "text", 'id' => 'section_bg', 'title' => __("Background", 'lang_theme'));
					$options_params[] = array('type' => "text", 'id' => 'section_size', 'title' => __("Size", 'lang_theme'), 'default' => "1.6em");
					$options_params[] = array('type' => "text", 'id' => 'section_line_height', 'title' => __("Line Height", 'lang_theme'), 'default' => "1.5");
					$options_params[] = array('type' => "text", 'id' => 'section_margin', 'title' => __("Margin", 'lang_theme'), 'default' => "0 0 2em");
					$options_params[] = array('type' => "text", 'id' => 'section_padding', 'title' => __("Padding", 'lang_theme'));
					$options_params[] = array('type' => "text", 'id' => 'section_margin_between', 'title' => __("Margin between Content", 'lang_theme'), 'default' => "1em");
					$options_params[] = array('type' => "color", 'id' => 'article_url_color', 'title' => __("Link Color", 'lang_theme'));
				$options_params[] = array('category_end' => "");

			if(is_active_widget_area('widget_sidebar_left') || is_active_widget_area('widget_after_content') || is_active_widget_area('widget_sidebar'))
			{
				$options_params[] = array('category' => __("Aside", 'lang_theme'), 'id' => 'mf_theme_aside');
					$options_params[] = array('type' => "text", 'id' => 'aside_width', 'title' => __("Width", 'lang_theme'), 'default' => "28%");
					$options_params[] = array('type' => "text", 'id' => 'aside_widget_background', 'title' => __("Widget Background", 'lang_theme'), 'placeholder' => $bg_placeholder); //, 'default' => "#f8f8f8"
					$options_params[] = array('type' => "text", 'id' => 'aside_widget_border', 'title' => __("Widget Border", 'lang_theme')); //, 'default' => "1px solid #d8d8d8"
					$options_params[] = array('type' => "text", 'id' => 'aside_heading_bg', 'title' => __("Background", 'lang_theme')." (H3)");
					$options_params[] = array('type' => "text", 'id' => 'aside_heading_border_bottom', 'title' => __("Border Bottom", 'lang_theme')." (H3)");
					$options_params[] = array('type' => "text", 'id' => 'aside_heading_size', 'title' => __("Size", 'lang_theme')." (H3)");
					$options_params[] = array('type' => "text", 'id' => 'aside_heading_padding', 'title' => __("Padding", 'lang_theme')." (H3)", 'default' => ".5em");
					$options_params[] = array('type' => "text", 'id' => 'aside_size', 'title' => __("Size", 'lang_theme')." (".__("Content", 'lang_theme').")");
					$options_params[] = array('type' => "text", 'id' => 'aside_line_height', 'title' => __("Line Height", 'lang_theme')." (".__("Content", 'lang_theme').")");
					$options_params[] = array('type' => "text", 'id' => 'aside_padding', 'title' => __("Padding", 'lang_theme')." (".__("Content", 'lang_theme').")", 'default' => ".5em");
				$options_params[] = array('category_end' => "");
			}

			if(is_active_widget_area('widget_pre_footer'))
			{
				$options_params[] = array('category' => __("Pre Footer", 'lang_theme'), 'id' => 'mf_theme_pre_footer');
					$options_params[] = array('type' => "checkbox", 'id' => 'pre_footer_full_width', 'title' => __("Full Width", 'lang_theme'), 'default' => 1);
					$options_params[] = array('type' => "text", 'id' => 'pre_footer_bg', 'title' => __("Background", 'lang_theme'), 'placeholder' => $bg_placeholder);
					$options_params[] = array('type' => "text", 'id' => 'pre_footer_padding', 'title' => __("Padding", 'lang_theme'));
						$options_params[] = array('type' => "text", 'id' => 'pre_footer_widget_padding', 'title' => __("Widget Padding", 'lang_theme'), 'default' => "0 0 .5em");
				$options_params[] = array('category_end' => "");
			}

			$options_params[] = array('category' => __("Footer", 'lang_theme'), 'id' => 'mf_theme_footer');
				$options_params[] = array('type' => "text", 'id' => 'footer_bg', 'title' => __("Background", 'lang_theme'), 'placeholder' => $bg_placeholder); //This is used as the default background on body to make the background go all the way down below the footer if present

				if(is_active_widget_area('widget_footer'))
				{
					$options_params[] = array('type' => "text", 'id' => 'footer_padding', 'title' => __("Padding", 'lang_theme'));
					$options_params[] = array('type' => "text", 'id' => 'footer_font_size', 'title' => __("Font size", 'lang_theme'), 'default' => "1.8em");
					$options_params[] = array('type' => "color", 'id' => 'footer_color', 'title' => __("Text Color", 'lang_theme'));
						$options_params[] = array('type' => "color", 'id' => 'footer_color_hover', 'title' => " - ".__("Text Color", 'lang_theme')." (".__("Hover", 'lang_theme').")", 'show_if' => 'footer_color');
						$options_params[] = array('type' => "checkbox", 'id' => 'footer_widget_flex', 'title' => __("Widget Flex", 'lang_theme'), 'default' => 2);
						$options_params[] = array('type' => "overflow", 'id' => 'footer_widget_overflow', 'title' => __("Widget Overflow", 'lang_theme'), 'default' => "hidden");
						$options_params[] = array('type' => "text", 'id' => 'footer_widget_padding', 'title' => __("Widget Padding", 'lang_theme'), 'default' => ".2em");
					$options_params[] = array('type' => "text", 'id' => 'footer_widget_heading_margin', 'title' => __("Widget Heading Margin", 'lang_theme'), 'default' => "0 0 .5em");
					$options_params[] = array('type' => "text_transform", 'id' => 'footer_widget_heading_text_transform', 'title' => __("Widget Heading Text Transform", 'lang_theme'), 'default' => "uppercase");
					$options_params[] = array('type' => "text", 'id' => 'footer_p_margin', 'title' => __("Paragraph/List Margin", 'lang_theme'), 'default' => "0 0 .5em");
					$options_params[] = array('type' => "text", 'id' => 'footer_a_bg', 'title' => __("Link Background", 'lang_theme'));
					$options_params[] = array('type' => "text", 'id' => 'footer_a_margin', 'title' => __("Link Margin", 'lang_theme'));
					$options_params[] = array('type' => "text", 'id' => 'footer_a_padding', 'title' => __("Link Padding", 'lang_theme'), 'default' => ".4em .6em");
				}

			$options_params[] = array('category_end' => "");

			$options_params[] = array('category' => __("Custom", 'lang_theme'), 'id' => 'mf_theme_generic');
				$options_params[] = array('type' => "textarea", 'id' => 'custom_css_all', 'title' => __("Custom CSS", 'lang_theme'));
				$options_params[] = array('type' => "textarea", 'id' => 'custom_css_mobile', 'title' => __("Custom CSS", 'lang_theme')." (".__("Mobile", 'lang_theme').")", 'show_if' => 'mobile_breakpoint');
			$options_params[] = array('category_end' => "");*/

		return gather_params($options_params);
	}
}

if(!function_exists('widgets_theme'))
{
	function widgets_theme()
	{
		register_sidebar(array(
			'name' => __("Header", 'lang_theme'),
			'id' => 'widget_header',
			'before_widget' => "",
			'before_title' => "<div>",
			'after_title' => "</div>",
			'after_widget' => ""
		));

		if(is_active_widget_area('widget_header'))
		{
			register_sidebar(array(
				'name' => __("After Header", 'lang_theme'),
				'id' => 'widget_after_header',
				'before_widget' => "<div class='widget %s %s'>",
				'before_title' => "<div>",
				'after_title' => "</div>",
				'after_widget' => "</div>"
			));

			register_sidebar(array(
				'name' => __("Slide menu", 'lang_theme'),
				'id' => 'widget_slide',
				'before_widget' => "",
				'before_title' => "",
				'after_title' => "",
				'after_widget' => ""
			));
		}

		register_sidebar(array(
			'name' => __("Pre Content", 'lang_theme'),
			'id' => 'widget_front',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>"
		));

		register_sidebar(array(
			'name' => __("Aside", 'lang_theme')." (".__("Left", 'lang_theme').")",
			'id' => 'widget_sidebar_left',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>"
		));

		register_sidebar(array(
			'name' => __("Below Main Column", 'lang_theme'),
			'id' => 'widget_after_content',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>"
		));

		register_sidebar(array(
			'name' => __("Aside", 'lang_theme')." (".__("Right", 'lang_theme').")",
			'id' => 'widget_sidebar',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>"
		));

		if(is_active_widget_area('widget_footer'))
		{
			register_sidebar(array(
				'name' => __("Pre Footer", 'lang_theme'),
				'id' => 'widget_pre_footer',
				'before_widget' => "<div class='widget %s %s'>",
				'before_title' => "<h3>",
				'after_title' => "</h3>",
				'after_widget' => "</div>"
			));
		}

		register_sidebar(array(
			'name' => __("Footer", 'lang_theme'),
			'id' => 'widget_footer',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>"
		));

		register_sidebar(array(
			'name' => __("Window Side Icons", 'lang_theme'),
			'id' => 'widget_window_side',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>"
		));

		register_widget('widget_theme_menu');
	}
}

if(!function_exists('meta_boxes_theme'))
{
	function meta_boxes_theme($meta_boxes)
	{
		$meta_prefix = "mf_theme_";

		$meta_boxes[] = array(
			'id' => 'settings',
			'title' => __("Settings", 'lang_theme'),
			'post_types' => array('page'),
			'context' => 'side',
			'priority' => 'low',
			'fields' => array(
				array(
					'name' => __("Display Heading", 'lang_theme'),
					'id' => $meta_prefix.'display_heading',
					'type' => 'select',
					'options' => get_yes_no_for_select(),
					'std' => 'yes',
				),
				array(
					'name' => __("Text Columns", 'lang_theme'),
					'id' => $meta_prefix.'text_columns',
					'type' => 'number',
					'std' => 1,
					'attributes' => array(
						'min' => 1,
						'max' => 2,
					),
				),
				array(
					'name' => __("Body Class", 'lang_theme'),
					'id' => $meta_prefix.'body_class',
					'type' => 'text',
				),
			)
		);

		return $meta_boxes;
	}
}

if(!function_exists('is_clean'))
{
	function is_clean($class = "")
	{
		$class .= (isset($_GET['clean']) ? " hide" : "");

		return ($class != '' ? " class='".$class."'" : "");
	}
}

if(!function_exists('get_menu_theme'))
{
	function get_menu_theme($data = array())
	{
		if(!isset($data['where'])){		$data['where'] = "";}
		if(!isset($data['type'])){		$data['type'] = "";}

		$out = "";

		if($data['type'] == 'slide')
		{
			$out .= "<nav>
				<a href='#' id='slide_nav'>
					".__("Menu", 'lang_theme')." <i class='fa fa-bars'></i>
				</a>
			</nav>";
		}

		else
		{
			if(in_array($data['type'], array('', 'secondary', 'both')))
			{
				$nav_content = wp_nav_menu(array('theme_location' => 'secondary', 'menu' => 'Secondary', 'container' => "div", 'container_override' => false, 'fallback_cb' => false, 'echo' => false));

				if($nav_content != '')
				{
					$out .= "<nav id='secondary_nav' class='theme_nav is_mobile_ready'>"
						.$nav_content
					."</nav>";
				}
			}

			if(in_array($data['type'], array('', 'main', 'both')))
			{
				$nav_content = wp_nav_menu(array('theme_location' => 'primary', 'menu' => 'Main', 'container' => "div", 'container_override' => false, 'echo' => false));

				if($nav_content != '')
				{
					if($data['where'] == 'widget_slide')
					{
						$out .= "<nav id='primary_nav' class='theme_nav'>"
							.$nav_content
						."</nav>";
					}

					else
					{
						$out .= "<nav id='primary_nav' class='theme_nav is_mobile_ready'>
							<i class='fa fa-bars toggle_icon'></i>
							<i class='fa fa-close toggle_icon'></i>"
							.$nav_content
						."</nav>";
					}
				}
			}
		}

		return $out;
	}
}

if(!function_exists('get_more_posts'))
{
	function get_more_posts($data = array())
	{
		global $wpdb;

		if(!isset($data['limit_start'])){	$data['limit_start'] = 0;}

		$out = "";

		$posts_per_page = get_option('posts_per_page');

		$result = $wpdb->get_results("SELECT * FROM ".$wpdb->posts." WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC LIMIT ".esc_sql($data['limit_start']).", ".(esc_sql($posts_per_page) + 1));

		$i = 0;

		foreach($result as $post)
		{
			$post_id = $post->ID;
			$post_title = $post->post_title;
			$post_excerpt = $post->post_excerpt;
			$post_content = apply_filters('the_content', $post->post_content);

			if($i < $posts_per_page)
			{
				$post_url = get_permalink($post);

				$post_meta = apply_filters('the_content_meta', "", $post);

				$post_url_start = "<a href='".$post_url."'>";
				$post_url_end = "</a>";

				$post_thumbnail = "";

				if(has_post_thumbnail($post_id))
				{
					$post_thumbnail = get_the_post_thumbnail($post_id, 'full');
				}

				$out .= "<article>";

					if($post_thumbnail != '')
					{
						$out .= "<div class='image'>".$post_thumbnail."</div>";
					}

					$out .= "<h1>"
						.$post_url_start
							.$post_title
						.$post_url_end
					."</h1>"
					.($post_meta != '' ? "<div class='meta'>".$post_meta."</div>" : "")
					."<section>";

						if($post_excerpt != '')
						{
							$out .= "<p>".$post_excerpt."</p>
							<p>"
								.$post_url_start
									.__("Read More", 'lang_theme')
								.$post_url_end
							."</p>";
						}

						else
						{
							$out .= $post_content;
						}

					$out .= "</section>
				</article>";

				$i++;
			}

			else
			{
				$out .= "<a href='#' id='load_more' rel='".$i."'>".__("Load more posts", 'lang_theme')."</a>";

				break;
			}
		}

		return $out;
	}
}