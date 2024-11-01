<?php
if( ! defined( 'ABSPATH' ) ) exit;
/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://zooza.sk
 * @since      1.0.0
 *
 * @package    Zooza
 * @subpackage Zooza/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h2><?php esc_html_e( 'Zooza', 'zooza' ); ?></h2>
    <?php settings_errors(); ?>
    <!--form method="post" action="options-general.php?page=zooza"-->
    <form method="post" action="options.php">
        <?php settings_fields( 'zooza' );?>
        <?php do_settings_sections( 'zooza' );?>
        <hr/>
        <?php submit_button( 'Uložiť', 'primary', 'submit' );?>
    </form>
</div>
