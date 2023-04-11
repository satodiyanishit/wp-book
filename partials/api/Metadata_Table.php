<?php

namespace partials\api;


class Metadata_Table{
    //create a custom meta table for book

    public static function create_table(){
        global $wpdb;
        $table_name = $wpdb->prefix.'bookmeta';
        $wpdb_collate = $wpdb->collate;

        //check if table is already created
        if($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name){ 
            $q = "CREATE TABLE {$table_name} (
                meta_id bigint(20) NOT NULL AUTO_INCREMENT,
                book_id bigint(20) NOT NULL DEFAULT 0,
                meta_key varchar(255) DEFAULT NULL,
                meta_value longtext NOT NULL,
                PRIMARY KEY  (meta_id),
                KEY meta_key (meta_key)
                )
                COLLATE {$wpdb_collate}";

                require_once(ABSPATH .'wp-admin/includes/upgrade.php');
                dbDelta($q); //for creating new table and updating existing table to a new structure
    }
}

public function register_table_with_wpdb(){
    global $wpdb;
    $wpdb->bookmeta = $wpdb->prefix . 'bookmeta';
    $wpdb->tables[] = 'bookmeta'; 
}

}