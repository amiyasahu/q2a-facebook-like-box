<?php

/*
	Question2Answer (c) Gideon Greenspan
	Facebook LikeBox (c) Amiya Sahu (developer.amiya@outlook.com)
	
	http://www.question2answer.org/

	
	File: qa-plugin/basic-adsense/qa-plugin.php
	Version: See define()s at top of qa-include/qa-base.php
	Description: Initiates Adsense widget plugin


	This program is free software; you can redistribute it and/or
	modify it under the terms of the GNU General Public License
	as published by the Free Software Foundation; either version 2
	of the License, or (at your option) any later version.
	
	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	More about this license: http://www.question2answer.org/license.php
*/

/* don't allow this page to be requested directly from browser */	
if (!defined('QA_VERSION')) {
		header('Location: /');
		exit;
}

return array(
	"colorscheme_label"     => "Color Scheme : The color scheme used by the plugin" ,
	"box_header_label"      => "Header: Specifies whether to display the Facebook header at the top of the plugin." ,
	"show_border_label"     => "Border: Specifies whether or not to show a border around the plugin." ,
	"show_faces_label"      => "Show Faces: Specifies whether to display profile photos of people who like the page." ,
	"show_stream_label"      => "Show Stream: Specifies whether to display a stream of the latest posts by the Page." ,
	"like_box_height_label" => "Height: The height of the plugin in pixels .(Recomended is 320 px for best results) " ,
	"like_box_width_label"  => "Width: The width of the plugin in pixels. Minimum is 292. (Recomended is 360 px for best results)" ,
	"ur_fb_page_url"        => "Page Url : The absolute URL of the Facebook Page that will be liked. This is a required setting." ,
	"fb_like_box"           => "Faceboo Like Box" ,
	"settings_saved"           => "Faceboo Like Box settings has been saved " ,
	);