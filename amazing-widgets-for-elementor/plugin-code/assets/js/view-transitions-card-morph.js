( function( $ ) {
	var AmazingCardMorphHandler = function( $scope, $ ) {
		var root = $scope.find( '.ac-04' )[0];
		if ( ! root || root.dataset.wired ) return;
		root.dataset.wired = '1';

		var grid = root.querySelector( '[data-grid]' );
		var detail = root.querySelector( '[data-detail]' );
		if ( ! grid || ! detail ) return;

		var el = {
			hero: detail.querySelector( '[data-hero]' ),
			tag: detail.querySelector( '[data-tag]' ),
			title: detail.querySelector( '[data-dtitle]' ),
			copy: detail.querySelector( '[data-copy]' ),
			price: detail.querySelector( '[data-dprice]' ),
			back: detail.querySelector( '[data-close]' ),
		};
		var opener = null;

		var run = function( fn ) {
			if ( ! document.startViewTransition ) { fn(); return undefined; }
			var t = document.startViewTransition( fn );
			t.ready.catch( function() {} );
			return t;
		};

		var focusAfter = function( t, elem ) {
			if ( ! elem ) return;
			Promise.resolve( t && t.finished ).catch( function() {} ).finally( function() { elem.focus( { preventScroll: true } ); } );
		};

		var open = function( btn ) {
			var card = btn.closest( '.ac-04__card' );
			opener = btn;
			var name = card.dataset.name || '';
			var price = card.dataset.price || '';
			var tag = card.dataset.tag || '';
			var copy = card.dataset.copy || '';
			var imgSrc = card.querySelector( '.ac-04__thumb' ) ? card.querySelector( '.ac-04__thumb' ).src : '';

			card.dataset.active = '1';
			var t = run( function() {
				delete card.dataset.active;
				if ( el.hero ) { el.hero.src = imgSrc; el.hero.alt = name; }
				if ( el.tag ) el.tag.textContent = tag;
				if ( el.title ) el.title.textContent = name;
				if ( el.copy ) el.copy.textContent = copy;
				if ( el.price ) el.price.textContent = price;
				grid.setAttribute( 'inert', '' );
				detail.hidden = false;
			} );
			focusAfter( t, el.back );
		};

		var close = function() {
			var card = opener && opener.closest( '.ac-04__card' );
			var t = run( function() {
				detail.hidden = true;
				grid.removeAttribute( 'inert' );
				if ( card ) card.dataset.active = '1';
			} );
			focusAfter( t, opener );
			if ( card ) Promise.resolve( t && t.finished ).catch( function() {} ).finally( function() { delete card.dataset.active; } );
		};

		grid.addEventListener( 'click', function( e ) {
			var b = e.target.closest( '[data-open]' );
			if ( b ) open( b );
		} );
		if ( el.back ) el.back.addEventListener( 'click', close );
		root.addEventListener( 'keydown', function( e ) {
			if ( e.key === 'Escape' && ! detail.hidden ) {
				e.preventDefault();
				close();
			}
		} );
	};

	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/amazing-view-transitions-card-morph.default', AmazingCardMorphHandler );
	} );
} )( jQuery );
