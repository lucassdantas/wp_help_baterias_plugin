<?php 

function custom_whatsapp_link_shortcode($atts) {
  $phone_number = get_option('custom_whatsapp_phone', '5521988511329');
  $phone_number = preg_replace('/\D/', '', $phone_number); // Remove todos os caracteres não numéricos
  
  $atts = shortcode_atts([
      'text' => 'Olá, estive em seu site e gostaria de ajuda.'
  ], $atts, 'whatsapp_link');
  
  $encoded_text = urlencode($atts['text']);
  
  return "https://api.whatsapp.com/send/?phone=$phone_number&text=$encoded_text&type=phone_number&app_absent=0";
}
add_shortcode('whatsapp_link', 'custom_whatsapp_link_shortcode');

function show_whatsapp_number(){
  $wpp_number = get_option('custom_whatsapp_phone', ' 21 98851-1329');
  return esc_html($wpp_number);
}

add_shortcode('show_whatsapp_number', 'show_whatsapp_number');
