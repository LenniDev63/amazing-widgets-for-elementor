<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_CSS_Stacked_Cards_Hover_Reveal extends Widget_Base {

	public function get_name() {
		return 'amazing-css-stacked-cards-hover-reveal';
	}

	public function get_title() {
		return __( 'Stacked Cards Hover Reveal', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-stack';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-css-stacked-cards-hover-reveal' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_cards',
			[
				'label' => __( 'Cards no Stack', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'chip',
			[
				'label'   => __( 'Chip / Tag', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Index',
			]
		);

		$repeater->add_control(
			'idx',
			[
				'label'   => __( 'Número / Índice', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Título', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Selected works',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'desc',
			[
				'label'   => __( 'Descrição', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Hover to open the deck. Move to explore.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'cta',
			[
				'label'   => __( 'Texto Botão (CTA)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Begin',
			]
		);

		$repeater->add_control(
			'gradient',
			[
				'label'   => __( 'Gradiente CSS de Fundo', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'linear-gradient(135deg,#1e1b4b,#4338ca 40%,#6d28d9)',
			]
		);

		$this->add_control(
			'cards_list',
			[
				'label'       => __( 'Lista de Cards (Max 4 recomendado)', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'chip'     => 'Type',
						'idx'      => '04',
						'title'    => 'Letter forms',
						'desc'     => 'An editorial typography system built for screens.',
						'cta'      => 'View case',
						'gradient' => 'linear-gradient(135deg,#7c2d12,#ea580c 45%,#f59e0b)',
					],
					[
						'chip'     => 'Motion',
						'idx'      => '03',
						'title'    => 'In motion',
						'desc'     => 'Kinetic brand identity that moves with intent.',
						'cta'      => 'View case',
						'gradient' => 'linear-gradient(135deg,#064e3b,#0d9488 50%,#2dd4bf)',
					],
					[
						'chip'     => 'Color',
						'idx'      => '02',
						'title'    => 'Warm tones',
						'desc'     => 'Palette & art direction with a human warmth.',
						'cta'      => 'View case',
						'gradient' => 'linear-gradient(135deg,#831843,#be185d 45%,#f43f5e)',
					],
					[
						'chip'     => 'Index',
						'idx'      => '01',
						'title'    => 'Selected works',
						'desc'     => 'Hover to open the deck. Move to explore.',
						'cta'      => 'Begin',
						'gradient' => 'linear-gradient(135deg,#1e1b4b,#4338ca 40%,#6d28d9)',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$cards    = $settings['cards_list'];
		$count    = count( $cards );
		?>
		<div class="amazing-widget-css-stacked-cards-hover-reveal">
			<div class="scd-28">
				<div class="scd-28__stage">
					<div class="scd-28__deck">
						<?php foreach ( $cards as $index => $item ) :
							$nth = $count - $index;
							$grad_style = ! empty( $item['gradient'] ) ? "background: {$item['gradient']};" : '';
							?>
							<div class="scd-28__card scd-28__card--c<?php echo esc_attr( $nth ); ?>">
								<div class="scd-28__surface">
									<div class="scd-28__grad" style="<?php echo esc_attr( $grad_style ); ?>"></div>
									<div class="scd-28__glow"></div>
									<div class="scd-28__sheen"></div>
								</div>
								<div class="scd-28__content">
									<div class="scd-28__meta">
										<span class="scd-28__chip"><?php echo esc_html( $item['chip'] ); ?></span>
										<span class="scd-28__idx"><?php echo esc_html( $item['idx'] ); ?></span>
									</div>
									<div class="scd-28__title"><?php echo esc_html( $item['title'] ); ?></div>
									<div class="scd-28__row">
										<p class="scd-28__desc"><?php echo esc_html( $item['desc'] ); ?></p>
									</div>
									<span class="scd-28__cta">
										<?php echo esc_html( $item['cta'] ); ?>
										<span class="scd-28__arrow">&rarr;</span>
									</span>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="scd-28__floor"></div>
				</div>
			</div>
		</div>

		<style>
		<?php
		$offsets = [
			1 => ['idle' => 'translateZ(0) translateY(0) rotate(-3deg)', 'spread' => 'translate(-165px,-30px) translateZ(40px) rotate(-12deg)', 'hover' => 'translate(-165px,-56px) translateZ(90px) rotate(-12deg) scale(1.06)'],
			2 => ['idle' => 'translateZ(-40px) translateY(10px) rotate(2deg)', 'spread' => 'translate(-55px,18px) translateZ(20px) rotate(-4deg)', 'hover' => 'translate(-55px,-8px) translateZ(90px) rotate(-4deg) scale(1.06)'],
			3 => ['idle' => 'translateZ(-80px) translateY(20px) rotate(-2deg)', 'spread' => 'translate(55px,18px) translateZ(20px) rotate(4deg)', 'hover' => 'translate(55px,-8px) translateZ(90px) rotate(4deg) scale(1.06)'],
			4 => ['idle' => 'translateZ(-120px) translateY(30px) rotate(3deg)', 'spread' => 'translate(165px,-30px) translateZ(40px) rotate(12deg)', 'hover' => 'translate(165px,-56px) translateZ(90px) rotate(12deg) scale(1.06)'],
		];
		foreach ( $cards as $index => $item ) :
			$c_num = $count - $index;
			$o = isset($offsets[$c_num]) ? $offsets[$c_num] : $offsets[1];
			echo "{{WRAPPER}} .scd-28__card--c{$c_num} { transform: {$o['idle']}; z-index: {$c_num}; }\n";
			echo "{{WRAPPER}} .scd-28__stage:hover:not(:has(.scd-28__card:hover)) .scd-28__card--c{$c_num} { transform: {$o['spread']}; filter: brightness(1); }\n";
			echo "{{WRAPPER}} .scd-28__stage:hover .scd-28__card--c{$c_num}:hover { transform: {$o['hover']}; filter: brightness(1.05); z-index: 9; }\n";
		endforeach;
		?>
		</style>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-css-stacked-cards-hover-reveal">
			<div class="scd-28">
				<div class="scd-28__stage">
					<div class="scd-28__deck">
						<#
						var count = settings.cards_list.length;
						_.each( settings.cards_list, function( item, index ) {
							var nth = count - index;
							var grad_style = item.gradient ? 'background: ' + item.gradient + ';' : '';
						#>
							<div class="scd-28__card scd-28__card--c{{{ nth }}}">
								<div class="scd-28__surface">
									<div class="scd-28__grad" style="{{{ grad_style }}}"></div>
									<div class="scd-28__glow"></div>
									<div class="scd-28__sheen"></div>
								</div>
								<div class="scd-28__content">
									<div class="scd-28__meta">
										<span class="scd-28__chip">{{{ item.chip }}}</span>
										<span class="scd-28__idx">{{{ item.idx }}}</span>
									</div>
									<div class="scd-28__title">{{{ item.title }}}</div>
									<div class="scd-28__row">
										<p class="scd-28__desc">{{{ item.desc }}}</p>
									</div>
									<span class="scd-28__cta">
										{{{ item.cta }}}
										<span class="scd-28__arrow">&rarr;</span>
									</span>
								</div>
							</div>
						<# }); #>
					</div>
					<div class="scd-28__floor"></div>
				</div>
			</div>
		</div>
		<?php
	}
}
