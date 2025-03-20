<?php

if(!defined('ABSPATH'))
{
	header('Content-Type: application/json');

	$folder = str_replace("/wp-content/themes/mf_theme/include/api", "/", dirname(__FILE__));

	require_once($folder."wp-load.php");
}

if(!isset($obj_theme))
{
	$obj_theme = new mf_theme();
}

$json_output = array();

$type = check_var('type', 'char');
$value = check_var('value', 'char');

switch($type)
{
	case 'load_more':
		$json_output['success'] = true;
		$json_output['response'] = $obj_theme->get_more_posts(array('limit_start' => $value));
	break;
}

echo json_encode($json_output);