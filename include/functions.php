<?php

if(!function_exists('get_search_page'))
{
	function get_search_page()
	{
		$strSearch = check_var('s');

		return "<article>
			<h1>".__("No results", 'lang_theme')."</h1>
			<section>
				<p>".sprintf(__("I could not find any results for '%s'", 'lang_theme'), $strSearch)."</p>
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
			$obj_theme = new mf_theme();

			$post_meta = get_post_meta($post->ID, $obj_theme->meta_prefix.'display_heading', true);

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
		$obj_theme_core = new mf_theme_core();
		$obj_theme_core->get_params();
		$obj_theme_core->enqueue_theme_fonts();

		$template_url = get_bloginfo('template_url');
		$theme_version = get_theme_version();

		mf_enqueue_style('style', $template_url."/include/style.php", $theme_version);
		mf_enqueue_script('script_theme', $template_url."/include/script.js", array(
			'template_url' => $template_url,
			'header_fixed' => (isset($obj_theme_core->options['header_fixed']) && $obj_theme_core->options['header_fixed'] == 'fixed'),
			'hamburger_collapse_if_no_space' => (isset($obj_theme_core->options['hamburger_collapse_if_no_space']) && $obj_theme_core->options['hamburger_collapse_if_no_space'] == 2),
		), $theme_version);
	}
}

if(!function_exists('body_class_theme'))
{
	function body_class_theme($classes)
	{
		global $post;

		if(isset($post) && isset($post->ID) && $post->ID > 0)
		{
			$obj_theme = new mf_theme();

			$body_class = get_post_meta($post->ID, $obj_theme->meta_prefix.'body_class', true);

			if($body_class)
			{
				$classes[] = $body_class;
			}
		}

		return $classes;
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
				'before_title' => "<h3>",
				'after_title' => "</h3>",
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
		$obj_theme = new mf_theme();

		$meta_boxes[] = array(
			'id' => 'settings',
			'title' => __("Content Settings", 'lang_theme'),
			'post_types' => array('page'),
			'context' => 'side',
			'priority' => 'low',
			'fields' => array(
				array(
					'name' => __("Display Heading", 'lang_theme'),
					'id' => $obj_theme->meta_prefix.'display_heading',
					'type' => 'select',
					'options' => get_yes_no_for_select(),
					'std' => 'yes',
				),
				array(
					'name' => __("Text Columns", 'lang_theme'),
					'id' => $obj_theme->meta_prefix.'text_columns',
					'type' => 'number',
					'std' => 1,
					'attributes' => array(
						'min' => 1,
						'max' => 2,
					),
				),
				array(
					'name' => __("Body Class", 'lang_theme'),
					'id' => $obj_theme->meta_prefix.'body_class',
					'type' => 'text',
				),
			)
		);

		return $meta_boxes;
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
					switch($data['where'])
					{
						case 'widget_slide':
							$nav_class = $nav_before_content = "";
						break;

						default:
							global $obj_theme_core;

							if(!isset($obj_theme_core))
							{
								$obj_theme_core = new mf_theme_core();
							}

							$obj_theme_core->get_params();

							$nav_class = "is_mobile_ready".(isset($obj_theme_core->options['nav_full_width']) && $obj_theme_core->options['nav_full_width'] == 2 ? " full_width" : "");

							//$nav_before_content = "<a href='#' class='toggle_icon'></a>";
							$nav_before_content = "<i class='fa fa-bars toggle_icon'></i>
							<i class='fa fa-close toggle_icon'></i>";
						break;
					}

					$out .= "<nav id='primary_nav' class='theme_nav".($nav_class != '' ? " ".$nav_class : '')."'>"
						.$nav_before_content
						.$nav_content
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

					$out .= "<h2>"
						.$post_url_start
							.$post_title
						.$post_url_end
					."</h2>"
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