<?php

    /*
      Question2Answer (c) Gideon Greenspan
      Facebook LikeBox (c) Amiya Sahu (developer.amiya@outlook.com)

        http://www.question2answer.org/


        File: qa-plugin/basic-adsense/qa-basic-adsense.php
        Version: See define()s at top of qa-include/qa-base.php
        Description: Widget module class for AdSense widget plugin


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

    class q2a_facebook_like_box
    {

        function output_widget( $region, $place, $themeobject, $template, $request, $qa_content )
        {
            require_once AMI_FB_LIKE_BOX_DIR . '/qa-facebook-like-box-admin.php';
            $has_error = false;
            $error_message = "";
            $widget_opt = qa_get_options( array( 'facebook_app_id',
                qa_facebook_like_box_admin::SHOW_FB_LIKE_BOX,
                qa_facebook_like_box_admin::SHOW_FB_LIKE_MODAL,
                qa_facebook_like_box_admin::FACEBOOK_PAGE_URL,
                qa_facebook_like_box_admin::LIKE_BOX_COLOR_SCHEME,
                qa_facebook_like_box_admin::LIKE_BOX_SHOW_HEADER,
                qa_facebook_like_box_admin::LIKE_BOX_SHOW_BORDER,
                qa_facebook_like_box_admin::LIKE_BOX_SHOW_FACES,
                qa_facebook_like_box_admin::LIKE_BOX_SHOW_DATA_STREAM,
                qa_facebook_like_box_admin::LIKE_BOX_HEIGHT,
                qa_facebook_like_box_admin::LIKE_BOX_WIDTH,
                qa_facebook_like_box_admin::MODAL_USE_CSS_FROM_THEME,
                qa_facebook_like_box_admin::MODAL_COLOR_SCHEME,
                qa_facebook_like_box_admin::MODAL_SHOW_HEADER,
                qa_facebook_like_box_admin::MODAL_SHOW_BORDER,
                qa_facebook_like_box_admin::MODAL_SHOW_FACES,
                qa_facebook_like_box_admin::MODAL_SHOW_DATA_STREAM,
                qa_facebook_like_box_admin::MODAL_HEIGHT,
                qa_facebook_like_box_admin::MODAL_WIDTH,
                qa_facebook_like_box_admin::MODAL_COOKIE_EXPIRE,
                qa_facebook_like_box_admin::MODAL_HEADER_MAIN_TEXT,
                qa_facebook_like_box_admin::MODAL_DISPLAY_EVERY_TIME,
                qa_facebook_like_box_admin::MODAL_FOOTER_TEXT,
                qa_facebook_like_box_admin::MODAL_COSTUM_CSS,
                qa_facebook_like_box_admin::MODAL_DELAY,
            ) );

            $fb_page_url = $this->get_fb_settings( $widget_opt, 'url' );
            $show_fb_like_box = $this->get_fb_settings( $widget_opt, 'show_fb_like_box' );
            $show_fb_like_box_modal = $this->get_fb_settings( $widget_opt, 'show_fb_like_modal' );

            if ( empty( $fb_page_url ) ) {
                $has_error = true;
                $error_message = qa_lang( 'flb_like_box/plz_provide_fb_url' );
            }

            if ( !$has_error ) {
                if ( $show_fb_like_box ) {
                    $themeobject->output( $this->get_facebook_like_box( $widget_opt ) );
                }
                if ( $show_fb_like_box_modal ) {
                    $themeobject->output( $this->get_facebook_like_modal( $widget_opt ) );
                }

            } else {
                $themeobject->output( '<div class="qa-sidebar error" style="color:red;">' . $error_message . '</div>' );
            }

        }

        function get_fb_settings( $widget_opt, $opt )
        {
            $value = "";
            switch ( $opt ) {
                case 'url':
                case 'href':

                    $value = !empty( $widget_opt[ qa_facebook_like_box_admin::FACEBOOK_PAGE_URL ] ) ? 'https://www.facebook.com/' . $widget_opt[ qa_facebook_like_box_admin::FACEBOOK_PAGE_URL ] : "";
                    break;

                case 'facebook_app_id':

                    return $widget_opt['facebook_app_id'];
                    break;

                case 'show_fb_like_box':

                    return (bool) $widget_opt[ qa_facebook_like_box_admin::SHOW_FB_LIKE_BOX ];
                    break;

                case 'show_fb_like_modal':

                    return (bool) $widget_opt[ qa_facebook_like_box_admin::SHOW_FB_LIKE_MODAL ];
                    break;

                case 'colorscheme':

                    return $widget_opt[ qa_facebook_like_box_admin::LIKE_BOX_COLOR_SCHEME ];

                    break;

                case 'show_header':

                    return $widget_opt[ qa_facebook_like_box_admin::LIKE_BOX_SHOW_HEADER ];
                    break;

                case 'show_border':

                    return $widget_opt[ qa_facebook_like_box_admin::LIKE_BOX_SHOW_BORDER ];
                    break;

                case 'show_faces':

                    return $widget_opt[ qa_facebook_like_box_admin::LIKE_BOX_SHOW_FACES ];
                    break;

                case 'stream':

                    return $widget_opt[ qa_facebook_like_box_admin::LIKE_BOX_SHOW_DATA_STREAM ];
                    break;

                case 'height':

                    $value = (int) $widget_opt[ qa_facebook_like_box_admin::LIKE_BOX_HEIGHT ];

                    if ( $this->get_fb_settings( $widget_opt, "data_stream" ) && $this->get_fb_settings( $widget_opt, "show_faces" ) ) {
                        // if both are true min height is 556px
                        $min_height = 556;
                    } elseif ( !$this->get_fb_settings( $widget_opt, "data_stream" ) && !$this->get_fb_settings( $widget_opt, "show_faces" ) ) {
                        // if both are false min height is 63px
                        $min_height = 63;
                    } else {
                        // otherwise
                        $min_height = 300;
                    }

                    return max( $value, $min_height );

                    break;

                case 'width':

                    $value = (int) $widget_opt[ qa_facebook_like_box_admin::LIKE_BOX_WIDTH ];
                    $min_width = 190; /*allow only these values*/

                    return max( $value, $min_width );
                    break;

                case 'm_url':
                case 'm_href':

                    $value = !empty( $widget_opt[ qa_facebook_like_box_admin::FACEBOOK_PAGE_URL ] ) ? '//www.facebook.com/plugins/likebox.php?href=http://www.facebook.com/' . $widget_opt[ qa_facebook_like_box_admin::FACEBOOK_PAGE_URL ] : "";
                    break;

                case 'm_colorscheme':

                    return $widget_opt[ qa_facebook_like_box_admin::MODAL_COLOR_SCHEME ];

                    break;

                case 'm_show_header':

                    return $widget_opt[ qa_facebook_like_box_admin::MODAL_SHOW_HEADER ];

                    break;

                case 'm_show_border':

                    return $widget_opt[ qa_facebook_like_box_admin::MODAL_SHOW_BORDER ];
                    break;

                case 'm_show_faces':

                    return $widget_opt[ qa_facebook_like_box_admin::MODAL_SHOW_FACES ];

                    break;

                case 'm_stream':

                    return $widget_opt[ qa_facebook_like_box_admin::MODAL_SHOW_DATA_STREAM ];

                    break;

                case 'm_height':

                    $value = (int) $widget_opt[ qa_facebook_like_box_admin::MODAL_HEIGHT ];
                    if ( $this->get_fb_settings( $widget_opt, "data_stream" ) && $this->get_fb_settings( $widget_opt, "show_faces" ) ) {
                        // if both are true min height is 556px
                        $min_height = 556;
                    } elseif ( !$this->get_fb_settings( $widget_opt, "data_stream" ) && !$this->get_fb_settings( $widget_opt, "show_faces" ) ) {
                        // if both are false min height is 175px
                        $min_height = 175;
                    } else {
                        // otherwise
                        $min_height = 275;
                    }

                    return max( $value, $min_height );
                    break;

                case 'm_width':

                    $value = (int) $widget_opt[ qa_facebook_like_box_admin::MODAL_WIDTH ];
                    $min_width = 300; /*allow only these values*/

                    return max( $value, $min_width );
                    break;
                case 'm_delay':

                    $value = (int) $widget_opt[ qa_facebook_like_box_admin::MODAL_DELAY ];

                    $min_delay = 5; /*allow only these values*/

                    return max( $value, $min_delay ) * 1000; /*make it to milli seconds */

                    break;

                case 'm_cookie_expire':

                    $value = $widget_opt[ qa_facebook_like_box_admin::MODAL_COOKIE_EXPIRE ];
                    break;
                default:
                    break;
            }

            return $value;
        }

        function get_facebook_like_box( $widget_opt )
        {
            // get the facebook like box settings
            $facebook_app_id = $this->get_fb_settings( $widget_opt, 'facebook_app_id' );
            $fb_page_url = $this->get_fb_settings( $widget_opt, 'url' );
            $colorscheme = $this->get_fb_settings( $widget_opt, 'colorscheme' );
            $header = $this->get_fb_settings( $widget_opt, 'show_header' );
            $show_border = $this->get_fb_settings( $widget_opt, 'show_border' );
            $show_faces = $this->get_fb_settings( $widget_opt, 'show_faces' );
            $stream = $this->get_fb_settings( $widget_opt, 'stream' );
            $height = $this->get_fb_settings( $widget_opt, 'height' );
            $width = $this->get_fb_settings( $widget_opt, 'width' );

            $data['href'] = 'data-href="' . $fb_page_url . '"';
            $data['force_wall'] = 'data-force-wall="false"';
            $data['colorscheme'] = 'data-colorscheme="' . $colorscheme . '"';
            $data['header'] = 'data-header="' . $header . '"';
            $data['show_border'] = 'data-show-border="' . $show_border . '"';
            $data['show_faces'] = 'data-show-faces="' . $show_faces . '"';
            $data['stream'] = 'data-stream="' . $stream . '"';
            $data['height'] = 'data-height="' . $height . '"';
            $data['width'] = 'data-width="' . $width . '"';

            $data_str = implode( ' ', $data );
            $fb_like_box = '<div class="fb-like-box" ' . $data_str . '> </div>';
            $facebook_app_id = qa_opt( 'facebook_app_id' );

            if ( !$facebook_app_id ) {
                // if the facebook app id is not set set it with app id given by the Facebook
                $facebook_app_id = "576492145800361";
            }

            ob_start();
            ?>
            <!--  widget start  -->
            <div id="fb-root"></div>
            <script>(function (d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s);
                    js.id = id;
                    js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=<?php echo $facebook_app_id; ?>&version=v2.0";
                    fjs.parentNode.insertBefore(js, fjs);
                }(document, 'script', 'facebook-jssdk'));</script>
            <div class="fb-like-box clearfix">
                <?php echo $fb_like_box ?>
            </div>
            <!--  widget ends  -->
            <?php

            return ob_get_clean();
        }

        function get_facebook_like_modal( $widget_opt )
        {
            // get the facebook like box settings
            $facebook_app_id = $this->get_fb_settings( $widget_opt, 'facebook_app_id' );
            $fb_page_url = $this->get_fb_settings( $widget_opt, 'm_url' );
            $colorscheme = $this->get_fb_settings( $widget_opt, 'm_colorscheme' );
            $header = $this->get_fb_settings( $widget_opt, 'm_show_header' );
            $show_border = $this->get_fb_settings( $widget_opt, 'm_show_border' );
            $show_faces = $this->get_fb_settings( $widget_opt, 'm_show_faces' );
            $stream = $this->get_fb_settings( $widget_opt, 'm_stream' );
            $height = $this->get_fb_settings( $widget_opt, 'm_height' );
            $width = $this->get_fb_settings( $widget_opt, 'm_width' );
            $cookie_expire = $this->get_fb_settings( $widget_opt, 'm_cookie_expire' );
            $delay = $this->get_fb_settings( $widget_opt, 'm_delay' );
            $header_main_text = @$widget_opt[ qa_facebook_like_box_admin::MODAL_HEADER_MAIN_TEXT ];
            $footer_text = @$widget_opt[ qa_facebook_like_box_admin::MODAL_FOOTER_TEXT ];
            $use_css_from_theme = @$widget_opt[ qa_facebook_like_box_admin::MODAL_USE_CSS_FROM_THEME ];
            $costum_css = @$widget_opt[ qa_facebook_like_box_admin::MODAL_COSTUM_CSS ];
            $show_on_every_load = @$widget_opt[ qa_facebook_like_box_admin::MODAL_DISPLAY_EVERY_TIME ];

            $css = "";
            //'//www.facebook.com/plugins/likebox.php?href=http://www.facebook.com/queryhandlers&width=290&height=275&colorscheme=light&show_faces=true&border_color=%23ffffff&stream=false&header=false'
            $data['href'] = $fb_page_url;
            $data['force_wall'] = 'force_wall=false';
            $data['colorscheme'] = 'colorscheme=' . $colorscheme . '';
            $data['header'] = 'header=' . $header . '';
            $data['show_border'] = 'show_border=' . $show_border . '';
            $data['show_faces'] = 'show_faces=' . $show_faces . '';
            $data['stream'] = 'stream=' . $stream . '';
            $data['height'] = 'height=' . $height . '';
            $data['width'] = 'width=' . $width . '';
            $data['border_color'] = 'border_color=%23ffffff';

            $src_str = implode( '&', $data );

            if ( !$use_css_from_theme ) {
                // if not using css from  theme put these default styling
                $css = '#fb-back {display: none; background: rgba(0,0,0,0.8); width: 100%; height: 100%; position: fixed; top: 0; left: 0; z-index: 99999; } #fb-exit {width: 100%; height: 100%; } .fb-box-inner {width:300px; position: relative; display:block; padding: 20px 0px 0px; margin:0 auto; text-align:center; } #fb-close {cursor: pointer; position: absolute; top: 10px; right: -10px; font-size: 18px; font-weight:700; color: #000; z-index: 99999; display:inline-block; line-height: 18px; height:18px; width: 18px; } #fb-close:hover {color:#06c; } #fb-box {min-width: 340px; min-height: 360px; position: absolute; top: 50%; left: 50%; margin: -220px 0 0 -170px; -webkit-box-shadow: 0px 0px 16px #000; -moz-box-shadow: 0px 0px 16px #000; box-shadow: 0px 0px 16px #000; -webkit-border-radius: 8px;- moz-border-radius: 8px; border-radius: 8px; background: #fff; /* pop up box bg color */ border-bottom: 40px solid #f0f0f0; /* pop up bottom border color/size */ } .fb-box-inner h3 {line-height: 1; margin:0 auto; text-transform:none; letter-spacing:none; font-size: 23px!important; /* header size */ color:#06c!important; /* header color */ } .fb-box-inner p {line-height: 1; margin:5px auto 5px; text-transform:none; letter-spacing:none; font-size: 13px!important; /* header size  */ color:#333!important; /* text color */ } a.fb-link {position:relative; margin: 0 auto; display: block; text-align:center; color: #333; /* link color */ bottom: -30px; } #fb-footer-txt {position:relative; margin: 0 auto; display: block; text-align:center; color: #333; /* link color */ bottom: -30px; } #fb-header-txt{margin-bottom: 10px ; } #fb-box h3,#fb-box p, a.fb-link { max-width:290px; padding:0; }';
            }
            if ( $show_on_every_load ) {
                // set the cookie expire time to zero if $show on every load is enabled
                $cookie_expire = 0;
            }
            $css .= $costum_css;


            ob_start();
            ?>
            <!--  Facebook Like Modal start  -->
            <!-- popup box stylings -->
            <style type="text/css">
                <?php echo $css ; ?>
            </style>

            <!-- facebook plugin -->
            <div id='fb-back'>
                <div id="fb-exit"></div>
                <div id='fb-box'>
                    <div class="fb-box-inner">

                        <div id="fb-header-txt">
                            <div id="fb-close">&times;</div>
                            <?php echo $header_main_text ?>
                        </div>
                        <!-- IFrame starts here -->
                        <iframe allowtransparency='true' frameborder='0' scrolling='no' src='<?php echo $src_str; ?>'
                                style='border: 0 none; overflow: hidden; width: 290px; height: 270px;text-align:center;margin:0 auto;'></iframe>
                        <!-- IFrame Ends here  -->
                        <div id="fb-footer-txt">
                            <?php echo $footer_text ?>
                        </div>
                    </div>
                </div>
            </div>
            <!-- popup plug-in snippet  -->
            <script type='text/javascript'>
                //<![CDATA[
                //grab user's browser info and calculates/saves first visit
                if (typeof(jQuery.cookie) == "undefined") {
                    jQuery.cookie = function (key, value, options) {
                        if (arguments.length > 1 && String(value) !== "[object Object]") {
                            options = jQuery.extend({}, options);
                            if (value === null || value === undefined) {
                                options.expires = -1;
                            }
                            if (typeof options.expires === 'number') {
                                var days = options.expires, t = options.expires = new Date();
                                t.setDate(t.getDate() + days);
                            }
                            value = String(value);
                            return (document.cookie = [encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value), options.expires ? '; expires=' + options.expires.toUTCString() : '', options.path ? '; path=' + options.path : '', options.domain ? '; domain=' + options.domain : '', options.secure ? '; secure' : ''].join(''));
                        }
                        options = value || {};
                        var result, decode = options.raw ? function (s) {
                            return s;
                        } : decodeURIComponent;
                        return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null;
                    };
                }
                ;

                // the pop up actions
                $(function ($) {
                    if ($.cookie('popup_fb') != 'yes') {
                        $('#fb-back').delay(<?php echo $delay; ?>).fadeIn("slow"); // options slow or fast
                        $('#fb-close, #fb-exit').click(function () {
                            $('#fb-back').stop().fadeOut("slow"); // options slow or fast
                        });
                    }
                    //initiate popup function by setting up the cookie expiring time
                    $.cookie('popup_fb', 'yes', {path: '/', expires: <?php echo $cookie_expire ?>});
                });
                //]]>
            </script>
            <!-- facebook like box ends -->
            <!--  Facebook Like Modal ends  -->
            <?php
            return ob_get_clean();
        }

        function allow_template( $template )
        {
            return ( $template != 'admin' );
        }


        function allow_region( $region )
        {
            $allow = false;

            switch ( $region ) {
                case 'main':
                case 'side':
                case 'full':
                    $allow = true;
                    break;
            }

            return $allow;
        }

    }


/*
	Omit PHP closing tag to help avoid accidental output
*/
