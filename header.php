<?php
/**
 * The Header for our theme.
*/

echo "<!DOCTYPE html>
<html lang='".get_bloginfo('language')."'>
	<head>
		<meta charset='".get_bloginfo('charset')."'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<meta name='author' content='frostkom.se'>
		<title>".get_wp_title()."</title>";

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
						list($options_params, $options) = get_params();

						echo get_logo_theme($options)
						.get_search_theme()
						.get_menu_theme();
					}

					echo "<div class='clear'></div>
				</div>
			</header>";

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
				echo "<mf-pre-content".is_clean().">
					<div>";

						dynamic_sidebar('widget_front');

					echo "</div>
				</mf-pre-content>";
			}

			echo "<mf-content>
				<div>
					<div id='main'>";