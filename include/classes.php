<?php

class widget_theme_logo extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array(
			'classname' => 'theme_logo',
			'description' => __("Display logo", 'lang_theme')
		);

		$control_ops = array('id_base' => 'theme-logo-widget');

		parent::__construct('theme-logo-widget', __("Theme Logo", 'lang_theme'), $widget_ops, $control_ops);
	}

	function widget($args, $instance)
	{
		extract($args);

		echo $before_widget
			.get_logo_theme()
		.$after_widget;
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		//$instance[''] = strip_tags($new_instance['']);

		return $instance;
	}

	function form($instance)
	{
		$defaults = array(
			//'' => "",
		);
		$instance = wp_parse_args((array)$instance, $defaults);

		echo "<p>".__("No need for settings here, we'll take care of the rest", 'lang_theme')."</p>";
	}
}

class widget_theme_menu extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array(
			'classname' => 'theme_menu',
			'description' => __("Display menu", 'lang_theme')
		);

		$control_ops = array('id_base' => 'theme-menu-widget');

		parent::__construct('theme-menu-widget', __("Theme Menu", 'lang_theme'), $widget_ops, $control_ops);
	}

	function widget($args, $instance)
	{
		extract($args);

		echo $before_widget
			.get_menu_theme(array('type' => $instance['theme_menu_type'], 'where' => $id))
		.$after_widget;
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['theme_menu_type'] = strip_tags($new_instance['theme_menu_type']);

		return $instance;
	}

	function form($instance)
	{
		$defaults = array(
			'theme_menu_type' => "",
		);
		$instance = wp_parse_args((array)$instance, $defaults);

		$arr_types = array(
			'' => "-- ".__("Choose here", 'lang_theme')." --",
			'main' => __("Main menu", 'lang_theme'),
			'secondary' => __("Secondary", 'lang_theme'),
			'both' => __("Main and Secondary menues", 'lang_theme'),
			'slide' => __("Slide in from right", 'lang_theme'),
		);

		$arr_data = array();

		foreach($arr_types as $key => $value)
		{
			$arr_data[$key] = $value;
		}

		echo "<div class='mf_form'>"
			.show_select(array('data' => $arr_data, 'name' => $this->get_field_name('theme_menu_type'), 'text' => __("Menu Type", 'lang_theme'), 'value' => $instance['theme_menu_type']))
		."</div>";
	}
}

class widget_theme_news extends WP_Widget
{
	function __construct()
	{
		$widget_ops = array(
			'classname' => 'theme_news',
			'description' => __("Display News/Posts", 'lang_theme')
		);

		$control_ops = array('id_base' => 'theme-news-widget');

		parent::__construct('theme-news-widget', __("News", 'lang_theme'), $widget_ops, $control_ops);
	}

	function widget($args, $instance)
	{
		global $wpdb;

		extract($args);

		echo $before_widget;

			if($instance['news_title'] != '')
			{
				echo $before_title
					.$instance['news_title']
				.$after_title;
			}

			if(!($instance['news_amount'] > 0))
			{
				$instance['news_amount'] = 3;
			}

			$result = $wpdb->get_results("SELECT ID, post_title FROM ".$wpdb->posts." WHERE post_type = 'post' AND post_status = 'publish' ORDER BY post_date DESC LIMIT 0, ".$instance['news_amount']);

			if($wpdb->num_rows > 0)
			{
				echo "<ul>";

					foreach($result as $post)
					{
						$post_id = $post->ID;
						$post_title = $post->post_title;
						//$post_excerpt = $post->post_excerpt;

						$post_url = get_permalink($post_id);

						$post_url_start = "<a href='".$post_url."'>";
						$post_url_end = "</a>";

						$post_thumbnail = "";

						if(has_post_thumbnail($post_id))
						{
							$post_thumbnail = get_the_post_thumbnail($post_id, 'large');
						}

						echo "<li>";

							if($post_thumbnail != '')
							{
								echo "<div class='image'>".$post_thumbnail."</div>";
							}

							echo "<h4>"
								.$post_url_start
									.$post_title
								.$post_url_end
							."</h4>";
						
						echo "</li>";
					}

				echo "</ul>";
			}

			else
			{
				echo "<p>".__("I could not find any posts to present to you", 'lang_theme')."</p>";
			}
			
		echo $after_widget;
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$instance['news_title'] = strip_tags($new_instance['news_title']);
		$instance['news_amount'] = strip_tags($new_instance['news_amount']);

		return $instance;
	}

	function form($instance)
	{
		$defaults = array(
			'news_title' => "",
			'news_amount' => 3,
		);
		$instance = wp_parse_args((array)$instance, $defaults);

		echo "<div class='mf_form'>"
			.show_textfield(array('name' => $this->get_field_name('news_title'), 'text' => __("Title", 'lang_theme'), 'value' => $instance['news_title']))
			.show_textfield(array('type' => 'number', 'name' => $this->get_field_name('news_amount'), 'text' => __("Amount", 'lang_theme'), 'value' => $instance['news_amount']))
		."</div>";
	}
}