<?php 

namespace partials;

//init class

final class init
{
    /**
     * Store all the classes which we want to register
     * @return array    list of classes
     */
    public static function get_services()
    {
        return [
            Pages\admin_CPT::class,
            Pages\Book_Metabox::class,
            Pages\Admin_Menu::class,
            Pages\Custom_Shortcode::class,
            Pages\Custom_Widget::class,
        ];
    }

    /**
     * Loop through the classes and call the register method.
     * @return
     */
    public static function register_services()
    {
        foreach( self::get_services() as $class ) {
            $service = self::instantiate( $class );
            $service->register();
        }
    }

    /**
     * Instantiate the class
     * @param class     class
     * @return object   object of class
     */
    private static function instantiate( $class ) {
        return new $class;
    }

}