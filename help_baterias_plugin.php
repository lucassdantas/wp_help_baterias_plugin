<?php
/**
* Plugin Name: Help baterias Plugin
* Plugin URI: https://github.com/lucassdantas/wp_help_baterias_plugin.git
* Update URI: https://github.com/lucassdantas/wp_help_baterias_plugin.git
* Description: Custom shipping configurations and global whatsapp for help baterias
* Version: 1.0.0
* Author: RD Exclusive
* Author URI: https://rdexclusive.com.br/
**/

defined('ABSPATH') or die();
if(!function_exists('add_action')){
    die;
}

require_once plugin_dir_path(__FILE__). 'src/add_help_baterias_shipping.php';
require_once plugin_dir_path(__FILE__). 'src/restrict_help_baterias_shipping_on_cart_and_checkout.php';
require_once plugin_dir_path(__FILE__). 'src/restrict_help_baterias_shipping_by_category.php';
require_once plugin_dir_path(__FILE__). 'src/check_and_add_custom_shipping_method.php';
require_once plugin_dir_path(__FILE__). 'src/script_custom_date.php';
require_once plugin_dir_path(__FILE__). 'src/script_restrict_shippings_on_variation.php';
require_once plugin_dir_path(__FILE__). 'src/global_whatsapp.php';
require_once plugin_dir_path(__FILE__). 'src/admin_page.php';