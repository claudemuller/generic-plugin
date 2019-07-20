<?php

/*
 * @package GenericPlugin
 */

namespace Inc\Base;

class SettingsLink {
    public function init() {
        add_filter( 'plugin_action_links', [ $this, 'create_settings_link' ], 10, 5 );
    }

    public function create_settings_link( $links ) {
        $settings_link = '<a href="admin.php?page=generic_plugin" title="Settings">Settings</a>';

        array_push( $links, $settings_link );

        return $links;
    }

}
