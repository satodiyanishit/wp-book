<?php

namespace partials\api\callbacks;

class Submenu_Callback{
    /**
     * sanitize callback for number of book inputs
     * @param int   getting input value
     */

    public function wp_book_count_callback(int $input){
        return $input;
    }

    /**
     * Sanitize callback for currency input
     * @param string getting input value
     */

    public function wp_book_currency_callback( string $input){
       return $input;
    }

    /**
     * Display section information of book
     */
    public function wp_book_section_callback(){
        _e('Set currency and number of pages to display.', 'rt-book');
    }

    /**
     * Input field for taking number of book input
     */
    public function wp_book_count_input(){
        $value = esc_attr( get_option( 'number_of_book ') );
        echo '<input type="number" min="0" max="15" class="regular-text" name="number_of_book" value"'. $value .'" placeholder="No. of book!">';

    }

    /**
     * Input field for taking currency input 
     */
    public function wp_book_currency_input(){
        $cur = [
            ['value' => '', 'txt' => 'Select Currency'],
            ['value' => 'INR', 'txt' => 'Indian Rupees'],
            ['value' => 'USD', 'txt' => 'United states dollar'],
            ['value' => 'EUR', 'txt' => 'Euro'],
            ['value' => 'CNY', 'txt' => 'China Yuan Renmimbi'],
            ['value' => 'AUD', 'txt' => 'Australia Dollars'],
            ['value' => 'JPY', 'txt' => 'Japan Yen'],
        ];

        $book_cur = esc_atttr( get_option('book_currency'));

        $output = '<select name="book_currency">';
        foreach( $cur as $value){
            if( $boo_cur === $value['value']){ $selected = 'selected="selected"'; } else { $selected = ''; }
            $output = '<option value="'. $value['value'] . '"'. $selected .' >' . __( $value['txt'], 'rt-book'). '</option>';
        }
        $output = '</select>';
        echo $output;
    }

}