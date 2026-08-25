<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_Staircase_Bricks extends Widget_Base {

	public function get_name() {
		return 'amazing-staircase-bricks';
	}

	public function get_title() {
		return __( 'Staircase Bricks', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-steps';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-staircase-bricks' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_cards',
			[
				'label' => __( 'Cards / Degraus', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Título', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Plan',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'subtitle',
			[
				'label'   => __( 'Subtítulo', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Scope & milestones',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'color',
			[
				'label'   => __( 'Cor do Card (OKLCH ou HEX)', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'oklch(0.64 0.16 265)',
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'   => __( 'Link', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::URL,
				'default' => [ 'url' => '#' ],
			]
		);

		$this->add_control(
			'cards_list',
			[
				'label'       => __( 'Lista de Cards (Cascata)', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[ 'title' => 'Plan', 'subtitle' => 'Scope & milestones', 'color' => 'oklch(0.64 0.16 265)' ],
					[ 'title' => 'Design', 'subtitle' => 'Flows & system', 'color' => 'oklch(0.64 0.15 210)' ],
					[ 'title' => 'Build', 'subtitle' => 'Ship in slices', 'color' => 'oklch(0.66 0.15 160)' ],
					[ 'title' => 'Launch', 'subtitle' => 'Measure & iterate', 'color' => 'oklch(0.68 0.16 90)' ],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		?>
		<div class="amazing-widget-staircase-bricks">
			<section class="scd-13">
				<div class="scd-13__stair">
					<?php foreach ( $settings['cards_list'] as $i => $item ) :
						$url   = ! empty( $item['link']['url'] ) ? $item['link']['url'] : '#';
						$style = "--i:{$i};--c:{$item['color']};";
						?>
						<a class="scd-13__card" href="<?php echo esc_url( $url ); ?>" style="<?php echo esc_attr( $style ); ?>">
							<b><?php echo esc_html( $item['title'] ); ?></b>
							<span><?php echo esc_html( $item['subtitle'] ); ?></span>
						</a>
					<?php endforeach; ?>
				</div>
			</section>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-staircase-bricks">
			<section class="scd-13">
				<div class="scd-13__stair">
					<# _.each( settings.cards_list, function( item, i ) {
						var style = '--i:' + i + ';--c:' + item.color + ';';
					#>
						<a class="scd-13__card" href="{{{ item.link.url }}}" style="{{{ style }}}">
							<b>{{{ item.title }}}</b>
							<span>{{{ item.subtitle }}}</span>
						</a>
					<# }); #>
				</div>
			</section>
		</div>
		<?php
	}
}
