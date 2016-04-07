<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage Theme
 */

get_header();

	echo "<article>
		<h1>".__('Not Found', 'lang_theme')."</h1>
		<section>
			<p>".__('Apologies, but the page you requested could not be found. Perhaps searching will help.', 'lang_theme')."</p>";

			get_search_form();

		echo "</section>
	</article>";

get_footer();