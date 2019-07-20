<?php

/*
 * @package GenericPlugin
 */

namespace Inc\Pages;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

class Admin extends BaseController {
    public $settings;
    public $pages;
    public $subpages;
    public $callbacks;

    public function init() {
        $this->settings = new SettingsApi();
        $this->callbacks = new AdminCallbacks();

        $this->pages = [ $this->settings_page() ];
        $this->subpages = [ $this->cpt_subpage() ];

        $this->set_settings();
        $this->set_sections();
        $this->set_fields();

        $this->settings
            ->add_pages( $this->pages )
            ->with_subpage( 'Dashboard' )
            ->with_subpages( $this->subpages )
            ->init();
    }

    public function set_settings() {
        $args = [
            [
                'option_group' => 'generic_plugin_options_group',
                'option_name' => 'text_example',
                'callback' => [ $this->callbacks, 'generic_plugin_options_group' ]
            ]
        ];

        $this->settings->set_settings( $args );
    }

    public function set_sections() {
        $args = [
            [
                'id' => 'generic_plugin_admin_index',
                'title' => 'Settings',
                'callback' => [ $this->callbacks, 'generic_plugin_admin_section' ],
                'page' => 'generic_plugin'
            ]
        ];

        $this->settings->set_sections( $args );
    }

    public function set_fields() {
        $args = [
            [
                'id' => 'text_example',
                'title' => 'Text Example',
                'callback' => [ $this->callbacks, 'generic_plugin_text_example' ],
                'page' => 'generic_plugin',
                'section' => 'generic_plugin_admin_index',
                'args' => [
                    'label_for' => 'text_example',
                    'class' => 'example-class'
                ]
            ]
        ];

        $this->settings->set_fields( $args );
    }

    private function settings_page() {
        return [
            'page_title' => 'Generic Plugin Plugin',
            'menu_title' => 'Generic Plugin',
            'capability' => 'manage_options',
            'menu_slug' => 'generic_plugin',
            'callback' => [ $this->callbacks, 'admin_dashboard' ],
            'icon_url' => 'dashicons-store',
            'position' => 110
        ];
    }

    private function cpt_subpage() {
        return [
            'parent_slug' => 'generic_plugin',
            'page_title' => 'Custom Post Type',
            'menu_title' => 'CPT',
            'capability' => 'manage_options',
            'menu_slug' => 'generic_plugin_cpt',
            'callback' => [ $this->callbacks, 'admin_cpt' ]
        ];
    }
}
