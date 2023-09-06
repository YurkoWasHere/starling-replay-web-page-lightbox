<?php
/*
Plugin Name: Replay Web Page
Description: Display WACZ player.
Version: 0.1
Author: Starling Lab
*/

// Allow wacz uploads
function wacz_mime_types( $mimes ) {
    
    // New allowed mime types.
    $mimes['wacz'] = 'application/wacz';
    $mimes['warc'] = 'application/warc';
    $mimes['json'] = 'application/json';
   
    return $mimes;
}
add_filter( 'upload_mimes', 'wacz_mime_types' );

//Add script to head
function add_script_to_head() {
//    wp_enqueue_script('custom-script', get_template_directory_uri() . '/custom-script.js', array(), '1.0', false);
    wp_enqueue_script('starling-replay-ui', 'https://cdn.jsdelivr.net/npm/replaywebpage@1.8.4/ui.js', array(), '1.0', false);
    wp_enqueue_script('starling-replay-js', plugins_url('', __FILE__).  '/starling-replay-web-page-js.php?api_url=' . esc_url_raw(rest_url()), array(), '1.0', false);
}
add_action('wp_enqueue_scripts', 'add_script_to_head');


// Write HTML code for the replay site
function display_wacz($atts) {
    // Extract and sanitize the URL from the shortcode attribute

    $url="";
    if (isset($atts['remote_url'])) {
      $url = esc_url($atts['remote_url']);
    }
    if (isset($atts['media_id'])) {
      $url = esc_url(wp_get_attachment_url($atts['media_id']));
    }

    // Current plugin directory 
    $plugin_dir_url = plugins_url('', __FILE__);

    //Attributes
    $height = isset($atts['height']) ? $atts['height'] : "400px";
    $width = isset($atts['width']) ? $atts['width'] : "100%";


    // Generate and return the replay-web-page control
    $ret = '<replay-web-page source="' . $url . '"';
    $ret .= ' replayBase="' . $plugin_dir_url . "/replay/" . '"';
    $ret .= ' style="height:' . $height . ';width:' . $width . '"';
    if (isset($atts['url'])) $ret .= ' url="' . $atts['url'] . '"';
    if (isset($atts['embed'])) $ret .= ' embed="' . $atts['embed'] . '"';
    $ret .= '></replay-web-page>';

    return $ret;    
}
// Register the shortcode to use in posts or pages
add_shortcode('wacz_url', 'display_wacz');
