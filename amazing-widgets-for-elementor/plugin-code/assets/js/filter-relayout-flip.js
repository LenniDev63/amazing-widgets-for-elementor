( function( $ ) {
	var AmazingFilterFlipHandler = function( $scope, $ ) {
		var root = $scope.find( '.ac-06' )[0];
		if ( ! root || root.dataset.wired ) return;
		root.dataset.wired = '1';

		var reduce = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;
		var grid = root.querySelector( '[data-grid]' );
		if ( ! grid ) return;
		var cards = Array.from( grid.querySelectorAll( '.ac-06__card' ) );
		var count = root.querySelector( '[data-count]' );
		var current = 'all';

		var apply = function( f ) {
			cards.forEach( function( c ) {
				c.hidden = ! ( f === 'all' || c.dataset.cat === f );
			} );
		};

		var report = function() {
			if ( ! count ) return;
			var n = cards.filter( function( c ) { return ! c.hidden; } ).length;
			count.textContent = n + ' of ' + cards.length + ' cards shown';
		};

		var flip = function( f ) {
			if ( reduce ) { apply( f ); report(); return; }
			cards.forEach( function( c ) {
				c.getAnimations().forEach( function( a ) { a.finish(); } );
			} );
			var first = new Map( cards.map( function( c ) {
				return [ c, c.hidden ? null : c.getBoundingClientRect() ];
			} ) );
			apply( f );
			cards.forEach( function( c ) {
				if ( c.hidden ) return;
				var a = first.get( c ), b = c.getBoundingClientRect();
				if ( ! a ) {
					c.animate( [ { opacity: 0, transform: 'scale(.86)' }, { opacity: 1, transform: 'none' } ],
						{ duration: 340, easing: 'cubic-bezier(.16,1,.3,1)', fill: 'both' } );
					return;
				}
				var dx = a.left - b.left, dy = a.top - b.top;
				if ( ! dx && ! dy ) return;
				c.animate( [ { transform: 'translate(' + dx + 'px,' + dy + 'px)' }, { transform: 'none' } ],
					{ duration: 440, easing: 'cubic-bezier(.16,1,.3,1)' } );
			} );
			report();
		};

		var vt = function( f ) {
			cards.forEach( function( c, i ) { c.style.viewTransitionName = 'ac-06-c' + i; } );
			var t = document.startViewTransition( function() { apply( f ); report(); } );
			t.ready.catch( function() {} );
			t.finished.catch( function() {} ).finally( function() {
				cards.forEach( function( c ) { c.style.viewTransitionName = ''; } );
			} );
		};

		root.querySelectorAll( '[data-filter]' ).forEach( function( btn ) {
			btn.addEventListener( 'click', function() {
				var f = btn.dataset.filter;
				if ( f === current ) return;
				current = f;
				root.querySelectorAll( '[data-filter]' ).forEach( function( b ) {
					b.setAttribute( 'aria-pressed', String( b === btn ) );
				} );
				if ( document.startViewTransition && ! reduce ) vt( f ); else flip( f );
			} );
		} );
		report();
	};

	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/amazing-filter-relayout-flip.default', AmazingFilterFlipHandler );
	} );
} )( jQuery );
