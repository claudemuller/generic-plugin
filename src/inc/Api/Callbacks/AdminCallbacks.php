<?php

/*
 * @package GenericPlugin
 */

namespace Inc\Api\Callbacks;

use Inc\Base\BaseController;

class AdminCallbacks extends BaseController {
    public function admin_dashboard() {
        return require_once( "$this->plugin_path/templates/admin.php" );
    }

    public function admin_cpt() {
        return require_once( "$this->plugin_path/templates/cpt.php" );
    }

    public function generic_plugin_options_group( $input ) {
        return $input;
    }

    public function generic_plugin_admin_section() {
        echo 'Check this sections';
    }

    public function generic_plugin_text_example() {
        $value = esc_attr( get_option( 'text_example' ) );

        echo '<input type="text" class="regular-text" name="text_example" value="' . $value . '" placeholder="Write something here">';
    }
}
