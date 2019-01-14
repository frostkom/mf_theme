<?php
/**
 * The template for displaying the search page.
*/

get_header();

	if(!isset($obj_theme))
	{
		$obj_theme = new mf_theme();
	}

	echo $obj_theme->get_search_page();

get_footer();