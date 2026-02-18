<?php
/*
Template Name: Webshop Favorites
*/

if(!function_exists('is_plugin_active') || function_exists('is_plugin_active') && is_plugin_active("mf_rentals/index.php"))
{
	if(have_posts())
	{
		$obj_rentals = new mf_rentals();

		while(have_posts())
		{
			the_post();

			$post_id = $post->ID;
			$post_title = $post->post_title;
			$post_content = $post->post_content;

			echo "<form action='".$obj_rentals->get_form_url(get_option('setting_quote_form'))."' method='post' id='product_form' class='mf_form product_search product_favorites'>
				<div class='aside'><div>".$obj_rentals->get_webshop_map()."</div></div>
				<article".(IS_ADMINISTRATOR ? " class='template_webshop_favorites'" : "").">
					<h1>".$post_title."</h1>
					<section>
						<div class='favorite_result'>"
							.$obj_rentals->get_search_result_info(array('type' => 'favorites'))
							.$obj_rentals->get_quote_button(array('include' => array('quote', 'print', 'email')))
							."<ul id='product_result_search' class='product_list webshop_item_list'><li class='loading'><i class='fa fa-spinner fa-spin fa-3x'></i></li></ul>
						</div>
						<div class='favorite_fallback hide'>".apply_filters('the_content', $post_content)."</div>"
					."</section>
				</article>
			</form>"
			.$obj_rentals->get_templates(array('type' => 'products'));
		}
	}
}