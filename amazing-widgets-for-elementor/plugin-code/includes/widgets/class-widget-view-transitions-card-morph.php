<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_View_Transitions_Card_Morph extends Widget_Base {

	public function get_name() {
		return 'amazing-view-transitions-card-morph';
	}

	public function get_title() {
		return __( 'View Transitions Card Morph', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-frame-expand';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-view-transitions-card-morph' ];
	}

	public function get_script_depends() {
		return [ 'amazing-widget-view-transitions-card-morph' ];
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
				'default' => 'Shared element morph',
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => __( 'Título Principal', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Tap a card — it becomes the page',
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_cards',
			[
				'label' => __( 'Cards / Produtos', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'name',
			[
				'label'   => __( 'Nome do Item', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Studio Over-Ear',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'price',
			[
				'label'   => __( 'Preço', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '$249',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'tag',
			[
				'label'   => __( 'Categoria / Tag', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Acoustics',
			]
		);

		$repeater->add_control(
			'description',
			[
				'label'   => __( 'Descrição Detalhada', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Forty-hour battery, adaptive ANC tuned in a real room rather than an anechoic chamber.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'image',
			[
				'label'   => __( 'Imagem', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=700&auto=format&fit=crop',
				],
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
						'name'        => 'Studio Over-Ear',
						'price'       => '$249',
						'tag'         => 'Acoustics',
						'description' => 'Forty-hour battery, adaptive ANC tuned in a real room.',
						'image'       => [ 'url' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?q=80&w=700&auto=format&fit=crop' ],
					],
					[
						'name'        => 'Field Watch 38',
						'price'       => '$390',
						'tag'         => 'Horology',
						'description' => 'A 38 mm case that disappears under a cuff, sapphire crystal.',
						'image'       => [ 'url' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?q=80&w=700&auto=format&fit=crop' ],
					],
					[
						'name'        => 'Rangefinder M',
						'price'       => '$1,180',
						'tag'         => 'Optics',
						'description' => 'Full-frame sensor in a body the size of a paperback.',
						'image'       => [ 'url' => 'https://images.unsplash.com/photo-1526170375885-4d8ecf77b99f?q=80&w=700&auto=format&fit=crop' ],
					],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->add_control(
			'chip_text',
			[
				'label'   => __( 'Texto Rodapé Informativo', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'document.startViewTransition() · view-transition-name pairs', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="amazing-widget-view-transitions-card-morph">
			<section class="ac-04">
				<div class="ac-04__stage">
					<header class="ac-04__head">
						<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
							<p class="ac-04__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $settings['title'] ) ) : ?>
							<h2 class="ac-04__title"><?php echo esc_html( $settings['title'] ); ?></h2>
						<?php endif; ?>
					</header>

					<ul class="ac-04__grid" role="list" data-grid>
						<?php foreach ( $settings['cards_list'] as $i => $card ) :
							$img_url = ! empty( $card['image']['url'] ) ? $card['image']['url'] : '';
							?>
							<li class="ac-04__card" data-name="<?php echo esc_attr( $card['name'] ); ?>" data-price="<?php echo esc_attr( $card['price'] ); ?>" data-tag="<?php echo esc_attr( $card['tag'] ); ?>" data-copy="<?php echo esc_attr( $card['description'] ); ?>">
								<?php if ( $img_url ) : ?>
									<img class="ac-04__thumb" src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $card['name'] ); ?>" loading="lazy">
								<?php endif; ?>
								<div class="ac-04__meta">
									<h3 class="ac-04__name"><?php echo esc_html( $card['name'] ); ?></h3>
									<p class="ac-04__price"><?php echo esc_html( $card['price'] ); ?></p>
								</div>
								<button class="ac-04__open" type="button" data-open="<?php echo esc_attr( $i ); ?>" aria-haspopup="dialog">
									Open<span class="ac-04__sr"> <?php echo esc_html( $card['name'] ); ?> details</span>
								</button>
							</li>
						<?php endforeach; ?>
					</ul>

					<div class="ac-04__detail" data-detail hidden role="dialog" aria-modal="true">
						<button class="ac-04__back" type="button" data-close>
							<svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
							Back to grid
						</button>
						<img class="ac-04__hero" data-hero alt="">
						<div class="ac-04__pane">
							<p class="ac-04__tag" data-tag></p>
							<h3 class="ac-04__dtitle" data-dtitle></h3>
							<p class="ac-04__copy" data-copy></p>
							<p class="ac-04__dprice" data-dprice></p>
						</div>
					</div>

					<?php if ( ! empty( $settings['chip_text'] ) ) : ?>
						<p class="ac-04__chip"><?php echo esc_html( $settings['chip_text'] ); ?></p>
					<?php endif; ?>
				</div>
			</section>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-view-transitions-card-morph">
			<section class="ac-04">
				<div class="ac-04__stage">
					<header class="ac-04__head">
						<# if ( settings.eyebrow ) { #>
							<p class="ac-04__eyebrow">{{{ settings.eyebrow }}}</p>
						<# } #>

						<# if ( settings.title ) { #>
							<h2 class="ac-04__title">{{{ settings.title }}}</h2>
						<# } #>
					</header>

					<ul class="ac-04__grid" role="list" data-grid>
						<# _.each( settings.cards_list, function( card, i ) { #>
							<li class="ac-04__card" data-name="{{{ card.name }}}" data-price="{{{ card.price }}}" data-tag="{{{ card.tag }}}" data-copy="{{{ card.description }}}">
								<# if ( card.image.url ) { #>
									<img class="ac-04__thumb" src="{{{ card.image.url }}}" alt="{{{ card.name }}}">
								<# } #>
								<div class="ac-04__meta">
									<h3 class="ac-04__name">{{{ card.name }}}</h3>
									<p class="ac-04__price">{{{ card.price }}}</p>
								</div>
								<button class="ac-04__open" type="button" data-open="{{{ i }}}" aria-haspopup="dialog">
									Open<span class="ac-04__sr"> {{{ card.name }}} details</span>
								</button>
							</li>
						<# }); #>
					</ul>

					<div class="ac-04__detail" data-detail hidden role="dialog" aria-modal="true">
						<button class="ac-04__back" type="button" data-close>
							<svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M15 18l-6-6 6-6"/></svg>
							Back to grid
						</button>
						<img class="ac-04__hero" data-hero alt="">
						<div class="ac-04__pane">
							<p class="ac-04__tag" data-tag></p>
							<h3 class="ac-04__dtitle" data-dtitle></h3>
							<p class="ac-04__copy" data-copy></p>
							<p class="ac-04__dprice" data-dprice></p>
						</div>
					</div>

					<# if ( settings.chip_text ) { #>
						<p class="ac-04__chip">{{{ settings.chip_text }}}</p>
					<# } #>
				</div>
			</section>
		</div>
		<?php
	}
}
