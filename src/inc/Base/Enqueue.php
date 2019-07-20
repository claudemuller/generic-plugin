<?php

/*
 * @package GenericPlugin
 */

namespace Inc\Base;

class Enqueue extends BaseController {
    public function init() {
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_styles' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
    }

    public function enqueue_styles() {
        $this->enqueue_admin_styles();
    }

    public function enqueue_scripts() {
        $this->enqueue_admin_scripts();
    }

    private function enqueue_admin_styles() {
        wp_enqueue_style( 'styles', $this->plugin_url . 'assets/css/style.css' );
    }

    private function enqueue_admin_scripts() {
        wp_enqueue_script( 'scripts', $this->plugin_url . 'assets/js/script.js' );
    }
}
