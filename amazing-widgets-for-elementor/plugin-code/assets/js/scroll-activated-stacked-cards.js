( function( $ ) {
	var AmazingScrollStackedHandler = function( $scope, $ ) {
		var root = $scope.find( '.scd-29' )[0];
		if ( ! root ) return;

		var steps = Array.from( root.querySelectorAll( '.scd-29__step' ) );
		if ( ! steps.length ) return;

		function update() {
			steps.forEach( function( s, i ) {
				var r = s.getBoundingClientRect();
				var stickTop = window.innerHeight * ( 0.20 + i * 0.02 );
				var next = steps[ i + 1 ];
				if ( next ) {
					var nr = next.getBoundingClientRect();
					var prog = Math.min( Math.max( ( stickTop + 320 - nr.top ) / 320, 0 ), 1 );
					s.style.transform = 'scale(' + ( 1 - prog * 0.10 ) + ') translateY(' + ( prog * -8 ) + 'px)';
					s.style.filter = 'brightness(' + ( 1 - prog * 0.35 ) + ')';
					var fill = s.querySelector( '.scd-29__bar i' );
					if ( fill ) fill.style.width = ( prog * 100 ) + '%';
				} else {
					var fill = s.querySelector( '.scd-29__bar i' );
					if ( fill ) fill.style.width = '100%';
				}
			} );
		}

		window.addEventListener( 'scroll', update, { passive: true } );
		window.addEventListener( 'resize', update );
		update();
	};

	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/amazing-scroll-activated-stacked-cards.default', AmazingScrollStackedHandler );
	} );
} )( jQuery );
