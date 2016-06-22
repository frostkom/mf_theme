<?php

include_once("include/classes.php");

add_action('after_setup_theme', 'setup_theme');
add_action('widgets_init', 'widgets_theme');
add_action('customize_register', 'customize_theme');
add_action('admin_menu', 'options_theme');

add_theme_support('post-thumbnails');

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

		add_post_type_support('page', 'excerpt');

		remove_action('wp_head', 'wp_print_scripts');
		remove_action('wp_head', 'wp_print_head_scripts', 9);
		remove_action('wp_head', 'wp_enqueue_scripts', 1);
		add_action('wp_footer', 'wp_print_scripts', 5);
		add_action('wp_footer', 'wp_enqueue_scripts', 5);
		add_action('wp_footer', 'wp_print_head_scripts', 5);
	}
}

if(!function_exists('options_theme'))
{
	function options_theme()
	{
		add_theme_page(__("Theme Options", 'lang_theme'), __("Theme Options", 'lang_theme'), 'edit_theme_options', 'theme_options', 'options_page_theme');
	}
}

if(!function_exists('options_page_theme'))
{
	function options_page_theme()
	{
		echo get_options_page_theme_core(array('dir' => "mf_theme"));
	}
}

if(!function_exists('get_params'))
{
	function get_params()
	{
		$options_params = array();

		$bg_placeholder = "#ffffff, rgba(0, 0, 0, .3), url(background.png)";

		$options_params[] = array('category' => __("Generic", 'lang_theme'), 'id' => "mf_theme_body");
			$options_params[] = array('type' => "checkbox", 'id' => "body_history", 'title' => __("Use HTML5 History", 'lang_theme'), 'default' => 1);
			$options_params[] = array('type' => "text", 'id' => "body_bg", 'title' => __("Background", 'lang_theme'), 'placeholder' => $bg_placeholder);
				$options_params[] = array('type' => "font", 'id' => "body_font", 'title' => __("Font", 'lang_theme'));
				$options_params[] = array('type' => "color", 'id' => "body_color", 'title' => __("Text Color", 'lang_theme'));
				$options_params[] = array('type' => "color", 'id' => "body_link_color", 'title' => __("Link Color", 'lang_theme'));
				$options_params[] = array('type' => "text", 'id' => "body_font_size", 'title' => __("Font size", 'lang_theme'), 'default' => "1.2vw");
				$options_params[] = array('type' => "text", 'id' => "body_desktop_font_size", 'title' => __("Font size", 'lang_theme')." (".__("Desktop", 'lang_theme').")", 'default' => ".625em");
				$options_params[] = array('type' => "number", 'id' => "website_max_width", 'title' => __("Website Max Width", 'lang_theme'), 'default' => "1100");
				$options_params[] = array('type' => "number", 'id' => "mobile_breakpoint", 'title' => __("Mobile Breakpoint", 'lang_theme'), 'default' => "600");
				$options_params[] = array('type' => "text", 'id' => "main_padding", 'title' => __("Padding", 'lang_theme'), 'default' => "0 1em");
		$options_params[] = array('category_end' => "");

			$options_params[] = array('category' => __("Header", 'lang_theme'), 'id' => "mf_theme_header");
				$options_params[] = array('type' => "checkbox", 'id' => "header_fixed", 'title' => __("Fixed", 'lang_theme'), 'default' => 1);
				$options_params[] = array('type' => "text",	'id' => "header_bg", 'title' => __("Background", 'lang_theme'), 'placeholder' => $bg_placeholder);
				$options_params[] = array('type' => "text", 'id' => "header_overflow", 'title' => __("Overflow", 'lang_theme'));
				$options_params[] = array('type' => "text",	'id' => "header_padding", 'title' => __("Padding", 'lang_theme'), 'default' => "1em 2em");
				$options_params[] = array('type' => "image", 'id' => "header_logo", 'title' => __("Logo", 'lang_theme'));
					$options_params[] = array('type' => "image", 'id' => "header_mobile_logo", 'title' => __("Logo", 'lang_theme')." (".__("Mobile", 'lang_theme').")");
					$options_params[] = array('type' => "checkbox", 'id' => "logo_mobile_visible", 'title' => __("Show Logo on small screens", 'lang_theme'), 'default' => 2);
					$options_params[] = array('type' => "font",	'id' => "logo_font", 'title' => __("Logo Font", 'lang_theme'));
					$options_params[] = array('type' => "text", 'id' => "logo_font_size", 'title' => __("Logo Font Size", 'lang_theme'), 'default' => "3em");
					$options_params[] = array('type' => "color", 'id' => "logo_color", 'title' => __("Logo Color", 'lang_theme'));
					$options_params[] = array('type' => "text", 'id' => "logo_padding", 'title' => __("Logo Padding", 'lang_theme'), 'default' => '20px 0');
					$options_params[] = array('type' => "text", 'id' => "logo_width", 'title' => __("Logo Width", 'lang_theme'), 'default' => '14em');
					$options_params[] = array('type' => "text", 'id' => "logo_width_mobile", 'title' => __("Logo Width", 'lang_theme')." (".__("Mobile", 'lang_theme').")", 'default' => '20em');
			$options_params[] = array('category_end' => "");

			$options_params[] = array('category' => __("Navigation", 'lang_theme'), 'id' => "mf_theme_navigation");
				$options_params[] = array('type' => "font", 'id' => "nav_font", 'title' => __("Font", 'lang_theme'));
				$options_params[] = array('type' => "text", 'id' => "nav_size", 'title' => __("Size", 'lang_theme'), 'default' => "2em");
				$options_params[] = array('type' => "color", 'id' => "nav_color", 'title' => __("Color", 'lang_theme'));
					$options_params[] = array('type' => "color", 'id' => "nav_underline_color_hover", 'title' => __("Underline Color", 'lang_theme')." (".__("Hover", 'lang_theme').")");
					$options_params[] = array('type' => "color", 'id' => "nav_color_hover", 'title' => __("Color", 'lang_theme')." (".__("Hover", 'lang_theme').")");
				$options_params[] = array('type' => "text", 'id' => "nav_link_padding", 'title' => __("Link Padding", 'lang_theme'), 'default' => "30px 1em 20px");
			$options_params[] = array('category_end' => "");

			$options_params[] = array('category' => __("Pre Content", 'lang_theme'), 'id' => "mf_theme_front");
				$options_params[] = array('type' => "text", 'id' => "front_bg", 'title' => __("Background", 'lang_theme'), 'placeholder' => $bg_placeholder);
				$options_params[] = array('type' => "text", 'id' => "front_padding", 'title' => __("Padding", 'lang_theme'));
			$options_params[] = array('category_end' => "");

			$options_params[] = array('category' => __("Content", 'lang_theme'), 'id' => "mf_theme_content");
				$options_params[] = array('type' => "text", 'id' => "content_bg", 'title' => __("Background", 'lang_theme'), 'placeholder' => $bg_placeholder);
				$options_params[] = array('type' => "text", 'id' => "content_padding", 'title' => __("Padding", 'lang_theme'), 'default' => "1em 2em");
					$options_params[] = array('type' => "checkbox", 'id' => "heading_front_visible", 'title' => __("Show heading on front page", 'lang_theme'), 'default' => 2);
					$options_params[] = array('type' => "font", 'id' => "heading_font", 'title' => __("Font", 'lang_theme')." (H1)");
					$options_params[] = array('type' => "text", 'id' => "heading_size", 'title' => __("Size", 'lang_theme')." (H1)", 'default' => "2.2em");
					$options_params[] = array('type' => "text", 'id' => "heading_weight", 'title' => __("Weight", 'lang_theme')." (H1)");
					$options_params[] = array('type' => "text", 'id' => "heading_margin", 'title' => __("Margin", 'lang_theme')." (H1)", 'default' => ".3em .5em .5em");
					$options_params[] = array('type' => "font", 'id' => "heading_font_h2", 'title' => __("Font", 'lang_theme')." (H2)");
					$options_params[] = array('type' => "text", 'id' => "heading_size_h2", 'title' => __("Size", 'lang_theme')." (H2)");
					$options_params[] = array('type' => "text", 'id' => "heading_border_bottom", 'title' => __("Heading Border Bottom", 'lang_theme'));
					$options_params[] = array('type' => "text", 'id' => "section_size", 'title' => __("Size", 'lang_theme'), 'default' => "1.6em");
					$options_params[] = array('type' => "text", 'id' => "section_line_height", 'title' => __("Line Height", 'lang_theme'), 'default' => "1.5");
					$options_params[] = array('type' => "text", 'id' => "section_margin", 'title' => __("Content Margin", 'lang_theme'), 'default' => "0 0 2em 0");
					$options_params[] = array('type' => "color", 'id' => "article_url_color", 'title' => __("Article Link Color", 'lang_theme'));
			$options_params[] = array('category_end' => "");

			$options_params[] = array('category' => __("Aside", 'lang_theme'), 'id' => "mf_theme_aside");
				$options_params[] = array('type' => "text", 'id' => "aside_size", 'title' => __("Size", 'lang_theme'));
				$options_params[] = array('type' => "text", 'id' => "aside_line_height", 'title' => __("Line Height", 'lang_theme'));
			$options_params[] = array('category_end' => "");

			$options_params[] = array('category' => __("Pre Footer", 'lang_theme'), 'id' => "mf_theme_pre_footer");
				$options_params[] = array('type' => "text", 'id' => "pre_footer_bg", 'title' => __("Background", 'lang_theme'), 'placeholder' => $bg_placeholder);
				$options_params[] = array('type' => "text", 'id' => "pre_footer_padding", 'title' => __("Padding", 'lang_theme'));
			$options_params[] = array('category_end' => "");

			$options_params[] = array('category' => __("Footer", 'lang_theme'), 'id' => "mf_theme_footer");
				$options_params[] = array('type' => "text",	'id' => "footer_bg", 'title' => __("Background", 'lang_theme'), 'placeholder' => $bg_placeholder);
				$options_params[] = array('type' => "text", 'id' => "footer_font_size", 'title' => __("Font size", 'lang_theme'), 'default' => "1.8em");
				$options_params[] = array('type' => "color", 'id' => "footer_color", 'title' => __("Color", 'lang_theme'));
				$options_params[] = array('type' => "text",	'id' => "footer_a_bg", 'title' => __("Link Background", 'lang_theme'));
				$options_params[] = array('type' => "text", 'id' => "footer_margin", 'title' => __("Margin", 'lang_theme'), 'default' => "0 0 .3em");
				$options_params[] = array('type' => "text", 'id' => "footer_padding", 'title' => __("Padding", 'lang_theme'), 'default' => "1em 2em");
					$options_params[] = array('type' => "checkbox", 'id' => "footer_widget_flex", 'title' => __("Widget Flex", 'lang_theme'), 'default' => 2);
					$options_params[] = array('type' => "text", 'id' => "footer_widget_overflow", 'title' => __("Widget Overflow", 'lang_theme'), 'default' => "hidden");
					$options_params[] = array('type' => "text", 'id' => "footer_widget_padding", 'title' => __("Widget Padding", 'lang_theme'), 'default' => ".2em");
				$options_params[] = array('type' => "text", 'id' => "footer_widget_heading_size", 'title' => __("Widget Heading Size", 'lang_theme'), 'default' => "1.3em");
				$options_params[] = array('type' => "text", 'id' => "footer_widget_heading_margin", 'title' => __("Widget Heading Margin", 'lang_theme'), 'default' => "0 0 .5em");
				$options_params[] = array('type' => "text", 'id' => "footer_widget_heading_text_transform", 'title' => __("Widget Heading Text Transform", 'lang_theme'), 'default' => "uppercase");
			$options_params[] = array('category_end' => "");

			$options_params[] = array('category' => __("Custom", 'lang_theme'), 'id' => "mf_theme_generic");
				$options_params[] = array('type' => "textarea",	'id' => "custom_css_all", 'title' => __("Custom CSS", 'lang_theme'));
				$options_params[] = array('type' => "textarea",	'id' => "custom_css_mobile", 'title' => __("Custom CSS", 'lang_theme')." (".__("Mobile", 'lang_theme').")");
			$options_params[] = array('category_end' => "");

		$options = array();

		//Maybe use get_theme_mods() instead?

		foreach($options_params as $param)
		{
			if(!isset($param['category']) && !isset($param['category_end']))
			{
				$default = isset($param['default']) ? $param['default'] : "";

				$options[$param['id']] = get_theme_mod($param['id'], $default);
			}
		}

		return array($options_params, $options);
	}
}

if(!function_exists('widgets_theme'))
{
	function widgets_theme()
	{
		register_sidebar(array(
			'name' => __("Header", 'lang_theme'),
			'id' => 'widget_header',
			'description' => __("The widget area", 'lang_theme'),
			'before_widget' => "",
			'before_title' => '<div>',
			'after_title' => '</div>',
			'after_widget' => ""
		));

		register_sidebar(array(
			'name' => __("Slide menu", 'lang_theme'),
			'id' => 'widget_slide',
			'description' => __("The widget area", 'lang_theme'),
			'before_widget' => "",
			'before_title' => '',
			'after_title' => '',
			'after_widget' => ''
		));

		register_sidebar(array(
			'name' => __("Pre Content", 'lang_theme'),
			'id' => 'widget_front',
			'description' => __("The widget area", 'lang_theme'),
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => '<h3>',
			'after_title' => '</h3>',
			'after_widget' => '</div>'
		));

		register_sidebar(array(
			'name' => __("Sidebar", 'lang_theme'),
			'id' => 'widget_sidebar',
			'description' => __("The widget area", 'lang_theme'),
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => '<h3>',
			'after_title' => '</h3>',
			'after_widget' => '</div>'
		));

		register_sidebar(array(
			'name' => __("Pre Footer", 'lang_theme'),
			'id' => 'widget_pre_footer',
			'description' => __("The widget area", 'lang_theme'),
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => '<h3>',
			'after_title' => '</h3>',
			'after_widget' => '</div>'
		));

		register_sidebar(array(
			'name' => __("Footer", 'lang_theme'),
			'id' => 'widget_footer',
			'description' => __("The widget area", 'lang_theme'),
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => '<h3>',
			'after_title' => '</h3>',
			'after_widget' => '</div>'
		));

		register_widget('widget_theme_logo');
		register_widget('widget_theme_menu');
	}
}

if(!function_exists('get_logo_theme'))
{
	function get_logo_theme($options = "")
	{
		if($options == "")
		{
			list($options_params, $options) = get_params();
		}

		$out = "<a href='".get_site_url()."/' id='site_logo'>";

			if($options['header_logo'] != '' || $options['header_mobile_logo'] != '')
			{
				if($options['header_logo'] != '')
				{
					$out .= "<img src='".$options['header_logo']."'".($options['header_mobile_logo'] != '' ? " class='hide_if_mobile'" : "")." alt='".__("Site logo", 'lang_theme')."'>";
				}

				if($options['header_mobile_logo'] != '')
				{
					$out .= "<img src='".$options['header_mobile_logo']."'".($options['header_logo'] != '' ? " class='show_if_mobile'" : "")." alt='".__("Site mobile logo", 'lang_theme')."'>";
				}
			}

			else
			{
				$site_name = get_bloginfo('name');
				$site_description = get_bloginfo('description');

				$out .= "<div>".$site_name."</div>";

				if($site_description != '')
				{
					$out .= "<span>".$site_description."</span>";
				}
			}

		$out .= "</a>";

		return $out;
	}
}

if(!function_exists('get_search_theme'))
{
	function get_search_theme()
	{
		return "<form action='".get_site_url()."' method='get' class='searchform'>
			<input type='text' name='s' value='".get_query_var('s')."' placeholder='".__("Search for", 'lang_theme')."...'>
		</form>";
	}
}

if(!function_exists('get_menu_theme'))
{
	function get_menu_theme($type = "")
	{
		$out = "";

		if($type == "slide")
		{
			$out .= "<nav>
				<a href='#' id='slide_nav'>
					".__("Menu", 'lang_theme')." <i class='fa fa-bars'></i>
				</a>
			</nav>";
		}

		else
		{
			if(in_array($type, array('', 'secondary', 'both')))
			{
				$wp_menu = wp_nav_menu(array('theme_location' => 'secondary', 'menu' => 'Secondary', 'container' => "div", 'container_override' => false, 'fallback_cb' => false, 'echo' => false));

				if($wp_menu != '')
				{
					$out .= "<nav id='secondary_nav'>"
						.$wp_menu
					."</nav>";
				}
			}

			if(in_array($type, array('', 'main', 'both')))
			{
				$wp_menu = wp_nav_menu(array('theme_location' => 'primary', 'menu' => 'Main', 'container' => "div", 'container_override' => false, 'echo' => false));

				if($wp_menu != '')
				{
					$out .= "<nav id='primary_nav' class='is_mobile_ready'>
						<i class='fa fa-bars toggle_icon'></i>
						<i class='fa fa-close toggle_icon'></i>"
						.$wp_menu
					."</nav>";
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

		foreach($result as $r)
		{
			$post_id = $r->ID;
			$post_title = $r->post_title;
			$post_excerpt = $r->post_excerpt;
			$post_content = apply_filters('the_content', $r->post_content);

			if($i < $posts_per_page)
			{
				$post_url = get_permalink($r);

				$post_url_start = "<a href='".$post_url."'>";
				$post_url_end = "</a>";

				$post_thumbnail = "";

				if(has_post_thumbnail($post_id))
				{
					$post_thumbnail = get_the_post_thumbnail($post_id);
				}

				$out .= "<li>
					<div>".$post_thumbnail."</div>
					<div>
						<h1>"
							.$post_url_start
								.$post_title
							.$post_url_end
						."</h1>
						<section>";

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
					</div>
				</li>";

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