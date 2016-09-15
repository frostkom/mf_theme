jQuery(function($)
{
	if(typeof history.pushState === 'undefined'){}

	else
	{
		var history_href = "",
			dom_element = "#wrapper",
			dom_obj = $(dom_element);

		$('body').append("<div id='body_history'><i class='fa fa-spinner fa-spin fa-3x'></i></div>");

		String.prototype.decodeHTML = function()
		{
			return $("<div>", {html: "" + this}).html();
		};

		function loadCallback(html, status, xhr)
		{
			if(status == "error")
			{
				console.log(xhr.status + " " + xhr.statusText);
				location.href = history_href;
			}

			else
			{
				$('html, body').animate({scrollTop: 0}, 800);

				history.pushState({}, '', history_href);

				document.title = html.match(/<title>(.*?)<\/title>/)[1].trim().decodeHTML();

				$('body').attr({'class': html.match(/<body.*?class\=[\'\"](.*?)[\'\"].*>/)[1].trim()});

				$('#body_history').fadeOut();
			}
		}

		function loadPage()
		{
			$('#body_history').fadeIn();

			dom_obj.load(history_href + " " + dom_element + ">*", loadCallback);
		}

		$(window).on("popstate", function(e)
		{
			if(e.originalEvent.state !== null)
			{
				history_href = location.href;

				loadPage();
			}
		});

		$(document).on("click", "a", function()
		{
			history_href = $(this).attr("href");

			if(history_href.indexOf('#') > -1 || history_href.indexOf('wp-admin') > -1){}
			else if(history_href.indexOf(document.domain) > -1 || history_href.indexOf(':') === -1)
			{
				loadPage();

				return false;
			}
		});

		$(document).on("submit", ".searchform", function()
		{
			history_href = script_theme_history.site_url + "?s=" + $(this).children('input[name=s]').val();

			loadPage();

			return false;
		});
	}
});