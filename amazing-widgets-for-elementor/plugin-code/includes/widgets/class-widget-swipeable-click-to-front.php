<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_Swipeable_Click_To_Front extends Widget_Base {

	public function get_name() {
		return 'amazing-swipeable-click-to-front';
	}

	public function get_title() {
		return __( 'Swipeable Click-to-Front Cards', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-carousel';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-swipeable-click-to-front' ];
	}

	public function get_script_depends() {
		return [ 'amazing-widget-swipeable-click-to-front' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_cards',
			[
				'label' => __( 'Cards / Tickets', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'tag',
			[
				'label'   => __( 'Tag Superior (Ex: Ticket #)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Ticket #4821',
			]
		);

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Título', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Payment retry loop',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'meta',
			[
				'label'   => __( 'Texto de Rodapé (Ex: Priority)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'High · Billing',
			]
		);

		$repeater->add_control(
			'color',
			[
				'label'   => __( 'Cor do Card (OKLCH ou HEX)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'oklch(0.63 0.17 20)',
			]
		);

		$this->add_control(
			'cards_list',
			[
				'label'       => __( 'Lista de Cards', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[ 'tag' => 'Ticket #4821', 'title' => 'Payment retry loop', 'meta' => 'High · Billing', 'color' => 'oklch(0.63 0.17 20)' ],
					[ 'tag' => 'Ticket #4822', 'title' => 'Slow search on mobile', 'meta' => 'Medium · Web', 'color' => 'oklch(0.66 0.15 150)' ],
					[ 'tag' => 'Ticket #4823', 'title' => 'Export to CSV missing', 'meta' => 'Low · Reports', 'color' => 'oklch(0.64 0.16 250)' ],
					[ 'tag' => 'Ticket #4824', 'title' => 'SSO redirect fails', 'meta' => 'High · Auth', 'color' => 'oklch(0.64 0.16 300)' ],
				],
				'title_field' => '{{{ tag }}} - {{{ title }}}',
			]
		);

		$this->add_control(
			'btn_text',
			[
				'label'   => __( 'Texto do Botão Próximo', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Next ticket ↻', 'amazing-widgets-for-elementor' ),
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="amazing-widget-swipeable-click-to-front">
			<section class="scd-09">
				<div class="scd-09__deck">
					<?php foreach ( $settings['cards_list'] as $i => $item ) :
						$c_style = "--c:{$item['color']}; --depth:{$i};";
						?>
						<button class="scd-09__card" type="button" style="<?php echo esc_attr( $c_style ); ?>">
							<span><?php echo esc_html( $item['tag'] ); ?></span>
							<b><?php echo esc_html( $item['title'] ); ?></b>
							<i><?php echo esc_html( $item['meta'] ); ?></i>
						</button>
					<?php endforeach; ?>
				</div>
				<?php if ( ! empty( $settings['btn_text'] ) ) : ?>
					<div class="scd-09__foot">
						<button class="scd-09__cyc" type="button"><?php echo esc_html( $settings['btn_text'] ); ?></button>
						<p class="scd-09__sr" aria-live="polite"></p>
					</div>
				<?php endif; ?>
			</section>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-swipeable-click-to-front">
			<section class="scd-09">
				<div class="scd-09__deck">
					<# _.each( settings.cards_list, function( item, i ) {
						var c_style = '--c:' + item.color + '; --depth:' + i + ';';
					#>
						<button class="scd-09__card" type="button" style="{{{ c_style }}}">
							<span>{{{ item.tag }}}</span>
							<b>{{{ item.title }}}</b>
							<i>{{{ item.meta }}}</i>
						</button>
					<# }); #>
				</div>
				<# if ( settings.btn_text ) { #>
					<div class="scd-09__foot">
						<button class="scd-09__cyc" type="button">{{{ settings.btn_text }}}</button>
						<p class="scd-09__sr" aria-live="polite"></p>
					</div>
				<# } #>
			</section>
		</div>
		<?php
	}
}
