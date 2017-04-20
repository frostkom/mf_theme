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

						if(is_active_sidebar('widget_after_content'))
						{
							echo "<div id='aside'".is_clean("after_content").">";

								dynamic_sidebar('widget_after_content');

							echo "</div>";
						}

					echo "</div>";

					if(is_active_sidebar('widget_sidebar_left'))
					{
						echo "<div id='aside'".is_clean("left").">";

							dynamic_sidebar('widget_sidebar_left');

						echo "</div>";
					}

					if(is_active_sidebar('widget_sidebar'))
					{
						echo "<div id='aside'".is_clean("right").">";

							dynamic_sidebar('widget_sidebar');

						echo "</div>";
					}

				echo "</div>
			</mf-content>";

			if(is_active_sidebar('widget_pre_footer'))
			{
				list($options_params, $options) = get_params();

				echo "<mf-pre-footer".(isset($options['pre_footer_full_width']) && $options['pre_footer_full_width'] == 2 ? " class='full_width'" : "").">
					<div>";

						dynamic_sidebar('widget_pre_footer');

					echo "</div>
				</mf-pre-footer>";
			}

			if(is_active_sidebar('widget_footer'))
			{
				echo "<footer".is_clean().">
					<div>";

						dynamic_sidebar('widget_footer');

					echo "</div>
				</footer>";
			}

		echo "</div>";

		wp_footer();

	echo "</body>
</html>";