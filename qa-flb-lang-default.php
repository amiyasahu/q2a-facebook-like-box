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
    if ( !defined( 'QA_VERSION' ) ) {
        header( 'Location: /' );
        exit;
    }

    return array(
        // languages for the facebook like modal
        "ur_fb_page_url"                  => "Page Url : The relative URL of the Facebook Page that will be liked. This is a required setting.",
        "ur_fb_page_url_note"             => "( If your facebook page url is <strong>https://www.facebook.com/queryhandlers</strong> , then only give <strong>queryhandlers</strong> in the text box )",
        "settings_saved"                  => "Facebook Like Box settings has been saved ",
        "plz_provide_fb_url"              => "Please provide your facebook page url to display on website ",
        // languages for the facebook like box
        "b_colorscheme_label"             => "Color Scheme : The color scheme used by the Like Box ",
        "b_box_header_label"              => "Display the Facebook header at the top of the box ",
        "b_show_border_label"             => "Show a border around the box ",
        "b_show_faces_label"              => "Display profile photos of people who like the page ",
        "b_show_stream_label"             => "Display a stream of the latest posts by the Page ",
        "b_like_box_height_label"         => "Height of the box in pixels ",
        "b_like_box_width_label"          => "Width of the box in pixels ",
        "b_show_fb_like_box"              => "Show Facebook Like Box ",
        // languages for the facebook like modal
        "m_colorscheme_label"             => "Color Scheme : The color scheme used by the popup box ",
        "m_box_header_label"              => "Display the Facebook header at the top of popup box ",
        "m_show_border_label"             => "Show a border around the popup box ",
        "m_show_faces_label"              => "Display profile photos of people who like the page ",
        "m_show_stream_label"             => "Display a stream of the latest posts by the Page ",
        "m_like_modal_height_label"       => "Height of the popup box in pixels ",
        "m_like_modal_width_label"        => "Width of the popup box in pixels ",
        "m_like_modal_cookie_expire"      => "Lifetime of the cookie (in days)",
        "m_like_modal_cookie_expire_note" => "( Number of days after which the pupop will be again displayed to the user ) ",
        "m_pop_up_header_text"            => "Header Text to be displayed for the popup ( HTML is allowed )",
        "m_pop_up_sp_text"                => "Supporting Text to be displayed for the popup ( HTML is allowed )",
        "m_pop_up_footer_text"            => "Footer Text to be displayed for the popup ( HTML is allowed )",
        "m_pop_up_footer_Link"            => "Footer link to be displayed for the popup ( HTML is allowed )",
        "m_show_fb_like_modal"            => "Show Facebook Like Modal when user visits first time ",
        "m_use_css_from_theme_file"       => "Use styling from the Theme css file ",
        "m_costum_css"                    => "Additional CSS properties according to your choice ",
        "m_costum_css_note"               => "Do not wrap this styles with <style>...</style> tags  ",
        "m_display_on_every_load"         => "Display popup on every page load ( Only required for debugging mode . Not recomended on live site )  ",
        "m_like_modal_delay"              => "Show the popup after ( time in seconds )",
        "m_like_modal_delay_note"         => "( No of seconds after which modal will be displayed user once the page loads ) ",
        "save_changes"                    => "Save Changes",
    );