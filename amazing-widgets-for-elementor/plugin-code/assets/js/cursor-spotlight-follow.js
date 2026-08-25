( function( $ ) {
	var AmazingSpotlightHandler = function( $scope, $ ) {
		var root = $scope.find( '.bga-02' )[0];
		if ( ! root ) return;

		var calm = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
		if ( ! calm ) root.classList.add( 'is-idle' );

		root.addEventListener( 'pointermove', function( e ) {
			var r = root.getBoundingClientRect();
			root.classList.remove( 'is-idle' );
			root.style.setProperty( '--bga-02-mx', ( ( e.clientX - r.left ) / r.width * 100 ).toFixed( 2 ) + '%' );
			root.style.setProperty( '--bga-02-my', ( ( e.clientY - r.top ) / r.height * 100 ).toFixed( 2 ) + '%' );
		}, { passive: true } );

		root.addEventListener( 'pointerleave', function() {
			root.style.removeProperty( '--bga-02-mx' );
			root.style.removeProperty( '--bga-02-my' );
			if ( ! calm ) root.classList.add( 'is-idle' );
		} );
	};

	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/amazing-cursor-spotlight-follow.default', AmazingSpotlightHandler );
	} );
} )( jQuery );
