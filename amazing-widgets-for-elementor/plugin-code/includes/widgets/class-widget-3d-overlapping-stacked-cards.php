<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Amazing_Widget_3D_Overlapping_Stacked_Cards extends Widget_Base {

	public function get_name() {
		return 'amazing-3d-overlapping-stacked-cards';
	}

	public function get_title() {
		return __( '3D Stacked Cards (Isometric)', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-cards';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-3d-overlapping-stacked-cards' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_cards',
			[
				'label' => __( 'Cards', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'card_title',
			[
				'label'       => __( 'Título do Plano', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'STARTER', 'amazing-widgets-for-elementor' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'card_features',
			[
				'label'       => __( 'Recursos / Recursos', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '1 seat · core features', 'amazing-widgets-for-elementor' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'card_price',
			[
				'label'       => __( 'Preço', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '$9', 'amazing-widgets-for-elementor' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'card_period',
			[
				'label'       => __( 'Período', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '/mo', 'amazing-widgets-for-elementor' ),
			]
		);

		$repeater->add_control(
			'card_bg_gradient_start',
			[
				'label'     => __( 'Cor Gradiente Inicial', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#3a4cf0',
			]
		);

		$repeater->add_control(
			'card_bg_gradient_end',
			[
				'label'     => __( 'Cor Gradiente Final', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#6d7cff',
			]
		);

		$repeater->add_control(
			'card_text_color',
			[
				'label'     => __( 'Cor do Texto', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
			]
		);

		$this->add_control(
			'cards_list',
			[
				'label'       => __( 'Lista de Cards', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'card_title' => __( 'STARTER', 'amazing-widgets-for-elementor' ),
						'card_features' => __( '1 seat · core features', 'amazing-widgets-for-elementor' ),
						'card_price' => '$9',
						'card_period' => '/mo',
						'card_bg_gradient_start' => '#3a4cf0',
						'card_bg_gradient_end' => '#6d7cff',
						'card_text_color' => '#ffffff',
					],
					[
						'card_title' => __( 'GROWTH', 'amazing-widgets-for-elementor' ),
						'card_features' => __( '10 seats · analytics · API', 'amazing-widgets-for-elementor' ),
						'card_price' => '$29',
						'card_period' => '/mo',
						'card_bg_gradient_start' => '#f0466b',
						'card_bg_gradient_end' => '#ff7aa0',
						'card_text_color' => '#ffffff',
					],
					[
						'card_title' => __( 'SCALE', 'amazing-widgets-for-elementor' ),
						'card_features' => __( 'Unlimited seats · SSO · SLA', 'amazing-widgets-for-elementor' ),
						'card_price' => '$79',
						'card_period' => '/mo',
						'card_bg_gradient_start' => '#11b894',
						'card_bg_gradient_end' => '#46f0c4',
						'card_text_color' => '#03241c',
					],
				],
				'title_field' => '{{{ card_title }}}',
			]
		);

		$this->add_control(
			'hint_text',
			[
				'label'       => __( 'Texto de Ajuda (Hint)', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'HOVER TO COMPARE PLANS', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();

		// ESTILOS
		$this->start_controls_section(
			'section_style_general',
			[
				'label' => __( 'Estilo Geral', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'container_bg',
			[
				'label'     => __( 'Fundo do Container', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .scd-31' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hint_color',
			[
				'label'     => __( 'Cor do Texto de Dica', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .scd-31__hint' => 'color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$cards = $settings['cards_list'];
		$count = count( $cards );
		?>
		<div class="amazing-widget-3d-overlapping-stacked-cards">
			<div class="scd-31">
				<div class="scd-31__stage">
					<div class="scd-31__stack">
						<?php
						if ( ! empty( $cards ) ) :
							// Render in reverse order so top item matches expected z index layering
							$reversed_cards = array_reverse( $cards, true );
							foreach ( $reversed_cards as $index => $item ) :
								$card_num = $count - $index;
								$z_offset = $card_num * 12;
								$hover_x = 0;
								$hover_y = 0;

								if ( $card_num === 1 ) {
									$hover_x = -150;
									$hover_y = -150;
								} elseif ( $card_num === $count && $count > 2 ) {
									$hover_x = 150;
									$hover_y = 150;
								}

								$bg = "linear-gradient(135deg, {$item['card_bg_gradient_start']}, {$item['card_bg_gradient_end']})";
								$style = "background: {$bg}; color: {$item['card_text_color']}; transform: translateZ({$z_offset}px) translate(0,0);";
								$key = 'card_' . $index;
								$this->add_render_attribute( $key, 'class', 'scd-31__plane' );
								$this->add_render_attribute( $key, 'style', $style );
								$this->add_render_attribute( $key, 'data-hover-x', $hover_x );
								$this->add_render_attribute( $key, 'data-hover-y', $hover_y );
								$this->add_render_attribute( $key, 'data-z', $z_offset );
								?>
								<div <?php $this->print_render_attribute_string( $key ); ?>>
									<span class="scd-31__tier"><?php echo esc_html( $item['card_title'] ); ?></span>
									<span class="scd-31__feat"><?php echo esc_html( $item['card_features'] ); ?></span>
									<span class="scd-31__price">
										<?php echo esc_html( $item['card_price'] ); ?>
										<small><?php echo esc_html( $item['card_period'] ); ?></small>
									</span>
								</div>
							<?php
							endforeach;
						endif;
						?>
					</div>
					<?php if ( ! empty( $settings['hint_text'] ) ) : ?>
						<span class="scd-31__hint"><?php echo esc_html( $settings['hint_text'] ); ?></span>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<style>
		<?php foreach ( $cards as $index => $item ) :
			$card_num = $count - $index;
			$z_offset = $card_num * 12;
			$hover_x = 0;
			$hover_y = 0;
			if ( $index === 0 ) { // top layer
				$hover_x = -150;
				$hover_y = -150;
			} elseif ( $index === $count - 1 && $count > 1 ) { // bottom layer
				$hover_x = 150;
				$hover_y = 150;
			}
			$nth = $index + 1;
			echo "{{WRAPPER}} .scd-31__plane:nth-child({$nth}) { transform: translateZ({$z_offset}px) translate(0,0); }\n";
			echo "{{WRAPPER}} .scd-31__stage:hover .scd-31__plane:nth-child({$nth}) { transform: translateZ({$z_offset}px) translate({$hover_x}px, {$hover_y}px); }\n";
		endforeach; ?>
		</style>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-3d-overlapping-stacked-cards">
			<div class="scd-31">
				<div class="scd-31__stage">
					<div class="scd-31__stack">
						<#
						if ( settings.cards_list.length ) {
							var count = settings.cards_list.length;
							var reversed = settings.cards_list.slice().reverse();
							_.each( reversed, function( item, index ) {
								var card_num = count - index;
								var z_offset = card_num * 12;
								var hover_x = 0;
								var hover_y = 0;
								if ( index === 0 ) {
									hover_x = -150;
									hover_y = -150;
								} else if ( index === count - 1 && count > 1 ) {
									hover_x = 150;
									hover_y = 150;
								}
								var bg = 'linear-gradient(135deg, ' + item.card_bg_gradient_start + ', ' + item.card_bg_gradient_end + ')';
								var style = 'background: ' + bg + '; color: ' + item.card_text_color + '; transform: translateZ(' + z_offset + 'px) translate(0,0);';
								#>
								<div class="scd-31__plane" style="{{{ style }}}">
									<span class="scd-31__tier">{{{ item.card_title }}}</span>
									<span class="scd-31__feat">{{{ item.card_features }}}</span>
									<span class="scd-31__price">
										{{{ item.card_price }}}
										<small>{{{ item.card_period }}}</small>
									</span>
								</div>
								<#
							});
						}
						#>
					</div>
					<# if ( settings.hint_text ) { #>
						<span class="scd-31__hint">{{{ settings.hint_text }}}</span>
					<# } #>
				</div>
			</div>
		</div>
		<?php
	}
}
