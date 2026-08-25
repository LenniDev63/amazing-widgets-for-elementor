<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_CSS_Parallax_Card_Hover extends Widget_Base {

	public function get_name() {
		return 'amazing-css-parallax-card-hover';
	}

	public function get_title() {
		return __( 'CSS Parallax Hover Cards', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-image-rollover';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-css-parallax-card-hover' ];
	}

	public function get_script_depends() {
		return [ 'amazing-widget-css-parallax-card-hover' ];
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
			'top_label',
			[
				'label'   => __( 'Rótulo Superior', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'CSS Parallax · Mouse-Driven Tilt', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->add_control(
			'main_heading',
			[
				'label'   => __( 'Título Principal', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Hover over a card', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->add_control(
			'sub_heading',
			[
				'label'   => __( 'Subtítulo', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( '— any card.', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cards',
			[
				'label' => __( 'Cards', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'icon',
			[
				'label'   => __( 'Ícone / Emoji', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '🌌',
			]
		);

		$repeater->add_control(
			'tag',
			[
				'label'   => __( 'Tag / Categoria', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01 · Astrophysics',
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Título', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'The Observable Universe',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'body',
			[
				'label'   => __( 'Descrição', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => '93 billion light-years of space. Everything we know fits inside this sphere.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'cta',
			[
				'label'   => __( 'Texto Botão (CTA)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Explore',
			]
		);

		$repeater->add_control(
			'bg_gradient',
			[
				'label'       => __( 'Gradiente CSS de Fundo', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => 'radial-gradient(ellipse at 40% 40%, rgba(99,102,241,0.6) 0%, rgba(30,27,75,0.9) 60%)',
				'placeholder' => 'radial-gradient(...)',
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
						'icon'  => '🌌',
						'tag'   => '01 · Astrophysics',
						'title' => 'The Observable Universe',
						'body'  => '93 billion light-years of space. Everything we know fits inside this sphere.',
						'cta'   => 'Explore',
						'bg_gradient' => 'radial-gradient(ellipse at 40% 40%, rgba(99,102,241,0.6) 0%, rgba(30,27,75,0.9) 60%)',
					],
					[
						'icon'  => '💎',
						'tag'   => '02 · Mineralogy',
						'title' => 'Crystalline Structures',
						'body'  => 'Carbon under immense pressure becomes diamond. Chaos compressed into nature.',
						'cta'   => 'Discover',
						'bg_gradient' => 'radial-gradient(ellipse at 60% 40%, rgba(236,72,153,0.5) 0%, rgba(75,10,50,0.9) 60%)',
					],
					[
						'icon'  => '🌊',
						'tag'   => '03 · Oceanography',
						'title' => 'Deep Currents',
						'body'  => "The ocean's thermohaline circulation moves water around the entire planet.",
						'cta'   => 'Dive in',
						'bg_gradient' => 'radial-gradient(ellipse at 40% 60%, rgba(16,185,129,0.5) 0%, rgba(5,50,30,0.9) 60%)',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'footer_text',
			[
				'label'   => __( 'Texto de Rodapé', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Hover any card · 3 independent parallax layers · CSS transform + JS cursor', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="amazing-widget-css-parallax-card-hover">
			<div class="plx-08">
				<header class="plx-08__header">
					<?php if ( ! empty( $settings['top_label'] ) ) : ?>
						<p class="plx-08__label"><?php echo esc_html( $settings['top_label'] ); ?></p>
					<?php endif; ?>
					<h2>
						<?php echo esc_html( $settings['main_heading'] ); ?><br>
						<span><?php echo esc_html( $settings['sub_heading'] ); ?></span>
					</h2>
				</header>

				<div class="plx-08__grid">
					<?php foreach ( $settings['cards_list'] as $index => $item ) :
						$bg_style = ! empty( $item['bg_gradient'] ) ? "background: {$item['bg_gradient']};" : '';
						?>
						<div class="plx-08__card">
							<div class="plx-08__card-bg" style="<?php echo esc_attr( $bg_style ); ?>"></div>
							<div class="plx-08__card-light"></div>
							<div class="plx-08__card-noise"></div>
							<div class="plx-08__card-geo">
								<svg viewBox="0 0 300 440" xmlns="http://www.w3.org/2000/svg">
									<circle cx="250" cy="80" r="120" stroke="white" stroke-width="1" fill="none"/>
									<circle cx="250" cy="80" r="70" stroke="white" stroke-width="0.5" fill="none"/>
									<line x1="0" y1="440" x2="300" y2="0" stroke="white" stroke-width="0.4"/>
								</svg>
							</div>
							<div class="plx-08__card-content">
								<div class="plx-08__card-icon"><?php echo esc_html( $item['icon'] ); ?></div>
								<p class="plx-08__card-tag"><?php echo esc_html( $item['tag'] ); ?></p>
								<h3 class="plx-08__card-title"><?php echo esc_html( $item['title'] ); ?></h3>
								<p class="plx-08__card-body"><?php echo esc_html( $item['body'] ); ?></p>
								<span class="plx-08__card-cta"><?php echo esc_html( $item['cta'] ); ?></span>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<?php if ( ! empty( $settings['footer_text'] ) ) : ?>
					<p class="plx-08__footer"><?php echo esc_html( $settings['footer_text'] ); ?></p>
				<?php endif; ?>
			</div>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-css-parallax-card-hover">
			<div class="plx-08">
				<header class="plx-08__header">
					<# if ( settings.top_label ) { #>
						<p class="plx-08__label">{{{ settings.top_label }}}</p>
					<# } #>
					<h2>
						{{{ settings.main_heading }}}<br>
						<span>{{{ settings.sub_heading }}}</span>
					</h2>
				</header>

				<div class="plx-08__grid">
					<# _.each( settings.cards_list, function( item ) {
						var bg_style = item.bg_gradient ? 'background: ' + item.bg_gradient + ';' : '';
					#>
						<div class="plx-08__card">
							<div class="plx-08__card-bg" style="{{{ bg_style }}}"></div>
							<div class="plx-08__card-light"></div>
							<div class="plx-08__card-noise"></div>
							<div class="plx-08__card-geo">
								<svg viewBox="0 0 300 440" xmlns="http://www.w3.org/2000/svg">
									<circle cx="250" cy="80" r="120" stroke="white" stroke-width="1" fill="none"/>
									<circle cx="250" cy="80" r="70" stroke="white" stroke-width="0.5" fill="none"/>
									<line x1="0" y1="440" x2="300" y2="0" stroke="white" stroke-width="0.4"/>
								</svg>
							</div>
							<div class="plx-08__card-content">
								<div class="plx-08__card-icon">{{{ item.icon }}}</div>
								<p class="plx-08__card-tag">{{{ item.tag }}}</p>
								<h3 class="plx-08__card-title">{{{ item.title }}}</h3>
								<p class="plx-08__card-body">{{{ item.body }}}</p>
								<span class="plx-08__card-cta">{{{ item.cta }}}</span>
							</div>
						</div>
					<# }); #>
				</div>

				<# if ( settings.footer_text ) { #>
					<p class="plx-08__footer">{{{ settings.footer_text }}}</p>
				<# } #>
			</div>
		</div>
		<?php
	}
}
