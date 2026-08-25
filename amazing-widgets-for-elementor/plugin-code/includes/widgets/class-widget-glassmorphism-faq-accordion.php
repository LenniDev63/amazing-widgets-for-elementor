<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_Glassmorphism_FAQ_Accordion extends Widget_Base {

	public function get_name() {
		return 'amazing-glassmorphism-faq-accordion';
	}

	public function get_title() {
		return __( 'Glassmorphism FAQ Accordion', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-search-bold';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-glassmorphism-faq-accordion' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_header',
			[
				'label' => __( 'Cabeçalho e Fundo', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'bg_image',
			[
				'label'   => __( 'Imagem de Fundo Glass', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => 'https://images.unsplash.com/photo-1518098268026-4e89f1a2cd8e?q=80&w=1800&auto=format&fit=crop',
				],
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => __( 'Título', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Membership FAQ',
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => __( 'Descrição', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Four layers make the glass: tint, frost, edge, highlight. The open panel frosts deeper.',
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
				'default' => 'What does membership include?',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'answer',
			[
				'label'   => __( 'Resposta', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Unlimited access to every studio location, all live classes, and the on-demand library.',
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
						'question' => 'What does membership include?',
						'answer'   => 'Unlimited access to every studio location, all live classes, and the on-demand library.',
						'is_open'  => 'yes',
					],
					[
						'question' => 'Can I freeze my membership?',
						'answer'   => 'Yes — up to 3 months per year, in one-month blocks, straight from the app.',
						'is_open'  => 'no',
					],
					[
						'question' => 'Do you offer day passes for guests?',
						'answer'   => 'Every member gets 2 free guest passes a month. Additional passes are $15.',
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
				'default' => __( 'backdrop-filter: blur(18px) saturate(1.6) — pure glass look.', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$bg_url   = ! empty( $settings['bg_image']['url'] ) ? $settings['bg_image']['url'] : '';
		$bg_style = $bg_url ? "background-image: linear-gradient(160deg,oklch(0.45 0.2 290/.55),oklch(0.5 0.22 340/.35) 55%,oklch(0.55 0.18 240/.5)),url('" . esc_url( $bg_url ) . "');" : '';
		?>
		<div class="amazing-widget-glassmorphism-faq-accordion">
			<section class="cfa-07">
				<div class="cfa-07__scene" style="<?php echo esc_attr( $bg_style ); ?>">
					<div class="cfa-07__wrap">
						<header class="cfa-07__head">
							<?php if ( ! empty( $settings['title'] ) ) : ?>
								<h2><?php echo esc_html( $settings['title'] ); ?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $settings['description'] ) ) : ?>
								<p><?php echo esc_html( $settings['description'] ); ?></p>
							<?php endif; ?>
						</header>

						<div class="cfa-07__list">
							<?php foreach ( $settings['faq_list'] as $item ) :
								$open = 'yes' === $item['is_open'] ? ' open' : '';
								?>
								<details class="cfa-07__item"<?php echo esc_attr( $open ); ?>>
									<summary class="cfa-07__q"><?php echo esc_html( $item['question'] ); ?><i aria-hidden="true"></i></summary>
									<div class="cfa-07__a"><p><?php echo esc_html( $item['answer'] ); ?></p></div>
								</details>
							<?php endforeach; ?>
						</div>

						<?php if ( ! empty( $settings['footer_text'] ) ) : ?>
							<p class="cfa-07__foot"><?php echo esc_html( $settings['footer_text'] ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</section>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-glassmorphism-faq-accordion">
			<section class="cfa-07">
				<#
				var bg_style = settings.bg_image.url ? "background-image: linear-gradient(160deg,oklch(0.45 0.2 290/.55),oklch(0.5 0.22 340/.35) 55%,oklch(0.55 0.18 240/.5)),url('" + settings.bg_image.url + "');" : '';
				#>
				<div class="cfa-07__scene" style="{{{ bg_style }}}">
					<div class="cfa-07__wrap">
						<header class="cfa-07__head">
							<# if ( settings.title ) { #>
								<h2>{{{ settings.title }}}</h2>
							<# } #>
							<# if ( settings.description ) { #>
								<p>{{{ settings.description }}}</p>
							<# } #>
						</header>

						<div class="cfa-07__list">
							<# _.each( settings.faq_list, function( item ) {
								var open = 'yes' === item.is_open ? ' open' : '';
							#>
								<details class="cfa-07__item"{{{ open }}}>
									<summary class="cfa-07__q">{{{ item.question }}}<i aria-hidden="true"></i></summary>
									<div class="cfa-07__a"><p>{{{ item.answer }}}</p></div>
								</details>
							<# }); #>
						</div>

						<# if ( settings.footer_text ) { #>
							<p class="cfa-07__foot">{{{ settings.footer_text }}}</p>
						<# } #>
					</div>
				</div>
			</section>
		</div>
		<?php
	}
}
