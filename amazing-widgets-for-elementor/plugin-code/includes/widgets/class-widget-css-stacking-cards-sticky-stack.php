<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_CSS_Stacking_Cards_Sticky_Stack extends Widget_Base {

	public function get_name() {
		return 'amazing-css-stacking-cards-sticky-stack';
	}

	public function get_title() {
		return __( 'CSS Sticky Stacking Cards', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-cards';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-css-stacking-cards-sticky-stack' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_cards',
			[
				'label' => __( 'Cards', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tag',
			[
				'label'   => __( 'Tag Superior', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Case study · 01',
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Título', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Meridian Bank',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'description',
			[
				'label'   => __( 'Descrição', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Rebuilt the onboarding flow around progressive disclosure; activation up 34%.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'footer',
			[
				'label'   => __( 'Texto Rodapé', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Fintech · 2025',
			]
		);

		$repeater->add_control(
			'tint',
			[
				'label'   => __( 'Cor do Card (OKLCH ou HEX)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'oklch(0.6 0.17 264)',
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
						'tag'         => 'Case study · 01',
						'title'       => 'Meridian Bank',
						'description' => 'Rebuilt the onboarding flow around progressive disclosure; activation up 34%.',
						'footer'      => 'Fintech · 2025',
						'tint'        => 'oklch(0.6 0.17 264)',
					],
					[
						'tag'         => 'Case study · 02',
						'title'       => 'Fieldnote',
						'description' => 'A note-taking canvas for ecologists — offline-first, sync when the trail ends.',
						'footer'      => 'SaaS · 2025',
						'tint'        => 'oklch(0.62 0.15 210)',
					],
					[
						'tag'         => 'Case study · 03',
						'title'       => 'Grove & Co.',
						'description' => 'Editorial e-commerce with a scroll-driven lookbook; bounce rate halved.',
						'footer'      => 'Retail · 2026',
						'tint'        => 'oklch(0.64 0.16 150)',
					],
					[
						'tag'         => 'Case study · 04',
						'title'       => 'Waypoint',
						'description' => 'Trip-planning PWA — map-first UI, 60fps scroll choreography on mid-range phones.',
						'footer'      => 'Travel · 2026',
						'tint'        => 'oklch(0.66 0.17 60)',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->add_control(
			'hint_text',
			[
				'label'   => __( 'Texto de Dica Superior', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Scroll — each card buries the last ↓', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->add_control(
			'end_text',
			[
				'label'   => __( 'Texto de Rodapé Final', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Four cards. Zero JavaScript. One timeline each.', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="amazing-widget-css-stacking-cards-sticky-stack">
			<section class="sda-04">
				<div class="sda-04__flow">
					<?php if ( ! empty( $settings['hint_text'] ) ) : ?>
						<p class="sda-04__hint"><?php echo esc_html( $settings['hint_text'] ); ?></p>
					<?php endif; ?>

					<?php foreach ( $settings['cards_list'] as $i => $item ) :
						$style = "--i:{$i};--tint:{$item['tint']};";
						?>
						<article class="sda-04__card" style="<?php echo esc_attr( $style ); ?>">
							<span class="sda-04__tag"><?php echo esc_html( $item['tag'] ); ?></span>
							<h3><?php echo esc_html( $item['title'] ); ?></h3>
							<p><?php echo esc_html( $item['description'] ); ?></p>
							<span class="sda-04__foot"><?php echo esc_html( $item['footer'] ); ?></span>
						</article>
					<?php endforeach; ?>

					<?php if ( ! empty( $settings['end_text'] ) ) : ?>
						<p class="sda-04__end"><?php echo esc_html( $settings['end_text'] ); ?></p>
					<?php endif; ?>
				</div>
			</section>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-css-stacking-cards-sticky-stack">
			<section class="sda-04">
				<div class="sda-04__flow">
					<# if ( settings.hint_text ) { #>
						<p class="sda-04__hint">{{{ settings.hint_text }}}</p>
					<# } #>

					<# _.each( settings.cards_list, function( item, i ) {
						var style = '--i:' + i + ';--tint:' + item.tint + ';';
					#>
						<article class="sda-04__card" style="{{{ style }}}">
							<span class="sda-04__tag">{{{ item.tag }}}</span>
							<h3>{{{ item.title }}}</h3>
							<p>{{{ item.description }}}</p>
							<span class="sda-04__foot">{{{ item.footer }}}</span>
						</article>
					<# }); #>

					<# if ( settings.end_text ) { #>
						<p class="sda-04__end">{{{ settings.end_text }}}</p>
					<# } #>
				</div>
			</section>
		</div>
		<?php
	}
}
