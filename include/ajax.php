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
$type_value = $arr_input[1];

if($type_action == "load_more")
{
	$json_output['success'] = true;
	$json_output['response'] = get_more_posts(array('limit_start' => $type_value));
}

echo json_encode($json_output);