<?php
/*
 * The template for displaying the footer.
*/

if(!isset($obj_theme_core))
{
	$obj_theme_core = new mf_theme_core();
}

						if(is_active_sidebar('widget_after_content') && $obj_theme_core->is_post_password_protected() == false)
						{
							echo "<div id='aside_after_content' class='aside after_content'>";

								dynamic_sidebar('widget_after_content');

							echo "</div>";
						}

					echo "</div>";

					if(is_active_sidebar('widget_sidebar_left') && $obj_theme_core->is_post_password_protected() == false)
					{
						echo "<div id='aside_left' class='aside left'>
							<div>";

								dynamic_sidebar('widget_sidebar_left');

							echo "</div>
						</div>";
					}

					if(is_active_sidebar('widget_sidebar') && $obj_theme_core->is_post_password_protected() == false) //Returns true even if it is empty below so I've had to add a hack here ;(
					{
						ob_start();

						dynamic_sidebar('widget_sidebar');

						$widget_content = ob_get_clean();

						if($widget_content != '')
						{
							echo "<div id='aside_right' class='aside right'>
								<div>"
									.$widget_content
								."</div>
							</div>";
						}
					}

				echo "</div>";

				if(is_active_sidebar('widget_below_content') && $obj_theme_core->is_post_password_protected() == false)
				{
					echo "<div id='aside_below_content' class='aside below_content'>";

						dynamic_sidebar('widget_below_content');

					echo "</div>";
				}

			echo "</div>";

			if(is_active_sidebar('widget_pre_footer') && $obj_theme_core->is_post_password_protected() == false)
			{
				$obj_theme_core->get_params();

				echo "<div id='mf-pre-footer'".(isset($obj_theme_core->options['pre_footer_full_width']) && $obj_theme_core->options['pre_footer_full_width'] == 2 ? " class='full_width'" : "").">
					<div>";

						dynamic_sidebar('widget_pre_footer');

					echo "</div>
				</div>";
			}

			if(is_active_sidebar('widget_footer'))
			{
				$obj_theme_core->get_params();

				echo "<footer".(isset($obj_theme_core->options['footer_full_width']) && $obj_theme_core->options['footer_full_width'] == 2 ? " class='full_width'" : "").">
					<div>";

						dynamic_sidebar('widget_footer');

					echo "</div>
				</footer>";
			}

			if(is_active_sidebar('widget_window_bottom'))
			{
				echo "<div id='window_bottom'>";

					dynamic_sidebar('widget_window_bottom');

				echo "</div>";
			}

		echo "</div>";

		if(is_active_sidebar('widget_window_side'))
		{
			echo "<div id='window_side'>";

				dynamic_sidebar('widget_window_side');

			echo "</div>";
		}

		wp_footer();

	echo "</body>
</html>";