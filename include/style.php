<?php

if(!defined('ABSPATH'))
{
	header("Content-Type: text/css; charset=utf-8");

	$folder = str_replace("/wp-content/themes/mf_theme/include", "/", dirname(__FILE__));

	require_once($folder."wp-load.php");
}

if(!isset($obj_theme_core))
{
	$obj_theme_core = new mf_theme_core();
}

$obj_theme_core->get_params();

$out = $obj_theme_core->show_font_face()
."@media all
{
	#mf-after-header, .aside, #mf-pre-footer
	{
		margin: 0;
		padding: 0;
	}

	#mf-after-header, .aside, #mf-pre-footer
	{
		box-sizing: border-box;
	}

	header, nav, #mf-after-header, #mf-pre-content, #mf-content, article, section, .aside, #mf-pre-footer, footer, input:not([type='checkbox']):not([type='radio']), textarea
	{
		display: block;
	}

	p a
	{"
		.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'body_link_color'))
	."}

	#wrapper .mf_form button, #wrapper .button
	{"
		.$obj_theme_core->render_css(array('property' => 'background', 'value' => array('button_color', 'nav_color_hover')))
		."color: #fff;"
	."}

		#wrapper .mf_form button:hover, #wrapper .button:hover
		{"
			.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'button_color_hover'))
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
		.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'body_font_size'))
		.$obj_theme_core->render_css(array('property' => 'overflow-y', 'value' => 'body_scroll'))
	."}

	body
	{"
		.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'footer_bg', 'append' => "min-height: 100vh;"))
		.$obj_theme_core->render_css(array('property' => 'background-color', 'value' => 'footer_bg_color'))
		.$obj_theme_core->render_css(array('property' => 'background-image', 'value' => 'footer_bg_image'))
		.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'body_font'))
		.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'body_color'))
		."overflow: hidden;
		position: relative;
	}

	#wrapper
	{"
		.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'body_bg'))
		.$obj_theme_core->render_css(array('property' => 'background-color', 'value' => 'body_bg_color'))
		.$obj_theme_core->render_css(array('property' => 'background-image', 'value' => 'body_bg_image'))
	."}

		header > div, #mf-after-header > div, #mf-pre-content > div, #mf-content > div, #mf-pre-footer > div, footer > div, .full_width .widget .section, .full_width .widget > div
		{"
			.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'main_padding'))
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
			.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'header_bg'))
			.$obj_theme_core->render_css(array('property' => 'background-color', 'value' => 'header_bg_color'))
			.$obj_theme_core->render_css(array('property' => 'background-image', 'value' => 'header_bg_image'))
			.$obj_theme_core->render_css(array('property' => 'overflow', 'value' => 'header_overflow'))
			."position: relative;
		}

			header > div
			{"
				.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'header_padding'))
			."}";

				//if(isset($obj_theme_core->options['header_fixed']) && $obj_theme_core->options['header_fixed'] == 2)
				if(isset($obj_theme_core->options['header_fixed']) && in_array($obj_theme_core->options['header_fixed'], array(2, 'absolute', 'fixed')))
				{
					$out .= "header.fixed > div
					{"
						.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'body_bg'))
						.$obj_theme_core->render_css(array('property' => 'background-color', 'value' => 'body_bg_color'))
						.$obj_theme_core->render_css(array('property' => 'background-image', 'value' => 'body_bg_image'))
						."left: 0;";

						if($obj_theme_core->options['header_fixed'] == 2)
						{
							$out .= "position: fixed;";
						}

						else
						{
							$out .= $obj_theme_core->render_css(array('property' => 'position', 'value' => 'header_fixed'));
						}

						$out .= "right: 0;
						z-index: 10;
					}";
				}

				$out .= "#site_logo
				{"
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'logo_font'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'logo_font_size'))
					."font-weight: bold;"
					.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'logo_color'))
					.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'logo_padding'))
					."position: relative;
					text-decoration: none;"
					//."transition: all .4s ease;"
				."}

					header #site_logo
					{"
						.$obj_theme_core->render_css(array('property' => 'float', 'value' => 'logo_float'))
						.$obj_theme_core->render_css(array('property' => 'max-width', 'value' => 'logo_width'))
					."}

					#site_logo span
					{
						display: block;
						font-size: .4em;
					}

				.searchform
				{"
					.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'search_color'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'search_size'))
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
							.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'search_color'))
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
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'nav_font'))
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
									.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'nav_link_padding'))
								."}

									header .theme_nav li:hover > .sub-menu, header .theme_nav li.current-menu-item > .sub-menu, header .theme_nav li.current-menu-ancestor > .sub-menu
									{
										display: block;
										opacity: .5;
									}

										header .theme_nav.is_mobile_ready li:hover > .sub-menu
										{
											opacity: 1;
											z-index: 101;
										}

									.theme_nav .sub-menu
									{
										display: none;
									}

					header #primary_nav
					{"
						.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'nav_bg'))
						.$obj_theme_core->render_css(array('property' => 'clear', 'value' => 'nav_clear'))
						.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'nav_size'))
						.$obj_theme_core->render_css(array('property' => 'text-align', 'value' => 'nav_align'))
					."}

						#primary_nav > .toggle_icon
						{
							display: none;
						}

							#primary_nav a
							{"
								.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'nav_color'))
							."}

								#primary_nav a:hover, #primary_nav li.current_page_ancestor.current_page_ancestor > a, #primary_nav li.current_page_item.current_page_item > a
								{"
									.$obj_theme_core->render_css(array('prefix' => "border-bottom: 5px solid ", 'value' => 'nav_underline_color_hover'))
									.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'nav_color_hover'))
								."}

									#primary_nav li.current_page_ancestor.current_page_ancestor > a, #primary_nav li.current_page_item.current_page_item > a
									{"
										.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'nav_bg_current'))
										.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'nav_color_current'))
									."}

						#slide_nav > .fa
						{
							display: inline-block;
							margin-left: .5em;
						}

					#secondary_nav
					{"
						.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'nav_secondary_bg'))
						.$obj_theme_core->render_css(array('property' => 'clear', 'value' => 'nav_secondary_clear'))
						.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'nav_secondary_size'))
						.$obj_theme_core->render_css(array('property' => 'text-align', 'value' => 'nav_secondary_align'))
					."}

						#secondary_nav a
						{"
							.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'nav_secondary_color'))
							.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'nav_secondary_link_padding'))
						."}

							#secondary_nav a:hover, #secondary_nav li.current_page_ancestor.current_page_ancestor > a, #secondary_nav li.current_page_item.current_page_item > a
							{"
								.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'nav_secondary_color_hover'))
							."}

								#secondary_nav li.current_page_ancestor.current_page_ancestor > a, #secondary_nav li.current_page_item.current_page_item > a
								{"
									.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'nav_secondary_bg_current'))
									.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'nav_secondary_color_current'))
								."}";

		if(is_active_widget_area('widget_after_header'))
		{
			$out .= "#mf-after-header
			{"
				.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'after_header_bg'))
				.$obj_theme_core->render_css(array('property' => 'background-color', 'value' => 'after_header_bg_color'))
				.$obj_theme_core->render_css(array('property' => 'background-image', 'value' => 'after_header_bg_image'))
			."}
			
				#mf-after-header .widget + .widget
				{
					margin-top: 1em;
				}";
		}

		if(is_active_widget_area('widget_slide'))
		{
			$out .= "#mf-slide-nav
			{
				background: rgba(0, 0, 0, .7);
				bottom: 0;
				display: none;
				left: 0;
				position: absolute;
				position: fixed;
				right: 0;
				top: 0;
				z-index: 1002;
			}

				#mf-slide-nav > div
				{"
					.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'slide_nav_bg'))
					."bottom: 0;"
					.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'slide_nav_color'))
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'nav_font'))
					."overflow: hidden;
					padding: 3.5em 0 1em;
					position: absolute;
					right: -90%;
					top: 0;
					width: 90%;
					max-width: 300px;
				}

					#mf-slide-nav #primary_nav
					{"
						.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'nav_size'))
					."}

						#mf-slide-nav .fa-close
						{
							font-size: 2em;
							margin: 3% 4% 0 0;
							position: absolute;
							right: 0;
							top: 0;
						}

						#mf-slide-nav ul
						{
							list-style: none;
						}

							#mf-slide-nav #primary_nav ul a
							{"
								.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'slide_nav_color'))
								."display: block;
								letter-spacing: .2em;
								overflow: hidden;"
								.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'slide_nav_link_padding'))
								."text-overflow: ellipsis;
								transition: all .4s ease;
								white-space: nowrap;
							}

								#mf-slide-nav #primary_nav ul a:hover
								{"
									.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'slide_nav_bg_hover'))
									.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'slide_nav_color_hover'))
									."text-indent: .3em;
								}

								#mf-slide-nav #primary_nav li.current_page_item > a
								{"
									.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'slide_nav_bg_hover'))
									.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'slide_nav_color_current'))
								."}

							#mf-slide-nav #primary_nav li ul
							{
								margin-bottom: 0;
							}

								/* Hide children until hover or current page */
								#mf-slide-nav #primary_nav.is_large .sub-menu
								{
									display: none;
								}

									#mf-slide-nav #primary_nav.is_large li:hover > .sub-menu, #mf-slide-nav #primary_nav.is_large li.current-menu-item > .sub-menu, #mf-slide-nav #primary_nav.is_large li.current-menu-ancestor > .sub-menu
									{
										display: block;
									}
								/* */

								#mf-slide-nav #primary_nav li ul a
								{
									text-indent: 1.4em;
								}

									#mf-slide-nav #primary_nav li ul a:hover
									{
										text-indent: 2em;
									}

					#mf-slide-nav ul, #mf-slide-nav p
					{
						margin-bottom: 1em;
					}";
		}

		if(is_active_widget_area('widget_front'))
		{
			$out .= "#mf-pre-content
			{"
				.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'front_bg'))
				.$obj_theme_core->render_css(array('property' => 'background-color', 'value' => 'pre_content_bg_color'))
				.$obj_theme_core->render_css(array('property' => 'background-image', 'value' => 'pre_content_bg_image'))
				."clear: both;"
				.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'front_color'))
				."overflow: hidden;
			}

				#mf-pre-content > div
				{"
					.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'front_padding'))
				."}

					#mf-pre-content h3
					{"
						.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font'))
						.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_size'))
						.$obj_theme_core->render_css(array('property' => 'font-weight', 'value' => 'heading_weight'))
						.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'heading_margin'))
						.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'heading_padding'))
					."}

					#mf-pre-content p
					{"
						.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'section_size'))
						.$obj_theme_core->render_css(array('property' => 'line-height', 'value' => 'section_line_height'))
						.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'section_margin'))
					."}";
		}

		$out .= "#mf-content
		{
			clear: both;
		}

			#mf-content > div
			{"
				.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'content_bg'))
				."overflow: hidden;"
				.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'content_padding'))
			."}

				#wrapper h1 /*article h1*/
				{"
					.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'heading_bg'))
					.$obj_theme_core->render_css(array('property' => 'border-bottom', 'value' => 'heading_border_bottom'))
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_size'))
					.$obj_theme_core->render_css(array('property' => 'font-weight', 'value' => 'heading_weight'))
					.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'heading_margin'))
					.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'heading_padding'))
				."}

					#wrapper h1 a /*article h1 a*/
					{
						color: inherit;
					}

				article h2
				{"
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_font_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-weight', 'value' => 'heading_weight_h2'))
					.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'heading_margin_h2'))
				."}

				article h3
				{"
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_font_size_h3'))
					.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'heading_margin_h3'))
					.$obj_theme_core->render_css(array('property' => 'font-weight', 'value' => 'heading_weight_h3'))
				."}

				article h4
				{"
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_font_size_h4'))
					.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'heading_margin_h4'))
					.$obj_theme_core->render_css(array('property' => 'font-weight', 'value' => 'heading_weight_h4'))
				."}

				article h5
				{"
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_font_size_h5'))
					.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'heading_margin_h5'))
					.$obj_theme_core->render_css(array('property' => 'font-weight', 'value' => 'heading_weight_h5'))
				."}

				article .meta
				{"
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'section_size'))
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
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_size_h2'))
				."}

				h3
				{"
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font_h3'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_size_h3'))
				."}

				article section
				{"
					.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'section_bg'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'section_size'))
					.$obj_theme_core->render_css(array('property' => 'line-height', 'value' => 'section_line_height'))
					.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'section_margin'))
					."overflow: hidden;"
					.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'section_padding'))
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
							}

					article p, article ul, article ol, article form
					{"
						.$obj_theme_core->render_css(array('property' => 'margin-bottom', 'value' => 'section_margin_between'))
					."}

						article p:last-child, article ul:last-child, article ol:last-child, article form:last-child
						{
							margin-bottom: 0;
						}

						article ul, article ol, article form
						{
							clear: both;
						}

						article ul, article ol
						{
							list-style-position: inside;
						}";

							if($obj_theme_core->options['article_url_color'] != '')
							{
								$out .= "article p a, article ul a, article ol a
								{
									border-bottom: 2px solid transparent;"
									.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'article_url_color'))
									."text-decoration: none;"
								."}

									article p a:hover, article ul a:hover, article ol a:hover
									{"
										.$obj_theme_core->render_css(array('property' => 'border-bottom-color', 'value' => 'article_url_color'))
									."}";
							}

							$out .= "article li + li
							{
								margin-top: 1em;
							}";

				if(is_active_widget_area('widget_sidebar_left') || is_active_widget_area('widget_after_content') || is_active_widget_area('widget_sidebar'))
				{
					$out .= ".aside
					{"
						.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'heading_margin'))
					."}

						.aside .widget
						{"
							.$obj_theme_core->render_css(array('property' => 'border', 'value' => 'aside_widget_border'))
						."}

							.aside .widget + .widget
							{
								margin-top: 1em;
							}

							.aside h3
							{"
								.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'aside_heading_bg'))
								.$obj_theme_core->render_css(array('property' => 'border-bottom', 'value' => 'aside_heading_border_bottom'))
								.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'aside_heading_size'))
								.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'aside_heading_padding'))
							."}

							.aside .widget .section, .aside .widget > div, .aside .widget > form, .aside .widget > ol, .aside .widget > ul, .aside .widget > p
							{"
								.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'aside_widget_background'))
								.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'aside_size'))
								.$obj_theme_core->render_css(array('property' => 'line-height', 'value' => 'aside_line_height'))
								."margin-bottom: .5em;"
								.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'aside_padding'))
							."}

							.aside ul, .aside ol
							{
								list-style-position: inside;
							}

								.aside p a, .aside ul a, .aside ol a
								{
									border-bottom: 2px solid transparent;"
									.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'article_url_color'))
									."text-decoration: none;
								}";

					if(is_active_widget_area('widget_after_content'))
					{
						$out .= ".aside.after_content .widget
						{"
							.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'after_content_widget_font_size'))
						."}";
					}
				}

		if(is_active_widget_area('widget_pre_footer'))
		{
			$out .= "#mf-pre-footer
			{"
				.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'pre_footer_bg'))
				.$obj_theme_core->render_css(array('property' => 'background-color', 'value' => 'pre_footer_bg_color'))
				.$obj_theme_core->render_css(array('property' => 'background-image', 'value' => 'pre_footer_bg_image'))
				."overflow: hidden;
			}

				#mf-pre-footer > div
				{"
					.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'pre_footer_padding'))
				."}

					#mf-pre-footer > div .widget
					{"
						.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'pre_footer_widget_font_size'))
						.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'pre_footer_widget_padding'))
					."}";
		}

		if(is_active_widget_area('widget_footer'))
		{
			$out .= "footer
			{"
				.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'footer_bg'))
				.$obj_theme_core->render_css(array('property' => 'background-color', 'value' => 'footer_bg_color'))
				.$obj_theme_core->render_css(array('property' => 'background-image', 'value' => 'footer_bg_image'))
				."overflow: hidden;
				position: relative;
				z-index: 1000;
			}

				footer > div
				{"
					.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'footer_color'))
					.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'footer_padding'));

					if(isset($obj_theme_core->options['footer_widget_flex']) && $obj_theme_core->options['footer_widget_flex'] == 2)
					{
						$out .= "display: -webkit-box;
						display: -ms-flexbox;
						display: -webkit-flex;
						display: flex;";
					}

				$out .= "}

					footer .widget
					{"
						.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'footer_font'))
						.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'footer_font_size'))
						.$obj_theme_core->render_css(array('property' => 'overflow', 'value' => 'footer_widget_overflow'))
						.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'footer_widget_padding'));

						if(isset($obj_theme_core->options['footer_widget_flex']) && $obj_theme_core->options['footer_widget_flex'] == 2)
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
							.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'footer_widget_heading_margin'))
							.$obj_theme_core->render_css(array('property' => 'text-transform', 'value' => 'footer_widget_heading_text_transform'))
						."}

							footer ul
							{
								list-style: none;
							}";

							if(isset($obj_theme_core->options['footer_p_margin']) && $obj_theme_core->options['footer_p_margin'] != '')
							{
								$out .= "footer .widget p, footer .widget li
								{"
									.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'footer_p_margin'))
								."}

									footer .widget li ul
									{
										margin: .5em 0 0 .5em;
									}";
							}

							$out .= "footer .widget a
							{";

								if(isset($obj_theme_core->options['footer_a_bg']) && $obj_theme_core->options['footer_a_bg'] != '')
								{
									$out .= "border-radius: .5em;"
									.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'footer_a_bg'))
									."display: block;"
									.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'footer_a_margin'))
									.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'footer_a_padding'));
								}

								$out .= $obj_theme_core->render_css(array('property' => 'color', 'value' => 'footer_color'))
							."}

								footer .widget a:hover, footer li.current_page_item a
								{"
									.$obj_theme_core->render_css(array('property' => 'color', 'value' => array('footer_color_hover', 'nav_color_hover')))
								."}";
		}

		if(is_active_widget_area('widget_window_side'))
		{
			$out .= "#window_side
			{
				position: absolute;
				position: fixed;
				right: 0;
				top: 10vh;
				-webkit-transform: translateX(50%);
				transform: translateX(50%);
				transition: all 1s ease;
				z-index: 1001;
			}

				#window_side:hover
				{
					-webkit-transform: translateX(20%);
					transform: translateX(20%);
				}

					#window_side a
					{
						display: block;
						font-size: 1.1em;
						margin: 0 0 .5em 0;
					}

						#window_side img, #window_side .fa
						{
							border-radius: 50%;
							border: .1em solid #666;
							transition: all 1s ease;
						}

							#window_side img:hover, #window_side .fa:hover
							{
								-webkit-transform: translateX(-30%);
								transform: translateX(-30%);
							}";
		}

	if(isset($obj_theme_core->options['custom_css_all']) && $obj_theme_core->options['custom_css_all'] != '')
	{
		$out .= $obj_theme_core->options['custom_css_all'];
	}

	/*if(is_plugin_active('css-hero-ce/css-hero-main.php'))
	{
		$arr_selectors = get_option('wpcss_current_settings_array_'.get_theme_slug());

		do_log(var_export($arr_selectors, true));

		foreach($arr_selectors as $selector => $arr_properties)
		{
			$out .= $selector."{";

				foreach($arr_properties as $key => $value)
				{
					$out .= $key.":".$value.";";
				}

			$out .= "}";
		}
	}*/

$out .= "}";

$aside_width = isset($obj_theme_core->options['aside_width']) && $obj_theme_core->options['aside_width'] != '' ? $obj_theme_core->options['aside_width'] : "28%";

$flex_content = "#mf-content > div
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

		#mf-content > div > article
		{
			width: 100%;
		}";

	if(is_active_widget_area('widget_after_content') || is_active_widget_area('widget_sidebar_left') || is_active_widget_area('widget_sidebar'))
	{
		$flex_content .= ".aside.right, .aside.left
		{
			margin-left: 2%;
			-webkit-box-flex: 0 0 ".$aside_width.";
			-webkit-flex: 0 0 ".$aside_width.";
			-ms-flex: 0 0 ".$aside_width.";
			flex: 0 0 ".$aside_width.";
			order: 3;"
			.$obj_theme_core->render_css(array('property' => 'max-width', 'value' => 'aside_width'))
		."}

			.aside.left
			{
				margin-right: 2%;
				margin-left: 0;
				order: 1;
			}";
	}

if(isset($obj_theme_core->options['mobile_breakpoint']) && $obj_theme_core->options['mobile_breakpoint'] > 0)
{
	$out .= "@media (max-width: ".($obj_theme_core->options['mobile_breakpoint'] - 1)."px)
	{
		body:before
		{
			content: 'is_mobile';
		}

		.hide_if_mobile
		{
			display: none;
		}

			#site_logo
			{"
				.$obj_theme_core->render_css(array('property' => 'max-width', 'value' => 'logo_width_mobile'))
			."}

			#secondary_nav, header .searchform
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
				}";

					if(is_active_widget_area('widget_slide'))
					{
						$out .= "#mf-slide-nav #primary_nav
						{
							text-align: left;
						}";
					}

					$out .= "header #primary_nav > .toggle_icon
					{"
						.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'logo_color'))
						."display: block;"
						.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => array('hamburger_font_size', 'logo_font_size')))
						."margin: .1em .2em;"
						.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'hamburger_margin'))
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
							}

					.theme_nav.is_mobile_ready > div > ul > li
					{"
						.$obj_theme_core->render_css(array('property' => 'background', 'value' => array('hamburger_menu_bg', 'header_bg', 'header_bg_color', 'header_bg_image')))
						."display: none;
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
				}";

			if(is_active_widget_area('widget_footer'))
			{
				$out .= "footer > div
				{
					display: block;
					text-align: center;
				}";
			}

		if(isset($obj_theme_core->options['custom_css_mobile']) && $obj_theme_core->options['custom_css_mobile'] != '')
		{
			$out .= $obj_theme_core->options['custom_css_mobile'];
		}

	$out .= "}

	@media (min-width: ".$obj_theme_core->options['mobile_breakpoint']."px)
	{
		body:before
		{
			content: 'is_tablet';
			display: none;
		}

		.show_if_mobile
		{
			display: none;
		}

		html
		{"
			.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'body_desktop_font_size'))
		."}

			.theme_nav.is_mobile_ready .sub-menu
			{
				border-radius: .3em;
				left: 50%;
				position: absolute;
				padding-top: .5em;
				-webkit-transform: translateY(-50%);
				transform: translateX(-50%);
				z-index: 100;
			}";

				if(isset($obj_theme_core->options['sub_nav_arrow']) && $obj_theme_core->options['sub_nav_arrow'] == 2)
				{
					$out .= ".theme_nav.is_mobile_ready .sub-menu
					{
						margin-top: 3.4em:
						padding-top: 0;
					}

						.theme_nav.is_mobile_ready .sub-menu:before
						{
							border: .7em solid transparent;"
							.$obj_theme_core->render_css(array('prefix' => 'border-bottom-color: ', 'value' => 'sub_nav_bg'))
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
							.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'sub_nav_bg'))
							.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'sub_nav_color'))
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
								.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'sub_nav_bg_hover'))
								.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'sub_nav_color_hover'))
							."}"
		.$flex_content
	."}";

	$flex_content = "";
}

if(isset($obj_theme_core->options['website_max_width']) && $obj_theme_core->options['website_max_width'] > 0)
{
	$out .= "@media (min-width: ".$obj_theme_core->options['website_max_width']."px)
	{
		body:before
		{
			content: 'is_desktop';
		}

		header > div, #mf-after-header > div, #mf-pre-content > div, #mf-content > div, #mf-pre-footer > div, footer > div, .full_width .widget .section, .full_width .widget > div
		{
			margin: 0 auto;
			max-width: ".$obj_theme_core->options['website_max_width']."px;
		}"
		.$flex_content
	."}";
}

$out .= "@media print
{
	body:before
	{
		content: 'is_print';
	}

	body
	{
		background: none;
	}

	#mf-content > div
	{
		width: auto;
	}

	header, #mf-after-header, #mf-pre-content, .aside, #mf-pre-footer, footer
	{
		display: none;
	}
}";

echo $out;