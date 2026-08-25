<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Icons_Manager;

class Amazing_Widget_Exemplo_Card extends Widget_Base {

	public function get_name() {
		return 'amazing-exemplo-card';
	}

	public function get_title() {
		return __( 'Exemplo Card', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-info-box';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-exemplo-card' ];
	}

	public function get_script_depends() {
		return [ 'amazing-widget-exemplo-card' ];
	}

	protected function register_controls() {

		// ==========================================
		// ABA CONTEÚDO
		// ==========================================

		// Seção de Ícone
		$this->start_controls_section(
			'section_icon',
			[
				'label' => __( 'Ícone', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'selected_icon',
			[
				'label'   => __( 'Ícone', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::ICONS,
				'default' => [
					'value'   => 'fas fa-rocket',
					'library' => 'fa-solid',
				],
			]
		);

		$this->end_controls_section();

		// Seção de Textos
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Conteúdo', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'card_title',
			[
				'label'       => __( 'Título', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Desenvolvimento Rápido', 'amazing-widgets-for-elementor' ),
				'placeholder' => __( 'Digite o título aqui', 'amazing-widgets-for-elementor' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'card_description',
			[
				'label'       => __( 'Descrição', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => __( 'Crie interfaces incríveis e totalmente personalizáveis dentro do Elementor.', 'amazing-widgets-for-elementor' ),
				'placeholder' => __( 'Digite a descrição aqui', 'amazing-widgets-for-elementor' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		// Seção do Botão
		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Botão', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'button_text',
			[
				'label'       => __( 'Texto do Botão', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Saiba Mais', 'amazing-widgets-for-elementor' ),
				'placeholder' => __( 'Saiba Mais', 'amazing-widgets-for-elementor' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->add_control(
			'button_link',
			[
				'label'       => __( 'Link', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'https://seu-link.com', 'amazing-widgets-for-elementor' ),
				'default'     => [
					'url'         => '#',
					'is_external' => false,
					'nofollow'    => false,
				],
				'dynamic'     => [ 'active' => true ],
			]
		);

		$this->end_controls_section();


		// ==========================================
		// ABA ESTILO
		// ==========================================

		// Estilo Geral do Card
		$this->start_controls_section(
			'section_style_card',
			[
				'label' => __( 'Card', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name'     => 'card_background',
				'label'    => __( 'Fundo', 'amazing-widgets-for-elementor' ),
				'types'    => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .codefronts-card',
			]
		);

		$this->add_responsive_control(
			'card_padding',
			[
				'label'      => __( 'Espaçamento Interno (Padding)', 'amazing-widgets-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .codefronts-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'card_border_radius',
			[
				'label'      => __( 'Arredondamento de Canto (Border Radius)', 'amazing-widgets-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .codefronts-card' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'card_box_shadow',
				'label'    => __( 'Sombra da Caixa', 'amazing-widgets-for-elementor' ),
				'selector' => '{{WRAPPER}} .codefronts-card',
			]
		);

		$this->add_responsive_control(
			'card_align',
			[
				'label'     => __( 'Alinhamento', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => __( 'Esquerda', 'amazing-widgets-for-elementor' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => __( 'Centralizado', 'amazing-widgets-for-elementor' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => __( 'Direita', 'amazing-widgets-for-elementor' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .codefronts-card' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		// Estilo do Ícone
		$this->start_controls_section(
			'section_style_icon',
			[
				'label' => __( 'Ícone', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'icon_color',
			[
				'label'     => __( 'Cor do Ícone', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-icon'     => 'color: {{VALUE}};',
					'{{WRAPPER}} .card-icon svg' => 'fill: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_size',
			[
				'label'      => __( 'Tamanho', 'amazing-widgets-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'em', 'rem' ],
				'range'      => [
					'px' => [ 'min' => 10, 'max' => 100 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .card-icon'     => 'font-size: {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .card-icon svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'icon_margin',
			[
				'label'      => __( 'Margem Inferior', 'amazing-widgets-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 60 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .card-icon' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Estilo do Título
		$this->start_controls_section(
			'section_style_title',
			[
				'label' => __( 'Título', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => __( 'Cor da Fonte', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => __( 'Tipografia', 'amazing-widgets-for-elementor' ),
				'selector' => '{{WRAPPER}} .card-title',
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => __( 'Margem Inferior', 'amazing-widgets-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 60 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .card-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Estilo da Descrição
		$this->start_controls_section(
			'section_style_description',
			[
				'label' => __( 'Descrição', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'description_color',
			[
				'label'     => __( 'Cor da Fonte', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-description' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'description_typography',
				'label'    => __( 'Tipografia', 'amazing-widgets-for-elementor' ),
				'selector' => '{{WRAPPER}} .card-description',
			]
		);

		$this->add_responsive_control(
			'description_margin',
			[
				'label'      => __( 'Margem Inferior', 'amazing-widgets-for-elementor' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [ 'min' => 0, 'max' => 60 ],
				],
				'selectors'  => [
					'{{WRAPPER}} .card-description' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		// Estilo do Botão
		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __( 'Botão', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->start_controls_tabs( 'tabs_button_style' );

		// Aba Normal
		$this->start_controls_tab(
			'tab_button_normal',
			[
				'label' => __( 'Normal', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->add_control(
			'button_text_color',
			[
				'label'     => __( 'Cor do Texto', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_bg_color',
			[
				'label'     => __( 'Cor de Fundo', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		// Aba Hover
		$this->start_controls_tab(
			'tab_button_hover',
			[
				'label' => __( 'Hover', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->add_control(
			'button_hover_text_color',
			[
				'label'     => __( 'Cor do Texto', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_hover_bg_color',
			[
				'label'     => __( 'Cor de Fundo', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .card-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'button_typography',
				'label'    => __( 'Tipografia', 'amazing-widgets-for-elementor' ),
				'selector' => '{{WRAPPER}} .card-button',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'button_padding',
			[
				'label'      => __( 'Espaçamento Interno (Padding)', 'amazing-widgets-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .card-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'button_border_radius',
			[
				'label'      => __( 'Arredondamento de Canto', 'amazing-widgets-for-elementor' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .card-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		// Atributos de edição inline para o Elementor
		$this->add_render_attribute( 'card_title', 'class', 'card-title' );
		$this->add_inline_editing_attributes( 'card_title', 'none' );

		$this->add_render_attribute( 'card_description', 'class', 'card-description' );
		$this->add_inline_editing_attributes( 'card_description', 'basic' );

		$this->add_render_attribute( 'button_text', 'class', 'card-button' );
		$this->add_inline_editing_attributes( 'button_text', 'none' );

		// Configuração de link do botão
		if ( ! empty( $settings['button_link']['url'] ) ) {
			$this->add_link_attributes( 'button_text', $settings['button_link'] );
		}
		?>
		<div class="amazing-widget-exemplo-card">
			<div class="codefronts-card">
				<?php if ( ! empty( $settings['selected_icon']['value'] ) ) : ?>
					<div class="card-icon">
						<?php Icons_Manager::render_icon( $settings['selected_icon'], [ 'aria-hidden' => 'true' ] ); ?>
					</div>
				<?php endif; ?>

				<?php if ( ! empty( $settings['card_title'] ) ) : ?>
					<h3 <?php $this->print_render_attribute_string( 'card_title' ); ?>>
						<?php echo esc_html( $settings['card_title'] ); ?>
					</h3>
				<?php endif; ?>

				<?php if ( ! empty( $settings['card_description'] ) ) : ?>
					<p <?php $this->print_render_attribute_string( 'card_description' ); ?>>
						<?php echo esc_html( $settings['card_description'] ); ?>
					</p>
				<?php endif; ?>

				<?php if ( ! empty( $settings['button_text'] ) ) : ?>
					<a <?php $this->print_render_attribute_string( 'button_text' ); ?>>
						<?php echo esc_html( $settings['button_text'] ); ?>
					</a>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<#
		view.addRenderAttribute( 'card_title', 'class', 'card-title' );
		view.addInlineEditingAttributes( 'card_title', 'none' );

		view.addRenderAttribute( 'card_description', 'class', 'card-description' );
		view.addInlineEditingAttributes( 'card_description', 'basic' );

		view.addRenderAttribute( 'button_text', 'class', 'card-button' );
		view.addInlineEditingAttributes( 'button_text', 'none' );

		var iconHTML = elementor.helpers.renderIcon( view, settings.selected_icon, { 'aria-hidden': true }, 'i', 'object' );
		#>
		<div class="amazing-widget-exemplo-card">
			<div class="codefronts-card">
				<# if ( settings.selected_icon && settings.selected_icon.value ) { #>
					<div class="card-icon">
						{{{ iconHTML.value }}}
					</div>
				<# } #>

				<# if ( settings.card_title ) { #>
					<h3 {{{ view.getRenderAttributeString( 'card_title' ) }}}>
						{{{ settings.card_title }}}
					</h3>
				<# } #>

				<# if ( settings.card_description ) { #>
					<p {{{ view.getRenderAttributeString( 'card_description' ) }}}>
						{{{ settings.card_description }}}
					</p>
				<# } #>

				<# if ( settings.button_text ) { #>
					<a href="{{{ settings.button_link.url }}}" {{{ view.getRenderAttributeString( 'button_text' ) }}}>
						{{{ settings.button_text }}}
					</a>
				<# } #>
			</div>
		</div>
		<?php
	}
}
