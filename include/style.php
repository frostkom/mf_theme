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
	#mf-pre-header, header, nav, #mf-after-header, #mf-pre-content, #mf-content, article, section, .aside, #mf-pre-footer, footer
	{
		display: block;
	}

	input:not([type='checkbox']):not([type='radio']), textarea
	{
		display: inline-block;
	}"

	.$obj_theme_core->get_common_style()

	."body
	{
		position: relative;
	}";

		if(is_active_widget_area('widget_pre_header'))
		{
			$out .= "#mf-pre-header
			{"
				.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'pre_header_bg'))
				.$obj_theme_core->render_css(array('property' => 'background-color', 'value' => 'pre_header_bg_color'))
				//.$obj_theme_core->render_css(array('property' => 'background-image', 'prefix' => 'url(', 'value' => 'pre_header_bg_image', 'suffix' => '); background-size: cover'))
				."clear: both;"
				.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'pre_header_color'))
				.$obj_theme_core->render_css(array('property' => 'overflow', 'value' => 'pre_header_overflow'))
			."}

				#mf-pre-header > div
				{"
					.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'pre_header_padding'))
				."}

					#mf-pre-header > div .widget
					{"
						.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'pre_header_widget_font_size'))
						//.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'pre_header_widget_padding'))
					."}";
		}

		$out .= "#site_logo
		{"
			.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'logo_font'))
			.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'logo_font_size'))
			."font-weight: bold;"
			.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'logo_color'))
			.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'logo_padding'))
			."position: relative;
			text-decoration: none;
			transition: all .4s ease;
		}

			#site_logo img
			{
				display: block;
			}

			#site_logo span
			{
				display: block;"
				.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'slogan_font_size'))
				."margin-bottom: 1em;
			}

			header #site_logo
			{"
				.$obj_theme_core->render_css(array('property' => 'float', 'value' => 'logo_float'))
				.$obj_theme_core->render_css(array('property' => 'max-width', 'value' => 'logo_width'))
			."}

		.theme_nav.is_mobile_ready
		{"
			.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'nav_font'))
		."}

			.theme_nav ul
			{
				list-style: none;";

				if(isset($obj_theme_core->options['hamburger_collapse_if_no_space']) && $obj_theme_core->options['hamburger_collapse_if_no_space'] == 2)
				{
					$out .= "overflow: hidden;
					white-space: nowrap;";
				}

			$out .= "}

				.theme_nav.is_mobile_ready li
				{
					display: inline-block;
					position: relative;
				}

					.theme_nav.is_mobile_ready li:not(:first-child)
					{
						margin-left: -.3em;
					}

						.theme_nav a
						{
							display: block;"
							.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'nav_link_padding'))
						."}";

							if(isset($obj_theme_core->options['sub_nav_direction']) && $obj_theme_core->options['sub_nav_direction'] == 'vertical')
							{
								$out .= "header .theme_nav li:hover > .sub-menu
								{
									display: block;
									opacity: .5;
								}";
							}

							else
							{
								$out .= "header .theme_nav li:hover > .sub-menu, header .theme_nav li.current-menu-item > .sub-menu, header .theme_nav li.current-menu-ancestor > .sub-menu
								{
									display: block;
									opacity: .5;
								}";
							}

								$out .= "header .theme_nav.is_mobile_ready li:hover > .sub-menu
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
				.$obj_theme_core->render_css(array('property' => 'background-color', 'value' => 'nav_bg_color'))
				.$obj_theme_core->render_css(array('property' => 'background-image', 'prefix' => 'url(', 'value' => 'nav_bg_image', 'suffix' => '); background-size: cover'))
				.$obj_theme_core->render_css(array('property' => 'clear', 'value' => 'nav_clear'))
				.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'nav_size'))
				.$obj_theme_core->render_css(array('property' => 'text-align', 'value' => 'nav_align'))
			."}

				#primary_nav > .toggle_icon
				{
					display: none;
				}

				header #primary_nav > div
				{"
					.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'nav_padding'))
				."}

					#primary_nav a
					{"
						.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'nav_color'))
					."}

						#primary_nav a:hover, #primary_nav li.current_page_ancestor.current_page_ancestor > a, #primary_nav li.current_page_item.current_page_item > a
						{"
							.$obj_theme_core->render_css(array('property' => 'border-bottom', 'prefix' => "5px solid ", 'value' => 'nav_underline_color_hover'))
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
						."}

				.is_mobile .theme_nav.is_mobile_ready, .theme_nav.is_mobile_ready.is_hamburger
				{
					margin: 0;
					width: 100%;
				}

					.is_mobile header #primary_nav, header #primary_nav.is_hamburger
					{
						clear: unset;
						float: none;
						overflow: hidden;
						text-align: center;
					}";

						if(is_active_widget_area('widget_slide'))
						{
							$out .= "#mf-slide-nav > div
							{
								right: -90%;
							}

							.is_mobile #mf-slide-nav .theme_nav
							{
								text-align: left;
							}";
						}

						$out .= ".is_mobile header #primary_nav > .toggle_icon, header #primary_nav.is_hamburger > .toggle_icon
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

							.is_mobile header #primary_nav.is_mobile_ready ul > li, header #primary_nav.is_mobile_ready.is_hamburger ul > li
							{
								display: none;
							}

								.is_mobile header #primary_nav.open ul > li, header #primary_nav.is_hamburger.open ul > li
								{
									display: block;
								}

							.is_mobile header #primary_nav .fa-times, header #primary_nav.is_hamburger .fa-times
							{
								display: none;
							}

								.is_mobile header #primary_nav.open .fa-bars, header #primary_nav.is_hamburger.open .fa-bars
								{
									display: none;
								}

								.is_mobile header #primary_nav.open .fa-times, header #primary_nav.is_hamburger.open .fa-times
								{
									display: block;
								}

						.is_mobile .theme_nav.is_mobile_ready > div > ul > li, .theme_nav.is_mobile_ready.is_hamburger > div > ul > li
						{"
							.$obj_theme_core->render_css(array('property' => 'background', 'value' => array('hamburger_menu_bg', 'header_bg', 'header_bg_color', 'header_bg_image')))
							."display: none;
						}

							.is_mobile .theme_nav.is_mobile_ready > div > ul > li:last-of-type, .theme_nav.is_mobile_ready.is_hamburger > div > ul > li:last-of-type
							{
								border-radius: 0 0 .3em .3em;
							}

							.is_mobile .theme_nav a:hover, .is_mobile .theme_nav li.current_page_item > a, .theme_nav.is_hamburger a:hover, .theme_nav.is_hamburger li.current_page_item > a
							{
								border-bottom: 0;
							}

								.is_mobile .theme_nav ul .sub-menu, .theme_nav.is_hamburger ul .sub-menu
								{
									display: block;
								}";

		$post_id = apply_filters('get_widget_search', 'theme-menu-widget');

		if($post_id > 0)
		{
			// Wrap with flex box but does align every main menu item like flex do
			/*$out .= ".theme_nav.has_menu_columns .menu
			{
				display: -webkit-box;
				display: -ms-flexbox;
				display: -webkit-flex;
				display: flex;
				-webkit-box-flex-wrap: wrap;
				-webkit-flex-wrap: wrap;
				-ms-flex-wrap: wrap;
				flex-wrap: wrap;
			}

				.theme_nav.has_menu_columns .menu > li
				{
					-webkit-box-flex: 1 1 auto;
					-webkit-flex: 1 1 auto;
					-ms-flex: 1 1 auto;
					flex: 1 1 auto;
				}

				.is_desktop .has_menu_columns.menu_columns_desktop_2 .menu > li, .is_tablet .has_menu_columns.menu_columns_tablet_2 .menu > li, .is_mobile .has_menu_columns.menu_columns_mobile_2 .menu > li
				{
					width: 50%;
				}
				
				.is_desktop .has_menu_columns.menu_columns_desktop_3 .menu > li, .is_tablet .has_menu_columns.menu_columns_tablet_3 .menu > li, .is_mobile .has_menu_columns.menu_columns_mobile_3 .menu > li
				{
					width: 33%;
				}";*/

			/* Wrap with column count but can sometimes split submenu items within a main menu item */
			$out .= ".is_desktop .has_menu_columns.menu_columns_desktop_2 .menu, .is_tablet .has_menu_columns.menu_columns_tablet_2 .menu, .is_mobile .has_menu_columns.menu_columns_mobile_2 .menu
			{
				-webkit-column-count: 2;
				column-count: 2;
			}
			
			.is_desktop .has_menu_columns.menu_columns_desktop_3 .menu, .is_tablet .has_menu_columns.menu_columns_tablet_3 .menu, .is_mobile .has_menu_columns.menu_columns_mobile_3 .menu
			{
				-webkit-column-count: 3;
				column-count: 3;
			}";

			/* Wrap with column direction and if set, a height on the menu to adjust manually for column to contain wanted menu items */
			$out .= ".theme_nav.has_menu_height .menu
			{
				display: -webkit-box;
				display: -ms-flexbox;
				display: -webkit-flex;
				display: flex;
				-webkit-box-flex-direction: column;
				-webkit-flex-direction: column;
				-ms-direction-wrap: column;
				flex-direction: column;
				-webkit-box-flex-wrap: wrap;
				-webkit-flex-wrap: wrap;
				-ms-flex-wrap: wrap;
				flex-wrap: wrap;
			}

				.theme_nav.has_menu_height .menu > li
				{
					-webkit-box-flex: 0 0 auto;
					-webkit-flex: 0 0 auto;
					-ms-flex: 0 0 auto;
					flex: 0 0 auto;
				}
				
					.is_desktop .has_menu_height.menu_columns_desktop_2 .menu > li, .is_tablet .has_menu_height.menu_columns_tablet_2 .menu > li, .is_mobile .has_menu_height.menu_columns_mobile_2 .menu > li
					{
						width: 50%;
					}
					
					.is_desktop .has_menu_height.menu_columns_desktop_3 .menu > li, .is_tablet .has_menu_height.menu_columns_tablet_3 .menu > li, .is_mobile .has_menu_height.menu_columns_mobile_3 .menu > li
					{
						width: 33%;
					}";
		}

		if(is_active_widget_area('widget_after_header'))
		{
			$out .= "#mf-after-header
			{"
				.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'after_header_bg'))
				.$obj_theme_core->render_css(array('property' => 'background-color', 'value' => 'after_header_bg_color'))
				.$obj_theme_core->render_css(array('property' => 'background-image', 'prefix' => 'url(', 'value' => 'after_header_bg_image', 'suffix' => '); background-size: cover'))
				."clear: both;"
				.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'after_header_color'))
				.$obj_theme_core->render_css(array('property' => 'overflow', 'value' => 'after_header_overflow'))
			."}

				#mf-after-header > div
				{"
					.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'after_header_padding'))
				."}

					#mf-after-header > div .widget
					{"
						.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'after_header_widget_font_size'))
						.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'after_header_widget_padding'))
					."}";
		}

		if(is_active_widget_area('widget_front'))
		{
			$out .= "#mf-pre-content
			{"
				.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'front_bg'))
				.$obj_theme_core->render_css(array('property' => 'background-color', 'value' => 'pre_content_bg_color'))
				.$obj_theme_core->render_css(array('property' => 'background-image', 'prefix' => 'url(', 'value' => 'pre_content_bg_image', 'suffix' => '); background-size: cover'))
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
					."}

						#mf-pre-content p:not(:last-child)
						{"
							.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'section_margin'))
						."}";
		}

		$out .= "#mf-content
		{"
			.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'content_bg'))
			.$obj_theme_core->render_css(array('property' => 'background-color', 'value' => 'content_bg_color'))
			.$obj_theme_core->render_css(array('property' => 'background-image', 'prefix' => 'url(', 'value' => 'content_bg_image', 'suffix' => '); background-size: cover'))
			."clear: both;
		}

			#mf-content > div
			{
				overflow: hidden;"
				.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'content_padding'))
			."}

				#wrapper h1
				{"
					.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'heading_bg'))
					.$obj_theme_core->render_css(array('property' => 'border-bottom', 'value' => 'heading_border_bottom'))
					.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'heading_color'))
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_size'))
					.$obj_theme_core->render_css(array('property' => 'font-weight', 'value' => 'heading_weight'))
					."line-height: 1.1;"
					.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'heading_margin'))
					.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'heading_padding'))
				."}

					#wrapper h1 a
					{
						color: inherit;
					}

				#wrapper h2
				{"
					.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'heading_color_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_size_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-weight', 'value' => 'heading_weight_h2'))
					."line-height: 1.1;"
					.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'heading_margin_h2'))
				."}

					/* Just to make sure that there is some margin if there is no heading for the page and posts are displayed as a front page */
					#wrapper article > h2:first-child
					{
						margin-top: 1em;
					}

				#mf-after-header h3, #wrapper article h3, #mf-pre-footer h3
				{"
					.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'heading_color_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_size_h3'))
					."line-height: 1.1;"
					.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'heading_margin_h3'))
					.$obj_theme_core->render_css(array('property' => 'font-weight', 'value' => 'heading_weight_h3'))
				."}

				#wrapper h4
				{"
					.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'heading_color_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_font_size_h4'))
					."line-height: 1.1;"
					.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'heading_margin_h4'))
					.$obj_theme_core->render_css(array('property' => 'font-weight', 'value' => 'heading_weight_h4'))
				."}

				#wrapper h5
				{"
					.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'heading_color_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_font_size_h5'))
					."line-height: 1.1;"
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

				h2
				{"
					.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'heading_color_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font_h2'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_size_h2'))
					."line-height: 1.1;"
				."}

				h3
				{"
					.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'heading_color_h3'))
					.$obj_theme_core->render_css(array('property' => 'font-family', 'value' => 'heading_font_h3'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'heading_size_h3'))
					."line-height: 1.1;"
				."}

				article > .image
				{
					margin-bottom: .5em;
				}

				article section
				{"
					.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'section_bg'))
					.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'section_size'))
					.$obj_theme_core->render_css(array('property' => 'line-height', 'value' => 'section_line_height'))
					.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'section_margin'))
					."overflow: hidden;"
					.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'section_padding'))
				."}

					article .aside.after_heading + section
					{
						margin-top: 1em;
					}

					article:not(.hide) + article
					{
						border-top: 1px solid #ccc;
						margin-top: 2.5em;
						padding-top: 1em;
					}

						article section.text_columns
						{
							-webkit-column-gap: 2em;
							column-gap: 2em;
						}

							article section.columns_2
							{
								-webkit-column-count: 2;
								column-count: 2;
							}

							article section.columns_3
							{
								-webkit-column-count: 3;
								column-count: 3;
							}

					article p:not(:last-child), article ul:not(:last-child), article ol:not(:last-child), article form:not(:last-child), article section > figure.wp-block-image
					{"
						.$obj_theme_core->render_css(array('property' => 'margin-bottom', 'value' => 'section_margin_between'))
					."}";

					if(isset($obj_theme_core->options['paragraph_drop_cap_size']) && $obj_theme_core->options['paragraph_drop_cap_size'] != '')
					{
						$out .= "article h1 + section p:first-child:first-letter
						{"
							."float: left;"
							.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'paragraph_drop_cap_size'))
							."line-height: 0;"
							."margin: .2em .2em 0 0;"
						."}";
					}

					if(isset($obj_theme_core->options['paragraph_indentation']) && $obj_theme_core->options['paragraph_indentation'] != '')
					{
						$out .= "article section p + p
						{"
							.$obj_theme_core->render_css(array('property' => 'text-indent', 'value' => 'paragraph_indentation'))
						."}";
					}

						$out .= "article section > figure.wp-block-image
						{
							margin: 0; /* Margin is otherwise automatically added in the browser */
						}

						article ul, article ol, article form
						{
							clear: both;
						}

						article ul, article ol
						{
							list-style-position: inside;
						}";

							if(isset($obj_theme_core->options['article_url_color']) && $obj_theme_core->options['article_url_color'] != '')
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
							}

				#main #load_more
				{
					font-size: 1.5em;
				}

				#main .pagination
				{
					list-style: none;
				}

					#main .pagination li
					{
						display: inline-block;
						font-size: 1.5em;
					}

						#main .pagination li a
						{
							display: inline-block;
							padding: .5em .5em 1em;
						}

							#main .pagination li a.current_page
							{
								opacity: .7;
							}

							#main .pagination li a.current_page:before
							{
								content: '[';
							}

							#main .pagination li a.current_page:after
							{
								content: ']';
							}";

						/* Comments */
						if(get_option('default_comment_status') == 'open')
						{
							$out .= "#comments .comment-list, #comments .comment-respond
							{"
								.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'section_size'))
							."}

							#comments ol
							{
								list-style: none;
							}

								#comments ol .children
								{
									margin-left: 2em;
								}

								#comments .comment-body
								{
									margin-bottom: 2em;
									margin-left: 65px;
								}

								#comments .comment-author
								{
									margin-bottom: 0.4em;
									position: relative;
								}

									#comments .comment-author .avatar
									{
										height: 50px;
										left: -65px;
										position: absolute;
										width: 50px;
									}

									#comments .comment-author .says
									{
										display: none;
									}

								.comment-meta
								{
									margin-bottom: .5em;
								}

									.comment-metadata
									{
										font-weight: 800;
										text-transform: uppercase;
									}

										.comment-metadata a.comment-edit-link
										{
											margin-left: 1em;
										}

								#comments .comment-reply-link
								{
									font-weight: 800;
									position: relative;
								}

								#comments .children .comment-author .avatar
								{
									height: 30px;
									left: -45px;
									width: 30px;
								}

								#comments .bypostauthor > .comment-body > .comment-meta > .comment-author .avatar
								{
									border: 1px solid #333;
									padding: 2px;
								}

							#comments .comments-pagination
							{
								margin: 2em 0 3em;
							}

							#comments .no-comments, #comments .comment-awaiting-moderation
							{
								color: #767676;
								font-style: italic;
							}";
						}

				if(is_active_widget_area('widget_after_heading') || is_active_widget_area('widget_sidebar_left') || is_active_widget_area('widget_after_content') || is_active_widget_area('widget_sidebar') || is_active_widget_area('widget_below_content'))
				{
					$out .= ".aside
					{"
						.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'heading_margin'))
						.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'aside_container_margin'))
						.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'aside_container_padding'))
					."}

						.aside .widget:not(.theme_widget_area)
						{"
							.$obj_theme_core->render_css(array('property' => 'border', 'value' => 'aside_widget_border'))
							.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'aside_widget_font_size'))
						."}

							.aside .widget:not(.theme_widget_area) .widget + .widget
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

							.aside .widget .section,
							.aside .widget:not(.theme_widget_area) > div,
							.aside .widget > form,
							.aside .widget > ol,
							.aside .widget > ul,
							.aside .widget > p
							{"
								.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'aside_widget_background'))
								.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'aside_size'))
								.$obj_theme_core->render_css(array('property' => 'line-height', 'value' => 'aside_line_height'))
								."margin-bottom: .5em;"
								.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'aside_padding'))
							."}";

								if(isset($obj_theme_core->options['aside_padding']) && $obj_theme_core->options['aside_padding'] != '')
								{
									$out .= ".aside div.widget.theme_widget_area .widget:not(.theme_widget_area) > div
									{
										padding-top: 0;
										padding-bottom: 0;
									}";
								}

							$out .= ".aside ul, .aside ol
							{
								list-style-position: inside;
							}

								.aside p:not(:last-child), .aside ul:not(:last-child), .aside ol:not(:last-child), .aside form:not(:last-child)
								{"
									.$obj_theme_core->render_css(array('property' => 'margin-bottom', 'value' => 'aside_margin_between'))
								."}

								.aside ul a, .aside ol a
								{
									border-bottom: 2px solid transparent;"
									.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'article_url_color'))
									."text-decoration: none;
								}";
				}

		if(is_active_widget_area('widget_pre_footer'))
		{
			$out .= "#mf-pre-footer
			{"
				.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'pre_footer_bg'))
				.$obj_theme_core->render_css(array('property' => 'background-color', 'value' => 'pre_footer_bg_color'))
				.$obj_theme_core->render_css(array('property' => 'background-image', 'prefix' => 'url(', 'value' => 'pre_footer_bg_image', 'suffix' => '); background-size: cover'))
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
				.$obj_theme_core->render_css(array('property' => 'background-image', 'prefix' => 'url(', 'value' => 'footer_bg_image', 'suffix' => '); background-size: cover'))
				."overflow: hidden;"
				.$obj_theme_core->render_css(array('property' => 'position', 'value' => 'footer_fixed'))
				."z-index: 1000;
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

					footer .widget:not(.theme_widget_area)
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
							.$obj_theme_core->render_css(array('property' => 'margin', 'value' => 'footer_widget_heading_margin'));

							if(isset($obj_theme_core->options['footer_widget_heading_text_transform']) && $obj_theme_core->options['footer_widget_heading_text_transform'] == 'uppercase')
							{
								$out .= "letter-spacing: .13em;";
							}

							$out .= $obj_theme_core->render_css(array('property' => 'text-transform', 'value' => 'footer_widget_heading_text_transform'))
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
									$out .= $obj_theme_core->render_css(array('property' => 'background', 'value' => 'footer_a_bg'))
									.$obj_theme_core->render_css(array('property' => 'border-radius', 'value' => 'form_button_border_radius'))
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

	/*if(is_plugin_active("css-hero-ce/css-hero-main.php"))
	{
		$arr_selectors = get_option('wpcss_current_settings_array_'.$obj_theme_core->get_theme_slug());

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

$aside_left_width = (isset($obj_theme_core->options['aside_left_width']) && $obj_theme_core->options['aside_left_width'] != '' ? $obj_theme_core->options['aside_left_width'] : "28%");
$aside_right_width = (isset($obj_theme_core->options['aside_width']) && $obj_theme_core->options['aside_width'] != '' ? $obj_theme_core->options['aside_width'] : "28%");

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

	if(is_active_widget_area('widget_sidebar_left') || is_active_widget_area('widget_sidebar'))
	{
		if(isset($obj_theme_core->options['aside_sticky_position']) && $obj_theme_core->options['aside_sticky_position'] != '')
		{
			$flex_content .= "#mf-content > div
			{
				overflow: unset;
			}

			.aside.right > div, .aside.left > div
			{
				position: sticky;"
				.$obj_theme_core->render_css(array('property' => 'top', 'value' => 'aside_sticky_position'))
			."}";
		}

		$flex_content .= ".aside.right
		{
			margin-left: 2%;
			-webkit-box-flex: 0 0 ".$aside_right_width.";
			-webkit-flex: 0 0 ".$aside_right_width.";
			-ms-flex: 0 0 ".$aside_right_width.";
			flex: 0 0 ".$aside_right_width.";
			order: 3;"
			.$obj_theme_core->render_css(array('property' => 'max-width', 'value' => 'aside_width'))
		."}

		.aside.left
		{
			margin-right: 2%;
			-webkit-box-flex: 0 0 ".$aside_left_width.";
			-webkit-flex: 0 0 ".$aside_left_width.";
			-ms-flex: 0 0 ".$aside_left_width.";
			flex: 0 0 ".$aside_left_width.";
			order: 1;"
			.$obj_theme_core->render_css(array('property' => 'max-width', 'value' => 'aside_left_width'))
		."}";
	}

if(isset($obj_theme_core->options['mobile_breakpoint']) && $obj_theme_core->options['mobile_breakpoint'] > 0)
{
	$out .= "@media (max-width: ".($obj_theme_core->options['mobile_breakpoint'] - 1)."px)
	{
		body:before
		{
			content: 'is_mobile'; /* is_size_palm */
		}

		.hide_if_mobile
		{
			display: none !important;
		}

			header #site_logo
			{"
				.$obj_theme_core->render_css(array('property' => 'max-width', 'value' => 'logo_width_mobile'))
			."}

			#secondary_nav/*, header .searchform*/
			{
				display: none;
			}

			article section.text_columns
			{
				-webkit-column-count: 1;
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
			content: 'is_tablet'; /* is_size_lap */
			display: none;
		}

		.show_if_mobile
		{
			display: none !important;
		}

		html
		{"
			.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'body_desktop_font_size'))
		."}

			.theme_nav.is_mobile_ready .sub-menu
			{
				left: 50%;
				position: absolute;
				-webkit-transform: translateY(-50%);
				transform: translateX(-50%);
				z-index: 100;
			}";

			if(isset($obj_theme_core->options['sub_nav_direction']) && $obj_theme_core->options['sub_nav_direction'] == 'vertical')
			{
				$out .= ".theme_nav.is_mobile_ready .sub-menu
				{"
					//.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'sub_nav_bg'))
					//."border-radius: .3em;"
					//."overflow: hidden;"
					."text-align: center;
				}

					.theme_nav.is_mobile_ready .sub-menu li
					{"
						//.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'sub_nav_bg'))
						."display: block;
						margin-left: 0;
					}

						.theme_nav.is_mobile_ready .sub-menu li a
						{"
							.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'sub_nav_bg'))
							."white-space: nowrap;
						}

							.theme_nav.is_mobile_ready .sub-menu li:first-child > a
							{
								border-top-left-radius: .3em;
								border-top-right-radius: .3em;
							}

							.theme_nav.is_mobile_ready .sub-menu li:last-child > a
							{
								border-bottom-left-radius: .3em;
								border-bottom-right-radius: .3em;
							}

						.theme_nav.is_mobile_ready .sub-menu .sub-menu
						{
							left: 17em !important;
							top: 0;
						}

							.theme_nav.is_mobile_ready .sub-menu .sub-menu:before
							{
								border-bottom-color: transparent;"
								.$obj_theme_core->render_css(array('property' => 'border-right-color', 'value' => 'sub_nav_bg'))
								."left: -0.6em;
								top: 0.9em;
							}";
			}

			else
			{
				$out .= ".theme_nav.is_mobile_ready .sub-menu
				{
					/*padding-top: .5em;*/
					white-space: nowrap;
				}

					#primary_nav.theme_nav.is_mobile_ready .sub-menu a
					{"
						.$obj_theme_core->render_css(array('property' => 'background', 'value' => 'sub_nav_bg'))
					."}

						.theme_nav.is_mobile_ready .sub-menu li:first-child > a
						{
							border-top-left-radius: .3em;
							border-bottom-left-radius: .3em;
						}

						.theme_nav.is_mobile_ready .sub-menu li:last-child > a
						{
							border-top-right-radius: .3em;
							border-bottom-right-radius: .3em;
						}";
			}

				if(isset($obj_theme_core->options['sub_nav_arrow']) && $obj_theme_core->options['sub_nav_arrow'] == 2)
				{
					$out .= ".theme_nav.is_mobile_ready .sub-menu
					{
						padding-top: .5em;
					}

						.theme_nav.is_mobile_ready .sub-menu:before
						{
							border: .7em solid transparent;"
							.$obj_theme_core->render_css(array('property' => 'border-bottom-color', 'value' => 'sub_nav_bg'))
							."content: '';
							left: 50%;
							position: absolute;
							top: -.6em;
							transform: translateX(-50%);
						}";
				}

						$out .= "#primary_nav.theme_nav.is_mobile_ready .sub-menu a
						{"
							.$obj_theme_core->render_css(array('property' => 'color', 'value' => 'sub_nav_color'))
							.$obj_theme_core->render_css(array('property' => 'padding', 'value' => 'sub_nav_link_padding'))
						."}

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
			content: 'is_desktop'; /* is_size_desk */
		}

		#mf-pre-header > div, header > div, #mf-after-header > div, #mf-pre-content > div, #mf-content > div, #mf-pre-footer > div, footer > div, body:not(.is_mobile) nav.full_width:not(.is_hamburger) > div, .full_width > div > .widget .section, .full_width > div > .widget > div
		{
			margin: 0 auto;
			margin-left: auto !important;
			margin-right: auto !important;
			max-width: ".$obj_theme_core->options['website_max_width']."px;
		}"
		.$flex_content
	."}";
}

$out .= "@media print
{
	html
	{"
		.$obj_theme_core->render_css(array('property' => 'font-size', 'value' => 'body_print_font_size'))
	."}
}";

echo $out;