<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Theme
 */

get_header();

	echo "<article>
		<h1>".__("No results", 'lang_theme')."</h1>
		<section>
			<p>".sprintf(__("I could not find any results for '%s'", 'lang_theme'), get_query_var('s'))."</p>
		</section>
	</article>";

get_footer();