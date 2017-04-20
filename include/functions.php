<?php

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

		mf_enqueue_style('style', $template_url."/include/style.php", get_plugin_version(__FILE__));

		list($options_params, $options) = get_params();

		$header_fixed = isset($options['header_fixed']) && $options['header_fixed'] == 2 ? true : false;

		mf_enqueue_script('script_theme', $template_url."/include/script.js", array('template_url' => $template_url, 'header_fixed' => $header_fixed), get_plugin_version(__FILE__));
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

		$arr_sidebars = wp_get_sidebars_widgets();

		$bg_placeholder = "#ffffff, rgba(0, 0, 0, .3), url(background.png)";

		$options_params[] = array('category' => __("Generic", 'lang_theme'), 'id' => 'mf_theme_body');
			$options_params[] = array('type' => "text", 'id' => 'body_bg', 'title' => __("Background", 'lang_theme'), 'default' => "#fff", 'placeholder' => $bg_placeholder);
				$options_params[] = array('type' => "text", 'id' => 'main_padding', 'title' => __("Padding", 'lang_theme'), 'default' => "1em 2em");
				$options_params[] = array('type' => "color", 'id' => 'body_color', 'title' => __("Text Color", 'lang_theme'));
				$options_params[] = array('type' => "color", 'id' => 'body_link_color', 'title' => __("Link Color", 'lang_theme'));
				$options_params[] = array('type' => "color", 'id' => 'button_color', 'title' => __("Button Color", 'lang_theme'));
					$options_params[] = array('type' => "color", 'id' => 'button_color_hover', 'title' => " - ".__("Button Color", 'lang_theme')." (".__("Hover", 'lang_theme').")", 'show_if' => 'button_color');
				$options_params[] = array('type' => "font", 'id' => 'body_font', 'title' => __("Font", 'lang_theme'));
				$options_params[] = array('type' => "number", 'id' => 'website_max_width', 'title' => __("Max Width", 'lang_theme'), 'default' => "1100");
				$options_params[] = array('type' => "text", 'id' => 'body_desktop_font_size', 'title' => __("Font Size", 'lang_theme'), 'default' => ".625em");
				$options_params[] = array('type' => "number", 'id' => 'mobile_breakpoint', 'title' => __("Breakpoint", 'lang_theme')." (".__("Mobile", 'lang_theme').")", 'default' => "600");
				$options_params[] = array('type' => "text", 'id' => 'body_font_size', 'title' => __("Font Size", 'lang_theme')." (".__("Mobile", 'lang_theme').")", 'default' => "2.4vw", 'show_if' => 'mobile_breakpoint');
		$options_params[] = array('category_end' => "");

			$options_params[] = array('category' => __("Header", 'lang_theme'), 'id' => 'mf_theme_header');
				$options_params[] = array('type' => "checkbox", 'id' => 'header_fixed', 'title' => __("Fixed", 'lang_theme'), 'default' => 1);
				$options_params[] = array('type' => "text", 'id' => 'header_bg', 'title' => __("Background", 'lang_theme'), 'placeholder' => $bg_placeholder);
				$options_params[] = array('type' => "text", 'id' => 'header_padding', 'title' => __("Padding", 'lang_theme'));
				$options_params[] = array('type' => "overflow", 'id' => 'header_overflow', 'title' => __("Overflow", 'lang_theme'));

				$options_params[] = array('type' => "color", 'id' => 'search_color', 'title' => __("Color", 'lang_theme')." (".__("Search", 'lang_theme').")");
				$options_params[] = array('type' => "text", 'id' => 'search_size', 'title' => __("Font Size", 'lang_theme')." (".__("Search", 'lang_theme').")", 'default' => "1.4em");
			$options_params[] = array('category_end' => "");

			$options_params[] = array('category' => __("Logo", 'lang_theme'), 'id' => 'mf_theme_logo');
				$options_params[] = array('type' => "text", 'id' => 'logo_padding', 'title' => __("Padding", 'lang_theme'), 'default' => '.6em 0 0');
				$options_params[] = array('type' => "image", 'id' => 'header_logo', 'title' => __("Image", 'lang_theme'));
				$options_params[] = array('type' => "text", 'id' => 'logo_width', 'title' => __("Width", 'lang_theme'), 'default' => '14em', 'show_if' => 'header_logo');
				$options_params[] = array('type' => "image", 'id' => 'header_mobile_logo', 'title' => __("Image", 'lang_theme')." (".__("Mobile", 'lang_theme').")", 'show_if' => 'mobile_breakpoint');
				//$options_params[] = array('type' => "checkbox", 'id' => 'logo_mobile_visible', 'title' => __("Show Logo on small screens", 'lang_theme'), 'default' => 2);
				$options_params[] = array('type' => "text", 'id' => 'logo_width_mobile', 'title' => __("Width", 'lang_theme')." (".__("Mobile", 'lang_theme').")", 'default' => '20em');
				$options_params[] = array('type' => "font", 'id' => 'logo_font', 'title' => __("Font", 'lang_theme'), 'hide_if' => 'header_logo');
				$options_params[] = array('type' => "text", 'id' => 'logo_font_size', 'title' => __("Font Size", 'lang_theme'), 'default' => "3em");
				$options_params[] = array('type' => "color", 'id' => 'logo_color', 'title' => __("Color", 'lang_theme'));
			$options_params[] = array('category_end' => "");

			$options_params[] = array('category' => __("Navigation", 'lang_theme'), 'id' => 'mf_theme_navigation');
				$options_params[] = array('type' => "text", 'id' => 'nav_bg', 'title' => __("Background", 'lang_theme'));
				$options_params[] = array('type' => "text", 'id' => 'nav_link_padding', 'title' => __("Link Padding", 'lang_theme'), 'default' => "1.5em 1em 1em");
				$options_params[] = array('type' => "clear", 'id' => 'nav_clear', 'title' => __("Clear", 'lang_theme'), 'default' => "right");
				$options_params[] = array('type' => "font", 'id' => 'nav_font', 'title' => __("Font", 'lang_theme'));
				$options_params[] = array('type' => "text", 'id' => 'nav_size', 'title' => __("Size", 'lang_theme'), 'default' => "2em");
				$options_params[] = array('type' => "align", 'id' => 'nav_align', 'title' => __("Align", 'lang_theme'), 'placeholder' => "left, right", 'default' => "right");
				$options_params[] = array('type' => "color", 'id' => 'nav_color', 'title' => __("Text Color", 'lang_theme'));
					$options_params[] = array('type' => "color", 'id' => 'nav_color_hover', 'title' => " - ".__("Text Color", 'lang_theme')." (".__("Hover", 'lang_theme').")");
					$options_params[] = array('type' => "color", 'id' => 'nav_underline_color_hover', 'title' => " - ".__("Underline Color", 'lang_theme')." (".__("Hover", 'lang_theme').")", 'show_if' => 'nav_color');
					$options_params[] = array('type' => "color", 'id' => 'nav_bg_current', 'title' => __("Background", 'lang_theme')." (".__("Current", 'lang_theme').")", 'show_if' => 'nav_color');
					$options_params[] = array('type' => "color", 'id' => 'nav_color_current', 'title' => __("Text Color", 'lang_theme')." (".__("Current", 'lang_theme').")", 'show_if' => 'nav_color');
			$options_params[] = array('category_end' => "");

				$options_params[] = array('category' => " - ".__("Submenu", 'lang_theme'), 'id' => 'mf_theme_navigation_sub');
					$options_params[] = array('type' => "color", 'id' => 'sub_nav_bg', 'title' => __("Background", 'lang_theme'), 'default' => "#ccc");
						$options_params[] = array('type' => "color", 'id' => 'sub_nav_bg_hover', 'title' => " - ".__("Background", 'lang_theme')." (".__("Hover", 'lang_theme').")", 'show_if' => 'sub_nav_bg');
					$options_params[] = array('type' => "color", 'id' => 'sub_nav_color', 'title' => __("Text Color", 'lang_theme'), 'default' => "#333");
						$options_params[] = array('type' => "color", 'id' => 'sub_nav_color_hover', 'title' => " - ".__("Text Color", 'lang_theme')." (".__("Hover", 'lang_theme').")", 'show_if' => 'sub_nav_color');
				$options_params[] = array('category_end' => "");

				$options_params[] = array('category' => " - ".__("Mobile Menu", 'lang_theme'), 'id' => 'mf_theme_navigation_hamburger');
					$options_params[] = array('type' => "text", 'id' => 'hamburger_font_size', 'title' => __("Size", 'lang_theme'), 'default' => "3em");
					$options_params[] = array('type' => "text", 'id' => 'hamburger_margin', 'title' => __("Margin", 'lang_theme'), 'default' => "1em .8em");
					$options_params[] = array('type' => "text", 'id' => 'hamburger_menu_bg', 'title' => __("Background", 'lang_theme')." (".__("Menu", 'lang_theme').")");
				$options_params[] = array('category_end' => "");

				if(isset($arr_sidebars['widget_slide']) && count($arr_sidebars['widget_slide']) > 0)
				{
					$options_params[] = array('category' => " - ".__("Slide Menu", 'lang_theme'), 'id' => 'mf_theme_navigation_slide');
						$options_params[] = array('type' => "text", 'id' => 'slide_nav_link_padding', 'title' => __("Link Padding", 'lang_theme'), 'default' => "1.5em 1em 1em");
						$options_params[] = array('type' => "color", 'id' => 'slide_nav_bg', 'title' => __("Background", 'lang_theme'), 'default' => "#fff");
						$options_params[] = array('type' => "color", 'id' => 'slide_nav_bg_hover', 'title' => " - ".__("Background", 'lang_theme')." (".__("Hover", 'lang_theme').")", 'show_if' => 'slide_nav_bg');
						$options_params[] = array('type' => "color", 'id' => 'slide_nav_color', 'title' => __("Text Color", 'lang_theme'));
						$options_params[] = array('type' => "color", 'id' => 'slide_nav_color_hover', 'title' => " - ".__("Text Color", 'lang_theme')." (".__("Hover", 'lang_theme').")", 'show_if' => 'slide_nav_color');
						$options_params[] = array('type' => "color", 'id' => 'slide_nav_color_current', 'title' => __("Text Color", 'lang_theme')." (".__("Current", 'lang_theme').")");
					$options_params[] = array('category_end' => "");
				}

			$options_params[] = array('category' => __("Pre Content", 'lang_theme'), 'id' => 'mf_theme_front');
				$options_params[] = array('type' => "text", 'id' => 'front_bg', 'title' => __("Background", 'lang_theme'), 'placeholder' => $bg_placeholder);
				$options_params[] = array('type' => "text", 'id' => 'front_padding', 'title' => __("Padding", 'lang_theme'));
				$options_params[] = array('type' => "color", 'id' => 'front_color', 'title' => __("Text Color", 'lang_theme'));
			$options_params[] = array('category_end' => "");

			$options_params[] = array('category' => __("Content", 'lang_theme'), 'id' => 'mf_theme_content');
				$options_params[] = array('type' => "text", 'id' => 'content_bg', 'title' => __("Background", 'lang_theme'), 'placeholder' => $bg_placeholder);
				$options_params[] = array('type' => "text", 'id' => 'content_padding', 'title' => __("Padding", 'lang_theme'));
			$options_params[] = array('category_end' => "");

				$options_params[] = array('category' => " - ".__("Headings", 'lang_theme'), 'id' => 'mf_theme_content_heading');
					//$options_params[] = array('type' => "checkbox", 'id' => 'heading_front_visible', 'title' => __("Show heading on front page", 'lang_theme'), 'default' => 2);
					$options_params[] = array('type' => "text", 'id' => 'heading_bg', 'title' => __("Background", 'lang_theme')." (H1)");
					$options_params[] = array('type' => "text", 'id' => 'heading_border_bottom', 'title' => __("Border Bottom", 'lang_theme')." (H1)");
					$options_params[] = array('type' => "font", 'id' => 'heading_font', 'title' => __("Font", 'lang_theme')." (H1)");
					$options_params[] = array('type' => "text", 'id' => 'heading_size', 'title' => __("Size", 'lang_theme')." (H1)", 'default' => "2.25em");
					$options_params[] = array('type' => "weight", 'id' => 'heading_weight', 'title' => __("Weight", 'lang_theme')." (H1)");
					$options_params[] = array('type' => "text", 'id' => 'heading_margin', 'title' => __("Margin", 'lang_theme')." (H1)");
					$options_params[] = array('type' => "text", 'id' => 'heading_padding', 'title' => __("Padding", 'lang_theme')." (H1)", 'default' => ".3em 0 .5em");
					$options_params[] = array('type' => "font", 'id' => 'heading_font_h2', 'title' => __("Font", 'lang_theme')." (H2)");
					$options_params[] = array('type' => "text", 'id' => 'heading_size_h2', 'title' => __("Size", 'lang_theme')." (H2)", 'default' => "1.5em");
					$options_params[] = array('type' => "font", 'id' => 'heading_font_h3', 'title' => __("Font", 'lang_theme')." (H3)");
					$options_params[] = array('type' => "text", 'id' => 'heading_size_h3', 'title' => __("Size", 'lang_theme')." (H3)", 'default' => "1.3em");
				$options_params[] = array('category_end' => "");

				$options_params[] = array('category' => " - ".__("Text", 'lang_theme'), 'id' => 'mf_theme_content_text');
					$options_params[] = array('type' => "text", 'id' => 'section_bg', 'title' => __("Background", 'lang_theme'));
					$options_params[] = array('type' => "text", 'id' => 'section_size', 'title' => __("Size", 'lang_theme'), 'default' => "1.6em");
					$options_params[] = array('type' => "text", 'id' => 'section_line_height', 'title' => __("Line Height", 'lang_theme'), 'default' => "1.5");
					$options_params[] = array('type' => "text", 'id' => 'section_margin', 'title' => __("Margin", 'lang_theme'), 'default' => "0 0 2em");
					$options_params[] = array('type' => "text", 'id' => 'section_padding', 'title' => __("Padding", 'lang_theme'));
					$options_params[] = array('type' => "text", 'id' => 'section_margin_between', 'title' => __("Margin between Content", 'lang_theme'), 'default' => "1em");
					$options_params[] = array('type' => "color", 'id' => 'article_url_color', 'title' => __("Link Color", 'lang_theme'));
				$options_params[] = array('category_end' => "");

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

			if(isset($arr_sidebars['widget_pre_footer']) && count($arr_sidebars['widget_pre_footer']) > 0)
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

				if(isset($arr_sidebars['widget_footer']) && count($arr_sidebars['widget_footer']) > 0)
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
			$options_params[] = array('category_end' => "");

		return gather_params($options_params);
	}
}

if(!function_exists('widgets_theme'))
{
	function widgets_theme()
	{
		$arr_sidebars = wp_get_sidebars_widgets();

		register_sidebar(array(
			'name' => __("Header", 'lang_theme'),
			'id' => 'widget_header',
			'before_widget' => "",
			'before_title' => "<div>",
			'after_title' => "</div>",
			'after_widget' => ""
		));

		if(isset($arr_sidebars['widget_header']) && count($arr_sidebars['widget_header']) > 0)
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
			'name' => __("After Content", 'lang_theme'),
			'id' => 'widget_after_content',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>"
		));

		register_sidebar(array(
			'name' => __("Sidebar", 'lang_theme')." (".__("Left", 'lang_theme').")",
			'id' => 'widget_sidebar_left',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>"
		));

		register_sidebar(array(
			'name' => __("Sidebar", 'lang_theme')." (".__("Right", 'lang_theme').")",
			'id' => 'widget_sidebar',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>"
		));

		if(isset($arr_sidebars['widget_footer']) && count($arr_sidebars['widget_footer']) > 0)
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

		register_widget('widget_theme_logo');
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
			'pages' => array('page'),
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
		return "<form action='".get_site_url()."' method='get' class='searchform mf_form'>"
			.show_textfield(array('name' => 's', 'value' => check_var('s'), 'placeholder' => __("Search for", 'lang_theme'))) //, 'required' => true
			."<i class='fa fa-search'></i>"
		."</form>";
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
				$wp_menu = wp_nav_menu(array('theme_location' => 'secondary', 'menu' => 'Secondary', 'container' => "div", 'container_override' => false, 'fallback_cb' => false, 'echo' => false));

				if($wp_menu != '')
				{
					$out .= "<nav id='secondary_nav' class='theme_nav is_mobile_ready'>"
						.$wp_menu
					."</nav>";
				}
			}

			if(in_array($data['type'], array('', 'main', 'both')))
			{
				$wp_menu = wp_nav_menu(array('theme_location' => 'primary', 'menu' => 'Main', 'container' => "div", 'container_override' => false, 'echo' => false));

				if($wp_menu != '')
				{
					if($data['where'] == 'widget_slide')
					{
						$out .= "<nav id='primary_nav' class='theme_nav'>"
							.$wp_menu
						."</nav>";
					}

					else
					{
						$out .= "<nav id='primary_nav' class='theme_nav is_mobile_ready'>
							<i class='fa fa-bars toggle_icon'></i>
							<i class='fa fa-close toggle_icon'></i>"
							.$wp_menu
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
					$post_thumbnail = get_the_post_thumbnail($post_id);
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