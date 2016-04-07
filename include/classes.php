<?php

class widget_theme_logo extends WP_Widget
{
	function widget_theme_logo()
	{
		$widget_ops = array(
			'classname' => 'theme',
			'description' => __("Display logo", 'lang_theme')
		);

		$control_ops = array('id_base' => 'theme-logo-widget');

		$this->__construct('theme-logo-widget', __("Theme Logo", 'lang_theme'), $widget_ops, $control_ops);
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
	function widget_theme_menu()
	{
		$widget_ops = array(
			'classname' => 'theme',
			'description' => __("Display menu", 'lang_theme')
		);

		$control_ops = array('id_base' => 'theme-menu-widget');

		$this->__construct('theme-menu-widget', __("Theme Menu", 'lang_theme'), $widget_ops, $control_ops);
	}

	function widget($args, $instance)
	{
		extract($args);

		echo $before_widget
			.get_menu_theme($instance['theme_menu_type'])
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

		echo "<p>
			<label for='".$this->get_field_id('theme_menu_type')."'>".__("Menu type", 'lang_theme')."</label>
			<select name='".$this->get_field_name('theme_menu_type')."' id='".$this->get_field_id('theme_menu_type')."' class='widefat'>";

				foreach($arr_types as $key => $value)
				{
					echo "<option value='".$key."'".($key == $instance['theme_menu_type'] ? " selected" : "").">".$value."</option>";
				}

			echo "</select>
		</p>";
	}
}