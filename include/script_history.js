jQuery(function($)
{
	String.prototype.decodeHTML = function()
	{
		return $("<div>", {html: "" + this}).html();
	};

	function loadCallback(html)
	{
		document.title = html.match(/<title>(.*?)<\/title>/)[1].trim().decodeHTML();

		$('body').attr({'class': html.match(/<body.*class\=[\'\"](.*?)[\'\"].*>/)[1].trim()});
	}
	
	function loadPage(href)
	{
		dom_obj.load(href + " " + dom_element + ">*", loadCallback);
	}

	var dom_element = "mf-wrapper",
		dom_obj = $(dom_element);

	$(window).on("popstate", function(e)
	{
		if(e.originalEvent.state !== null)
		{
			loadPage(location.href);
		}
	});

	$(document).on("click", "a", function()
	{
		var href = $(this).attr("href");

		if(href.indexOf('#') > -1 || href.indexOf('wp-admin') > -1){}

		else if(href.indexOf(document.domain) > -1 || href.indexOf(':') === -1)
		{
			history.pushState({}, '', href);

			loadPage(href);

			return false;
		}
	});

	$(document).on("submit", ".searchform", function()
	{
		var href = script_theme_history.site_url + "?s=" + $(this).children('input[name=s]').val();

		history.pushState({}, '', href);

		loadPage(href);

		return false;
	});
});