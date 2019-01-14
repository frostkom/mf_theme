<?php
/*
 * The template for displaying 404 pages (Not Found).
*/

if(preg_match("/wp-admin/i", $_SERVER['REQUEST_URI']))
{
	wp_redirect(admin_url(), 301);
	exit;
}

get_header();

	echo get_404_page();

get_footer();