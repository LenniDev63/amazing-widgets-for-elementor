<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;

class Amazing_Widget_Ambient_Breathing_Glow extends Widget_Base {

	public function get_name() {
		return 'amazing-ambient-breathing-glow';
	}

	public function get_title() {
		return __( 'Ambient Breathing Glow', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-lightbulb';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-ambient-breathing-glow' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_cards',
			[
				'label' => __( 'Cards / Planos', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'is_hero',
			[
				'label'        => __( 'Destaque (Glow Hero)?', 'amazing-widgets-for-elementor' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Sim', 'amazing-widgets-for-elementor' ),
				'label_off'    => __( 'Não', 'amazing-widgets-for-elementor' ),
				'return_value' => 'yes',
				'default'      => 'no',
			]
		);

		$repeater->add_control(
			'badge_text',
			[
				'label'       => __( 'Badge / Flag (Card Destaque)', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Most popular', 'amazing-widgets-for-elementor' ),
				'condition'   => [ 'is_hero' => 'yes' ],
			]
		);

		$repeater->add_control(
			'plan_name',
			[
				'label'       => __( 'Nome do Plano', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Studio', 'amazing-widgets-for-elementor' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'price',
			[
				'label'       => __( 'Preço', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '$24', 'amazing-widgets-for-elementor' ),
				'dynamic'     => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'period',
			[
				'label'       => __( 'Período', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( '/mo', 'amazing-widgets-for-elementor' ),
			]
		);

		$repeater->add_control(
			'features',
			[
				'label'       => __( 'Recursos (Um por linha)', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXTAREA,
				'default'     => "Unlimited projects\nPriority support · 4 hr SLA\n250 GB storage\nCustom domains",
			]
		);

		$repeater->add_control(
			'button_text',
			[
				'label'       => __( 'Texto do Botão', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Choose Studio', 'amazing-widgets-for-elementor' ),
			]
		);

		$repeater->add_control(
			'button_link',
			[
				'label'       => __( 'Link do Botão', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::URL,
				'default'     => [ 'url' => '#' ],
			]
		);

		$this->add_control(
			'cards_list',
			[
				'label'       => __( 'Lista de Planos', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'is_hero'     => 'no',
						'plan_name'   => 'Starter',
						'price'       => '$0',
						'period'      => '/mo',
						'features'    => "3 projects\nCommunity support\n1 GB storage",
						'button_text' => 'Choose Starter',
					],
					[
						'is_hero'     => 'yes',
						'badge_text'  => 'Most popular',
						'plan_name'   => 'Studio',
						'price'       => '$24',
						'period'      => '/mo',
						'features'    => "Unlimited projects\nPriority support · 4 hr SLA\n250 GB storage\nCustom domains",
						'button_text' => 'Choose Studio',
					],
					[
						'is_hero'     => 'no',
						'plan_name'   => 'Scale',
						'price'       => '$96',
						'period'      => '/mo',
						'features'    => "Everything in Studio\nSSO & audit log\n2 TB storage",
						'button_text' => 'Choose Scale',
					],
				],
				'title_field' => '{{{ plan_name }}}',
			]
		);

		$this->add_control(
			'chip_text',
			[
				'label'       => __( 'Rodapé Informativo / Chip', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'counter-phase auras · @property hue drift · rotating conic halo · 6s resting breath', 'amazing-widgets-for-elementor' ),
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
				'label'     => __( 'Cor de Fundo da Seção', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ac-15' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="amazing-widget-ambient-breathing-glow">
			<section class="ac-15">
				<div class="ac-15__stage">
					<div class="ac-15__row">
						<?php
						foreach ( $settings['cards_list'] as $index => $item ) :
							$is_hero = 'yes' === $item['is_hero'];
							$card_classes = 'ac-15__card' . ( $is_hero ? ' ac-15__card--hero' : '' );
							$list_classes = 'ac-15__list' . ( $is_hero ? ' ac-15__list--lit' : '' );
							$btn_classes  = 'ac-15__cta' . ( $is_hero ? ' ac-15__cta--go' : '' );
							$features     = explode( "\n", str_replace( "\r", '', $item['features'] ) );
							?>
							<article class="<?php echo esc_attr( $card_classes ); ?>">
								<?php if ( $is_hero ) : ?>
									<span class="ac-15__halo" aria-hidden="true"></span>
									<span class="ac-15__aura ac-15__aura--a" aria-hidden="true"></span>
									<span class="ac-15__aura ac-15__aura--b" aria-hidden="true"></span>
									<span class="ac-15__crown" aria-hidden="true"></span>
									<span class="ac-15__veil" aria-hidden="true"></span>
									<span class="ac-15__sheen" aria-hidden="true"></span>
									<?php if ( ! empty( $item['badge_text'] ) ) : ?>
										<span class="ac-15__flag"><?php echo esc_html( $item['badge_text'] ); ?></span>
									<?php endif; ?>
								<?php endif; ?>

								<div class="<?php echo $is_hero ? 'ac-15__inner' : ''; ?>">
									<p class="ac-15__plan"><?php echo esc_html( $item['plan_name'] ); ?></p>
									<p class="ac-15__price">
										<?php echo esc_html( $item['price'] ); ?>
										<span><?php echo esc_html( $item['period'] ); ?></span>
									</p>
									<ul class="<?php echo esc_attr( $list_classes ); ?>" role="list">
										<?php foreach ( $features as $feat ) : if ( trim( $feat ) !== '' ) : ?>
											<li><?php echo esc_html( $feat ); ?></li>
										<?php endif; endforeach; ?>
									</ul>
									<a href="<?php echo esc_url( $item['button_link']['url'] ); ?>" class="<?php echo esc_attr( $btn_classes ); ?>">
										<?php echo esc_html( $item['button_text'] ); ?>
										<?php if ( $is_hero ) : ?>
											<span class="ac-15__ctaglow" aria-hidden="true"></span>
										<?php endif; ?>
									</a>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
					<?php if ( ! empty( $settings['chip_text'] ) ) : ?>
						<p class="ac-15__chip"><?php echo esc_html( $settings['chip_text'] ); ?></p>
					<?php endif; ?>
				</div>
			</section>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-ambient-breathing-glow">
			<section class="ac-15">
				<div class="ac-15__stage">
					<div class="ac-15__row">
						<# _.each( settings.cards_list, function( item ) {
							var is_hero = 'yes' === item.is_hero;
							var card_classes = 'ac-15__card' + ( is_hero ? ' ac-15__card--hero' : '' );
							var list_classes = 'ac-15__list' + ( is_hero ? ' ac-15__list--lit' : '' );
							var btn_classes  = 'ac-15__cta' + ( is_hero ? ' ac-15__cta--go' : '' );
							var features = item.features ? item.features.split('\n') : [];
						#>
							<article class="{{{ card_classes }}}">
								<# if ( is_hero ) { #>
									<span class="ac-15__halo" aria-hidden="true"></span>
									<span class="ac-15__aura ac-15__aura--a" aria-hidden="true"></span>
									<span class="ac-15__aura ac-15__aura--b" aria-hidden="true"></span>
									<span class="ac-15__crown" aria-hidden="true"></span>
									<span class="ac-15__veil" aria-hidden="true"></span>
									<span class="ac-15__sheen" aria-hidden="true"></span>
									<# if ( item.badge_text ) { #>
										<span class="ac-15__flag">{{{ item.badge_text }}}</span>
									<# } #>
								<# } #>

								<div class="{{{ is_hero ? 'ac-15__inner' : '' }}}">
									<p class="ac-15__plan">{{{ item.plan_name }}}</p>
									<p class="ac-15__price">
										{{{ item.price }}}
										<span>{{{ item.period }}}</span>
									</p>
									<ul class="{{{ list_classes }}}" role="list">
										<# _.each( features, function( feat ) { if ( feat.trim() ) { #>
											<li>{{{ feat }}}</li>
										<# } }); #>
									</ul>
									<a href="{{{ item.button_link.url }}}" class="{{{ btn_classes }}}">
										{{{ item.button_text }}}
										<# if ( is_hero ) { #>
											<span class="ac-15__ctaglow" aria-hidden="true"></span>
										<# } #>
									</a>
								</div>
							</article>
						<# }); #>
					</div>
					<# if ( settings.chip_text ) { #>
						<p class="ac-15__chip">{{{ settings.chip_text }}}</p>
					<# } #>
				</div>
			</section>
		</div>
		<?php
	}
}
