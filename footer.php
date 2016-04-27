<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content
 * after.  Calls sidebar-footer.php for bottom widgets.
 *
 * @package WordPress
 * @subpackage Theme
 */

if(!isset($_GET['clean']))
{
						echo "</div>";

						if(is_active_sidebar('widget_sidebar'))
						{
							echo "<div id='aside'>";

								dynamic_sidebar('widget_sidebar');

							echo "</div>";
						}
}

					echo "</div>
				</mf-content>";

				if(is_active_sidebar('widget_pre_footer'))
				{
					echo "<mf-pre-footer>
						<div>";

							dynamic_sidebar('widget_pre_footer');

						echo "</div>
					</mf-pre-footer>";
				}

if(!isset($_GET['clean']))
{
				if(is_active_sidebar('widget_footer'))
				{
					echo "<footer>
						<div>";

							dynamic_sidebar('widget_footer');

						echo "</div>
					</footer>";
				}
}

		echo "</mf-wrapper>";

		list($options_params, $options) = get_params();

		$header_fixed = isset($options['header_fixed']) && $options['header_fixed'] == 2 ? true : false;
		$template_url = get_bloginfo('template_url');

		mf_enqueue_script('script_theme', $template_url."/include/script.js", array('template_url' => $template_url, 'header_fixed' => $header_fixed));

		list($options_params, $options) = get_params();

		if(isset($options['body_history']) && $options['body_history'] == 2)
		{
			mf_enqueue_script('script_theme_history', $template_url."/include/script_history.js", array('site_url' => get_site_url()));
		}

		wp_footer();

	echo "</body>
</html>";