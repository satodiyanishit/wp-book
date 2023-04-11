<?php

namespace partials\pages;

class admin_CPT{
    //register Hierarchical taxonomy, Non-hierarchical taxonomy related to book.
    public function register(){
        add_action('init',array($this,'register_custom_post_type'));
        add_action('init',array($this,'register_custom_taxonomy'));

    }
    /**
     * Register CPT book
     * @return
     */
    public function register_custom_post_type(){
        $labels = array(
            'name'                  => __( 'Books', 'wp-book' ),
            'singular_name'         => __( 'Book', 'wp-book' ),
            'menu_name'             => __( 'Books', 'wp-book' ),
            'name_admin_bar'        => __( 'Book', 'wp-book' ),
            'add_new'               => __( 'Add New', 'wp-book' ),
            'add_new_item'          => __( 'Add New Book', 'wp-book' ),
            'new_item'              => __( 'New Book', 'wp-book' ),
            'edit_item'             => __( 'Edit Book', 'wp-book' ),
            'view_item'             => __( 'View Book', 'wp-book' ),
            'all_items'             => __( 'All Books', 'wp-book' ),
            'search_items'          => __( 'Search Books', 'wp-book' ),
            'parent_item_colon'     => __( 'Parent Books:', 'wp-book' ),
            'not_found'             => __( 'No books found.', 'wp-book' ),
            'not_found_in_trash'    => __( 'No books found in Trash.', 'wp-book' ),
            'featured_image'        => __( 'Book Cover Image', 'wp-book' ),
            'set_featured_image'    => __( 'Set cover image', 'wp-book' ),
            'remove_featured_image' => __( 'Remove cover image', 'wp-book' ),
            'use_featured_image'    => __( 'Use as cover image', 'wp-book' ),
            'archives'              => __( 'Book archives', 'wp-book' ),
            'insert_into_item'      => __( 'Insert into book', 'wp-book' ),
            'uploaded_to_this_item' => __( 'Uploaded to this book', 'wp-book' ),
            'filter_items_list'     => __( 'Filter books list', 'wp-book' ),
            'items_list_navigation' => __( 'Books list navigation', 'wp-book' ),
            'items_list'            => __( 'Books list', 'wp-book' ),
        );

        $args=array(
            'labels'             => $labels,
            'public'             => true,
            'publicly_queryable' => true,
            'show_ui'            => true,
            'show_in_menu'       => true,
            'query_var'          => true,
            'rewrite'            => array( 'slug' => 'book' ),
            'capability_type'    => 'post',
            'has_archive'        => true,
            'hierarchical'       => false,
            'menu_position'      => null,
            'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        );

        register_post_type('book',$args);
    }

    /**
     * register taxonomy for CPT book
     */
    public function register_custom_taxonomy() {

        // Hierarchical
        $args = [
            'labels' => $this->get_labels( 'Categorie' ),
            'public' => true,
            'rewrite' => array( 'slug' => 'books/categories' ),
            'hierarchical' => true,
        ];
        register_taxonomy( 'book-categories', 'book', $args );

        // Non-Hierarchical
        $args = [
            'labels' => $this->get_labels( 'Tag' ),
            'public' => true,
            'rewrite' => array( 'slug' => 'books/tags' ),
            'hierarchical' => false,
        ];
        register_taxonomy( 'book-tags', 'book', $args );
    }

     /**
     * generate labels for taxonomy
     * @return array    array of labels
     */
    public function get_labels( string $type ) {
        return [
            'name'              => __( 'Book ' . $type . 's', 'wp-book' ),
            'singular_name'     => __( 'Book ' . $type, 'wp-book' ),
            'popular_items'     => __( 'Popular Book ' . $type . 's', 'wp-book' ),
            'edit_item'         => __( 'Edit Book '. $type, 'wp-book'),
            'view_item'         => __( 'View Book ' . $type, 'wp-book' ),
            'update_item'       => __( 'Update Book ' . $type, 'wp-book' ),
            'add_new_item'      => __( 'Add New Book ' . $type, 'wp-book' ),
            'most_used'         => __( 'Most Used Book ' . $type . 's', 'wp-book' ),
        ];
    }

}