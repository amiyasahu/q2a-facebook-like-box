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

		
		function admin_form(&$qa_content)
		{
			$saved=false;
			
			if (qa_clicked('fb_like_box_save_btn')) {	
				qa_opt('flb_page_url' , qa_post_text('flb_page_url')) ;
				qa_opt('flb_like_box_colorscheme' , qa_post_text('flb_like_box_colorscheme')) ;
				qa_opt('flb_like_box_header' , qa_post_text('flb_like_box_header')) ;
				qa_opt('flb_like_box_show_border' , qa_post_text('flb_like_box_show_border')) ;
				qa_opt('flb_like_box_show_faces' , qa_post_text('flb_like_box_show_faces')) ;
				qa_opt('flb_like_box_data_stream' , qa_post_text('flb_like_box_data_stream')) ;
				qa_opt('flb_like_box_height' , qa_post_text('flb_like_box_height')) ;
				qa_opt('flb_like_box_width' , qa_post_text('flb_like_box_width')) ;
				
				$saved=true;
			}
			
			return array(
				'ok' => $saved ? qa_lang('flb_like_box/settings_saved') : null,
				
				'fields' => array(
                    'flb_page_url' => array(
                                    'label' => qa_lang('flb_like_box/ur_fb_page_url'),
                                    'type'  => 'text',
                                    'tags'  => 'name="flb_page_url"',
                                    'value' =>  qa_opt('flb_page_url'),
                    ),
                    'flb_like_box_colorscheme' => array(
                                    'label' => qa_lang('flb_like_box/colorscheme_label'),
                                    'type'  => 'select',
                                    'tags'  => 'name="flb_like_box_colorscheme"',
                                    'value' => qa_opt('flb_like_box_colorscheme'),
                                    'options' => array(
                                          'light' => 'light',
                                          'dark'  => 'dark',
                                    ),
                    ),
                   'flb_like_box_header' => array(
                                    'label' => qa_lang('flb_like_box/box_header_label'),
                                    'type'  => 'select',
                                    'tags'  => 'name="flb_like_box_header"',
                                    'value' => qa_opt('flb_like_box_header'),
                                    'options' => array(
                                       	  'false' => 'false',
                                          'true'  => 'true' ,
                                    ),
                    ),
                   'flb_like_box_show_border' => array(
                                    'label' => qa_lang('flb_like_box/show_border_label'),
                                    'type'  => 'select',
                                    'tags'  => 'name="flb_like_box_show_border"',
                                    'value' =>  qa_opt('flb_like_box_show_border'),
                                    'options' => array(
                                    	  'false' => 'false',
                                        'true'  =>'true',
                                    ),
                    ),
                    'flb_like_box_show_faces' => array(
                                    'label' => qa_lang('flb_like_box/show_faces_label'),
                                    'type'  => 'select',
                                    'tags'  => 'name="flb_like_box_show_faces"',
                                    'value' => qa_opt('flb_like_box_show_faces'),
                                    'options' => array(
                                          'true'  =>'true',
                                          'false' =>'false',
                                    ),
                    ),
                   'flb_like_box_data_stream' => array(
                        						'label' => qa_lang('flb_like_box/show_stream_label'),
                        						'type'  => 'select',
                        						'tags'  => 'name="flb_like_box_data_stream"',
                        						'value' => qa_opt('flb_like_box_data_stream'),
                        						'options' => array(
                                          'false' => 'false',
                                          'true'  =>  'true',
                        						),
                    ),

                    'flb_like_box_height' => array(
                                    'label' => qa_lang('flb_like_box/like_box_height_label'),
                                    'type'  => 'text',
                                    'tags'  => 'name="flb_like_box_height"',
                                    'value' => (!!qa_opt('flb_like_box_height')) ? qa_opt('flb_like_box_height') : 320 , /*this default value is to fit for Snow theme */
                    ),
                     'flb_like_box_width' => array(
                        						'label' => qa_lang('flb_like_box/like_box_width_label'),
                        						'type'  => 'text',
                        						'tags'  => 'name="flb_like_box_width"',
                        						'value' => (!!qa_opt('flb_like_box_width')) ? qa_opt('flb_like_box_width') : 200 , /*this default value is to fit for Snow theme */
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

			      $widget_opt  = qa_get_options(array('flb_page_url','flb_like_box_colorscheme','flb_like_box_header','flb_like_box_show_border','flb_like_box_show_faces','flb_like_box_data_stream','flb_like_box_height','flb_like_box_width'));
            $fb_page_url = $this->get_fb_settings($widget_opt , 'url') ;	
            
            if (!$fb_page_url) {
                  return false;
            }

            // get the other settings 
            $colorscheme =  $this->get_fb_settings($widget_opt , 'colorscheme') ; 
            $header      =  $this->get_fb_settings($widget_opt , 'header') ; 
            $show_border =  $this->get_fb_settings($widget_opt , 'show_border') ; 
            $show_faces  =  $this->get_fb_settings($widget_opt , 'show_faces') ; 
            $stream      =  $this->get_fb_settings($widget_opt , 'stream') ; 
            $height      =  $this->get_fb_settings($widget_opt , 'height') ; 
            $width       =  $this->get_fb_settings($widget_opt , 'width') ; 

            $data['href']        = 'data-href="'.$fb_page_url.'"' ;
            $data['force_wall']  = 'data-force-wall="false"' ;
            $data['colorscheme'] = 'data-colorscheme="'.$colorscheme.'"' ;
            $data['header']      = 'data-header="'.$header.'"' ;
            $data['show_border'] = 'data-show-border="'.$show_border.'"' ;
            $data['show_faces']  = 'data-show-faces="'.$show_faces.'"' ;
            $data['stream']      = 'data-stream="'.$stream.'"' ;
            $data['height']      = 'data-height="'.$height.'"' ;
            $data['width']       = 'data-width="'.$width.'"' ;
            $data_str = implode(' ', $data ) ;
            
            $fb_like_box =   '<div class="fb-like-box" '.$data_str.'> </div>'  ;
            
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

            $themeobject->output(ob_get_clean());
                       
		}
    
		function get_fb_settings($widget_opt , $opt )
       {
            $value = "" ;
             switch ($opt) {
                   case 'url':
                   case 'href':
                         $value = isset($widget_opt['flb_page_url']) ? $widget_opt['flb_page_url'] : "" ;
                         break;
                   case 'colorscheme':
                         $value         = isset($widget_opt['flb_like_box_colorscheme']) ? $widget_opt['flb_like_box_colorscheme'] : "" ;
                         $allowed_value = array('light' , 'dark'); /*allow only these values*/
                         if (!$value || !in_array($value , $allowed_value )) {
                               $value = "light" ;
                         }
                         break;
                   case 'header':
                         $value         = isset($widget_opt['flb_like_box_header']) ? $widget_opt['flb_like_box_header'] : "" ;
                         $allowed_value = array('true' , 'false'); /*allow only these values*/
                         if (!$value || !in_array($value , $allowed_value )) {
                               $value = "true" ;
                         }
                         break;
                   case 'show_border':
                         $value         = isset($widget_opt['flb_like_box_show_border']) ? $widget_opt['flb_like_box_show_border'] : "" ;
                         $allowed_value = array('true' , 'false'); /*allow only these values*/
                         if (!$value || !in_array($value , $allowed_value )) {
                               $value = "true" ;
                         }
                         break;
                   case 'show_faces':
                         $value         = isset($widget_opt['flb_like_box_show_faces']) ? $widget_opt['flb_like_box_show_faces'] : "" ;
                         $allowed_value = array('true' , 'false'); /*allow only these values*/
                         if (!$value || !in_array($value , $allowed_value )) {
                               $value = "true" ;
                         }
                         break;
                   case 'stream':
                         $value         = isset($widget_opt['flb_like_box_data_stream']) ? $widget_opt['flb_like_box_data_stream'] : "" ;
                         $allowed_value = array('true' , 'false'); /*allow only these values*/
                         if (!$value || !in_array($value , $allowed_value )) {
                               $value = "false" ;
                         }
                         break;
                   case 'height':
                         $value = isset($widget_opt['flb_like_box_height']) ? $widget_opt['flb_like_box_height'] : "" ;
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
                         $value     = isset($widget_opt['flb_like_box_width']) ? $widget_opt['flb_like_box_width'] : "" ;
                         $min_width = 190 ; /*allow only these values*/
                         if (!$value || $value < $min_width) {
                               $value = $min_width ;
                         }
                         break;
                   
                   default:
                         break;
             }
             return $value ;
       }
	}
	

/*
	Omit PHP closing tag to help avoid accidental output
*/