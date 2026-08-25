( function( $ ) {
	var AmazingSwipeableCardHandler = function( $scope, $ ) {
		var root = $scope.find( '.scd-09' )[0];
		if ( ! root ) return;

		var deck = root.querySelector( '.scd-09__deck' );
		var live = root.querySelector( '.scd-09__sr' );
		var btnNext = root.querySelector( '.scd-09__cyc' );
		if ( ! deck ) return;

		var paint = function() {
			Array.from( deck.children ).forEach( function( c, i ) {
				c.style.setProperty( '--depth', i );
			} );
		};

		function cycle() {
			var front = deck.firstElementChild;
			if ( ! front ) return;
			front.classList.add( 'scd-09__sending' );
			front.addEventListener( 'transitionend', function() {
				front.classList.remove( 'scd-09__sending' );
				deck.appendChild( front );
				paint();
				if ( live && deck.firstElementChild ) {
					var nf = deck.firstElementChild.querySelector( 'b' );
					if ( nf ) live.textContent = 'Now showing ' + nf.textContent;
				}
			}, { once: true } );
		}

		deck.addEventListener( 'click', function( e ) {
			if ( e.target.closest( '.scd-09__card' ) === deck.firstElementChild ) cycle();
		} );

		if ( btnNext ) btnNext.addEventListener( 'click', cycle );
		paint();
	};

	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/amazing-swipeable-click-to-front.default', AmazingSwipeableCardHandler );
	} );
} )( jQuery );
