<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Amazing_Widget_Animated_Gradient_Border_Card extends Widget_Base {

	public function get_name() {
		return 'amazing-animated-gradient-border-card';
	}

	public function get_title() {
		return __( 'Animated Conic Border Card', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-border-style';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-animated-gradient-border-card' ];
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
			'card_style',
			[
				'label'   => __( 'Estilo de Borda', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'solid',
				'options' => [
					'solid' => __( 'Solid + Bloom Glow', 'amazing-widgets-for-elementor' ),
					'mask'  => __( 'Glass Mask Ring', 'amazing-widgets-for-elementor' ),
					'comet' => __( 'Comet Trail Arc', 'amazing-widgets-for-elementor' ),
				],
			]
		);

		$repeater->add_control(
			'eyebrow',
			[
				'label'   => __( 'Subtítulo (Eyebrow)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Conic sweep', 'amazing-widgets-for-elementor' ),
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Título', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Registered angle', 'amazing-widgets-for-elementor' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'description',
			[
				'label'   => __( 'Descrição', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => __( 'Animated @property <angle> conic border gradient effect.', 'amazing-widgets-for-elementor' ),
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'meta',
			[
				'label'   => __( 'Texto Rodapé (Meta)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '5 s linear · hover to accelerate', 'amazing-widgets-for-elementor' ),
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
						'card_style'  => 'solid',
						'eyebrow'     => 'Conic sweep',
						'title'       => 'Registered angle',
						'description' => 'A single @property <angle> animated 0 -> 360deg behind an opaque card.',
						'meta'        => '5 s linear · hover to accelerate',
					],
					[
						'card_style'  => 'mask',
						'eyebrow'     => 'Mask composite',
						'title'       => 'True ring',
						'description' => 'Two masks subtracted leave a real 2 px ring, so the card behind it stays glassy.',
						'meta'        => 'mask-composite: exclude',
					],
					[
						'card_style'  => 'comet',
						'eyebrow'     => 'Partial arc',
						'title'       => 'Comet trail',
						'description' => 'Transparent stops turn the full sweep into a single travelling highlight.',
						'meta'        => '3.2 s linear · transparent stops',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'chip_text',
			[
				'label'   => __( 'Texto de Informação (Chip)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '@property <angle> · conic-gradient(from var(--a)) · mask-composite ring', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Estilo Geral', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'bg_color',
			[
				'label'     => __( 'Cor de Fundo', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ac-18' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="amazing-widget-animated-gradient-border-card">
			<section class="ac-18">
				<div class="ac-18__stage">
					<div class="ac-18__row">
						<?php foreach ( $settings['cards_list'] as $item ) :
							$style = $item['card_style'];
							$class_map = [
								'solid' => 'ac-18__card--solid',
								'mask'  => 'ac-18__card--mask',
								'comet' => 'ac-18__card--comet',
							];
							$card_class = isset( $class_map[ $style ] ) ? $class_map[ $style ] : 'ac-18__card--solid';
							?>
							<article class="ac-18__card <?php echo esc_attr( $card_class ); ?>">
								<?php if ( 'solid' === $style ) : ?>
									<span class="ac-18__bloom" aria-hidden="true"></span>
								<?php endif; ?>

								<?php if ( ! empty( $item['eyebrow'] ) ) : ?>
									<p class="ac-18__eyebrow"><?php echo esc_html( $item['eyebrow'] ); ?></p>
								<?php endif; ?>

								<?php if ( ! empty( $item['title'] ) ) : ?>
									<h3 class="ac-18__title"><?php echo esc_html( $item['title'] ); ?></h3>
								<?php endif; ?>

								<?php if ( ! empty( $item['description'] ) ) : ?>
									<p class="ac-18__copy"><?php echo esc_html( $item['description'] ); ?></p>
								<?php endif; ?>

								<?php if ( ! empty( $item['meta'] ) ) : ?>
									<p class="ac-18__meta"><?php echo esc_html( $item['meta'] ); ?></p>
								<?php endif; ?>
							</article>
						<?php endforeach; ?>
					</div>
					<?php if ( ! empty( $settings['chip_text'] ) ) : ?>
						<p class="ac-18__chip"><?php echo esc_html( $settings['chip_text'] ); ?></p>
					<?php endif; ?>
				</div>
			</section>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-animated-gradient-border-card">
			<section class="ac-18">
				<div class="ac-18__stage">
					<div class="ac-18__row">
						<# _.each( settings.cards_list, function( item ) {
							var style_class = 'ac-18__card--solid';
							if ( item.card_style === 'mask' ) style_class = 'ac-18__card--mask';
							if ( item.card_style === 'comet' ) style_class = 'ac-18__card--comet';
						#>
							<article class="ac-18__card {{{ style_class }}}">
								<# if ( item.card_style === 'solid' ) { #>
									<span class="ac-18__bloom" aria-hidden="true"></span>
								<# } #>

								<# if ( item.eyebrow ) { #>
									<p class="ac-18__eyebrow">{{{ item.eyebrow }}}</p>
								<# } #>

								<# if ( item.title ) { #>
									<h3 class="ac-18__title">{{{ item.title }}}</h3>
								<# } #>

								<# if ( item.description ) { #>
									<p class="ac-18__copy">{{{ item.description }}}</p>
								<# } #>

								<# if ( item.meta ) { #>
									<p class="ac-18__meta">{{{ item.meta }}}</p>
								<# } #>
							</article>
						<# }); #>
					</div>
					<# if ( settings.chip_text ) { #>
						<p class="ac-18__chip">{{{ settings.chip_text }}}</p>
					<# } #>
				</div>
			</section>
		</div>
		<?php
	}
}
