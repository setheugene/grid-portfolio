<?php
/**
 * Contact page template.
 *
 * Template Name: Contact
 *
 * Form submits via assets/js/contact.js to the custom REST endpoint at
 * /wp-json/portfolio/v1/contact. No plugin. No GravityForms.
 *
 * @package SethPortfolio
 */

get_header();
?>

<main id="main" class="site-main pt-16">

	<section class="section">
		<div class="container">

			<div class="max-w-xl">

				<!-- Header -->
				<p class="font-mono text-xs text-muted uppercase tracking-widest mb-6" data-animate>
					Contact
				</p>

				<h1 class="hdg-2 text-text mb-6" data-animate style="--delay:80ms">
					Let's talk.
				</h1>

				<p class="text-lg text-muted leading-relaxed mb-12" data-animate style="--delay:160ms">
					I'm open to senior engineering roles, contract work, and interesting projects. Drop me a line and I'll get back to you within a day.
				</p>

				<!-- Contact form -->
				<form
					id="contact-form"
					class="space-y-6"
					novalidate
					data-animate
					style="--delay:240ms"
					aria-label="Contact form"
				>

					<!-- Name -->
					<div class="flex flex-col gap-2">
						<label for="contact-name" class="font-mono text-xs text-muted uppercase tracking-widest">
							Name <span class="text-accent" aria-hidden="true">*</span>
						</label>
						<input
							id="contact-name"
							type="text"
							name="name"
							autocomplete="name"
							required
							class="bg-bg-2 border border-border rounded-sm px-4 py-3 text-text text-sm font-body placeholder:text-border focus:outline-none focus:border-accent transition-colors duration-200"
							placeholder="Your name"
						>
					</div>

					<!-- Email -->
					<div class="flex flex-col gap-2">
						<label for="contact-email" class="font-mono text-xs text-muted uppercase tracking-widest">
							Email <span class="text-accent" aria-hidden="true">*</span>
						</label>
						<input
							id="contact-email"
							type="email"
							name="email"
							autocomplete="email"
							required
							class="bg-bg-2 border border-border rounded-sm px-4 py-3 text-text text-sm font-body placeholder:text-border focus:outline-none focus:border-accent transition-colors duration-200"
							placeholder="you@example.com"
						>
					</div>

					<!-- Message -->
					<div class="flex flex-col gap-2">
						<label for="contact-message" class="font-mono text-xs text-muted uppercase tracking-widest">
							Message <span class="text-accent" aria-hidden="true">*</span>
						</label>
						<textarea
							id="contact-message"
							name="message"
							rows="6"
							required
							class="bg-bg-2 border border-border rounded-sm px-4 py-3 text-text text-sm font-body placeholder:text-border focus:outline-none focus:border-accent transition-colors duration-200 resize-y"
							placeholder="Tell me about the role or project…"
						></textarea>
					</div>

					<!-- Honeypot — hidden from real users, filled by bots -->
					<div class="hidden" aria-hidden="true">
						<label for="contact-honey">Leave this empty</label>
						<input
							id="contact-honey"
							type="text"
							name="honey"
							tabindex="-1"
							autocomplete="off"
						>
					</div>

					<!-- Error message (populated by contact.js) -->
					<p class="form-error font-mono text-xs text-red-400 hidden" role="alert" aria-live="polite"></p>

					<!-- Submit -->
					<button
						type="submit"
						class="inline-flex items-center gap-2 bg-accent text-bg font-medium text-sm px-6 py-3 rounded-sm hover:bg-white transition-colors duration-200 cursor-pointer border-0 disabled:opacity-50 disabled:cursor-not-allowed"
					>
						Send Message
						<span aria-hidden="true">→</span>
					</button>

				</form>

			</div>

		</div>
	</section>

</main>

<?php get_footer(); ?>
