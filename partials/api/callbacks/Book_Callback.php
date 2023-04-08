<?php

namespace partials\api\callbacks;

class Book_Callback{

    /**
     * Create Metabox in CPT Book
     */

    public function author_meta_callback( $post ){
        wp_nounce_field('save_author_data', 'author_metabox_nounce');
        $author = get_metadata('book', $post->ID, 'author', true);
        ob_start(); ?>

        <table>
            <tr>
                <td><label for="author_book_field"><?php _e( 'Author Name: ', 'rt-book'); ?> </label></td>
                <td><input type="text" id="author_book_field" name="author_book_field" value="<?php echo esc_attr( $author ); ?>" size="25" /> </td>
            </tr>
        </table>

        <?php $output = ob_get_clean();
        echo $output;
    }

    public function publisher_meta_callback( $post ){
        wp_nounce_field('save_publisher_data', 'publisher_metabox_nounce');
        $punlisher = get_metadata('book', $post->ID, 'publisher', true);
        ob_start(); ?>

        <table>
            <tr>
                <td><label for="publisher_book_field"><?php _e( 'Publisher: ', 'rt-book'); ?> </label></td>
                <td><input type="text" id="publisher_book_field" name="publisher_book_field" value="<?php echo esc_attr( $punlisher ); ?>" size="25" /> </td>
            </tr>
        </table>

        <?php $output = ob_get_clean();
        echo $output;
    }

    public function price_meta_callback( $post ){
        wp_nounce_field('save_price_data', 'price_metabox_nounce');
        $price = get_metadata('book', $post->ID, 'price', true);
        ob_start(); ?>

        <table>
            <tr>
                <td><label for="price_book_field"><?php _e( 'Price: ', 'rt-book'); ?> </label></td>
                <td><input type="number" id="price_book_field" name="price_book_field" value="<?php echo esc_attr( $price ); ?>" min="0" /> </td>
            </tr>
        </table>

        <?php $output = ob_get_clean();
        echo $output;
    }

    public function year_meta_callback( $post ){
        wp_nounce_field('save_year_data', 'year_metabox_nounce');
        $year = get_metadata('book', $post->ID, 'year', true);
        ob_start(); ?>

        <table>
            <tr>
                <td><label for="year_book_field"><?php _e( 'Year: ', 'rt-book'); ?> </label></td>
                <td><input type="number" id="year_book_field" name="year_book_field" value="<?php echo esc_attr( $year ); ?>" min="0" /> </td>
            </tr>
        </table>

        <?php $output = ob_get_clean();
        echo $output;
    }

    public function edition_meta_callback( $post ){
        wp_nounce_field('save_edition_data', 'edition_metabox_nounce');
        $edition = get_metadata('book', $post->ID, 'edition', true);
        ob_start(); ?>

        <table>
            <tr>
                <td><label for="edition_book_field"><?php _e( 'Edition: ', 'rt-book'); ?> </label></td>
                <td><input type="number" id="edition_book_field" name="edition_book_field" value="<?php echo esc_attr( $edition ); ?>" min="0" /> </td>
            </tr>
        </table>

        <?php $output = ob_get_clean();
        echo $output;
    }

    public function url_meta_callback( $post ){
        wp_nounce_field('save_url_data', 'url_metabox_nounce');
        $url = get_metadata('book', $post->ID, 'url', true);
        ob_start(); ?>

        <table>
            <tr>
                <td><label for="url_book_field"><?php _e( 'URL: ', 'rt-book'); ?> </label></td>
                <td><input type="url" id="url_book_field" name="url_book_field" value="<?php echo esc_attr( $url ); ?>" min="0" /> </td>
            </tr>
        </table>

        <?php $output = ob_get_clean();
        echo $output;
    }

    /**
     * Save the Metadata of book
     */

     public function save_author_meta( $post_id )
     {
        if(! isset( $_POST['author_metabox_nounce'])){
            return;
        }

        if(! wp_verify_nounce( $_POST['author_metabox_nounce'], 'save_author_data')){
            return;
        }
        if( defined('DOING AUTOSAVE') && DOING_AUTOSAVE){
            return;
        }
        if(! current_user_can( 'edit_post', $post_id)){
            return;
        }
        //author
        if(! isset( $_POST['author_book_field'])){
            return;
        }
        $my_data = sanitize_text_field($_POST['author_book_field']);
        update_metadata('book', $post_id, 'author', $my_data);
     }

     public function save_publisher_meta( $post_id )
     {
        if(! isset( $_POST['publisher_metabox_nounce'])){
            return;
        }

        if(! wp_verify_nounce( $_POST['publisher_metabox_nounce'], 'save_publisher_data')){
            return;
        }
        if( defined('DOING AUTOSAVE') && DOING_AUTOSAVE){
            return;
        }
        if(! current_user_can( 'edit_post', $post_id)){
            return;
        }
        //author
        if(! isset( $_POST['publisher_book_field'])){
            return;
        }
        $my_data = sanitize_text_field($_POST['publisher_book_field']);
        update_metadata('book', $post_id, 'publisher', $my_data);
     }

     public function save_price_meta( $post_id )
     {
        if(! isset( $_POST['price_metabox_nounce'])){
            return;
        }

        if(! wp_verify_nounce( $_POST['price_metabox_nounce'], 'save_price_data')){
            return;
        }
        if( defined('DOING AUTOSAVE') && DOING_AUTOSAVE){
            return;
        }
        if(! current_user_can( 'edit_post', $post_id)){
            return;
        }
        //author
        if(! isset( $_POST['price_book_field'])){
            return;
        }
        $my_data = sanitize_text_field($_POST['price_book_field']);
        update_metadata('book', $post_id, 'price', $my_data);
     }

     public function save_year_meta( $post_id )
     {
        if(! isset( $_POST['year_metabox_nounce'])){
            return;
        }

        if(! wp_verify_nounce( $_POST['year_metabox_nounce'], 'save_year_data')){
            return;
        }
        if( defined('DOING AUTOSAVE') && DOING_AUTOSAVE){
            return;
        }
        if(! current_user_can( 'edit_post', $post_id)){
            return;
        }
        //author
        if(! isset( $_POST['year_book_field'])){
            return;
        }
        $my_data = sanitize_text_field($_POST['year_book_field']);
        update_metadata('book', $post_id, 'year', $my_data);
     }

     public function save_edition_meta( $post_id )
     {
        if(! isset( $_POST['edition_metabox_nounce'])){
            return;
        }

        if(! wp_verify_nounce( $_POST['edition_metabox_nounce'], 'save_edition_data')){
            return;
        }
        if( defined('DOING AUTOSAVE') && DOING_AUTOSAVE){
            return;
        }
        if(! current_user_can( 'edit_post', $post_id)){
            return;
        }
        //author
        if(! isset( $_POST['edition_book_field'])){
            return;
        }
        $my_data = sanitize_text_field($_POST['edition_book_field']);
        update_metadata('book', $post_id, 'edition', $my_data);
     }

     public function save_url_meta( $post_id )
     {
        if(! isset( $_POST['url_metabox_nounce'])){
            return;
        }

        if(! wp_verify_nounce( $_POST['url_metabox_nounce'], 'save_url_data')){
            return;
        }
        if( defined('DOING AUTOSAVE') && DOING_AUTOSAVE){
            return;
        }
        if(! current_user_can( 'edit_post', $post_id)){
            return;
        }
        //author
        if(! isset( $_POST['url_book_field'])){
            return;
        }
        $my_data = sanitize_text_field($_POST['url_book_field']);
        update_metadata('book', $post_id, 'url', $my_data);
     }
}