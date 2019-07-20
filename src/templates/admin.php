<div class="wrap">
    <h1>Generic Plugin Admin</h1>

    <?php settings_errors(); ?>

    <form method="post" action="options.php">
        <?php

        settings_fields( 'generic_plugin_options_group' );
        do_settings_sections( 'generic_plugin' );
        submit_button();

        ?>
    </form>
</div>
