<?php

if(!defined('ABSPATH'))
{
	header('Content-Type: application/json');

	$folder = str_replace("/wp-content/themes/mf_theme/include/api", "/", dirname(__FILE__));

	require_once($folder."wp-load.php");
}

do_action('run_cache', array('suffix' => 'json'));

if(!isset($obj_theme))
{
	$obj_theme = new mf_theme();
}

$json_output = array();

$type = check_var('type', 'char');

$arr_input = explode("/", $type);

$type_action = $arr_input[0];
$type_value = (isset($arr_input[1]) ? $arr_input[1] : '');

switch($type_action)
{
	case 'load_more':
		$json_output['success'] = true;
		$json_output['response'] = $obj_theme->get_more_posts(array('limit_start' => $type_value));
	break;
}

echo json_encode($json_output);