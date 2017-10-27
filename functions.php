<?php

include_once("include/functions.php");
include_once("include/classes.php");

add_action('cron_base', 'cron_theme', mt_rand(1, 10));

if(is_admin())
{
	add_action('admin_menu', 'options_theme');
	add_action('rwmb_meta_boxes', 'meta_boxes_theme');
}

else
{
	add_action('wp_head', 'head_theme', 0);

	add_filter('body_class', 'body_class_theme');

	add_filter('the_content_meta', 'content_meta_theme', 1, 2);
}

add_action('customize_register', 'customize_theme');
//add_action('customize_save', 'customize_save_theme');

add_action('after_setup_theme', 'setup_theme');
add_action('widgets_init', 'widgets_theme');

add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');