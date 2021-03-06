<?php
/*
 * The template for displaying the footer.
*/

						if(is_active_sidebar('widget_after_content') && !post_password_required())
						{
							echo "<div class='aside after_content'>";

								dynamic_sidebar('widget_after_content');

							echo "</div>";
						}

					echo "</div>";

					if(is_active_sidebar('widget_sidebar_left') && !post_password_required())
					{
						echo "<div id='aside_left' class='aside left'>
							<div>";

								dynamic_sidebar('widget_sidebar_left');

							echo "</div>
						</div>";
					}

					if(is_active_sidebar('widget_sidebar') && !post_password_required()) //Returns true even if it is empty below so I've had to add a hack here ;(
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

				if(is_active_sidebar('widget_below_content') && !post_password_required())
				{
					echo "<div id='aside_below_content' class='aside below_content'>";

						dynamic_sidebar('widget_below_content');

					echo "</div>";
				}

			echo "</div>";

			if(is_active_sidebar('widget_pre_footer') && !post_password_required())
			{
				if(!isset($obj_theme_core))
				{
					$obj_theme_core = new mf_theme_core();
				}

				$obj_theme_core->get_params();

				echo "<div id='mf-pre-footer'".(isset($obj_theme_core->options['pre_footer_full_width']) && $obj_theme_core->options['pre_footer_full_width'] == 2 ? " class='full_width'" : "").">
					<div>";

						dynamic_sidebar('widget_pre_footer');

					echo "</div>
				</div>";
			}

			if(is_active_sidebar('widget_footer'))
			{
				echo "<footer>
					<div>";

						dynamic_sidebar('widget_footer');

					echo "</div>
				</footer>";
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