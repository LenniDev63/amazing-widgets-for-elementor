<?php
/**
 * Plugin Name: Amazing Widgets for Elementor
 * Description: Coleção de widgets avançados inspirados em componentes do Codefronts para Elementor.
 * Version:     1.0.0
 * Author:      Lenni Nune de Oliveira
 * Author URI:  https://lennioliveira.site
 * Text Domain: amazing-widgets-for-elementor
 */

if (!defined('ABSPATH')) {
	exit; // Exit if accessed directly.
}

/**
 * Função principal para verificar dependências e carregar o plugin.
 */
function amazing_widgets_init()
{

	// Verifica se o Elementor está instalado e ativo
	if (!did_action('elementor/loaded')) {
		add_action('admin_notices', 'amazing_widgets_missing_elementor_notice');
		return;
	}

	// Carrega a classe principal de inicialização
	require_once __DIR__ . '/includes/class-plugin-init.php';
	\AmazingWidgets\Plugin_Init::get_instance();
}
add_action('plugins_loaded', 'amazing_widgets_init');

/**
 * Aviso no painel caso o Elementor não esteja ativo.
 */
function amazing_widgets_missing_elementor_notice()
{
	$message = sprintf(
		/* translators: %s: Plugin name */
		esc_html__('"%1$s" requer o plugin "%2$s" instalado e ativo.', 'amazing-widgets-for-elementor'),
		'<strong>Amazing Widgets for Elementor</strong>',
		'<strong>Elementor</strong>'
	);
	printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
}
