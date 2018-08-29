<?php
/**
 * @package BTC_value
 * @version 1.0
 */
/*
Plugin Name: Get Current BTC
Plugin URI: https://wordpress.org/plugins/get-current-btc/
Description: Get the current BTC value
Author: Peter Andersson
Version: 1.0
Author URI: https://www.fsh.se
Text Domain: get-btc
 */
function get_btc_from_web()
{
    $jsnsrc = "https://blockchain.info/ticker";
    $json = file_get_contents($jsnsrc);
    $json = json_decode($json);
    $one = $json->USD->last;
    return wptexturize($one);
}
// This just echoes the chosen line, we'll position it later
function get_btc()
{
    $chosen = get_btc_from_web();
    echo "<p id='btc'>$chosen</p>";
}
// Now we set that function up to execute when the admin_notices action is called
add_action('admin_notices', 'get_btc');
// We need some CSS to position the paragraph
function btc_css()
{
    // This makes sure that the positioning is also good for right-to-left languages
    $x = is_rtl() ? 'left' : 'right';
    echo "
	<style type='text/css'>
	#btc {
		float: $x;
		padding-$x: 15px;
		padding-top: 5px;
		margin: 0;
		font-size: 11px;
	}
	</style>
	";
}
add_action('admin_head', 'btc_css');
