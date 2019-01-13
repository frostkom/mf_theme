<?php
/**
 * The Header for our theme.
*/

if(!isset($obj_theme_core))
{
	$obj_theme_core = new mf_theme_core();
}

if(!isset($obj_theme))
{
	$obj_theme = new mf_theme();
}

echo "<!DOCTYPE html>
<html ".get_language_attributes().">
	<head>";

		wp_head();

	echo "</head>
	<body class='".implode(" ", get_body_class())."'>
		<div id='wrapper'>
			<header>
				<div>";

					if(is_active_sidebar('widget_header'))
					{
						dynamic_sidebar('widget_header');
					}

					else
					{
						echo $obj_theme_core->get_logo()
						.get_search_theme_core()
						.$obj_theme->get_menu(array('where' => 'header'));
					}

					echo "<div class='clear'></div>
				</div>
			</header>";

			if(is_active_sidebar('widget_after_header'))
			{
				$obj_theme_core->get_params();

				echo "<div id='mf-after-header'".(isset($obj_theme_core->options['after_header_full_width']) && $obj_theme_core->options['after_header_full_width'] == 2 ? " class='full_width'" : "").">
					<div>";

						dynamic_sidebar('widget_after_header');

					echo "</div>
				</div>";
			}

			if(is_active_sidebar('widget_slide'))
			{
				echo "<div id='mf-slide-nav'>
					<div>
						<i class='fa fa-times'></i>";

						dynamic_sidebar('widget_slide');

					echo "</div>
				</div>";
			}

			if(is_active_sidebar('widget_front'))
			{
				$obj_theme_core->get_params();

				echo "<div id='mf-pre-content'".(isset($obj_theme_core->options['pre_content_full_width']) && $obj_theme_core->options['pre_content_full_width'] == 2 ? " class='full_width'" : "").">
					<div>";

						dynamic_sidebar('widget_front');

					echo "</div>
				</div>";
			}

			echo "<div id='mf-content'>
				<div>
					<div id='main'>";