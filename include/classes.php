<?php

class mf_theme
{
	function __construct()
	{
		$this->meta_prefix = "mf_theme_";
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

		$instance['theme_menu_type'] = sanitize_text_field($new_instance['theme_menu_type']);

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