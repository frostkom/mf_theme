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