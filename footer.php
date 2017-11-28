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

						if(is_active_sidebar('widget_after_content') && !post_password_required())
						{
							echo "<div class='aside after_content'>";

								dynamic_sidebar('widget_after_content');

							echo "</div>";
						}

					echo "</div>";

					if(is_active_sidebar('widget_sidebar_left') && !post_password_required())
					{
						//".is_clean("")."
						echo "<div class='aside left'>";

							dynamic_sidebar('widget_sidebar_left');

						echo "</div>";
					}

					if(is_active_sidebar('widget_sidebar') && !post_password_required()) //Returns true even if it is empty below so I've had to add a hack here ;(
					{
						ob_start();

						dynamic_sidebar('widget_sidebar');

						$content = ob_get_clean();

						if($content != '')
						{
							//".is_clean()."
							echo "<div class='aside right'>".$content."</div>";
						}
					}

				echo "</div>
			</div>";

			if(is_active_sidebar('widget_pre_footer'))
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
				//".is_clean()."
				echo "<footer>
					<div>";

						dynamic_sidebar('widget_footer');

					echo "</div>
				</footer>";
			}

		echo "</div>";

		if(is_active_sidebar('widget_window_side'))
		{
			//".is_clean()."
			echo "<div id='window_side'>";

				dynamic_sidebar('widget_window_side');

			echo "</div>";
		}

		wp_footer();

	echo "</body>
</html>";