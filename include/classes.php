<?php

class mf_theme
{
	var $meta_prefix = 'mf_theme_';

	function __construct(){}

	function get_search_page()
	{
		return "<article".(IS_ADMINISTRATOR ? " class='get_search_page'" : "").">
			<h1>".__("No results", 'lang_theme')."</h1>
			<section>
				<p>".sprintf(__("I could not find any results for %s", 'lang_theme'), check_var('s'))."</p>
			</section>
		</article>";
	}

	function is_heading_visible($post)
	{
		if($post->post_type == 'page')
		{
			$post_meta = get_post_meta($post->ID, $this->meta_prefix.'display_heading', true);

			return ($post_meta != 'no');
		}

		else
		{
			return true;
		}
	}

	function get_menu($data = array())
	{
		if(!isset($data['where'])){				$data['where'] = "";}
		if(!isset($data['type'])){				$data['type'] = "";}
		if(!isset($data['class'])){				$data['class'] = "";}
		if(!isset($data['columns_desktop'])){	$data['columns_desktop'] = 1;}
		if(!isset($data['columns_tablet'])){	$data['columns_tablet'] = 1;}
		if(!isset($data['columns_mobile'])){	$data['columns_mobile'] = 1;}
		if(!isset($data['columns_height'])){	$data['columns_height'] = "";}

		if($data['columns_desktop'] > 1 || $data['columns_tablet'] > 1 || $data['columns_mobile'] > 1)
		{
			$data['class'] .= ($data['class'] != '' ? " " : "").($data['columns_height'] != '' ? "has_menu_height" : "has_menu_columns");

			if($data['columns_desktop'] > 1)
			{
				$data['class'] .= " menu_columns_desktop_".$data['columns_desktop'];
			}

			if($data['columns_tablet'] > 1)
			{
				$data['class'] .= " menu_columns_tablet_".$data['columns_tablet'];
			}

			if($data['columns_mobile'] > 1)
			{
				$data['class'] .= " menu_columns_mobile_".$data['columns_mobile'];
			}
		}

		$out = "";

		if($data['type'] == 'slide')
		{
			$out .= "<nav>
				<a href='#' id='slide_nav'".($data['class'] != '' ? " class='".$data['class']."'" : "").">
					".__("Menu", 'lang_theme')." <i class='fa fa-bars'></i>
				</a>
			</nav>";
		}

		else
		{
			if(in_array($data['type'], array('', 'secondary', 'secondary-menu', 'both')))
			{
				$nav_content = wp_nav_menu(array('theme_location' => 'secondary', 'menu' => 'Secondary', 'container' => "div", 'container_override' => false, 'fallback_cb' => false, 'echo' => false));

				if($nav_content != '')
				{
					$out .= "<nav id='secondary_nav' class='theme_nav is_mobile_ready".($data['class'] != '' ? " ".$data['class'] : "")."'>"
						.$nav_content
					."</nav>";
				}
			}

			if(in_array($data['type'], array('', 'main', 'main-menu', 'both')))
			{
				$nav_content = wp_nav_menu(array('theme_location' => 'primary', 'menu' => 'Main', 'container' => "div", 'container_override' => false, 'echo' => false));

				if($nav_content != '')
				{
					switch($data['where'])
					{
						case 'widget_slide':
							$nav_before_content = "";
						break;

						default:
							global $obj_theme_core;

							if(!isset($obj_theme_core))
							{
								$obj_theme_core = new mf_theme_core();
							}

							$obj_theme_core->get_params();

							$data['class'] .= ($data['class'] != '' ? " " : "")."is_mobile_ready".(isset($obj_theme_core->options['nav_full_width']) && $obj_theme_core->options['nav_full_width'] == 2 ? " full_width" : "");

							$nav_before_content = "<i class='fa fa-bars toggle_icon'></i>
							<i class='fa fa-times toggle_icon'></i>";
						break;
					}

					$out .= "<nav id='primary_nav' class='theme_nav".($data['class'] != '' ? " ".$data['class'] : '')."'>"
						.$nav_before_content
						.$nav_content
					."</nav>";
				}
			}

			if($data['type'] != '' && !in_array($data['type'], array('main', 'main-menu', 'secondary', 'secondary-menu', 'both')))
			{
				$nav_content = wp_nav_menu(array('menu' => $data['type'], 'container' => "div", 'container_override' => false, 'echo' => false));

				if($nav_content != '')
				{
					switch($data['where'])
					{
						case 'widget_slide':
							$nav_before_content = "";
						break;

						default:
							global $obj_theme_core;

							if(!isset($obj_theme_core))
							{
								$obj_theme_core = new mf_theme_core();
							}

							$obj_theme_core->get_params();

							$data['class'] .= ($data['class'] != '' ? " " : "")."is_mobile_ready".(isset($obj_theme_core->options['nav_full_width']) && $obj_theme_core->options['nav_full_width'] == 2 ? " full_width" : "");

							$nav_before_content = "<i class='fa fa-bars toggle_icon'></i>
							<i class='fa fa-times toggle_icon'></i>";
						break;
					}

					$out .= "<nav id='primary_nav' class='theme_nav".($data['class'] != '' ? " ".$data['class'] : '')."'>"
						.$nav_before_content
						.$nav_content
					."</nav>";
				}
			}
		}

		if($data['columns_height'] != '')
		{
			$out = str_replace(' class="menu"', " class='menu' style='height: ".$data['columns_height']."'", $out);
		}

		return $out;
	}

	function get_more_posts($data = array())
	{
		global $wpdb;

		if(!isset($data['limit_start'])){	$data['limit_start'] = 0;}

		$out = "";

		$posts_per_page = get_option('posts_per_page');

		$query_limit = " LIMIT ".esc_sql($data['limit_start']).", ".(esc_sql($posts_per_page) + 1);

		$result = $wpdb->get_results($wpdb->prepare("SELECT * FROM ".$wpdb->posts." WHERE post_type = %s AND post_status = %s ORDER BY post_date DESC".$query_limit, 'post', 'publish'));

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
				$post_meta = apply_filters('the_content_meta', "", $r);

				$post_url_start = "<a href='".$post_url."'>";
				$post_url_end = "</a>";

				$post_thumbnail = "";

				if(has_post_thumbnail($post_id))
				{
					$post_thumbnail = get_the_post_thumbnail($post_id, 'full');
				}

				$out .= "<article class='post_type_post".(IS_ADMINISTRATOR ? " get_more_posts post_".$post_id : "")."'>";

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
							$out .= "<p>".$post_excerpt."</p>"
							.apply_filters('the_content_read_more', "<p>".$post_url_start.__("Read More", 'lang_theme').$post_url_end."</p>", $r);
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
				$out .= "<div class='form_button'>
					<a href='#' id='load_more' class='button' rel='".($data['limit_start'] + $i)."'>".__("Load more posts", 'lang_theme')."</a>
				</div>";

				break;
			}
		}

		return $out;
	}

	function display_featured_image($post_id)
	{
		$obj_theme_core = new mf_theme_core();

		$post_meta = get_post_meta($post_id, $obj_theme_core->meta_prefix.'display_featured_image', true);

		return ($post_meta != 'no');
	}

	function rwmb_meta_boxes($meta_boxes)
	{
		$arr_fields = array(
			array(
				'name' => __("Display Heading", 'lang_theme'),
				'id' => $this->meta_prefix.'display_heading',
				'type' => 'select',
				'options' => get_yes_no_for_select(),
				'std' => 'yes',
			),
		);

		$post_id = check_var('post');

		if($post_id > 0 && has_post_thumbnail($post_id))
		{
			$obj_theme_core = new mf_theme_core();

			$arr_fields[] = array(
				'name' => __("Display Featured Image on Single Page", 'lang_theme'),
				'id' => $obj_theme_core->meta_prefix.'display_featured_image',
				'type' => 'select',
				'options' => get_yes_no_for_select(),
			);
		}

		$arr_fields[] = array(
			'name' => __("Text Columns", 'lang_theme'),
			'id' => $this->meta_prefix.'text_columns',
			'type' => 'number',
			'std' => 1,
			'attributes' => array(
				'min' => 1,
				'max' => 2,
			),
		);

		$arr_fields[] = array(
			'name' => __("Body Class", 'lang_theme'),
			'id' => $this->meta_prefix.'body_class',
			'type' => 'text',
		);

		$meta_boxes[] = array(
			'id' => $this->meta_prefix.'settings',
			'title' => __("Content Settings", 'lang_theme'),
			'post_types' => array('page'),
			'context' => 'side',
			'priority' => 'low',
			'fields' => $arr_fields,
		);

		return $meta_boxes;
	}

	function wp_head()
	{
		global $obj_theme_core;

		if(!isset($obj_theme_core))
		{
			$obj_theme_core = new mf_theme_core();
		}

		$obj_theme_core->get_params();
		$obj_theme_core->enqueue_theme_fonts();

		$template_url = get_bloginfo('template_url');
		$theme_version = get_theme_version();

		mf_enqueue_style('theme_style', $template_url."/include/style.php");

		$obj_theme_core->get_external_css($theme_version);

		mf_enqueue_script('script_theme', $template_url."/include/script.js", array(
			'template_url' => $template_url,
			//'hamburger_collapse_if_no_space' => (isset($obj_theme_core->options['hamburger_collapse_if_no_space']) && $obj_theme_core->options['hamburger_collapse_if_no_space'] == 2),
		));
	}

	function body_class($classes)
	{
		global $post;

		if(isset($post) && isset($post->ID) && $post->ID > 0)
		{
			$body_class = get_post_meta($post->ID, $this->meta_prefix.'body_class', true);

			if($body_class)
			{
				$classes[] = $body_class;
			}
		}

		return $classes;
	}

	function after_setup_theme()
	{
		load_theme_textdomain('lang_theme', get_template_directory()."/lang");

		register_nav_menus(array(
			'primary' => __("Primary Navigation", 'lang_theme'),
			'secondary' => __("Secondary Navigation", 'lang_theme'),
			//'footer' => ,
		));
	}

	function widgets_init()
	{
		// A fix to make it work on register form
		if(!class_exists('mf_theme_core'))
		{
			include_once(ABSPATH."wp-content/plugins/mf_theme_core/include/classes.php");
			include_once(ABSPATH."wp-content/plugins/mf_theme_core/include/functions.php");
		}

		$obj_theme_core = new mf_theme_core();
		$obj_theme_core->get_custom_widget_areas();

		$obj_theme_core->display_custom_widget_area('widget_header');

		/*if(is_active_widget_area('widget_header'))
		{*/
			register_sidebar(array(
				'name' => __("Before Header", 'lang_theme'),
				'id' => 'widget_pre_header',
				'before_widget' => "<div class='widget %s %s'>",
				'before_title' => "<h3>",
				'after_title' => "</h3>",
				'after_widget' => "</div>",
			));
		//}

		register_sidebar(array(
			'name' => __("Header", 'lang_theme'),
			'id' => 'widget_header',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<div>",
			'after_title' => "</div>",
			'after_widget' => "</div>",
		));

		/*if(is_active_widget_area('widget_header'))
		{*/
			register_sidebar(array(
				'name' => __("After Header", 'lang_theme'),
				'id' => 'widget_after_header',
				'before_widget' => "<div class='widget %s %s'>",
				'before_title' => "<h3>",
				'after_title' => "</h3>",
				'after_widget' => "</div>",
			));

			$obj_theme_core->display_custom_widget_area('widget_after_header');

			register_sidebar(array(
				'name' => __("Slide menu", 'lang_theme'),
				'id' => 'widget_slide',
				'before_widget' => "<div class='widget %s %s'>",
				'before_title' => "",
				'after_title' => "",
				'after_widget' => "</div>",
			));

			$obj_theme_core->display_custom_widget_area('widget_slide');
		//}

		register_sidebar(array(
			'name' => __("Pre Content", 'lang_theme'),
			'id' => 'widget_front',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>",
		));

		$obj_theme_core->display_custom_widget_area('widget_front');

		register_sidebar(array(
			'name' => __("Below Main Heading", 'lang_theme'),
			'id' => 'widget_after_heading',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>",
		));

		$obj_theme_core->display_custom_widget_area('widget_after_heading');

		register_sidebar(array(
			'name' => __("Aside", 'lang_theme')." (".__("Left", 'lang_theme').")",
			'id' => 'widget_sidebar_left',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>",
		));

		$obj_theme_core->display_custom_widget_area('widget_sidebar_left');

		register_sidebar(array(
			'name' => __("Below Main Column", 'lang_theme'),
			'id' => 'widget_after_content',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>",
		));

		$obj_theme_core->display_custom_widget_area('widget_after_content');

		register_sidebar(array(
			'name' => __("Aside", 'lang_theme')." (".__("Right", 'lang_theme').")",
			'id' => 'widget_sidebar',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>",
		));

		$obj_theme_core->display_custom_widget_area('widget_sidebar');

		register_sidebar(array(
			'name' => __("Below Content", 'lang_theme'),
			'id' => 'widget_below_content',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>",
		));

		$obj_theme_core->display_custom_widget_area('widget_below_content');

		if(is_active_widget_area('widget_footer'))
		{
			register_sidebar(array(
				'name' => __("Pre Footer", 'lang_theme'),
				'id' => 'widget_pre_footer',
				'before_widget' => "<div class='widget %s %s'>",
				'before_title' => "<h3>",
				'after_title' => "</h3>",
				'after_widget' => "</div>",
			));

			$obj_theme_core->display_custom_widget_area('widget_pre_footer');
		}

		register_sidebar(array(
			'name' => __("Footer", 'lang_theme'),
			'id' => 'widget_footer',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>",
		));

		$obj_theme_core->display_custom_widget_area('widget_footer');

		register_sidebar(array(
			'name' => __("Window Side", 'lang_theme'),
			'id' => 'widget_window_side',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>",
		));

		$obj_theme_core->display_custom_widget_area('widget_window_side');

		register_sidebar(array(
			'name' => __("Window Bottom", 'lang_theme'),
			'id' => 'widget_window_bottom',
			'before_widget' => "<div class='widget %s %s'>",
			'before_title' => "<h3>",
			'after_title' => "</h3>",
			'after_widget' => "</div>",
		));

		$obj_theme_core->display_custom_widget_area('widget_window_bottom');

		register_widget('widget_theme_menu');
	}
}

class widget_theme_menu extends WP_Widget
{
	var $obj_theme = "";

	var $widget_ops = array();

	var $arr_default = array(
		'theme_menu_title' => '',
		'theme_menu_type' => '',
		'theme_menu_display_mobile_version' => 'no',
		'theme_menu_columns_desktop' => 1,
		'theme_menu_columns_tablet' => 1,
		'theme_menu_columns_mobile' => 1,
		'theme_menu_height' => '',
	);

	function __construct()
	{
		$this->obj_theme = new mf_theme();

		$this->widget_ops = array(
			'classname' => 'theme_menu',
			'description' => __("Display Menu", 'lang_theme'),
		);

		/*$this->arr_default = array(
			'theme_menu_title' => '',
			'theme_menu_type' => '',
			'theme_menu_display_mobile_version' => 'no',
			'theme_menu_columns_desktop' => 1,
			'theme_menu_columns_tablet' => 1,
			'theme_menu_columns_mobile' => 1,
			'theme_menu_height' => '',
		);*/

		parent::__construct(str_replace("_", "-", $this->widget_ops['classname']).'-widget', __("Menu", 'lang_theme'), $this->widget_ops);
	}

	function widget($args, $instance)
	{
		do_log(__CLASS__."->".__FUNCTION__."(): Add a block instead", 'publish', false);

		extract($args);
		$instance = wp_parse_args((array)$instance, $this->arr_default);

		echo apply_filters('filter_before_widget', $before_widget);

			if(isset($instance['theme_menu_title']) && $instance['theme_menu_title'] != '')
			{
				$instance['theme_menu_title'] = apply_filters('widget_title', $instance['theme_menu_title'], $instance, $this->id_base);

				echo $before_title
					.$instance['theme_menu_title']
				.$after_title;
			}

			if(!isset($id))
			{
				do_log("widget_theme_menu->widget - Unknown ID because of new Widget view(?): ".var_export($args, true));

				$id = '';
			}

			echo $this->obj_theme->get_menu(array(
				'type' => $instance['theme_menu_type'],
				'where' => $id,
				'class' => ($instance['theme_menu_display_mobile_version'] == 'yes' ? "is_hamburger" : ""),
				'columns_desktop' => $instance['theme_menu_columns_desktop'],
				'columns_tablet' => $instance['theme_menu_columns_tablet'],
				'columns_mobile' => $instance['theme_menu_columns_mobile'],
				'columns_height' => $instance['theme_menu_height'],
			))
		.$after_widget;
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		$new_instance = wp_parse_args((array)$new_instance, $this->arr_default);

		$instance['theme_menu_title'] = sanitize_text_field($new_instance['theme_menu_title']);
		$instance['theme_menu_type'] = sanitize_text_field($new_instance['theme_menu_type']);
		$instance['theme_menu_display_mobile_version'] = sanitize_text_field($new_instance['theme_menu_display_mobile_version']);
		$instance['theme_menu_columns_desktop'] = sanitize_text_field($new_instance['theme_menu_columns_desktop']);
		$instance['theme_menu_columns_tablet'] = sanitize_text_field($new_instance['theme_menu_columns_tablet']);
		$instance['theme_menu_columns_mobile'] = sanitize_text_field($new_instance['theme_menu_columns_mobile']);
		$instance['theme_menu_height'] = sanitize_text_field($new_instance['theme_menu_height']);

		return $instance;
	}

	function get_columns_for_select()
	{
		return array(
			1 => 1,
			2 => 2,
			3 => 3,
		);
	}

	function form($instance)
	{
		$instance = wp_parse_args((array)$instance, $this->arr_default);

		echo "<div class='mf_form'>"
			.show_textfield(array('name' => $this->get_field_name('theme_menu_title'), 'text' => __("Title", 'lang_theme'), 'value' => $instance['theme_menu_title'], 'xtra' => " id='".$this->widget_ops['classname']."-title'"))
			.show_select(array('data' => get_menu_type_for_select(), 'name' => $this->get_field_name('theme_menu_type'), 'text' => __("Menu Type", 'lang_theme')." <a href='".admin_url("nav-menus.php")."'><i class='fa fa-wrench fa-lg'></i></a>", 'value' => $instance['theme_menu_type']))
			.show_select(array('data' => get_yes_no_for_select(), 'name' => $this->get_field_name('theme_menu_display_mobile_version'), 'text' => __("Always Display Mobile Menu", 'lang_theme'), 'value' => $instance['theme_menu_display_mobile_version']));

			if($instance['theme_menu_display_mobile_version'] == 'no')
			{
				echo "<h4>".__("Columns", 'lang_theme')."</h4>
				<div class='flex_flow'>"
					.show_select(array('data' => $this->get_columns_for_select(), 'name' => $this->get_field_name('theme_menu_columns_desktop'), 'text' => __("Desktop", 'lang_theme'), 'value' => $instance['theme_menu_columns_desktop']))
					.show_select(array('data' => $this->get_columns_for_select(), 'name' => $this->get_field_name('theme_menu_columns_tablet'), 'text' => __("Tablet", 'lang_theme'), 'value' => $instance['theme_menu_columns_tablet']))
					.show_select(array('data' => $this->get_columns_for_select(), 'name' => $this->get_field_name('theme_menu_columns_mobile'), 'text' => __("Mobile", 'lang_theme'), 'value' => $instance['theme_menu_columns_mobile']));

					if($instance['theme_menu_columns_desktop'] > 0 || $instance['theme_menu_columns_tablet'] > 0 || $instance['theme_menu_columns_mobile'] > 0)
					{
						echo show_textfield(array('name' => $this->get_field_name('theme_menu_height'), 'text' => __("Height", 'lang_theme'), 'value' => $instance['theme_menu_height'], 'placeholder' => "20em"));
					}

				echo "</div>";
			}

		echo "</div>";
	}
}