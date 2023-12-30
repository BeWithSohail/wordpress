=== Simplistic page navi ===
Contributors: strix-bubol5
Donate link: 
Tags: navigation, pagination, paging, pages, pager
Requires at least: 4.5
Tested up to: 6.1
Stable tag: 5.1
Requires PHP: 7.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin displays a linked list by page number. It is simple but has several features.

== Description ==
This plugin's page-list has an input box that allows you to directly specify the page number you wish to display.

This plugin has a setting to display page-list in reverse order

You can specify style-sheet and some options at each page.

This plugin has several sample stylesheets by default.

By passing an array of options to the function as arguments on each page, it is possible to change the appearance of multiple linked listings within the same page, except for the style.

It is common to have two linked lists, one at the top of the page and one at the bottom. In such cases, when the function is called a second time, the list created the first time is reused from memory to avoid having the same process performed twice.

This plugin has a custom block for Gutenberg Block Editor.

Even if you don't know much html or php, this plugin has the ability to insert linked list at the beginning and end of an html element using Javascript by specifying the ID of the html element where you want to display it.
Furthermore, if you have no idea about the ID of html elements, etc., go into the plugin's options settings page and try typing "search" in the "Page-lists outputted by javascript" field. When the page is displayed, the plugin uses javascript to find the html elements of the main content, and if it is lucky enough to find it, it will use Javascript to insert a page-lists at the beginning and end of that HTML element. Perhaps it might work.

== Installation ==

1. Upload "simplistic_pagenavi" folder which include "simplistic_pagenavi.php" to the "/wp-content/plugins/" directory
2. Activate the plugin through the "Plugins" menu in WordPress
3. Go to "WP-Admin -> Settings -> Simplistic Page-navi Option" to configure the plugin options
4. Add a template tag "splcpn_echopager" to the place where you would like to display page-navigation in your theme. Or, if you don't want to touch HTML or PHP at all, try into a word "search" in the "Page-lists outputted by javascript" option box. If this plugin can successfully find the main content, maybe it will work.

Usage is as follows.
`
<?php
	if ( function_exists( 'splcpn_echopager' ) ) {
		splcpn_echopager( 1 );
	}
?>
`
In this case, HTML will be generated as follows when you set 1 as an argument.
`
<nav id="toppagelink"><div class="pagenavilist">
`

If you set 0 or if you omit it ( optional in the case because 0 is default value) is as follows.
`
<nav id="bottompagelink"><div class="pagenavilist">
`
If you want to display page-lists twice in the same page, you can setting of position in detail for each.

I think it is common to display two pagenations  at the top and bottom of a page. In that case, the second time the function is called, the first creation is stored in memory and reused.

Other parameters (like options, but those related to style sheets are useless) can also be specified as the second argument in an array, as shown bellow.

By specifying options in the function arguments, you can have different displays even within the same page. (e.g., a full list at the top and a minimalist list at the bottom)

The following is a list of all the items that can be specified, but in reality, only the necessary items need to be specified in an array.

When specifying the second argument, the first argument must be specified even if the first argument is the default value of 0 (otherwise an error will occur).

The last parameter "max_page_num" is not an option value. For example, when you get a list of the specific category post using the WP_Query at a "static" page, there is a case where "$wp_query->max_num_pages" is no value. In that case, pagenation will be not displayed. You should specified in this parameter by getting the total number of pages in some way.
`
<?php
	if ( function_exists( 'splcpn_echopager' ) ) {
		$args = array(
			'reverse' => '0', // 0:normal(from left) 1:reverse(from right)
			'above' => '7', // Show jump-box when the total number of pages is more than this number, default:7
			'minimum_unit' => '1', // 0:minimum-list 1:full-list
			'adjacent_num'=> '3',// Number of pages that adjacent to current page to be displayed, 1-5
			'larger_page'=> '3',// Number of pages that multiples of 10 to be displayed, 0-5
			'top_label' => 'Top',
			'last_label' => 'Last',
			'connection_str'=>'~',// Connection string, empty is disable.
			'div_id'=>'pagenavilist',// ID name of parent div tag.
			'font_size'=>'0',//specify font size. set 0 to disable. -10 : 0.5em ~ 10 : 1.5em, at intervals of 0.05em.
			'top_text_align'=>'0',// Text-align of id="toppagelink" of "nav" tag. 0 : disable, 1:left, 2: right, 3:center.
			'top_margin'=>'',// Margin of  id="toppagelink" of "nav" tag. Empty is disable, top:right:bottom:left. This value can have from one to four values same as the format of css.
			'bottom_text_align'=>'0',// Text-align of  id selector "bottompagelink" of "nav" tag. 0 : disable, 1:left, 2: right, 3:center.
			'bottom_margin'=>'',// Margin of  id selector "bottompagelink" of "nav" tag. Same as "top_margin". 
			'distant_num'=>'3',// Number of pages that multiples of 100 to be displayed when the wide distance from the edge label.
			'max_page_num'=>$wp_query->max_num_pages,// The total number of pages. This value is required when value of $wp_query->max_num_pages is empty.
		);
		splcpn_echopager( 0, $args );
	}
?>
`

In addition, when you want to change the style by the page. 

You set the "Load style sheet" of the option to 0, and calling the function of "direct_splcpn_style" before wp_head () in header.php. 

You can specify the style sheet to be loaded for each page.

For example, if in the following manner, you can randomly change the style at load page.

`
<?php
	$splcpn_num = rand( 1, 6 );
	direct_splcpn_style( $splcpn_num );
	wp_head();
?>
`

== Frequently asked questions ==

= What web browsers are supported? =
The supporting Web browser has to be HTML5 and CSS3.

= What is the supporting language? =
Japanese and English supports it.
But I am not good at english. English part needs improvement.

= After having deleted the plugin, how does the stored optional value turn out? =
The stored optional value is deleted if you delete plugin in WP-Admin->plugins menu.

== Screenshots ==

1. page list styling samples.
2. reverse list and minimum list.
3. Option page english.

== Changelog ==
= 5.1 - November 12,2022 =
*  Bug fixed : Fixed center not being applied to parent tag text-align setting.

= 5.0 - November 7,2022 =
*  function of generate page-list has been completely rewritten to speed up the process.
*  Updated custom block for Gutenberg Block Editor to apiVersion2.
*  Supported php8.1.

= 4.0 - September 8,2021 =
*  Equipped block for Gutenberg block editor.
*  Added the ability to insert HTML elements of page-list by Javascript without writing function names in the template file.
*  Bug fixed : enabled option : Maximum number of hundreds place pages to display list
*  Bug fixed : PHP8 Warning:  Array to string conversion formatting. php at function get_url_parameter.
*  Improved function of generate page list to speed up.

= 3.0 - December 11,2019 =
*  Changed the method of deleting the option value saved in the database to the method of using the uninstall.php file when the plug-in is deleted from WP-Admin->plugins menu.
*  Improved function of generate page list to speed up.

= August 23,2017 =
*  Changed : change default value of madia query max-width for narrow screen.

= 2.1 - August 16,2016 =
*  Fixed : Minor update for function of make_pagenumlink.

= 2.0 - August 12,2016 =
*  Improved function of generate number-link to speed up.
*  Bug fixed : display 1 page in minimum list.
*  Test for Wordpress 4.6.

= 1.0 - July 1,2016 =
*  Simplistic page navi release.

== Upgrade Notice ==



== Arbitrary section 1 ==

