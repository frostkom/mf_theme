<?php

$wp_root = '../../../..';

if(file_exists($wp_root.'/wp-load.php'))
{
	require_once($wp_root.'/wp-load.php');
}

else
{
	require_once($wp_root.'/wp-config.php');
}

$json_output = array();

$type = check_var('type', 'char');

$arr_input = explode("/", $type);

$type_action = $arr_input[0];
$type_value = isset($arr_input[1]) ? $arr_input[1] : "";

if($type_action == "load_more")
{
	$json_output['success'] = true;
	$json_output['response'] = get_more_posts(array('limit_start' => $type_value));
}

else if($type_action == "get_style_source")
{
	$theme = wp_get_theme();

	if($theme->exists())
	{
		list($upload_path, $upload_url) = get_uploads_folder('mf_theme');

		$globals['mf_theme_files'] = array();

		get_file_info(array('path' => $upload_path, 'callback' => "get_previous_backups"));

		$count_temp = count($globals['mf_theme_files']);

		if($count_temp > 0)
		{
			$style_url = $upload_url.$globals['mf_theme_files'][0]['name'];
			$style_changed = date("Y-m-d H:i:s", strtotime(substr($style_url, -17, 12)));
		}

		else
		{
			$style_url = "";
			$style_changed = DEFAULT_DATE;
		}

		$json_output['success'] = true;
		$json_output['response'] = array(
			'theme_version' => $theme->get('Version'),
			'style_changed' => $style_changed,
			'style_url' => $style_url,
		);
	}
}

echo json_encode($json_output);