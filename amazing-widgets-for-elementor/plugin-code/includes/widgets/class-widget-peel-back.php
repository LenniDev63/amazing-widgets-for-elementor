<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;

class Amazing_Widget_Peel_Back extends Widget_Base {

	public function get_name() {
		return 'amazing-peel-back';
	}

	public function get_title() {
		return __( 'Peel Back Stacked Cards', 'amazing-widgets-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-copy-bold';
	}

	public function get_categories() {
		return [ 'amazing-widgets' ];
	}

	public function get_style_depends() {
		return [ 'amazing-widget-peel-back' ];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'section_cards',
			[
				'label' => __( 'Cards do Stack (3 Camadas)', 'amazing-widgets-for-elementor' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'label'   => __( 'Título', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Peel me',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'description',
			[
				'label'   => __( 'Descrição', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Hover to lift the top',
				'dynamic' => [ 'active' => true ],
			]
		);

		$repeater->add_control(
			'bg_gradient',
			[
				'label'   => __( 'Gradiente CSS de Fundo', 'amazing-widgets-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'linear-gradient(150deg,#ff6a3d,#f9484a)',
			]
		);

		$repeater->add_control(
			'text_color',
			[
				'label'     => __( 'Cor do Texto', 'amazing-widgets-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ffffff',
			]
		);

		$this->add_control(
			'cards_list',
			[
				'label'       => __( 'Lista de Cards (Do fundo para o topo)', 'amazing-widgets-for-elementor' ),
				'type'        => Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'default'     => [
					[
						'title'       => 'Layer C',
						'description' => 'Bottom of the stack',
						'bg_gradient' => 'linear-gradient(150deg,#43e97b,#38f9d7)',
						'text_color'  => '#006633',
					],
					[
						'title'       => 'Layer B',
						'description' => 'The middle ground',
						'bg_gradient' => 'linear-gradient(150deg,#1fa2ff,#12d8fa)',
						'text_color'  => '#ffffff',
					],
					[
						'title'       => 'Peel me',
						'description' => 'Hover to lift the top',
						'bg_gradient' => 'linear-gradient(150deg,#ff6a3d,#f9484a)',
						'text_color'  => '#ffffff',
					],
				],
				'title_field' => '{{{ title }}}',
			]
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$cards    = $settings['cards_list'];
		$count    = count( $cards );
		?>
		<div class="amazing-widget-peel-back">
			<div class="scd-34">
				<div class="scd-34__stage">
					<?php foreach ( $cards as $index => $item ) :
						$c_num = $count - $index;
						$style = "background: {$item['bg_gradient']}; color: {$item['text_color']}; z-index: {$c_num};";
						?>
						<div class="scd-34__card scd-34__card--c<?php echo esc_attr( $c_num ); ?>" style="<?php echo esc_attr( $style ); ?>">
							<div class="scd-34__inner">
								<h3><?php echo esc_html( $item['title'] ); ?></h3>
								<p><?php echo esc_html( $item['description'] ); ?></p>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<?php
	}

	protected function content_template() {
		?>
		<div class="amazing-widget-peel-back">
			<div class="scd-34">
				<div class="scd-34__stage">
					<#
					var count = settings.cards_list.length;
					_.each( settings.cards_list, function( item, index ) {
						var c_num = count - index;
						var style = 'background: ' + item.bg_gradient + '; color: ' + item.text_color + '; z-index: ' + c_num + ';';
					#>
						<div class="scd-34__card scd-34__card--c{{{ c_num }}}" style="{{{ style }}}">
							<div class="scd-34__inner">
								<h3>{{{ item.title }}}</h3>
								<p>{{{ item.description }}}</p>
							</div>
						</div>
					<# }); #>
				</div>
			</div>
		</div>
		<?php
	}
}
