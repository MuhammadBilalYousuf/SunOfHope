<?php
/*
   Plugin Name: Custom Plugin
   description: Custom Plugin Actions Hook
   Version: 1.0
 */
add_action("admin_menu", "cspd_imdb_options_submenu");
function cspd_imdb_options_submenu()
{
    add_submenu_page(
        'options-general.php',
        'Add Live Stream',
        'Live Stream',
        'administrator',
        'cspd-imdb-options',
        'cspd_imdb_settings_page'
    );
}
function cspd_imdb_settings_page()
{
?>
<div class="wrap">
    <div class="metabox-holder columns-2">
        <div class="meta-box-sortables ui-sortable">
            <div class="postbox">
                <div class="inside">
                    <form method="post" name="cleanup_options" action="">
                        <textarea name="message" cols="50" rows="7" placeholder="Paste iframe here..."></textarea><br><br>
                        <input class="button-primary" type="submit" value="Go Live" name="send_sms_message" />
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<br>
<h2>Currently Live iFrame</h2>
<?php
$social_options = get_option( 'iframe' );
?><iframe width="420" height="315" src="<?= $social_options ?>"></iframe><?php
}

add_action('admin_init', "send_message");

function send_message()
{
    if (!isset($_POST["send_sms_message"])) {
        return;
    }

    $message   = (isset($_POST["message"])) ? $_POST["message"] : "";

    update_option( 'iframe', $message );
}




function iframe_homepage () {
    $social_options = get_option( 'iframe' );
    ?><iframe width="420" height="315" src="<?= $social_options ?>"></iframe><?php
}
add_shortcode( 'live_stream_homepage', 'iframe_homepage');