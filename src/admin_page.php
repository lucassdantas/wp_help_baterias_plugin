<?php 
function custom_whatsapp_settings_page() {
  add_menu_page(
      'Configuração do WhatsApp',
      'WhatsApp Config',
      'manage_options',
      'custom-whatsapp-settings',
      'custom_whatsapp_settings_page_html',
      'dashicons-whatsapp',
      20
  );
}
add_action('admin_menu', 'custom_whatsapp_settings_page');

function custom_whatsapp_settings_page_html() {
  if (!current_user_can('manage_options')) {
      return;
  }
  
  if (isset($_POST['custom_whatsapp_phone'])) {
      update_option('custom_whatsapp_phone', sanitize_text_field($_POST['custom_whatsapp_phone']));
      echo '<div class="updated"><p>Número atualizado com sucesso!</p></div>';
  }
  
  $phone_number = get_option('custom_whatsapp_phone', '5521988511329');
  ?>
  <div class="wrap">
      <h1>Configuração do WhatsApp</h1>
      <form method="post">
          <label for="custom_whatsapp_phone">Número do WhatsApp:</label>
          <input type="text" id="custom_whatsapp_phone" name="custom_whatsapp_phone" value="<?php echo esc_attr($phone_number); ?>" />
          <button type="submit" class="button button-primary">Salvar</button>
      </form>
  </div>
  <?php
}
