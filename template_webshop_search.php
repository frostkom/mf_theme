<?php
/*
Template Name: Webshop Search
*/

if(!function_exists('is_plugin_active') || function_exists('is_plugin_active') && is_plugin_active("mf_rentals/index.php"))
{
	$obj_rentals = new mf_rentals();

	echo "<form action='".$obj_rentals->get_form_url(get_option('setting_quote_form'))."' method='post' id='product_form' class='mf_form product_search'>
		<div class='aside'><div>".$obj_rentals->get_webshop_map()."</div></div>
		<article".(IS_ADMINISTRATOR ? " class='template_webshop_search'" : "").">"
			."<section>"
				.$obj_rentals->get_search_result_info(array('type' => 'filter'))
				.$obj_rentals->get_webshop_search()
				.$obj_rentals->get_search_result_info(array('type' => 'matches'))
				."<ul id='product_result_search' class='product_list webshop_item_list'><li class='loading'><i class='fa fa-spinner fa-spin fa-3x'></i></li></ul>"
				.$obj_rentals->get_quote_button()
				.$obj_rentals->get_form_fields_passthru()
			."</section>
		</article>
	</form>"
	.$obj_rentals->get_templates(array('type' => 'products'));
}