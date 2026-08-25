<?php
namespace AmazingWidgets;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Plugin_Init {

	private static $instance = null;

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}

	public function __construct() {
		// Registra a categoria personalizada de widgets
		add_action( 'elementor/elements/categories_registered', [ $this, 'register_category' ] );

		// Registra os widgets
		add_action( 'elementor/widgets/register', [ $this, 'register_widgets' ] );

		// Registra os estilos e scripts
		add_action( 'elementor/frontend/after_register_styles', [ $this, 'register_styles' ] );
		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'register_scripts' ] );
	}

	public function register_category( $elements_manager ) {
		$elements_manager->add_category(
			'amazing-widgets',
			[
				'title' => __( 'Amazing Widgets', 'amazing-widgets-for-elementor' ),
				'icon'  => 'fa fa-plug',
			]
		);
	}

	public function register_styles() {
		$styles = [
			'amazing-widget-exemplo-card'                    => 'exemplo-card.css',
			'amazing-widget-3d-overlapping-stacked-cards'    => '3d-overlapping-stacked-cards.css',
			'amazing-widget-ambient-breathing-glow'         => 'ambient-breathing-glow.css',
			'amazing-widget-animated-gradient-border-card'  => 'animated-gradient-border-card.css',
			'amazing-widget-css-parallax-card-hover'         => 'css-parallax-card-hover.css',
			'amazing-widget-css-stacked-cards-hover-reveal'  => 'css-stacked-cards-hover-reveal.css',
			'amazing-widget-css-stacking-cards-sticky-stack' => 'css-stacking-cards-sticky-stack.css',
			'amazing-widget-cursor-spotlight-follow'         => 'cursor-spotlight-follow.css',
			'amazing-widget-dark-mode-faq-accordion'         => 'dark-mode-faq-accordion.css',
			'amazing-widget-filter-relayout-flip'            => 'filter-relayout-flip.css',
			'amazing-widget-glassmorphism-faq-accordion'     => 'glassmorphism-faq-accordion.css',
			'amazing-widget-horizontal-accordion-expand'     => 'horizontal-accordion-expand.css',
			'amazing-widget-horizontal-faq-accordion'        => 'horizontal-faq-accordion.css',
			'amazing-widget-horizontal-scroll-section'       => 'horizontal-scroll-section.css',
			'amazing-widget-peel-back'                        => 'peel-back.css',
			'amazing-widget-perspective-deck'                => 'perspective-deck.css',
			'amazing-widget-scroll-activated-stacked-cards'  => 'scroll-activated-stacked-cards.css',
			'amazing-widget-scroll-driven-scaling-stack'     => 'scroll-driven-scaling-stack.css',
			'amazing-widget-staircase-bricks'                => 'staircase-bricks.css',
			'amazing-widget-swipeable-click-to-front'        => 'swipeable-click-to-front.css',
			'amazing-widget-view-transitions-card-morph'     => 'view-transitions-card-morph.css',
		];

		foreach ( $styles as $handle => $filename ) {
			wp_register_style(
				$handle,
				plugins_url( 'assets/css/' . $filename, __DIR__ ),
				[],
				'1.0.0'
			);
		}
	}

	public function register_scripts() {
		$scripts = [
			'amazing-widget-exemplo-card'                   => 'exemplo-card.js',
			'amazing-widget-css-parallax-card-hover'        => 'css-parallax-card-hover.js',
			'amazing-widget-cursor-spotlight-follow'        => 'cursor-spotlight-follow.js',
			'amazing-widget-filter-relayout-flip'           => 'filter-relayout-flip.js',
			'amazing-widget-scroll-activated-stacked-cards' => 'scroll-activated-stacked-cards.js',
			'amazing-widget-swipeable-click-to-front'       => 'swipeable-click-to-front.js',
			'amazing-widget-view-transitions-card-morph'    => 'view-transitions-card-morph.js',
		];

		foreach ( $scripts as $handle => $filename ) {
			wp_register_script(
				$handle,
				plugins_url( 'assets/js/' . $filename, __DIR__ ),
				[ 'jquery' ],
				'1.0.0',
				true
			);
		}
	}

	public function register_widgets( $widgets_manager ) {
		$widgets = [
			'class-widget-exemplo-card.php'                   => '\Amazing_Widget_Exemplo_Card',
			'class-widget-3d-overlapping-stacked-cards.php'   => '\Amazing_Widget_3D_Overlapping_Stacked_Cards',
			'class-widget-ambient-breathing-glow.php'         => '\Amazing_Widget_Ambient_Breathing_Glow',
			'class-widget-animated-gradient-border-card.php' => '\Amazing_Widget_Animated_Gradient_Border_Card',
			'class-widget-css-parallax-card-hover.php'        => '\Amazing_Widget_CSS_Parallax_Card_Hover',
			'class-widget-css-stacked-cards-hover-reveal.php' => '\Amazing_Widget_CSS_Stacked_Cards_Hover_Reveal',
			'class-widget-css-stacking-cards-sticky-stack.php' => '\Amazing_Widget_CSS_Stacking_Cards_Sticky_Stack',
			'class-widget-cursor-spotlight-follow.php'        => '\Amazing_Widget_Cursor_Spotlight_Follow',
			'class-widget-dark-mode-faq-accordion.php'        => '\Amazing_Widget_Dark_Mode_FAQ_Accordion',
			'class-widget-filter-relayout-flip.php'           => '\Amazing_Widget_Filter_Relayout_FLIP',
			'class-widget-glassmorphism-faq-accordion.php'    => '\Amazing_Widget_Glassmorphism_FAQ_Accordion',
			'class-widget-horizontal-accordion-expand.php'    => '\Amazing_Widget_Horizontal_Accordion_Expand',
			'class-widget-horizontal-faq-accordion.php'       => '\Amazing_Widget_Horizontal_FAQ_Accordion',
			'class-widget-horizontal-scroll-section.php'      => '\Amazing_Widget_Horizontal_Scroll_Section',
			'class-widget-peel-back.php'                       => '\Amazing_Widget_Peel_Back',
			'class-widget-perspective-deck.php'               => '\Amazing_Widget_Perspective_Deck',
			'class-widget-scroll-activated-stacked-cards.php' => '\Amazing_Widget_Scroll_Activated_Stacked_Cards',
			'class-widget-scroll-driven-scaling-stack.php'    => '\Amazing_Widget_Scroll_Driven_Scaling_Stack',
			'class-widget-staircase-bricks.php'               => '\Amazing_Widget_Staircase_Bricks',
			'class-widget-swipeable-click-to-front.php'       => '\Amazing_Widget_Swipeable_Click_To_Front',
			'class-widget-view-transitions-card-morph.php'    => '\Amazing_Widget_View_Transitions_Card_Morph',
		];

		foreach ( $widgets as $file => $class_name ) {
			require_once __DIR__ . '/widgets/' . $file;
			$widgets_manager->register( new $class_name() );
		}
	}
}
