<?php

namespace partials\pages;

class Custom_Shortcode{

    //register all shortcode
    public function register(){
        add_shortcode('book', array( $this, 'custom_book_shortcode') );
    }

    /**
     * Register shortcode for CPT book
     * @param attr id, author, year, publisher, categorys, tags
     * @return html list of full information about book
     */

    public function custom_book_shortcode($attr){

        // setting default values
        $attr = shortcode_atts( [
            'id'        => null,
            'author'    => null,
            'year'      => null,
            'publisher' => null,
            'category'  => null,
            'tag'       => null,
        ], $attr );

        $ids = array();
        $taxo = array(
            'relation' => 'OR',
        );

    $args = array(
        'post_type' => 'book',
    );

    //check if id available and if yes then add it into the taxo array
    if( isset( $attr['id'])) {
        $ids[] = $attr['id'];
    }

    //check if category available and if yes then add it into the taxo array
    if( isset( $attr['category'] ) ) {
        $taxo[] = array(
            'taxonomy' => 'book-categories',
            'field' => 'slug',
            'terms' => $attr['category'],
        );
    }

    //check if tag available and if yes then add it into the taxo array
    if( isset( $attr['tag'] ) ) {
        $taxo[] = array(
            'taxonomy' => 'book-tags',
            'field' => 'slug',
            'terms' => $attr['tag'],
        );
    }

    if( !empty( $taxo)){
        $args['tax_query'] = $taxo;
    }

    //get id of all books from custom metatable 'wp_bookmeta' who has following author
    if( isset( $attr['author'])){
        global $wpdb;
        $value = $wpdb->get_results( 'select book_id from wp_bookmeta where meta_key = "author" and meta_value = "'. $attr['author'] . '"' );
        foreach( $value as $meta){
            if(! \in_array($meta->book_id, $ids)){
                $ids[] = $meta->book_id;
            }
        }
    }

    //get id of all books from custom metatable 'wp_bookmeta' who has following year
    if( isset( $attr['year'])){
        global $wpdb;
        $value = $wpdb->get_results( 'select book_id from wp_bookmeta where meta_key = "year" and meta_value = "'. $attr['year'] . '"' );
        foreach( $value as $meta){
            if(! \in_array($meta->book_id, $ids)){
                $ids[] = $meta->book_id;
            }
        }
    }

    //get id of all books from custom metatable 'wp_bookmeta' who has following publisher
    if( isset( $attr['publisher'])){
        global $wpdb;
        $value = $wpdb->get_results( 'select book_id from wp_bookmeta where meta_key = "publisher" and meta_value = "'. $attr['publisher'] . '"' );
        foreach( $value as $meta){
            if(! \in_array($meta->book_id, $ids)){
                $ids[] = $meta->book_id;
            }
        }
    }

    // if ids not empty then create query var in args array
    if( ! empty( $ids ) ) {
        $args['post__in'] = $ids;
    }

    $content = '<div class="wrap">';
    $query = new \WP_Query($args);
    if($query ->have_posts()):
        global $wpdb;
        while($query->have_posts()) : $query->the_post();
        $content = the_title( "<h5>", "</h5>", false);

        //get meta information of using book id
        $value = $wpdb->get_results('select meta_key, meta_value from wp_bookmeta where book_id= "'. get_the_ID() .'"');
        foreach($value as $meta){
            if($meta->meta_value != '') {
                $content = '<li>' .$meta->meta_key . ':'. $meta->meta_value . '</li>';
            }
        }
        endwhile;
        wp_reset_postdata();
    else:
        $content = 'Not found any book';
    endif;

    $content = "</div>";

    return $content;
    }
}