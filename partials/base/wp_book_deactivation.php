<?php
namespace partials\base;
class wp_book_deactivation{
    public static function deactive(){

        flush_rewrite_rules();//it allows for automatic flushing of the WordPress rewrite rules 
    }
}