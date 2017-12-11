<?php

if(!defined('ABSPATH'))
{
	header('Content-Type: application/json');

	$folder = str_replace("/wp-content/themes/mf_theme/include/api", "/", dirname(__FILE__));

	require_once($folder."wp-load.php");
}

if(is_plugin_active('mf_cache/index.php'))
{
	$obj_cache = new mf_cache();
	$obj_cache->fetch_request();
	$obj_cache->get_or_set_file_content('json');
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