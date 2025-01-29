<?php

defined('ABSPATH') or die();
if(!function_exists('add_action')){
    die;
}

add_action('woocommerce_before_checkout_form', 'check_and_add_custom_shipping_method');
function check_and_add_custom_shipping_method() {
	$current_shipping_name = "";
	$current_shipping_method = WC()->session->get( 'chosen_shipping_methods' );
	$packages = WC()->shipping()->get_packages();
	$package = $packages[0];
	$available_methods = $package['rates'];
	foreach ($available_methods as $key => $method) {
		if($current_shipping_method[0] == $method->id){
			$current_shipping_name = $method->label;
		}
	}
	if($current_shipping_name === 'Entrega Help Baterias'){
		add_filter('woocommerce_checkout_fields', 'custom_date_field');
		function custom_date_field($fields)
		{	

			global $is_50minutes_shipping;
			$is_50minutes_shipping = true;

			// Inicialize a contagem total de produtos
			$total_product_count = 0;

			foreach (WC()->cart->get_cart() as $cart_item) {
				$product_id = $cart_item['product_id'];
				$term_names = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'names'));

				// Verifique se o produto não tem a categoria "Receba em 50 minutos"
				if (!in_array('Receba em 50 minutos', $term_names)) {
					$is_50minutes_shipping = false;
					break; // Se encontrar um produto sem a categoria, defina como false e saia do loop
				}
				
				// Adicione a quantidade deste item ao total
				$total_product_count += $cart_item['quantity'];
			}
			
			// Se houver mais de 2 unidades no total, defina como false
			if ($total_product_count > 2) {
				$is_50minutes_shipping = false;
			}


			$fields['billing']['shipping_type'] = array(
				'label'     => __('Tipo de entrega', 'woocommerce'),
				'type'		=> 'select',
				'placeholder'   => _x('Selecione o tipo de entrega', 'placeholder', 'woocommerce'),
				'required'  => true,
				'class'     => array('form-row-wide'),
				'clear'     => true
			);
			
			if($is_50minutes_shipping){
				$fields['billing']['shipping_type']['options'] = array (
					'Entrega imediata' => 'Entrega imediata',
					'Próximo dia útil' => 'Próximo dia útil',
					'Entrega agendada' => 'Agendar entrega'
				);
			}else{
				$fields['billing']['shipping_type']['options'] = array (
					#'Entrega no mesmo dia' => 'Entrega no mesmo dia',
					'Próximo dia útil' => 'Próximo dia útil',
					'Entrega agendada' => 'Agendar entrega'
				);
			}
			
			
			$fields['billing']['shipping_type']['priority'] = 8;
			
			
			$fields['billing']['shipping_date'] = array(
				'type' => 'date',
				'label'     => __('Data aproximada da entrega', 'woocommerce'),
				'placeholder'   => _x('Data aproximada da entrega', 'placeholder', 'woocommerce'),
				'required'  => false,
				'class'     => array('form-row-wide'),
				'clear'     => true
			);
			
			$fields['billing']['shipping_date']['priority'] = 9;
			return $fields;
		}




	}
}


require_once plugin_dir_path(__FILE__).'./add_order_metadata.php';

