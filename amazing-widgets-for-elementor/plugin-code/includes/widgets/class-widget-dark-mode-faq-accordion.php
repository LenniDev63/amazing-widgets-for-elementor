<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_Dark_Mode_FAQ_Accordion extends Widget_Base {

	public function get_name() {
		return 'amazing-dark-mode-faq-accordion';
	}

	public function get_title() {
		return __( 'Dark Mode FAQ Accordion', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-accordion';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-dark-mode-faq-accordion' ];
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
			'brand_name',
			[
				'label'   => __( 'Nome da Marca / Topo', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Nightshift Docs',
			]
		);

		$this->add_control(
			'main_title',
			[
				'label'   => __( 'Título Principal', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Frequently asked questions',
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => __( 'Descrição', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Every color below is driven by light-dark() tokens with full dark mode toggle support.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_faq',
			[
				'label' => __( 'Perguntas Frequentes (FAQ)', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'question',
			[
				'label'   => __( 'Pergunta', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Does dark mode save battery?',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'answer',
			[
				'label'   => __( 'Resposta', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'On OLED screens, meaningfully — black pixels are unlit.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'is_open',
			[
				'label'        => __( 'Aberto por Padrão?', 'amazing-widgets-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Sim', 'amazing-widgets-for-elementor' ),
				'label_off'    => __( 'Não', 'amazing-widgets-for-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$this->add_control(
			'faq_list',
			[
				'label'       => __( 'Lista de Itens', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'question' => 'Does dark mode save battery?',
						'answer'   => 'On OLED screens, meaningfully — black pixels are unlit. On LCD panels the backlight runs regardless.',
						'is_open'  => 'yes',
					],
					[
						'question' => 'Why not just add a .dark class?',
						'answer'   => 'Class-swapping duplicates every color rule and misses native UI scrollbars and inputs.',
						'is_open'  => 'no',
					],
					[
						'question' => 'Should dark mode be pure black?',
						'answer'   => 'Usually no — near-black surfaces reduce smearing on OLED and let shadows still read.',
						'is_open'  => 'no',
					],
				],
				'title_field' => '{{{ question }}}',
			]
		);

		$this->add_control(
			'footer_text',
			[
				'label'   => __( 'Texto de Rodapé', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Unchecked = follow OS theme. Checked = forced dark mode.', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$widget_id = $this->get_id();
		$cb_id     = 'cfa06-mode-' . $widget_id;
		?>
		<div class="amazing-widget-dark-mode-faq-accordion">
			<section class="cfa-06">
				<div class="cfa-06__wrap">
					<div class="cfa-06__bar">
						<?php if ( ! empty( $settings['brand_name'] ) ) : ?>
							<span class="cfa-06__brand"><?php echo esc_html( $settings['brand_name'] ); ?></span>
						<?php endif; ?>
						<input type="checkbox" id="<?php echo esc_attr( $cb_id ); ?>" class="cfa-06__modecb">
						<label class="cfa-06__toggle" for="<?php echo esc_attr( $cb_id ); ?>" title="Toggle dark mode">
							<span class="cfa-06__sun" aria-hidden="true"><svg viewBox="0 0 24 24" width="13" height="13"><circle cx="12" cy="12" r="4.4" fill="currentColor"/><g stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M12 2.5v3M12 18.5v3M2.5 12h3M18.5 12h3M5 5l2.1 2.1M16.9 16.9L19 19M19 5l-2.1 2.1M7.1 16.9L5 19"/></g></svg></span>
							<span class="cfa-06__knob" aria-hidden="true"></span>
							<span class="cfa-06__moon" aria-hidden="true"><svg viewBox="0 0 24 24" width="13" height="13"><path d="M20 14.5A8.5 8.5 0 019.5 4a8.5 8.5 0 1010.5 10.5z" fill="currentColor"/></svg></span>
							<span class="cfa-06__sr">Toggle dark theme</span>
						</label>
					</div>

					<header class="cfa-06__head">
						<?php if ( ! empty( $settings['main_title'] ) ) : ?>
							<h2><?php echo esc_html( $settings['main_title'] ); ?></h2>
						<?php endif; ?>
						<?php if ( ! empty( $settings['description'] ) ) : ?>
							<p><?php echo esc_html( $settings['description'] ); ?></p>
						<?php endif; ?>
					</header>

					<div class="cfa-06__list">
						<?php foreach ( $settings['faq_list'] as $item ) :
							$open = 'yes' === $item['is_open'] ? ' open' : '';
							?>
							<details class="cfa-06__item"<?php echo esc_attr( $open ); ?>>
								<summary class="cfa-06__q"><?php echo esc_html( $item['question'] ); ?><i aria-hidden="true"></i></summary>
								<div class="cfa-06__a"><p><?php echo esc_html( $item['answer'] ); ?></p></div>
							</details>
						<?php endforeach; ?>
					</div>

					<?php if ( ! empty( $settings['footer_text'] ) ) : ?>
						<p class="cfa-06__foot"><?php echo esc_html( $settings['footer_text'] ); ?></p>
					<?php endif; ?>
				</div>
			</section>
		</div>
		<style>
		{{WRAPPER}} .cfa-06:has(#<?php echo esc_attr( $cb_id ); ?>:checked) {
			color-scheme: dark;
		}
		</style>
		<?php
	}

	protected function content_template() {
		?>
		<# var cb_id = 'cfa06-mode-' + view.getID(); #>
		<div class="amazing-widget-dark-mode-faq-accordion">
			<section class="cfa-06">
				<div class="cfa-06__wrap">
					<div class="cfa-06__bar">
						<# if ( settings.brand_name ) { #>
							<span class="cfa-06__brand">{{{ settings.brand_name }}}</span>
						<# } #>
						<input type="checkbox" id="{{{ cb_id }}}" class="cfa-06__modecb">
						<label class="cfa-06__toggle" for="{{{ cb_id }}}" title="Toggle dark mode">
							<span class="cfa-06__sun" aria-hidden="true"><svg viewBox="0 0 24 24" width="13" height="13"><circle cx="12" cy="12" r="4.4" fill="currentColor"/><g stroke="currentColor" stroke-width="1.8" stroke-linecap="round"><path d="M12 2.5v3M12 18.5v3M2.5 12h3M18.5 12h3M5 5l2.1 2.1M16.9 16.9L19 19M19 5l-2.1 2.1M7.1 16.9L5 19"/></g></svg></span>
							<span class="cfa-06__knob" aria-hidden="true"></span>
							<span class="cfa-06__moon" aria-hidden="true"><svg viewBox="0 0 24 24" width="13" height="13"><path d="M20 14.5A8.5 8.5 0 019.5 4a8.5 8.5 0 1010.5 10.5z" fill="currentColor"/></svg></span>
							<span class="cfa-06__sr">Toggle dark theme</span>
						</label>
					</div>

					<header class="cfa-06__head">
						<# if ( settings.main_title ) { #>
							<h2>{{{ settings.main_title }}}</h2>
						<# } #>
						<# if ( settings.description ) { #>
							<p>{{{ settings.description }}}</p>
						<# } #>
					</header>

					<div class="cfa-06__list">
						<# _.each( settings.faq_list, function( item ) {
							var open = 'yes' === item.is_open ? ' open' : '';
						#>
							<details class="cfa-06__item"{{{ open }}}>
								<summary class="cfa-06__q">{{{ item.question }}}<i aria-hidden="true"></i></summary>
								<div class="cfa-06__a"><p>{{{ item.answer }}}</p></div>
							</details>
						<# }); #>
					</div>

					<# if ( settings.footer_text ) { #>
						<p class="cfa-06__foot">{{{ settings.footer_text }}}</p>
					<# } #>
				</div>
			</section>
		</div>
		<?php
	}
}
