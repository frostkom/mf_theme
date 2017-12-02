<?php

if(!defined('ABSPATH'))
{
	$folder = str_replace("/wp-content/themes/mf_theme/include", "/", dirname(__FILE__));

	require_once($folder."wp-load.php");
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

echo json_encode($json_output);