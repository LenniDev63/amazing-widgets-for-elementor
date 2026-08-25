<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_Horizontal_FAQ_Accordion extends Widget_Base {

	public function get_name() {
		return 'amazing-horizontal-faq-accordion';
	}

	public function get_title() {
		return __( 'Horizontal FAQ Accordion', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-accordion';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-horizontal-faq-accordion' ];
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
			'main_title',
			[
				'label'   => __( 'Título Principal', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Plan your expedition',
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'description',
			[
				'label'   => __( 'Descrição', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Five questions standing sideways — the open one unfolds smoothly.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_panels',
			[
				'label' => __( 'Painéis FAQ', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'spine_title',
			[
				'label'   => __( 'Título da Espinha (Spine)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'When to go?',
			]
		);

		$repeater->add_control(
			'question',
			[
				'label'   => __( 'Pergunta Completa (Expandido)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'When is the best season?',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'answer',
			[
				'label'   => __( 'Resposta Completa', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'June through September for the high passes — long days, stable weather, open refuges.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'bg_image',
			[
				'label'   => __( 'Imagem de Fundo do Painel', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=1200&auto=format&fit=crop',
				],
			]
		);

		$repeater->add_control(
			'is_active',
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
			'panels_list',
			[
				'label'       => __( 'Lista de Painéis', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'spine_title' => 'When to go?',
						'question'    => 'When is the best season?',
						'answer'      => 'June through September for the high passes — long days, stable weather.',
						'is_active'   => 'yes',
						'bg_image'    => [ 'url' => 'https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?q=80&w=1200&auto=format&fit=crop' ],
					],
					[
						'spine_title' => 'Fitness level',
						'question'    => 'How fit do I need to be?',
						'answer'      => 'Comfortable hiking 6–7 hours with a daypack, two days in a row.',
						'is_active'   => 'no',
						'bg_image'    => [ 'url' => 'https://images.unsplash.com/photo-1551632811-561732d1e306?q=80&w=1200&auto=format&fit=crop' ],
					],
					[
						'spine_title' => "What's included",
						'question'    => 'What does the price include?',
						'answer'      => 'Guides, refuge nights, breakfasts and dinners, luggage transfer.',
						'is_active'   => 'no',
						'bg_image'    => [ 'url' => 'https://images.unsplash.com/photo-1501554728187-ce583db33af7?q=80&w=1200&auto=format&fit=crop' ],
					],
				],
				'title_field' => '{{{ spine_title }}}',
			]
		);

		$this->add_control(
			'footer_text',
			[
				'label'   => __( 'Texto de Rodapé', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'grid-template-columns 0fr->1fr + flex-grow transition.', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings  = $this->get_settings_for_display();
		$widget_id = $this->get_id();
		$group_name = 'cfa15-' . $widget_id;
		?>
		<div class="amazing-widget-horizontal-faq-accordion">
			<section class="cfa-15">
				<div class="cfa-15__stage">
					<div class="cfa-15__wrap">
						<header class="cfa-15__head">
							<?php if ( ! empty( $settings['main_title'] ) ) : ?>
								<h2><?php echo esc_html( $settings['main_title'] ); ?></h2>
							<?php endif; ?>
							<?php if ( ! empty( $settings['description'] ) ) : ?>
								<p><?php echo esc_html( $settings['description'] ); ?></p>
							<?php endif; ?>
						</header>

						<div class="cfa-15__strip">
							<?php foreach ( $settings['panels_list'] as $i => $panel ) :
								$rb_id = "cfa15-{$widget_id}-p{$i}";
								$checked = 'yes' === $panel['is_active'] ? ' checked' : '';
								$img_url = ! empty( $panel['bg_image']['url'] ) ? $panel['bg_image']['url'] : '';
								$img_style = $img_url ? "--img:url('" . esc_url( $img_url ) . "');" : '';
								?>
								<div class="cfa-15__panel" style="<?php echo esc_attr( $img_style ); ?>">
									<input type="radio" name="<?php echo esc_attr( $group_name ); ?>" id="<?php echo esc_attr( $rb_id ); ?>" class="cfa-15__rb"<?php echo esc_attr( $checked ); ?>>
									<label class="cfa-15__spine" for="<?php echo esc_attr( $rb_id ); ?>">
										<h3><?php echo esc_html( $panel['spine_title'] ); ?></h3>
									</label>
									<div class="cfa-15__body">
										<div>
											<h4><?php echo esc_html( $panel['question'] ); ?></h4>
											<p><?php echo esc_html( $panel['answer'] ); ?></p>
										</div>
									</div>
								</div>
							<?php endforeach; ?>
						</div>

						<?php if ( ! empty( $settings['footer_text'] ) ) : ?>
							<p class="cfa-15__foot"><?php echo esc_html( $settings['footer_text'] ); ?></p>
						<?php endif; ?>
					</div>
				</div>
			</section>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<# var group_name = 'cfa15-' + view.getID(); #>
		<div class="amazing-widget-horizontal-faq-accordion">
			<section class="cfa-15">
				<div class="cfa-15__stage">
					<div class="cfa-15__wrap">
						<header class="cfa-15__head">
							<# if ( settings.main_title ) { #>
								<h2>{{{ settings.main_title }}}</h2>
							<# } #>
							<# if ( settings.description ) { #>
								<p>{{{ settings.description }}}</p>
							<# } #>
						</header>

						<div class="cfa-15__strip">
							<# _.each( settings.panels_list, function( panel, i ) {
								var rb_id = 'cfa15-' + view.getID() + '-p' + i;
								var checked = 'yes' === panel.is_active ? ' checked' : '';
								var img_style = panel.bg_image.url ? "--img:url('" + panel.bg_image.url + "');" : '';
							#>
								<div class="cfa-15__panel" style="{{{ img_style }}}">
									<input type="radio" name="{{{ group_name }}}" id="{{{ rb_id }}}" class="cfa-15__rb"{{{ checked }}}>
									<label class="cfa-15__spine" for="{{{ rb_id }}}">
										<h3>{{{ panel.spine_title }}}</h3>
									</label>
									<div class="cfa-15__body">
										<div>
											<h4>{{{ panel.question }}}</h4>
											<p>{{{ panel.answer }}}</p>
										</div>
									</div>
								</div>
							<# }); #>
						</div>

						<# if ( settings.footer_text ) { #>
							<p class="cfa-15__foot">{{{ settings.footer_text }}}</p>
						<# } #>
					</div>
				</div>
			</section>
		</div>
		<?php
	}
}
