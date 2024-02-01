<?php

if(!function_exists('is_plugin_active') || function_exists('is_plugin_active') && is_plugin_active("mf_webshop/index.php"))
{
	global $obj_webshop;

	if(!isset($obj_webshop) && class_exists('mf_webshop'))
	{
		$obj_webshop = new obj_webshop();
	}

	echo $obj_webshop->get_template_admin(array('type' => 'template_webshop'));
}