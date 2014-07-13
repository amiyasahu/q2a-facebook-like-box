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

	class q2a_facebook_like_box {

        const FACEBOOK_PAGE_URL         = 'flb_page_url' ;
        const SHOW_FB_LIKE_BOX          = 'flb_show_fb_like_box' ;
        const LIKE_BOX_COLOR_SCHEME     = 'flb_like_box_colorscheme';
        const LIKE_BOX_SHOW_HEADER      = 'flb_like_box_header';
        const LIKE_BOX_SHOW_BORDER      = 'flb_like_box_show_border';
        const LIKE_BOX_SHOW_FACES       = 'flb_like_box_show_faces';
        const LIKE_BOX_SHOW_DATA_STREAM = 'flb_like_box_data_stream';
        const LIKE_BOX_HEIGHT           = 'flb_like_box_height';
        const LIKE_BOX_WIDTH            = 'flb_like_box_width';
        const SHOW_FB_LIKE_MODAL       =  'flb_show_fb_like_modal';
        const MODAL_COLOR_SCHEME       =  'flb_like_modal_colorscheme';
        const MODAL_SHOW_HEADER        =  'flb_like_modal_header';
        const MODAL_SHOW_BORDER        =  'flb_like_modal_show_border';
        const MODAL_SHOW_FACES         =  'flb_like_modal_show_faces';
        const MODAL_SHOW_DATA_STREAM   =  'flb_like_modal_data_stream' ;
        const MODAL_HEIGHT             =  'flb_like_modal_height' ;
        const MODAL_WIDTH              =  'flb_like_modal_width' ;
        const MODAL_COOKIE_EXPIRE      =  'flb_modal_cookie_expire' ;
        const MODAL_HEADER_MAIN_TEXT   =  'flb_modal_header_main_text' ;
        const MODAL_FOOTER_TEXT        =  'flb_modal_header_footer_text' ;
        const MODAL_USE_CSS_FROM_THEME =  'flb_use_css_from_theme_file' ;
        const MODAL_COSTUM_CSS         =  'flb_modal_costum_css' ;
        const MODAL_DISPLAY_EVERY_TIME =  'flb_display_on_every_load' ;
        const MODAL_DELAY              =  'flb_modal_delay' ;

		function admin_form(&$qa_content)
		{
			$saved=false;

			if (qa_clicked('fb_like_box_save_btn')) {
                qa_opt(self::FACEBOOK_PAGE_URL , qa_post_text(self::FACEBOOK_PAGE_URL)) ;
        		// for like box
				qa_opt(self::SHOW_FB_LIKE_BOX ,          !!qa_post_text(self::SHOW_FB_LIKE_BOX)) ;
			    qa_opt(self::LIKE_BOX_COLOR_SCHEME ,     qa_post_text(self::LIKE_BOX_COLOR_SCHEME)) ;
        		qa_opt(self::LIKE_BOX_SHOW_HEADER ,      qa_post_text(self::LIKE_BOX_SHOW_HEADER)) ;
        		qa_opt(self::LIKE_BOX_SHOW_BORDER ,      qa_post_text(self::LIKE_BOX_SHOW_BORDER)) ;
        		qa_opt(self::LIKE_BOX_SHOW_FACES ,       qa_post_text(self::LIKE_BOX_SHOW_FACES)) ;
			 	qa_opt(self::LIKE_BOX_SHOW_DATA_STREAM , qa_post_text(self::LIKE_BOX_SHOW_DATA_STREAM)) ;
        		qa_opt(self::LIKE_BOX_HEIGHT ,           qa_post_text(self::LIKE_BOX_HEIGHT)) ;
			 	qa_opt(self::LIKE_BOX_WIDTH ,            qa_post_text(self::LIKE_BOX_WIDTH)) ;
        			// for modal
				qa_opt(self::SHOW_FB_LIKE_MODAL ,        !!qa_post_text(self::SHOW_FB_LIKE_MODAL)) ;
				qa_opt(self::MODAL_COLOR_SCHEME ,        qa_post_text(self::MODAL_COLOR_SCHEME)) ;
				qa_opt(self::MODAL_SHOW_HEADER ,         qa_post_text(self::MODAL_SHOW_HEADER)) ;
				qa_opt(self::MODAL_SHOW_BORDER ,         qa_post_text(self::MODAL_SHOW_BORDER)) ;
				qa_opt(self::MODAL_SHOW_FACES ,          qa_post_text(self::MODAL_SHOW_FACES)) ;
				qa_opt(self::MODAL_SHOW_DATA_STREAM ,    qa_post_text(self::MODAL_SHOW_DATA_STREAM)) ;
				qa_opt(self::MODAL_HEIGHT ,               qa_post_text(self::MODAL_HEIGHT)) ;
				qa_opt(self::MODAL_WIDTH ,               qa_post_text(self::MODAL_WIDTH)) ;
				qa_opt(self::MODAL_COOKIE_EXPIRE ,       qa_post_text(self::MODAL_COOKIE_EXPIRE)) ;
        		qa_opt(self::MODAL_HEADER_MAIN_TEXT ,    qa_post_text(self::MODAL_HEADER_MAIN_TEXT)) ;
				qa_opt(self::MODAL_FOOTER_TEXT ,         qa_post_text(self::MODAL_FOOTER_TEXT)) ;
				qa_opt(self::MODAL_USE_CSS_FROM_THEME ,  !!qa_post_text(self::MODAL_USE_CSS_FROM_THEME)) ;
        		qa_opt(self::MODAL_COSTUM_CSS ,          !!qa_post_text(self::MODAL_COSTUM_CSS)) ;
				qa_opt(self::MODAL_DISPLAY_EVERY_TIME ,  !!qa_post_text(self::MODAL_DISPLAY_EVERY_TIME)) ;
				qa_opt(self::MODAL_DELAY ,               (int)qa_post_text(self::MODAL_DELAY)) ;

        		$saved=true;
			}
			 qa_set_display_rules($qa_content, array(
                // for facebook like box
                self::LIKE_BOX_COLOR_SCHEME => self::SHOW_FB_LIKE_BOX ,
                self::LIKE_BOX_SHOW_HEADER      => self::SHOW_FB_LIKE_BOX ,
                self::LIKE_BOX_SHOW_BORDER => self::SHOW_FB_LIKE_BOX ,
                self::LIKE_BOX_SHOW_FACES  => self::SHOW_FB_LIKE_BOX ,
                self::LIKE_BOX_SHOW_DATA_STREAM => self::SHOW_FB_LIKE_BOX ,
                self::LIKE_BOX_HEIGHT      => self::SHOW_FB_LIKE_BOX ,
                self::LIKE_BOX_WIDTH       => self::SHOW_FB_LIKE_BOX ,
                // for facebook like modal
                self::MODAL_COLOR_SCHEME   => self::SHOW_FB_LIKE_MODAL ,
                self::MODAL_SHOW_HEADER        => self::SHOW_FB_LIKE_MODAL ,
                self::MODAL_SHOW_BORDER   => self::SHOW_FB_LIKE_MODAL ,
                self::MODAL_SHOW_FACES    => self::SHOW_FB_LIKE_MODAL ,
                self::MODAL_SHOW_DATA_STREAM   => self::SHOW_FB_LIKE_MODAL ,
                self::MODAL_HEIGHT        => self::SHOW_FB_LIKE_MODAL ,
                self::MODAL_WIDTH         => self::SHOW_FB_LIKE_MODAL ,
                self::MODAL_COOKIE_EXPIRE      => self::SHOW_FB_LIKE_MODAL ,
                self::MODAL_HEADER_MAIN_TEXT   => self::SHOW_FB_LIKE_MODAL ,
                self::MODAL_FOOTER_TEXT => self::SHOW_FB_LIKE_MODAL ,
                self::MODAL_USE_CSS_FROM_THEME  => self::SHOW_FB_LIKE_MODAL ,
                self::MODAL_COSTUM_CSS         => self::SHOW_FB_LIKE_MODAL ,
                self::MODAL_DISPLAY_EVERY_TIME    => self::SHOW_FB_LIKE_MODAL ,
                self::MODAL_DELAY    => self::SHOW_FB_LIKE_MODAL ,
            ));
			return array(
				'ok' => $saved ? qa_lang('flb_like_box/settings_saved') : null,

				'fields' => array(
                    self::FACEBOOK_PAGE_URL => array(
                                    'label' => qa_lang('flb_like_box/ur_fb_page_url'),
                                    'type'  => 'text',
                                    'tags'  => 'name="flb_page_url"',
                                    'value' =>  qa_opt(self::FACEBOOK_PAGE_URL),
                                    'note'  =>  qa_lang('flb_like_box/ur_fb_page_url_note'),
                    ),
                    self::SHOW_FB_LIKE_BOX => array(
                                    'label' => qa_lang('flb_like_box/b_show_fb_like_box'),
                                    'tags'  => 'name="flb_show_fb_like_box" id="flb_show_fb_like_box"',
                                    'value' => qa_opt(self::SHOW_FB_LIKE_BOX),
                                    'type'  => 'checkbox',
                    ),
                    self::LIKE_BOX_COLOR_SCHEME => array(
                                    'id' => self::LIKE_BOX_COLOR_SCHEME ,
                                    'label' => qa_lang('flb_like_box/b_colorscheme_label'),
                                    'type'  => 'select',
                                    'tags'  => 'name="flb_like_box_colorscheme"',
                                    'value' => qa_opt(self::LIKE_BOX_COLOR_SCHEME),
                                    'options' => array(
                                          'light' => 'light',
                                          'dark'  => 'dark',
                                    ),
                    ),
                   self::LIKE_BOX_SHOW_HEADER => array(
                                    'id' => self::LIKE_BOX_SHOW_HEADER ,
                                    'label' => qa_lang('flb_like_box/b_box_header_label'),
                                    'type'  => 'select',
                                    'tags'  => 'name="flb_like_box_header"',
                                    'value' => qa_opt(self::LIKE_BOX_SHOW_HEADER),
                                    'options' => array(
                                       	  'false' => 'false',
                                          'true'  => 'true' ,
                                    ),
                    ),
                   self::LIKE_BOX_SHOW_BORDER => array(
                                    'id' => self::LIKE_BOX_SHOW_BORDER ,
                                    'label' => qa_lang('flb_like_box/b_show_border_label'),
                                    'type'  => 'select',
                                    'tags'  => 'name="flb_like_box_show_border"',
                                    'value' =>  qa_opt(self::LIKE_BOX_SHOW_BORDER),
                                    'options' => array(
                                    	  'false' => 'false',
                                        'true'  =>'true',
                                    ),
                    ),
                    self::LIKE_BOX_SHOW_FACES => array(
                                    'id' => self::LIKE_BOX_SHOW_FACES ,
                                    'label' => qa_lang('flb_like_box/b_show_faces_label'),
                                    'type'  => 'select',
                                    'tags'  => 'name="flb_like_box_show_faces"',
                                    'value' => qa_opt(self::LIKE_BOX_SHOW_FACES),
                                    'options' => array(
                                          'true'  =>'true',
                                          'false' =>'false',
                                    ),
                    ),
                   self::LIKE_BOX_SHOW_DATA_STREAM => array(
                                    'id' => self::LIKE_BOX_SHOW_DATA_STREAM ,
                        						'label' => qa_lang('flb_like_box/b_show_stream_label'),
                        						'type'  => 'select',
                        						'tags'  => 'name="flb_like_box_data_stream"',
                        						'value' => qa_opt(self::LIKE_BOX_SHOW_DATA_STREAM),
                        						'options' => array(
                                          'false' => 'false',
                                          'true'  =>  'true',
                        						),
                    ),

                    self::LIKE_BOX_HEIGHT => array(
                                    'id' => self::LIKE_BOX_HEIGHT ,
                                    'label' => qa_lang('flb_like_box/b_like_box_height_label'),
                                    'type'  => 'text',
                                    'tags'  => 'name="flb_like_box_height"',
                                    'value' => (!!qa_opt(self::LIKE_BOX_HEIGHT)) ? qa_opt(self::LIKE_BOX_HEIGHT) : 320 , /*this default value is to fit for Snow theme */
                    ),
                     self::LIKE_BOX_WIDTH => array(
                                    'id' => self::LIKE_BOX_WIDTH ,
				    'label' => qa_lang('flb_like_box/b_like_box_width_label'),
				    'type'  => 'text',
				    'tags'  => 'name="flb_like_box_width"',
				    'value' => (!!qa_opt(self::LIKE_BOX_WIDTH)) ? qa_opt(self::LIKE_BOX_WIDTH) : 200 , /*this default value is to fit for Snow theme */
                    ),
                    //settings for facebook like box ends here
                    self::SHOW_FB_LIKE_MODAL => array(
                                    'label' => qa_lang('flb_like_box/m_show_fb_like_modal'),
                                    'tags'  => 'name="flb_show_fb_like_modal" id="flb_show_fb_like_modal"',
                                    'value' => qa_opt(self::SHOW_FB_LIKE_MODAL),
                                    'type'  => 'checkbox',
                    ),
                    self::MODAL_USE_CSS_FROM_THEME => array(
                                    'id' => self::MODAL_USE_CSS_FROM_THEME ,
                                    'label' => qa_lang('flb_like_box/m_use_css_from_theme_file'),
                                    'tags'  => 'name="flb_use_css_from_theme_file"',
                                    'value' => qa_opt(self::MODAL_USE_CSS_FROM_THEME),
                                    'type'  => 'checkbox',
                    ),
                    self::MODAL_DISPLAY_EVERY_TIME => array(
                                    'id' => self::MODAL_DISPLAY_EVERY_TIME ,
                                    'label' => qa_lang('flb_like_box/m_display_on_every_load'),
                                    'tags'  => 'name="flb_display_on_every_load"',
                                    'value' => qa_opt(self::MODAL_DISPLAY_EVERY_TIME),
                                    'type'  => 'checkbox',
                    ),

                    self::MODAL_COLOR_SCHEME => array(
                                    'id' => self::MODAL_COLOR_SCHEME ,
                                    'label' => qa_lang('flb_like_box/m_colorscheme_label'),
                                    'type'  => 'select',
                                    'tags'  => 'name="flb_like_modal_colorscheme"',
                                    'value' => qa_opt(self::MODAL_COLOR_SCHEME),
                                    'options' => array(
                                          'light' => 'light',
                                          'dark'  => 'dark',
                                    ),
                    ),
                   self::MODAL_SHOW_HEADER => array(
                                    'id' => self::MODAL_SHOW_HEADER ,
                                    'label' => qa_lang('flb_like_box/m_box_header_label'),
                                    'type'  => 'select',
                                    'tags'  => 'name="flb_like_modal_header"',
                                    'value' => qa_opt(self::MODAL_SHOW_HEADER),
                                    'options' => array(
                                          'false' => 'false',
                                          'true'  => 'true' ,
                                    ),
                    ),
                   self::MODAL_SHOW_BORDER => array(
                                    'id' => self::MODAL_SHOW_BORDER ,
                                    'label' => qa_lang('flb_like_box/m_show_border_label'),
                                    'type'  => 'select',
                                    'tags'  => 'name="flb_like_modal_show_border"',
                                    'value' =>  qa_opt(self::MODAL_SHOW_BORDER),
                                    'options' => array(
                                        'false' => 'false',
                                        'true'  =>'true',
                                    ),
                    ),
                    self::MODAL_SHOW_FACES => array(
                                    'id' => self::MODAL_SHOW_FACES ,
                                    'label' => qa_lang('flb_like_box/m_show_faces_label'),
                                    'type'  => 'select',
                                    'tags'  => 'name="flb_like_modal_show_faces"',
                                    'value' => qa_opt(self::MODAL_SHOW_FACES),
                                    'options' => array(
                                          'true'  =>'true',
                                          'false' =>'false',
                                    ),
                    ),
                   self::MODAL_SHOW_DATA_STREAM => array(
                                    'id' => self::MODAL_SHOW_DATA_STREAM ,
                                    'label' => qa_lang('flb_like_box/m_show_stream_label'),
                                    'type'  => 'select',
                                    'tags'  => 'name="flb_like_modal_data_stream"',
                                    'value' => qa_opt(self::MODAL_SHOW_DATA_STREAM),
                                    'options' => array(
                                          'false' => 'false',
                                          'true'  =>  'true',
                                    ),
                    ),

                    self::MODAL_HEIGHT => array(
                                    'id' => self::MODAL_HEIGHT ,
                                    'label' => qa_lang('flb_like_box/m_like_modal_height_label'),
                                    'type'  => 'text',
                                    'tags'  => 'name="flb_like_modal_height"',
                                    'value' => (!!qa_opt(self::MODAL_HEIGHT)) ? qa_opt(self::MODAL_HEIGHT) : 300 , /*this default value is to fit for Snow theme */
                    ),
                     self::MODAL_WIDTH => array(
                                    'id' => self::MODAL_WIDTH ,
                                    'label' => qa_lang('flb_like_box/m_like_modal_width_label'),
                                    'type'  => 'text',
                                    'tags'  => 'name="flb_like_modal_width"',
                                    'value' => (!!qa_opt(self::MODAL_WIDTH)) ? qa_opt(self::MODAL_WIDTH) : 200 , /*this default value is to fit for Snow theme */
                    ),
                   self::MODAL_DELAY => array(
                                    'id' => self::MODAL_DELAY ,
                                    'label' => qa_lang('flb_like_box/m_like_modal_delay'),
                                    'type'  => 'text',
                                    'tags'  => 'name="flb_modal_delay"',
                                    'value' =>  qa_opt(self::MODAL_DELAY),
                                    'note'  =>  qa_lang('flb_like_box/m_like_modal_cookie_expire_note'),
                    ),

                    self::MODAL_COOKIE_EXPIRE => array(
                                    'id' => self::MODAL_COOKIE_EXPIRE ,
                                    'label' => qa_lang('flb_like_box/m_like_modal_cookie_expire'),
                                    'type'  => 'text',
                                    'tags'  => 'name="flb_modal_cookie_expire"',
                                    'value' =>  qa_opt(self::MODAL_COOKIE_EXPIRE),
                                    'note'  =>  qa_lang('flb_like_box/m_like_modal_cookie_expire_note'),
                    ),
                    self::MODAL_HEADER_MAIN_TEXT => array(
                                    'id' => self::MODAL_HEADER_MAIN_TEXT ,
                                    'label' => qa_lang('flb_like_box/m_pop_up_header_text'),
                                    'type'  => 'textarea',
                                    'rows'  => 4 ,
                                    'tags'  => 'name="flb_modal_header_main_text"',
                                    'value' =>  qa_opt(self::MODAL_HEADER_MAIN_TEXT),
                    ),

                   self::MODAL_FOOTER_TEXT => array(
                                    'id' => self::MODAL_FOOTER_TEXT ,
                                    'label' => qa_lang('flb_like_box/m_pop_up_footer_text'),
                                    'type'  => 'textarea',
                                    'rows'  => 4 ,
                                    'tags'  => 'name="flb_modal_header_footer_text"',
                                    'value' =>  qa_opt(self::MODAL_FOOTER_TEXT),
                    ),
                   self::MODAL_COSTUM_CSS => array(
                                    'id' => self::MODAL_COSTUM_CSS ,
                                    'label' => qa_lang('flb_like_box/m_costum_css'),
                                    'type'  => 'textarea',
                                    'rows'  => 4 ,
                                    'tags'  => 'name="flb_modal_costum_css"',
                                    'value' =>  qa_opt(self::MODAL_COSTUM_CSS),
                                    'note' => qa_lang_html('flb_like_box/m_costum_css_note'),
                    ),
                ),

				'buttons' => array(
      					array(
      						'label' => 'Save Changes',
      						'tags' => 'name="fb_like_box_save_btn"',
      					),
				 ),
			);
		}


		function output_widget($region, $place, $themeobject, $template, $request, $qa_content)
		{
            $has_error     = false ;
            $error_message = "" ;
            $widget_opt    = qa_get_options(array('facebook_app_id',self::SHOW_FB_LIKE_BOX ,
                                                  self::SHOW_FB_LIKE_MODAL ,self::FACEBOOK_PAGE_URL,
                                                  self::LIKE_BOX_COLOR_SCHEME,
                                                  self::LIKE_BOX_SHOW_HEADER,self::LIKE_BOX_SHOW_BORDER,
                                                  self::LIKE_BOX_SHOW_FACES, self::LIKE_BOX_SHOW_DATA_STREAM,self::LIKE_BOX_HEIGHT,
                                                  self::LIKE_BOX_WIDTH ,
                                                  self::MODAL_USE_CSS_FROM_THEME, self::MODAL_COLOR_SCHEME,
                                                  self::MODAL_SHOW_HEADER, self::MODAL_SHOW_BORDER,
                                                  self::MODAL_SHOW_FACES, self::MODAL_SHOW_DATA_STREAM,
                                                  self::MODAL_HEIGHT, self::MODAL_WIDTH,
                                                  self::MODAL_COOKIE_EXPIRE, self::MODAL_HEADER_MAIN_TEXT,
                                                  self::MODAL_DISPLAY_EVERY_TIME, self::MODAL_FOOTER_TEXT,
                                                  self::MODAL_COSTUM_CSS,
                                                  ));

            $fb_page_url            = $this->get_fb_settings($widget_opt , 'url') ;
            $show_fb_like_box       = $this->get_fb_settings($widget_opt , 'show_fb_like_box') ;
            $show_fb_like_box_modal = $this->get_fb_settings($widget_opt , 'show_fb_like_modal') ;

            if (empty($fb_page_url)) {
                  $has_error = true ;
                  $error_message = qa_lang('flb_like_box/plz_provide_fb_url') ;
            }

            if (!$has_error) {
                if ($show_fb_like_box) {
                   $themeobject->output($this->get_facebook_like_box($widget_opt));
                }
                if ($show_fb_like_box_modal) {
                   $themeobject->output($this->get_facebook_like_modal($widget_opt));
                }

            } else {
               $themeobject->output('<div class="qa-sidebar error" style="color:red;">'.$error_message.'</div>');
            }

		}
    function get_facebook_like_box($widget_opt)
    {
        // get the facebook like box settings
        $facebook_app_id =  $this->get_fb_settings($widget_opt , 'facebook_app_id') ;
        $fb_page_url     =  $this->get_fb_settings($widget_opt , 'url') ;
        $colorscheme     =  $this->get_fb_settings($widget_opt , 'colorscheme') ;
        $header          =  $this->get_fb_settings($widget_opt , 'header') ;
        $show_border     =  $this->get_fb_settings($widget_opt , 'show_border') ;
        $show_faces      =  $this->get_fb_settings($widget_opt , 'show_faces') ;
        $stream          =  $this->get_fb_settings($widget_opt , 'stream') ;
        $height          =  $this->get_fb_settings($widget_opt , 'height') ;
        $width           =  $this->get_fb_settings($widget_opt , 'width') ;

        $data['href']        = 'data-href="'.$fb_page_url.'"' ;
        $data['force_wall']  = 'data-force-wall="false"' ;
        $data['colorscheme'] = 'data-colorscheme="'.$colorscheme.'"' ;
        $data['header']      = 'data-header="'.$header.'"' ;
        $data['show_border'] = 'data-show-border="'.$show_border.'"' ;
        $data['show_faces']  = 'data-show-faces="'.$show_faces.'"' ;
        $data['stream']      = 'data-stream="'.$stream.'"' ;
        $data['height']      = 'data-height="'.$height.'"' ;
        $data['width']       = 'data-width="'.$width.'"' ;

        $data_str        = implode(' ', $data ) ;
        $fb_like_box     = '<div class="fb-like-box" '.$data_str.'> </div>'  ;
        $facebook_app_id = qa_opt('facebook_app_id');

        if (!$facebook_app_id) {
            // if the facebook app id is not set set it with app id given by the Facebook
            $facebook_app_id = "576492145800361" ;
        }

        ob_start();
            ?>
              <!--  widget start  -->
                  <div id="fb-root"></div>
                  <script>(function(d, s, id) {
                    var js, fjs = d.getElementsByTagName(s)[0];
                    if (d.getElementById(id)) return;
                    js = d.createElement(s); js.id = id;
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

    function get_facebook_like_modal($widget_opt)
    {
        // get the facebook like box settings
        $facebook_app_id    =  $this->get_fb_settings($widget_opt , 'facebook_app_id') ;
        $fb_page_url        =  $this->get_fb_settings($widget_opt , 'm_url') ;
        $colorscheme        =  $this->get_fb_settings($widget_opt , 'm_colorscheme') ;
        $header             =  $this->get_fb_settings($widget_opt , 'm_header') ;
        $show_border        =  $this->get_fb_settings($widget_opt , 'm_show_border') ;
        $show_faces         =  $this->get_fb_settings($widget_opt , 'm_show_faces') ;
        $stream             =  $this->get_fb_settings($widget_opt , 'm_stream') ;
        $height             =  $this->get_fb_settings($widget_opt , 'm_height') ;
        $width              =  $this->get_fb_settings($widget_opt , 'm_width') ;
        $cookie_expire      =  $this->get_fb_settings($widget_opt , 'm_cookie_expire') ;
        $delay              =  $this->get_fb_settings($widget_opt , 'm_delay') ;
        $header_main_text   =  @$widget_opt[self::MODAL_HEADER_MAIN_TEXT] ;
        $footer_text        =  @$widget_opt[self::MODAL_FOOTER_TEXT] ;
        $use_css_from_theme =  @$widget_opt[self::MODAL_USE_CSS_FROM_THEME] ;
        $costum_css         =  @$widget_opt[self::MODAL_COSTUM_CSS] ;
        $show_on_every_load =  @$widget_opt[self::MODAL_DISPLAY_EVERY_TIME] ;

        $css = "" ;
        //'//www.facebook.com/plugins/likebox.php?href=http://www.facebook.com/queryhandlers&width=290&height=275&colorscheme=light&show_faces=true&border_color=%23ffffff&stream=false&header=false'
        $data['href']         = $fb_page_url ;
        $data['force_wall']   = 'force_wall=false' ;
        $data['colorscheme']  = 'colorscheme='.$colorscheme.'' ;
        $data['header']       = 'header='.$header.'' ;
        $data['show_border']  = 'show_border='.$show_border.'' ;
        $data['show_faces']   = 'show_faces='.$show_faces.'' ;
        $data['stream']       = 'stream='.$stream.'' ;
        $data['height']       = 'height='.$height.'' ;
        $data['width']        = 'width='.$width.'' ;
        $data['border_color'] = 'border_color=%23ffffff' ;

        $src_str        = implode('&', $data ) ;

        $facebook_app_id = qa_opt('facebook_app_id');


        if (!$facebook_app_id) {
            // if the facebook app id is not set set it with app id given by the Facebook
            $facebook_app_id = "576492145800361" ;
        }
        if (!$use_css_from_theme) {
            // if not using css from  theme put these default styling
            $css = '#fb-back {display: none; background: rgba(0,0,0,0.8); width: 100%; height: 100%; position: fixed; top: 0; left: 0; z-index: 99999; } #fb-exit {width: 100%; height: 100%; } .fb-box-inner {width:300px; position: relative; display:block; padding: 20px 0px 0px; margin:0 auto; text-align:center; } #fb-close {cursor: pointer; position: absolute; top: 10px; right: -10px; font-size: 18px; font-weight:700; color: #000; z-index: 99999; display:inline-block; line-height: 18px; height:18px; width: 18px; } #fb-close:hover {color:#06c; } #fb-box {min-width: 340px; min-height: 360px; position: absolute; top: 50%; left: 50%; margin: -220px 0 0 -170px; -webkit-box-shadow: 0px 0px 16px #000; -moz-box-shadow: 0px 0px 16px #000; box-shadow: 0px 0px 16px #000; -webkit-border-radius: 8px;- moz-border-radius: 8px; border-radius: 8px; background: #fff; /* pop up box bg color */ border-bottom: 40px solid #f0f0f0; /* pop up bottom border color/size */ } .fb-box-inner h3 {line-height: 1; margin:0 auto; text-transform:none; letter-spacing:none; font-size: 23px!important; /* header size */ color:#06c!important; /* header color */ } .fb-box-inner p {line-height: 1; margin:5px auto 5px; text-transform:none; letter-spacing:none; font-size: 13px!important; /* header size  */ color:#333!important; /* text color */ } a.fb-link {position:relative; margin: 0 auto; display: block; text-align:center; color: #333; /* link color */ bottom: -30px; } #fb-footer-txt {position:relative; margin: 0 auto; display: block; text-align:center; color: #333; /* link color */ bottom: -30px; } #fb-header-txt{margin-bottom: 10px ; } #fb-box h3,#fb-box p, a.fb-link { max-width:290px; padding:0; }' ;
        }
        if ($show_on_every_load) {
            // set the cookie expire time to zero if $show on every load is enabled
            $cookie_expire = 0 ;
        }
        $css .= $costum_css ;


        ob_start();
            ?>
              <!--  Facebook Like Modal start  -->
                  <!-- popup box stylings -->
                  <style type="text/css">
                          <?php echo $css ; ?>
                  </style>

                  <!-- facebook plugin -->
                  <div id='fb-back'>
                      <div id="fb-exit"> </div>
                      <div id='fb-box'>
                           <div class="fb-box-inner">

                                 <div id="fb-header-txt">
                                      <div id="fb-close">&times;</div>
                                      <?php echo $header_main_text ?>
                                 </div>
                                      <!-- IFrame starts here -->
                                       <iframe allowtransparency='true' frameborder='0' scrolling='no' src='<?php echo $src_str ; ?>'style='border: 0 none; overflow: hidden; width: 290px; height: 270px;text-align:center;margin:0 auto;'></iframe>
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
                  if (typeof(jQuery.cookie)=="undefined") {
                    jQuery.cookie = function (key, value, options) { if (arguments.length > 1 && String(value) !== "[object Object]") { options = jQuery.extend({}, options); if (value === null || value === undefined) { options.expires = -1; }
                    if (typeof options.expires === 'number') { var days = options.expires,  t = options.expires = new Date();  t.setDate(t.getDate() + days); } value = String(value); return (document.cookie = [encodeURIComponent(key), '=', options.raw ? value : encodeURIComponent(value), options.expires ? '; expires=' + options.expires.toUTCString() : '', options.path ? '; path=' + options.path : '', options.domain ? '; domain=' + options.domain : '', options.secure ? '; secure' : ''].join('')); }
                    options = value || {}; var result, decode = options.raw ? function (s) { return s; } : decodeURIComponent; return (result = new RegExp('(?:^|; )' + encodeURIComponent(key) + '=([^;]*)').exec(document.cookie)) ? decode(result[1]) : null; };
                  };

                  // the pop up actions
                  $(function ($) {
                    if ($.cookie('popup_fb') != 'yes') {
                      $('#fb-back').delay(<?php echo $delay; ?>).fadeIn("slow"); // options slow or fast
                      $('#fb-close, #fb-exit').click(function () {
                        $('#fb-back').stop().fadeOut("slow"); // options slow or fast
                      });
                   }
                  //initiate popup function by setting up the cookie expiring time
                  $.cookie('popup_fb', 'yes', { path: '/', expires: <?php echo $cookie_expire ?> });
                  });
                  //]]>
                  </script>
                  <!-- facebook like box ends -->
              <!--  Facebook Like Modal ends  -->
            <?php
        return ob_get_clean();
    }

	function get_fb_settings($widget_opt , $opt )
     {
          $value = "" ;
           switch ($opt) {
                 case 'url':
                 case 'href':
                       $value = isset($widget_opt[self::FACEBOOK_PAGE_URL]) && !empty($widget_opt[self::FACEBOOK_PAGE_URL]) ? 'https://www.facebook.com/'.$widget_opt[self::FACEBOOK_PAGE_URL] : "" ;
                       break;

                 case 'facebook_app_id':
                       $value = isset($widget_opt['facebook_app_id']) && !empty($widget_opt['facebook_app_id']) ? $widget_opt['facebook_app_id'] : "" ;
                       break;

                 case 'show_fb_like_box':
                       $value = isset($widget_opt[self::SHOW_FB_LIKE_BOX]) && !empty($widget_opt[self::SHOW_FB_LIKE_BOX]) ? !!$widget_opt[self::SHOW_FB_LIKE_BOX] : false ;
                       break;

                 case 'show_fb_like_modal':
                       $value = isset($widget_opt[self::SHOW_FB_LIKE_MODAL]) && !empty($widget_opt[self::SHOW_FB_LIKE_MODAL]) ? !!$widget_opt[self::SHOW_FB_LIKE_MODAL] : false ;
                       break;

                 case 'colorscheme':
                       $value         = isset($widget_opt[self::LIKE_BOX_COLOR_SCHEME]) && !empty($widget_opt[self::LIKE_BOX_COLOR_SCHEME]) ? $widget_opt[self::LIKE_BOX_COLOR_SCHEME] : "" ;
                       $allowed_value = array('light' , 'dark'); /*allow only these values*/
                       if (!$value || !in_array($value , $allowed_value )) {
                             $value = "light" ;
                       }
                       break;

                 case 'header':
                       $value         = isset($widget_opt[self::LIKE_BOX_SHOW_HEADER]) && !empty($widget_opt[self::LIKE_BOX_SHOW_HEADER]) ? $widget_opt[self::LIKE_BOX_SHOW_HEADER] : "" ;
                       $allowed_value = array('true' , 'false'); /*allow only these values*/
                       if (!$value || !in_array($value , $allowed_value )) {
                             $value = "true" ;
                       }
                       break;

                 case 'show_border':
                       $value         = isset($widget_opt[self::LIKE_BOX_SHOW_BORDER]) && !empty($widget_opt[self::LIKE_BOX_SHOW_BORDER]) ? $widget_opt[self::LIKE_BOX_SHOW_BORDER] : "" ;
                       $allowed_value = array('true' , 'false'); /*allow only these values*/
                       if (!$value || !in_array($value , $allowed_value )) {
                             $value = "true" ;
                       }
                       break;

                 case 'show_faces':
                       $value         = isset($widget_opt[self::LIKE_BOX_SHOW_FACES]) && !empty($widget_opt[self::LIKE_BOX_SHOW_FACES]) ? $widget_opt[self::LIKE_BOX_SHOW_FACES] : "" ;
                       $allowed_value = array('true' , 'false'); /*allow only these values*/
                       if (!$value || !in_array($value , $allowed_value )) {
                             $value = "true" ;
                       }
                       break;

                 case 'stream':
                       $value         = isset($widget_opt[self::LIKE_BOX_SHOW_DATA_STREAM]) && !empty($widget_opt[self::LIKE_BOX_SHOW_DATA_STREAM]) ? $widget_opt[self::LIKE_BOX_SHOW_DATA_STREAM] : "" ;
                       $allowed_value = array('true' , 'false'); /*allow only these values*/
                       if (!$value || !in_array($value , $allowed_value )) {
                             $value = "false" ;
                       }
                       break;

                 case 'height':
                       $value = isset($widget_opt[self::LIKE_BOX_HEIGHT]) && !empty($widget_opt[self::LIKE_BOX_HEIGHT]) ? $widget_opt[self::LIKE_BOX_HEIGHT] : "" ;
                       if ($this->get_fb_settings($widget_opt , "data_stream") && $this->get_fb_settings($widget_opt , "show_faces")   ) {
                             // if both are true min height is 556px
                             $min_height = 556 ;
                       }elseif (!$this->get_fb_settings($widget_opt , "data_stream") && !$this->get_fb_settings($widget_opt , "show_faces") ) {
                             // if both are false min height is 63px
                             $min_height = 63 ;
                       }else {
                             // otherwise
                             $min_height = 300 ;
                       }

                       if (!$value || $value < $min_height ) {
                             $value = $min_height ;
                       }
                       break;

                 case 'width':
                       $value     = isset($widget_opt[self::LIKE_BOX_WIDTH]) && !empty($widget_opt[self::LIKE_BOX_WIDTH]) ? $widget_opt[self::LIKE_BOX_WIDTH] : "" ;
                       $min_width = 190 ; /*allow only these values*/
                       if (!$value || $value < $min_width) {
                             $value = $min_width ;
                       }
                       break;

                 case 'm_url':
                 case 'm_href':
                       $value = isset($widget_opt[self::FACEBOOK_PAGE_URL]) && !empty($widget_opt[self::FACEBOOK_PAGE_URL]) ? '//www.facebook.com/plugins/likebox.php?href=http://www.facebook.com/'.$widget_opt[self::FACEBOOK_PAGE_URL] : "" ;
                       break;

                 case 'm_colorscheme':
                       $value         = isset($widget_opt[self::MODAL_COLOR_SCHEME]) && !empty($widget_opt[self::MODAL_COLOR_SCHEME]) ? $widget_opt[self::MODAL_COLOR_SCHEME] : "" ;
                       $allowed_value = array('light' , 'dark'); /*allow only these values*/
                       if (!$value || !in_array($value , $allowed_value )) {
                             $value = "light" ;
                       }
                       break;

                 case 'm_header':
                       $value         = isset($widget_opt[self::MODAL_SHOW_HEADER]) && !empty($widget_opt[self::MODAL_SHOW_HEADER]) ? $widget_opt[self::MODAL_SHOW_HEADER] : "" ;
                       $allowed_value = array('true' , 'false'); /*allow only these values*/
                       if (!$value || !in_array($value , $allowed_value )) {
                             $value = "true" ;
                       }
                       break;

                 case 'm_show_border':
                       $value         = isset($widget_opt[self::MODAL_SHOW_BORDER]) && !empty($widget_opt[self::MODAL_SHOW_BORDER]) ? $widget_opt[self::MODAL_SHOW_BORDER] : "" ;
                       $allowed_value = array('true' , 'false'); /*allow only these values*/
                       if (!$value || !in_array($value , $allowed_value )) {
                             $value = "true" ;
                       }
                       break;

                 case 'm_show_faces':
                       $value         = isset($widget_opt[self::MODAL_SHOW_FACES]) && !empty($widget_opt[self::MODAL_SHOW_FACES]) ? $widget_opt[self::MODAL_SHOW_FACES] : "" ;
                       $allowed_value = array('true' , 'false'); /*allow only these values*/
                       if (!$value || !in_array($value , $allowed_value )) {
                             $value = "true" ;
                       }
                       break;

                 case 'm_stream':
                       $value         = isset($widget_opt[self::MODAL_SHOW_DATA_STREAM]) && !empty($widget_opt[self::MODAL_SHOW_DATA_STREAM]) ? $widget_opt[self::MODAL_SHOW_DATA_STREAM] : "" ;
                       $allowed_value = array('true' , 'false'); /*allow only these values*/
                       if (!$value || !in_array($value , $allowed_value )) {
                             $value = "false" ;
                       }
                       break;

                 case 'm_height':
                       $value = isset($widget_opt[self::MODAL_HEIGHT]) && !empty($widget_opt[self::MODAL_HEIGHT]) ? $widget_opt[self::MODAL_HEIGHT] : "" ;
                       if ($this->get_fb_settings($widget_opt , "data_stream") && $this->get_fb_settings($widget_opt , "show_faces")   ) {
                             // if both are true min height is 556px
                             $min_height = 556 ;
                       }elseif (!$this->get_fb_settings($widget_opt , "data_stream") && !$this->get_fb_settings($widget_opt , "show_faces") ) {
                             // if both are false min height is 63px
                             $min_height = 175 ;
                       }else {
                             // otherwise
                             $min_height = 275 ;
                       }

                       if (!$value || $value < $min_height ) {
                             $value = $min_height ;
                       }
                       break;

                 case 'm_width':
                       $value     = isset($widget_opt[self::MODAL_WIDTH]) && !empty($widget_opt[self::MODAL_WIDTH]) ? $widget_opt[self::MODAL_WIDTH] : "" ;
                       $min_width = 300 ; /*allow only these values*/
                       if (!$value || $value < $min_width) {
                             $value = $min_width ;
                       }
                       break;
                 case 'm_delay':
                       $value     = isset($widget_opt[self::MODAL_DELAY]) && !empty($widget_opt[self::MODAL_DELAY]) ? $widget_opt[self::MODAL_DELAY] : 10 /*10 seconds by default*/ ;
                       $min_delay = 5 ; /*allow only these values*/
                       if (!$value || $value < $min_delay) {
                             $value = $min_delay ;
                       }
                       $value = $value * 1000 ; /*make it to milli seconds */
                       break;

                  case 'm_cookie_expire':
                       $value     = isset($widget_opt[self::MODAL_COOKIE_EXPIRE]) && !empty($widget_opt[self::MODAL_COOKIE_EXPIRE]) ? $widget_opt[self::MODAL_COOKIE_EXPIRE] : 30 /*by default 30*/ ;
                       break;
                 default:
                       break;
           }
           return $value ;
       }

       function allow_template($template)
       {
        return ($template!='admin');
       }


       function allow_region($region)
       {
        $allow=false;

        switch ($region)
        {
            case 'main':
            case 'side':
            case 'full':
                $allow=true;
                break;
        }

        return $allow;
       }

	}


/*
	Omit PHP closing tag to help avoid accidental output
*/
