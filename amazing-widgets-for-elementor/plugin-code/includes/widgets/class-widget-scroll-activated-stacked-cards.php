<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_Scroll_Activated_Stacked_Cards extends Widget_Base {

	public function get_name() {
		return 'amazing-scroll-activated-stacked-cards';
	}

	public function get_title() {
		return __( 'Scroll Activated Sticky Stack', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-post-list';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-scroll-activated-stacked-cards' ];
	}

	public function get_script_depends() {
		return [ 'amazing-widget-scroll-activated-stacked-cards' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_steps',
			[
				'label' => __( 'Passos / Cards', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'idx',
			[
				'label'   => __( 'Número do Passo', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			]
		);

		$repeater->add_control(
			'chip',
			[
				'label'   => __( 'Tag / Fase', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Phase one',
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Título', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Discover',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'description',
			[
				'label'   => __( 'Descrição', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'We map your goals and audit exactly where you stand today.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'gradient',
			[
				'label'   => __( 'Gradiente CSS de Fundo', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'linear-gradient(135deg,#1e1b4b,#4338ca 45%,#7c3aed)',
			]
		);

		$this->add_control(
			'steps_list',
			[
				'label'       => __( 'Lista de Passos', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'idx'         => '01',
						'chip'        => 'Phase one',
						'title'       => 'Discover',
						'description' => 'We map your goals and audit exactly where you stand today.',
						'gradient'    => 'linear-gradient(135deg,#1e1b4b,#4338ca 45%,#7c3aed)',
					],
					[
						'idx'         => '02',
						'chip'        => 'Phase two',
						'title'       => 'Design',
						'description' => 'Concepts take shape through rapid, collaborative iteration.',
						'gradient'    => 'linear-gradient(135deg,#831843,#be185d 45%,#fb7185)',
					],
					[
						'idx'         => '03',
						'chip'        => 'Phase three',
						'title'       => 'Build',
						'description' => 'Production-ready code, tested and shipped with real care.',
						'gradient'    => 'linear-gradient(135deg,#064e3b,#0d9488 50%,#34d399)',
					],
					[
						'idx'         => '04',
						'chip'        => 'Phase four',
						'title'       => 'Launch',
						'description' => 'We go live, measure everything, then refine what works.',
						'gradient'    => 'linear-gradient(135deg,#7c2d12,#ea580c 45%,#fbbf24)',
					],
				],
				'title_field' => '{{{ idx }}} - {{{ title }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="amazing-widget-scroll-activated-stacked-cards">
			<div class="scd-29">
				<div class="scd-29__scroll-wrap">
					<?php foreach ( $settings['steps_list'] as $i => $step ) :
						$top_val = 20 + ( $i * 2 );
						$grad_style = ! empty( $step['gradient'] ) ? "background: {$step['gradient']};" : '';
						?>
						<section class="scd-29__step" style="top: <?php echo esc_attr( $top_val ); ?>vh;">
							<div class="scd-29__grad" style="<?php echo esc_attr( $grad_style ); ?>"></div>
							<div class="scd-29__sheen"></div>
							<div class="scd-29__top">
								<span class="scd-29__idx"><?php echo esc_html( $step['idx'] ); ?></span>
								<span class="scd-29__chip"><?php echo esc_html( $step['chip'] ); ?></span>
							</div>
							<div>
								<h2 class="scd-29__h2"><?php echo esc_html( $step['title'] ); ?></h2>
								<p class="scd-29__p"><?php echo esc_html( $step['description'] ); ?></p>
								<div class="scd-29__bar"><i></i></div>
							</div>
						</section>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-scroll-activated-stacked-cards">
			<div class="scd-29">
				<div class="scd-29__scroll-wrap">
					<# _.each( settings.steps_list, function( step, i ) {
						var top_val = 20 + ( i * 2 );
						var grad_style = step.gradient ? 'background: ' + step.gradient + ';' : '';
					#>
						<section class="scd-29__step" style="top: {{{ top_val }}}vh;">
							<div class="scd-29__grad" style="{{{ grad_style }}}"></div>
							<div class="scd-29__sheen"></div>
							<div class="scd-29__top">
								<span class="scd-29__idx">{{{ step.idx }}}</span>
								<span class="scd-29__chip">{{{ step.chip }}}</span>
							</div>
							<div>
								<h2 class="scd-29__h2">{{{ step.title }}}</h2>
								<p class="scd-29__p">{{{ step.description }}}</p>
								<div class="scd-29__bar"><i></i></div>
							</div>
						</section>
					<# }); #>
				</div>
			</div>
		</div>
		<?php
	}
}
