<?php
/**
 * Front page template.
 *
 * Sections: Hero → Selected Work → Skills → CTA band.
 *
 * @package SethPortfolio
 */

get_header();
?>

<main id="main" class="site-main">

	<!-- =====================================================================
	     Hero
	     ===================================================================== -->
	<section class="relative overflow-hidden section min-h-[calc(100svh_-_64px)] flex items-center">
		<div id="front-page__hero-bg" class="absolute inset-0 top-0 left-0 grid w-full h-full gap-px grid-cols-20 grid-rows-10 bg-border/50 size-full">
			<?php for ( $i = 0; $i < 200; $i++ ) : ?>
				<span class="size-full duration-300 ease-in-out bg-black front-page__grid-square hover:opacity-10 [&.is-active]:opacity-0 [&.is-active]:hover:opacity-10"></span>
			<?php endfor; ?>
		</div>
		<div class="container">

			<p class="mb-6 font-mono text-xs tracking-widest uppercase pointer-events-none text-muted" data-animate>
				Available for work
			</p>

			<h1 class="hdg-1 mb-8 pointer-events-none" data-animate style="--delay:80ms">
				Seth Wills.<br>
				<span class="text-muted">WordPress Engineer.</span>
			</h1>

			<p class="max-w-xl mb-10 text-lg leading-relaxed pointer-events-none text-muted" data-animate style="--delay:160ms">
				8 years building things that work — custom themes, REST APIs, headless WordPress, and the kind of code hiring managers actually want to read.
			</p>

			<div class="flex flex-wrap items-center gap-4 w-fit" data-animate style="--delay:240ms">
				<a
					href="<?php echo esc_url( home_url( '/work' ) ); ?>"
					class="inline-flex items-center gap-2 px-6 py-3 text-sm font-medium no-underline transition-colors duration-200 rounded-sm bg-accent text-bg font-body hover:bg-white"
				>
					View My Work
					<span aria-hidden="true">→</span>
				</a>
				<a
					href="<?php echo esc_url( home_url( '/about' ) ); ?>"
					class="inline-flex items-center gap-2 px-6 py-3 text-sm no-underline transition-colors duration-200 border rounded-sm text-muted border-border hover:text-white hover:border-white"
				>
					About Me
				</a>
			</div>

		</div>
		<div class="absolute bottom-0 left-0 w-full from-bg-2 to-transparent bg-linear-to-t h-[200px] pointer-events-none"></div>
	</section>

	<!-- =====================================================================
	     Selected Work
	     ===================================================================== -->
	<section class="section section--alt">
		<div class="container">

			<header class="flex items-end justify-between gap-4 mb-12">
				<div>
					<p class="mb-2 font-mono text-xs tracking-widest uppercase text-muted" data-animate>Selected Work</p>
					<h2 class="hdg-3 m-0 text-text" data-animate style="--delay:80ms">Things I've Built</h2>
				</div>
				<a
					href="<?php echo esc_url( home_url( '/work' ) ); ?>"
					class="items-center hidden gap-1 text-sm nav-link shrink-0 sm:inline-flex"
					data-animate style="--delay:80ms"
				>
					All work →
				</a>
			</header>

			<?php
			$work_query = new WP_Query( [
				'post_type'      => 'case_study',
				'posts_per_page' => 3,
				'post_status'    => 'publish',
				'no_found_rows'  => true,
			] );
			?>

			<?php if ( $work_query->have_posts() ) : ?>
				<div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-3">
					<?php while ( $work_query->have_posts() ) : $work_query->the_post(); ?>
						<?php get_template_part( 'template-parts/case-study-card' ); ?>
					<?php endwhile; ?>
				</div>
				<?php wp_reset_postdata(); ?>
			<?php else : ?>
				<p class="font-mono text-sm text-muted">No case studies published yet.</p>
			<?php endif; ?>

			<div class="mt-8 sm:hidden">
				<a
					href="<?php echo esc_url( home_url( '/work' ) ); ?>"
					class="text-sm nav-link"
				>
					View all work →
				</a>
			</div>

		</div>
	</section>

	<!-- =====================================================================
	     Skills Strip
	     ===================================================================== -->
	<section class="section">
		<div class="container">

			<p class="mb-10 font-mono text-xs tracking-widest uppercase text-muted" data-animate>
				Core Stack
			</p>

			<?php
			$skill_groups = [
				'WordPress'  => [ 'Custom Themes', 'CPT & Taxonomies', 'Gutenberg Blocks', 'REST API', 'Multisite', 'WP-CLI' ],
				'Languages'  => [ 'PHP 8', 'JavaScript (ES6+)', 'HTML / CSS', 'SQL', 'Bash' ],
				'Ecosystem'  => [ 'ACF', 'Yoast SEO', 'WooCommerce', 'Tailwind CSS', 'Git' ],
				'Craft'      => [ 'Lighthouse ≥ 95', 'Core Web Vitals', 'Accessibility', 'Local by Flywheel', 'Flywheel / WP Engine' ],
			];
			?>

			<div class="grid grid-cols-1 gap-10 sm:grid-cols-2 lg:grid-cols-4">
				<?php foreach ( $skill_groups as $group => $skills ) : ?>
					<div data-animate>
						<h3 class="mb-4 font-mono text-xs tracking-widest uppercase text-accent"><?php echo esc_html( $group ); ?></h3>
						<ul class="p-0 m-0 space-y-2 list-none">
							<?php foreach ( $skills as $skill ) : ?>
								<li class="text-sm leading-snug text-muted"><?php echo esc_html( $skill ); ?></li>
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endforeach; ?>
			</div>

		</div>
	</section>

	<!-- =====================================================================
	     CTA Band
	     ===================================================================== -->
	<section class="section section--alt">
		<div class="container text-center">

			<p class="mb-4 font-mono text-xs tracking-widest uppercase text-accent" data-animate>
				Open to Opportunities
			</p>

			<h2 class="hdg-2 mb-6 text-text" data-animate style="--delay:80ms">
				Available for the right role.
			</h2>

			<p class="max-w-lg mx-auto mb-10 text-lg text-muted" data-animate style="--delay:160ms">
				Senior WordPress engineering, full-time or contract. Remote-friendly. Let's talk.
			</p>

			<div class="flex flex-wrap items-center justify-center gap-4" data-animate style="--delay:240ms">
				<a
					href="<?php echo esc_url( home_url( '/contact' ) ); ?>"
					class="inline-flex items-center gap-2 px-6 py-3 text-sm font-medium no-underline transition-colors duration-200 rounded-sm bg-accent text-bg hover:bg-white"
				>
					Get in Touch
					<span aria-hidden="true">→</span>
				</a>
				<a
					href="https://github.com/setheugene"
					class="inline-flex items-center gap-2 px-6 py-3 text-sm no-underline transition-colors duration-200 border rounded-sm text-muted border-border hover:text-white hover:border-white"
					target="_blank"
					rel="noopener noreferrer"
				>
					GitHub ↗
				</a>
			</div>

		</div>
	</section>

</main>

<?php get_footer(); ?>
