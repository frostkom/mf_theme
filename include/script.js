document.createElement("header");
	document.createElement("nav");
document.createElement("article");
	document.createElement("section");
document.createElement("footer");

jQuery(function($)
{
	/* Slide nav */
	var slide_dom_obj = $("#mf-slide-nav");

	if(slide_dom_obj.length > 0)
	{
		var menu_items = slide_dom_obj.find(".menu .menu-item").length;

		if(menu_items > 10)
		{
			slide_dom_obj.find("#primary_nav").addClass('is_large');
		}

		var right_orig = slide_dom_obj.children("div").css('right');

		function init_slide_nav()
		{
			slide_dom_obj.show();
		}

		function display_slide_nav()
		{
			$("body").addClass('display_slide_nav');

			return false;
		}

		function hide_slide_nav()
		{
			$("body").removeClass('display_slide_nav');

			return false;
		}

		init_slide_nav();

		$(document).on('click', "#slide_nav", function()
		{
			display_slide_nav();
		});

		$(document).on('click', ".is_large .menu-item-has-children:not(.current-menu-item) > a", function()
		{
			$(this).parent("li").addClass('current-menu-item');
		});

		slide_dom_obj.on('click', function(e)
		{
			var dom_obj = $(e.target);

			if(dom_obj.is("#mf-slide-nav") || dom_obj.is("i"))
			{
				hide_slide_nav();
			}
		});
	}

	/* Mobile nav */
	function toggle_hamburger(dom_obj_nav)
	{
		var toggle_class = (!dom_obj_nav.hasClass('is_hamburger') && dom_obj_nav.parents("body").hasClass('is_mobile') ? 'hide_if_mobile' : 'hide');

		dom_obj_nav.toggleClass('open').siblings().toggleClass(toggle_class);
	}

	$(document).on('click', "#primary_nav > .toggle_icon", function()
	{
		var slide_nav = slide_dom_obj.find("nav");

		if(slide_nav.length > 0)
		{
			if($("body").hasClass('display_slide_nav'))
			{
				hide_slide_nav();
			}

			else
			{
				display_slide_nav();
			}
		}

		else
		{
			var dom_obj_nav = $(this).parent("nav");

			toggle_hamburger(dom_obj_nav);
		}

		return false;
	});

	$(document).on('click', "#primary_nav.is_hamburger.open a", function()
	{
		toggle_hamburger($(this).parents("nav"));
	});

	/* Load More */
	$(document).on('click', "#load_more", function()
	{
		var dom_obj_parent = $(this).parent(".form_button");

		$.ajax(
		{
			url: script_theme.template_url + '/include/api/',
			type: 'post',
			dataType: 'json',
			data: {
				type: 'load_more',
				value: $(this).attr('rel')
			},
			success: function(data)
			{
				if(data.success)
				{
					var dom_obj_main = dom_obj_parent.parent("#main");

					dom_obj_parent.remove();
					dom_obj_main.append(data.response);
				}
			}
		});

		return false;
	});
});