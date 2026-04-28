/**
 * main.js
 *
 * Two responsibilities:
 *  1. Mobile nav toggle — sets data-nav-open on <body>, manages aria-expanded
 *  2. Scroll fade-in — IntersectionObserver adds .is-visible to [data-animate] elements
 *
 * No libraries. No framework. Vanilla ES6+.
 */

document.addEventListener( 'DOMContentLoaded', () => {

	// -------------------------------------------------------------------------
	// 1. Mobile nav toggle
	// -------------------------------------------------------------------------

	const toggle = document.querySelector( '.nav-toggle' );
	const nav    = document.getElementById( 'primary-nav' );

	if ( toggle && nav ) {
		toggle.addEventListener( 'click', () => {
			const isOpen = document.body.hasAttribute( 'data-nav-open' );

			document.body.toggleAttribute( 'data-nav-open' );
			toggle.setAttribute( 'aria-expanded', String( ! isOpen ) );

			// Toggle hidden directly — Tailwind's utility layer wins over the
			// component-layer CSS selector, so we manage visibility in JS.
			nav.classList.toggle( 'hidden', isOpen );
		} );

		// Close on Escape — restore focus to toggle button
		document.addEventListener( 'keydown', ( e ) => {
			if ( e.key === 'Escape' && document.body.hasAttribute( 'data-nav-open' ) ) {
				document.body.removeAttribute( 'data-nav-open' );
				toggle.setAttribute( 'aria-expanded', 'false' );
				nav.classList.add( 'hidden' );
				toggle.focus();
			}
		} );
	}

	// -------------------------------------------------------------------------
	// 2. Scroll fade-in (IntersectionObserver)
	// -------------------------------------------------------------------------

	// Skip animations if user prefers reduced motion
	const prefersReduced = window.matchMedia( '(prefers-reduced-motion: reduce)' ).matches;

	if ( ! prefersReduced ) {
		const observer = new IntersectionObserver(
			( entries ) => {
				entries.forEach( ( entry ) => {
					if ( entry.isIntersecting ) {
						entry.target.classList.add( 'is-visible' );
						observer.unobserve( entry.target ); // fire once
					}
				} );
			},
			{ threshold: 0.15 }
		);

		document.querySelectorAll( '[data-animate]' ).forEach( ( el ) => {
			observer.observe( el );
		} );
	} else {
		// Make all animated elements immediately visible
		document.querySelectorAll( '[data-animate]' ).forEach( ( el ) => {
			el.classList.add( 'is-visible' );
		} );
	}
	
	document.querySelectorAll( '.front-page__grid-square' ).forEach( ( square ) => {
		square.addEventListener( 'click', () => {
			square.classList.toggle( 'is-active' );
		} );
	} );

} );
