<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_Horizontal_Scroll_Section extends Widget_Base {

	public function get_name() {
		return 'amazing-horizontal-scroll-section';
	}

	public function get_title() {
		return __( 'Horizontal Scroll Section', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-h-align-stretch';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-horizontal-scroll-section' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_intro',
			[
				'label' => __( 'Introdução', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'intro_title',
			[
				'label'   => __( 'Título da Introdução', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Scroll down.<br>Travel sideways.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'intro_desc',
			[
				'label'   => __( 'Descrição da Introdução', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'A named view-timeline maps vertical progress onto horizontal motion.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_panels',
			[
				'label' => __( 'Painéis Horizontais', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'number',
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
				'default' => 'Named timelines',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'description',
			[
				'label'   => __( 'Descrição', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'view-timeline: --sda-05-h on the tall wrapper broadcasts progress.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'color',
			[
				'label'   => __( 'Cor do Painel (OKLCH ou HEX)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'oklch(0.62 0.17 264)',
			]
		);

		$this->add_control(
			'panels_list',
			[
				'label'       => __( 'Lista de Painéis', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'number'      => '01',
						'title'       => 'Named timelines',
						'description' => 'view-timeline: --sda-05-h on the tall wrapper broadcasts progress.',
						'color'       => 'oklch(0.62 0.17 264)',
					],
					[
						'number'      => '02',
						'title'       => 'Sticky pinning',
						'description' => 'position:sticky holds this stage on screen while the wrapper scrolls.',
						'color'       => 'oklch(0.62 0.15 210)',
					],
					[
						'number'      => '03',
						'title'       => 'One transform',
						'description' => 'translateX(0 -> -100% + 100vw): the end value self-adjusts.',
						'color'       => 'oklch(0.63 0.16 150)',
					],
					[
						'number'      => '04',
						'title'       => 'No pin-spacers',
						'description' => 'No resize listeners, no recalculation, momentum stays native.',
						'color'       => 'oklch(0.66 0.17 60)',
					],
				],
				'title_field' => '{{{ number }}} - {{{ title }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_outro',
			[
				'label' => __( 'Conclusão / Outro', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'outro_desc',
			[
				'label'   => __( 'Texto de Conclusão', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => "…and you're back to vertical. No hijack, no jank.",
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="amazing-widget-horizontal-scroll-section">
			<section class="sda-05" tabindex="0">
				<?php if ( ! empty( $settings['intro_title'] ) || ! empty( $settings['intro_desc'] ) ) : ?>
					<div class="sda-05__intro">
						<?php if ( ! empty( $settings['intro_title'] ) ) : ?>
							<h2><?php echo wp_kses_post( $settings['intro_title'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $settings['intro_desc'] ) ) : ?>
							<p><?php echo esc_html( $settings['intro_desc'] ); ?></p>
						<?php endif; ?>
					</div>
				<?php endif; ?>

				<div class="sda-05__wrap">
					<div class="sda-05__pin">
						<div class="sda-05__track">
							<?php foreach ( $settings['panels_list'] as $panel ) :
								$c_style = "--c:{$panel['color']};";
								?>
								<article class="sda-05__panel" style="<?php echo esc_attr( $c_style ); ?>">
									<span><?php echo esc_html( $panel['number'] ); ?></span>
									<h3><?php echo esc_html( $panel['title'] ); ?></h3>
									<p><?php echo esc_html( $panel['description'] ); ?></p>
								</article>
							<?php endforeach; ?>
						</div>
						<div class="sda-05__dots" aria-hidden="true">
							<div class="sda-05__thumb"></div>
						</div>
					</div>
				</div>

				<?php if ( ! empty( $settings['outro_desc'] ) ) : ?>
					<div class="sda-05__outro">
						<p><?php echo esc_html( $settings['outro_desc'] ); ?></p>
					</div>
				<?php endif; ?>
			</section>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-horizontal-scroll-section">
			<section class="sda-05" tabindex="0">
				<# if ( settings.intro_title || settings.intro_desc ) { #>
					<div class="sda-05__intro">
						<# if ( settings.intro_title ) { #>
							<h2>{{{ settings.intro_title }}}</h2>
						<# } #>
						<# if ( settings.intro_desc ) { #>
							<p>{{{ settings.intro_desc }}}</p>
						<# } #>
					</div>
				<# } #>

				<div class="sda-05__wrap">
					<div class="sda-05__pin">
						<div class="sda-05__track">
							<# _.each( settings.panels_list, function( panel ) {
								var c_style = '--c:' + panel.color + ';';
							#>
								<article class="sda-05__panel" style="{{{ c_style }}}">
									<span>{{{ panel.number }}}</span>
									<h3>{{{ panel.title }}}</h3>
									<p>{{{ panel.description }}}</p>
								</article>
							<# }); #>
						</div>
						<div class="sda-05__dots" aria-hidden="true">
							<div class="sda-05__thumb"></div>
						</div>
					</div>
				</div>

				<# if ( settings.outro_desc ) { #>
					<div class="sda-05__outro">
						<p>{{{ settings.outro_desc }}}</p>
					</div>
				<# } #>
			</section>
		</div>
		<?php
	}
}
