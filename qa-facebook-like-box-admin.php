<?php

    /*
      Question2Answer (c) Gideon Greenspan
      Google Plus Badge (c) Amiya Sahu (developer.amiya@outlook.com)

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

    class qa_facebook_like_box_admin
    {

        const FACEBOOK_PAGE_URL = 'flb_page_url';
        const SHOW_FB_LIKE_BOX = 'flb_show_fb_like_box';
        const LIKE_BOX_COLOR_SCHEME = 'flb_like_box_colorscheme';
        const LIKE_BOX_SHOW_HEADER = 'flb_like_box_show_header';
        const LIKE_BOX_SHOW_BORDER = 'flb_like_box_show_border';
        const LIKE_BOX_SHOW_FACES = 'flb_like_box_show_faces';
        const LIKE_BOX_SHOW_DATA_STREAM = 'flb_like_box_data_stream';
        const LIKE_BOX_HEIGHT = 'flb_like_box_height';
        const LIKE_BOX_WIDTH = 'flb_like_box_width';
        const SHOW_FB_LIKE_MODAL = 'flb_show_fb_like_modal';
        const MODAL_COLOR_SCHEME = 'flb_like_modal_colorscheme';
        const MODAL_SHOW_HEADER = 'flb_like_modal_header';
        const MODAL_SHOW_BORDER = 'flb_like_modal_show_border';
        const MODAL_SHOW_FACES = 'flb_like_modal_show_faces';
        const MODAL_SHOW_DATA_STREAM = 'flb_like_modal_data_stream';
        const MODAL_HEIGHT = 'flb_like_modal_height';
        const MODAL_WIDTH = 'flb_like_modal_width';
        const MODAL_COOKIE_EXPIRE = 'flb_modal_cookie_expire';
        const MODAL_HEADER_MAIN_TEXT = 'flb_modal_header_main_text';
        const MODAL_FOOTER_TEXT = 'flb_modal_header_footer_text';
        const MODAL_USE_CSS_FROM_THEME = 'flb_use_css_from_theme_file';
        const MODAL_COSTUM_CSS = 'flb_modal_costum_css';
        const MODAL_DISPLAY_EVERY_TIME = 'flb_display_on_every_load';
        const MODAL_DELAY = 'flb_modal_delay';
        const SAVE_BUTTON = 'fb_like_box_save_btn';

        function admin_form( &$qa_content )
        {
            $saved = false;

            if ( qa_clicked( self::SAVE_BUTTON ) ) {
                qa_opt( self::FACEBOOK_PAGE_URL, qa_post_text( self::FACEBOOK_PAGE_URL ) );
                // for like box
                qa_opt( self::SHOW_FB_LIKE_BOX, ! !qa_post_text( self::SHOW_FB_LIKE_BOX ) );
                qa_opt( self::LIKE_BOX_COLOR_SCHEME, qa_post_text( self::LIKE_BOX_COLOR_SCHEME ) );
                qa_opt( self::LIKE_BOX_SHOW_HEADER, qa_post_text( self::LIKE_BOX_SHOW_HEADER ) );
                qa_opt( self::LIKE_BOX_SHOW_BORDER, qa_post_text( self::LIKE_BOX_SHOW_BORDER ) );
                qa_opt( self::LIKE_BOX_SHOW_FACES, qa_post_text( self::LIKE_BOX_SHOW_FACES ) );
                qa_opt( self::LIKE_BOX_SHOW_DATA_STREAM, qa_post_text( self::LIKE_BOX_SHOW_DATA_STREAM ) );
                qa_opt( self::LIKE_BOX_HEIGHT, qa_post_text( self::LIKE_BOX_HEIGHT ) );
                qa_opt( self::LIKE_BOX_WIDTH, qa_post_text( self::LIKE_BOX_WIDTH ) );
                // for modal
                qa_opt( self::SHOW_FB_LIKE_MODAL, ! !qa_post_text( self::SHOW_FB_LIKE_MODAL ) );
                qa_opt( self::MODAL_COLOR_SCHEME, qa_post_text( self::MODAL_COLOR_SCHEME ) );
                qa_opt( self::MODAL_SHOW_HEADER, qa_post_text( self::MODAL_SHOW_HEADER ) );
                qa_opt( self::MODAL_SHOW_BORDER, qa_post_text( self::MODAL_SHOW_BORDER ) );
                qa_opt( self::MODAL_SHOW_FACES, qa_post_text( self::MODAL_SHOW_FACES ) );
                qa_opt( self::MODAL_SHOW_DATA_STREAM, qa_post_text( self::MODAL_SHOW_DATA_STREAM ) );
                qa_opt( self::MODAL_HEIGHT, qa_post_text( self::MODAL_HEIGHT ) );
                qa_opt( self::MODAL_WIDTH, qa_post_text( self::MODAL_WIDTH ) );
                qa_opt( self::MODAL_COOKIE_EXPIRE, qa_post_text( self::MODAL_COOKIE_EXPIRE ) );
                qa_opt( self::MODAL_HEADER_MAIN_TEXT, qa_post_text( self::MODAL_HEADER_MAIN_TEXT ) );
                qa_opt( self::MODAL_FOOTER_TEXT, qa_post_text( self::MODAL_FOOTER_TEXT ) );
                qa_opt( self::MODAL_USE_CSS_FROM_THEME, ! !qa_post_text( self::MODAL_USE_CSS_FROM_THEME ) );
                qa_opt( self::MODAL_COSTUM_CSS, qa_post_text( self::MODAL_COSTUM_CSS ) );
                qa_opt( self::MODAL_DISPLAY_EVERY_TIME, ! !qa_post_text( self::MODAL_DISPLAY_EVERY_TIME ) );
                qa_opt( self::MODAL_DELAY, (int) qa_post_text( self::MODAL_DELAY ) );

                $saved = true;
            }
            qa_set_display_rules( $qa_content, array(
                // for facebook like box
                self::LIKE_BOX_COLOR_SCHEME     => self::SHOW_FB_LIKE_BOX,
                self::LIKE_BOX_SHOW_HEADER      => self::SHOW_FB_LIKE_BOX,
                self::LIKE_BOX_SHOW_BORDER      => self::SHOW_FB_LIKE_BOX,
                self::LIKE_BOX_SHOW_FACES       => self::SHOW_FB_LIKE_BOX,
                self::LIKE_BOX_SHOW_DATA_STREAM => self::SHOW_FB_LIKE_BOX,
                self::LIKE_BOX_HEIGHT           => self::SHOW_FB_LIKE_BOX,
                self::LIKE_BOX_WIDTH            => self::SHOW_FB_LIKE_BOX,
                // for facebook like modal
                self::MODAL_COLOR_SCHEME        => self::SHOW_FB_LIKE_MODAL,
                self::MODAL_SHOW_HEADER         => self::SHOW_FB_LIKE_MODAL,
                self::MODAL_SHOW_BORDER         => self::SHOW_FB_LIKE_MODAL,
                self::MODAL_SHOW_FACES          => self::SHOW_FB_LIKE_MODAL,
                self::MODAL_SHOW_DATA_STREAM    => self::SHOW_FB_LIKE_MODAL,
                self::MODAL_HEIGHT              => self::SHOW_FB_LIKE_MODAL,
                self::MODAL_WIDTH               => self::SHOW_FB_LIKE_MODAL,
                self::MODAL_COOKIE_EXPIRE       => self::SHOW_FB_LIKE_MODAL,
                self::MODAL_HEADER_MAIN_TEXT    => self::SHOW_FB_LIKE_MODAL,
                self::MODAL_FOOTER_TEXT         => self::SHOW_FB_LIKE_MODAL,
                self::MODAL_USE_CSS_FROM_THEME  => self::SHOW_FB_LIKE_MODAL,
                self::MODAL_COSTUM_CSS          => self::SHOW_FB_LIKE_MODAL,
                self::MODAL_DISPLAY_EVERY_TIME  => self::SHOW_FB_LIKE_MODAL,
                self::MODAL_DELAY               => self::SHOW_FB_LIKE_MODAL,
            ) );

            return array(
                'ok'      => $saved ? qa_lang( 'flb_like_box/settings_saved' ) : null,

                'fields'  => array(
                    self::FACEBOOK_PAGE_URL         => $this->get_fb_page_url_field(),
                    self::SHOW_FB_LIKE_BOX          => $this->get_show_likebox_field(),
                    self::LIKE_BOX_COLOR_SCHEME     => $this->get_lokebox_color_scheme_field(),
                    self::LIKE_BOX_SHOW_HEADER      => $this->get_likebox_show_header_field(),
                    self::LIKE_BOX_SHOW_BORDER      => $this->get_likebox_show_border_field(),
                    self::LIKE_BOX_SHOW_FACES       => $this->get_likebox_show_faces_field(),
                    self::LIKE_BOX_SHOW_DATA_STREAM => $this->get_likebox_show_data_stream(),
                    self::LIKE_BOX_HEIGHT           => $this->get_likebox_height_field(),
                    self::LIKE_BOX_WIDTH            => $this->get_likebox_width_field(),
                    //settings for facebook like box ends here
                    self::SHOW_FB_LIKE_MODAL        => $this->get_show_like_modal_field(),
                    self::MODAL_USE_CSS_FROM_THEME  => $this->get_like_modal_use_css_from_theme_field(),
                    self::MODAL_DISPLAY_EVERY_TIME  => $this->get_like_modal_display_every_time_field(),
                    self::MODAL_COLOR_SCHEME        => $this->get_like_modal_color_scheme_field(),
                    self::MODAL_SHOW_HEADER         => $this->get_like_modal_show_header_field(),
                    self::MODAL_SHOW_BORDER         => $this->get_like_modal_show_border_field(),
                    self::MODAL_SHOW_FACES          => $this->get_like_modal_show_faces_field(),
                    self::MODAL_SHOW_DATA_STREAM    => $this->get_like_modal_show_data_stream_field(),
                    self::MODAL_HEIGHT              => $this->get_like_modal_height_field(),
                    self::MODAL_WIDTH               => $this->get_like_modal_width_field(),
                    self::MODAL_DELAY               => $this->get_like_modal_delay_field(),
                    self::MODAL_COOKIE_EXPIRE       => $this->get_like_modal_cookie_expire_field(),
                    self::MODAL_HEADER_MAIN_TEXT    => $this->get_like_modal_header_main_text_field(),
                    self::MODAL_FOOTER_TEXT         => $this->get_like_modal_footer_text_field(),
                    self::MODAL_COSTUM_CSS          => $this->get_like_modal_custom_css_field(),
                ),

                'buttons' => $this->get_admin_buttons(),
            );
        }

        function option_default( $option )
        {

            switch ( $option ) {
                case self::SHOW_FB_LIKE_BOX:
                    return 1;
                case self::FACEBOOK_PAGE_URL:
                    return 'FacebookDevelopers';
                case self::LIKE_BOX_COLOR_SCHEME:
                    return 'light';
                case self::LIKE_BOX_SHOW_HEADER:
                    return 'true';
                case self::LIKE_BOX_SHOW_BORDER:
                    return 'false';
                case self::LIKE_BOX_SHOW_FACES:
                    return 'true';
                case self::LIKE_BOX_SHOW_DATA_STREAM:
                    return 'false';
                case self::LIKE_BOX_HEIGHT:
                    return 300;
                case self::LIKE_BOX_WIDTH:
                    return 200;
                case self::SHOW_FB_LIKE_MODAL:
                    return 1;
                case self::MODAL_COLOR_SCHEME:
                    return 'light';
                case self::MODAL_SHOW_HEADER:
                    return 'false';
                case self::MODAL_SHOW_BORDER:
                    return 'true';
                case self::MODAL_SHOW_FACES:
                    return 'true';
                case self::MODAL_SHOW_DATA_STREAM:
                    return 'false';
                case self::MODAL_HEIGHT:
                    return 175;
                case self::MODAL_WIDTH:
                    return 300;
                case self::MODAL_COOKIE_EXPIRE:
                    return 30;
                case self::MODAL_HEADER_MAIN_TEXT:
                    return '<h3>Like us on Facebook</h3>
                            <p>Show your Support. Become a <b>FAN!</b></p>';
                case self::MODAL_FOOTER_TEXT:
                    return 'Thank you for visiting us';
                case self::MODAL_USE_CSS_FROM_THEME:
                    return 0;
                case self::MODAL_COSTUM_CSS:
                    return "/*enter css here*/";
                case self::MODAL_DISPLAY_EVERY_TIME:
                    return 0;
                case self::MODAL_DELAY:
                    return 5 /*5 seconds*/
                        ;
                default:
                    return null;
            }

        }

        function allow_template( $template )
        {
            return ( $template != 'admin' );
        }

        /**
         * @return array
         */
        private function get_fb_page_url_field()
        {
            return array(
                'label' => qa_lang( 'flb_like_box/ur_fb_page_url' ),
                'type'  => 'text',
                'tags'  => 'name="' . self::FACEBOOK_PAGE_URL . '"',
                'value' => qa_opt( self::FACEBOOK_PAGE_URL ),
                'note'  => qa_lang( 'flb_like_box/ur_fb_page_url_note' ),
            );
        }

        /**
         * @return array
         */
        private function get_show_likebox_field()
        {
            return array(
                'label' => qa_lang( 'flb_like_box/b_show_fb_like_box' ),
                'tags'  => 'name="' . self::SHOW_FB_LIKE_BOX . '" id="' . self::SHOW_FB_LIKE_BOX . '"',
                'value' => qa_opt( self::SHOW_FB_LIKE_BOX ),
                'type'  => 'checkbox',
            );
        }

        /**
         * @return array
         */
        private function get_lokebox_color_scheme_field()
        {
            return array(
                'id'      => self::LIKE_BOX_COLOR_SCHEME,
                'label'   => qa_lang( 'flb_like_box/b_colorscheme_label' ),
                'type'    => 'select',
                'tags'    => 'name="' . self::LIKE_BOX_COLOR_SCHEME . '"',
                'value'   => qa_opt( self::LIKE_BOX_COLOR_SCHEME ),
                'options' => array(
                    'light' => 'light',
                    'dark'  => 'dark',
                ),
            );
        }

        /**
         * @return array
         */
        private function get_likebox_show_header_field()
        {
            return array(
                'id'      => self::LIKE_BOX_SHOW_HEADER,
                'label'   => qa_lang( 'flb_like_box/b_box_header_label' ),
                'type'    => 'select',
                'tags'    => 'name="' . self::LIKE_BOX_SHOW_HEADER . '"',
                'value'   => qa_opt( self::LIKE_BOX_SHOW_HEADER ),
                'options' => array(
                    'false' => 'false',
                    'true'  => 'true',
                ),
            );
        }

        /**
         * @return array
         */
        private function get_likebox_show_border_field()
        {
            return array(
                'id'      => self::LIKE_BOX_SHOW_BORDER,
                'label'   => qa_lang( 'flb_like_box/b_show_border_label' ),
                'type'    => 'select',
                'tags'    => 'name="' . self::LIKE_BOX_SHOW_BORDER . '"',
                'value'   => qa_opt( self::LIKE_BOX_SHOW_BORDER ),
                'options' => array(
                    'false' => 'false',
                    'true'  => 'true',
                ),
            );
        }

        /**
         * @return array
         */
        private function get_likebox_show_faces_field()
        {
            return array(
                'id'      => self::LIKE_BOX_SHOW_FACES,
                'label'   => qa_lang( 'flb_like_box/b_show_faces_label' ),
                'type'    => 'select',
                'tags'    => 'name="' . self::LIKE_BOX_SHOW_FACES . '"',
                'value'   => qa_opt( self::LIKE_BOX_SHOW_FACES ),
                'options' => array(
                    'true'  => 'true',
                    'false' => 'false',
                ),
            );
        }

        /**
         * @return array
         */
        private function get_likebox_show_data_stream()
        {
            return array(
                'id'      => self::LIKE_BOX_SHOW_DATA_STREAM,
                'label'   => qa_lang( 'flb_like_box/b_show_stream_label' ),
                'type'    => 'select',
                'tags'    => 'name="' . self::LIKE_BOX_SHOW_DATA_STREAM . '"',
                'value'   => qa_opt( self::LIKE_BOX_SHOW_DATA_STREAM ),
                'options' => array(
                    'false' => 'false',
                    'true'  => 'true',
                ),
            );
        }

        /**
         * @return array
         */
        private function get_likebox_height_field()
        {
            return array(
                'id'    => self::LIKE_BOX_HEIGHT,
                'label' => qa_lang( 'flb_like_box/b_like_box_height_label' ),
                'type'  => 'text',
                'tags'  => 'name="' . self::LIKE_BOX_HEIGHT . '"',
                'value' => qa_opt( self::LIKE_BOX_HEIGHT ), /*this default value is to fit for Snow theme */
            );
        }

        /**
         * @return array
         */
        private function get_likebox_width_field()
        {
            return array(
                'id'    => self::LIKE_BOX_WIDTH,
                'label' => qa_lang( 'flb_like_box/b_like_box_width_label' ),
                'type'  => 'text',
                'tags'  => 'name="' . self::LIKE_BOX_WIDTH . '"',
                'value' => ( ! !qa_opt( self::LIKE_BOX_WIDTH ) ) ? qa_opt( self::LIKE_BOX_WIDTH ) : 200, /*this default value is to fit for Snow theme */
            );
        }

        /**
         * @return array
         */
        private function get_show_like_modal_field()
        {
            return array(
                'label' => qa_lang( 'flb_like_box/m_show_fb_like_modal' ),
                'tags'  => 'name="' . self::SHOW_FB_LIKE_MODAL . '" id="' . self::SHOW_FB_LIKE_MODAL . '"',
                'value' => qa_opt( self::SHOW_FB_LIKE_MODAL ),
                'type'  => 'checkbox',
            );
        }

        /**
         * @return array
         */
        private function get_like_modal_use_css_from_theme_field()
        {
            return array(
                'id'    => self::MODAL_USE_CSS_FROM_THEME,
                'label' => qa_lang( 'flb_like_box/m_use_css_from_theme_file' ),
                'tags'  => 'name="' . self::MODAL_USE_CSS_FROM_THEME . '"',
                'value' => qa_opt( self::MODAL_USE_CSS_FROM_THEME ),
                'type'  => 'checkbox',
            );
        }

        /**
         * @return array
         */
        private function get_like_modal_display_every_time_field()
        {
            return array(
                'id'    => self::MODAL_DISPLAY_EVERY_TIME,
                'label' => qa_lang( 'flb_like_box/m_display_on_every_load' ),
                'tags'  => 'name="' . self::MODAL_DISPLAY_EVERY_TIME . '"',
                'value' => qa_opt( self::MODAL_DISPLAY_EVERY_TIME ),
                'type'  => 'checkbox',
            );
        }

        /**
         * @return array
         */
        private function get_like_modal_color_scheme_field()
        {
            return array(
                'id'      => self::MODAL_COLOR_SCHEME,
                'label'   => qa_lang( 'flb_like_box/m_colorscheme_label' ),
                'type'    => 'select',
                'tags'    => 'name="' . self::MODAL_COLOR_SCHEME . '"',
                'value'   => qa_opt( self::MODAL_COLOR_SCHEME ),
                'options' => array(
                    'light' => 'light',
                    'dark'  => 'dark',
                ),
            );
        }

        /**
         * @return array
         */
        private function get_like_modal_show_header_field()
        {
            return array(
                'id'      => self::MODAL_SHOW_HEADER,
                'label'   => qa_lang( 'flb_like_box/m_box_header_label' ),
                'type'    => 'select',
                'tags'    => 'name="' . self::MODAL_SHOW_HEADER . '"',
                'value'   => qa_opt( self::MODAL_SHOW_HEADER ),
                'options' => array(
                    'false' => 'false',
                    'true'  => 'true',
                ),
            );
        }

        /**
         * @return array
         */
        private function get_like_modal_show_border_field()
        {
            return array(
                'id'      => self::MODAL_SHOW_BORDER,
                'label'   => qa_lang( 'flb_like_box/m_show_border_label' ),
                'type'    => 'select',
                'tags'    => 'name="' . self::MODAL_SHOW_BORDER . '"',
                'value'   => qa_opt( self::MODAL_SHOW_BORDER ),
                'options' => array(
                    'false' => 'false',
                    'true'  => 'true',
                ),
            );
        }

        /**
         * @return array
         */
        private function get_like_modal_show_faces_field()
        {
            return array(
                'id'      => self::MODAL_SHOW_FACES,
                'label'   => qa_lang( 'flb_like_box/m_show_faces_label' ),
                'type'    => 'select',
                'tags'    => 'name="' . self::MODAL_SHOW_FACES . '"',
                'value'   => qa_opt( self::MODAL_SHOW_FACES ),
                'options' => array(
                    'true'  => 'true',
                    'false' => 'false',
                ),
            );
        }

        /**
         * @return array
         */
        private function get_like_modal_show_data_stream_field()
        {
            return array(
                'id'      => self::MODAL_SHOW_DATA_STREAM,
                'label'   => qa_lang( 'flb_like_box/m_show_stream_label' ),
                'type'    => 'select',
                'tags'    => 'name="' . self::MODAL_SHOW_DATA_STREAM . '"',
                'value'   => qa_opt( self::MODAL_SHOW_DATA_STREAM ),
                'options' => array(
                    'false' => 'false',
                    'true'  => 'true',
                ),
            );
        }

        /**
         * @return array
         */
        private function get_like_modal_height_field()
        {
            return array(
                'id'    => self::MODAL_HEIGHT,
                'label' => qa_lang( 'flb_like_box/m_like_modal_height_label' ),
                'type'  => 'text',
                'tags'  => 'name="' . self::MODAL_HEIGHT . '"',
                'value' => qa_opt( self::MODAL_HEIGHT ), /*this default value is to fit for Snow theme */
            );
        }

        /**
         * @return array
         */
        private function get_like_modal_width_field()
        {
            return array(
                'id'    => self::MODAL_WIDTH,
                'label' => qa_lang( 'flb_like_box/m_like_modal_width_label' ),
                'type'  => 'text',
                'tags'  => 'name="' . self::MODAL_WIDTH . '"',
                'value' => qa_opt( self::MODAL_WIDTH ), /*this default value is to fit for Snow theme */
            );
        }

        /**
         * @return array
         */
        private function get_like_modal_delay_field()
        {
            return array(
                'id'    => self::MODAL_DELAY,
                'label' => qa_lang( 'flb_like_box/m_like_modal_delay' ),
                'type'  => 'text',
                'tags'  => 'name="' . self::MODAL_DELAY . '"',
                'value' => qa_opt( self::MODAL_DELAY ),
                'note'  => qa_lang( 'flb_like_box/m_like_modal_delay_note' ),
            );
        }

        /**
         * @return array
         */
        private function get_like_modal_cookie_expire_field()
        {
            return array(
                'id'    => self::MODAL_COOKIE_EXPIRE,
                'label' => qa_lang( 'flb_like_box/m_like_modal_cookie_expire' ),
                'type'  => 'text',
                'tags'  => 'name="' . self::MODAL_COOKIE_EXPIRE . '"',
                'value' => qa_opt( self::MODAL_COOKIE_EXPIRE ),
                'note'  => qa_lang( 'flb_like_box/m_like_modal_cookie_expire_note' ),
            );
        }

        /**
         * @return array
         */
        private function get_like_modal_header_main_text_field()
        {
            return array(
                'id'    => self::MODAL_HEADER_MAIN_TEXT,
                'label' => qa_lang( 'flb_like_box/m_pop_up_header_text' ),
                'type'  => 'textarea',
                'rows'  => 4,
                'tags'  => 'name="' . self::MODAL_HEADER_MAIN_TEXT . '"',
                'value' => qa_opt( self::MODAL_HEADER_MAIN_TEXT ),
            );
        }

        /**
         * @return array
         */
        private function get_like_modal_footer_text_field()
        {
            return array(
                'id'    => self::MODAL_FOOTER_TEXT,
                'label' => qa_lang( 'flb_like_box/m_pop_up_footer_text' ),
                'type'  => 'textarea',
                'rows'  => 4,
                'tags'  => 'name="' . self::MODAL_FOOTER_TEXT . '"',
                'value' => qa_opt( self::MODAL_FOOTER_TEXT ),
            );
        }

        /**
         * @return array
         */
        private function get_like_modal_custom_css_field()
        {
            return array(
                'id'    => self::MODAL_COSTUM_CSS,
                'label' => qa_lang( 'flb_like_box/m_costum_css' ),
                'type'  => 'textarea',
                'rows'  => 4,
                'tags'  => 'name="' . self::MODAL_COSTUM_CSS . '"',
                'value' => qa_opt( self::MODAL_COSTUM_CSS ),
                'note'  => qa_lang_html( 'flb_like_box/m_costum_css_note' ),
            );
        }

        /**
         * @return array
         */
        private function get_admin_buttons()
        {
            return array(
                array(
                    'label' => qa_lang( 'flb_like_box/save_changes' ),
                    'tags'  => 'name="' . self::SAVE_BUTTON . '"',
                ),
            );
        }

    }
