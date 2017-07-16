<?php

header("Content-Type: text/css; charset=utf-8");

if(!defined('ABSPATH'))
{
	$folder = str_replace("/wp-content/themes/mf_theme/include", "/", dirname(__FILE__));

	require_once($folder."wp-load.php");
}

$options_fonts = get_theme_fonts();

list($options_params, $options) = get_params();

$out = show_font_face($options_params, $options_fonts, $options)
."@media all
{
	mf-after-header, #aside, mf-pre-footer
	{
		margin: 0;
		padding: 0;
	}

	mf-after-header, #aside, mf-pre-footer
	{
		box-sizing: border-box;
	}

	header, nav, mf-after-header, #mf-pre-content, mf-content, article, section, #aside, mf-pre-footer, footer, input:not([type='checkbox']):not([type='radio']), textarea
	{
		display: block;
	}

	p a
	{"
		.render_css(array('property' => 'color', 'value' => 'body_link_color'))
	."}

	#wrapper .mf_form button, #wrapper .button
	{";
		if(isset($options['button_color']) && $options['button_color'] != '')
		{
			$out .= render_css(array('property' => 'background', 'value' => 'button_color'));
		}

		else
		{
			$out .= render_css(array('property' => 'background', 'value' => 'nav_color_hover'));
		}

		$out .= "color: #fff;"
	."}

		#wrapper .mf_form button:hover, #wrapper .button:hover
		{"
			.render_css(array('property' => 'background', 'value' => 'button_color_hover'))
		."}

		#wrapper button.button-secondary
		{
			background: #999;
		}

			#wrapper button.button-secondary:hover
			{
				background: #aaa;
			}

	html
	{
		font-size: .625em;"
		.render_css(array('property' => 'font-size', 'value' => 'body_font_size'))
		."overflow-y: scroll;
	}

	body
	{";

		if(isset($options['footer_bg']) && $options['footer_bg'] != '')
		{
			$out .= render_css(array('property' => 'background', 'value' => 'footer_bg'))
			."min-height: 100vh;";
		}

		$out .= render_css(array('property' => 'font-family', 'value' => 'body_font'))
		.render_css(array('property' => 'color', 'value' => 'body_color'))
		."overflow: hidden;
		position: relative;
	}

	#wrapper
	{"
		.render_css(array('property' => 'background', 'value' => 'body_bg'))
	."}

		header > div, mf-after-header > div, #mf-pre-content > div, mf-content > div, mf-pre-footer > div, footer > div, .full_width .widget .section, .full_width .widget > div
		{"
			.render_css(array('property' => 'padding', 'value' => 'main_padding'))
			."position: relative;
		}

		.full_width .widget
		{
			left: 50%;
			margin-left: -50vw;
			margin-right: -50vw;
			position: relative;
			right: 50%;
			width: 100vw;
			max-width: none;
		}

		header
		{"
			.render_css(array('property' => 'background', 'value' => 'header_bg'))
			.render_css(array('property' => 'overflow', 'value' => 'header_overflow'))
			."position: relative;
		}";

			if(isset($options['header_padding']) && $options['header_padding'] != '')
			{
				$out .= "header > div
				{"
					.render_css(array('property' => 'padding', 'value' => 'header_padding'))
				."}";
			}

				if(isset($options['header_fixed']) && $options['header_fixed'] == 2)
				{
					$out .= "header.fixed > div
					{"
						.render_css(array('property' => 'background', 'value' => 'body_bg'))
						."left: 0;
						position: fixed;
						right: 0;
						z-index: 10;
					}";
				}

				$out .= "#site_logo
				{"
					.render_css(array('property' => 'font-family', 'value' => 'logo_font'))
					."float: left;"
					.render_css(array('property' => 'font-size', 'value' => 'logo_font_size'))
					."font-weight: bold;"
					.render_css(array('property' => 'color', 'value' => 'logo_color'))
					.render_css(array('property' => 'margin', 'value' => 'logo_padding'))
					."position: relative;
					text-decoration: none;
					transition: all .4s ease;"
					.render_css(array('property' => 'max-width', 'value' => 'logo_width'))
				."}

					#site_logo span
					{
						display: block;
						font-size: .4em;
					}

				.searchform
				{"
					.render_css(array('property' => 'color', 'value' => 'search_color'))
					.render_css(array('property' => 'font-size', 'value' => 'search_size'))
					."padding: .3em;
					position: relative;
				}

					.searchform .form_textfield
					{
						display: inline-block;
						position: relative;
						z-index: 1;
					}

						.searchform .form_textfield input
						{
							background: none;"
							.render_css(array('property' => 'color', 'value' => 'search_color'))
							."display: inline-block;
							float: right;
							margin: 0;
							padding-right: 2.2em !important;
						}

							.searchform.search_animate .form_textfield input
							{
								border-color: rgba(0, 0, 0, .1);
								opacity: 0;
								transition: all .4s ease;
								width: 0 !important;
							}

								.searchform.search_animate .form_textfield input:focus
								{
									border-color: #e1e1e1;
									opacity: 1;
									width: 100% !important;
								}

					.searchform .fa
					{
						position: absolute;
						right: 1em;
						top: 1.1em;
					}

				header .searchform
				{
					float: right;
				}

				.theme_nav.is_mobile_ready
				{"
					.render_css(array('property' => 'font-family', 'value' => 'nav_font'))
				."}

					.theme_nav ul
					{
						list-style: none;
					}
					
						.theme_nav.is_mobile_ready li
						{
							display: inline-block;
							margin-left: -.3em;
							position: relative;
						}

							header .theme_nav.is_mobile_ready li:first-child
							{
								margin-left: 0;
							}
							
								.theme_nav a
								{
									display: block;"
									.render_css(array('property' => 'padding', 'value' => 'nav_link_padding'))
								."}

									.theme_nav li:hover > ul, .theme_nav li.current-menu-item > ul, .theme_nav li.current-menu-ancestor > ul
									{
										display: block;
									}

									.theme_nav li > ul
									{
										display: none;
									}

					header #primary_nav
					{"
						.render_css(array('property' => 'background', 'value' => 'nav_bg'))
						.render_css(array('property' => 'clear', 'value' => 'nav_clear'))
						.render_css(array('property' => 'font-size', 'value' => 'nav_size'))
						.render_css(array('property' => 'text-align', 'value' => 'nav_align'))
					."}

						#primary_nav > .toggle_icon
						{
							display: none;
						}

							#primary_nav a
							{"
								.render_css(array('property' => 'color', 'value' => 'nav_color'))
							."}

								#primary_nav a:hover, #primary_nav li.current_page_ancestor.current_page_ancestor > a, #primary_nav li.current_page_item.current_page_item > a
								{"
									.render_css(array('prefix' => "border-bottom: 5px solid ", 'value' => 'nav_underline_color_hover'))
									.render_css(array('property' => 'color', 'value' => 'nav_color_hover'))
								."}

									#primary_nav li.current_page_ancestor.current_page_ancestor > a, #primary_nav li.current_page_item.current_page_item > a
									{"
										.render_css(array('property' => 'background', 'value' => 'nav_bg_current'))
										.render_css(array('property' => 'color', 'value' => 'nav_color_current'))
									."}

						#slide_nav > .fa
						{
							display: inline-block;
							margin-left: .5em;
						}

					#secondary_nav
					{"
						.render_css(array('property' => 'background', 'value' => 'nav_secondary_bg'))
						.render_css(array('property' => 'clear', 'value' => 'nav_secondary_clear'))
						.render_css(array('property' => 'font-size', 'value' => 'nav_secondary_size'))
						.render_css(array('property' => 'text-align', 'value' => 'nav_secondary_align'))
					."}

						#secondary_nav a
						{"
							.render_css(array('property' => 'color', 'value' => 'nav_secondary_color'))
						."}

							#secondary_nav a:hover, #secondary_nav li.current_page_ancestor.current_page_ancestor > a, #secondary_nav li.current_page_item.current_page_item > a
							{"
								.render_css(array('property' => 'color', 'value' => 'nav_secondary_color_hover'))
							."}

								#secondary_nav li.current_page_ancestor.current_page_ancestor > a, #secondary_nav li.current_page_item.current_page_item > a
								{"
									.render_css(array('property' => 'background', 'value' => 'nav_secondary_bg_current'))
									.render_css(array('property' => 'color', 'value' => 'nav_secondary_color_current'))
								."}

		mf-after-header .widget + .widget
		{
			margin-top: 1em;
		}

		#mf-pre-content
		{"
			.render_css(array('property' => 'background', 'value' => 'front_bg'))
			.render_css(array('property' => 'color', 'value' => 'front_color'))
			."overflow: hidden;
		}

			#mf-pre-content > div
			{"
				.render_css(array('property' => 'padding', 'value' => 'front_padding'))
			."}

				#mf-pre-content h3
				{"
					.render_css(array('property' => 'font-family', 'value' => 'heading_font'))
					.render_css(array('property' => 'font-size', 'value' => 'heading_size'))
					.render_css(array('property' => 'font-weight', 'value' => 'heading_weight'))
					.render_css(array('property' => 'margin', 'value' => 'heading_margin'))
					.render_css(array('property' => 'padding', 'value' => 'heading_padding'))
				."}

				#mf-pre-content p
				{"
					.render_css(array('property' => 'font-size', 'value' => 'section_size'))
					.render_css(array('property' => 'line-height', 'value' => 'section_line_height'))
					.render_css(array('property' => 'margin', 'value' => 'section_margin'))
				."}

		mf-slide-nav
		{
			background: rgba(0, 0, 0, .3);
			bottom: 0;
			display: none;
			left: 0;
			position: fixed;
			right: 0;
			top: 0;
			z-index: 1001;
		}

			mf-slide-nav > div
			{"
				.render_css(array('property' => 'background', 'value' => 'slide_nav_bg'))
				."bottom: 0;"
				.render_css(array('property' => 'color', 'value' => 'slide_nav_color'))
				.render_css(array('property' => 'font-family', 'value' => 'nav_font'))
				//.render_css(array('property' => 'font-size', 'value' => 'nav_size'))
				."overflow: hidden;
				padding: 2.6em 0 1em;
				position: absolute;
				right: -90%;
				top: 0;
				width: 90%;
				max-width: 300px;
			}

				mf-slide-nav .fa-close
				{
					font-size: 2em;
					margin: 3% 4% 0 0;
					position: absolute;
					right: 0;
					top: 0;
				}

				mf-slide-nav ul
				{
					list-style: none;
				}

					mf-slide-nav #primary_nav ul a
					{"
						.render_css(array('property' => 'color', 'value' => 'slide_nav_color'))
						."display: block;
						letter-spacing: .2em;"
						.render_css(array('property' => 'padding', 'value' => 'slide_nav_link_padding'))
						."transition: all .4s ease;
					}

						mf-slide-nav #primary_nav ul a:hover
						{"
							.render_css(array('property' => 'background', 'value' => 'slide_nav_bg_hover'))
							.render_css(array('property' => 'color', 'value' => 'slide_nav_color_hover'))
							."text-indent: .3em;
						}

						mf-slide-nav #primary_nav li.current_page_item > a
						{"
							.render_css(array('property' => 'background', 'value' => 'slide_nav_bg_hover'))
							.render_css(array('property' => 'color', 'value' => 'slide_nav_color_current'))
						."}

					mf-slide-nav #primary_nav li ul
					{
						margin-bottom: 0;
					}

						mf-slide-nav #primary_nav li ul a
						{
							text-indent: 1.4em;
						}

							mf-slide-nav #primary_nav li ul a:hover
							{
								text-indent: 2em;
							}

				mf-slide-nav ul, mf-slide-nav p
				{
					margin-bottom: 1em;
				}

		mf-content
		{
			clear: both;
		}

			mf-content > div
			{"
				.render_css(array('property' => 'background', 'value' => 'content_bg'))
				."overflow: hidden;"
				.render_css(array('property' => 'padding', 'value' => 'content_padding'))
			."}

				article h1
				{"
					.render_css(array('property' => 'background', 'value' => 'heading_bg'))
					.render_css(array('property' => 'border-bottom', 'value' => 'heading_border_bottom'))
					.render_css(array('property' => 'font-family', 'value' => 'heading_font'))
					.render_css(array('property' => 'font-size', 'value' => 'heading_size'))
					.render_css(array('property' => 'font-weight', 'value' => 'heading_weight'))
					.render_css(array('property' => 'margin', 'value' => 'heading_margin'))
					.render_css(array('property' => 'padding', 'value' => 'heading_padding'))
				."}

					article h1 a
					{
						color: inherit;
					}

				article .meta
				{"
					.render_css(array('property' => 'font-size', 'value' => 'section_size'))
					."opacity: .2;
					transition: all 1s ease;
				}

					article:hover .meta
					{
						opacity: 1;
					}

					article .date
					{
						background: #808080;
						border-radius: .2em;
						color: #fff;
						display: inline-block;
						margin-right: .5em;
						margin-bottom: 1em;
						padding: .25em .5em;
					}

				h2
				{"
					.render_css(array('property' => 'font-family', 'value' => 'heading_font_h2'))
					.render_css(array('property' => 'font-size', 'value' => 'heading_size_h2'))
				."}

				h3
				{"
					.render_css(array('property' => 'font-family', 'value' => 'heading_font_h3'))
					.render_css(array('property' => 'font-size', 'value' => 'heading_size_h3'))
				."}

				article section
				{"
					.render_css(array('property' => 'background', 'value' => 'section_bg'))
					.render_css(array('property' => 'font-size', 'value' => 'section_size'))
					.render_css(array('property' => 'line-height', 'value' => 'section_line_height'))
					.render_css(array('property' => 'margin', 'value' => 'section_margin'))
					."overflow: hidden;"
					.render_css(array('property' => 'padding', 'value' => 'section_padding'))
				."}

					article + article
					{
						border-top: 1px solid #ccc;
						margin-top: 2.5em;
						padding-top: 1em;
					}

						article section.text_columns
						{
							-webkit-column-gap: 2em;
							-moz-column-gap: 2em;
							column-gap: 2em;
						}
					
							article section.columns_2
							{
								-webkit-column-count: 2;
								-moz-column-count: 2;
								column-count: 2;
							}
							
							article section.columns_3
							{
								-webkit-column-count: 3;
								-moz-column-count: 3;
								column-count: 3;
							}";


					if(isset($options['section_margin_between']) && $options['section_margin_between'] != '')
					{
						$out .= "article p, article ul, article ol, article form
						{"
							.render_css(array('property' => 'margin-bottom', 'value' => 'section_margin_between'))
						."}

							article p:last-child, article ul:last-child, article ol:last-child, article form:last-child
							{
								margin-bottom: 0;
							}";
					}

						$out .= "article ul, article ol, article form
						{
							clear: both;
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

							article li + li
							{
								margin-top: 1em;
							}

				#aside
				{"
					.render_css(array('property' => 'margin', 'value' => 'heading_margin'))
				."}

					#aside .widget
					{"
						.render_css(array('property' => 'border', 'value' => 'aside_widget_border'))
					."}

						#aside .widget + .widget
						{
							margin-top: 1em;
						}

						#aside h3
						{"
							.render_css(array('property' => 'background', 'value' => 'aside_heading_bg'))
							.render_css(array('property' => 'border-bottom', 'value' => 'aside_heading_border_bottom'))
							.render_css(array('property' => 'font-size', 'value' => 'aside_heading_size'))
							.render_css(array('property' => 'padding', 'value' => 'aside_heading_padding'))
						."}

						#aside .widget .section, #aside .widget > div, #aside .widget > form, #aside .widget > ol, #aside .widget > ul, #aside .widget > p
						{"
							.render_css(array('property' => 'background', 'value' => 'aside_widget_background'))
							.render_css(array('property' => 'font-size', 'value' => 'aside_size'))
							.render_css(array('property' => 'line-height', 'value' => 'aside_line_height'))
							."margin-bottom: .5em;"
							.render_css(array('property' => 'padding', 'value' => 'aside_padding'))
						."}

						#aside ul, #aside ol
						{
							list-style-position: inside;
						}

							#aside p a, #aside ul a, #aside ol a
							{
								border-bottom: 2px solid transparent;"
								.render_css(array('property' => 'color', 'value' => 'article_url_color'))
								."text-decoration: none;
							}

		mf-pre-footer
		{"
			.render_css(array('property' => 'background', 'value' => 'pre_footer_bg'))
			."overflow: hidden;
		}";

			if(isset($options['pre_footer_padding']) && $options['pre_footer_padding'] != '')
			{
				$out .= "mf-pre-footer > div
				{"
					.render_css(array('property' => 'padding', 'value' => 'pre_footer_padding'))
				."}";
			}

				if(isset($options['pre_footer_widget_padding']) && $options['pre_footer_widget_padding'] != '')
				{
					$out .= "mf-pre-footer > div .widget
					{"
						.render_css(array('property' => 'padding', 'value' => 'pre_footer_widget_padding'))
					."}";
				}

		$out .= "footer
		{"
			.render_css(array('property' => 'background', 'value' => 'footer_bg'))
			."overflow: hidden;
			position: relative;
			z-index: 1000;
		}

			footer > div
			{"
				.render_css(array('property' => 'color', 'value' => 'footer_color'))
				.render_css(array('property' => 'padding', 'value' => 'footer_padding'));

				if(isset($options['footer_widget_flex']) && $options['footer_widget_flex'] == 2)
				{
					$out .= "display: -webkit-box;
					display: -ms-flexbox;
					display: -webkit-flex;
					display: flex;";
				}

			$out .= "}

				footer .widget
				{"
					.render_css(array('property' => 'font-size', 'value' => 'footer_font_size'))
					.render_css(array('property' => 'overflow', 'value' => 'footer_widget_overflow'))
					.render_css(array('property' => 'padding', 'value' => 'footer_widget_padding'));

					if(isset($options['footer_widget_flex']) && $options['footer_widget_flex'] == 2)
					{
						$out .= "-webkit-box-flex: 1;
						-webkit-flex: 1;
						-ms-flex: 1;
						flex: 1;";
					}

				$out .= "}

					footer .widget:nth-child(2n)
					{
						margin-right: 0;
					}

					footer .widget h3
					{"
						.render_css(array('property' => 'margin', 'value' => 'footer_widget_heading_margin'));

						if(isset($options['footer_widget_heading_text_transform']) && $options['footer_widget_heading_text_transform'] != '')
						{
							$out .= render_css(array('property' => 'text-transform', 'value' => 'footer_widget_heading_text_transform'));
						}

					$out .= "}

						footer ul
						{
							list-style: none;
						}";

						if(isset($options['footer_p_margin']) && $options['footer_p_margin'] != '')
						{
							$out .= "footer .widget p, footer .widget li
							{"
								.render_css(array('property' => 'margin', 'value' => 'footer_p_margin'))
							."}

								footer .widget li ul
								{
									margin: .5em 0 0 .5em;
								}";
						}

						$out .= "footer .widget a
						{";

							if(isset($options['footer_a_bg']) && $options['footer_a_bg'] != '')
							{
								$out .= "border-radius: .5em;"
								.render_css(array('property' => 'background', 'value' => 'footer_a_bg'))
								."display: block;"
								.render_css(array('property' => 'margin', 'value' => 'footer_a_margin'))
								.render_css(array('property' => 'padding', 'value' => 'footer_a_padding'));
							}

							$out .= render_css(array('property' => 'color', 'value' => 'footer_color'))
						."}

							footer .widget a:hover, footer li.current_page_item a
							{";

								if(isset($options['footer_color_hover']) && $options['footer_color_hover'] != '')
								{
									$out .= render_css(array('property' => 'color', 'value' => 'footer_color_hover'));
								}

								else
								{
									$out .= render_css(array('property' => 'color', 'value' => 'nav_color_hover'));
								}

							$out .= "}";

	if(isset($options['custom_css_all']) && $options['custom_css_all'] != '')
	{
		$out .= $options['custom_css_all'];
	}

$out .= "}";

$aside_width = isset($options['aside_width']) && $options['aside_width'] != '' ? $options['aside_width'] : "28%";

$flex_content = "mf-content > div
{
	display: -webkit-box;
	display: -ms-flexbox;
	display: -webkit-flex;
	display: flex;
}

	#main
	{
		-webkit-box-flex: 2 1 0;
		-webkit-flex: 2 1 0;
		-ms-flex: 2 1 0;
		flex: 2 1 0;
		order: 2;
		overflow: hidden;
		padding-right: 0;
		max-width: 100%;
	}

		mf-content > div > article
		{
			width: 100%;
		}

	#aside.right, #aside.left
	{
		margin-left: 2%;
		-webkit-box-flex: 0 0 ".$aside_width.";
		-webkit-flex: 0 0 ".$aside_width.";
		-ms-flex: 0 0 ".$aside_width.";
		flex: 0 0 ".$aside_width.";
		order: 3;"
		.render_css(array('property' => 'max-width', 'value' => 'aside_width'))
	."}

		#aside.left
		{
			margin-right: 2%;
			margin-left: 0;
			order: 1;
		}";

if(isset($options['mobile_breakpoint']) && $options['mobile_breakpoint'] > 0)
{
	$out .= "@media (max-width: ".($options['mobile_breakpoint'] - 1)."px)
	{
		body:before
		{
			content: 'mobile';
		}

		.hide_if_mobile
		{
			display: none;
		}";

			if(isset($options['logo_width_mobile']) && $options['logo_width_mobile'] != '')
			{
				$out .= "#site_logo
				{"
					.render_css(array('property' => 'max-width', 'value' => 'logo_width_mobile'))
				."}";
			}

			$out .= "#secondary_nav, header .searchform
			{
				display: none;
			}

			.theme_nav.is_mobile_ready
			{
				margin: 0;
				width: 100%;
			}

				header #primary_nav
				{
					float: none;
					clear: unset;
					text-align: center;
				}

					mf-slide-nav #primary_nav
					{
						text-align: left;
					}

					header #primary_nav > .toggle_icon
					{"
						.render_css(array('property' => 'color', 'value' => 'logo_color'))
						."display: block;";

						if(isset($options['hamburger_font_size']) && $options['hamburger_font_size'] != '')
						{
							$out .= render_css(array('property' => 'font-size', 'value' => 'hamburger_font_size'));
						}

						else
						{
							$out .= render_css(array('property' => 'font-size', 'value' => 'logo_font_size'));
						}

						$out .= "margin: .1em .2em;"
						.render_css(array('property' => 'padding', 'value' => 'hamburger_margin'))
						."position: absolute;
						right: 0;
						top: 0;
						z-index: 1;
					}

						header #primary_nav .fa-close
						{
							display: none;
						}

						header #primary_nav.is_mobile_ready ul > li
						{
							display: none;
						}

							header #primary_nav.open .fa-bars
							{
								display: none;
							}

							header #primary_nav.open .fa-close
							{
								display: block;
							}

							header #primary_nav.open ul > li
							{
								display: block;
							}";

				/*.theme_nav.is_mobile_ready ul
				{
					min-height: 2em;
				}*/

					$out .= ".theme_nav.is_mobile_ready > div > ul > li
					{";

						if(isset($options['hamburger_menu_bg']) && $options['hamburger_menu_bg'] != '')
						{
							$out .= render_css(array('property' => 'background', 'value' => 'hamburger_menu_bg'));
						}

						else
						{
							$out .= render_css(array('property' => 'background', 'value' => 'header_bg'));
						}

						$out .= "display: none;
					}

						.theme_nav.is_mobile_ready > div > ul > li:last-of-type
						{
							border-radius: 0 0 .3em .3em;
						}

						.theme_nav a:hover, .theme_nav li.current_page_item > a
						{
							border-bottom: 0;
						}

							.theme_nav ul .sub-menu
							{
								display: block;
							}

				article section.text_columns
				{
					-webkit-column-count: 1;
					-moz-column-count: 1;
					column-count: 1;
				}

			footer > div
			{
				display: block;
				text-align: center;
			}";

		if(isset($options['custom_css_mobile']) && $options['custom_css_mobile'] != '')
		{
			$out .= $options['custom_css_mobile'];
		}

	$out .= "}

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
		}";

		if(isset($options['body_desktop_font_size']) && $options['body_desktop_font_size'] != '' && $options['body_desktop_font_size'] != $options['body_font_size'])
		{
			$out .= "html
			{"
				.render_css(array('property' => 'font-size', 'value' => 'body_desktop_font_size'))
			."}";
		}

			$out .= ".theme_nav.is_mobile_ready .sub-menu
			{"
				//.render_css(array('property' => 'background', 'value' => 'sub_nav_bg'))
				."border-radius: .3em;
				left: 50%;
				position: absolute;
				padding-top: .5em;
				transform: translateX(-50%);
				z-index: 100;
			}";

				if(isset($options['sub_nav_arrow']) && $options['sub_nav_arrow'] == 2)
				{
					$out .= ".theme_nav.is_mobile_ready .sub-menu
					{
						margin-top: 3.4em:
						padding-top: 0;
					}
				
						.theme_nav.is_mobile_ready .sub-menu:before
						{
							border: .7em solid transparent;"
							.render_css(array('prefix' => 'border-bottom-color: ', 'value' => 'sub_nav_bg'))
							."content: '';
							left: 50%;
							position: absolute;
							top: -.8em;
							transform: translateX(-50%);
						}";
				}

					$out .= ".theme_nav.is_mobile_ready .sub-menu
					{
						white-space: nowrap;
					}

						#primary_nav.theme_nav.is_mobile_ready .sub-menu a
						{"
							.render_css(array('property' => 'background', 'value' => 'sub_nav_bg'))
							.render_css(array('property' => 'color', 'value' => 'sub_nav_color'))
							."padding: .8em;
						}

							.theme_nav.is_mobile_ready .sub-menu li:first-child a
							{
								border-top-left-radius: .3em;
								border-bottom-left-radius: .3em;
							}

							.theme_nav.is_mobile_ready .sub-menu li:last-child a
							{
								border-top-right-radius: .3em;
								border-bottom-right-radius: .3em;
							}

							#primary_nav.theme_nav.is_mobile_ready .sub-menu a:hover
							{"
								.render_css(array('property' => 'background', 'value' => 'sub_nav_bg_hover'))
								.render_css(array('property' => 'color', 'value' => 'sub_nav_color_hover'))
							."}"
		.$flex_content
	."}";

	$flex_content = "";
}

if(isset($options['website_max_width']) && $options['website_max_width'] > 0)
{
	$out .= "@media (min-width: ".$options['website_max_width']."px)
	{
		body:before
		{
			content: 'desktop';
		}

		header > div, mf-after-header > div, #mf-pre-content > div, mf-content > div, mf-pre-footer > div, footer > div, .full_width .widget .section, .full_width .widget > div
		{
			margin: 0 auto;
			max-width: ".$options['website_max_width']."px;
		}"
		.$flex_content
	."}";
}

$out .= "@media print
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

	header, mf-after-header, #mf-pre-content, #aside, mf-pre-footer, footer
	{
		display: none;
	}
}";

echo $out;