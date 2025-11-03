<?php

if(!function_exists('point2int'))
{
	function point2int($in, $handle)
	{
		$str_version = 0;
		$multiplier = 1;

		if($in != '')
		{
			if(strpos($in, "-"))
			{
				list($in, $rest) = explode("-", $in);
			}

			$arr_version = explode(".", $in);

			$count_temp = count($arr_version);

			while($count_temp < 3)
			{
				$arr_version[] = 0;

				$count_temp++;
			}

			for($i = 1; $i <= $count_temp; $i++)
			{
				$str_version += ((int)$arr_version[$count_temp - $i] * $multiplier);

				/*if((int)$arr_version[$count_temp - $i] != $arr_version[$count_temp - $i])
				{
					do_log(__FUNCTION__.": ".$handle.", ".$in." -> ".$count_temp." -> ".$arr_version[$count_temp - $i]." * ".$multiplier." -> ".$str_version);
				}*/

				$multiplier *= 100;
			}
		}

		return $str_version;
	}
}

//main_version * 10000 + minor_version * 100 + sub_version. For example, 4.1.0 is returned as 40100
function int2point($in)
{
	$out = "";
	$in_orig = $in;

	$main_version = floor($in / 10000);

	$in -= $main_version * 10000;

	$minor_version = floor($in / 100);

	$in -= $minor_version * 100;

	$sub_version = $in;

	return $main_version.".".$minor_version.".".$sub_version;
}

function get_theme_version()
{
	$theme_version = $parent_version = 0;

	if(function_exists('wp_get_theme'))
	{
		$arr_theme_data = wp_get_theme();
		$theme_version = $arr_theme_data->get('Version');

		$parent = $arr_theme_data->parent();

		if(!empty($parent))
		{
			$parent_version = $parent->Version;
		}
	}

	return int2point(point2int($theme_version, $arr_theme_data->get('Name')) + point2int($parent_version, $arr_theme_data->get('Name')." (parent)") + get_option_or_default('option_theme_version', 1));
}

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