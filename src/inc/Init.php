<?php

/*
 * @package GenericPlugin
 */

namespace Inc;

final class Init {
    /**
     * Store all the classes in an array
     *
     * @return array List of classes
     */
    public static function get_services() {
        return [
            Pages\Admin::class,
            Base\Enqueue::class,
            Base\SettingsLink::class,
            Base\CustomPostType::class
        ];
    }

    /**
     * Loop through the classes, initialise them and call init()
     */
    public static function init_services() {
        foreach ( self::get_services() as $class ) {
            $service = self::instantiate( $class );

            if ( method_exists( $service, 'init' ) ) {
                $service->init();
            }
        }
    }

    /**
     * Initialise the class
     *
     * @param $class Class from the services array
     * @return mixed New instance of the class
     */
    private static function instantiate( $class ) {
        $service = new $class();

        return $service;
    }
}
