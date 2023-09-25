<?php

if(!function_exists('is_plugin_active') || function_exists('is_plugin_active') && is_plugin_active("mf_front_end_admin/index.php"))
{
	global $obj_fea;

	if(!isset($obj_fea) && class_exists('mf_fea'))
	{
		$obj_fea = new obj_fea();
	}

	echo $obj_fea->get_template_admin();
}