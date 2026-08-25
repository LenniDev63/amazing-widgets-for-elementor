<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_Cursor_Spotlight_Follow extends Widget_Base {

	public function get_name() {
		return 'amazing-cursor-spotlight-follow';
	}

	public function get_title() {
		return __( 'Cursor Spotlight Follow', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-search-bold';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-cursor-spotlight-follow' ];
	}

	public function get_script_depends() {
		return [ 'amazing-widget-cursor-spotlight-follow' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Conteúdo', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label'   => __( 'Imagem de Revelação no Fundo', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => 'https://images.unsplash.com/photo-1519681393784-d120267933ba?q=80&w=1800&auto=format&fit=crop',
				],
			]
		);

		$this->add_control(
			'eyebrow',
			[
				'label'   => __( 'Subtítulo (Eyebrow)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Pointer-reactive · Spotlight',
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => __( 'Título Principal', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Move the light.<br>The surface answers.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => __( 'Descrição', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Two custom properties are written on pointermove. The falloff, mask, and easing are pure CSS.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'stat_number',
			[
				'label'   => __( 'Número / Destaque', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '0',
			]
		);

		$repeater->add_control(
			'stat_label',
			[
				'label'   => __( 'Rótulo', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'rAF loops',
			]
		);

		$this->add_control(
			'stats_list',
			[
				'label'       => __( 'Estatísticas / Métricas', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[ 'stat_number' => '0', 'stat_label' => 'rAF loops' ],
					[ 'stat_number' => '2', 'stat_label' => 'properties written' ],
					[ 'stat_number' => '1', 'stat_label' => 'passive listener' ],
				],
				'title_field' => '{{{ stat_number }}} - {{{ stat_label }}}',
			]
		);

		$this->add_control(
			'hint_text',
			[
				'label'   => __( 'Texto de Dica', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Move your cursor — or wait, and it orbits on its own.', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$img_url  = ! empty( $settings['bg_image']['url'] ) ? $settings['bg_image']['url'] : '';
		?>
		<div class="amazing-widget-cursor-spotlight-follow">
			<section class="bga-02">
				<div class="bga-02__grid" aria-hidden="true"></div>
				<div class="bga-02__reveal" aria-hidden="true">
					<?php if ( $img_url ) : ?>
						<img class="bga-02__photo" src="<?php echo esc_url( $img_url ); ?>" alt="" loading="lazy">
					<?php endif; ?>
				</div>
				<div class="bga-02__beam" aria-hidden="true"></div>
				<div class="bga-02__vig" aria-hidden="true"></div>

				<div class="bga-02__stage">
					<div class="bga-02__panel">
						<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
							<p class="bga-02__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $settings['title'] ) ) : ?>
							<h2 class="bga-02__title"><?php echo wp_kses_post( $settings['title'] ); ?></h2>
						<?php endif; ?>

						<?php if ( ! empty( $settings['description'] ) ) : ?>
							<p class="bga-02__sub"><?php echo esc_html( $settings['description'] ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $settings['stats_list'] ) ) : ?>
							<ul class="bga-02__meta">
								<?php foreach ( $settings['stats_list'] as $stat ) : ?>
									<li>
										<b><?php echo esc_html( $stat['stat_number'] ); ?></b>
										<span><?php echo esc_html( $stat['stat_label'] ); ?></span>
									</li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
					</div>
					<?php if ( ! empty( $settings['hint_text'] ) ) : ?>
						<p class="bga-02__hint"><?php echo esc_html( $settings['hint_text'] ); ?></p>
					<?php endif; ?>
				</div>
			</section>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-cursor-spotlight-follow">
			<section class="bga-02">
				<div class="bga-02__grid" aria-hidden="true"></div>
				<div class="bga-02__reveal" aria-hidden="true">
					<# if ( settings.bg_image.url ) { #>
						<img class="bga-02__photo" src="{{{ settings.bg_image.url }}}" alt="">
					<# } #>
				</div>
				<div class="bga-02__beam" aria-hidden="true"></div>
				<div class="bga-02__vig" aria-hidden="true"></div>

				<div class="bga-02__stage">
					<div class="bga-02__panel">
						<# if ( settings.eyebrow ) { #>
							<p class="bga-02__eyebrow">{{{ settings.eyebrow }}}</p>
						<# } #>

						<# if ( settings.title ) { #>
							<h2 class="bga-02__title">{{{ settings.title }}}</h2>
						<# } #>

						<# if ( settings.description ) { #>
							<p class="bga-02__sub">{{{ settings.description }}}</p>
						<# } #>

						<# if ( settings.stats_list.length ) { #>
							<ul class="bga-02__meta">
								<# _.each( settings.stats_list, function( stat ) { #>
									<li>
										<b>{{{ stat.stat_number }}}</b>
										<span>{{{ stat.stat_label }}}</span>
									</li>
								<# }); #>
							</ul>
						<# } #>
					</div>
					<# if ( settings.hint_text ) { #>
						<p class="bga-02__hint">{{{ settings.hint_text }}}</p>
					<# } #>
				</div>
			</section>
		</div>
		<?php
	}
}
