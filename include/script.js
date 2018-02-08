document.createElement("header");
	document.createElement("nav");
document.createElement("article");
	document.createElement("section");
document.createElement("footer");

jQuery(function($)
{
	var dom_scrollWidth = 0;

	$.fn.isOverflown = function()
	{
		var e = this[0];

		if(typeof e != 'undefined')
		{
			if(dom_scrollWidth == 0)
			{
				dom_scrollWidth = e.scrollWidth;
			}

			var isOverflown = (dom_scrollWidth > e.clientWidth), /*e.scrollHeight > e.clientHeight || */
				dom_obj = $(this);

			if(isOverflown)
			{
				dom_obj.parents("nav").addClass('is_hamburger');
			}

			else
			{
				dom_obj.parents("nav").removeClass('is_hamburger');
			}
		}
	};

	/* Slide nav */
	var slide_dom_obj = $('#mf-slide-nav');

	if(slide_dom_obj.length > 0)
	{
		var menu_items = slide_dom_obj.find('.menu .menu-item').length;

		if(menu_items > 10)
		{
			slide_dom_obj.find('#primary_nav').addClass('is_large');
		}
	}

	var slide_dom_obj = $('#mf-slide-nav');

	if(slide_dom_obj.length > 0)
	{
		var right_orig = slide_dom_obj.children('div').css('right');

		function show_slide_menu()
		{
			slide_dom_obj.fadeIn().children('div').animate({'right': '0'}, 500);

			return false;
		}

		function hide_slide_menu()
		{
			slide_dom_obj.children('div').animate({'right': right_orig}, 500, function()
			{
				$(this).parent('#mf-slide-nav').fadeOut();
			});

			return false;
		}

		$(document).on('click', '#slide_nav', function()
		{
			show_slide_menu();
		});

		$(document).on('click', '.is_large .menu-item-has-children:not(.current-menu-item) > a', function()
		{
			$(this).parent('li').addClass('current-menu-item');

			return false;
		});

		$(document).on('click', '#mf-slide-nav', function(e)
		{
			var dom_obj = $(e.target);

			if(dom_obj.is('#mf-slide-nav') || dom_obj.is('i'))
			{
				hide_slide_menu();
			}
		});
	}

	/* Mobile nav */
	if(script_theme.hamburger_collapse_if_no_space)
	{
		$("body:not(.is_mobile) #primary_nav .menu").isOverflown();
	}

	$(document).on('click', "#primary_nav > .toggle_icon", function()
	{
		var slide_nav = $('#mf-slide-nav nav');

		if(slide_nav.length > 0)
		{
			if(slide_nav.is(':visible'))
			{
				hide_slide_menu();
			}

			else
			{
				show_slide_menu();
			}
		}

		else
		{
			$(this).parent('nav').toggleClass('open').siblings('#site_logo').toggleClass('hide_if_mobile');
		}

		return false;
	});

	if(script_theme.hamburger_collapse_if_no_space)
	{
		$(window).on('resize', function()
		{
			$("body:not(.is_mobile) #primary_nav .menu").isOverflown();
		});
	}

	/* Fixed header */
	if(script_theme.header_fixed)
	{
		function has_scrolled()
		{
			var scroll_top = $(window).scrollTop(),
				header_height = $('header').height();

			if(scroll_top > header_height)
			{
				$('header').addClass('fixed');
			}

			else
			{
				$('header').removeClass('fixed');
			}
		}

		has_scrolled();

		$(window).scroll(function(e)
		{
			has_scrolled();
		});
	}

	/* Load more */
	$(document).on('click', '#load_more', function()
	{
		var self = $(this);

		$.ajax(
		{
			url: script_theme.template_url + '/include/api/?type=load_more/' + $(this).attr('rel'),
			type: 'post',
			dataType: 'json',
			success: function(data)
			{
				if(data.success)
				{
					var parent = self.parent('ul');

					self.remove();
					parent.append(data.response);
				}
			}
		});

		return false;
	});
});