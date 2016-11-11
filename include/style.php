<?php

header("Content-Type: text/css; charset=utf-8");

if(!defined('ABSPATH'))
{
	$folder = str_replace("/wp-content/themes/mf_theme/include", "/", dirname(__FILE__));

	require_once($folder."wp-load.php");
}

$options_fonts = get_theme_fonts();

list($options_params, $options) = get_params();

echo show_font_face($options_params, $options_fonts, $options);

echo "@media all
{
	body:before
	{
		display: none;
	}

	html, body, header, nav, mf-pre-content, mf-content, article, section, aside, #aside, mf-pre-footer, footer, div, ul, ol, li, h1, h2, h3, h4, h5, h6, form, button, p
	{
		margin: 0;
		padding: 0;
	}

	html
	{
		overflow-y: scroll;
	}

	body, header, nav, mf-pre-content, mf-content, article, section, aside, #aside, mf-pre-footer, footer, div, ol, ul, li, form, input, select, textarea, button, a, iframe, h1, h2, h3, h4, h5
	{
		box-sizing: border-box;
	}

	header, nav, mf-pre-content, mf-content, article, section, aside, #aside, mf-pre-footer, footer, input:not([type='checkbox']):not([type='radio']), textarea
	{
		display: block;
	}

	a
	{
		color: inherit;
		text-decoration: none;
	}

		p a
		{
			text-decoration: underline;"
			.render_css(array('property' => 'color', 'value' => 'body_link_color'))
		."}

	img
	{
		border: 0;
		max-width: 100%;
	}

	.clear
	{
		clear: both;
	}

	.aligncenter
	{
		margin: .5em 0 .5em 0;
		text-align: center;
	}

	.alignleft
	{
		float: left;
		margin: 0 .5em .5em 0;
	}

	.alignright
	{
		float: right;
		margin: 0 0 .5em .5em;
	}

	/*.alignleft
	{
		float: left;
	}

		img.alignleft
		{
			margin: 0 1em 1em 0;
		}

	.alignright
	{
		float: right;
	}

		img.alignright
		{
			margin: 0 0 1em 1em;
		}*/

	.edit_mode
	{
		background: #eee;
		border: 1px solid #999;
		display: none;
		opacity: .7;
		padding: 3px;
		position: absolute;
	}

		article:hover > .edit_mode
		{
			display: block;
		}

	html
	{"
		."font-size: .625em;"
		.render_css(array('property' => 'font-size', 'value' => 'body_font_size'))
	."}

	body
	{"
		.render_css(array('property' => 'background', 'value' => 'body_bg'))
		.render_css(array('property' => 'font-family', 'value' => 'body_font'))
		.render_css(array('property' => 'color', 'value' => 'body_color'))
		."position: relative;
		text-align: left;
	}

		header > div, mf-pre-content > div, mf-content > div, mf-pre-footer > div, footer > div
		{"
			.render_css(array('property' => 'padding', 'value' => 'main_padding'))
			."position: relative;
		}

		header
		{"
			.render_css(array('property' => 'background', 'value' => 'header_bg'))
			.render_css(array('property' => 'overflow', 'value' => 'header_overflow'))
			."position: relative;
		}

			header > div
			{"
				.render_css(array('property' => 'padding', 'value' => 'header_padding'))
			."}";

				if(isset($options['header_fixed']) && $options['header_fixed'] == 2)
				{
					echo "header.fixed > div
					{"
						.render_css(array('property' => 'background', 'value' => 'body_bg'))
						."left: 0;
						position: fixed;
						right: 0;
						z-index: 10;
					}";
				}

				echo "#site_logo
				{"
					.render_css(array('property' => 'font-family', 'value' => 'logo_font'))
					."float: left;"
					.render_css(array('property' => 'font-size', 'value' => 'logo_font_size'))
					."font-weight: bold;"
					.render_css(array('property' => 'color', 'value' => 'logo_color'))
					.render_css(array('property' => 'padding', 'value' => 'logo_padding'))
					."position: relative;
					text-decoration: none;"
					.render_css(array('property' => 'max-width', 'value' => 'logo_width'))
				."}

					#site_logo span
					{
						display: block;
						font-size: 0.4em;
					}

				header .searchform
				{
					float: right;
					padding: 1em;
				}

					header .searchform input
					{
						display: inline-block;
						padding: .5em;
					}

				header nav
				{
					clear: right;"
					.render_css(array('property' => 'font-family', 'value' => 'nav_font'))
					.render_css(array('property' => 'font-size', 'value' => 'nav_size'))
					."text-align: right;
				}

					#secondary_nav
					{
						clear: none;
					}

						#secondary_nav > div
						{
							font-size: .7em;
						}

					header nav > .toggle_icon
					{
						cursor: pointer;
						display: none;
					}

					header nav ul
					{
						list-style: none;
					}

						header nav li
						{
							display: inline-block;
							position: relative;
						}

							header nav a
							{
								display: block;"
								.render_css(array('property' => 'color', 'value' => 'nav_color'))
								.render_css(array('property' => 'padding', 'value' => 'nav_link_padding'))
							."}

								header nav a:hover, header nav li.current_page_item > a
								{"
									.render_css(array('prefix' => "border-bottom: 5px solid ", 'value' => 'nav_underline_color_hover'))
									.render_css(array('property' => 'color', 'value' => 'nav_color_hover'))
								."}

								header nav li:hover > ul, header nav li.current-menu-item > ul, header nav li.current-menu-ancestor > ul
								{
									display: block;
								}

								header nav li > ul
								{
									display: none;
									font-size: .8em;
									white-space: nowrap;
								}

									header nav li > ul a
									{
										padding: .7em;
									}

						#slide_nav > .fa
						{
							display: inline-block;
							margin-left: .5em;
						}

		mf-pre-content
		{"
			.render_css(array('property' => 'background', 'value' => 'front_bg'))
			."overflow: hidden;"
			.render_css(array('property' => 'padding', 'value' => 'front_padding'))
		."}

		mf-slide-nav
		{
			display: none;

			background: #000;
			background: rgba(0, 0, 0, .3);
			bottom: 0;
			left: 0;
			position: absolute;
			right: 0;
			top: 0;
			z-index: 1001;
		}

			mf-slide-nav > div
			{
				right: -30%;

				background: #fff;
				bottom: 0;"
				.render_css(array('property' => 'font-family', 'value' => 'nav_font'))
				.render_css(array('property' => 'font-size', 'value' => 'nav_size'))
				."padding: 2em;
				position: absolute;
				top: 0;
				width: 30%;
				max-width: 250px;
			}

				mf-slide-nav .fa-close
				{
					cursor: pointer;
					font-size: 1.4em;
					position: absolute;
					right: 4%;
					top: 1%;
				}

				mf-slide-nav ul
				{
					list-style: none;
				}

					mf-slide-nav .menu a
					{
						display: block;
						letter-spacing: .2em;
						margin-left: 0;
						opacity: .7;"
						.render_css(array('property' => 'padding', 'value' => 'nav_link_padding'))
						."transition: all .4s ease;
					}

					mf-slide-nav .menu a:hover
					{
						margin-left: .3em;
						opacity: 1;
					}

				mf-slide-nav ul, mf-slide-nav p
				{
					margin-bottom: 1em;
				}

		content, mf-content
		{
			clear: both;
		}

			mf-content > div
			{"
				.render_css(array('property' => 'background', 'value' => 'content_bg'))
				."overflow: hidden;"
				.render_css(array('property' => 'padding', 'value' => 'content_padding'))
			."}

				article{}

					article h1
					{"
						.render_css(array('property' => 'border-bottom', 'value' => 'heading_border_bottom'))
						.render_css(array('property' => 'font-family', 'value' => 'heading_font'))
						.render_css(array('property' => 'font-size', 'value' => 'heading_size'))
						.render_css(array('property' => 'font-weight', 'value' => 'heading_weight'))
						.render_css(array('property' => 'margin', 'value' => 'heading_margin'))
						."padding-bottom: 1%;
					}

						article h1 a
						{
							color: inherit;
						}

					article h2
					{"
						.render_css(array('property' => 'font-family', 'value' => 'heading_font_h2'))
						.render_css(array('property' => 'font-size', 'value' => 'heading_size_h2'))
					."}

					article section
					{"
						.render_css(array('property' => 'font-size', 'value' => 'section_size'))
						.render_css(array('property' => 'line-height', 'value' => 'section_line_height'))
						.render_css(array('property' => 'margin', 'value' => 'section_margin'))
					."}

						article p, article ul, article ol, article form
						{
							clear: both;
							margin-bottom: 1em;
						}

							article ul, article ol
							{
								list-style-position: inside;
							}

								article p a, article ul a, article ol a
								{
									border-bottom: 2px solid transparent;"
									.render_css(array('property' => 'color', 'value' => 'article_url_color'))
									."text-decoration: none;
								}

									article p a:hover, article ul a:hover, article ol a:hover
									{"
										.render_css(array('property' => 'border-bottom-color', 'value' => 'article_url_color'))
									."}

				aside, #aside
				{"
					.render_css(array('property' => 'font-size', 'value' => 'aside_size'))
					.render_css(array('property' => 'line-height', 'value' => 'aside_line_height'))
				."}

					aside ul, aside ol, #aside ul, #aside ol
					{
						list-style-position: inside;
					}

						aside p a, aside ul a, aside ol a, #aside p a, #aside ul a, #aside ol a
						{
							border-bottom: 2px solid transparent;"
							.render_css(array('property' => 'color', 'value' => 'article_url_color'))
							."text-decoration: none;
						}

		mf-pre-footer
		{"
			.render_css(array('property' => 'background', 'value' => 'pre_footer_bg'))
			."overflow: hidden;"
			.render_css(array('property' => 'padding', 'value' => 'pre_footer_padding'))
		."}

		footer
		{"
			.render_css(array('property' => 'background', 'value' => 'footer_bg'))
			.render_css(array('property' => 'font-size', 'value' => 'footer_font_size'))
			."line-height: 1.5;"
			.render_css(array('property' => 'margin', 'value' => 'footer_margin'))
			."overflow: hidden;"
			.render_css(array('property' => 'padding', 'value' => 'footer_padding'))
			."position: relative;
			z-index: 1000;
		}

			footer > div
			{";

				if(isset($options['footer_widget_flex']) && $options['footer_widget_flex'] == 2)
				{
					echo "display: -webkit-box;
					display: -ms-flexbox;
					display: -webkit-flex;
					display: flex;";
				}

			echo "}

				footer, footer a
				{"
					.render_css(array('property' => 'color', 'value' => 'footer_color'))
				."}

				footer .widget
				{"
					.render_css(array('property' => 'overflow', 'value' => 'footer_widget_overflow'))
					.render_css(array('property' => 'padding', 'value' => 'footer_widget_padding'));

					if(isset($options['footer_widget_flex']) && $options['footer_widget_flex'] == 2)
					{
						echo "-webkit-box-flex: 1;
						-webkit-flex: 1;
						-ms-flex: 1;
						flex: 1;";
					}

				echo "}

					footer .widget:nth-child(2n)
					{
						margin-right: 0;
					}

					footer .widget h3
					{"
						.render_css(array('property' => 'font-size', 'value' => 'footer_widget_heading_size'))
						.render_css(array('property' => 'margin', 'value' => 'footer_widget_heading_margin'));

						if(isset($options['footer_widget_heading_text_transform']) && $options['footer_widget_heading_text_transform'] != '')
						{
							echo render_css(array('property' => 'text-transform', 'value' => 'footer_widget_heading_text_transform'));
						}

					echo "}

						footer ul
						{
							list-style: none;
							margin-left: -.4em;
						}

							footer li a
							{
								border-radius: .3em;
								display: block;
								margin-bottom: .2em;
								padding: .4em;
							}

								footer li a:hover, footer li.current_page_item a
								{"
									.render_css(array('property' => 'color', 'value' => 'nav_color_hover'))
								."}

						footer .textwidget > a, footer .vcard > a
						{
							display: block;"
							.render_css(array('property' => 'background', 'value' => 'footer_a_bg'))
							."margin-top: .5em;";

							if(isset($options['footer_a_bg']) && $options['footer_a_bg'] != '')
							{
								echo "border-radius: 5px;
								padding: 2%;";
							}

						echo "}

							footer .textwidget > a:hover, footer .vcard > a:hover
							{"
								.render_css(array('property' => 'color', 'value' => 'nav_color_hover'))
							."}

							footer a img.alignleft
							{
								border-radius: 10px;
								max-width: 44%;
							}

								footer a:nth-of-type(2n + 1) img.alignleft
								{
									margin-right: 4%;
								}";

	if(isset($options['custom_css_all']) && $options['custom_css_all'] != '')
	{
		echo $options['custom_css_all'];
	}

echo "}";

$flex_content = "mf-content > div
{
	display: -webkit-box;
	display: -ms-flexbox;
	display: -webkit-flex;
	display: flex;
}

	mf-content > div > article
	{
		width: 100%;
	}

	main, #main
	{
		-webkit-box-flex: 2 1 auto;
		-webkit-flex: 2 1 auto;
		-ms-flex: 2 1 auto;
		flex: 2 1 auto;
		padding-right: 0;
		max-width: 100%;
	}

	aside, #aside
	{
		margin-left: 2%;
		-webkit-box-flex: 1 0 28%;
		-webkit-flex: 1 0 28%;
		-ms-flex: 1 0 28%;
		flex: 1 0 28%;
	}";

if(isset($options['mobile_breakpoint']) && $options['mobile_breakpoint'] > 0)
{
	echo "@media (max-width: ".($options['mobile_breakpoint'] - 1)."px)
	{
		body:before
		{
			content: 'mobile';
		}

		.hide_if_mobile
		{
			display: none;
		}";

			if(!isset($options['logo_mobile_visible']) || $options['logo_mobile_visible'] != 2)
			{
				echo "#site_logo
				{
					display: none;
				}";
			}

			else
			{
				echo "#site_logo
				{"
					.render_css(array('property' => 'max-width', 'value' => 'logo_width_mobile'))
				."}";
			}

			echo "#secondary_nav, header .searchform
			{
				display: none;
			}

			header nav#primary_nav
			{
				float: none;
				margin: 0;
				text-align: center;
				width: 100%;
			}

				header nav > .toggle_icon
				{"
					.render_css(array('property' => 'color', 'value' => 'nav_color'))
					."display: block;
					font-size: 1.4em;
					position: absolute;
					right: 4%;
					top: 1em;
				}

					header nav .fa-close
					{
						display: none;
					}

					header nav.is_mobile_ready ul > li
					{
						display: none;
					}

						header nav.open .fa-bars
						{
							display: none;
						}

						header nav.open .fa-close
						{
							display: block;
						}

						header nav.open ul > li
						{
							display: block;
						}

				header nav ul
				{
					min-height: 3em;
					margin: 0 auto;
					width: 80%;
				}

					header nav > div > ul > li
					{"
						.render_css(array('property' => 'background', 'value' => 'header_bg'))
						."display: none;
					}

						header nav > div > ul > li:last-of-type
						{
							border-radius: 0 0 1em 1em;
						}

						header nav a:hover, header nav li.current_page_item > a
						{
							border-bottom: 0;
						}

							header nav ul .sub-menu
							{
								display: block;
							}

			footer > div
			{
				display: block;
				text-align: center;
			}";

		if(isset($options['custom_css_mobile']) && $options['custom_css_mobile'] != '')
		{
			echo $options['custom_css_mobile'];
		}

	echo "}

	@media (min-width: ".$options['mobile_breakpoint']."px)
	{
		body:before
		{
			content: 'tablet';
			display: none;
		}

		.show_if_mobile
		{
			display: none;
		}

		html
		{"
			.render_css(array('property' => 'font-size', 'value' => 'body_desktop_font_size'))
		."}

			header nav li > ul
			{
				background: rgba(0, 0, 0, .2);
				border-radius: .3em;
				right: 0;
				position: absolute;
				top: 4em;
			}

				header nav li > ul:before
				{
					content: '';
					position: absolute;
					top: -2em;
					right: 3em;
					border: 1em solid transparent;
					border-bottom: 1em solid rgba(0, 0, 0, .2);
				}"
		.$flex_content
	."}";

	$flex_content = "";
}

if(isset($options['website_max_width']) && $options['website_max_width'] > 0)
{
	echo "@media (min-width: ".$options['website_max_width']."px)
	{
		body:before
		{
			content: 'desktop';
		}

		header > div, mf-pre-content > div, mf-content > div, mf-pre-footer > div, footer > div
		{
			margin: 0 auto;
			max-width: ".$options['website_max_width']."px;
		}"
		.$flex_content
	."}";
}

echo "@media print
{
	body:before
	{
		content: 'print';
	}

	body
	{
		background: none;
	}

	mf-content > div
	{
		width: auto;
	}

	header, mf-pre-content, aside, #aside, mf-pre-footer, footer
	{
		display: none;
	}
}";