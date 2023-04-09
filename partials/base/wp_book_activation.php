<?php

namespace partials\base;
use partials\api\Metadata_Table;

class wp_book_activation{
    public static function active(){
        //create book meta table
        Metadata_Table::create_table();

        flush_rewrite_rules();//it allows for automatic flushing of the WordPress rewrite rules
        
    }
}

