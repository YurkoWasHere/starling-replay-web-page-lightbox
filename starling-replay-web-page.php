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
   
    // Optional. Remove a mime type.
    unset( $mimes['exe'] );
    
    return $mimes;
}
add_filter( 'upload_mimes', 'wacz_mime_types' );

//Add script to head
function add_script_to_head() {
//    wp_enqueue_script('custom-script', get_template_directory_uri() . '/custom-script.js', array(), '1.0', false);
    wp_enqueue_script('custom-script', 'https://cdn.jsdelivr.net/npm/replaywebpage@1.8.4/ui.js', array(), '1.0', false);
}
add_action('wp_enqueue_scripts', 'add_script_to_head');


// Write HTML code for the replay site
function display_wacz($atts) {
    // Extract and sanitize the URL from the shortcode attribute

    $url="";
    if (isset($atts['url'])) {
      $url = esc_url($atts['url']);
    }
    if (isset($atts['media_id'])) {
      $url = esc_url(wp_get_attachment_url($atts['media_id']));
    }

    // Generate and return the HTML with the iframe
    $plugin_dir_url = plugins_url('', __FILE__);
    $height="400px";
    $width="100%";
    return '<replay-web-page source="' . $url . '"  replayBase="' . $plugin_dir_url . "/replay/" . '" style="height:' . $height . ';width:' . $width . ';"></replay-web-page>';
}
// Register the shortcode to use in posts or pages
add_shortcode('wacz_url', 'display_wacz');
