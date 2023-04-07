<?php

namespace partials\pages;
use partials\api\callbacks\Submenu_Callback;

class Admin_Menu
{

    public $menu_callbacks;

    public function __construct(){
        $this->menu_callbacks = new Submenu_Callback;
    }

    /**
     * Register custom submenu page.
     */

    public function add_custom_submenu_page(){
        add_submunu_page(
            'edit.php?post_type=book',
            __( 'Settings','wp-book'),
            __( 'Settings','wp-book'),
            'manage_options',
            'settings',
            array($this, 'wp_create_page' )
        );

        add_action('admin_init', array( $this, 'register_custom_fields') );
    }

    /**
     * Display setting form
     */
    public function wp_create_page(){
        require_once dirname( __FILE__, 3 ). '/template/book_options.php';
    }

    /**
     * Register setting information of type book
     */

    public function register_custom_fields(){

        $settings_args = [
            [
                'option_group' => 'wp-book-option-group',
                'option_name'  => 'number_of_book',
                'callback'     => array( $this->menu_callbacks, 'wp_book_count_callback')
            ],

            [
                'option_group' => 'wp-book-option-group',
                'option_name'  => 'book_currency',
                'callback'     => array( $this->menu_callbacks, 'wp_book_currency_callback')
            ]
            ];

            $section_args = [
                [
                    'id' => 'wp-book-section',
                    'title' => __('Book Options', 'wp-book'),
                    'callback' => array( $this->menu_callbacks, 'wp_book_section_callback'),
                    'page' => 'edit.php?post_type=book'
                ]
                ];

            $field_args = [
                [
                    'id' => 'number_of_book',
                    'title' => __('Enter number of book', 'wp-book'),
                    'callback' => array( $this->menu_callbacks, 'wp_book_count_input'),
                    'page' => 'edit.php?post_type=book',
                    'section' => 'wp-book-section',
                    'args' => [
                        'label_for' => 'number_of_book',
                        'class' => 'no-of-page'
                    ]
                ],
                [
                    'id' => 'book_currency',
                    'title' => __('Choose Currency', 'wp-book'),
                    'callback' => array( $this->menu_callbacks, 'wp_book_currency_input' ),
                    'page' => 'edit.php?post_type=book',
                    'section' => 'wp-book-section',
                    'args' => [
                        'label_for' => 'book_currency',
                        'class' => 'book-currency'
                    ]
                ]
            ];

            //register settings
            foreach($settings_args as $setting){
                register_setting($setting["option_group"], $setting["option_name"], (isset($setting["callback"]) ? $setting["callback"] : '' ) );
            }

            //add setting section
            foreach($section_args as $section){
                add_settings_section($section["id"], $section["title"], (isset($section["callback"]) ? $section["callback"] : '' ), $section["page"] );
            }
            
            //add setting fields
            foreach($field_args as $field){
                add_settings_field($field["option_group"], $field["option_name"], (isset($field["callback"]) ? $field["callback"] : '' ), $field["page"], $field["section"], ( isset( $field["args"] ) ? $field["args"] : '' ) );
            }
    }
}