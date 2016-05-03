<?php
/**
 * The Header for our theme.
*/

global $page, $paged;

//require_user_login();

echo "<!DOCTYPE html>
<html lang='".get_bloginfo('language')."'>
	<head>
		<meta charset='".get_bloginfo('charset')."'>
		<meta name='viewport' content='width=device-width, initial-scale=1'>
		<meta name='author' content='frostkom.se'>
		<title>";

			wp_title('|', true, 'right');

			echo get_bloginfo('name');

			$site_description = get_bloginfo('description', 'display');

			if($site_description != '' && (is_home() || is_front_page()))
			{
				echo " | ".$site_description;
			}

			if($paged >= 2 || $page >= 2)
			{
				echo " | ".sprintf( __('Page %s', 'lang_theme'), max($paged, $page));
			}

		echo "</title>";

		enqueue_theme_fonts();

		wp_enqueue_style('style', replace_stylesheet_url());

		list($options_params, $options) = get_params();

		if(isset($options['body_history']) && $options['body_history'] == 2)
		{
			$template_url = get_bloginfo('template_url');

			wp_enqueue_style('style_theme_history', $template_url."/include/style_history.css");
		}

		wp_head();

	echo "</head>
	<body class='".implode(" ", get_body_class())."'>
		<div id='wrapper'>";

if(!isset($_GET['clean']))
{
			echo "<header>
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
				echo "<mf-slide-nav>
					<div>
						<i class='fa fa-close'></i>";

						dynamic_sidebar('widget_slide');

					echo "</div>
				</mf-slide-nav>";
			}

			if(is_active_sidebar('widget_front'))
			{
				echo "<mf-pre-content>
					<div>";

						dynamic_sidebar('widget_front');

					echo "</div>
				</mf-pre-content>";
			}
}

			echo "<mf-content>
				<div>
					<div id='main'>";