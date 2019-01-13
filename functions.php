<?php

include_once("include/classes.php");

$obj_theme = new mf_theme();

if(is_admin())
{
	add_action('rwmb_meta_boxes', array($obj_theme, 'rwmb_meta_boxes'));
}

else
{
	add_action('wp_head', array($obj_theme, 'wp_head'), 0);

	add_filter('body_class', array($obj_theme, 'body_class'));
}

add_action('after_setup_theme', array($obj_theme, 'after_setup_theme'));
add_action('widgets_init', array($obj_theme, 'widgets_init'));

add_theme_support('post-thumbnails');
add_theme_support('automatic-feed-links');