<?php

/*
 * @package GenericPlugin
 */

namespace Inc\Base;

class CustomPostType {
    public function init() {
        add_action('init', [$this, 'register_custom_post_type']);
    }

    public function register_custom_post_type() {
        register_post_type( 'book', [
            'public' => true,
            'label' => 'Books'
        ] );
    }
}
