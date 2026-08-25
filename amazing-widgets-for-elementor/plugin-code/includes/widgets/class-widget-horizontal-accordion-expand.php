<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_Horizontal_Accordion_Expand extends Widget_Base {

	public function get_name() {
		return 'amazing-horizontal-accordion-expand';
	}

	public function get_title() {
		return __( 'Horizontal Accordion Expand', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-column';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-horizontal-accordion-expand' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_header',
			[
				'label' => __( 'Cabeçalho', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'eyebrow',
			[
				'label'   => __( 'Subtítulo (Eyebrow)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Gallery layout',
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => __( 'Título Principal', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Hover a panel — or tab through it',
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_panels',
			[
				'label' => __( 'Painéis (Galeria)', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Imagem', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => 'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?q=80&w=900&auto=format&fit=crop',
				],
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Título do Painel', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Cascade Fog',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'subtitle',
			[
				'label'   => __( 'Subtítulo / Info', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Oregon · 06:14',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'   => __( 'Link do Painel', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::URL,
				'default' => [ 'url' => '#' ],
			]
		);

		$this->add_control(
			'panels_list',
			[
				'label'       => __( 'Lista de Painéis (Max 5)', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title'    => 'Cascade Fog',
						'subtitle' => 'Oregon · 06:14',
						'image'    => [ 'url' => 'https://images.unsplash.com/photo-1470071459604-3b5ec3a7fe05?q=80&w=900&auto=format&fit=crop' ],
					],
					[
						'title'    => 'First Light',
						'subtitle' => 'Dolomites · 05:41',
						'image'    => [ 'url' => 'https://images.unsplash.com/photo-1493246507139-91e8fad9978e?q=80&w=900&auto=format&fit=crop' ],
					],
					[
						'title'    => 'Glass Water',
						'subtitle' => 'Wanaka · 07:02',
						'image'    => [ 'url' => 'https://images.unsplash.com/photo-1506744038136-46273834b3fb?q=80&w=900&auto=format&fit=crop' ],
					],
					[
						'title'    => 'Understory',
						'subtitle' => 'Vancouver Is. · 09:20',
						'image'    => [ 'url' => 'https://images.unsplash.com/photo-1441974231531-c6227db76b6e?q=80&w=900&auto=format&fit=crop' ],
					],
					[
						'title'    => 'Night Grid',
						'subtitle' => 'Orbit · 23:58',
						'image'    => [ 'url' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=900&auto=format&fit=crop' ],
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'chip_text',
			[
				'label'   => __( 'Texto de Rodapé', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( ':has() parent selector · animatable grid-template-columns · pure CSS', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$count    = count( $settings['panels_list'] );
		?>
		<div class="amazing-widget-horizontal-accordion-expand">
			<section class="ac-24">
				<div class="ac-24__stage">
					<header class="ac-24__head">
						<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
							<p class="ac-24__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $settings['title'] ) ) : ?>
							<h2 class="ac-24__title"><?php echo esc_html( $settings['title'] ); ?></h2>
						<?php endif; ?>
					</header>

					<div class="ac-24__rail" style="grid-template-columns: repeat(<?php echo esc_attr( $count ); ?>, 1fr);">
						<?php foreach ( $settings['panels_list'] as $i => $panel ) :
							$img_url = ! empty( $panel['image']['url'] ) ? $panel['image']['url'] : '';
							$url     = ! empty( $panel['link']['url'] ) ? $panel['link']['url'] : '#';
							?>
							<a class="ac-24__panel" href="<?php echo esc_url( $url ); ?>">
								<?php if ( $img_url ) : ?>
									<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $panel['title'] ); ?>" loading="lazy">
								<?php endif; ?>
								<span class="ac-24__scrim" aria-hidden="true"></span>
								<span class="ac-24__cap">
									<b><?php echo esc_html( $panel['title'] ); ?></b>
									<i><?php echo esc_html( $panel['subtitle'] ); ?></i>
								</span>
							</a>
						<?php endforeach; ?>
					</div>

					<?php if ( ! empty( $settings['chip_text'] ) ) : ?>
						<p class="ac-24__chip"><?php echo esc_html( $settings['chip_text'] ); ?></p>
					<?php endif; ?>
				</div>
			</section>
		</div>

		<style>
		<?php for ( $idx = 1; $idx <= $count; $idx++ ) :
			$cols = array_fill( 0, $count, '1fr' );
			$cols[ $idx - 1 ] = '2.6fr';
			$cols_str = implode( ' ', $cols );
			echo "{{WRAPPER}} .ac-24__rail:has(.ac-24__panel:nth-child({$idx}):hover), {{WRAPPER}} .ac-24__rail:has(.ac-24__panel:nth-child({$idx}):focus-within) { grid-template-columns: {$cols_str}; }\n";
		endfor; ?>
		</style>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-horizontal-accordion-expand">
			<section class="ac-24">
				<div class="ac-24__stage">
					<header class="ac-24__head">
						<# if ( settings.eyebrow ) { #>
							<p class="ac-24__eyebrow">{{{ settings.eyebrow }}}</p>
						<# } #>

						<# if ( settings.title ) { #>
							<h2 class="ac-24__title">{{{ settings.title }}}</h2>
						<# } #>
					</header>

					<div class="ac-24__rail" style="grid-template-columns: repeat({{{ settings.panels_list.length }}}, 1fr);">
						<# _.each( settings.panels_list, function( panel ) { #>
							<a class="ac-24__panel" href="{{{ panel.link.url }}}">
								<# if ( panel.image.url ) { #>
									<img src="{{{ panel.image.url }}}" alt="{{{ panel.title }}}">
								<# } #>
								<span class="ac-24__scrim" aria-hidden="true"></span>
								<span class="ac-24__cap">
									<b>{{{ panel.title }}}</b>
									<i>{{{ panel.subtitle }}}</i>
								</span>
							</a>
						<# }); #>
					</div>

					<# if ( settings.chip_text ) { #>
						<p class="ac-24__chip">{{{ settings.chip_text }}}</p>
					<# } #>
				</div>
			</section>
		</div>
		<?php
	}
}
