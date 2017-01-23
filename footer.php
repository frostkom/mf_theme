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

					echo "</div>";

					if(is_active_sidebar('widget_sidebar'))
					{
						echo "<div id='aside'".is_clean().">";

							dynamic_sidebar('widget_sidebar');

						echo "</div>";
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