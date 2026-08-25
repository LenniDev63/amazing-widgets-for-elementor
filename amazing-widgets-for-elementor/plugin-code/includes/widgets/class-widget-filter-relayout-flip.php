<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_Filter_Relayout_FLIP extends Widget_Base {

	public function get_name() {
		return 'amazing-filter-relayout-flip';
	}

	public function get_title() {
		return __( 'Filter Re-Layout FLIP', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-filter';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-filter-relayout-flip' ];
	}

	public function get_script_depends() {
		return [ 'amazing-widget-filter-relayout-flip' ];
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
				'default' => 'Layout animation',
			]
		);

		$this->add_control(
			'title',
			[
				'label'   => __( 'Título Principal', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Cards that travel to their new position',
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_filters',
			[
				'label' => __( 'Filtros & Categorias', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater_filters = new Repeater();

		$repeater_filters->add_control(
			'slug',
			[
				'label'   => __( 'Slug da Categoria', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'ui',
			]
		);

		$repeater_filters->add_control(
			'label',
			[
				'label'   => __( 'Nome do Filtro', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Interface',
			]
		);

		$this->add_control(
			'filters_list',
			[
				'label'       => __( 'Abas de Filtro', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_filters->get_controls(),
				'default'     => [
					[ 'slug' => 'all', 'label' => 'All' ],
					[ 'slug' => 'ui', 'label' => 'Interface' ],
					[ 'slug' => 'type', 'label' => 'Typography' ],
					[ 'slug' => 'motion', 'label' => 'Motion' ],
				],
				'title_field' => '{{{ label }}} ({{{ slug }}})',
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

		$repeater_cards = new Repeater();

		$repeater_cards->add_control(
			'cat_slug',
			[
				'label'   => __( 'Slug da Categoria correspondente', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'ui',
			]
		);

		$repeater_cards->add_control(
			'name',
			[
				'label'   => __( 'Nome do Item', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Command palette',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater_cards->add_control(
			'tag_label',
			[
				'label'   => __( 'Rótulo da Categoria', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Interface',
			]
		);

		$repeater_cards->add_control(
			'swatch_color',
			[
				'label'   => __( 'Cor da Amostra (Swatch)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'oklch(0.72 0.17 42)',
			]
		);

		$this->add_control(
			'cards_list',
			[
				'label'       => __( 'Lista de Cards', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater_cards->get_controls(),
				'default'     => [
					[ 'cat_slug' => 'ui', 'name' => 'Command palette', 'tag_label' => 'Interface', 'swatch_color' => 'oklch(0.72 0.17 42)' ],
					[ 'cat_slug' => 'type', 'name' => 'Fluid type scale', 'tag_label' => 'Typography', 'swatch_color' => 'oklch(0.75 0.15 92)' ],
					[ 'cat_slug' => 'motion', 'name' => 'Spring easing set', 'tag_label' => 'Motion', 'swatch_color' => 'oklch(0.74 0.16 155)' ],
					[ 'cat_slug' => 'ui', 'name' => 'Sheet & drawer', 'tag_label' => 'Interface', 'swatch_color' => 'oklch(0.70 0.16 262)' ],
					[ 'cat_slug' => 'motion', 'name' => 'Page transitions', 'tag_label' => 'Motion', 'swatch_color' => 'oklch(0.72 0.18 330)' ],
					[ 'cat_slug' => 'type', 'name' => 'Optical sizing', 'tag_label' => 'Typography', 'swatch_color' => 'oklch(0.78 0.14 200)' ],
				],
				'title_field' => '{{{ name }}}',
			]
		);

		$this->add_control(
			'chip_text',
			[
				'label'   => __( 'Texto Rodapé Informativo', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'First · Last · Invert · Play · transform-only, 60 fps', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="amazing-widget-filter-relayout-flip">
			<section class="ac-06">
				<div class="ac-06__stage">
					<header class="ac-06__head">
						<?php if ( ! empty( $settings['eyebrow'] ) ) : ?>
							<p class="ac-06__eyebrow"><?php echo esc_html( $settings['eyebrow'] ); ?></p>
						<?php endif; ?>

						<?php if ( ! empty( $settings['title'] ) ) : ?>
							<h2 class="ac-06__title"><?php echo esc_html( $settings['title'] ); ?></h2>
						<?php endif; ?>

						<?php if ( ! empty( $settings['filters_list'] ) ) : ?>
							<div class="ac-06__tabs" role="group" aria-label="Filter cards by category">
								<?php foreach ( $settings['filters_list'] as $i => $filter ) :
									$is_all = $i === 0 || 'all' === $filter['slug'];
									?>
									<button class="ac-06__tab" type="button" data-filter="<?php echo esc_attr( $filter['slug'] ); ?>" aria-pressed="<?php echo $is_all ? 'true' : 'false'; ?>">
										<?php echo esc_html( $filter['label'] ); ?>
									</button>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</header>

					<ul class="ac-06__grid" role="list" data-grid>
						<?php foreach ( $settings['cards_list'] as $card ) :
							$sw_style = "--ac-06-c:{$card['swatch_color']};";
							?>
							<li class="ac-06__card" data-cat="<?php echo esc_attr( $card['cat_slug'] ); ?>">
								<span class="ac-06__sw" style="<?php echo esc_attr( $sw_style ); ?>"></span>
								<h3 class="ac-06__name"><?php echo esc_html( $card['name'] ); ?></h3>
								<p class="ac-06__tag"><?php echo esc_html( $card['tag_label'] ); ?></p>
							</li>
						<?php endforeach; ?>
					</ul>

					<p class="ac-06__count" role="status" aria-live="polite" data-count></p>

					<?php if ( ! empty( $settings['chip_text'] ) ) : ?>
						<p class="ac-06__chip"><?php echo esc_html( $settings['chip_text'] ); ?></p>
					<?php endif; ?>
				</div>
			</section>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-filter-relayout-flip">
			<section class="ac-06">
				<div class="ac-06__stage">
					<header class="ac-06__head">
						<# if ( settings.eyebrow ) { #>
							<p class="ac-06__eyebrow">{{{ settings.eyebrow }}}</p>
						<# } #>

						<# if ( settings.title ) { #>
							<h2 class="ac-06__title">{{{ settings.title }}}</h2>
						<# } #>

						<# if ( settings.filters_list.length ) { #>
							<div class="ac-06__tabs" role="group" aria-label="Filter cards by category">
								<# _.each( settings.filters_list, function( filter, i ) {
									var is_all = i === 0 || filter.slug === 'all';
								#>
									<button class="ac-06__tab" type="button" data-filter="{{{ filter.slug }}}" aria-pressed="{{{ is_all ? 'true' : 'false' }}}">
										{{{ filter.label }}}
									</button>
								<# }); #>
							</div>
						<# } #>
					</header>

					<ul class="ac-06__grid" role="list" data-grid>
						<# _.each( settings.cards_list, function( card ) {
							var sw_style = '--ac-06-c:' + card.swatch_color + ';';
						#>
							<li class="ac-06__card" data-cat="{{{ card.cat_slug }}}">
								<span class="ac-06__sw" style="{{{ sw_style }}}"></span>
								<h3 class="ac-06__name">{{{ card.name }}}</h3>
								<p class="ac-06__tag">{{{ card.tag_label }}}</p>
							</li>
						<# }); #>
					</ul>

					<p class="ac-06__count" role="status" aria-live="polite" data-count></p>

					<# if ( settings.chip_text ) { #>
						<p class="ac-06__chip">{{{ settings.chip_text }}}</p>
					<# } #>
				</div>
			</section>
		</div>
		<?php
	}
}
