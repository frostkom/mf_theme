<?php
/**
 * The Header for our theme.
*/

echo "<!DOCTYPE html>
<html ".get_language_attributes().">
	<head>";

		wp_head();

	echo "</head>
	<body class='".implode(" ", get_body_class())."'>
		<div id='wrapper'>
			<header".is_clean().">
				<div>";

					if(is_active_sidebar('widget_header'))
					{
						dynamic_sidebar('widget_header');
					}

					else
					{
						//list($options_params, $options) = get_params();

						echo get_logo() //array('options' => $options)
						.get_search_theme_core()
						.get_menu_theme(array('where' => 'header'));
					}

					echo "<div class='clear'></div>
				</div>
			</header>";

			if(is_active_sidebar('widget_after_header'))
			{
				echo "<mf-after-header".is_clean().">
					<div>";

						dynamic_sidebar('widget_after_header');

					echo "</div>
				</mf-after-header>";
			}

			if(is_active_sidebar('widget_slide'))
			{
				echo "<mf-slide-nav".is_clean().">
					<div>
						<i class='fa fa-close'></i>";

						dynamic_sidebar('widget_slide');

					echo "</div>
				</mf-slide-nav>";
			}

			if(is_active_sidebar('widget_front'))
			{
				echo "<div id='mf-pre-content'".is_clean().">
					<div>";

						dynamic_sidebar('widget_front');

					echo "</div>
				</div>";
			}

			echo "<mf-content>
				<div>
					<div id='main'>";