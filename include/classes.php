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

		$this->arr_default = array();

		parent::__construct('theme-logo-widget', __("Logo", 'lang_theme'), $widget_ops, $control_ops);
	}

	function widget($args, $instance)
	{
		extract($args);

		$instance = wp_parse_args((array)$instance, $this->arr_default);

		echo $before_widget
			.get_logo_theme()
		.$after_widget;
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$new_instance = wp_parse_args((array)$new_instance, $this->arr_default);

		//$instance[''] = strip_tags($new_instance['']);

		return $instance;
	}

	function form($instance)
	{
		$instance = wp_parse_args((array)$instance, $this->arr_default);

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

		$this->arr_default = array(
			'theme_menu_type' => "",
		);

		parent::__construct('theme-menu-widget', __("Menu", 'lang_theme'), $widget_ops);
	}

	function widget($args, $instance)
	{
		extract($args);

		$instance = wp_parse_args((array)$instance, $this->arr_default);

		echo $before_widget
			.get_menu_theme(array('type' => $instance['theme_menu_type'], 'where' => $id))
		.$after_widget;
	}

	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;

		$new_instance = wp_parse_args((array)$new_instance, $this->arr_default);

		$instance['theme_menu_type'] = strip_tags($new_instance['theme_menu_type']);

		return $instance;
	}

	function form($instance)
	{
		$instance = wp_parse_args((array)$instance, $this->arr_default);

		echo "<div class='mf_form'>"
			.show_select(array('data' => get_menu_type_for_select(), 'name' => $this->get_field_name('theme_menu_type'), 'text' => __("Menu Type", 'lang_theme'), 'value' => $instance['theme_menu_type']))
		."</div>";
	}
}