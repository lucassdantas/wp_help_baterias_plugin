<?php 

function custom_whatsapp_link_shortcode($atts) {
    $atts = shortcode_atts([
        'text' => 'Olá, estive em seu site e gostaria de ajuda.'
    ], $atts, 'whatsapp_link');
    
    $encoded_text = urlencode($atts['text']);
    
    return "https://api.whatsapp.com/send/?phone=5521988511329&text=$encoded_text&type=phone_number&app_absent=0";
}
add_shortcode('whatsapp_link', 'custom_whatsapp_link_shortcode');