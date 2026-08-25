( function( $ ) {
	var AmazingParallaxCardHandler = function( $scope, $ ) {
		var root = $scope.find( '.plx-08' )[0];
		if ( ! root ) return;

		var cards = Array.from( root.querySelectorAll( '.plx-08__card' ) );
		var TILT_MAX = 18;
		var BG_SPEED = 0.3;
		var GEO_SPEED = -0.5;
		var CONTENT_SPEED = 0.7;

		cards.forEach( function( card ) {
			var bg = card.querySelector( '.plx-08__card-bg' );
			var light = card.querySelector( '.plx-08__card-light' );
			var geo = card.querySelector( '.plx-08__card-geo' );
			var content = card.querySelector( '.plx-08__card-content' );

			function onMove( e ) {
				var rect = card.getBoundingClientRect();
				var nx = ( ( e.clientX - rect.left ) / rect.width ) * 2 - 1;
				var ny = ( ( e.clientY - rect.top ) / rect.height ) * 2 - 1;

				var rotX = -ny * TILT_MAX;
				var rotY = nx * TILT_MAX;
				card.style.transform = 'perspective(800px) rotateX(' + rotX + 'deg) rotateY(' + rotY + 'deg)';

				if ( bg ) {
					var bgX = nx * 20 * BG_SPEED;
					var bgY = ny * 20 * BG_SPEED;
					bg.style.transform = 'translateX(' + bgX + 'px) translateY(' + bgY + 'px)';
				}

				if ( light ) {
					light.style.background = 'radial-gradient(circle at ' + ( ( nx + 1 ) / 2 * 100 ) + '% ' + ( ( ny + 1 ) / 2 * 100 ) + '%, rgba(255,255,255,0.15) 0%, transparent 55%)';
				}

				if ( geo ) {
					var geoX = nx * 20 * GEO_SPEED;
					var geoY = ny * 20 * GEO_SPEED;
					geo.style.transform = 'translateX(' + geoX + 'px) translateY(' + geoY + 'px)';
				}

				if ( content ) {
					var contentX = nx * 12 * CONTENT_SPEED;
					var contentY = ny * 12 * CONTENT_SPEED;
					content.style.transform = 'translateX(' + contentX + 'px) translateY(' + contentY + 'px) translateZ(20px)';
				}
			}

			function onLeave() {
				card.style.transform = 'perspective(800px) rotateX(0deg) rotateY(0deg)';
				if ( bg ) bg.style.transform = 'translateX(0px) translateY(0px)';
				if ( geo ) geo.style.transform = 'translateX(0px) translateY(0px)';
				if ( content ) content.style.transform = 'translateX(0px) translateY(0px) translateZ(0px)';
				if ( light ) light.style.background = 'radial-gradient(circle at 50% 50%, rgba(255,255,255,0.12) 0%, transparent 60%)';
			}

			function onTouch( e ) {
				var t = e.touches[0];
				onMove( { clientX: t.clientX, clientY: t.clientY } );
			}

			card.addEventListener( 'mousemove', onMove );
			card.addEventListener( 'mouseleave', onLeave );
			card.addEventListener( 'touchmove', onTouch, { passive: true } );
			card.addEventListener( 'touchend', onLeave );
		} );
	};

	$( window ).on( 'elementor/frontend/init', function() {
		elementorFrontend.hooks.addAction( 'frontend/element_ready/amazing-css-parallax-card-hover.default', AmazingParallaxCardHandler );
	} );
} )( jQuery );
