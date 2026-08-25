( function( $ ) {
	/**
	 * Manipulador de evento no frontend do Elementor
	 */
	var AmazingExemploCardHandler = function( $scope, $ ) {
		console.log( 'Exemplo Card inicializado na página ou no editor!' );
	};

	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/amazing-exemplo-card.default', AmazingExemploCardHandler );
	} );
} )( jQuery );
