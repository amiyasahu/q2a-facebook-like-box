<?php
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
	);