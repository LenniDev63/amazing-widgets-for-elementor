<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_Perspective_Deck extends Widget_Base {

	public function get_name() {
		return 'amazing-perspective-deck';
	}

	public function get_title() {
		return __( 'Perspective Deck 3D', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-box';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-perspective-deck' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_cards',
			[
				'label' => __( 'Cards do Deck', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Título do Setor / Card', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'SECTOR 01',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'status',
			[
				'label'   => __( 'Status / Subtítulo', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Active node // online',
				'dynamic' => [ 'active' => true ],
			]
		);

		$this->add_control(
			'cards_list',
			[
				'label'       => __( 'Lista de Cards (Frente para Trás)', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[ 'title' => 'SECTOR 01', 'status' => 'Active node // online' ],
					[ 'title' => 'SECTOR 02', 'status' => 'Buffered // standby' ],
					[ 'title' => 'SECTOR 03', 'status' => 'Cached // idle' ],
					[ 'title' => 'SECTOR 04', 'status' => 'Archived // sleep' ],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$cards    = $settings['cards_list'];
		?>
		<div class="amazing-widget-perspective-deck">
			<div class="scd-33">
				<div class="scd-33__stage">
					<div class="scd-33__deck">
						<?php foreach ( $cards as $index => $item ) :
							$z = $index * -80;
							$y = $index * -26;
							$op = max( 0.2, 1 - ( $index * 0.2 ) );
							$style = "transform: translateZ({$z}px) translateY({$y}px); opacity: {$op};";
							?>
							<div class="scd-33__card" style="<?php echo esc_attr( $style ); ?>">
								<h3><?php echo esc_html( $item['title'] ); ?></h3>
								<p><?php echo esc_html( $item['status'] ); ?></p>
							</div>
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>

		<style>
		<?php foreach ( $cards as $index => $item ) :
			$nth = $index + 1;
			$z = $index * -80;
			$y = $index * -26;
			$op = max( 0.2, 1 - ( $index * 0.2 ) );
			echo "{{WRAPPER}} .scd-33__card:nth-child({$nth}) { transform: translateZ({$z}px) translateY({$y}px); opacity: {$op}; }\n";
			if ( $index === 0 ) {
				echo "{{WRAPPER}} .scd-33__stage:hover .scd-33__card:nth-child(1) { transform: translateZ(60px); }\n";
			}
		endforeach; ?>
		</style>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-perspective-deck">
			<div class="scd-33">
				<div class="scd-33__stage">
					<div class="scd-33__deck">
						<# _.each( settings.cards_list, function( item, index ) {
							var z = index * -80;
							var y = index * -26;
							var op = Math.max( 0.2, 1 - ( index * 0.2 ) );
							var style = 'transform: translateZ(' + z + 'px) translateY(' + y + 'px); opacity: ' + op + ';';
						#>
							<div class="scd-33__card" style="{{{ style }}}">
								<h3>{{{ item.title }}}</h3>
								<p>{{{ item.status }}}</p>
							</div>
						<# }); #>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
}
