<?php

namespace partials\pages;
use partial\api\callbacks\Book_Callback;
use partials\api\Meta_Table;

//create custom meta
class Book_Metabox{
    public $book_callback;
    public $meta_tab;

    public function __construct(){
        $this->meta_tab = new Meta_Table;
        $this->book_callback = new Book_Callback;

        add_action('init', array( $this->meta_tab, 'register_table_with_wpdb'), 0);

    }

    public function register(){
        add_action('add_meta_boxes', array( $this, 'add_book_metadata') );
        add_action('save_post', array( $this, 'save_book_metadata') );
    }

    public function add_book_metadata(){
        add_meta_box('book_author_meta_data', __( 'Author','rt-book' ), array( $this->book_callback, 'author_meta_callback' ), 'book', 'side', 'high' );
        add_meta_box('book_publisher_meta_data', __( 'Publisher name','rt-book' ), array( $this->book_callback, 'publisher_meta_callback' ), 'book', 'side' );
        add_meta_box('book_price_meta_data', __( 'Price' . esc_attr( get_option( 'book_currency') ),'rt-book' ), array( $this->book_callback, 'price_meta_callback' ), 'book' );
        add_meta_box('book_year_meta_data', __( 'Year of Publish','rt-book' ), array( $this->book_callback, 'year_meta_callback' ), 'book' );
        add_meta_box('book_edition_meta_data', __( 'Edition Number','rt-book' ), array( $this->book_callback, 'edition_meta_callback' ), 'book' );
        add_meta_box('book_url_meta_data', __( 'URL of the book','rt-book' ), array( $this->book_callback, 'url_metabox_callback' ), 'book', 'side' );
    }

    public function save_book_metadata( $id ){
        $this->book_callback->save_author_meta($id);
        $this->book_callback->save_publisher_meta($id);
        $this->book_callback->save_price_meta($id);
        $this->book_callback->save_year_meta($id);
        $this->book_callback->save_edition_meta($id);
        $this->book_callback->save_url_meta($id);
    }
}