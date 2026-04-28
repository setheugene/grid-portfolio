/* global portfolioData */

document.addEventListener( 'DOMContentLoaded', () => {
	const form = document.getElementById( 'contact-form' );
	if ( ! form ) return;

	form.addEventListener( 'submit', async ( e ) => {
		e.preventDefault();

		const btn       = form.querySelector( '[type="submit"]' );
		const errorEl   = form.querySelector( '.form-error' );

		btn.disabled    = true;
		btn.textContent = 'Sending…';

		if ( errorEl ) {
			errorEl.textContent = '';
			errorEl.classList.add( 'hidden' );
		}

		const body = {
			name:    form.querySelector( '[name="name"]' ).value.trim(),
			email:   form.querySelector( '[name="email"]' ).value.trim(),
			message: form.querySelector( '[name="message"]' ).value.trim(),
			honey:   form.querySelector( '[name="honey"]' ).value,
		};

		try {
			const res = await fetch( portfolioData.restUrl, {
				method:  'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-WP-Nonce':   portfolioData.nonce,
				},
				body: JSON.stringify( body ),
			} );

			const data = await res.json();

			if ( data.success ) {
				form.innerHTML = '<p class="form-success">Message sent. I\'ll be in touch.</p>';
			} else {
				btn.disabled    = false;
				btn.textContent = 'Send Message';

				if ( errorEl ) {
					errorEl.textContent = data.message || 'Something went wrong. Try emailing directly.';
					errorEl.classList.remove( 'hidden' );
				}
			}
		} catch {
			btn.disabled    = false;
			btn.textContent = 'Send Message';

			if ( errorEl ) {
				errorEl.textContent = 'Network error. Please try again.';
				errorEl.classList.remove( 'hidden' );
			}
		}
	} );
} );
