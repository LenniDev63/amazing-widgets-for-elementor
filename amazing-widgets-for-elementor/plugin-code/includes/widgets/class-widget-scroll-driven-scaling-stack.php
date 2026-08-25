<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_Scroll_Driven_Scaling_Stack extends Widget_Base {

	public function get_name() {
		return 'amazing-scroll-driven-scaling-stack';
	}

	public function get_title() {
		return __( 'Scroll Driven Scaling Stack', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-history';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-scroll-driven-scaling-stack' ];
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
			'num',
			[
				'label'   => __( 'Número', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => '01',
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Título', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Capture',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'description',
			[
				'label'   => __( 'Descrição', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXTAREA,
				'default' => 'Every idea starts as a rough note. We pin it before it escapes.',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'gradient',
			[
				'label'   => __( 'Gradiente CSS de Fundo', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'linear-gradient(135deg,oklch(0.62 0.17 264),oklch(0.55 0.16 292))',
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
						'num'         => '01',
						'title'       => 'Capture',
						'description' => 'Every idea starts as a rough note. We pin it before it escapes.',
						'gradient'    => 'linear-gradient(135deg,oklch(0.62 0.17 264),oklch(0.55 0.16 292))',
					],
					[
						'num'         => '02',
						'title'       => 'Shape',
						'description' => 'Notes compress into a plan — the earlier one settles quietly behind.',
						'gradient'    => 'linear-gradient(135deg,oklch(0.66 0.15 200),oklch(0.6 0.16 250))',
					],
					[
						'num'         => '03',
						'title'       => 'Ship',
						'description' => 'The plan surfaces on top, in focus, ready to hand off.',
						'gradient'    => 'linear-gradient(135deg,oklch(0.7 0.15 150),oklch(0.62 0.15 200))',
					],
					[
						'num'         => '04',
						'title'       => 'Reflect',
						'description' => 'What worked stacks up as depth you can scroll back through.',
						'gradient'    => 'linear-gradient(135deg,oklch(0.72 0.16 60),oklch(0.64 0.17 30))',
					],
				],
				'title_field' => '{{{ num }}} - {{{ title }}}',
			]
		);

		$this->add_control(
			'hint_text',
			[
				'label'   => __( 'Texto Dica', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Scroll ↓ inside this panel', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->add_control(
			'end_text',
			[
				'label'   => __( 'Texto Fim', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Fin.', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="amazing-widget-scroll-driven-scaling-stack">
			<section class="scd-01">
				<div class="scd-01__scene">
					<?php if ( ! empty( $settings['hint_text'] ) ) : ?>
						<p class="scd-01__hint"><?php echo esc_html( $settings['hint_text'] ); ?></p>
					<?php endif; ?>

					<?php foreach ( $settings['cards_list'] as $i => $item ) :
						$grad_style = ! empty( $item['gradient'] ) ? "background: {$item['gradient']};" : '';
						$style = "--i:{$i}; {$grad_style}";
						?>
						<article class="scd-01__card" style="<?php echo esc_attr( $style ); ?>">
							<span class="scd-01__num"><?php echo esc_html( $item['num'] ); ?></span>
							<h3><?php echo esc_html( $item['title'] ); ?></h3>
							<p><?php echo esc_html( $item['description'] ); ?></p>
						</article>
					<?php endforeach; ?>

					<?php if ( ! empty( $settings['end_text'] ) ) : ?>
						<div class="scd-01__end"><?php echo esc_html( $settings['end_text'] ); ?></div>
					<?php endif; ?>
				</div>
			</section>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-scroll-driven-scaling-stack">
			<section class="scd-01">
				<div class="scd-01__scene">
					<# if ( settings.hint_text ) { #>
						<p class="scd-01__hint">{{{ settings.hint_text }}}</p>
					<# } #>

					<# _.each( settings.cards_list, function( item, i ) {
						var grad_style = item.gradient ? 'background: ' + item.gradient + ';' : '';
						var style = '--i:' + i + '; ' + grad_style;
					#>
						<article class="scd-01__card" style="{{{ style }}}">
							<span class="scd-01__num">{{{ item.num }}}</span>
							<h3>{{{ item.title }}}</h3>
							<p>{{{ item.description }}}</p>
						</article>
					<# }); #>

					<# if ( settings.end_text ) { #>
						<div class="scd-01__end">{{{ settings.end_text }}}</div>
					<# } #>
				</div>
			</section>
		</div>
		<?php
	}
}
