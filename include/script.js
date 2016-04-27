document.createElement("mf-wrapper");
	document.createElement("header");
		document.createElement("nav");
	document.createElement("mf-slide-nav");
	document.createElement("mf-pre-content");
	document.createElement("mf-content");
		//document.createElement("main");
			document.createElement("article");
			document.createElement("section");
		//document.createElement("aside");
		document.createElement("mf-pre-footer");
	document.createElement("footer");

jQuery(function($)
{
	//Mobile nav
	function toggle_menu(dom_obj)
	{
		dom_obj.parent('nav').siblings('#site_logo').toggleClass('hide_if_mobile');
		dom_obj.parent('nav').find('ul > li').toggleClass('show_page_item');
	}

	$('header nav > .fa').on('click', function()
	{
		toggle_menu($(this));

		$(this).parent('nav').toggleClass('open');
	});

	//Slide nav
	var right_orig = $('mf-slide-nav > div').css('right');

	function show_menu()
	{
		$('mf-slide-nav').fadeIn().children('div').animate({'right': '0'}, 500);

		return false;
	}

	function hide_menu()
	{
		$('mf-slide-nav > div').animate({'right': right_orig}, 500, function()
		{
			$(this).parent('mf-slide-nav').fadeOut();
		});

		return false;
	}

	$('#slide_nav').on('click', function()
	{
		show_menu();
	});

	$('mf-slide-nav').on('click', function(e)
	{
		var dom_obj = $(e.target);

		if(dom_obj.is('mf-slide-nav') || dom_obj.is('i'))
		{
			hide_menu();
		}
	});

	//Fixed header
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

	if(script_theme.header_fixed)
	{
		$(window).scroll(function(e)
		{
			has_scrolled();
		});

		has_scrolled();
	}

	//Load more
	$('#load_more').on('click', function()
	{
		var self = $(this);

		$.ajax(
		{
			url: script_theme.template_url + '/include/ajax.php?type=load_more/' + $(this).attr('rel'),
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